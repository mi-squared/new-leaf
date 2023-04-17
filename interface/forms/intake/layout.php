<?php
require_once('array.php');

if (!isset($xyzzy))
{
  $xyzzy = array("foo");
}

foreach($xyzzy as $index => &$val){
    $val = html_entity_decode($val);

}

?>



<!-- display the form's manual based fields -->
<table>
    <tr><td colspan='5'>&nbsp;</td></tr>
    <tr><td colspan='5'>&nbsp;</td></tr>
    <tr><td><div id="header" class='section'><table>
                    <!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Date of Intake','e').':'; ?></td></tr>
                    <tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['date_created'], array_key_exists('date_created', $xyzzy) ? $xyzzy['date_created'] : date()); ?></td><!-- called consumeRows 515--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
                </table>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_1' value='1' data-section="header" checked="checked" />Presenting Issue/Chief Complaint</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="header" class='section'><table>
<!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Presenting Issue/Chief Complaint (include onset and duration)','e').':'; ?></td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['presenting_issue'], array_key_exists('presenting_issue', $xyzzy) ? $xyzzy['presenting_issue'] : ''); ?></td><!-- called consumeRows 515--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr> <!-- end section header -->
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_2' value='1' data-section="current_symptoms_behaviors" checked="checked" />Current Symptoms/Behaviors</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="current_symptoms_behaviors" class='section'><table>

<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('BEHAVIORAL EVIDENCE','e').''; ?></td></tr>
<tr><td class='fieldlabel italic' colspan='5'><?php echo xl_layout_label('(Please note frequency, intensity, and duration of symptom)','e').''; ?></td></tr>
<tr><td class='fieldlabel italic' colspan='5'><?php echo xl_layout_label('(1-None, 2-History Now Stable, 3-Mild/Infrequent, 4-Moderate/Frequent, 5-Severe/Acute Crisis)','e').''; ?></td></tr>

