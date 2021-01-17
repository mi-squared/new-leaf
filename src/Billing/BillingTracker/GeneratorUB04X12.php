<?php


namespace OpenEMR\Billing\BillingTracker;

require_once __DIR__ . '/../../../interface/billing/ub04_dispose.php';

class GeneratorUB04X12 extends AbstractGenerator implements GeneratorInterface
{
    // These two are specific to UB04
    protected $template = array();
    protected $ub04id = array();

    protected $batch;

    public function setup($context)
    {
        $this->batch = new BillingClaimBatch();
    }

    public function execute(BillingClaim $claim)
    {
        $this->ub04id = get_ub04_array($claim->getPid(), $claim->getEncounter());
        $ub_save = json_encode($this->ub04id);
        $tmp = BillingUtilities::updateClaim(
            true,
            $claim->getPid(),
            $claim->getEncounter(),
            $claim->getPayorId(),
            $claim->getPayorType(),
            BillingClaim::STATUS_MARK_AS_BILLED,
            BillingClaim::BILL_PROCESS_IN_PROGRESS,
            '',
            $claim->getTarget(),
            $claim->getPartner() . '-837I',
            0,
            $ub_save);

        $log = '';
        $segs = explode("~\n", X125010837I::generateX12837I($claim->getPid(), $claim->getEncounter(), $log, $this->ub04id));
        $this->appendToLog($log);
        $this->append_claim($segs);
        if ($this->getAction() === BillingProcessor::VALIDATE_ONLY) {
            return $tmp;
        } else {
            if (!BillingUtilities::updateClaim(false, $claim->getPid(), $claim->getEncounter(), -1, -1, 2, 2, $this->batch->getBatFilename(), 'X12-837I', -1, 0, json_encode($ub04id))) {
                $this->printToScreen(xl("Internal error: claim ") . $claim->getId() . xl(" not found!") . "\n");
            }
        }

        return $tmp;
    }

    public function complete($context = null)
    {
        $this->batch->write_batch_file();
    }
}
