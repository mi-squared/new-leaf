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
echo '
{
    "data": [
        {
            "id": "3",
            "dateCreated": "2020-08-18",
            "dateUpdated": "2020-08-19",
            "status": "Sent",
            "x12Partner": "Test",
            "file": "/tmp/somefile.txt",
            "claims": [
                "1", "1",
                "2", "2"
            ]
        },
        {
            "id": "2",
            "dateCreated": "2020-08-16",
            "dateUpdated": "2020-08-17",
            "status": "Not Sent",
            "x12Partner": "Test",
            "file": "/tmp/somefile.txt",
            "claims": []
        }
    ]
}';
