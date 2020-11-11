<?php

/*   This script is for importing data from the three spreadsheets provided from new-leaf
 *

	Your database now has deidientified all data and can never be restored.

 * Copyright (C) 2020 Daniel Pflieger <growlingflea@gmail.com daniel@mi-squared.com and OEMR <www.oemr.org>
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @package OpenEMR
 * @author  Daniel Pflieger <growlingflea@gmail.com> <daniel@mi-squared.com>
 * @link    http://www.open-emr.org


*/

//Read in the first line of the file.  These are the names of the columns
require_once(dirname(__FILE__) . "/../interface/globals.php");
require_once("$srcdir/sql.inc");
require_once("$srcdir/patient.inc");

//STEP ONE: NAME YOUR FILES.
//declare both files as variables
$source = "/home/growlingflea/Documents/GrowlingfleaSoftware/Accounts/Mi-squared/New Leaf/MedicaidClientRosterFull.csv";

//Column where bad date is


//Open both files
$fh_source = fopen($source, 'r') or die("Failed to open file");


//This returns the demographic information for a single patient.
function buildPatientDataTable($array){

    $patient_data = array();

    foreach($array as $key => $val){

        if (trim(strtolower($key)) == 'first name') {
            $patient_data['fname'] = $val;

        } else if((trim(strtolower($key)) == 'last name')) {
            $patient_data['lname'] = $val;

        } else if((trim(strtolower($key)) == 'activity notes')) {
            $patient_data['billing_note'] = $val;

        } else if((trim(strtolower($key)) == 'dob')) {
            $patient_data['dob'] = date("Y-m-d", strtotime($val));

        } else if((trim(strtolower($key)) == 'county')){
            $patient_data['county'] = $val;

        } else if((trim(strtolower($key)) == 'address line 1')) {
            $patient_data['street'] = $val;

        } else if((trim(strtolower($key)) == 'address line 2')) {
            //handle the city and state
            $city = explode(' ', $val);
            $patient_data['state']  = array_pop($city);
            $city = implode(" ", $city);
            $patient_data['city'] = $city;

        } else if((trim(strtolower($key)) == 'address line 3')){
            $patient_data['postal_code'] =  $val;

        } else if((trim(strtolower($key)) == 'primary phone')){
            $patient_data['phone_home'] =  $val;

        } else if((trim(strtolower($key)) == 'email address')){
            $patient_data['email'] = $val;

        } else if((trim(strtolower($key)) == strtolower('Parent / Guardian Name (Relationship)'))) {
            $guardian_array = explode(' ', $val);
            $patient_data['guardianrelationship'] = array_pop($guardian_array);
            $name = implode(" ", $guardian_array);
            $patient_data['guardiansname'] = $name;

        }else if(strpos($key, 'Gender') !== false){
            if($val == "M")
                $patient_data['sex'] = "Male";
            else if($val == "F")
                $patient_data['sex'] = "Female";
            else $patient_data['sex'] = '';

        }else if((strpos(trim(strtolower($key)), 'ethnicity')) !== false) {

            switch($val){
                case "H":
                    $patient_data['ethnicity'] = 'hisp_or_latin';
                    break;
                case "B" or "W":
                    $patient_data['ethnicity'] = 'not_hisp_or_latin';
                default:
                    $patient_data['ethnicity'] = '';

            }


        }




    }

    return $patient_data;
}