<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('DANGER TO SELF/OTHERS','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Suicidal Thought/Behavior','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_suicidal_thought_rating'], array_key_exists('symptoms_suicidal_thought_rating', $xyzzy) ? $xyzzy['symptoms_suicidal_thought_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_suicidal_thought_text'], array_key_exists('symptoms_suicidal_thought_text', $xyzzy) ? $xyzzy['symptoms_suicidal_thought_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Homicial Thought/Behavior','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_homicidal_thought_rating'], array_key_exists('symptoms_homicidal_thought_rating', $xyzzy) ? $xyzzy['symptoms_homicidal_thought_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_homicidal_thought_text'], array_key_exists('symptoms_homicidal_thought_text', $xyzzy) ? $xyzzy['symptoms_homicidal_thought_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Aggressiveness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_aggressiveness_rating'], array_key_exists('symptoms_aggressiveness_rating', $xyzzy) ? $xyzzy['symptoms_aggressiveness_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_aggressiveness_text'], array_key_exists('symptoms_aggressiveness_text', $xyzzy) ? $xyzzy['symptoms_aggressiveness_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Self-Injurious Behavior','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_self_injurious_behavior_rating'], array_key_exists('symptoms_self_injurious_behavior_rating', $xyzzy) ? $xyzzy['symptoms_self_injurious_behavior_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_self_injurious_behavior_text'], array_key_exists('symptoms_self_injurious_behavior_text', $xyzzy) ? $xyzzy['symptoms_self_injurious_behavior_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Sexual Trauma perpetrator','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_sexual_trauma_perpetrator_rating'], array_key_exists('symptoms_sexual_trauma_perpetrator_rating', $xyzzy) ? $xyzzy['symptoms_sexual_trauma_perpetrator_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_sexual_trauma_perpetrator_text'], array_key_exists('symptoms_sexual_trauma_perpetrator_text', $xyzzy) ? $xyzzy['symptoms_sexual_trauma_perpetrator_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('PSYCHOSIS','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Hallucinations','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_hallucinations_rating'], array_key_exists('symptoms_hallucinations_rating', $xyzzy) ? $xyzzy['symptoms_hallucinations_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_hallucinations_text'], array_key_exists('symptoms_hallucinations_text', $xyzzy) ? $xyzzy['symptoms_hallucinations_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Delusions','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_delusions_rating'], array_key_exists('symptoms_delusions_rating', $xyzzy) ? $xyzzy['symptoms_delusions_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_delusions_text'], array_key_exists('symptoms_delusions_text', $xyzzy) ? $xyzzy['symptoms_delusions_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Paranoia','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_paranoia_rating'], array_key_exists('symptoms_paranoia_rating', $xyzzy) ? $xyzzy['symptoms_paranoia_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_paranoia_text'], array_key_exists('symptoms_paranoia_text', $xyzzy) ? $xyzzy['symptoms_paranoia_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('MOOD','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Depressed Mood','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_depression_rating'], array_key_exists('symptoms_depression_rating', $xyzzy) ? $xyzzy['symptoms_depression_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_depression_text'], array_key_exists('symptoms_depression_text', $xyzzy) ? $xyzzy['symptoms_depression_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Feelings of Worthlessness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_worthlessness_rating'], array_key_exists('symptoms_worthlessness_rating', $xyzzy) ? $xyzzy['symptoms_worthlessness_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_worthlessness_text'], array_key_exists('symptoms_worthlessness_text', $xyzzy) ? $xyzzy['symptoms_worthlessness_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Manic Thought/Behavior','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_manic_thought_rating'], array_key_exists('symptoms_manic_thought_rating', $xyzzy) ? $xyzzy['symptoms_manic_thought_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_manic_thought_text'], array_key_exists('symptoms_manic_thought_text', $xyzzy) ? $xyzzy['symptoms_manic_thought_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Intense or Abrupt Moodswings','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_moodswings_rating'], array_key_exists('symptoms_moodswings_rating', $xyzzy) ? $xyzzy['symptoms_moodswings_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_moodswings_text'], array_key_exists('symptoms_moodswings_text', $xyzzy) ? $xyzzy['symptoms_moodswings_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Irritability/Anger Issues','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_irritability_anger_rating'], array_key_exists('symptoms_irritability_anger_rating', $xyzzy) ? $xyzzy['symptoms_irritability_anger_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_irritability_anger_text'], array_key_exists('symptoms_irritability_anger_text', $xyzzy) ? $xyzzy['symptoms_irritability_anger_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('ANXIETY','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Anxiety','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_anxiety_rating'], array_key_exists('symptoms_anxiety_rating', $xyzzy) ? $xyzzy['symptoms_anxiety_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_anxiety_text'], array_key_exists('symptoms_anxiety_text', $xyzzy) ? $xyzzy['symptoms_anxiety_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Phobias','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_phobias_rating'], array_key_exists('symptoms_phobias_rating', $xyzzy) ? $xyzzy['symptoms_phobias_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_phobias_text'], array_key_exists('symptoms_phobias_text', $xyzzy) ? $xyzzy['symptoms_phobias_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Obsessions/Compulsions','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_obsessions_compulsions_rating'], array_key_exists('symptoms_obsessions_compulsions_rating', $xyzzy) ? $xyzzy['symptoms_obsessions_compulsions_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_obsessions_compulsions_text'], array_key_exists('symptoms_obsessions_compulsions_text', $xyzzy) ? $xyzzy['symptoms_obsessions_compulsions_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('PHYSICAL/COGNITIVE','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Change in Appetite','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_change_in_appetite_rating'], array_key_exists('symptoms_change_in_appetite_rating', $xyzzy) ? $xyzzy['symptoms_change_in_appetite_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_change_in_appetite_text'], array_key_exists('symptoms_change_in_appetite_text', $xyzzy) ? $xyzzy['symptoms_change_in_appetite_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Change in Energy Level','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_change_in_energy_level_rating'], array_key_exists('symptoms_change_in_energy_level_rating', $xyzzy) ? $xyzzy['symptoms_change_in_energy_level_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_change_in_energy_level_text'], array_key_exists('symptoms_change_in_energy_level_text', $xyzzy) ? $xyzzy['symptoms_change_in_energy_level_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Sleep Disturbance','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_sleep_disturbance_rating'], array_key_exists('symptoms_sleep_disturbance_rating', $xyzzy) ? $xyzzy['symptoms_sleep_disturbance_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_sleep_disturbance_text'], array_key_exists('symptoms_sleep_disturbance_text', $xyzzy) ? $xyzzy['symptoms_sleep_disturbance_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Decreased Concentration','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_decreased_concentration_rating'], array_key_exists('symptoms_decreased_concentration_rating', $xyzzy) ? $xyzzy['symptoms_decreased_concentration_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_decreased_concentration_text'], array_key_exists('symptoms_decreased_concentration_text', $xyzzy) ? $xyzzy['symptoms_decreased_concentration_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Disorganized/disoriented','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_disorganized_disoriented_rating'], array_key_exists('symptoms_disorganized_disoriented_rating', $xyzzy) ? $xyzzy['symptoms_disorganized_disoriented_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_disorganized_disoriented_text'], array_key_exists('symptoms_disorganized_disoriented_text', $xyzzy) ? $xyzzy['symptoms_disorganized_disoriented_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Learning Problem','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_learning_problem_rating'], array_key_exists('symptoms_learning_problem_rating', $xyzzy) ? $xyzzy['symptoms_learning_problem_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_learning_problem_text'], array_key_exists('symptoms_learning_problem_text', $xyzzy) ? $xyzzy['symptoms_learning_problem_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Medical Complication/Pain','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_medical_complication_rating'], array_key_exists('symptoms_medical_complication_rating', $xyzzy) ? $xyzzy['symptoms_medical_complication_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_medical_complication_text'], array_key_exists('symptoms_medical_complication_text', $xyzzy) ? $xyzzy['symptoms_medical_complication_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('BEHAVIOR','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Social Withdrawal','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_social_withdrawal_rating'], array_key_exists('symptoms_social_withdrawal_rating', $xyzzy) ? $xyzzy['symptoms_social_withdrawal_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_social_withdrawal_text'], array_key_exists('symptoms_social_withdrawal_text', $xyzzy) ? $xyzzy['symptoms_social_withdrawal_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Binges/Purges','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_binges_purges_rating'], array_key_exists('symptoms_binges_purges_rating', $xyzzy) ? $xyzzy['symptoms_binges_purges_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_binges_purges_text'], array_key_exists('symptoms_binges_purges_text', $xyzzy) ? $xyzzy['symptoms_binges_purges_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Sexual Acting Out / Promiscuity','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_sexual_acting_out_rating'], array_key_exists('symptoms_sexual_acting_out_rating', $xyzzy) ? $xyzzy['symptoms_sexual_acting_out_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_sexual_acting_out_text'], array_key_exists('symptoms_sexual_acting_out_text', $xyzzy) ? $xyzzy['symptoms_sexual_acting_out_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Distractibility/Impulsivity','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_distractibility_impulsivity_rating'], array_key_exists('symptoms_distractibility_impulsivity_rating', $xyzzy) ? $xyzzy['symptoms_distractibility_impulsivity_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_distractibility_impulsivity_text'], array_key_exists('symptoms_distractibility_impulsivity_text', $xyzzy) ? $xyzzy['symptoms_distractibility_impulsivity_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Hyperactivity','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_hyperactivity_rating'], array_key_exists('symptoms_hyperactivity_rating', $xyzzy) ? $xyzzy['symptoms_hyperactivity_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_hyperactivity_text'], array_key_exists('symptoms_hyperactivity_text', $xyzzy) ? $xyzzy['symptoms_hyperactivity_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Lying/Manipulative','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_lying_maniuplative_rating'], array_key_exists('symptoms_lying_maniuplative_rating', $xyzzy) ? $xyzzy['symptoms_lying_maniuplative_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_lying_maniuplative_text'], array_key_exists('symptoms_lying_maniuplative_text', $xyzzy) ? $xyzzy['symptoms_lying_maniuplative_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Oppositional Behavior','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_oppositional_behavior_rating'], array_key_exists('symptoms_oppositional_behavior_rating', $xyzzy) ? $xyzzy['symptoms_oppositional_behavior_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_oppositional_behavior_text'], array_key_exists('symptoms_oppositional_behavior_text', $xyzzy) ? $xyzzy['symptoms_oppositional_behavior_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Running Away','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_running_away_rating'], array_key_exists('symptoms_running_away_rating', $xyzzy) ? $xyzzy['symptoms_running_away_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_running_away_text'], array_key_exists('symptoms_running_away_text', $xyzzy) ? $xyzzy['symptoms_running_away_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Truancy/Absenteeism','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_truancy_absenteeism_rating'], array_key_exists('symptoms_truancy_absenteeism_rating', $xyzzy) ? $xyzzy['symptoms_truancy_absenteeism_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_truancy_absenteeism_text'], array_key_exists('symptoms_truancy_absenteeism_text', $xyzzy) ? $xyzzy['symptoms_truancy_absenteeism_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Property Destruction','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_property_destruction_rating'], array_key_exists('symptoms_property_destruction_rating', $xyzzy) ? $xyzzy['symptoms_property_destruction_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_property_destruction_text'], array_key_exists('symptoms_property_destruction_text', $xyzzy) ? $xyzzy['symptoms_property_destruction_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Fire Setting','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_fire_setting_rating'], array_key_exists('symptoms_fire_setting_rating', $xyzzy) ? $xyzzy['symptoms_fire_setting_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_fire_setting_text'], array_key_exists('symptoms_fire_setting_text', $xyzzy) ? $xyzzy['symptoms_fire_setting_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Cruelty to Animals','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_cruelty_to_animals_rating'], array_key_exists('symptoms_cruelty_to_animals_rating', $xyzzy) ? $xyzzy['symptoms_cruelty_to_animals_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_cruelty_to_animals_text'], array_key_exists('symptoms_cruelty_to_animals_text', $xyzzy) ? $xyzzy['symptoms_cruelty_to_animals_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Stealing','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_stealing_rating'], array_key_exists('symptoms_stealing_rating', $xyzzy) ? $xyzzy['symptoms_stealing_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_stealing_text'], array_key_exists('symptoms_stealing_text', $xyzzy) ? $xyzzy['symptoms_stealing_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('ADDICTIVE BEHAVIORS','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Gambling','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_gambling_rating'], array_key_exists('symptoms_gambling_rating', $xyzzy) ? $xyzzy['symptoms_gambling_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_gambling_text'], array_key_exists('symptoms_gambling_text', $xyzzy) ? $xyzzy['symptoms_gambling_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Internet','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_internet_rating'], array_key_exists('symptoms_internet_rating', $xyzzy) ? $xyzzy['symptoms_internet_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_internet_text'], array_key_exists('symptoms_internet_text', $xyzzy) ? $xyzzy['symptoms_internet_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Gaming','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_gaming_rating'], array_key_exists('symptoms_gaming_rating', $xyzzy) ? $xyzzy['symptoms_gaming_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_gaming_text'], array_key_exists('symptoms_gaming_text', $xyzzy) ? $xyzzy['symptoms_gaming_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 325--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel top' colspan='2'><?php echo xl_layout_label('Other Issues','e').':'; ?></td><td class='text data top' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_behavioral_other_issues_rating'], array_key_exists('symptoms_behavioral_other_issues_rating', $xyzzy) ? $xyzzy['symptoms_behavioral_other_issues_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_behavioral_other_issues_text'], array_key_exists('symptoms_behavioral_other_issues_text', $xyzzy) ? $xyzzy['symptoms_behavioral_other_issues_text'] : ''); ?></td><!-- called consumeRows 525--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td class='fieldlabel bold' colspan='5'><?php echo xl_layout_label('OTHER ISSUES','e').''; ?></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Other','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_other1_rating'], array_key_exists('symptoms_other1_rating', $xyzzy) ? $xyzzy['symptoms_other1_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_other1_text'], array_key_exists('symptoms_other1_text', $xyzzy) ? $xyzzy['symptoms_other1_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Other','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_other2_rating'], array_key_exists('symptoms_other2_rating', $xyzzy) ? $xyzzy['symptoms_other2_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_other2_text'], array_key_exists('symptoms_other2_text', $xyzzy) ? $xyzzy['symptoms_other2_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Other','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['symptoms_other3_rating'], array_key_exists('symptoms_other3_rating', $xyzzy) ? $xyzzy['symptoms_other3_rating'] : ''); ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['symptoms_other3_text'], array_key_exists('symptoms_other3_text', $xyzzy) ? $xyzzy['symptoms_other3_text'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section current_symptoms_behaviors -->
<tr><td>
        <fieldset class="top_buttons">
            <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
        </fieldset>
</td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_3' value='1' data-section="alcohol_drug_use_history" checked="checked" />Alcohol/Drug Use History</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><div id="alcohol_drug_use_history" class='section'><table>
<td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Substance Use','e').':'; ?></td></tr>

<tr><td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Please include information related to amount used, frequency, age first used and last used.','e').''; ?></td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['substance_use'], array_key_exists('substance_use', $xyzzy) ? $xyzzy['substance_use'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Comments','e').':'; ?><br/>Please include history of withdrawal symptoms, overdose, periods of abstinence.</td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['substance_use_general_comments'], array_key_exists('substance_use_general_comments', $xyzzy) ? $xyzzy['substance_use_general_comments'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Client Acknowledgment','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['substance_use_client_acknowledgment'], array_key_exists('substance_use_client_acknowledgment', $xyzzy) ? $xyzzy['substance_use_client_acknowledgment'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Supportive Recovery Environment','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['substance_use_supportive_environment'], array_key_exists('substance_use_supportive_environment', $xyzzy) ? $xyzzy['substance_use_supportive_environment'] : ''); ?></td><!-- called consumeRows 215--> <!-- Exiting not($fields) and generating 3 empty fields --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='5'><br/><?php echo xl_layout_label('History of Prior Substance Abuse Treatment','e').':'; ?><br/>Include participation in outpatient treatment, self-help and 12-step programs, withdrawal management, and detox.</td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['substance_use_prior_treatment'], array_key_exists('substance_use_prior_treatment', $xyzzy) ? $xyzzy['substance_use_prior_treatment'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section alcohol_drug_use_history -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_4' value='1' data-section="legal_history" checked="checked" />Legal History</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="legal_history" class='section'><table>

<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 325--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Legal History. Include probation, parole, court dates, arrests, convictions, and name of parole officer','e').':'; ?></td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['legal_comments'], array_key_exists('legal_comments', $xyzzy) ? $xyzzy['legal_comments'] : ''); ?></td><!-- called consumeRows 825--> <!-- Exiting not($fields) and generating -3 empty fields --></tr>

</table></div>
</td></tr> <!-- end section legal_history -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_5' value='1' data-section="mental_health_history" checked="checked" />Mental Health Treatment History</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="mental_health_history" class='section'><table>
<tr><td class='fieldlabel' colspan='1'>Previous Treatment</td><td class='fieldlabel' colspan='1'>Location</td><td class='fieldlabel' colspan='1'>Dates</td><td class='fieldlabel' colspan='1'>Number in last 12 months</td><td class='fieldlabel' colspan='1'>Total Number</td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Inpatient Hospitalizations','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_inpatient_hospitalizations_location'], array_key_exists('mh_inpatient_hospitalizations_location', $xyzzy) ? $xyzzy['mh_inpatient_hospitalizations_location'] : ''); ?></td>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_inpatient_hospitalizations_dates'], array_key_exists('mh_inpatient_hospitalizations_dates', $xyzzy) ? $xyzzy['mh_inpatient_hospitalizations_dates'] : ''); ?>
</td>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_inpatient_hospitalizations_last_year'], array_key_exists('mh_inpatient_hospitalizations_last_year', $xyzzy) ? $xyzzy['mh_inpatient_hospitalizations_last_year'] : ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_inpatient_hospitalizations_total_num'], array_key_exists('mh_inpatient_hospitalizations_total_num', $xyzzy) ? $xyzzy['mh_inpatient_hospitalizations_total_num'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('ER/Crisis MH Involvement','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_er_crisis_involvement_location'], array_key_exists('mh_er_crisis_involvement_location', $xyzzy) ? $xyzzy['mh_er_crisis_involvement_location'] : ''); ?></td>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_er_crisis_involvement_dates'], array_key_exists('mh_er_crisis_involvement_dates', $xyzzy) ? $xyzzy['mh_er_crisis_involvement_dates'] : ''); ?>
</td>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_er_crisis_involvement_last_year'], array_key_exists('mh_er_crisis_involvement_last_year', $xyzzy) ? $xyzzy['mh_er_crisis_involvement_last_year'] : ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_er_crisis_involvement_total_num'], array_key_exists('mh_er_crisis_involvement_total_num', $xyzzy) ? $xyzzy['mh_er_crisis_involvement_total_num'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Outpatient Therapy','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_outpatient_therapy_location'], array_key_exists('mh_outpatient_therapy_location', $xyzzy) ? $xyzzy['mh_outpatient_therapy_location'] : ''); ?></td>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_outpatient_therapy_dates'], array_key_exists('mh_outpatient_therapy_dates', $xyzzy) ? $xyzzy['mh_outpatient_therapy_dates'] : ''); ?>
</td>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_outpatient_therapy_last_year'], array_key_exists('mh_outpatient_therapy_last_year', $xyzzy) ? $xyzzy['mh_outpatient_therapy_last_year'] : ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mh_outpatient_therapy_total_num'], array_key_exists('mh_outpatient_therapy_total_num', $xyzzy) ? $xyzzy['mh_outpatient_therapy_total_num'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Comments','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['mh_comments'], array_key_exists('mh_comments', $xyzzy) ? $xyzzy['mh_comments'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Currently seeing','e').':'; ?></td></tr><tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['mh_currently_seeing'], array_key_exists('mh_currently_seeing', $xyzzy) ? $xyzzy['mh_currently_seeing'] : ''); ?></td><!-- called consumeRows 215--> <!-- Exiting not($fields) and generating 3 empty fields --><td class='emptycell' colspan='1'></td></tr>
</table></div>
</td></tr> <!-- end section mental_health_history -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_6' value='1' data-section="medical_history" checked="checked" />Medical History</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="medical_history" class='section'><table>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Significant History/problems','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['med_hist_comments'], array_key_exists('med_hist_comments', $xyzzy) ? $xyzzy['med_hist_comments'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 435--> <!--  generating 5 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Routine medical care?','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['med_hist_routine_medical_care'], array_key_exists('med_hist_routine_medical_care', $xyzzy) ? $xyzzy['med_hist_routine_medical_care'] : ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Allergies?','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['med_hist_allergies'], array_key_exists('med_hist_allergies', $xyzzy) ? $xyzzy['med_hist_allergies'] : ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['med_hist_allergies_comments'], array_key_exists('med_hist_allergies_comments', $xyzzy) ? $xyzzy['med_hist_allergies_comments'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td>
<span class="fieldlabel"><?php xl('Date last seen by primary care doctor (approximate)','e'); ?></span>
</td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['med_hist_date'], array_key_exists('med_hist_date', $xyzzy) ? $xyzzy['med_hist_date'] : ''); ?>
</td>
<!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 325--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('If female, currently pregnant?','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['med_hist_pregnant'], array_key_exists('med_hist_pregnant', $xyzzy) ? $xyzzy['med_hist_pregnant'] : ''); ?></td><td class='fieldlabel' colspan='2'><?php echo xl_layout_label('If yes, history?','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['med_hist_pregnant_comments'], array_key_exists('med_hist_pregnant_comments', $xyzzy) ? $xyzzy['med_hist_pregnant_comments'] : ''); ?></td><!-- called consumeRows 525--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr> <!-- end section medical_history -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_7' value='1' data-section="current_medications" checked="checked" />Current Medications</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="current_medications" class='section'><table>
<tr><td class='fieldlabel' colspan='1'>Medication</td>
<td class='fieldlabel' colspan='1'>Dosage</td>
<td class='fieldlabel' colspan='1'>Frequency</td>
<td class='fieldlabel' colspan='1'>Date Started</td>
<td class='fieldlabel' colspan='1'>Side effects (if any)</td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 125--> <!-- just calling --><!-- called consumeRows 235--> <!-- just calling --><!-- called consumeRows 345--> <!-- just calling --><!-- called consumeRows 455--> <!--  generating 5 cells and calling -->
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_name_1'], array_key_exists('medication_name_1', $xyzzy) ? $xyzzy['medication_name_1'] : ''); ?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_dosage_1'], array_key_exists('medication_dosage_1', $xyzzy) ? $xyzzy['medication_dosage_1'] : ''); ?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_freq_1'], array_key_exists('medication_freq_1', $xyzzy) ? $xyzzy['medication_freq_1'] : '');?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_date_started_1'], array_key_exists('medication_date_started_1', $xyzzy) ? $xyzzy['medication_date_started_1'] : '');?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_side_effects_1'], array_key_exists('medication_side_effects_1', $xyzzy) ? $xyzzy['medication_side_effects_1'] : '');?></td><!--  generating empties -->
                <td class='emptycell' colspan='1'></td></tr>

                <tr><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_name_2'], array_key_exists('medication_name_2', $xyzzy) ? $xyzzy['medication_name_2'] : ''); ?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_dosage_2'], array_key_exists('medication_dosage_2', $xyzzy) ? $xyzzy['medication_dosage_2'] : ''); ?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_freq_2'], array_key_exists('medication_freq_2', $xyzzy) ? $xyzzy['medication_freq_2'] : '');?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_date_started_2'], array_key_exists('medication_date_started_2', $xyzzy) ? $xyzzy['medication_date_started_2'] : '');?></td>
                <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_side_effects_2'], array_key_exists('medication_side_effects_2', $xyzzy) ? $xyzzy['medication_side_effects_2'] : '');?></td><!--  generating empties -->
                <td class='emptycell' colspan='1'></td></tr>

                <tr><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_name_3'], array_key_exists('medication_name_3', $xyzzy) ? $xyzzy['medication_name_3'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_dosage_3'], array_key_exists('medication_dosage_3', $xyzzy) ? $xyzzy['medication_dosage_3'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_freq_3'], array_key_exists('medication_freq_3', $xyzzy) ? $xyzzy['medication_freq_3'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_date_started_3'], array_key_exists('medication_date_started_3', $xyzzy) ? $xyzzy['medication_date_started_3'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_side_effects_3'], array_key_exists('medication_side_effects_3', $xyzzy) ? $xyzzy['medication_side_effects_3'] : '');?></td><!--  generating empties -->
                    <td class='emptycell' colspan='1'></td></tr>

                <tr><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_name_4'], array_key_exists('medication_name_4', $xyzzy) ? $xyzzy['medication_name_4'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_dosage_4'], array_key_exists('medication_dosage_4', $xyzzy) ? $xyzzy['medication_dosage_4'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_freq_4'], array_key_exists('medication_freq_4', $xyzzy) ? $xyzzy['medication_freq_4'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_date_started_4'], array_key_exists('medication_date_started_4', $xyzzy) ? $xyzzy['medication_date_started_4'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_side_effects_4'], array_key_exists('medication_side_effects_4', $xyzzy) ? $xyzzy['medication_side_effects_4'] : '');?></td><!--  generating empties -->
                    <td class='emptycell' colspan='1'></td></tr>

                <tr><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_name_5'], array_key_exists('medication_name_5', $xyzzy) ? $xyzzy['medication_name_5'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_dosage_5'], array_key_exists('medication_dosage_5', $xyzzy) ? $xyzzy['medication_dosage_5'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_freq_5'], array_key_exists('medication_freq_5', $xyzzy) ? $xyzzy['medication_freq_5'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_date_started_5'], array_key_exists('medication_date_started_5', $xyzzy) ? $xyzzy['medication_date_started_5'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_side_effects_5'], array_key_exists('medication_side_effects_5', $xyzzy) ? $xyzzy['medication_side_effects_5'] : '');?></td><!--  generating empties -->
                    <td class='emptycell' colspan='1'></td></tr>

                <tr><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_name_6'], array_key_exists('medication_name_6', $xyzzy) ? $xyzzy['medication_name_6'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_dosage_6'], array_key_exists('medication_dosage_6', $xyzzy) ? $xyzzy['medication_dosage_6'] : ''); ?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_freq_6'], array_key_exists('medication_freq_6', $xyzzy) ? $xyzzy['medication_freq_6'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_date_started_6'], array_key_exists('medication_date_started_6', $xyzzy) ? $xyzzy['medication_date_started_6'] : '');?></td>
                    <td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['medication_side_effects_6'], array_key_exists('medication_side_effects_6', $xyzzy) ? $xyzzy['medication_side_effects_6'] : '');?></td><!--  generating empties -->
                    <td class='emptycell' colspan='1'></td></tr>

