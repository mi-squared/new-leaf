<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\BillingTracker\Traits\WritesToBillingScreen;
use OpenEMR\Billing\BillingUtilities;

class TaskMarkAsClear extends AbstractProcessingTask implements ProcessingTaskInterface
{
    use WritesToBillingScreen;

    public function setup()
    {

    }

    public function execute(BillingClaim $claim)
    {
        $this->appendToScreen(xl("Claim ") . $claim->getId() . xl(" was marked as billed only.") . "\n");
        return $this->clearClaim($claim);
    }
}