function buildInsuraceDataTable($array, $pid){
    $patientInsData = array();

    foreach($array as $key => $val) {
        if ((strpos(trim(strtolower($key)), 'primary insurance')) !== false) {
            switch ($val) {
                case "M":
                    $patientInsData['plan_name'] = "Medicaid";
                    $patientInsData['provider'] = 8;

                    break;
                default:
                    $patientInsData['plan_name'] = "Unknown";

            }
        } else if((trim(strtolower($key)) == 'last name')) {
            $patientInsData['subscriber_lname'] = $val;

        } else if ((strpos(trim(strtolower($key)), 'primary ins no')) !== false) {
            $patientInsData['primary']['policy_number'] = $val;

        } else if ((strpos(trim(strtolower($key)), 'secondary ins no')) !== false) {
            $patientInsData['secondary']['policy_number'] = $val;

        } else if ((strpos(trim(strtolower($key)), 'relation to')) !== false) {
            $patientInsData['subscriber_relationship'] = $val;

        } else if ((strpos(trim(strtolower($key)), 'insurance notes')) !== false) {
            $insArray = explode(' ', $val);
            $startDate = $insArray[0];
            $startDate = preg_replace(':', '', $startDate);
            $patientInsData['date'] = date('Y-m-d', strtotime($startDate));
            echo '';

        } else if((trim(strtolower($key)) == 'dob')) {
            $patientInsData['subscriber_dob'] = date("Y-m-d", strtotime($val));

        } else if (trim(strtolower($key)) == 'first name') {
            $patientInsData['subscriber_fname'] = $val;

        } else if((trim(strtolower($key)) == 'primary phone')){
            $patientInsData['subscriber_phone'] = $val;

        } else if((trim(strtolower($key)) == 'address line 1')) {
            $patientInsData['subscriber_street'] = $val;

        } else if((trim(strtolower($key)) == 'address line 2')) {
            //handle the city and state
            $city = explode(' ', $val);
            $patientInsData['subscriber_state'] = array_pop($city);
            $city = implode(" ", $city);
            $patientInsData['subscriber_city'] = $city;

        } else if((trim(strtolower($key)) == 'address line 3')){
            $patientInsData['subscriber_postal_code'] = $val;

        } else if (trim(strtolower($key)) == 'insurance notes'){
            $var = explode(' ', $val);
            $patientInsData['date'] = date('Y-m-d', strtotime($var[0]));

        } else if(strpos($key, 'Gender') !== false){
            if($val == "M")
                $patientInsData['subscriber_sex'] = "Male";
            else if($val == "F")
                $patientInsData['subscriber_sex'] = "Female";
            else  $patientInsData['subscriber_sex'] = '';

        }
    }
   // $patientInsData['accept_assignment'] = 'YES';
    $patientInsData['pid'] = $pid;
    //After we build the ins data, we get the pid
    return $patientInsData;
}


function importPatientData($patient_data){

    //check if the lname, fname, dob exists in the patient_data table
    $sql = "Select * from patient_data where lname = ? and fname = ? and dob = ? ";
    $res = sqlStatement($sql, array($patient_data['lname'], $patient_data['fname'], $patient_data['dob']));
    $numRows = sqlNumRows($res);

    $keys = implode(', ', array_keys($patient_data));
    $values = "'" . implode("','", array_values($patient_data)) . "'";
    $binding = '';
    $update = "Update patient_data set " ;
    foreach($patient_data as $index => $value ) {

        //Here we skip the insurance array and ignore it for the ptData array

        $binding .= "?, ";
        $update .= " $index = ?,";
    }


    // if a record exists we will update, else we will insert
    if($numRows > 0 ){
        $row = sqlFetchArray($res);
        $update = substr($update, 0, -1);
        $update .= " where pid = {$row['pid']} ";
        $success = sqlStatement($update, array_values($patient_data));
        return array('action' => 'update', 'pid' => $row['pid'], 'lname' => $patient_data['lname'], 'fname' => $patient_data['fname']  );

    }else{
        //this is new so we need to get a new pid
        $pid = "select max(pid) as pid from patient_data";
        $newPid = sqlQuery($pid)['pid'] +  1;
        $patient_data = array_merge($patient_data, array('pid' => $newPid));
        //here we add the pid since this is a new patient
        $keys .= ", pid ";
        $values .= ", " . $newPid;
        $binding .= "? ";
        //$values = explode(',', $values);

        $query = 'INSERT into patient_data  ('.$keys.') values ('.$binding.')';
        $success = sqlStatement($query, array_values($patient_data));
        return array('action' => 'insert', 'pid' => $newPid, 'lname' => $patient_data['lname'], 'fname' => $patient_data['fname']  );
    }


}