</table></div>
</td></tr> <!-- end section current_medications -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_8' value='1' data-section="mental_status_exam" checked="checked" />Mental Status Exam</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="mental_status_exam" class='section'><table class="wide">

<tr><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('GENERAL APPEARANCE','e').''; ?></td></tr>
<tr><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Physical Stature','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_physical_stature'], array_key_exists('mental_status_physical_stature', $xyzzy) ? $xyzzy['mental_status_physical_stature'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Hygiene','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_hygiene'], array_key_exists('mental_status_hygiene', $xyzzy) ? $xyzzy['mental_status_hygiene'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Apparent Age','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_apparent_age'], array_key_exists('mental_status_apparent_age', $xyzzy) ? $xyzzy['mental_status_apparent_age'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Dress','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_dress_appearance'], array_key_exists('mental_status_dress_appearance', $xyzzy) ? $xyzzy['mental_status_dress_appearance'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Posture','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_posture_appearance'], array_key_exists('mental_status_posture_appearance', $xyzzy) ? $xyzzy['mental_status_posture_appearance'] : ''); ?></td></tr>
</table></td>
<!--  generating empties --><td class='emptycell' colspan='1'></td><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('ACTIVITY','e').''; ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Consciousness','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_consciousness_activity'], array_key_exists('mental_status_consciousness_activity', $xyzzy) ? $xyzzy['mental_status_consciousness_activity'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' class='top' colspan='1'><?php echo xl_layout_label('Motor Activity','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_motor_activity'], array_key_exists('mental_status_motor_activity', $xyzzy) ? $xyzzy['mental_status_motor_activity'] : ''); ?></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Eye Contact','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_eye_contact'], array_key_exists('mental_status_eye_contact', $xyzzy) ? $xyzzy['mental_status_eye_contact'] : ''); ?></td></tr>
</table></td></tr>

