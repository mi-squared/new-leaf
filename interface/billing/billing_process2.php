<?php

/*
 * Billing process Program
 *
 * This program processes data for claims generation
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Terry Hill <terry@lilysystems.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Stephen Waite <stephen.waite@cmsvt.com>
 * @copyright Copyright (c) 2014-2020 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2016 Terry Hill <terry@lillysystems.com>
 * @copyright Copyright (c) 2017-2020 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2018-2020 Stephen Waite <stephen.waite@cmsvt.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
require_once("$srcdir/patient.inc");

use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Billing\Hcfa1500;
use OpenEMR\Billing\X125010837I;
use OpenEMR\Billing\X125010837P;
use OpenEMR\Common\Crypto\CryptoGen;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}


// Initialize billing processor with the post variables from the billing manager form
$billingProcessor = new \OpenEMR\Billing\BillingTracker\BillingProcessor($_POST);
$billingProcessor->execute();
?>
<html>
<head>
    <?php Header::setupHeader(); ?>
    <script>
        $(function () {
            $("#close-link").click(function () {
                window.close();
            });
        });
    </script>
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h3><?php echo xlt('Billing queue results'); ?>:</h3>
                <ul>
                    <li>
                        <?php
                        foreach ($bill_info as $infoline) {
                            echo nl2br($infoline);
                        }
                        ?>
                    </li>
                </ul>
                <button class="btn btn-secondary btn-sm btn-cancel" id="close-link">
                    <?php echo xlt('Close'); ?>
                </button>
            </div>
        </div>
    </div>
</body>
</html>