function importInsuranceData($patient_data, $pid, $insData){


    $i1dob = $patient_data['dob'];
    //does a insurance record exist for this pid?  If so we update, if not we add a promary, secondary and tritary columns
    newInsuranceData(
        $pid,
        "primary",
        $insData['provider'],
        $insData['primary']['policy_number'],
        $insData['group_number'],
        $insData['plan_name'],
        $insData['subscriber_lname'],
        $insData['subscriber_mname'],
        $insData['subscriber_fname'],
        'self',
        $insData['subscriber_ss'],
        $i1dob,
        $insData['subscriber_street'],
        $insData['subscriber_postal_code'],
        $insData['subscriber_city'],
        $insData['subscriber_state'],
        "",
        $insData['subscriber_phone'],
        $insData['subscriber_employer'],
        $insData['subscriber_employer_street'],
        $insData['subscriber_employer_city'],
        $insData['subscriber_employer_postal_code'],
       '',
       '',
       '' ,
        $insData['subscriber_sex'],
        $insData['date'],
        'YES',
        ''
    );

    newInsuranceData(
        $pid,
        "secondary",
        filter_input(INPUT_POST, "i2provider"),
        filter_input(INPUT_POST, "i2policy_number"),
        filter_input(INPUT_POST, "i2group_number"),
        filter_input(INPUT_POST, "i2plan_name"),
        filter_input(INPUT_POST, "i2subscriber_lname"),
        filter_input(INPUT_POST, "i2subscriber_mname"),
        filter_input(INPUT_POST, "i2subscriber_fname"),
        filter_input(INPUT_POST, "form_i2subscriber_relationship"),
        filter_input(INPUT_POST, "i2subscriber_ss"),
        $i1dob,
        filter_input(INPUT_POST, "i2subscriber_street"),
        filter_input(INPUT_POST, "i2subscriber_postal_code"),
        filter_input(INPUT_POST, "i2subscriber_city"),
        filter_input(INPUT_POST, "form_i2subscriber_state"),
        filter_input(INPUT_POST, "form_i2subscriber_country"),
        filter_input(INPUT_POST, "i2subscriber_phone"),
        filter_input(INPUT_POST, "i2subscriber_employer"),
        filter_input(INPUT_POST, "i2subscriber_employer_street"),
        filter_input(INPUT_POST, "i2subscriber_employer_city"),
        filter_input(INPUT_POST, "i2subscriber_employer_postal_code"),
        filter_input(INPUT_POST, "form_i2subscriber_employer_state"),
        filter_input(INPUT_POST, "form_i2subscriber_employer_country"),
        filter_input(INPUT_POST, 'i2copay'),
        filter_input(INPUT_POST, 'form_i2subscriber_sex'),
        '',
        '',
        ''
    );

    newInsuranceData(
        $pid,
        "tertiary",
        filter_input(INPUT_POST, "i3provider"),
        filter_input(INPUT_POST, "i3policy_number"),
        filter_input(INPUT_POST, "i3group_number"),
        filter_input(INPUT_POST, "i3plan_name"),
        filter_input(INPUT_POST, "i3subscriber_lname"),
        filter_input(INPUT_POST, "i3subscriber_mname"),
        filter_input(INPUT_POST, "i3subscriber_fname"),
        filter_input(INPUT_POST, "form_i3subscriber_relationship"),
        filter_input(INPUT_POST, "i3subscriber_ss"),
        $i1dob,
        filter_input(INPUT_POST, "i3subscriber_street"),
        filter_input(INPUT_POST, "i3subscriber_postal_code"),
        filter_input(INPUT_POST, "i3subscriber_city"),
        filter_input(INPUT_POST, "form_i3subscriber_state"),
        filter_input(INPUT_POST, "form_i3subscriber_country"),
        filter_input(INPUT_POST, "i3subscriber_phone"),
        filter_input(INPUT_POST, "i3subscriber_employer"),
        filter_input(INPUT_POST, "i3subscriber_employer_street"),
        filter_input(INPUT_POST, "i3subscriber_employer_city"),
        filter_input(INPUT_POST, "i3subscriber_employer_postal_code"),
        filter_input(INPUT_POST, "form_i3subscriber_employer_state"),
        filter_input(INPUT_POST, "form_i3subscriber_employer_country"),
        filter_input(INPUT_POST, 'i3copay'),
        filter_input(INPUT_POST, 'form_i3subscriber_sex'),
        '',
        '',
        ''
    );

}



//STEP THREE: Get the columns
//This will change.
//Read the headers and transform them into Open EMR headers. Some of these
//headers are obvious, some aren't.  Some are put in the genericval, genericname
//columns.

//read the first line
$col = fgetcsv($fh_source, 0, ',');

while(!feof($fh_source)){

    $row = fgetcsv($fh_source, 0 , ',');
    if($row[0] == '') break;

    //combine the arrays using array_combine
    $insert_base = array_combine($col, $row);

    //There are two cases, either update or insert.  We need to build the arrays first
    $patient_data = buildPatientDataTable($insert_base);

    //if by chance the csv file has unlimited rows
    $action = importPatientData($patient_data);
    ob_flush();
    flush();
    echo "<br>{$action['action']} for {$action['lname']}, {$action['fname']} with pid: {$action['pid']}";
    ob_flush();
    flush();
    $action = buildInsuraceDataTable($insert_base, $action['pid']);

    importInsuranceData($patient_data, $action['pid'], $action);

    echo '';


}
echo "\n\n You successfully updated or inserted entries";
//close both files
fclose($fh_source);

