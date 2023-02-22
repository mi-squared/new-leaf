<?php

/*
 * this file's contents are included in both the encounter page as a 'quick summary' of a form, and in the medical records' reports page.
 */

/* for $GLOBALS[], ?? */
require_once(dirname(__FILE__).'/../../globals.php');
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_display_field() */
require_once($GLOBALS['srcdir'].'/options.inc.php');
include_once("$srcdir/classes/PrintoutHelper.class.php");

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
            grid-template-columns: repeat(1, 1000px);
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
        }

        .header3 {
            font-size: 14px;
            font-weight:bold;
            text-decoration: underline;
            margin-top: 7px;
        }

        .header4 {
            font-size: 14px;
            font-weight:bold;
            margin-top: 7px;
        }

        .title{
            margin-top: 15px;
        }

         .intake {
            display: grid;
            grid-template-columns: 300px 600px;
            grid-template-rows: auto;
            row-gap:1ch;
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
        }

        .substanceUse{
            display: grid;
            grid-template-columns: 300px 800px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
        }

           .oneLineGrid{
            display: grid;
            grid-template-columns: 200px 800px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
        }

        .mentalHealth{
            display: grid;
            grid-template-columns: 300px 200px 200px 150px 200px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin: 3ch 0 0 0;
        }

        .mentalHealthInput{
            grid-column: 2/6;
        }

         .interpetive{
            display: grid;
            grid-template-columns: 200px 200px 200px 200px 200px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin-bottom: 12ch;
        }

        .medicalHistory{
            display: grid;
            grid-template-columns: 300px 200px 200px 200px 200px;
            grid-template-rows: auto;
            row-gap:1ch;
            margin-top:3ch;
        }
        .mentalstatus{
            display: grid;
            grid-template-columns: 200px 200px ;
            grid-template-rows: auto;
            row-gap:1ch;
            margin-top:3ch;
        }

        .currentMedications{
            display: grid;
            grid-template-columns: 190px 300px 300px 200px 300px;
            grid-template-rows: auto;
            row-gap:1ch;

            margin-top:3ch;
        }


}

    </style>

    ";

    $data = "<div class = 'hcontainer'>";
    $data .= "<div class = 'intake'>";
    $data .= PrintoutHelper::generate_title( 'header', "Intake Exam") . "<div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Date of Intake Exam",  $patient_data['date']);

    $data .= PrintoutHelper::generate_title( 'header2', "Presenting Issue/Cheif Complaint") . "<div></div>";
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
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other1_rating']);

    $data .= PrintoutHelper::generate_line_title_val("Other:",
        PrintoutHelper::getRating($patient_data['symptoms_other2_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other2_text']);

    $data .= PrintoutHelper::generate_line_title_val("Other:",
        PrintoutHelper::getRating($patient_data['symptoms_other3_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other3_text']);
    $data .= PrintoutHelper::generate_line_title_val("Other:",
        PrintoutHelper::getRating($patient_data['symptoms_other4_rating']));
    $data .= PrintoutHelper::formatNoteField($patient_data['symptoms_other4_text']);


    $data .= "</div>"; //end of current symptoms

    $data .= "<div class = 'substanceUse'>";
    $data .= PrintoutHelper::generate_title( 'header2', "Alcohol/Drug Use History") . "<div></div>";
    $data .= PrintoutHelper::generate_title( 'header3', "Substance Use") . "<div></div>";
    $data .= PrintoutHelper::displayDrugUse($patient_data['substance_use']);
    $data .= PrintoutHelper::generate_line_title_val("Comments:",
        PrintoutHelper::getRating($patient_data['substance_use_general_comments']));
    $data .= PrintoutHelper::generate_title( 'header3', "Client Ack") . "<div></div>";
    $data .= PrintoutHelper::displayDrugUse($patient_data['substance_use_client_acknowledgment']);
    $data .= PrintoutHelper::generate_title( 'header3', "Supportive Recovery Environment") . "<div></div>";
    $data .= PrintoutHelper::displayDrugUse($patient_data['substance_use_supportive_environment']);
    $data .= PrintoutHelper::generate_line_title_val("History of Prior Substance Use Treatment:",
        $patient_data['substance_use_prior_treatment']);
    $data .= "</div>"; //substanceUse
    $data .= "</div>"; //hccontainer


    $data .= "<div class = 'legalHistory oneLineGrid'>";
    $data .= PrintoutHelper::generate_title( 'header2', "Legal History") . "<div></div>";
    $data .= PrintoutHelper::generate_line_title_val("Legal Comments:",
        $patient_data['legal_comments']);
    $data .= "</div>"; //legalHist

    $data .= "<div class = 'mentalHealth'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "MH Treatment Hist") . " .
 <div></div> <div></div> <div></div>";
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Previous Treat") ;
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

    $data .= PrintoutHelper::generate_value('header4', "Comments" );
    $data .= PrintoutHelper::generate_value('mentalHealthInput', $patient_data['mh_comments'] );

    $currentlySeeing = explode('|', $patient_data['mh_currently_seeing']  );
    $data .= PrintoutHelper::generate_value('header3', "Currently Seeing" ) .
        '<div></div><div></div><div></div><div></div>';
    $data .= PrintoutHelper::generate_value('header4', "Current Psych" );
    $data .= PrintoutHelper::generate_value('mentalHealthInput', explode(':', $currentlySeeing[0])[1]);
    $data .= PrintoutHelper::generate_value('header4', "Other MH Provider" );
    $data .= PrintoutHelper::generate_value('mentalHealthInput', explode(':', $currentlySeeing[1])[1]);
    $data .= "</div>"; //mentalHealth

    $data .= "<div class = 'medicalHistory'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Medical History")  .  "<div></div><div></div> <div></div> <div></div>";
    $data .= PrintoutHelper::generate_value('header4', "Significant History/problems:" );
    $data .= PrintoutHelper::generate_value('mentalHealthInput', $patient_data['med_hist_comments']);

    $data .= PrintoutHelper::generate_value('header4', "Routine Medical Care:" );
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_routine_medical_care']);
    $data .= PrintoutHelper::generate_value('header4', "Allergies:" );
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_allergies']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_allergies_comments']);

    $data .= PrintoutHelper::generate_value('header4', "Last seen by PCP:" );
    $data .= PrintoutHelper::generate_value('mentalHealthInput', $patient_data['med_hist_date']);

    $data .= PrintoutHelper::generate_value('header4', "If Female, Pregnant?" );
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant']);
    $data .= PrintoutHelper::generate_value('header4', "Comments" );
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);

    $data .= "</div>"; //medicalHistory

    $data .= "<div class = 'currentMedications'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Medication History")  .  "<div></div><div></div> <div></div> <div></div>";
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Medication") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Doseage") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Frequency") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Date Started") ;
    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Side Effects (if any)") ;

    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);

    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);

    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);

    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);

    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "Med Info from") ;
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= "<div></div><div></div><div></div>";

    $data .= "</div>"; //currentMedications

    $data .= "<div class = 'mentalstatus'>";
    $data .= PrintoutHelper::generate_title( 'header2 mhtitle', "Mental Status Exam")  .  "<div></div>";

    $data .= PrintoutHelper::generate_title( 'header3 mhheadertitle', "General Appearance") . "<div></div>" ;

    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Physical Stature") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Hygiene") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Apparent Age") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Dress") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);
    $data .= PrintoutHelper::generate_title( 'header4 mhheadertitle', "Posture") . "" ;
    $data .= PrintoutHelper::generate_value('', $patient_data['med_hist_pregnant_comments']);



    $data .= "</div>"; //mentalStatus

    $data .= "<div class = 'familyAndSocial'>";
    $data .= "</div>"; //mentalStatus

    $data .= "<div class = 'developmentHistory'>";
    $data .= "</div>"; //mentalStatus

    $data .= "<div class = 'educationEmpHistory'>";
    $data .= "</div>"; //mentalStatus

    $data .= "<div class = 'holisticNeeds'>";
    $data .= "</div>"; //mentalStatu

    $data .= "<div class = 'interpetive'>";
    $data .= "</div>"; //mentalStatu
    echo $htmlcss.$data;
}