<tr><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('ATTITUDE','e').''; ?></td></tr>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_attitude'], array_key_exists('mental_status_attitude', $xyzzy) ? $xyzzy['mental_status_attitude'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td>

</table></td>
<!--  generating empties --><td class='emptycell' colspan='1'></td><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('SPEECH','e').''; ?></td></tr>

<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Production','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_speech_production'], array_key_exists('mental_status_speech_production', $xyzzy) ? $xyzzy['mental_status_speech_production'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Tone','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_speech_tone'], array_key_exists('mental_status_speech_tone', $xyzzy) ? $xyzzy['mental_status_speech_tone'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Rate','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_speech_rate'], array_key_exists('mental_status_speech_rate', $xyzzy) ? $xyzzy['mental_status_speech_rate'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Other','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_speech_other'], array_key_exists('mental_status_speech_other', $xyzzy) ? $xyzzy['mental_status_speech_other'] : ''); ?></td></tr>
</table></td></tr>

<tr><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('MOOD','e').''; ?></td></tr>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_mood'], array_key_exists('mental_status_mood', $xyzzy) ? $xyzzy['mental_status_mood'] : ''); ?></td></tr>

</table></td>
<!--  generating empties --><td class='emptycell' colspan='1'></td><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('AFFECT','e').''; ?></td></tr>
<td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_affect'], array_key_exists('mental_status_affect', $xyzzy) ? $xyzzy['mental_status_affect'] : ''); ?></td>

