<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Common\Crypto\CryptoGen;

class BillingLogger
{
    protected $bill_info = [];
    protected $hlog;

    public function __construct()
    {
        if ($GLOBALS['billing_log_option'] == 1) {
            // Set up crypto object
            $cryptoGen = new CryptoGen();

            if (file_exists($GLOBALS['OE_SITE_DIR'] . "/documents/edi/process_bills.log")) {
                $this->hlog = file_get_contents($GLOBALS['OE_SITE_DIR'] . "/documents/edi/process_bills.log");
            }
            if ($cryptoGen->cryptCheckStandard($this->hlog)) {
                $this->hlog = $cryptoGen->decryptStandard($this->hlog, null, 'database');
            }
        } else { // ($GLOBALS['billing_log_option'] == 2)
            $this->hlog = '';
        }
    }

    public function printToScreen($message)
    {
        $this->bill_info[]= $message;
    }

    public function bill_info()
    {
        return $this->bill_info;
    }

    public function appendToLog($message)
    {
        $this->hlog .= $message;
    }

    public function hlog()
    {
        return $this->hlog;
    }
}
