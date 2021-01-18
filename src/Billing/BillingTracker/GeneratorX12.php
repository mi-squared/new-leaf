<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\BillingTracker\Traits\GeneratesTxt;
use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Billing\X125010837P;

class GeneratorX12 extends AbstractGenerator implements GeneratorInterface
{
    /**
     * If "Allow Encounter Claims" is enabled, this allows the claims to use
     * the alternate payor ID on the claim and sets the claims to report,
     * not chargeable. ie: RP = reporting, CH = chargeable
     *
     * @var bool|mixed
     */
    protected $encounter_claim = false;

    /**
     * @var BillingClaimBatch
     */
    private $batch;

    public function __construct($action, $encounter_claim = false)
    {
        parent::__construct($action);
        $this->encounter_claim = $encounter_claim;
    }

    public function setup($context)
    {
        $this->batch = new BillingClaimBatch();
        $filename = $this->batch->getBatFilename() . '.txt';
        $this->batch->setBatFilename($filename);
    }

    /**
     * @param BillingClaim $claim
     * @param bool $createNewVersion
     */
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

        // Generate the file
        $log = '';
        $segs = explode("~\n", X125010837P::genX12837P($claim->getPid(), $claim->getEncounter(), $log, $this->encounter_claim));
        $this->appendToLog($log);
        $this->batch->append_claim($segs);

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

        return $tmp;
    }

    public function complete($context = null)
    {
        $this->batch->append_claim_close();
        // If we're validating only, or clearing and validiating, don't write to our EDI directory
        // Just send to the browser in that case for the end-user to review.

//        if ($this->action ===)
        $format_bat = str_replace('~', PHP_EOL, $bat_content);
        $wrap = "<!DOCTYPE html><html><head></head><body><div style='overflow: hidden;'><pre>" . text($format_bat) . "</pre></div></body></html>";
        echo $wrap;
        exit();

        $this->batch->write_batch_file();
    }
}
