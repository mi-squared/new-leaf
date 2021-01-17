<?php


namespace OpenEMR\Billing\BillingTracker;


class GeneratorExternal extends AbstractProcessingTask implements GeneratorInterface
{
    protected $be;

    public function setup()
    {
        $this->be = new \BillingExport();
    }

    public function setAction($action)
    {
        // TODO: Implement setAction() method.
    }

    public function processClaim(BillingClaim $claim)
    {
        $this->be->addClaim($claim->getPid(), $claim->getEncounter());
        return $this->clearClaim($claim);
    }
}
