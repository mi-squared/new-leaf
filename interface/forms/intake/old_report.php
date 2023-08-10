<?php

/*
 * this file's contents are included in both the encounter page as a 'quick summary' of a form, and in the medical records' reports page.
 */

/* for $GLOBALS[], ?? */
require_once(dirname(__FILE__).'/../../globals.php');
require_once($GLOBALS['srcdir'].'/api.inc');
/* for generate_display_field() */
require_once($GLOBALS['srcdir'].'/options.inc.php');

use OpenEMR\Common\Acl\AclMain;

/* The name of the function is significant and must match the folder name */
function intake_report( $pid, $encounter, $cols, $id) {
    $count = 0;
/** CHANGE THIS - name of the database table associated with this form **/
$table_name = 'form_intake';

require_once('array.php');

/* an array of all of the fields' names and their types. */
$field_names = array('presenting_issue' => 'textarea','symptoms_suicidal_thought_rating' => 'dropdown_list','symptoms_suicidal_thought_text' => 'textfield','symptoms_homicidal_thought_rating' => 'dropdown_list','symptoms_homicidal_thought_text' => 'textfield','symptoms_aggressiveness_rating' => 'dropdown_list','symptoms_aggressiveness_text' => 'textfield','symptoms_self_injurious_behavior_rating' => 'dropdown_list','symptoms_self_injurious_behavior_text' => 'textfield','symptoms_sexual_trauma_perpetrator_rating' => 'dropdown_list','symptoms_sexual_trauma_perpetrator_text' => 'textfield','symptoms_hallucinations_rating' => 'dropdown_list','symptoms_hallucinations_text' => 'textfield','symptoms_delusions_rating' => 'dropdown_list','symptoms_delusions_text' => 'textfield','symptoms_paranoia_rating' => 'dropdown_list','symptoms_paranoia_text' => 'textfield','symptoms_depression_rating' => 'dropdown_list','symptoms_depression_text' => 'textfield','symptoms_worthlessness_rating' => 'dropdown_list','symptoms_worthlessness_text' => 'textfield','symptoms_manic_thought_rating' => 'dropdown_list','symptoms_manic_thought_text' => 'textfield','symptoms_moodswings_rating' => 'dropdown_list','symptoms_moodswings_text' => 'textfield','symptoms_irritability_anger_rating' => 'dropdown_list','symptoms_irritability_anger_text' => 'textfield','symptoms_anxiety_rating' => 'dropdown_list','symptoms_anxiety_text' => 'textfield','symptoms_phobias_rating' => 'dropdown_list','symptoms_phobias_text' => 'textfield','symptoms_obsessions_compulsions_rating' => 'dropdown_list','symptoms_obsessions_compulsions_text' => 'textfield','symptoms_change_in_appetite_rating' => 'dropdown_list','symptoms_change_in_appetite_text' => 'textfield','symptoms_change_in_energy_level_rating' => 'dropdown_list','symptoms_change_in_energy_level_text' => 'textfield','symptoms_sleep_disturbance_rating' => 'dropdown_list','symptoms_sleep_disturbance_text' => 'textfield','symptoms_decreased_concentration_rating' => 'dropdown_list','symptoms_decreased_concentration_text' => 'textfield','symptoms_disorganized_disoriented_rating' => 'dropdown_list','symptoms_disorganized_disoriented_text' => 'textfield','symptoms_learning_problem_rating' => 'dropdown_list','symptoms_learning_problem_text' => 'textfield','symptoms_medical_complication_rating' => 'dropdown_list','symptoms_medical_complication_text' => 'textfield','symptoms_social_withdrawal_rating' => 'dropdown_list','symptoms_social_withdrawal_text' => 'textfield','symptoms_binges_purges_rating' => 'dropdown_list','symptoms_binges_purges_text' => 'textfield','symptoms_sexual_acting_out_rating' => 'dropdown_list','symptoms_sexual_acting_out_text' => 'textfield','symptoms_distractibility_impulsivity_rating' => 'dropdown_list','symptoms_distractibility_impulsivity_text' => 'textfield','symptoms_hyperactivity_rating' => 'dropdown_list','symptoms_hyperactivity_text' => 'textfield','symptoms_lying_maniuplative_rating' => 'dropdown_list','symptoms_lying_maniuplative_text' => 'textfield','symptoms_oppositional_behavior_rating' => 'dropdown_list','symptoms_oppositional_behavior_text' => 'textfield','symptoms_running_away_rating' => 'dropdown_list','symptoms_running_away_text' => 'textfield','symptoms_truancy_absenteeism_rating' => 'dropdown_list','symptoms_truancy_absenteeism_text' => 'textfield','symptoms_property_destruction_rating' => 'dropdown_list','symptoms_property_destruction_text' => 'textfield','symptoms_fire_setting_rating' => 'dropdown_list','symptoms_fire_setting_text' => 'textfield','symptoms_cruelty_to_animals_rating' => 'dropdown_list','symptoms_cruelty_to_animals_text' => 'textfield','symptoms_stealing_rating' => 'dropdown_list','symptoms_stealing_text' => 'textfield','symptoms_behavioral_other_issues_rating' => 'dropdown_list','symptoms_behavioral_other_issues_text' => 'textfield','substance_use' => 'checkbox_combo_list','substance_use_general_comments' => 'textbox','substance_use_client_acknowledgment' => 'checkbox_list','substance_use_supportive_environment' => 'checkbox_list','legal_probation' => 'dropdown_list','legal_parole' => 'dropdown_list','legal_court_dates' => 'date','legal_previous_arrests' => 'textfield','legal_officer' => 'textfield','legal_comments' => 'textbox','mh_inpatient_hospitalizations_location' => 'textfield','mh_inpatient_hospitalizations_dates' => 'date','mh_inpatient_hospitalizations_last_year' => 'textfield','mh_inpatient_hospitalizations_total_num' => 'textfield','mh_er_crisis_involvement_location' => 'textfield','mh_er_crisis_involvement_dates' => 'date','mh_er_crisis_involvement_last_year' => 'textfield','mh_er_crisis_involvement_total_num' => 'textfield','mh_outpatient_therapy_location' => 'textfield','mh_outpatient_therapy_dates' => 'date','mh_outpatient_therapy_last_year' => 'textfield','mh_outpatient_therapy_total_num' => 'textfield','mh_comments' => 'textbox','mh_currently_seeing' => 'checkbox_combo_list','med_hist_comments' => 'textbox','med_hist_routine_medical_care' => 'dropdown_list','med_hist_allergies' => 'dropdown_list','med_hist_allergies_comments' => 'textfield','med_hist_date' => 'date','med_hist_pregnant' => 'dropdown_list','med_hist_pregnant_comments' => 'textfield','medication_name_1' => 'textfield','medication_dosage_1' => 'textfield','medication_freq_1' => 'textfield','medication_date_started_1' => 'date','medication_side_effects_1' => 'textfield','medication_name_2' => 'textfield','medication_dosage_2' => 'textfield','medication_freq_2' => 'textfield','medication_date_started_2' => 'date','medication_side_effects_2' => 'textfield','medication_name_3' => 'textfield','medication_dosage_3' => 'textfield','medication_freq_3' => 'textfield','medication_date_started_3' => 'date','medication_side_effects_3' => 'textfield','medication_name_4' => 'textfield','medication_dosage_4' => 'textfield','medication_freq_4' => 'textfield','medication_date_started_4' => 'date','medication_side_effects_4' => 'textfield','medication_name_5' => 'textfield','medication_dosage_5' => 'textfield','medication_freq_5' => 'textfield','medication_date_started_5' => 'date','medication_side_effects_5' => 'textfield','medication_name_6' => 'textfield','medication_dosage_6' => 'textfield','medication_freq_6' => 'textfield','medication_date_started_6' => 'date','medication_side_effects_6' => 'textfield','medication_info_from' => 'checkbox_list','medication_effectiveness' => 'textbox','mental_status_physical_stature' => 'checkbox_list','mental_status_hygiene' => 'checkbox_list','mental_status_apparent_age' => 'checkbox_list','mental_status_dress_appearance' => 'checkbox_list','mental_status_posture_appearance' => 'checkbox_list','mental_status_consciousness_activity' => 'checkbox_list','mental_status_motor_activity' => 'checkbox_list','mental_status_eye_contact' => 'checkbox_list','mental_status_attitude' => 'checkbox_list','mental_status_speech_tone' => 'checkbox_list','mental_status_speech_rate' => 'checkbox_list','mental_status_speech_production' => 'checkbox_list','mental_status_speech_other' => 'checkbox_list','mental_status_mood' => 'checkbox_list','mental_status_mood_comments' => 'textfield','mental_status_affect' => 'checkbox_list','mental_status_affect_other' => 'textfield','mental_status_thought_process' => 'checkbox_list','mental_status_hallucinations' => 'checkbox_list','mental_status_other_distortions' => 'checkbox_combo_list','mental_status_delusions' => 'checkbox_list','mental_status_abnormal_other' => 'checkbox_combo_list','mental_status_orientation' => 'checkbox_list','mental_status_intelligence' => 'checkbox_list','mental_status_attention_concentration' => 'checkbox_combo_list','mental_status_memory_impaired' => 'checkbox_combo_list','mental_status_abstraction' => 'checkbox_list','mental_status_insight' => 'checkbox_list','mental_status_judgment_impaired' => 'checkbox_combo_list','family_social_history_name_1' => 'textfield','family_social_history_relation_1' => 'textfield','family_social_history_age_1' => 'textfield','family_social_history_cohabitate_1' => 'dropdown_list','family_social_history_name_2' => 'textfield','family_social_history_relation_2' => 'textfield','family_social_history_age_2' => 'textfield','family_social_history_cohabitate_2' => 'dropdown_list','family_social_history_name_3' => 'textfield','family_social_history_relation_3' => 'textfield','family_social_history_age_3' => 'textfield','family_social_history_cohabitate_3' => 'dropdown_list','family_social_history_name_4' => 'textfield','family_social_history_relation_4' => 'textfield','family_social_history_age_4' => 'textfield','family_social_history_cohabitate_4' => 'dropdown_list','family_social_history_name_5' => 'textfield','family_social_history_relation_5' => 'textfield','family_social_history_age_5' => 'textfield','family_social_history_cohabitate_5' => 'dropdown_list','family_social_history_name_6' => 'textfield','family_social_history_relation_6' => 'textfield','family_social_history_age_6' => 'textfield','family_social_history_cohabitate_6' => 'dropdown_list','family_social_history_name_7' => 'textfield','family_social_history_relation_7' => 'textfield','family_social_history_age_7' => 'textfield','family_social_history_cohabitate_7' => 'textfield','family_social_history_in_relationship' => 'dropdown_list','family_social_history_previous_relationships' => 'dropdown_list','family_social_history_comments' => 'textarea','family_social_history_trauma' => 'textarea','family_social_history_mh_sa_comments' => 'textbox','family_social_history_cultural_ethnic' => 'textbox','dev_history_applicable' => 'checkbox_list','dev_history_fetal_development' => 'checkbox_combo_list','dev_history_delivery_complications' => 'checkbox_combo_list','dev_history_milestones' => 'dropdown_list','dev_history_sat_alone' => 'textfield','dev_history_first_word' => 'textfield','dev_history_bladder_training' => 'textfield','dev_history_nighttime_dryness' => 'textfield','dev_history_first_sentence' => 'textfield','dev_history_walked' => 'textfield','dev_history_bowel_training' => 'textfield','dev_history_other' => 'textarea','education_in_school' => 'dropdown_list','education_highest_grade' => 'textfield','education_school_attended' => 'textfield','education_grade_level' => 'textfield','education_academic_history' => 'textarea','education_learning_disabilities' => 'dropdown_list','education_employment_hobbies' => 'textarea','education_employment_hours_per_week' => 'dropdown_list','education_employment_type' => 'checkbox_list','education_employment_peer_relations' => 'textarea','needs_assessment_skills_ability' => 'checkbox_list','needs_resources' => 'checkbox_list','assessment_presenting_problem' => 'textarea','assessment_client_attitude' => 'dropdown_list','assessment_diagnosis_1' => 'textfield','assessment_diagnosis_1_comments' => 'textfield','assessment_diagnosis_2' => 'textfield','assessment_diagnosis_2_comments' => 'textfield','assessment_diagnosis_3' => 'textfield','assessment_diagnosis_3_comments' => 'textfield','assessment_diagnosis_4' => 'textfield','assessment_diagnosis_4_comments' => 'textfield','assessment_diagnosis_5' => 'textfield','assessment_diagnosis_5_comments' => 'textfield','assessment_family_housing' => 'textfield','assessment_family_housing_z_code' => 'textfield','assessment_educational_work' => 'textfield','assessment_educational_z_code' => 'textfield','assessment_economic_legal' => 'textfield','assessment_economic_legal_z_code' => 'textfield','assessment_cultural_environmental' => 'textfield','assessment_cultural_environmental_z_code' => 'textfield','assessment_personal' => 'textfield','assessment_personal_z_code' => 'textfield','assessment_gaf' => 'textfield','assessment_disability_assessment_schedule' => 'textfield','assessment_factors_comments' => 'textarea','assessment_recommended_treatment_modalities' => 'checkbox_list','assessment_recommended_treatment_other' => 'textarea','assessment_recommended_treatment_comments' => 'textarea');/* in order to use the layout engine's draw functions, we need a fake table of layout data. */

/* an array of the lists the fields may draw on. */
$lists = array();

    $data = formFetch($table_name, $id);

    if ($data) {

        if (isset($GLOBALS['PATIENT_REPORT_ACTIVE']) && ! empty($_POST['pdf'])) { // PDF Print
            $td_style = "<td style='width:24%'><span class='bold'>";
            echo '<table style="width:775px;"><tr>';
        } elseif (isset($GLOBALS['PATIENT_REPORT_ACTIVE']) && empty($_POST['pdf'])) { // Patient report view/search and printable
            $cols = 4;
            $td_style = "<td><span class='bold'>";
            echo '<table style="width:775px;"><tr>';
        } else { // Okay an encounter view.
            $td_style = "<td><span class='bold'>";
            echo '<table border=1px width=100%><tr>';
        }


        foreach($data as $key => $value) {

            if ($key == 'id' || $key == 'pid' || $key == 'user' ||
                $key == 'groupname' || $key == 'authorized' ||
                $key == 'activity' || $key == 'date' ||
                $value == '' || $value == '0000-00-00 00:00:00' ||
                $value == 'n')
            {
                /* skip built-in fields and "blank data". */
	        continue;
            }

            /* display 'yes' instead of 'on'. */
            if ($value == 'on') {
                $value = 'yes';
            }

            /* remove the time-of-day from the 'date' fields. */
            #if ($field_names[$key] == 'date')
            // if ($value != '') {
            //   $dateparts = explode(' ', $value);
            //   $value = $dateparts[0];
            //   $dateparts1 = explode('|', $data['substance_use']);
            // }
$ratingvalue=generate_display_field( $manual_layouts[$key], $value );



            if ($key == 'presenting_issue' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Presenting Issue/Chief Complaint');
               echo '</b></td></tr><td>' .$data['presenting_issue']. '</td><tr></table>';
            }

        //DANGER TO SELF/OTHERS//
            if ($key == 'symptoms_suicidal_thought_rating')
            {
                echo '<h7><b>DANGER TO SELF/OTHERS</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Suicidal Thought/Behavior');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_suicidal_thought_text', $data))
                {
                    echo '<td>' .$data['symptoms_suicidal_thought_text']. '</td></tr>';
                }
            }


            if ($key == 'symptoms_homicidal_thought_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Homicial Thought/Behavior');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_homicidal_thought_text', $data))
                {
                    echo '<td>' .$data['symptoms_homicidal_thought_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_aggressiveness_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Aggressiveness');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_aggressiveness_text', $data))
                {
                    echo '<td>' .$data['symptoms_aggressiveness_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_self_injurious_behavior_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Self-Injurious Behavior');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_self_injurious_behavior_text', $data))
                {
                    echo '<td>' .$data['symptoms_self_injurious_behavior_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_sexual_trauma_perpetrator_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Sexual Trauma perpetrator');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_sexual_trauma_perpetrator_text', $data))
                {
                    echo '<td>' .$data['symptoms_sexual_trauma_perpetrator_text']. '</td></tr></table>';
                }
            }

        //PSYCHOSIS//

            if ($key == 'symptoms_hallucinations_rating' )
            {
                echo '<h7><b>PSYCHOSIS</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Hallucinations');
                echo '<b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_hallucinations_text', $data))
                {
                    echo '<td>' .$data['symptoms_hallucinations_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_delusions_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Delusions');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_delusions_text', $data))
                {
                    echo '<td>' .$data['symptoms_delusions_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_paranoia_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Paranoia');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_paranoia_text', $data))
                {
                    echo '<td>' .$data['symptoms_paranoia_text']. '</td></tr></table>';
                }
            }

        //MOOD//

            if ($key == 'symptoms_depression_rating' )
            {
                echo '<h7><b>MOOD</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Depressed Mood');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_depression_text', $data))
                {
                    echo '<td>' .$data['symptoms_depression_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_worthlessness_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Feelings of Worthlessness');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_worthlessness_text', $data))
                {
                    echo '<td>' .$data['symptoms_worthlessness_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_manic_thought_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Manic Thought/Behavior');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_manic_thought_text', $data))
                {
                    echo '<td>' .$data['symptoms_manic_thought_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_moodswings_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Intense or Abrupt Moodswings');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_moodswings_text', $data))
                {
                    echo '<td>' .$data['symptoms_moodswings_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_irritability_anger_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Irritability/Anger Issues');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_irritability_anger_text', $data))
                {
                    echo '<td>' .$data['symptoms_irritability_anger_text']. '</td></tr></table>';
                }
            }

    //ANXIETY//

            if ($key == 'symptoms_anxiety_rating' )
            {
                echo '<h7><b>ANXIETY</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Anxiety');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_anxiety_text', $data))
                {
                    echo '<td>' .$data['symptoms_anxiety_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_phobias_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Phobias');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_phobias_text', $data))
                {
                    echo '<td>' .$data['symptoms_phobias_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_obsessions_compulsions_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Obsessions/Compulsions');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_obsessions_compulsions_text', $data))
                {
                    echo '<td>' .$data['symptoms_obsessions_compulsions_text']. '</td></tr></table>';
                }
            }

    //PHYSICAL/COGNITIVE//
            if ($key == 'symptoms_change_in_appetite_rating' )
            {
                echo '<h7><b>PHYSICAL/COGNITIVE</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Change in Appetite');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_change_in_appetite_text', $data))
                {
                    echo '<td>' .$data['symptoms_change_in_appetite_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_change_in_energy_level_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Change in Energy Level');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_change_in_energy_level_text', $data))
                {
                    echo '<td>' .$data['symptoms_change_in_energy_level_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_sleep_disturbance_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Sleep Disturbance');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_sleep_disturbance_text', $data))
                {
                    echo '<td>' .$data['symptoms_sleep_disturbance_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_decreased_concentration_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Decreased Concentration');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_decreased_concentration_text', $data))
                {
                    echo '<td>' .$data['symptoms_decreased_concentration_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_disorganized_disoriented_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Disorganized/disoriented');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_disorganized_disoriented_text', $data))
                {
                    echo '<td>' .$data['symptoms_disorganized_disoriented_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_learning_problem_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Learning Problem');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_learning_problem_text', $data))
                {
                    echo '<td>' .$data['symptoms_learning_problem_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_medical_complication_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Medical Complication/Pain');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_medical_complication_text', $data))
                {
                    echo '<td>' .$data['symptoms_medical_complication_text']. '</td></tr></table>';
                }
            }

    ////BEHAVIOUR/////
            if ($key == 'symptoms_social_withdrawal_rating' )
            {
                echo '<h7><b>BEHAVIOUR</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Social Withdrawal');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_social_withdrawal_text', $data))
                {
                    echo '<td>' .$data['symptoms_social_withdrawal_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_binges_purges_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Binges/Purges');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_binges_purges_text', $data))
                {
                    echo '<td>' .$data['symptoms_binges_purges_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_sexual_acting_out_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Sexual Acting Out / Promiscuity');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_sexual_acting_out_text', $data))
                {
                    echo '<td>' .$data['symptoms_sexual_acting_out_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_distractibility_impulsivity_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Distractibility/Impulsivity');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_distractibility_impulsivity_text', $data))
                {
                    echo '<td>' .$data['symptoms_distractibility_impulsivity_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_hyperactivity_rating' )
            {

                echo '<tr><td><b>';
                echo xl_layout_label('Hyperactivity');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_hyperactivity_text', $data))
                {
                    echo '<td>' .$data['symptoms_hyperactivity_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_lying_maniuplative_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Lying/Manipulative');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_lying_maniuplative_text', $data))
                {
                    echo '<td>' .$data['symptoms_lying_maniuplative_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_oppositional_behavior_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Oppositional Behavior');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_oppositional_behavior_text', $data))
                {
                    echo '<td>' .$data['symptoms_oppositional_behavior_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_running_away_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Running Away');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_running_away_text', $data))
                {
                    echo '<td>' .$data['symptoms_running_away_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_truancy_absenteeism_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Truancy/Absenteeism');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_truancy_absenteeism_text', $data))
                {
                    echo '<td>' .$data['symptoms_truancy_absenteeism_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_property_destruction_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Property Destruction');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_property_destruction_text', $data))
                {
                    echo '<td>' .$data['symptoms_property_destruction_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_fire_setting_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Fire Setting');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_fire_setting_text', $data))
                {
                    echo '<td>' .$data['symptoms_fire_setting_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_cruelty_to_animals_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Cruelty to Animals');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_cruelty_to_animals_text', $data))
                {
                    echo '<td>' .$data['symptoms_cruelty_to_animals_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_stealing_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Stealing');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_stealing_text', $data))
                {
                    echo '<td>' .$data['symptoms_stealing_text']. '</td></tr></table>';
                }
            }

    //ADDICTIVE BEHAVIORS////
            if ($key == 'symptoms_gambling_rating' )
            {
                echo '<h7><b>ADDICTIVE BEHAVIOUR</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Gambling');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_gambling_text', $data))
                {
                    echo '<td>' .$data['symptoms_gambling_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_internet_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Internet');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_internet_text', $data))
                {
                    echo '<td>' .$data['symptoms_internet_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_gaming_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Gaming');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_gaming_text', $data))
                {
                    echo '<td>' .$data['symptoms_gaming_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_behavioral_other_issues_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Other Issues');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_behavioral_other_issues_text', $data))
                {
                    echo '<td>' .$data['symptoms_behavioral_other_issues_text']. '</td></tr></table>';
                }
            }

    //OTHER ISSUES//

            if ($key == 'symptoms_other1_rating' )
            {
                echo '<h7><b>OTHER ISSUES</b></h7>';
                echo '<table width=100% border=1><tr><td width=20%><b>';
                echo xl_layout_label('Other');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_other1_text', $data))
                {
                    echo '<td>' .$data['symptoms_other1_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_other2_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Other');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_other2_text', $data))
                {
                    echo '<td>' .$data['symptoms_other2_text']. '</td></tr>';
                }
            }

            if ($key == 'symptoms_other3_rating' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Other');
                echo '</b></td><td>' .$ratingvalue. '</td>';

                if(array_key_exists('symptoms_other3_text', $data))
                {
                    echo '<td>' .$data['symptoms_other3_text']. '</td></tr></table>';
                }
            }

    //substance_use//

            if ($key == 'substance_use' )
            {
                $dateparts1 = explode('|', $data['substance_use']);
                echo '<br>';
                foreach($dateparts1 as $key1 => $value)
                {
                    $dateparts2 = explode(':', $dateparts1[$key1]);
                    echo '<table width=100% border=1><tr><td width=20%><b>' .$dateparts2[0]. '</b></td>';
                    echo '<td>' .$dateparts2[1]. '</td></tr></table>';
                }
            }
    //Comments//
            if ($key == 'substance_use_general_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Comments');
                echo '</b></td></tr><tr><td>' .$data['substance_use_general_comments']. '</td></tr></table>';
            }

    //Client acknoledgment///
            if ($key == 'substance_use_client_acknowledgment' )
            {
                $acknowledgment = explode('|', $data['substance_use_client_acknowledgment']);
                echo '<br><table width=100% border=1><tr><td colspan=4><b>';
                echo xl_layout_label('Client Acknowledgment');
                echo '</b></td></tr><tr>';
                foreach($acknowledgment as $value)
                    echo '<td>' .$value. '</td>';
                echo '</tr></table>';
            }


    //Supportive Recovery Environment//

            if ($key == 'substance_use_supportive_environment')
            {
                $RecoveryEnvironment = explode('|', $data['substance_use_supportive_environment']);
                echo '<br><table width=100% border=1><tr><td colspan=4><b>';
                echo xl_layout_label('Supportive Recovery Environment');
                echo '</b></td></tr><tr>';
                foreach($RecoveryEnvironment as $value)
                    echo '<td>' .$value. '</td>';
                echo '</tr></table>';
            }

    /////

            // if ($key == 'legal_probation' )
            // {
            //     echo xl_layout_label('Probation').":";
            // }

            // if ($key == 'legal_parole' )
            // {
            //     echo xl_layout_label('Parole (Junvenile or Adult)').":";
            // }

            // if ($key == 'legal_court_dates' )
            // {
            //     echo xl_layout_label('Court Dates/Pending').":";
            // }

            // if ($key == 'legal_previous_arrests' )
            // {
            //     echo xl_layout_label('Number of previous Arrests/Convictions').":";
            // }

    //History of Prior Substance Absue Treatment//
            if ($key == 'substance_use_prior_treatment' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('History of Prior Substance Absue Treatment');
                echo '</b></td></tr><tr>';
                echo '<td>' .$data['substance_use_prior_treatment']. '</td></tr></table>';
            }

    //legal_comments//
            if ($key == 'legal_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Comments');
                echo '</b></td></tr><tr>';
                echo '<td>' .$data['legal_comments']. '</td></tr></table>';
            }

    //Inpatient Hospitalizations//
            if ($key == 'mh_inpatient_hospitalizations_location' )
            {
                echo '<br><table width=100% border=1><tr><td><b>Previous Treatment</b></td><td><b>Location</b></td><td><b>Dates</b></td><td><b>Number in last 12 months</b></td><td><b>Total Number</b></td></tr><tr><td>';
                echo xl_layout_label('Inpatient Hospitalizations');
                echo '</td><td>' .$data['mh_inpatient_hospitalizations_location']. '</td>';

                if(array_key_exists('mh_inpatient_hospitalizations_dates', $data))
                {
                    echo '<td>' .$data['mh_inpatient_hospitalizations_dates']. '</td>';
                }

                if(array_key_exists('mh_inpatient_hospitalizations_last_year', $data))
                {
                    echo '<td>' .$data['mh_inpatient_hospitalizations_last_year']. '</td>';
                }

                if(array_key_exists('mh_inpatient_hospitalizations_total_num', $data))
                {
                    echo '<td>' .$data['mh_inpatient_hospitalizations_total_num']. '</td></tr>';
                }
            }

    //ER/Crisis MH Involvement//

            if ($key == 'mh_er_crisis_involvement_location' )
            {
                echo '<tr><td>';
                echo xl_layout_label('ER/Crisis MH Involvement');
                echo '</td><td>' .$data['mh_er_crisis_involvement_location']. '</td>';

                if(array_key_exists('mh_er_crisis_involvement_dates', $data))
                {
                    echo '<td>' .$data['mh_er_crisis_involvement_dates']. '</td>';
                }

                if(array_key_exists('mh_er_crisis_involvement_last_year', $data))
                {
                    echo '<td>' .$data['mh_er_crisis_involvement_last_year']. '</td>';
                }

                if(array_key_exists('mh_er_crisis_involvement_total_num', $data))
                {
                    echo '<td>' .$data['mh_er_crisis_involvement_total_num']. '</td></tr>';
                }
            }

    //Outpatient Therapy//

            if ($key == 'mh_outpatient_therapy_location' )
            {
                echo '<tr><td>';
                echo xl_layout_label('Outpatient Therapy');
                echo '</td><td>' .$data['mh_outpatient_therapy_location']. '</td>';

                if(array_key_exists('mh_outpatient_therapy_dates', $data))
                {
                    echo '<td>' .$data['mh_outpatient_therapy_dates']. '</td>';
                }

                if(array_key_exists('mh_outpatient_therapy_last_year', $data))
                {
                    echo '<td>' .$data['mh_outpatient_therapy_last_year']. '</td>';
                }

                if(array_key_exists('mh_outpatient_therapy_total_num', $data))
                {
                    echo '<td>' .$data['mh_outpatient_therapy_total_num']. '</td></tr></table>';
                }
            }

    //Comments//

            if ($key == 'mh_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Comments');
                echo '</b></td></tr><tr><td>' .$data['mh_comments']. '</td></tr></table>';
            }

    //Currently seeing//

            if ($key == 'mh_currently_seeing' )
            {
                $Currentlyseeing = explode('|', $data['mh_currently_seeing']);

                echo '<br><table width=100% border=1><tr><td>';
                echo xl_layout_label('Currently seeing');
                echo '</td></tr>';
                foreach($Currentlyseeing as $key2 => $value)
                {
                    $Currentlyseeing1 = explode(':',$Currentlyseeing[$key2]);
                    echo '<tr><td>' .$Currentlyseeing1[0]. '</td>';
                    echo '<td>' .$Currentlyseeing1[0]. '</td></tr>';
                }
                echo '</table>';
            }

    //Significant History/problems///

            if ($key == 'med_hist_comments' )
            {
                echo '<br><table width=100% border=1><tr><td colspan=5><b>';
                echo xl_layout_label('Significant History/problems');
                echo '</b></td></tr><tr><td colspan=5>' .$data['med_hist_comments']. '</td></tr></table>';
            }

    //Routine medical care//

            if ($key == 'med_hist_routine_medical_care' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Routine medical care?');
                echo '</b></td><td>' .$value. '</td><td><b>';

                if(array_key_exists('med_hist_allergies', $data))
                {
                    echo xl_layout_label('Allergies?').'</b></td>';
                    echo '<td>' .$data['med_hist_allergies']. '</td>';
                }

                if(array_key_exists('med_hist_allergies_comments', $data))
                {
                    echo '<td>' .$data['med_hist_allergies_comments']. '</td></tr></table>';
                }
            }

    //Date last seen by primary care doctor//

            if ($key == 'med_hist_date' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Date last seen by primary care doctor');
                echo '</b></td><td colspan=5>' .$data['med_hist_date']. '</td></tr></table>';
            }

    //If female, currently pregnant?//

            if ($key == 'med_hist_pregnant' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('If female, currently pregnant?');
                echo '</b></td><td>' .$value. '</td>';
            }

            if ($key == 'med_hist_pregnant_comments' )
            {
                echo '<td><b>';
                echo xl_layout_label('If yes, history?');
                echo '</b></td><td colspan=5>' .$data['med_hist_pregnant_comments']. '</td></tr></table>';
            }

    //Medication #1 Name//

            if ($key == 'medication_name_1' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Medication'). '</b></td><td><b>';
                echo xl_layout_label('Dosage'). '</b></td><td><b>';
                echo xl_layout_label('Frequency'). '</b></td><td><b>';
                echo xl_layout_label('Date Started'). '</b></td><td><b>';
                echo xl_layout_label('Side Effects'). '</b></td></tr>';

                echo '<tr><td>'.$data['medication_name_1']. '</td>';
                echo '<td>' .$data['medication_dosage_1']. '</td>';
                echo '<td>' .$data['medication_freq_1']. '</td>';
                echo '<td>' .$data['medication_date_started_1']. '</td>';
                echo '<td>' .$data['medication_side_effects_1']. '</td></tr>';

                echo '<tr><td>' .$data['medication_name_2']. '</td>';
                echo '<td>' .$data['medication_dosage_2']. '</td>';
                echo '<td>' .$data['medication_freq_2']. '</td>';
                echo '<td>' .$data['medication_date_started_2']. '</td>';
                echo '<td>' .$data['medication_side_effects_2']. '</td></tr>';

                echo '<tr><td>' .$data['medication_name_3']. '</td>';
                echo '<td>' .$data['medication_dosage_3']. '</td>';
                echo '<td>' .$data['medication_freq_3']. '</td>';
                echo '<td>' .$data['medication_date_started_3']. '</td>';
                echo '<td>' .$data['medication_side_effects_3']. '</td></tr>';

                echo '<tr><td>' .$data['medication_name_4']. '</td>';
                echo '<td>' .$data['medication_dosage_4']. '</td>';
                echo '<td>' .$data['medication_freq_4']. '</td>';
                echo '<td>' .$data['medication_date_started_4']. '</td>';
                echo '<td>' .$data['medication_side_effects_4']. '</td></tr>';

                echo '<tr><td>' .$data['medication_name_5']. '</td>';
                echo '<td>' .$data['medication_dosage_5']. '</td>';
                echo '<td>' .$data['medication_freq_5']. '</td>';
                echo '<td>' .$data['medication_date_started_5']. '</td>';
                echo '<td>' .$data['medication_side_effects_5']. '</td></tr>';

                echo '<tr><td>'.$data['medication_name_6']. '</td>';
                echo '<td>' .$data['medication_dosage_6']. '</td>';
                echo '<td>' .$data['medication_freq_6']. '</td>';
                echo '<td>' .$data['medication_date_started_6']. '</td>';
                echo '<td>' .$data['medication_side_effects_6']. '</td></tr>';
            }

    //Medication information was obtained from//

            if ($key == 'medication_info_from' )
            {
                $medicationInformation = explode('|', $value);
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Medication information was obtained from'). '</b></td>';
                foreach($medicationInformation as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr>';
            }

    //Medication effectiveness//

            if ($key == 'medication_effectiveness' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Medication effectiveness');
                echo '</b></td><td colspan=4>' .$data['medication_effectiveness']. '</td></tr></table>';
            }

    //GENERAL APPEARANCE && ACTIVITY//

            if ($key == 'mental_status_physical_stature' )
            {
                $physicalStature = explode('|', $data['mental_status_physical_stature']);
                echo '<br><table width=100% border=1><tr><td colspan=5><b>GENERAL APPEARANCE</b></td><td colspan=9><b>ACTIVITY</b></td></tr><tr><td><b>';
                echo xl_layout_label('Physical Stature').'</b></td>';
                foreach($physicalStature as $value)
                {
                echo '<td>' .$value. '</td>';
                }

                if(array_key_exists('mental_status_consciousness_activity', $data))
                {
                    $Consciousness = explode('|', $data['mental_status_consciousness_activity']);
                    echo '<td><b>';
                    echo xl_layout_label('Consciousness'). '</b></td>';
                    foreach($Consciousness as $value)
                    {
                        echo '<td>' .$value. '</td>';
                    }
                }
                echo '</tr>';
            }

            if ($key == 'mental_status_hygiene' )
            {
                $Hygiene = explode('|', $data['mental_status_hygiene']);
                echo '<tr><td><b>';
                echo xl_layout_label('Hygiene'). '</b></td>';
                foreach($Hygiene as $value)
                {
                echo '<td>' .$value. '</td>';
                }

                if(array_key_exists('mental_status_motor_activity', $data))
                {
                    $motorActivity = explode('|', $data['mental_status_motor_activity']);
                    echo '<td><b>';
                    echo xl_layout_label('Motor Activity'). '</b></td>';
                    foreach($motorActivity as $value)
                    {
                        echo '<td>' .$value. '</td>';
                    }
                }
                echo '</tr>';
            }

            if ($key == 'mental_status_apparent_age' )
            {
                $apparentAge = explode('|', $data['mental_status_apparent_age']);
                echo '<tr><td><b>';
                echo xl_layout_label('Apparent Age'). '</b></td>';
                foreach($apparentAge as $value)
                {
                echo '<td>' .$value. '</td>';
                }

                if(array_key_exists('mental_status_eye_contact', $data))
                {
                    $eyeContact = explode('|', $data['mental_status_eye_contact']);
                    echo '<td><b>';
                    echo xl_layout_label('Eye Contact'). '</b></td>';
                    foreach($eyeContact as $value)
                    {
                        echo '<td>' .$value. '</td>';
                    }
                }
                echo '</tr>';
            }

            if ($key == 'mental_status_dress_appearance' )
            {
                $dress = explode('|', $data['mental_status_dress_appearance']);
                echo '<tr><td><b>';
                echo xl_layout_label('Dress'). '</b></td>';
                foreach($dress as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr>';
            }

            if ($key == 'mental_status_posture_appearance' )
            {
                $Posture = explode('|', $data['mental_status_posture_appearance']);
                echo '<tr><td><b>';
                echo xl_layout_label('Posture'). '</b></td>';
                foreach($Posture as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }
    //Attitude//

            if ($key == 'mental_status_attitude' )
            {
                $attitude = explode('|', $data['mental_status_attitude']);
                echo '<br><table width=100% border=1><tr><td colspan=18><b>';
                echo xl_layout_label('Attitude'). '</b></td></tr><tr>';
                foreach($attitude as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }

    //SPEECH//

            if ($key == 'mental_status_speech_production' )
            {
                $production = explode('|', $data['mental_status_speech_production']);
                echo '<br><table width=100% border=1><tr><td colspan=5><b>SPEECH</b></td></tr><tr><td><b>';
                echo xl_layout_label('Production'). '</b></td>';
                foreach($production as $value)
                {
                    echo '<td>' .$value. '</td>';
                }
                echo '</tr>';

                if(array_key_exists('mental_status_speech_tone', $data))
                {
                    $tone = explode('|', $data['mental_status_speech_tone']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Tone'). '</b></td>';
                    foreach($tone as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }


                if(array_key_exists('mental_status_speech_rate', $data))
                {
                    $rate = explode('|', $data['mental_status_speech_rate']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Rate'). '</b></td>';
                    foreach($rate as $value)
                    {
                        echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }

                if(array_key_exists('mental_status_speech_other', $data))
                {
                    $other = explode('|', $data['mental_status_speech_other']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Other'). '</b></td>';
                    foreach($other as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr></table>';
                }
            }


    ////Mood//
            if ($key == 'mental_status_mood' )
            {
                $mood = explode('|', $data['mental_status_mood']);
                echo '<br><table width=100% border=1><tr><td colspan=18><b>';
                echo xl_layout_label('Mood'). '</b></td></tr><tr>';
                foreach($mood as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }

    ///
            // if ($key == 'mental_status_mood_comments' )
            // {
            //     echo xl_layout_label('Mood comments').":";
            // }

    //Affect//

            if ($key == 'mental_status_affect' )
            {
                $affect = explode('|', $data['mental_status_affect']);
                echo '<br><table width=100% border=1><tr><td colspan=18><b>';
                echo xl_layout_label('Affect'). '</b></td></tr><tr>';
                foreach($affect as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }

    ///

            // if ($key == 'mental_status_affect_other' )
            // {
            //     echo xl_layout_label('Affect comments').":";
            // }

    //Thought Process//
            if ($key == 'mental_status_thought_process' )
            {
                $thoughtProcess = explode('|', $data['mental_status_thought_process']);
                echo '<br><table width=100% border=1><tr><td colspan=18><b>';
                echo xl_layout_label('Thought Process'). '</b></td></tr><tr>';
                foreach($thoughtProcess as $value)
                {
                echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }

    //PERCEPTUAl DISTORTIONS//

            if ($key == 'mental_status_hallucinations' )
            {
                $hallucinations = explode('|', $data['mental_status_hallucinations']);
                echo '<br><table width=100% border=1><tr><td colspan=7><b>PERCEPTUAl DISTORTIONS</b></td></tr><tr><td><b>';
                echo xl_layout_label('Hallucinations'). '</b></td>';
                foreach($hallucinations as $value)
                {
                    echo '<td>' .$value. '</td>';
                }
                echo '</tr>';

                if(array_key_exists('mental_status_other_distortions', $data))
                {
                    $test = generate_list_map('other_perceptual_distortions');
                    $tone = explode('|', $data['mental_status_other_distortions']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Other Perceptual Distortions'). '</b></td>';
                    foreach($tone as $value1)
                    {
                        echo '<td>' .$test[$value1]. '</td>';
                    }
                    echo '</tr></table>';
                }
            }



    //ABNORMAL THOUGHTS//

            if ($key == 'mental_status_delusions' )
            {
                $abnormalThoughts = explode('|', $data['mental_status_delusions']);
                echo '<br><table width=100% border=1><tr><td colspan=7><b>ABNORMAL THOUGHTS</b></td></tr><tr><td><b>';
                echo xl_layout_label('Abnormal Thoughts Delusions'). '</b></td>';
                foreach($abnormalThoughts as $value)
                {
                    echo '<td>' .$value. '</td>';
                }
                echo '</tr>';

                if(array_key_exists('mental_status_abnormal_other', $data))
                {
                    $test1 = generate_list_map('other_abnormal_thoughts');
                    $tone1 = explode('|', $data['mental_status_abnormal_other']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Other Abnormal Thoughts'). '</b></td>';
                    foreach($tone1 as $value2)
                    {
                        echo '<td>' .$test1[$value2]. '</td>';
                    }
                    echo '</tr></table>';
                }
            }

            if ($key == 'mental_status_orientation' )
            {
                $Orientation = explode('|', $data['mental_status_orientation']);
                echo '<br><table width=100% border=1><tr><td colspan=7><b>EXECUTIVE FUNCTIONING</b></td></tr><tr><td><b>';
                echo xl_layout_label('Orientation'). '</b></td>';
                foreach($Orientation as $value)
                {
                    echo '<td>' .$value. '</td>';
                }
                echo '</tr>';

                if(array_key_exists('mental_status_intelligence', $data))
                {
                    $Intelligence = explode('|', $data['mental_status_intelligence']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Intelligence'). '</b></td>';
                    foreach($Intelligence as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }

                if(array_key_exists('mental_status_abstraction', $data))
                {
                    $Abstraction = explode('|', $data['mental_status_abstraction']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Abstraction'). '</b></td>';
                    foreach($Abstraction as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }

                if(array_key_exists('mental_status_insight', $data))
                {
                    $Abstraction = explode('|', $data['mental_status_insight']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('insight'). '</b></td>';
                    foreach($Abstraction as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }

                if(array_key_exists('mental_status_memory_impaired', $data))
                {
                    $memoryImpaired = explode('|', $data['mental_status_memory_impaired']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Memory Impaired'). '</b></td>';
                    foreach($memoryImpaired as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }

                if(array_key_exists('mental_status_attention_concentration', $data))
                {
                    $concentrationImpaired = explode('|', $data['mental_status_attention_concentration']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Attn./Concentration Impaired'). '</b></td>';
                    foreach($concentrationImpaired as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr>';
                }

                if(array_key_exists('mental_status_judgment_impaired', $data))
                {
                    $judgment = explode('|', $data['mental_status_judgment_impaired']);
                    echo '<tr><td><b>';
                    echo xl_layout_label('Judgment Impaired').'</b></td>';
                    foreach($judgment as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr></table>';
                }
            }

    //Name of significant family/relationships//

            if ($key == 'family_social_history_name_1' )
            {
                echo '<br><table width=100% border=1><tr><td><b>Name of significant family/relationships</b></td><td><b>Relation to client</b></td><td><b>Age</b></td><td><b>Live with you?</b></td></tr>';
                echo '<tr><td>' .$data['family_social_history_name_1']. '</td>';
                echo '<td>' .$data['family_social_history_relation_1']. '</td>';
                echo '<td>' .$data['family_social_history_age_1']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_1']. '</td></tr>';

                echo '<tr><td>'.$data['family_social_history_name_2']. '</td>';
                echo '<td>' .$data['family_social_history_relation_2']. '</td>';
                echo '<td>' .$data['family_social_history_age_2']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_2']. '</td></tr>';

                echo '<tr><td>'.$data['family_social_history_name_3']. '</td>';
                echo '<td>' .$data['family_social_history_relation_3']. '</td>';
                echo '<td>' .$data['family_social_history_age_3']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_3']. '</td></tr>';

                echo '<tr><td>' .$data['family_social_history_name_4']. '</td>';
                echo '<td>' .$data['family_social_history_relation_4']. '</td>';
                echo '<td>' .$data['family_social_history_age_4']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_4']. '</td></tr>';

                echo '<tr><td>'.$data['family_social_history_name_5']. '</td>';
                echo '<td>' .$data['family_social_history_relation_5']. '</td>';
                echo '<td>' .$data['family_social_history_age_5']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_5']. '</td></tr>';

                echo '<tr><td>'.$data['family_social_history_name_6']. '</td>';
                echo '<td>' .$data['family_social_history_relation_6']. '</td>';
                echo '<td>' .$data['family_social_history_age_6']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_6']. '</td></tr>';

                echo '<tr><td>' .$data['family_social_history_name_7']. '</td>';
                echo '<td>' .$data['family_social_history_relation_7']. '</td>';
                echo '<td>' .$data['family_social_history_age_7']. '</td>';
                echo '<td>' .$data['family_social_history_cohabitate_7']. '</td></tr></table>';
            }

    ///

            // if ($key == 'family_social_history_in_relationship' )
            // {
            //     echo xl_layout_label('Are you currently in a significant relationship?').":";
            // }

            // if ($key == 'family_social_history_previous_relationships' )
            // {
            //     echo xl_layout_label('Previous Marriages/Significant Relationships?').":";
            // }

    //Social History//

            if ($key == 'family_social_history_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Social History');
                echo '</b></td></tr><tr><td>' .$data['family_social_history_comments']. '</td></tr></table>';
            }

    //Trauma History//

            if ($key == 'family_social_history_trauma' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Trauma History');
                echo '</b></td></tr><tr><td>' .$data['family_social_history_trauma']. '</td></tr></table>';
            }

    //Previous Mental Health//

            if ($key == 'family_social_history_mh_sa_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Previous Mental Health/Substance Abuse problems for Family');
                echo '</b></td></tr><tr><td>' .$data['family_social_history_mh_sa_comments']. '</td></tr></table>';
            }

    //Are there cultural, ethnic, or family issues//

            if ($key == 'family_social_history_cultural_ethnic' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Are there cultural, ethnic, or family issues that are causing you problems or might affect your treatment?');
                echo '</b></td></tr><tr><td>' .$data['family_social_history_cultural_ethnic']. '</td></tr></table>';
            }

    ///

            // if ($key == 'dev_history_applicable' )
            // {
            //     echo xl_layout_label('Developmental History?');
            // }

            // if ($key == 'dev_history_fetal_development' )
            // {
            //     echo xl_layout_label('Fetal Development: Substance exposure?').":";
            // }

            // if ($key == 'dev_history_delivery_complications' )
            // {
            //     echo xl_layout_label('Complications with delivery?').":";
            // }

            // if ($key == 'dev_history_milestones' )
            // {
            //     echo xl_layout_label('Developmental Milestones Within Normal Limits').":";
            // }

            // if ($key == 'dev_history_sat_alone' )
            // {
            //     echo xl_layout_label('Sat Alone').":";
            // }

            // if ($key == 'dev_history_first_word' )
            // {
            //     echo xl_layout_label('First Word').":";
            // }

            // if ($key == 'dev_history_bladder_training' )
            // {
            //     echo xl_layout_label('Bladder Training').":";
            // }

            // if ($key == 'dev_history_nighttime_dryness' )
            // {
            //     echo xl_layout_label('Achieved Nighttime Dryness').":";
            // }

            // if ($key == 'dev_history_first_sentence' )
            // {
            //     echo xl_layout_label('1st Sentence').":";
            // }

            // if ($key == 'dev_history_walked' )
            // {
            //     echo xl_layout_label('Walked').":";
            // }

            // if ($key == 'dev_history_bowel_training' )
            // {
            //     echo xl_layout_label('Bowel Training').":";
            // }

    //Developmental History
            if ($key == 'dev_history_other' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Developmental History?').":";
                echo '</b></td></tr><tr><td>' .$data['dev_history_other']. '</td></tr></table>';
            }

    //Client currently in school//


            if ($key == 'education_in_school' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Client currently in school?');
                echo '</b></td><td>' .$data['education_in_school']. '</td>';

                if(array_key_exists('education_highest_grade', $data))
                {
                    echo '<td><b>';
                    echo xl_layout_label('If no, highest grade completed');
                    echo '</b></td><td colspan=5>' .$data['education_highest_grade']. '</td></tr></table>';
                }


            if (array_key_exists ('education_school_attended', $data) )
             // if ($key == 'education_school_attended' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('If yes, school');
                echo '</b></td><td>' .$data['education_school_attended']. '</td>';

                if(array_key_exists('education_grade_level', $data))
                {
                    echo '<td><b>';
                    echo xl_layout_label('Grade level');
                    echo '</b></td><td colspan=5>' .$data['education_grade_level']. '</td></tr></table>';
                }
            }


        if (array_key_exists ('education_academic_history', $data) )
            // if ($key == 'education_academic_history' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Academic History');
                echo '</b></td><td colspan=7>' .$data['education_academic_history']. '</td></tr></table>';
            }

    //Learning Disabilities / IEP://

    if (array_key_exists ('education_learning_disabilities', $data) )
            // if ($key == 'education_learning_disabilities' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Learning Disabilities / IEP:');
                echo '</b></td><td colspan=7>' .$data['education_learning_disabilities']. '</td></tr>';
            }

            if (array_key_exists ('education_employment_hobbies', $data) )
            // if ($key == 'education_employment_hobbies' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Employment / Extracirricular Activities');
                echo '</b></td><td colspan=7>' .$data['education_employment_hobbies']. '</td></tr>';
            }

            if (array_key_exists ('education_employment_hours_per_week', $data) )
            // if ($key == 'education_employment_hours_per_week' )
            {
                echo '<tr><td><b>';
                echo xl_layout_label('Employment hours per week');
                echo '</b></td><td>' .$data['education_employment_hours_per_week']. '</td>';

                if(array_key_exists('education_employment_type', $data))
                {
                    $employmentType = explode('|', $data['education_employment_type']);
                    echo '<td><b>';
                    echo xl_layout_label('Employment Type');
                    echo '</td></b>';
                    foreach($employmentType as $value)
                    {
                    echo '<td>' .$value. '</td>';
                    }
                    echo '</tr></table>';
                }
            }

            if (array_key_exists ('education_employment_peer_relations', $data) )
            // if ($key == 'education_employment_peer_relations' )
            {
                echo '<table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Coworker / Peer Relations:');
                echo '</b></td><td colspan=7>' .$data['education_employment_peer_relations']. '</td></tr></table>';
            }
        }
    //Skills//

            if ($key == 'needs_assessment_skills_ability' )
            {
                $Skills = generate_list_map('NeedAsssessment');
                $tone2 = explode('|', $data['needs_assessment_skills_ability']);
                echo '<br><table width=100% border=1><tr><td colspan=14><b>';
                echo xl_layout_label('Skills/Ability Assessment');
                echo '</b></td></tr><tr>';
                foreach($tone2 as $value3)
                {
                    echo '<td>' .$Skills[$value3]. '</td>';
                }
                echo '</tr></table>';
            }

    //Resource Needs//

            if ($key == 'needs_resources' )
            {
                $Resource = explode('|', $value);
                echo '<table width=100% border=1><tr><td colspan=14><b>';
                echo xl_layout_label('Resource Needs');
                echo '</b></td></tr><tr>';
                foreach($Resource as $value)
                {
                    echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }

    //Interpretive Summary//

            if ($key == 'assessment_presenting_problem' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Interpretive Summary');
                echo '</b></td><td>' .$data['assessment_presenting_problem']. '</td><tr></table>';
            }

    //DIAGNOSIS//

            if ($key == 'assessment_diagnosis_1_comments' )
            {
                echo '<h7><b>DIAGNOSIS</b></h7>';
                echo '<table width=100% border=1><tr>';
                echo '<td>' .$data['assessment_diagnosis_1_comments']. '</td></tr>';
                echo '<tr><td>' .$data['assessment_diagnosis_2_comments']. '</td></tr>';
                echo '<tr><td>' .$data['assessment_diagnosis_3_comments']. '</td></tr>';
                echo '<tr><td>' .$data['assessment_diagnosis_4_comments']. '</td></tr>';
                echo '<tr><td>' .$data['assessment_diagnosis_5_comments']. '</td></tr></table>';
            }

    ///

            // if ($key == 'assessment_family_housing' )
            // {
            //     echo xl_layout_label('Family/Housing').":";
            // }

            // if ($key == 'assessment_family_housing_z_code' )
            // {
            //     echo xl_layout_label('hidden label').":";
            // }

            // if ($key == 'assessment_educational_work' )
            // {
            //     echo xl_layout_label('Educational/Work').":";
            // }

            // if ($key == 'assessment_educational_z_code' )
            // {
            //     echo xl_layout_label('hidden label').":";
            // }

            // if ($key == 'assessment_economic_legal' )
            // {
            //     echo xl_layout_label('Economic/Legal').":";
            // }

            // if ($key == 'assessment_economic_legal_z_code' )
            // {
            //     echo xl_layout_label('hidden label').":";
            // }

            // if ($key == 'assessment_cultural_environmental' )
            // {
            //     echo xl_layout_label('Cultural/Environmental').":";
            // }

            // if ($key == 'assessment_cultural_environmental_z_code' )
            // {
            //     echo xl_layout_label('hidden label').":";
            // }

            // if ($key == 'assessment_personal' )
            // {
            //     echo xl_layout_label('Personal').":";
            // }

            // if ($key == 'assessment_personal_z_code' )
            // {
            //     echo xl_layout_label('hidden label').":";
            // }

            // if ($key == 'assessment_gaf' )
            // {
            //     echo xl_layout_label('ASSESSMENTS GAP').":";
            // }

            // if ($key == 'assessment_disability_assessment_schedule' )
            // {
            //     echo xl_layout_label('Disability Assessment Schedule').":";
            // }

    //Factors affective treatment and recovery//

            if ($key == 'assessment_factors_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Factors affective treatment and recovery');
                echo '</b></td><td>' .$data['assessment_factors_comments']. '</td></tr></table>';
            }

            if ($key == 'assessment_client_attitude' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Clients assess attitude towards treatment');
                echo '</b></td><td>' .$data['assessment_client_attitude']. '</td></tr></table>';
            }

            if ($key == 'assessment_recommended_treatment_modalities' )
            {
                $treatment = explode('|', $data['assessment_recommended_treatment_modalities']);
                echo '<br><table width=100% border=1><tr><td colspan=3><b>';
                echo xl_layout_label('Recommended treatment modalities');
                echo '</b></td></tr><tr>';
                foreach($treatment as $value)
                {
                    echo '<td>' .$value. '</td>';
                }
                echo '</tr></table>';
            }

    //

            // if ($key == 'assessment_recommended_treatment_other' )
            // {
            //     echo xl_layout_label('Other').":";
            // }

    //Treatment Recommendations//

            if ($key == 'assessment_recommended_treatment_comments' )
            {
                echo '<br><table width=100% border=1><tr><td><b>';
                echo xl_layout_label('Treatment Recommendations');
                echo '</b></td><td>' .$data['assessment_recommended_treatment_comments']. '</td></tr></table>';
            }

                // echo '</span><span class=text>'.generate_display_field( $manual_layouts[$key], $value ).'</span></td>';

            $count++;
            if ($count == $cols) {
                $count = 0;
                echo '</tr><tr>' . PHP_EOL;
            }
        }
    }

    echo '</tr></table><hr>';


}
?>

