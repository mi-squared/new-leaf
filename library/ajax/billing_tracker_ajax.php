<?php

/**
 * Ajax endpoint for interface/billing/billing_tracker.php,
 * which is the interface that provides tracking information for a claim batch
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once __DIR__ . "/../../interface/globals.php";

use OpenEMR\Common\Csrf\CsrfUtils;

// verify csrf
if (!CsrfUtils::verifyCsrfToken($_GET["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

$remoteTracker = new \OpenEMR\Billing\BillingTracker\X12RemoteTracker();
$claim_files = $remoteTracker->fetchAll();
$response = new stdClass();
$response->data = [];
foreach ($claim_files as $claim_file) {
    $element = new stdClass();
    $element->x12_partner_name = $claim_file['name'];
    $element->x12_filename = $claim_file['x12_filename'];
    $element->status = $claim_file['status'];
    $element->created_at = oeFormatDateTime($claim_file['created_at']);
    $element->updated_at = oeFormatDateTime($claim_file['updated_at']);
    $element->claims = [];
    $response->data []= $element;
}

echo json_encode($response);
exit();
