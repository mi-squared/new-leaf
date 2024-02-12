<?php

/*
 * this file's contents are included in both the encounter page as a 'quick summary' of a form, and in the medical records' reports page.
 */

/* for $GLOBALS[], ?? */
require_once(dirname(__FILE__).'/../../globals.php');
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_display_field() */
require_once($GLOBALS['srcdir'].'/options.inc.php');
include_once($GLOBALS["srcdir"] . "/classes/PrintoutHelper.class.php");

use OpenEMR\Common\Acl\AclMain;


/* The name of the function is significant and must match the folder name */
function intake_report( $pid, $encounter, $cols, $id) {
    $patient_data = formFetch("form_intake", $id);
    $htmlcss = "
        <style>


        .report {
            padding-top:25px;
            display: grid;
            grid-template-columns:600px 600px;
            grid-gap:5px;
            font-size:12px
        }
        form label {
            display: block;
        }

         .hcontainer {
            display: grid;
            grid-template-columns: 100%;
            grid-template-rows: auto;
            padding: 25px;


        }

        .header {
            font-size: 22px;
            font-weight:bold;
             text-decoration: underline;
        }

        .header2 {
            font-size: 18px;
            font-weight:bold;
             text-decoration: underline;
             margin-top:4ch;
        }

        .header3 {
            font-size: 14px;
            font-weight:bold;
            text-decoration: underline;
            margin-top: 3ch;
        }

        .header4 {
            font-size: 14px;
            font-weight:bold;
            margin-top: 7px;
        }

        .title{
            margin-top: 15px;
        }

        .comments{
            grid-column: 1 / -1;
            margin: 0 0 0 2ch;

        }

         .intake {
            display: grid;
            grid-template-columns: 300px 600px;
            grid-template-rows: auto;
            row-gap:1ch;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            padding:25px;

        }

          .presentingIssue {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: auto;
            row-gap:1ch;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            padding:25px;
            margin: 3ch 0 0 0;

        }

        .longInput{
            width:500px;

        }

        .medInput{
            width:200px;
        }

        .currentSymptoms{
            display: grid;
            grid-template-columns: 300px 200px 800px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #d2c376;
            padding:25px;

        }

.substanceUse {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto;
    row-gap: 1ch;
    margin: 3ch 0 0 0;
    border: 1px solid black;
    border-radius: 5px;
    background-color: #fff9db;
    padding: 25px;
}

.substanceUse .header2 {
    grid-template-columns: 1fr;

}

.substanceUse .row:nth-child(2n) {
    background-color: #fff9db;
    margin: 0 2px 3ch -1px;

}



.substanceUse .row:nth-child(2n+1) {
    background-color: #f1ebd1;
    margin: 0 0 0 0;
}

        .legalHistory{
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #d3cebd;
            padding:25px;
        }

           .oneLineGrid{
            display: grid;
            grid-template-columns: 200px 800px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
            padding:25px;

        }

        .mentalHealth{
            display: grid;
            grid-template-columns: 300px repeat(4, 1fr);;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #d2c376;
            padding:25px;
        }





        .medicalHistory{
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: auto;
            row-gap:1ch;
               border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            margin: 3ch 0 0 0;
            padding:25px;


        }

        .mentalstatus{
            display: grid;
            grid-template-columns: 200px 600px ;
            grid-template-rows: auto;
            row-gap:1ch;
                  border: 1px solid black;
            border-radius: 5px;
            background-color: #d2c376;
            margin: 3ch 0 0 0;
            padding:25px;

        }

        .currentMedications{
            display: grid;
            grid-template-columns: 190px 100px 100px 150px 300px;
            grid-template-rows: auto;
            row-gap:1ch;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            margin: 3ch 0 0 0;
            padding:25px;



        }



        .familyAndSocial{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            row-gap:1ch;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            margin: 3ch 0 0 0;
            padding:25px;
        }


        .developmentHistory{
             grid-template-columns: 800px;
            row-gap:1ch;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            margin: 3ch 0 0 0;
            padding:25px;

        }

        .edEmpHist{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            row-gap:1ch;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #d2c376;
            margin: 3ch 0 0 0;
            padding:25px;



        }

        .holisticNeeds{
            grid-template-columns: 200px 600px;
             border: 1px solid black;
            border-radius: 5px;
            background-color: #fff9db;
            margin: 3ch 0 0 0;
            padding:25px;
        }


        .interpetive{
            grid-template-columns: 200px 600px;
            border: 1px solid black;
            border-radius: 5px;
            background-color: #8fec9b;
            margin: 3ch 0 0 0;
            padding:25px;
        }


          .twoToThreeText{
            grid-column: 2/3;
        }

        .twoToSixText{
            grid-column: 2/6;
        }
         .oneToFiveText{
            grid-column: 1/5;
        }

        .twoToFourText{
             grid-column: 2/4;
        }

          .twoToFiveText{
             grid-column: 2/5;
        }

        .oneToThreeText{
            grid-column: 1/3;
        }

          .oneToSixText{
            grid-column: 1/6;
        }









    </style>

    ";

    $data = "<div class = 'hcontainer'>";
    $data .= "<div class = 'intake'>";
    $data .= PrintoutHelper::generate_title( 'header', "Intake Exam") . "<div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Date of Intake Exam",  substr($patient_data['date_created'], 0, 10));
    $data .= "</div>";

    $data .= "<div class = 'presentingIssue'>";
    $data .= PrintoutHelper::generate_title( 'header2', "Presenting Issue/Chief Complaint") . "<div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Presenting Issue/Chief Complaint", $patient_data['presenting_issue']);
    $data .= "</div>"; //end of intake


    $data .= "<div class = 'currentSymptoms'>";

    $data .= PrintoutHelper::generate_title( 'header2', "BEHAVIORAL EVIDENCE") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_title( 'header3', "DANGER TO SELF/OTHERS") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Suicidal Thought/Behavior:",
        PrintoutHelper::getRating($patient_data['symptoms_suicidal_thought_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_suicidal_thought_text']);

    $data .= PrintoutHelper::generate_line_title_val("Homicidal Thought/Behavior:",
        PrintoutHelper::getRating($patient_data['symptoms_homicidal_thought_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_homicidal_thought_text']);

    $data .= PrintoutHelper::generate_line_title_val("Aggressiveness:",
        PrintoutHelper::getRating($patient_data['symptoms_aggressiveness_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_aggressiveness_text']);

    $data .= PrintoutHelper::generate_line_title_val("Self-Injurious Behavior::",
        PrintoutHelper::getRating($patient_data['symptoms_self_injurious_behavior_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_self_injurious_behavior_text']);


    $data .= PrintoutHelper::generate_title( 'header3', "PSYCHOSIS") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Hallucinations:",
        PrintoutHelper::getRating($patient_data['symptoms_hallucinations_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_hallucinations_text']);

    $data .= PrintoutHelper::generate_line_title_val("Delusions",
        PrintoutHelper::getRating($patient_data['symptoms_delusions_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_delusions_text']);

    $data .= PrintoutHelper::generate_line_title_val("Paranoia:",
        PrintoutHelper::getRating($patient_data['symptoms_paranoia_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_paranoia_text']);


    $data .= PrintoutHelper::generate_title( 'header3', "MOOD") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Depressed Mood",
        PrintoutHelper::getRating($patient_data['symptoms_depression_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_depression_text']);

    $data .= PrintoutHelper::generate_line_title_val("Feelings of Worthlessness",
        PrintoutHelper::getRating($patient_data['symptoms_worthlessness_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_worthlessness_text']);

    $data .= PrintoutHelper::generate_line_title_val("Manic Thought/Behavior:",
        PrintoutHelper::getRating($patient_data['symptoms_manic_thought_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_manic_thought_text']);

    $data .= PrintoutHelper::generate_line_title_val("Intense or Abrupt Moodswings",
        PrintoutHelper::getRating($patient_data['symptoms_moodswings_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_moodswings_text']);

    $data .= PrintoutHelper::generate_line_title_val("Irritability/Anger Issues:",
        PrintoutHelper::getRating($patient_data['symptoms_irritability_anger_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_irritability_anger_text']);


    $data .= PrintoutHelper::generate_title( 'header3', "ANXIETY") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Anxiety:",
        PrintoutHelper::getRating($patient_data['symptoms_anxiety_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_anxiety_text']);

    $data .= PrintoutHelper::generate_line_title_val("Phobias:",
        PrintoutHelper::getRating($patient_data['symptoms_phobias_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_phobias_text']);

    $data .= PrintoutHelper::generate_line_title_val("Obsessions/Compulsions::",
        PrintoutHelper::getRating($patient_data['symptoms_obsessions_compulsions_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_obsessions_compulsions_text']);



    $data .= PrintoutHelper::generate_title( 'header3', "PHYSICAL/COGNITIVE") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Change in Appetite:",
        PrintoutHelper::getRating($patient_data['symptoms_change_in_appetite_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_change_in_appetite_text']);

    $data .= PrintoutHelper::generate_line_title_val("Change in Energy Level:",
        PrintoutHelper::getRating($patient_data['symptoms_change_in_energy_level_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_change_in_energy_level_text']);

    $data .= PrintoutHelper::generate_line_title_val("Sleep Disturbance:",
        PrintoutHelper::getRating($patient_data['symptoms_sleep_disturbance_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_sleep_disturbance_text']);

    $data .= PrintoutHelper::generate_line_title_val("Decreased Concentration:",
        PrintoutHelper::getRating($patient_data['symptoms_decreased_concentration_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_decreased_concentration_text']);

    $data .= PrintoutHelper::generate_line_title_val("Disorganized/disorentated:",
        PrintoutHelper::getRating($patient_data['symptoms_disorganized_disoriented_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_disorganized_disoriented_text']);

    $data .= PrintoutHelper::generate_line_title_val("Learning Problem:",
        PrintoutHelper::getRating($patient_data['symptoms_learning_problem_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_learning_problem_text']);

    $data .= PrintoutHelper::generate_line_title_val("Medical Complication/Pain:",
        PrintoutHelper::getRating($patient_data['symptoms_medical_complication_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_medical_complication_text']);



    $data .= PrintoutHelper::generate_title( 'header3', "BEHAVIOR") . "<div></div><div></div>";

    $data .= PrintoutHelper::generate_line_title_val("Social Withdrawal::",
        PrintoutHelper::getRating($patient_data['symptoms_social_withdrawal_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_social_withdrawal_text']);

    $data .= PrintoutHelper::generate_line_title_val("Binges/Purges:",
        PrintoutHelper::getRating($patient_data['symptoms_binges_purges_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_binges_purges_text']);

    $data .= PrintoutHelper::generate_line_title_val("Sexual Acting Out / Promiscuity:",
        PrintoutHelper::getRating($patient_data['symptoms_sexual_acting_out_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_sexual_acting_out_text']);

    $data .= PrintoutHelper::generate_line_title_val("Distractibility/Impulsivity:",
        PrintoutHelper::getRating($patient_data['symptoms_distractibility_impulsivity_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_distractibility_impulsivity_text']);

    $data .= PrintoutHelper::generate_line_title_val("Hyperactivity:",
        PrintoutHelper::getRating($patient_data['symptoms_hyperactivity_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_hyperactivity_text']);


    $data .= PrintoutHelper::generate_line_title_val("Lying / Manipulative:",
        PrintoutHelper::getRating($patient_data['symptoms_lying_maniuplative_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_lying_maniuplative_text']);

    $data .= PrintoutHelper::generate_line_title_val("Oppositional Behavior:",
        PrintoutHelper::getRating($patient_data['symptoms_oppositional_behavior_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_oppositional_behavior_text']);

    $data .= PrintoutHelper::generate_line_title_val("Running Away:",
        PrintoutHelper::getRating($patient_data['symptoms_running_away_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_running_away_text']);

    $data .= PrintoutHelper::generate_line_title_val("Truancy/Absenteeism:",
        PrintoutHelper::getRating($patient_data['symptoms_truancy_absenteeism_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_truancy_absenteeism_text']);

    $data .= PrintoutHelper::generate_line_title_val("Property Destruction:",
        PrintoutHelper::getRating($patient_data['symptoms_property_destruction_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_property_destruction_text']);

    $data .= PrintoutHelper::generate_line_title_val("Fire Setting::",
        PrintoutHelper::getRating($patient_data['symptoms_fire_setting_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_fire_setting_text']);

    $data .= PrintoutHelper::generate_line_title_val("Cruelty to Animals:",
        PrintoutHelper::getRating($patient_data['symptoms_cruelty_to_animals_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_cruelty_to_animals_text']);

    $data .= PrintoutHelper::generate_line_title_val("Stealing:",
        PrintoutHelper::getRating($patient_data['symptoms_stealing_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_stealing_text']);


    $data .= PrintoutHelper::generate_title( 'header3', "ADDICTIVE BEHAVIORS") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Gambling:",
        PrintoutHelper::getRating($patient_data['symptoms_gambling_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_gambling_text']);

    $data .= PrintoutHelper::generate_line_title_val("Internet:",
        PrintoutHelper::getRating($patient_data['symptoms_internet_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_internet_text']);

    $data .= PrintoutHelper::generate_line_title_val("Gaming:",
        PrintoutHelper::getRating($patient_data['symptoms_gaming_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_gaming_text']);

    $data .= PrintoutHelper::generate_line_title_val("Other Issues:",
        PrintoutHelper::getRating($patient_data['symptoms_behavioral_other_issues_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_behavioral_other_issues_text']);


    $data .= PrintoutHelper::generate_title( 'header3', "OTHER ISSUES") . "<div></div><div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Other",
        PrintoutHelper::getRating($patient_data['symptoms_other1_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other1_text']);

    $data .= PrintoutHelper::generate_line_title_val("Other:",
        PrintoutHelper::getRating($patient_data['symptoms_other2_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other2_text']);

    $data .= PrintoutHelper::generate_line_title_val("Other:",
        PrintoutHelper::getRating($patient_data['symptoms_other3_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other3_text']);



    $data .= "</div>"; //end of current symptoms

    $data .= "<div class = 'substanceUse'>";
    $data .= PrintoutHelper::generate_title( 'header2', "Alcohol/Drug Use History") . "<div></div>";
    $data .= PrintoutHelper::generate_title( 'header3', "Substance Use") . "<div></div>";
    $data .= PrintoutHelper::displayDrugUse($patient_data['substance_use']);
    $data .= PrintoutHelper::generate_line_title_val("Comments:",
        PrintoutHelper::generate_value('oneToThree',$patient_data['substance_use_general_comments']));

    $data .= PrintoutHelper::generate_title( 'header4', "Client Acknowledgement") ;
    $data .= PrintoutHelper::generate_value('twoToThree', Printouthelper::displayList($patient_data['substance_use_client_acknowledgment']));

    $data .= PrintoutHelper::generate_title( 'header4', "Supportive Recovery Environment") ;
    $data .= PrintoutHelper::displayList($patient_data['substance_use_supportive_environment']);

    $data .= PrintoutHelper::generate_title( ' header4',"History of Prior Substance Use Treatment:");
    $data .= PrintoutHelper::generate_value('',  $patient_data['substance_use_prior_treatment']);

    $data .= "</div>"; //substanceUse



    $data .= "<div class = 'legalHistory '>";
    $data .= PrintoutHelper::generate_title( 'header2', "Legal History") . "<div></div>";
    $data .= PrintoutHelper::generate_title('header4',"Legal Comments:");
    $data .= PrintoutHelper::generate_value('',  $patient_data['legal_comments']);

    $data .= "</div>"; //legalHist

    $data .= "<div class = 'mentalHealth'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "MH Treatment Hist") . " .
 <div></div> <div></div> <div></div>";
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Previous Treatment") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Location") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Dates") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "# in last 12 months") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Total") ;

    $data .= PrintoutHelper::generate_value('header4', "InPatient Hospitalizations" );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_inpatient_hospitalizations_location'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_inpatient_hospitalizations_dates'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_inpatient_hospitalizations_last_year'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_inpatient_hospitalizations_total_num'] );

    $data .= PrintoutHelper::generate_value('header4', "ER/Crisis MH Involvement" );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_er_crisis_involvement_location'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_er_crisis_involvement_dates'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_er_crisis_involvement_last_year'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_er_crisis_involvement_total_num'] );

    $data .= PrintoutHelper::generate_value('header4', "Outpatient Therapy" );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_outpatient_therapy_location'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_outpatient_therapy_dates'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_outpatient_therapy_last_year'] );
    $data .= PrintoutHelper::generate_value('', $patient_data['mh_outpatient_therapy_total_num'] );

    $data .= PrintoutHelper::generate_value('header4 comments', "Comments" );
    $data .= PrintoutHelper::generate_value('comments', $patient_data['mh_comments'] );

    $currentlySeeing = explode('|', $patient_data['mh_currently_seeing']  );
    $data .= PrintoutHelper::generate_value('header3', "Currently Seeing" ) .
        '<div></div><div></div><div></div><div></div>';
    $data .= PrintoutHelper::generate_value('header4', "Current Psych" );
    $data .= PrintoutHelper::generate_value('twoToSixText', explode(':', $currentlySeeing[0])[1]);
    $data .= PrintoutHelper::generate_value('header4', "Other MH Provider" );
    $data .= PrintoutHelper::generate_value('comments', explode(':', $currentlySeeing[1])[1]);
    $data .= "</div>"; //mentalHealth

    $data .= "<div class = 'medicalHistory'>";//5 columns
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle oneToSixText', "Medical History");
    $data .= PrintoutHelper::generate_value('header4 comments', "Significant History/problems:" );
    $data .= PrintoutHelper::generate_value('comments', $patient_data['med_hist_comments'] );

    $data .= PrintoutHelper::generate_value('header4', "Routine Medical Care:" );
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_routine_medical_care']);
    $data .= PrintoutHelper::generate_value('header4', "Allergies:" );
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_allergies']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_allergies_comments']);

    $data .= PrintoutHelper::generate_value('header4', "Last seen by PCP:" );
    $data .= PrintoutHelper::generate_value('twoToSixText', $patient_data['med_hist_date']);

    $data .= PrintoutHelper::generate_value('header4', "If Female, Pregnant?" );
    $data .= PrintoutHelper::generate_value('twoToSixText', $patient_data['med_hist_pregnant']);
    $data .= PrintoutHelper::generate_value('header4', "Comments" );
    $data .= PrintoutHelper::generate_value('twoToSixText', $patient_data['med_hist_pregnant_comments']);

    $data .= "</div>"; //medicalHistory

    $data .= "<div class = 'currentMedications'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Medication History")  .  "<div></div><div></div> <div></div> <div></div>";
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Medication") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Doseage") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Frequency") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Date Started") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Side Effects (if any)") ;

    $data .= PrintoutHelper::generate_value('', $patient_data['medication_name_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_dosage_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_freq_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_date_started_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_side_effects_1']);

    $data .= PrintoutHelper::generate_value('', $patient_data['medication_name_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_dosage_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_freq_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_date_started_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_side_effects_2']);

    $data .= PrintoutHelper::generate_value('', $patient_data['medication_name_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_dosage_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_freq_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_date_started_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_side_effects_3']);

    $data .= PrintoutHelper::generate_value('', $patient_data['medication_name_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_dosage_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_freq_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_date_started_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_side_effects_4']);

    $data .= PrintoutHelper::generate_value('', $patient_data['medication_name_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_dosage_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_freq_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_date_started_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_side_effects_5']);

    $data .= PrintoutHelper::generate_value('', $patient_data['medication_name_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_dosage_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_freq_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_date_started_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['medication_side_effects_6']);

    $data .= PrintoutHelper::generate_title( 'header4 ', "Med Info from") ;
    $data .= PrintoutHelper::generate_value('comments', PrintoutHelper::displayList($patient_data['medication_info_from']));
    $data .= "<div></div><div></div><div></div>";

    $data .= "</div>"; //currentMedications

    $data .= "<div class = 'mentalstatus'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Mental Status Exam")  .  "<div></div>";

    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "General Appearance") . "<div></div>" ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Physical Stature") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_physical_stature']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Hygiene") ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_hygiene']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Apparent Age") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_apparent_age']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Dress") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_dress_appearance']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Posture") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_posture_appearance']));


    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle', "Activity") . "<div></div>" ;
       $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Consciousness") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_consciousness_activity']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Motor Activity") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_motor_activity']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Eye Contact") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_eye_contact']));

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Attitude")  ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_attitude'])); //todo: genCheckbox

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToThreeText', "Speech") ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Production") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_speech_production']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Tone") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_speech_tone']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Rate") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_speech_rate']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Other") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_speech_other']));

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToThreeText', "Mood") ;
    $data .= PrintoutHelper::generate_value('oneToThreeText', PrintoutHelper::displayList($patient_data['mental_status_mood'])); //todo: genCheckbox

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToThreeText', "Affect") ;
    $data .= PrintoutHelper::generate_value('oneToThreeText',PrintoutHelper::displayList( $patient_data['mental_status_affect'])); //todo: genCheckbox

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToThreeText', "Thought Process") ;
    $data .= PrintoutHelper::generate_value('oneToThreeText', PrintoutHelper::displayList($patient_data['mental_status_thought_process'])); //todo: genCheckbox

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToThreeText', "Perpetual Distortions")  ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Hallucinations") . "" ;
    $data .= PrintoutHelper::generate_value('',PrintoutHelper::displayList( $patient_data['mental_status_hallucinations']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Other Perpetual Distortions") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_other_distortions']));


    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle', "Abnormal Thoughts") . "<div></div>" ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Abnormal Thoughts / Delusions") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_delusions']));

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Other Abnormal Thoughts") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_abnormal_other']));

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle', "Executive Functioning") . "<div></div>" ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Orientation ") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_orientation']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Intelligence") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_intelligence']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Abstraction") . "" ;
    $data .= PrintoutHelper::generate_value('',PrintoutHelper::displayList( $patient_data['mental_status_abstraction']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Insight") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_insight']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Memory Impaired") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_memory_impaired']));
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Attention Concentration Impaired") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_attention_concentration']));
 ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Judgement Impaired") . "" ;
    $data .= PrintoutHelper::generate_value('', PrintoutHelper::displayList($patient_data['mental_status_judgment_impaired']));
    $data .= "</div>"; //mentalStatus

    $data .= "<div class = 'familyAndSocial'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Family and Social History")  .  "<div></div><div></div> <div></div> ";
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Name of Signifigant family/relationships") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Relation to Client") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Age") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Live with you?") ;

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_1']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_1']);

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_2']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_2']);

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_3']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_3']);

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_4']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_4']);

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_5']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_5']);

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_6']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_6']);

    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_name_7']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_relation_7']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_age_7']);
    $data .= PrintoutHelper::generate_value('', $patient_data['family_social_history_cohabitate_7']);


    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToFiveText', "Social History")  ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle oneToFiveText', "Include aspects of family history, relationships with others/family, history of significant relationships/marriages. ") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['family_social_history_comments']);

    $data .= PrintoutHelper::generate_title( 'header2 mhheadertitle oneToFiveText', "Trauma History:")  ;
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle oneToFiveText', "Include history of any phycial abuse, sexual abuse, domestic violence, other trauma. ") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['family_social_history_trauma']);


    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle oneToFiveText', "Previous Mental Health/Substance Abuse problems for Family: ") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['family_social_history_mh_sa_comments']);


    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle oneToFiveText', "Are there cultural, ethnic, or family issues that are causing you problems or might affect your treatment? If yes, please explain. ") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['family_social_history_cultural_ethnic']);

    $data .= "</div>"; //familyAndSocial

    $data .= "<div class = 'developmentHistory'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Developmental History");
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['dev_history_other']);
    $data .= "</div>"; //debhist

    $data .= "<div class = 'edEmpHist educationEmpHistory'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle oneToFiveText', "Educational/Employment History");
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Client currently in school?") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['education_in_school']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "If No, Highest grade completed") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['education_highest_grade']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "If yes, school:") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['education_school_attended']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Grade Level") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['education_grade_level']);

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Academic History") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['education_academic_history']);

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Learning Disabilities / IEP") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['education_learning_disabilities']);

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Employment / Extracirricular Activities") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['education_employment_hobbies']);

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Employment hours per week:") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['education_employment_hours_per_week']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Employment Type:") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['education_employment_type']);

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Coworker Peer Relations") . "" ;
    $data .= PrintoutHelper::generate_value('comments', $patient_data['education_employment_peer_relations']);

    $data .= "</div>"; //mentalStatus

    $data .= "<div class = 'holisticNeeds'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle oneToThreeText', "Holistic Needs Assessment");
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Skills/Ability") . "" ;
    $holisticNeeds = PrintoutHelper::displayList($patient_data['needs_assessment_skills_ability']);
    $data .= PrintoutHelper::generate_value('twoThruFiveText', PrintoutHelper::getHolsticNeeds($holisticNeeds, 'NeedAsssessment'));

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle ', "Resource Needs") . "" ;
    $data .= PrintoutHelper::generate_value('twoThruFiveText', PrintoutHelper::displayList($patient_data['needs_resources']));

    $data .= "</div>"; //mentalStatu

    $data .= "<div class = 'interpetive'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle oneToThreeText', "Interpretive Summary: (rationale for diagnoses; please include diagnostic criteria and contextual factors that justify all diagnoses generated)");
    $data .= PrintoutHelper::generate_value('oneToThreeText', $patient_data['assessment_presenting_problem']);

    $data .= PrintoutHelper::generate_title( 'header3 mhtitle oneToThreeText', "Diagnosis");
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_diagnosis_1']);
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_diagnosis_2']);
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_diagnosis_3']);
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_diagnosis_4']);
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_diagnosis_5']);


    $data .= PrintoutHelper::generate_title( 'header3 mhtitle oneToThreeText', "Factors affecting treatment and recovery");
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_factors_comments']);

    $data .= PrintoutHelper::generate_title( 'header3 mhtitle oneToThreeText', "Clients assess attitude towards treatment");
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_client_attitude']);

    $data .= PrintoutHelper::generate_title( 'header3 mhtitle oneToThreeText', "Recommended treatment modalities");
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_recommended_treatment_modalities']);

    $data .= PrintoutHelper::generate_title( 'header3 mhtitle oneToThreeText', "Treatment Recommendations");
    $data .= PrintoutHelper::generate_value('twoThruThreeText', $patient_data['assessment_recommended_treatment_comments']);


    $data .= "</div>"; //mentalStatu
    $data .= "</div>"; //hccontainer
    echo $htmlcss.$data;
}


