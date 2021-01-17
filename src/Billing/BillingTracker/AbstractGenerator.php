<?php


namespace OpenEMR\Billing\BillingTracker;

abstract class AbstractGenerator extends AbstractProcessingTask
{
    protected $action;

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }
}
