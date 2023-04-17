
CREATE TABLE IF NOT EXISTS `form_intake` (
`date` datetime DEFAULT NULL COMMENT 'last modified date',
    `date_created` datetime DEFAULT NULL,
  `id` bigint NOT NULL AUTO_INCREMENT,
  `pid` bigint NOT NULL DEFAULT '0',
  `user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `groupname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `authorized` tinyint DEFAULT NULL,
  `activity` tinyint DEFAULT NULL,
  `presenting_issue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_suicidal_thought_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_suicidal_thought_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_homicidal_thought_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_homicidal_thought_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_aggressiveness_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_aggressiveness_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_self_injurious_behavior_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_self_injurious_behavior_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_sexual_trauma_perpetrator_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_sexual_trauma_perpetrator_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_hallucinations_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_hallucinations_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_delusions_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_delusions_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_paranoia_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_depression_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_depression_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_worthlessness_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_worthlessness_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_manic_thought_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_manic_thought_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_moodswings_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_moodswings_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_irritability_anger_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_irritability_anger_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_anxiety_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_anxiety_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_phobias_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_phobias_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_obsessions_compulsions_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_obsessions_compulsions_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_change_in_appetite_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_change_in_appetite_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_change_in_energy_level_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_change_in_energy_level_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_sleep_disturbance_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_sleep_disturbance_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_decreased_concentration_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_decreased_concentration_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_disorganized_disoriented_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_disorganized_disoriented_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_learning_problem_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_learning_problem_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_medical_complication_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_medical_complication_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,


  `symptoms_social_withdrawal_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_social_withdrawal_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_binges_purges_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_binges_purges_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_sexual_acting_out_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_sexual_acting_out_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_distractibility_impulsivity_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_distractibility_impulsivity_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_hyperactivity_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_hyperactivity_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_lying_maniuplative_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_lying_maniuplative_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_oppositional_behavior_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_oppositional_behavior_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_running_away_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_running_away_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_truancy_absenteeism_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_truancy_absenteeism_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_property_destruction_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_property_destruction_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_fire_setting_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_fire_setting_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_cruelty_to_animals_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_cruelty_to_animals_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_stealing_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_stealing_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_gambling_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_gambling_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_internet_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_internet_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_gaming_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_gaming_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `symptoms_behavioral_other_issues_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_behavioral_other_issues_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other1_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other1_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other2_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other2_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other3_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other3_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other4_rating` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `symptoms_other4_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `substance_use` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `substance_use_general_comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `substance_use_client_acknowledgment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `substance_use_supportive_environment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `substance_use_prior_treatment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,


  `legal_probation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `legal_parole` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `legal_court_dates` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `legal_previous_arrests` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `legal_officer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `legal_comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,



  `mh_inpatient_hospitalizations_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_inpatient_hospitalizations_dates` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_inpatient_hospitalizations_last_year` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_inpatient_hospitalizations_total_num` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_er_crisis_involvement_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_er_crisis_involvement_dates` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_er_crisis_involvement_last_year` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_er_crisis_involvement_total_num` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `mh_outpatient_therapy_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_outpatient_therapy_dates` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_outpatient_therapy_last_year` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_outpatient_therapy_total_num` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mh_currently_seeing` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `med_hist_comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `med_hist_routine_medical_care` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,



  `med_hist_allergies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `med_hist_allergies_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `med_hist_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `med_hist_pregnant` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `med_hist_pregnant_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `medication_name_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_dosage_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_freq_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_date_started_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_side_effects_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_name_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_dosage_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_freq_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_date_started_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_side_effects_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_name_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_dosage_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_freq_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_date_started_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_side_effects_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_name_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_dosage_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_freq_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_date_started_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_side_effects_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_name_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_dosage_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_freq_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_date_started_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_side_effects_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_name_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_dosage_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_freq_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_date_started_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_side_effects_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_info_from` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `medication_effectiveness` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,


  `mental_status_physical_stature` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_hygiene` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_apparent_age` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_dress_appearance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_posture_appearance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_consciousness_activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `mental_status_motor_activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_eye_contact` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,



  `mental_status_attitude` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_speech_tone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_speech_rate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_speech_production` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_speech_other` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `mental_status_mood` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_mood_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_affect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_affect_other` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_thought_process` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_hallucinations` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_other_distortions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_delusions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_abnormal_other` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_orientation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_intelligence` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `mental_status_attention_concentration` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_memory_impaired` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_abstraction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_insight` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mental_status_judgment_impaired` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_name_7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_relation_7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_age_7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_cohabitate_7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_in_relationship` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_previous_relationships` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_trauma` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `family_social_history_mh_sa_comments` blob,
  `family_social_history_cultural_ethnic` blob,

  `dev_history_applicable` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_fetal_development` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_delivery_complications` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_milestones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_sat_alone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_first_word` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_bladder_training` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_nighttime_dryness` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_first_sentence` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_walked` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dev_history_bowel_training` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `dev_history_other` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_in_school` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_highest_grade` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_school_attended` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_grade_level` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_academic_history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_learning_disabilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `education_employment_hobbies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_employment_hours_per_week` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_employment_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `education_employment_peer_relations` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `needs_assessment_skills_ability` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `needs_resources` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_presenting_problem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_client_attitude` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_1_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_2_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_3_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_4_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_diagnosis_5_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `assessment_family_housing` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_family_housing_z_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_educational_work` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_educational_z_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_economic_legal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_economic_legal_z_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_cultural_environmental` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_cultural_environmental_z_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_personal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_personal_z_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_gaf` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_disability_assessment_schedule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_factors_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,

  `assessment_recommended_treatment_modalities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_recommended_treatment_other` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `assessment_recommended_treatment_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='onetofive',
    title='1-5';
INSERT IGNORE INTO list_options SET list_id='onetofive',
    option_id='1',
    title='1 (None)',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='onetofive',
    option_id='2',
    title='2 (History now stable)',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='onetofive',
    option_id='3',
    title='3 (Mild/Infrequent)',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='onetofive',
    option_id='4',
    title='4 (Moderate/Frequent)',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='onetofive',
    option_id='5',
    title='5 (Severe/Acute Crisis)',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='substances_list',
    title='Substancelist';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Alcohol',
    title='Alcohol',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Marijuana',
    title='Marijuana',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Cocaine / Crack',
    title='Cocaine / Crack',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Amphetamines',
    title='Amphetamines',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Sedatives / Narcotics',
    title='Sedatives / Narcotics',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Opiates',
    title='Opiates',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Inhalants',
    title='Inhalants',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Designer',
    title='Designer',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Tobacco Use',
    title='Tobacco Use',
    seq='90';
INSERT IGNORE INTO list_options SET list_id='substances_list',
    option_id='Other',
    title='Other',
    seq='100';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='client_acknowledgment_list',
    title='Client Acknowledgment';
INSERT IGNORE INTO list_options SET list_id='client_acknowledgment_list',
    option_id='client_acknowledges_problem',
    title='Client acknowledges problem',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='client_acknowledgment_list',
    option_id='client_evidences_minimization_blame',
    title='Client evidences minimization/blame',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='client_acknowledgment_list',
    option_id='client_recognizes_need_for_treatment',
    title='Client recognized need for treatment',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='client_acknowledgment_list',
    option_id='motivation_to_stop_use_is_external',
    title='Motivation to stop use is external',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='good_fair_poor',
    title='GoodFairPoor';
INSERT IGNORE INTO list_options SET list_id='good_fair_poor',
    option_id='Good',
    title='Good',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='good_fair_poor',
    option_id='Fair',
    title='Fair',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='good_fair_poor',
    option_id='Poor',
    title='Poor',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='currently_seeing_list',
    title='Currently Seeing Providers List';
INSERT IGNORE INTO list_options SET list_id='currently_seeing_list',
    option_id='Psychiatrist',
    title='Current Psychiatrist',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='currently_seeing_list',
    option_id='Other MH provider',
    title='Current other MH provider',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='medication_info_list',
    title='Medication Information Obtained From List';
INSERT IGNORE INTO list_options SET list_id='medication_info_list',
    option_id='Client',
    title='Client',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='medication_info_list',
    option_id='Family_member',
    title='Family Member',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='medication_info_list',
    option_id='Medication_bottles',
    title='Medication Bottles',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='physical_stature',
    title='Physical Stature';
INSERT IGNORE INTO list_options SET list_id='physical_stature',
    option_id='Thin',
    title='Thin',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='physical_stature',
    option_id='Average',
    title='Average',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='physical_stature',
    option_id='Obese',
    title='Obese',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='ApparentAge',
    title='ApparentAge';
INSERT IGNORE INTO list_options SET list_id='ApparentAge',
    option_id='Younger',
    title='Younger',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='ApparentAge',
    option_id='Stated',
    title='Stated',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='ApparentAge',
    option_id='Older',
    title='Older',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Dress',
    title='Dress';
INSERT IGNORE INTO list_options SET list_id='Dress',
    option_id='Neat',
    title='Neat',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Dress',
    option_id='Casual',
    title='Casual',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Dress',
    option_id='Sloppy',
    title='Sloppy',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Dress',
    option_id='Inappropriate',
    title='Inappropriate',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Posture',
    title='Posture';
INSERT IGNORE INTO list_options SET list_id='Posture',
    option_id='Stiff',
    title='Stiff',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Posture',
    option_id='Normal',
    title='Normal',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Posture',
    option_id='Slumped',
    title='Slumped',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Posture',
    option_id='Bent',
    title='Bent',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Consciousness',
    title='Consciousness';
INSERT IGNORE INTO list_options SET list_id='Consciousness',
    option_id='Alert',
    title='Alert',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Consciousness',
    option_id='Drowsy',
    title='Drowsy',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Consciousness',
    option_id='Stuporous',
    title='Stuporous',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='MotorActivity',
    title='MotorActivity';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Calm',
    title='Calm',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Hyperactive',
    title='Hyperactive',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Agitated',
    title='Agitated',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Stereotypicmoves',
    title='Stereotypic moves',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Tics',
    title='Tics',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Hypoactive',
    title='Hypoactive',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Fidgety',
    title='Fidgety',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='MotorActivity',
    option_id='Tremors',
    title='Tremors',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Attitude',
    title='Attitude';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Cooperative',
    title='Cooperative',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Uncooperative',
    title='Uncooperative',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Relaxed',
    title='Relaxed',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Casual',
    title='Casual',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Attentive',
    title='Attentive',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Pleasant',
    title='Pleasant',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Friendly',
    title='Friendly',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Interested',
    title='Interested',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Hostile',
    title='Hostile',
    seq='90';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Defiant',
    title='Defiant',
    seq='100';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Guarded',
    title='Guarded',
    seq='110';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Defensive',
    title='Defensive',
    seq='120';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Avoidant',
    title='Avoidant',
    seq='130';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Distracted',
    title='Distracted',
    seq='140';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Aggresive',
    title='Aggresive',
    seq='150';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Dependent',
    title='Dependent',
    seq='160';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Dramatic',
    title='Dramatic',
    seq='170';
INSERT IGNORE INTO list_options SET list_id='Attitude',
    option_id='Disruptive',
    title='Disruptive',
    seq='180';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Tone',
    title='Tone';
INSERT IGNORE INTO list_options SET list_id='Tone',
    option_id='Soft',
    title='Soft',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Tone',
    option_id='Regular',
    title='Regular',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Tone',
    option_id='Loud',
    title='Loud',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Tone',
    option_id='Mumbled',
    title='Mumbled',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Rate',
    title='Rate';
INSERT IGNORE INTO list_options SET list_id='Rate',
    option_id='Decreased',
    title='Decreased',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Rate',
    option_id='Regular',
    title='Regular',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Rate',
    option_id='Increased_Pressured',
    title='Increased/Pressured',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Production',
    title='Production';
INSERT IGNORE INTO list_options SET list_id='Production',
    option_id='Decreased',
    title='Decreased',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Production',
    option_id='Regular',
    title='Regular',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Production',
    option_id='Increased_Pressured',
    title='Increased/Pressured',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Speech_Other',
    title='Speech Other';
INSERT IGNORE INTO list_options SET list_id='Speech_Other',
    option_id='Dysarthic',
    title='Dysarthic',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Speech_Other',
    option_id='Stutter',
    title='Stutter',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Speech_Other',
    option_id='Slurred',
    title='Slurred',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Speech_Other',
    option_id='Incoherent',
    title='Incoherent',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Mood',
    title='Mood';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Good',
    title='Good',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Sad_Depressed',
    title='Sad Depressed',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Irritable',
    title='Irritable',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Angry',
    title='Angry',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Apathetic',
    title='Apathetic',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Anxious',
    title='Anxious',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='Mood',
    option_id='Euphoric',
    title='Euphoric',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Affect',
    title='Affect';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Appropriate',
    title='Appropriate',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Irritable',
    title='Irritable',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Angry',
    title='Angry',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Apathetic',
    title='Apathetic',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Anxious',
    title='Anxious',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Euthymic',
    title='Euthymic',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Mood_congruent',
    title='Mood Congruent',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Inappropriate',
    title='Inappropriate',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Labile',
    title='Labile',
    seq='90';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Constricted',
    title='Constricted',
    seq='100';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Flat',
    title='Flat',
    seq='110';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Bright',
    title='Bright',
    seq='120';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Sad_Depressed',
    title='Sad/Depressed',
    seq='130';
INSERT IGNORE INTO list_options SET list_id='Affect',
    option_id='Full_range',
    title='Full range',
    seq='140';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Thought_Process',
    title='Thought Process';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Intact',
    title='Intact',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Logical',
    title='Logical',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Goal-directed',
    title='Goal-directed',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Tangential',
    title='Tangential',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Flight_of_ideas',
    title='Flight of Ideas',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Circumstantial',
    title='Circumstantial',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Derailment',
    title='Derailment Congruent',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Thought-blocking',
    title='Thought-blocking',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Concrete',
    title='Concrete',
    seq='90';
INSERT IGNORE INTO list_options SET list_id='Thought_Process',
    option_id='Perseveration',
    title='Perseveration',
    seq='100';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Hallucinations',
    title='Hallucinations';
INSERT IGNORE INTO list_options SET list_id='Hallucinations',
    option_id='Not_Present',
    title='Not Present',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Hallucinations',
    option_id='Auditory',
    title='Auditory',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Hallucinations',
    option_id='Visual',
    title='Visual',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Hallucinations',
    option_id='Olfactory',
    title='Olfactory',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='Hallucinations',
    option_id='Tactile',
    title='Tactile',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='Hallucinations',
    option_id='Somatic',
    title='Somatic',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='other_perceptual_distortions',
    title='Other Perceptual Distortions';
INSERT IGNORE INTO list_options SET list_id='other_perceptual_distortions',
    option_id='1',
    title='Illusions Present',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='other_perceptual_distortions',
    option_id='2',
    title='Depersonalization/Derealization',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='other_abnormal_thoughts',
    title='Other Abnormal Thoughts';
INSERT IGNORE INTO list_options SET list_id='other_abnormal_thoughts',
    option_id='1',
    title='Obsessive/Rumination',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='other_abnormal_thoughts',
    option_id='2',
    title='Nightmares/Flashbacks',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='delusions',
    title='Delusions';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Not_present',
    title='Not present',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Persecutory',
    title='Persecutory',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Grandiose',
    title='Grandiose',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Somatic',
    title='Somatic',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Ideas of Reference',
    title='Ideas of Reference',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Paranoid',
    title='Paranoid',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Controlled',
    title='Controlled',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='delusions',
    option_id='Other',
    title='Other',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Orientation',
    title='Orientation';
INSERT IGNORE INTO list_options SET list_id='Orientation',
    option_id='Oriented_x_4',
    title='Oriented x 4',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Orientation',
    option_id='Person',
    title='Person',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Orientation',
    option_id='Place',
    title='Place',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Orientation',
    option_id='Time',
    title='Time',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='Orientation',
    option_id='Situation',
    title='Situation',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='intact_or_impaired',
    title='Intact or Impaired';
INSERT IGNORE INTO list_options SET list_id='intact_or_impaired',
    option_id='Intact',
    title='Intact',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='intact_or_impaired',
    option_id='Impaired',
    title='Impaired',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Intelligence',
    title='Intelligence';
INSERT IGNORE INTO list_options SET list_id='Intelligence',
    option_id='Below_Avg',
    title='Below Avg.',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Intelligence',
    option_id='Average',
    title='Average',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Intelligence',
    option_id='Above_Avg',
    title='Above Avg.',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Abstraction',
    title='Abstraction';
INSERT IGNORE INTO list_options SET list_id='Abstraction',
    option_id='Intact',
    title='Intact',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Abstraction',
    option_id='Concrete',
    title='Concrete',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Abstraction',
    option_id='Impaired',
    title='Impaired',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='Insight',
    title='Insight';
INSERT IGNORE INTO list_options SET list_id='Insight',
    option_id='Poor',
    title='Poor',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='Insight',
    option_id='Average',
    title='Average',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='Insight',
    option_id='Good',
    title='Good',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='Insight',
    option_id='Age-appropriate',
    title='Age-appropriate',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='HoursPerWeek',
    title='Hours Per Week';
INSERT IGNORE INTO list_options SET list_id='HoursPerWeek',
    option_id='',
    title='',
    seq='1';
INSERT IGNORE INTO list_options SET list_id='HoursPerWeek',
    option_id='None',
    title='None',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='HoursPerWeek',
    option_id='1-9',
    title='1-9',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='HoursPerWeek',
    option_id='10-19',
    title='10-19',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='HoursPerWeek',
    option_id='20-39',
    title='20-39',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='HoursPerWeek',
    option_id='40_or_more',
    title='40 or more',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='EmploymentType',
    title='Employment Type';
INSERT IGNORE INTO list_options SET list_id='EmploymentType',
    option_id='Independent',
    title='Independent',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='EmploymentType',
    option_id='Vocational_Rehab',
    title='Vocational Rehab',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='EmploymentType',
    option_id='Supportive Employment',
    title='Supportive Employment',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='EmploymentType',
    option_id='Unemployed',
    title='Unemployed',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='EmploymentType',
    option_id='Volunteering',
    title='Volunteering',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='NeedAsssessment',
    title='Needs Assessment';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='ph',
    title='Personal Hygiene',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='ht',
    title='Household Tasks',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='csem',
    title='Coping Skills/Emotional Management',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='sfr',
    title='Social/Family Relationships',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='lr',
    title='Leisure/Recreational',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='ps',
    title='Personal Safety',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='cp',
    title='Childcare/Parenting',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='fm',
    title='Financial Management',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='cn',
    title='Cooking/Nutrition',
    seq='90';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='mmm',
    title='Medical/Med. Management',
    seq='100';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='mwc',
    title='Mobility within Community',
    seq='110';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='lbm',
    title='Literacy/Basic Math',
    seq='120';
INSERT IGNORE INTO list_options SET list_id='NeedAsssessment',
    option_id='prevoc',
    title='Prevocational',
    seq='130';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='ResourceNeeds',
    title='Resource Needs';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Housing',
    title='Housing',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Family_Social_Support',
    title='Family/Social Support',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Community_Involvement_Support',
    title='Community Involvement/Support',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Financial',
    title='Financial',
    seq='40';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Healthcare',
    title='Healthcare',
    seq='50';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Transportation',
    title='Transportation',
    seq='60';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Educational',
    title='Educational',
    seq='70';
INSERT IGNORE INTO list_options SET list_id='ResourceNeeds',
    option_id='Vocational',
    title='Vocational',
    seq='80';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='RecommendedTreatment',
    title='Recommended Treatment Modalities';
INSERT IGNORE INTO list_options SET list_id='RecommendedTreatment',
    option_id='Psychotherapy',
    title='Individual Psychotherapy',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='RecommendedTreatment',
    option_id='Family Therapy',
    title='Family Therapy',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='RecommendedTreatment',
    option_id='Group Therapy',
    title='Group Therapy',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='YesNoComboList',
    title='Yes No with text';
INSERT IGNORE INTO list_options SET list_id='YesNoComboList',
    option_id='No',
    title='No',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='YesNoComboList',
    option_id='Yes',
    title='Yes',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='lists',
    option_id='TreatmentAttitude',
    title='TreatmentAttitude';
INSERT IGNORE INTO list_options SET list_id='TreatmentAttitude',
    option_id='',
    title='',
    seq='1';
INSERT IGNORE INTO list_options SET list_id='TreatmentAttitude',
    option_id='Enthusiastic',
    title='Enthusiastic',
    seq='10';
INSERT IGNORE INTO list_options SET list_id='TreatmentAttitude',
    option_id='Cooperative',
    title='Cooperative',
    seq='20';
INSERT IGNORE INTO list_options SET list_id='TreatmentAttitude',
    option_id='Minimal',
    title='Minimal',
    seq='30';
INSERT IGNORE INTO list_options SET list_id='TreatmentAttitude',
    option_id='Unwilling',
    title='Unwilling',
    seq='30';
