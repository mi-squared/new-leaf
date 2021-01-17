<?php


namespace OpenEMR\Billing\BillingTracker;


class ProcessUB04Form
{
    use GeneratesPdf;

    // These two are specific to UB04
    protected $template = array();
    protected $ub04id = array();

    public function setup()
    {

    }
}
