<?php

use OpenEMR\Common\ORDataObject\ORDataObject;

include_once("../../interface/globals.php"); //include because of jquery functions
require_once("$srcdir/sql.inc.php");
require_once("$srcdir/patient.inc.php");
require_once("$srcdir/formatting.inc.php");

class PrintoutHelper extends ORDataObject
{

    //Returns Patient Name and DOB.
    public static function getPatientNameDOB($pid)
    {
        return sqlQuery("select CONCAT(fname, ' ', lname) as pname, dob from patient_data where pid = ?", array($pid));

    }

    //Returns



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




    public static function getReportData($pid, $report) {

        return sqlQuery("select *, fe.date as encounterDate, fpr.date as dateFormCompleted from forms f
    join $report fpr on f.form_id = fpr.id
    join form_encounter fe on fe.encounter = f.encounter
    where deleted = 0 and fpr.pid = ? " .
            "order by fpr.date desc limit 1", array($pid) );

    }

    public static function getRating($num) {
            switch($num) {
                case 1:
                    return "1(NONE) ";

                case 2:
                    return "2(History now Stable";

                case 3:
                    return "3(Mild / Infrequent)";
                case 4:
                    return "4(Moderate Frequent)";
                case 5:
                    return "5(Severe/Acute)";
            }

    }

    public static function formatNoteField($string, $length = 2): string {

        return "<div>$string</div>";
    }

    public static function newLine($num = 2){
        $string = '';
        for($i=0; $i<=$num; $i++){
            $string .= '<br>';
        }

        return $string;
    }




    public static function generate_checkbox($parameter, $class, $title): string {
        if($parameter == 1) {
            $status = "checked";
        }else{
            $status = '';
        }

        $string = '<div class="'.$class.'"><label for="chbox"><span>'.$title.'</span>
                <input type="checkbox" id="chbox"  value="1" onclick="return false;" '.$status.'>
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

    public static function generate_title($class, $value): string {
        $string = '<div class="'.$class.' ">'.htmlspecialchars($value).'</div>';
        if ($value !== '') {
            return $string;
        } else {
            return '';
        }

    }

    public static function generate_value($class, $value): string {
        $string = '<div class="'.$class.' ">' . $value .'</div>';
        if ($value !== '') {
            return $string;
        } else {
            return '<div class="'.$class.' "></div>';
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

    public static function displayDrugUse($drugs) {
        $string = '';
        $explode = explode('|', $drugs);
        foreach($explode as $drug){
            $item = explode(':', $drug);
            if ($item[1] !== '') {
                $string .= self::generate_checkbox(1, '', $item[0]) .'<div>'. $item[1] . '</div>';

            }


        }

        return $string;
    }

    public static function displayList($str) {
        $string = '';
        if (str_contains($str, '|')) {
            $explode = explode('|', $str);
            foreach ($explode as $item) {

                $string .= $item . ', ';

            }
        } else {
            return $str;
        }

        $string = str_replace('_', ' ', $string);

        return rtrim($string, ', ');
    }

    //This assumes that we get a string with commas
    public static function getHolsticNeeds($str) {
        $str = explode(',', $str);
        $retString = '';

        foreach($str as $s) {

            $retString .= sqlQuery("Select title from list_options where option_id = ? and list_id = ? ", array(trim($s), 'NeedAsssessment'))['title'] . ', ';
        }

        return rtrim($retString, ', ');
    }


}

$data['id'] = $_POST['id'] ?? null ;
if (isset($_POST['func']) && $_POST['func'] == 'getIssues' && $_POST['pid']) {

    $res = sqlStatement("SELECT DISTINCT type, diagnosis, title, short_desc, REPLACE(diagnosis, 'ICD10:', '') AS diag
            FROM lists
            LEFT JOIN icd10_dx_order_code
            ON REPLACE(diagnosis, 'ICD10:', '') = formatted_dx_code
            WHERE pid = ?
            AND type = ?
            AND (activity = 1 OR enddate IS NULL)", array($_POST['pid'], "medical_problem"));
                while($row = sqlFetchArray($res)) {
        array_push($data, $row);
    }
    $data['type'] = "problems";
    $data['title'] = "Health Problems to be Aware of.";

    echo json_encode($data);
}
