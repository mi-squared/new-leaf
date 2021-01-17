<?php
/**
 * Model that provides tracking information for a run of claim processing using
 * the billing manager. Each run is saved as an entry in the billing_tracker_batch
 * table.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Services\BaseService;

class BillingTrackerBatch extends BaseService
{
    protected $bat_content, $bat_filename, $bat_file_dir;

    const TABLE_NAME = 'billing_tracker_batch';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    public function create($fields)
    {
        $setQueryPart = $this->buildInsertColumns($fields);
        $sql = " INSERT INTO {self::TABLE_NAME} SET ";
        $sql .= $setQueryPart['set'];

        $results = sqlInsert(
            $sql,
            $setQueryPart['bind']
        );
    }


}