</table></td></tr>

<tr><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('THOUGHT PROCESS','e').''; ?></td></tr>
<tr><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['mental_status_thought_process'], array_key_exists('mental_status_thought_process', $xyzzy) ? $xyzzy['mental_status_thought_process'] : ''); ?></td></tr>

</table></td>
<!--  generating empties --><td class='emptycell' colspan='1'></td><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('PERCEPTUAL DISTORTIONS','e').''; ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Hallucinations','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_hallucinations'], array_key_exists('mental_status_hallucinations', $xyzzy) ? $xyzzy['mental_status_hallucinations'] : ''); ?></td>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Other Perceptual Distortions','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_other_distortions'], array_key_exists('mental_status_other_distortions', $xyzzy) ? $xyzzy['mental_status_other_distortions'] : ''); ?></td></tr>

</table></td></tr>

<tr><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('ABNORMAL THOUGHTS','e').''; ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Abnormal Thoughts Delusions','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_delusions'], array_key_exists('mental_status_delusions', $xyzzy) ? $xyzzy['mental_status_delusions'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Other Abnormal Thoughts','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_abnormal_other'], array_key_exists('mental_status_abnormal_other', $xyzzy) ? $xyzzy['mental_status_abnormal_other'] : ''); ?></td></tr>

</table></td>
<!--  generating empties --><td class='emptycell' colspan='1'></td><td colspan='2' class='top'>
<table class="wide">
<tr><td class='fieldlabel bold' colspan='2'><?php echo xl_layout_label('EXECUTIVE FUNCTIONING','e').''; ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Orientation','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_orientation'], array_key_exists('mental_status_orientation', $xyzzy) ? $xyzzy['mental_status_orientation'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Intelligence','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_intelligence'], array_key_exists('mental_status_intelligence', $xyzzy) ? $xyzzy['mental_status_intelligence'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Abstraction','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_abstraction'], array_key_exists('mental_status_abstraction', $xyzzy) ? $xyzzy['mental_status_abstraction'] : ''); ?></td></tr></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Insight','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_insight'], array_key_exists('mental_status_insight', $xyzzy) ? $xyzzy['mental_status_insight'] : ''); ?></td></tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Memory Impaired','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_memory_impaired'], array_key_exists('mental_status_memory_impaired', $xyzzy) ? $xyzzy['mental_status_memory_impaired'] : ''); ?></td> </tr>
<tr><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Attn./Concentration Impaired','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_attention_concentration'], array_key_exists('mental_status_attention_concentration', $xyzzy) ? $xyzzy['mental_status_attention_concentration'] : ''); ?></td></tr>
<tr><!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel top' colspan='1'><?php echo xl_layout_label('Judgment Impaired','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['mental_status_judgment_impaired'], array_key_exists('mental_status_judgment_impaired', $xyzzy) ? $xyzzy['mental_status_judgment_impaired'] : ''); ?></td></tr>

