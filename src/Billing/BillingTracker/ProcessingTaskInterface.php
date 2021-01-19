<?php

namespace OpenEMR\Billing\BillingTracker;

interface ProcessingTaskInterface
{
    public function setup($context);

    public function execute(BillingClaim $claim);

    public function complete($context = null);
}
