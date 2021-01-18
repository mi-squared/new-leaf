<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Billing\X125010837P;
use OpenEMR\Common\Csrf\CsrfUtils;

class GeneratorX12Direct extends AbstractGenerator implements GeneratorInterface
{
    /**
     * If "Allow Encounter Claims" is enabled, this allows the claims to use
     * the alternate payor ID on the claim and sets the claims to report,
     * not chargeable. ie: RP = reporting, CH = chargeable
     *
     * @var bool|mixed
     */
    protected $encounter_claim = false;

    protected $x12_partner_batches = [];

    public function __construct($action, $encounter_claim = false)
    {
        parent::__construct($action);
        $this->encounter_claim = $encounter_claim;
    }

    public function setup($context)
    {
        // We have to prepare our batches here
        $result = sqlStatement("SELECT * from x12_partners");
        while ($row = sqlFetchArray($result)) {

            $has_dir = true;
            if (!isset($row['x12_sftp_local_dir'])) {
                // Local Directory not set
                $has_dir = false;
                $this->printToScreen(xl("No directory for X12 partner " . $row['name']));
            } else if (isset($row['x12_sftp_local_dir']) &&
                !is_dir($row['x12_sftp_local_dir'])) {
                // If the local directory doesn't exist, attempt to create it
                $has_dir = mkdir($row['x12_sftp_local_dir'], '644', true);
                if (false === $has_dir) {
                    $this->printToScreen(xl("Could not create directory for X12 partner " . $row['name']));
                }
            }

            $batch = new BillingClaimBatch();
            $filename = $batch->getBatFilename();
            $filename = str_replace('batch', 'batch-p'.$row['id'], $filename);
            $filename = $filename . '.txt';
            $batch->setBatFilename($filename);

            // Only set the batch file directory if we have a valid directory
            if ($has_dir) {
                $batch->setBatFiledir($row['x12_sftp_local_dir']);
            }

            // Store the directory in an associative array with the partner ID as the index
            $this->x12_partner_batches[$row['id']] = $batch;
        }
    }

    public function execute(BillingClaim $claim)
    {
        // Status is a filed in claims table
        $status = 0;
        if ($this->getAction() === BillingProcessor::NORMAL) {
            $status = BillingClaim::STATUS_MARK_AS_BILLED; // Status == 2 means mark as billed and set the billed date
        } else if ($this->getAction() === BillingProcessor::VALIDATE_AND_CLEAR) {
            $status = BillingClaim::STATUS_LEAVE_UNBILLED; // Status == 1 means leave as unbilled
        }

        $this->printToScreen(xl("Processing claim " . $claim->getId()));

        $tmp = BillingUtilities::updateClaim(
            true,
            $claim->getPid(),
            $claim->getEncounter(),
            $claim->getPayorId(),
            $claim->getPayorType(),
            $status,
            BillingClaim::BILL_PROCESS_IN_PROGRESS, // bill_process == 1 means??
            '', // process_file
            $claim->getTarget(),
            $claim->getPartner()
        );

        // Get the correct batch file using the X-12 partner ID
        $batch = $this->x12_partner_batches[$claim->getPartner()];

        // Use the tr3 format to output for direct-submission to insurance companies
        $log = '';
        $segs = explode("~\n", X125010837P::gen_x12_837_tr3($claim->getPid(), $claim->getEncounter(), $log, $this->encounter_claim, $claim->getIsLast()));
        $this->appendToLog($log);
        $batch->append_claim($segs);

        // If we're validating only, exit. Otherwise finish the claim
        if ($this->getAction() === BillingProcessor::VALIDATE_ONLY) {
            // Don't finalize the claim, just return after we write the claim to the batch file
            return $tmp;
        } else {
            // After we save the claim, update it with the filename (don't create a new revision)
            if (!BillingUtilities::updateClaim(false, $claim->getPid(), $claim->getEncounter(), -1, -1, 2, 2, $batch->getBatFilename())) {
                $this->printToScreen(xl("Internal error: claim ") . $claim->getId() . xl(" not found!") . "\n");
            }
        }
    }

    public function complete($context = null)
    {
        $format_bat = "";
        $created_batches = [];
        // Loop through all of the X12 batch files we've created, one per x-12 partner,
        // and depending on the action we're running, either write the final claim
        // to disk, or format the content for printing to the screen.
        foreach ($this->x12_partner_batches as $x12_partner_id => $x12_partner_batch) {

            if (empty($x12_partner_batch->getBatContent())) {
                // If we didn't write any claims for this X12 partner
                // don't append the closing lines or write the claim file or do anything else
                continue;
            }

            $x12_partner_batch->append_claim_close();

            // If this is the final, validated claim, write to the edi location
            // for this x12 partner
            if ($this->getAction() === BillingProcessor::VALIDATE_ONLY ||
                $this->getAction() === BillingProcessor::VALIDATE_AND_CLEAR) {
                $format_bat .= str_replace('~', PHP_EOL, $x12_partner_batch->getBatContent()) . "\n";
            } else if ($this->getAction() === BillingProcessor::NORMAL) {
                $x12_partner_batch->write_batch_file($x12_partner_id);
            }

            $created_batches[]= $x12_partner_batch;
        }

        // if validating (sending to screen for user)
        if ($this->getAction() === BillingProcessor::VALIDATE_ONLY ||
            $this->getAction() === BillingProcessor::VALIDATE_AND_CLEAR) {
            $wrap = "<!DOCTYPE html><html><head></head><body><div style='overflow: hidden;'><pre>" . text($format_bat) . "</pre></div></body></html>";
            echo $wrap;
            exit();
        } else if ($this->getAction() === BillingProcessor::NORMAL) {

            // In the "normal" operation, we have written the batch files to disk above, and
            // need to build a presentation for the user to download them.
            $html = "<!DOCTYPE html><html><head></head><body><div style='overflow: hidden;'>";

            // If the global is enabled to SFTP claim files, tell the user
            if ($GLOBALS['auto_sftp_claims_to_x12_partner']) {
                $html .= "<div class='alert alert-primary' role='alert'>" . xl("Sending Claims via STFP. Check status on the `Claim File Tracker`") . "</div>";
            }

            // Build the download URLs for our claim files so we can present them to the
            // user for download.
            $html .= "<ul class='list-group'>";
            foreach ($created_batches as $created_batch) {
                $file = $created_batch->getBatFilename();
                $url = $GLOBALS['webroot'] . '/interface/billing/get_claim_file.php?key=' . $file .
                    '&csrf_token_form=' . CsrfUtils::collectCsrfToken();
                $html .= "<li class='list-group-item d-flex justify-content-between align-items-center'><a href='$url'>$file</a></li>";
            }
            $html .= "</ul>";
            $html .= "</div></body></html>";
            $this->logger->setShowCloseButton(false);
            echo $html;
        }

    }
}