</table></td></tr>


</table></div>
</td></tr> <!-- end section mental_status_exam -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_9' value='1' data-section="family_and_social_history" checked="checked" />Family And Social History</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="family_and_social_history" class='section'><table>
<tr><td colspan='2' class='fieldlabel'>Name of significant family/relationships</td><td colspan='1' class='fieldlabel'>Relation to client</td><td colspan='1' class='fieldlabel'>Age</td><td colspan='1' class='fieldlabel'>Lives with you?</td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_1'], $xyzzy['family_social_history_name_1'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_1'], $xyzzy['family_social_history_relation_1'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_1'], $xyzzy['family_social_history_age_1'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_1'], $xyzzy['family_social_history_cohabitate_1'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_2'], $xyzzy['family_social_history_name_2'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_2'], $xyzzy['family_social_history_relation_2'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_2'], $xyzzy['family_social_history_age_2'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_2'], $xyzzy['family_social_history_cohabitate_2'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_3'], $xyzzy['family_social_history_name_3'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_3'], $xyzzy['family_social_history_relation_3'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_3'], $xyzzy['family_social_history_age_3'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_3'], $xyzzy['family_social_history_cohabitate_3'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_4'], $xyzzy['family_social_history_name_4'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_4'], $xyzzy['family_social_history_relation_4'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_4'], $xyzzy['family_social_history_age_4'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_4'], $xyzzy['family_social_history_cohabitate_4'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_5'], $xyzzy['family_social_history_name_5'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_5'], $xyzzy['family_social_history_relation_5'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_5'], $xyzzy['family_social_history_age_5'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_5'], $xyzzy['family_social_history_cohabitate_5'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_6'], $xyzzy['family_social_history_name_6'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_6'], $xyzzy['family_social_history_relation_6'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_6'], $xyzzy['family_social_history_age_6'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_6'], $xyzzy['family_social_history_cohabitate_6'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!-- just calling --><!-- called consumeRows 335--> <!-- just calling --><!-- called consumeRows 445--> <!--  generating 5 cells and calling --><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['family_social_history_name_7'], $xyzzy['family_social_history_name_7'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_relation_7'], $xyzzy['family_social_history_relation_7'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_age_7'], $xyzzy['family_social_history_age_7'] ?? ''); ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['family_social_history_cohabitate_7'], $xyzzy['family_social_history_cohabitate_7'] ?? ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Social History','e').':'; ?><br>Include aspects of family history, relationships with others/family, history of significant relationships/marriages.</td></tr><tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['family_social_history_comments'], array_key_exists('family_social_history_comments', $xyzzy) ? $xyzzy['family_social_history_comments'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Trauma History','e').':'; ?><br>Include history of any phycial abuse, sexual abuse, domestic violence, other trauma.</td></tr><tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['family_social_history_trauma'], array_key_exists('family_social_history_trauma', $xyzzy) ? $xyzzy['family_social_history_trauma'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Previous Mental Health/Substance Abuse problems for Family','e').':'; ?></td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['family_social_history_mh_sa_comments'], array_key_exists('family_social_history_mh_sa_comments', $xyzzy) ? $xyzzy['family_social_history_mh_sa_comments'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='5'></td></tr>
<!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Are there cultural, ethnic, or family issues that are causing you problems or might affect your treatment? If yes, please explain.','e').''; ?></td></tr>
<tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['family_social_history_cultural_ethnic'], array_key_exists('family_social_history_cultural_ethnic', $xyzzy) ? $xyzzy['family_social_history_cultural_ethnic'] : ''); ?></td><!-- called consumeRows 515--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr> <!-- end section family_and_social_history -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_10' value='1' data-section="developmental_history" checked="checked" />Developmental History</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="developmental_history" class='section'><table>







