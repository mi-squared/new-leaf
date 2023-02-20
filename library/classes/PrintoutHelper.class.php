<?php

include_once("../../interface/globals.php"); //include because of jquery functions
require_once("$srcdir/sql.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/formatting.inc.php");

class PrintoutHelper extends ORDataObject
{

    //Returns Patient Name and DOB.
    public static function getPatientNameDOB($pid)
    {
        return sqlQuery("select CONCAT(fname, ' ', lname) as pname, dob from patient_data where pid = ?", array($pid));

    }

    //Returns
    public static function getEyeData($pid)
    {
        return sqlQuery("SELECT fpr.* FROM patient_data pd
                        JOIN forms f USING (pid) JOIN form_snellen fpr ON f.form_id = fpr.id
                        WHERE pd.pid = ? AND f.deleted = 0
                        ORDER BY fpr.date DESC limit 1", array($pid));
    }

    //We can put in "Allergy"
    public static function getIssues($pid, $issue)
    {
        $count =sqlQuery("select count(*) as count from lists where type = ? ", array($issue))['count'];
        if ($count > 0) {

            return sqlQuery("Select title from lists where pid = ? and type = ? ", array($pid, $issue));
        } else{
            return array('error' => 'Issue does not exist.  ');

        }
    }


    public static function getLastFormLBF($pid, $formdir)
    {
       $form_data =  sqlQuery("SELECT ld.form_id, f.date as date FROM patient_data pd
                join forms f ON f.pid = pd.pid
                join lbf_data ld ON ld.form_id = f.form_id
                WHERE pd.pid = ? AND f.deleted = 0
                AND f.formdir = ? ORDER BY f.date DESC limit 1 ", array($pid, $formdir));


        $res = sqlStatement("Select * from lbf_data where form_id = ? ", array($form_data['form_id']));

        $data['result'] = array();
        while ($row = sqlFetchArray($res)){
            $data['result'][$row['field_id']] = $row['field_value'];
        }

        $data['result']['date'] = $form_data['date'];

        return $data['result'];


    }

    //break up notes into number of lines for printing to a form
    //return note array, if note is too big return note but give error.
    public static function handleNotes($text, $numLines) {


    }

    public static function formatEyeData($array): array
    {
        if (!$array){
            $response['date'] = "No record Exists";

            return $response;
        }

        $vision = "Uncorrected Vision: Left: 20/{$array['left_1']} Right: 20/{$array['left_1']}";
        if ( str_contains($array['notes'], "Referred to optometry")){
            $response['data'] = " Did not pass screening." . $vision;
        }else {
            $response['data'] = " Passed Screening. " . $vision;
        }
        $response['date'] = substr($array['date'], 0, 10);
        return $response;
    }

    public static function formatMedicalIssues($array): string
    {
        $string = '';
        foreach($array as $datum){
            $string .= "  " . $datum != NULL ? $datum : ' ';

        }

        return $string;

    }



    public static function formatHearing($array) : array {

        if (!$array['date']) {
            $response['data'] = "";
            $response['date'] = 'No data exists';
            return $response;
        }

        if ($array['Left_Ear'] === "Passed" && $array['Right_Ear'] === "Passed"){
            $response['data'] =  "Passed Hearing Screening";

        } elseif (str_contains($array['Left_Ear'], 'unco')){
            $response['data'] = $array['Left_Ear'] . " " . $array['Right_Ear'];

        }

        $response['date'] = substr($array['date'], 0, 10);
        return $response;
    }

    public static function getReportData($pid, $report) {

        return sqlQuery("select *, fe.date as encounterDate, fpr.date as dateFormCompleted from forms f
    join $report fpr on f.form_id = fpr.id
    join form_encounter fe on fe.encounter = f.encounter
    where deleted = 0 and fpr.pid = ? " .
            "order by fpr.date desc limit 1", array($pid) );




    }

    public static function formatTBRisk($array) :  array
    {
        if($array['date'] === null) {
            $response['data'] = "No data exists";
            $response['date'] = "";
            return $response;
        }
        //$response['date'] = $array['date'];
        if (strtolower($array['TB_Risk']) == 'no') {
            $response['data'] = 0;
        } else {
            $response['data'] = 1;
        }
        $response['date'] = substr($array['date'], 0, 10);
        return $response;

    }

    public static function formatSpeech($array) : array {
        $response['data'] =  array();

        if($array['AudiologyRefer'] == "Yes"){
            $response['data'][] = "Referred to Audiology.";
        }

        if($array['SpeechTx'] == "Yes") {
            $response['data'][] = "Referred to Speech Therapy.";
        }

        //Go to the fee sheet to get diag codes.

        $response['date'] = substr($array['date'], 0, 10);
        $query = "Select code_type, code, encounter, code_text from billing where date like '{$response['date']}%'
                and activity = 1";

        $res = sqlStatement($query);
        while($row = sqlFetchArray($res)) {
            $response['data'][] = $row['code_type'] . " " . $row['code'] . " " . $row['code_text'];
        }

        return $response;
    }

    public static function getEmergencyContact($pid) {

        $sql = "Select mothersname, relation1name, relation1home, relation1cell, fathersname, " .
            "relation2name, relation2cell, relation2home, guardiansname, relation3name," .
            " relation3cell, relation3home from patient_data where pid = ?";
        $res = sqlQuery($sql, array($pid));

        return $res;


    }

    public static function formatNoteField($string, $length = 90): array {
        $str = wordwrap($string, $length, '<br>');
        $str = explode("<br>", $str);
        return $str;
    }






    public static function generate_checkbox($parameter, $class, $title): string {
        if($parameter == 1) {
            $status = "checked";
        }else{
            $status = '';
        }

        $string = '<div class="'.$class.'"><label for="tbRisk"><span>'.$title.'</span>
                <input type="checkbox" id="tbRisk" name = "tbRisk" value="1" onclick="return false;" '.$status.'>
            </label></div>';

        //if the checkbox is checked we can print it.  if not we send an empty string
        if($status === "checked") {
            return $string;

        }else {
            return '';

        }
    }

    public static function generate_line($title, $class, $value): string {
        $string = '<div class="'.$class.' "><label><span>'.$title.':</span></label>  '.$value.'</div>';
        if ($value !== '') {
            return $string;
        } else {
            return '';
        }

    }

    public static function generate_line_title_val($title, $value): string {
        $string = '<div class="measurement_title">'.$title.'</div><div class="value">'.$value.'</div>';
        if ($value !== '') {
            return $string;
        } else {
            return '';
        }


    }

    public static function getProviders(): array {
        $sql = "select id, CONCAT(fname, ' ', mname, ' ', lname) as providername from users where authorized = 1
              and federaltaxid != '' and calendar = 1 order by id asc";
        $res = sqlStatement($sql);
        $array = array();
        while ($row = sqlFetchArray($res)){
            $array[] = $row;

        }

        return $array;

    }

    public static function getLastWellCheckAppointment($pid) {

        $sql = "select date(date) as date, encounter, opc.pc_catid, opc.pc_catname"
            ." from form_encounter fe "
            ."join openemr_postcalendar_categories opc on opc.pc_catid = fe.pc_catid "
            ." where pid = ? and pc_catname like ? order by date desc limit 1";

        return sqlQuery($sql, array($pid, "%Well%"));


    }







}

//This is kind of OK - but not the best OOP practices.
$data = array();
$data['id'] = $_POST['id'];
if ($_POST['func'] === 'getIssues' && $_POST['pid']) {

    $res = sqlStatement("Select type, diagnosis, title, short_desc, type,  REPLACE(diagnosis, 'ICD10:', '') as diag from lists
        left join icd10_dx_order_code on REPLACE(diagnosis, 'ICD10:', '') = formatted_dx_code
        where pid = ? and type = ? and (activity = 1 or enddate is null)", array($_POST['pid'], "medical_problem"));
    while($row = sqlFetchArray($res)) {
        array_push($data, $row);
    }
    $data['type'] = "problems";
    $data['title'] = "Health Problems to be Aware of.";

    echo json_encode($data);
}

if ($_POST['func'] === 'getAllergies' ) {


    $res = sqlStatement("Select title, type from lists where pid = ? and type = ? ", array($_POST['pid'], "allergy"));
    while($row = sqlFetchArray($res)) {
        array_push($data, $row);
    }
    $data['type'] = "allergies";
    $data['title'] ="Known Allergies";
    echo json_encode($data);

}

if ($_POST['func'] === 'getDental' ) {


    $res = sqlStatement("Select diagnosis, title, type from lists where pid = ? and type = ? and activity = 1", array($_POST['pid'], "dental"));
    while($row = sqlFetchArray($res)) {
        $data[] = $row;
    }
    $data['title'] = "Dental Issues";
    $data['type'] = "Dental Issues";
    echo json_encode($data);

}



if ($_POST['func'] === 'getSpeech'  ) {
    $data = array();
    //get the last encounter and formID of the last Speech Delay form
    $query = sqlQuery("select encounter, form_id, date from forms where formdir = ? and pid = ? and deleted = 0 order by id desc ", array("LBF_SpeechDelay", $_POST['pid']));
    $data['encounter'] = $query['encounter'];
    $data['date'] = substr($query['date'], 0, 10);

    //Get the values from the LBF Form

    $query2 = sqlStatement("Select title, field_value, lbf_data.field_id from lbf_data
    join layout_options on lbf_data.field_id = layout_options.field_id where lbf_data.form_id = ? ", array($query['form_id']));
    while ($row = sqlFetchArray($query2)){
        $data[] = $row;
    }

    $query3 = sqlStatement("Select CONCAT(code_type, ' ', code, ' ', code_text) as title, code as field_id from billing where encounter = ? and code_type like '%ICD%' ", array($data['encounter']) );
    while ($row = sqlFetchArray($query3)) {
        $data[] = $row;
    }
    $data['title'] = "Speech Issues";
    $data['type'] = 'speechIssues';
    echo json_encode($data);

}

if ($_POST['func'] === 'getMeds'  ) {
    $query = sqlStatement("select drug, date_added from prescriptions where patient_id = {$_POST['pid']}");
    while ($row = sqlFetchArray($query)) {
        $data[] = $row;
    }

    $data['type'] = 'meds';
    $data['title'] ='Medications';
    echo json_encode($data);
}

if ($_POST['func'] === 'getContacts'  ) {
    $data[] = PrintoutHelper::getEmergencyContact($_POST['pid']);
    $data['type'] = 'contacts';
    $data['title'] = 'Emergency Contact List';
    echo json_encode($data);

}

if ($_POST['func'] === 'getHearing'  ) {


   $data = PrintoutHelper::getLastFormLBF($_POST['pid'], "LBFHearingSCN");
    $data['type'] = 'hearing';
    $data['title'] = "Hearing Results";
    echo json_encode($data);

}
