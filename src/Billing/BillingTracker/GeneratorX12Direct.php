<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Billing\X125010837P;

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

    public function __construct($encounter_claim = false)
    {
        $this->encounter_claim = $encounter_claim;
    }

    public function setup($context)
    {
        // We have to prepare our batches here
        $result = sqlStatement("SELECT * from x12_partners");
        while ($row = sqlFetchArray($result)) {

            // If the local directory doesn't exist, attempt to create it
            if (isset($row['x12_sftp_local_dir']) &&
                !is_dir($row['x12_sftp_local_dir'])) {
                $state = mkdir($row['x12_sftp_local_dir'], '644', true);
                if (false === $state) {
                    $this->printToScreen(xl("Could not create directory for X12 partner " . $row['name']));
                }
            }

            $batch = new BillingClaimBatch();
            $filename = $batch->getBatFilename();
            $filename = $bat_filename = str_replace('batch', 'batch-p'.$row['id'], $filename );
            $batch->setBatFilename($filename);
            $batch->setBatFiledir($row['x12_sftp_local_dir']);

            // Store the directory in an associative array with the partner ID as the index
            $this->x12_partner_dirs[$row['id']] = $batch;
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
            if (!BillingUtilities::updateClaim(false, $claim->getPid(), $claim->getEncounter(), -1, -1, 2, 2, $this->batch->getBatFilename())) {
                $this->printToScreen(xl("Internal error: claim ") . $claim->getId() . xl(" not found!") . "\n");
            }
        }
    }

    public function complete($context = null)
    {
        foreach ($this->x12_partner_batches as $x12_partner_batch) {
            $x12_partner_batch->write_batch_file();
        }
    }
}