<!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Developmental History?','e').':'; ?><br />Indicate any issues with developmental milestones, complications with delivery, fetal exposure to substance abuse, and other developmental history.</td></tr>
<td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['dev_history_other'], array_key_exists('dev_history_other', $xyzzy) ? $xyzzy['dev_history_other'] : ''); ?></td><!-- called consumeRows 525--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr> <!-- end section developmental_history -->
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_11' value='1' data-section="educational_employment_history" checked="checked" />Educational/Employment History</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="educational_employment_history" class='section'><table>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!--  generating 5 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Client currently in school?','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['education_in_school'], array_key_exists('education_in_school', $xyzzy) ? $xyzzy['education_in_school'] : ''); ?></td><td class='fieldlabel' colspan='2'><?php echo xl_layout_label('If no, highest grade completed','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['education_highest_grade'], array_key_exists('education_highest_grade', $xyzzy) ? $xyzzy['education_highest_grade'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 225--> <!--  generating 5 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('If yes, school','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['education_school_attended'], array_key_exists('education_school_attended', $xyzzy) ? $xyzzy['education_school_attended'] : ''); ?></td><td class='fieldlabel' colspan='2'><?php echo xl_layout_label('Grade level','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['education_grade_level'], array_key_exists('education_grade_level', $xyzzy) ? $xyzzy['education_grade_level'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Academic History','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['education_academic_history'], array_key_exists('education_academic_history', $xyzzy) ? $xyzzy['education_academic_history'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Learning Disabilities / IEP:','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['education_learning_disabilities'], array_key_exists('education_learning_disabilities', $xyzzy) ? $xyzzy['education_learning_disabilities'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Employment / Extracirricular Activities','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['education_employment_hobbies'], array_key_exists('education_employment_hobbies', $xyzzy) ? $xyzzy['education_employment_hobbies'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- just calling --><!-- called consumeRows 325--> <!--  generating 8 cells and calling --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Employment hours per week','e').':'; ?></td><td class='text data' colspan='1'><?php echo generate_form_field($manual_layouts['education_employment_hours_per_week'], array_key_exists('education_employment_hours_per_week', $xyzzy) ? $xyzzy['education_employment_hours_per_week'] : ''); ?></td><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Employment Type','e').':'; ?></td><td class='text data' colspan='2'><?php echo generate_form_field($manual_layouts['education_employment_type'], array_key_exists('education_employment_type', $xyzzy) ? $xyzzy['education_employment_type'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last --><td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Coworker / Peer Relations:','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['education_employment_peer_relations'], array_key_exists('education_employment_peer_relations', $xyzzy) ? $xyzzy['education_employment_peer_relations'] : ''); ?></td><!-- called consumeRows 515--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr>
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_12' value='1' data-section="needs_assessment" checked="checked" />Holistic Needs Assessment </td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="needs_assessment" class='section'><table>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Skills/Ability','e').':'; ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['needs_assessment_skills_ability'], array_key_exists('needs_assessment_skills_ability', $xyzzy) ? $xyzzy['needs_assessment_skills_ability'] : ''); ?></td><!--  generating empties --><td class='emptycell' colspan='1'></td></tr>
<td class='fieldlabel' colspan='1'><?php echo xl_layout_label('Resource Needs &nbsp&nbsp','e'); ?></td><td class='text data' colspan='4'><?php echo generate_form_field($manual_layouts['needs_resources'], array_key_exists('needs_resources', $xyzzy) ? $xyzzy['needs_resources'] : ''); ?></td><!-- called consumeRows 515--> <!-- Exiting not($fields) and generating 0 empty fields --></tr>
</table></div>
</td></tr>
    <tr><td>
            <fieldset class="top_buttons">
                <input type="button" class="save_continue btn-primary"  value="<?php xl('Save and Continue','e'); ?>" />
            </fieldset>
        </td></tr>
<tr><td class='sectionlabel'><input type='checkbox' id='form_cb_m_13' value='1' data-section="interpretive_summary" checked="checked" />Interpretive Summary:  (rationale for diagnoses; please include diagnostic criteria and contextual factors that justify all diagnoses generated)</td></tr>
<tr><td colspan='5'>&nbsp;</td></tr>
<tr><td><div id="interpretive_summary" class='section'>
<table>
<td class='fieldlabel' colspan='5'><?php echo xl_layout_label('Interpretive Summary','e').':'; ?></td></tr><tr><td class='text data' colspan='5'><?php echo generate_form_field($manual_layouts['assessment_presenting_problem'], array_key_exists('assessment_presenting_problem', $xyzzy) ? $xyzzy['assessment_presenting_problem'] : ''); ?></td><td class='emptycell' colspan='1'></td></tr>

    <tr>
        <td class="fieldlabel" colspan="5">DIAGNOSIS:</td>
    </tr>
    <tr>
        <td class="text data" colspan="1">
        <button id="add_issue">Add ICD10 to Patient Issue List</button>
        </td>
        <td class="text data" colspan="4"  >
            <?php echo generate_form_field($manual_layouts['assessment_diagnosis_1'], array_key_exists('assessment_diagnosis_1', $xyzzy) ? $xyzzy['assessment_diagnosis_1'] : ''); ?>
        </td>

    </tr>





    <td class='fieldlabel' colspan='1'>
                    <?php echo xl_layout_label('Factors affecting treatment and recovery','e').':'; ?>
                </td>
                <td class='text data' colspan='4'>
                    <?php echo generate_form_field($manual_layouts['assessment_factors_comments'], array_key_exists('assessment_factors_comments', $xyzzy) ? $xyzzy['assessment_factors_comments'] : ''); ?>
                </td>
                <!--  generating empties -->
                <td class='emptycell' colspan='1'></td>
                </tr>
                <td class='fieldlabel' colspan='1'>
                    <?php echo xl_layout_label('Clients assess attitude towards treatment','e').':'; ?>
                </td>
                <td class='text data' colspan='1'>
                    <?php echo generate_form_field($manual_layouts['assessment_client_attitude'], array_key_exists('assessment_client_attitude', $xyzzy) ? $xyzzy['assessment_client_attitude'] : ''); ?>
                </td>
                <!--  generating empties -->
                <td class='emptycell' colspan='1'></td>
                </tr>
                <td class='fieldlabel' colspan='1'>
                    <?php echo xl_layout_label('Recommended treatment modalities','e').':'; ?>
                </td>
                <td class='text data' colspan='4'>
                    <?php echo generate_form_field($manual_layouts['assessment_recommended_treatment_modalities'], array_key_exists('assessment_recommended_treatment_modalities', $xyzzy) ? $xyzzy['assessment_recommended_treatment_modalities'] : ''); ?>
                </td>
                <!--  generating empties -->
                <td class='emptycell' colspan='1'></td>
                </tr>
                <!-- called consumeRows 015--> <!-- generating not($fields[$checked+1]) and calling last -->
                <td class='fieldlabel' colspan='1'>
                    <?php echo xl_layout_label('Treatment Recommendations','e').':'; ?>
                </td>
                <td class='text data' colspan='4'>
                    <?php echo generate_form_field($manual_layouts['assessment_recommended_treatment_comments'], array_key_exists('assessment_recommended_treatment_comments', $xyzzy) ? $xyzzy['assessment_recommended_treatment_comments'] : ''); ?>
                </td>
                <!-- called consumeRows 515--> <!-- Exiting not($fields) and generating 0 empty fields -->
                </tr>
</table></div>
</td></tr>
</table>

