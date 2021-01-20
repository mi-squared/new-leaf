<?php

/**
 * These are logging functions that were extracted from the original
 * billing_process.php function and placed here.
 *
 * Each Processing Task that writes to the log can 'use' the trait
 * WritesToBillingLog which helps the task implement the LoggerInterface.
 *
 * That trait will keep a reference of this object, which is passed all
 * throughout the billing process, so everything writes to the same log.
 *
 * At the end of the billing process, the BillingLogger instance is
 * returned to billing_process.php to write any log messages to the screen.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Ken Chapple <ken@mi-squared.com>
 * @author    Daniel Pflieger <daniel@growlingflea.com>
 * @author    Terry Hill <terry@lilysystems.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Stephen Waite <stephen.waite@cmsvt.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Daniel Pflieger <daniel@growlingflea.com>
 * @copyright Copyright (c) 2014-2020 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2016 Terry Hill <terry@lillysystems.com>
 * @copyright Copyright (c) 2017-2020 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2018-2020 Stephen Waite <stephen.waite@cmsvt.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing\BillingTracker;

use OpenEMR\Common\Crypto\CryptoGen;

class BillingLogger
{
    /**
     * Contains an array of status messages that accumulate
     * through the billing process
     *
     * @var array
     */
    protected $bill_info = [];

    /**
     * Contains a string that represents the results from formatting
     * x-12 claims. This is what you see when you click the 'Logs' button
     * on the result modal.
     *
     * @var false|string
     */
    protected $hlog;

    /**
     * @var function
     */
    protected $onLogCompleteCallback = [];

    /**
     * Show/Hide the 'Close' button that is printed in billing_process.php
     *
     * @var bool
     */
    protected $showCloseButton = true;

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

    public function setLogCompleteCallback($obj, $func)
    {
        $this->onLogCompleteCallback = ['obj' => $obj, 'func' => $func];
    }

    /**
     * Called when log is done writing
     *
     * @return false|mixed
     */
    public function onLogComplete()
    {
        if (isset($this->onLogCompleteCallback['obj']) &&
            isset($this->onLogCompleteCallback['func'])) {

            return call_user_func([
                    $this->onLogCompleteCallback['obj'],
                    $this->onLogCompleteCallback['func']]
            );
        }

        return false;
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

    /**
     * @return bool
     */
    public function showCloseButton(): bool
    {
        return $this->showCloseButton;
    }

    /**
     * @param bool $showCloseButton
     */
    public function setShowCloseButton(bool $showCloseButton): void
    {
        $this->showCloseButton = $showCloseButton;
    }
}
