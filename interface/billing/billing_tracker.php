<?php

/**
 * Interface that provides tracking information for a claim batch
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2020 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../globals.php");
require_once "$srcdir/options.inc.php";

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use OpenEMR\OeUI\OemrUI;
?>
<html>
<head>
    <?php Header::setupHeader(['datatables', 'datatables-colreorder', 'datatables-dt', 'datatables-bs']); ?>
    <title><?php echo xlt("Claim Batch Tracker"); ?></title>
    <style>
        table.dataTable td.details-control:before {
            content: '\f152';
            font-family: 'Font Awesome\ 5 Free';
            cursor: pointer;
            font-size: 22px;
            color: #55a4be;
        }
        table.dataTable tr.shown td.details-control:before {
            content: '\f150';
            color: black;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            const serverUrl = "<?php echo $GLOBALS['webroot']; ?>/library/ajax/billing_tracker_ajax.php?csrf_token_form=" + <?php echo js_url(CsrfUtils::collectCsrfToken()); ?>;
            const oTable = $('#billing-tracker-table').DataTable({
                "processing": true,
                // next 2 lines invoke server side processing
                "ajax": {
                    "type" : "GET",
                    "url" : serverUrl,
                    "dataSrc": function (json) {
                        return json.data;
                    }
                },
                "columns": [
                    {
                        "class": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    { "data": "status" },
                    { "data": "x12_partner_name" },
                    {
                        "data": "x12_filename",
                        "render": function(data, type, row, meta){
                            if(type === 'display'){
                                const url = '<?php echo $GLOBALS['webroot']; ?>/interface/billing/get_claim_file.php?key=' +
                                    data + '&csrf_token_form=<?php echo CsrfUtils::collectCsrfToken(); ?>';
                                data = '<a href="' + url + '">' + data + '</a>';
                            }

                            return data;
                        }
                    },
                    { "data": "created_at" },
                    { "data": "updated_at" },
                ],
                "order": [[1, 'asc']]
            });

            oTable.on('preXhr.dt', function (e, settings, data) {
                console.log("before ajax call");
                top.restoreSession();
            });

            /* Formatting function for row details - modify as you need */
            function format (d) {
                // `d` is the original data object for the row
                let claimsTable = 'd.messages' +
                    '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                    '<tr>'+
                    '<td>Jim Jones</td>'+
                    '<td>BCBS NC</td>'+
                    '<td>$150</td>'+
                    '<td><a href="">details</a></td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>Paula Smith</td>'+
                    '<td>BCBS NC</td>'+
                    '<td>$200</td>'+
                    '<td><a href="">details</a></td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td>John Dow</td>'+
                    '<td>BCBS NC</td>'+
                    '<td>$50</td>'+
                    '<td><a href="">details</a></td>'+
                    '</tr>'+
                    '</table>';

                return claimsTable;
            }

            // Add event listener for opening and closing details
            $('#billing-tracker-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).parents('tr');
                var row = oTable.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        });
    </script>
</head>
<body>
    <div id="container_div" class="mt-3">
         <div class="w-100 p-4">

             <table id="billing-tracker-table">
                 <thead>
                 <tr>
                     <th>&nbsp;</th>
                     <th><?php echo xl('Status') ?></th>
                     <th><?php echo xl('X-12 Partner') ?></th>
                     <th><?php echo xl('File') ?></th>
                     <th><?php echo xl('Date Created') ?></th>
                     <th><?php echo xl('Date Updated') ?></th>
                 </tr>
                 </thead>
                 <tfoot>
                 <tr>
                     <th>&nbsp;</th>
                     <th><?php echo xl('Status') ?></th>
                     <th><?php echo xl('X-12 Partner') ?></th>
                     <th><?php echo xl('File') ?></th>
                     <th><?php echo xl('Date Created') ?></th>
                     <th><?php echo xl('Date Updated') ?></th>
                 </tr>
                 </tfoot>
             </table>
        </div>
    </div>
</body>
</html>
