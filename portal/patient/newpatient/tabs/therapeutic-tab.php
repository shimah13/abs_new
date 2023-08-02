<div class="row">
    <label>What is your primary means of finical support?</label></br>
    <?= generateRadioButtons('therap_support_list', 'therapSupportList') ?>
</div>

<div class="row" name="employeementDiv" style="display:none"></br>
    <label>Career/Industry and Where do you work?<span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="career" class="form-control"></br>
    <!-- <label>Where do you work? <span style = "color:red"> * </span></label></br>
    <input type = "text" style = "width:50%" name = "work_where" class = "form-control"></br> -->
    <label>Job Position <span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="work_position" class="form-control"></br>
    <label>Are you satisfied with your current work experience?<span style="color:red"> * </span></label></br>
    <input type="radio" name="work_exp" value="yes"> Yes</br>
    <input type="radio" name="work_exp" value="no"> No</br>
    <label>How long have you worked there? <span style="color:red"> * </span></label></br>
    <select name="how_long" class="form-control" style="width:50%">
        <option value="less_1">Less than 1 year</option>
        <option value="1_3">1 - 3 years</option>
        <option value="3_5">3 - 5 years</option>
        <option value="more_5">More than 5 years</option>
    </select></br>
</div>

<div class="row" style="display:none" name="unemployeementDiv">
    <label>How long have you been unemployed? <span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="how_long_unemployeed" class="form-control"></br>
    <label>Reason for unemployment <span style="color:red"> * </span></label></br>
    <textarea name="reason_unemployee"></textarea>
</div>

<div class="row" style="display:none" name="publicAssistanceDiv">
    <label>How long have you been receiving assistance? <span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="receiving_assistance" class="form-control"></br>
</div>

<div class="row" style="display:none" name="ssi_ssd_div">
    <label>What is your disability? <span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="ssi_ssd" class="form-control"></br>
</div>

<div class="row" style="display:none" name="family_sup_div">
    <label>Who in your family do you receive support from? <span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="family_support" class="form-control"></br>
</div>

<div class="row">
    <label>Education Level</label></br>
    <?= generateRadioButtons('education_list', 'education_level_list') ?>
</div>

<div class="row" name="college_list_div" style="display:none">
    <?= generateDropdown('college_list', 'college_list') ?>
    </select>
</div>

<div class="row">
    <label>Family Composition</label></br>
    <label>Which best describes your relationship status?<span style="color:red"> * </span></label></br>
    <?= generateRadioButtons('fam_relationship_list', 'fam_relationship_list') ?>
</div>

<div class="row" name="DivorcedDiv" style="display:none">
    <label>How many times have you been married?</label></br>
    <input type="text" name="how_many_married" class="form-control" style="width:50%"></br>
    <label>What are your ex partner('s) name(s)<span style="color:red"> * </span></label></br>
    <input type="text" name="ex_partner_name" class="form-control" style="width:50%"></br>
</div>

<div class="row" name="currentMarriedDiv" style="display:none">
    <label>What is your spouse's name?<span style="color:red"> * </span></label></br>
    <input type="text" name="spouse_name" class="form-control" style="width:50%"></br>
</div>

<div class="row" name="lastRelationShipDiv" style="display:none">
    <label>When was your last relationship?<span style="color:red"> * </span></label></br>
    <input type="text" name="last_relationship" class="form-control" style="width:50%"></br>
</div>

<div class="row">
    <label>Household Members</label></br>
    <label>Who do you live with?<span style="color:red"> * </span></label><br>
    <?= generateCheckBox('who_live_with', 'who_live_with') ?>
</div>

<div class="row">
    <label>Children</label></br>
    <label>How many children/step children do you have in total?<span style="color:red"> * </span></label><br>
    <?= generateDropdown('how_many_children', 'how_many_children') ?>
    </select>
</div>
<div class="row" name="children_custody_list_div">
</div>

<!-- family composition -->
<div class="row">
    <!-- <label>Family Composition</label></br> -->
    <label>Is a member of your family supportive of your recovery/treatment? <span style="color:red"> * </span></label></br>
    <input type="radio" name="fam_support_recovery" value="yes"> Yes</br>
    <input type="radio" name="fam_support_recovery" value="no"> No</br>
</div>

<div class="row" name="fam_support_recovery_div" style="display:none">
    <label>Would your family members be willing to participate in your treatment? <span style="color:red"> * </span></label></br>
    <input type="radio" name="fam_mem_willing_part" value="yes"> Yes</br>
    <input type="radio" name="fam_mem_willing_part" value="no"> No</br>
</div>

<div class="row" name="fam_mem_willing_part_div" style="display:none">
    <label>What is the name of the family member that will participate in your treatment?<span style="color:red"> * </span></label></br>
    <input type="text" name="fam_mem_part_name" class="form-control" style="width:50%"></br>
    <label>What is their relationship to you?<span style="color:red"> * </span></label></br>
    <input type="text" name="fam_mem_part_relation" class="form-control" style="width:50%"></br>
    <label>What is their phone number?<span style="color:red"> * </span></label></br>
    <input type="text" name="fam_mem_part_ph" class="form-control" style="width:50%"></br>
</div>

<div class="row">
    <label>Family Composition</label></br>
    <label>Is there any family history of substance abuse or mental illness?<span style="color:red"> * </span></label></br>
    <input type="radio" name="fam_sub_abuse" value="yes"> Yes</br>
    <input type="radio" name="fam_sub_abuse" value="no"> No</br>
</div>

<div class="row" style="display:none" name="fam_sub_abuse_div">
    <label>Please explain the family history of substance abuse or mental illness<span style="color:red"> * </span></label></br>
    <textarea name="sub_abuse_explanation" class="form-control"></textarea></br>
</div>

<div class="row">
    <label>Primary care doctor</label></br>
    <label>Do you have a primary care doctor?<span style="color:red"> * </span></label></br>
    <input type="radio" name="primary_care_doc" value="yes"> Yes</br>
    <input type="radio" name="primary_care_doc" value="no"> No</br>
</div>

<div class="row" name="primary_care_doc_div" style="display:none">
    <label>What is your primary care Doctor's Name?<span style="color:red"> * </span></label></br>
    <input type="text" name="pri_doc_name" class="form-control" style="width:50%"></br>
    <label>What is your primary care doctor's phone number?</label></br>
    <input type="text" name="pri_doc_ph" class="form-control" style="width:50%"></br>
</div>

<div class="row">
    <label>Physical Health</label></br>
    <label>What do you consider your current health? (Including physical and mental health)<span style="color:red"> * </span></label></br>
    <input type="radio" name="curr_health" value="good"> Good</br>
    <input type="radio" name="curr_health" value="fair"> Fair</br>
    <input type="radio" name="curr_health" value="poor"> Poor</br>
</div>

<div class="row" name="curr_health_good_div" style="display:none">
    <label>Please list any past medical conditions, procedures, surgeries or injuries you have had.</label></br>
    <textarea name="surgeries_details" class="form-control"></textarea></br>
</div>

<div class="row" name="curr_health_fair_div" style="display:none">
    <label>What are your current medical conditions that you are aware of?<span style="color:red"> * </span></label></br>
    <textarea name="med_condition_details" class="form-control"></textarea></br>
    <label>Are you currently prescribed medications from a doctor?<span style="color:red"> * </span></label></br>
    <input type="radio" name="curr_pres_med" value="yes"> Yes</br>
    <input type="radio" name="curr_pres_med" value="no"> No</br>

    <div name="curr_pre_med_div" style="display:none">
        <label>Please list the doctor-prescribed medications as well as dosages<span style="color:red"> * </span></label></br>
        <textarea name="curr_pre_med_details" class="form-control"></textarea></br>
        <label>Do you take your medication as prescribed?<span style="color:red"> * </span></label></br>
        <input type="radio" name="do_you_take_med_as_pres" value="yes"> Yes</br>
        <input type="radio" name="do_you_take_med_as_pres" value="no"> No</br>

        <div name="do_you_take_med_as_pres_div" style="display:none">
            <label>Please explain why you don't take your medications as prescribed<span style="color:red"> * </span></label></br>
            <textarea name="do_you_take_med_as_pres_details" class="form-control"></textarea></br>
        </div>

    </div>

    <label>Have you had any recent hospitalization?<span style="color:red"> * </span></label></br>
    <input type="radio" name="recent_hospitalization" value="yes"> Yes</br>
    <input type="radio" name="recent_hospitalization" value="no"> No</br>
    <div class="row" style="display:none" name="recent_hospitalizationDiv">
        <label>What where you treated for during your last hospitalization?</label></br>
        <textarea name="other_health_concern_details" class="form-control"></textarea></br>
    </div>
</div>

<div class="row">
    <label>Reason for Referral to ABS</label></br>

    <!-- <label>What ABS program(s) are you interested in or being referred to?</label></br>
    <?= generateCheckBox('being_referred_to', 'being_referred_to') ?> -->

</div>

<div class="row">
    <label>What are the reasons you are being referred for services & what ABS program(s) are you interested in enrolling in?</label></br>
    <?= generateCheckBox('being_referred_for_services', 'being_referred_for_service') ?>
</div>

<div class="row" name="being_rf_for_services_anger_mgmt_div" style="display:none">
    <label>When was the last time you were in an argument or domestic dispute?<span style="color:red"> * </span></label></br>
    <?= generateRadioButtons('argument_domestic_dispute_list', 'anger_mgmt_time_list') ?>
    <label>Were you ever in a physical confrontation or fight?<span style="color:red"> * </span></label><br>
    <input type="radio" name="physical_confrontation" value="yes"> Yes</br>
    <input type="radio" name="physical_confrontation" value="no"> No</br>

    <div name="physical_confrontationDiv" style="display:none">
        <label>Who were you fighting with?<span style="color:red"> * </span></label><br>
        <?= generateRadioButtons('fighting_with', 'fighting_with') ?>
    </div>

    <label>Have you ever physically hurt or injured someone?<span style="color:red"> * </span></label><br>
    <input type="radio" name="physically_hurt" value="yes"> Yes</br>
    <input type="radio" name="physically_hurt" value="no"> No</br>
    <div name="injuriesSustainDiv" style="display:none">
        <label>What injuries did they sustain?<span style="color:red"> * </span></label><br>
        <textarea name="injurySusDetail" class="form-control"></textarea>
    </div>
    <label>Were you ever arrested for a violent crime?<span style="color:red"> * </span></label><br>
    <input type="radio" name="arrested_violent_crime" value="yes"> Yes</br>
    <input type="radio" name="arrested_violent_crime" value="no"> No</br>
    <label>Has impulsive anger or aggression caused you other problems in your life? <span style="color:red"> * </span></label><br>
    <?= generateCheckBox('anger_or_agression_caused', 'anger_or_agression_caused') ?>
</div>

<!-- Alcohol div -->
<div class="row" style="display:none" name="alcohol_drug_abuse_div">
    <label>How often do you have a drink containing alcohol?</label></br>
    <?= generateRadioButtons('drug_consumption_duration', 'dring_contain_alc') ?>

    <label>How many standard drinks containing alcohol do you have on a typical day when drinking?</label></br>
    <?= generateRadioButtons('std_drink_contain_alcohol', 'when_drink_drings') ?>

    <label>How often do you have six or more drinks on one occasion</label></br>
    <?= generateRadioButtons('how_often_drink', 'occasional_drinks') ?>

    <label>During the past year, how often have you found that you were not able to stop drinking once you had started?</label></br>
    <?= generateRadioButtons('how_often_drink', 'how_often_stop_drink') ?>

    <label>During the past year, how often have you failed to do what was normally expected of you because of drinking?</label></br>
    <?= generateRadioButtons('how_often_drink', 'how_often_failed_stop_drink') ?>

    <label>During the past year, how often have you needed a drink in the morning to get yourself going after a heavy drinking session?</label></br>
    <?= generateRadioButtons('how_often_drink', 'how_often_need_drink') ?>

    <label>During the past year, how often have you had a feeling of guilt or remorse after drinking?</label></br>
    <?= generateRadioButtons('how_often_drink', 'remorse_after_drink') ?>

    <label>During the past year, how often have you been unable to remember what happened the night before because you had been drinking?</label></br>
    <?= generateRadioButtons('how_often_drink', 'unable_remember_night_session') ?>

    <label>Have you or someone else been injured as a result of your drinking?</label></br>
    <input type="radio" name="injured_result_drink" value="no"> No</br>
    <input type="radio" name="injured_result_drink" value="yes_not_in_past_year"> Yes, but not in the past year</br>
    <input type="radio" name="injured_result_drink" value="yes_during_year"> Yes, during the past year</br>

    <label>Has a relative or friend, doctor or other health worker beeen concerned about your drinking or suggested you cut down?</label></br>
    <input type="radio" name="concerned_about_drink" value="no"> No</br>
    <input type="radio" name="concerned_about_drink" value="yes_not_in_past_year"> Yes, but not in the past year</br>
    <input type="radio" name="concerned_about_drink" value="yes_during_year"> Yes, during the past year</br>

    <label>What are your drugs of choice? Please list all.</label></br>
    <?= generateCheckBox('drug_choices', 'drugs_of_chioces') ?>

    <label>How old were you the first time you used?</label></br>
    <input type="text" name="first_time_used" value="" class="form-control" style="width:50%"></br>

    <label>How much did you use at the height of your usage?</label></br>
    <input type="text" name="height_of_usage" value="" class="form-control" style="width:50%"></br>

    <label>Have you ever been in alcohol or drug treatment before?</label></br>
    <input type="radio" name="ever_been_in_alcohol" value="yes"> Yes</br>
    <input type="radio" name="ever_been_in_alcohol" value="no"> No</br>

</div>

<div class="row" style="display:none" name="dwi_dui_div">
    <label>How many drinking and driving offenses have you had?</label></br>
    <input type="text" name="how_drink_drive_offence" class="form-control" style="width:50%"></br>

    <label>Have you ever been in drug treatment before?</label></br>
    <input type="radio" name="drug_treat_before_ever" value="yes"> Yes</br>
    <input type="radio" name="drug_treat_before_ever" value="no"> No</br>
</div>

<div class="row" style="display:none" name="gam_pblm_div">
    <label>Gambling - Please check all that apply</label><span style="color:red"> * </span></br>
    <?= generateCheckBox('gam_pblm_list', 'gamList') ?>
</div>


<div class="row" style="display:none" name="sex_behav_div">
    <label>Are you currently sexually active? </label><span style="color:red">*</span></br>
    <input type="radio" name="sex_active" value="yes"> Yes</br>
    <input type="radio" name="sex_active" value="no"> No</br>
    <label>What is your sexual preference</label><span style="color:red">*</span></br>
    <?= generateRadioButtons('sexual_orientation', 'sex_preference') ?>
    <label>Are you satisfied with your sexual identity?</label><span style="color:red">*</span></br>
    <input type="radio" name="satisfied_sex_identity" value="yes"> Yes</br>
    <input type="radio" name="satisfied_sex_identity" value="no"> No</br>
    <label>Have you ever been charged with a sex crime?</label><span style="color:red">*</span></br>
    <input type="radio" name="charged_sex_crime" value="yes"> Yes</br>
    <input type="radio" name="charged_sex_crime" value="no"> No</br>
    <label>Have you ever had any other problems in your life as a result of impulsive sexual behavior such as the following?</label></br>
    <?= generateCheckBox('impulsive_sex_behave', 'impulsive_sex_behave') ?>
</div>


<div class="row" style="display:none" name="domestic_violence_div"></br>
    <label>When was the last time you were in an argument or domestic dispute?<span style="color:red"> * </span></label></br>
    <?= generateRadioButtons('argument_domestic_dispute_list', 'domestic_violence') ?>
    <label>Were you ever in a physical confrontation or fight?<span style="color:red"> * </span></label></br>
    <input type="radio" name="phy_confrintation" value="yes"> Yes </br>
    <input type="radio" name="phy_confrintation" value="no"> No </br>
    <label>Have you ever physically hurt or injured someone?<span style="color:red"> * </span></label></br>
    <input type="radio" name="phy_hurt" value="yes"> Yes </br>
    <input type="radio" name="phy_hurt" value="no"> No </br>
    <label>Were you ever arrested for a violent crime?<span style="color:red"> * </span></label></br>
    <input type="radio" name="ever_arrested_violent_crime" value="yes"> Yes </br>
    <input type="radio" name="ever_arrested_violent_crime" value="no"> No </br>
    <label>Has impulsive anger or aggression caused you other problems in your life?<span style="color:red"> * </span></label></br>
    <?= generateCheckBox('domestic_violence_list', 'domestic_violence_list') ?>
</div>

<div class="row" style="display:none" name="parenting_issues_div"></br>
    <label>Please explain the parenting issues</label></br>
    <textarea class="form-control" name="explain_parenting_issue"></textarea></br>
</div>

<div class="row" style="display:none" name="non_chemical_addiction_div"></br>
    <label>Please explain your non-chemical addiction</label></br>
    <textarea class="form-control" name="non_chemical_addiction"></textarea></br>
</div>

<div class="row">
    <label>Suicidal Thoughts</label></br>
    <label>Have you ever had any suicidal thinking or thoughts of hurting/killing yourself?<span style="color:red"> * </span></label></br>
    <?= generateRadioButtons('Intake_suicide', 'Intake_suicide') ?>
</div>

<div class="row" style="display:none" name="last_attempt_explanation_div">
    <label>Please explain the method and when the last attempt was<span style="color:red"> * </span></label></br>
    <textarea class="form-control"></textarea></br>
</div>

<div class="row" style="display:none" name="felt_inclined_div">
    <label>When was the last time you felt inclined to harm yourself?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="felt_inclined_harm" value="today"> Today
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="felt_inclined_harm" value="past_2_weeks"> Within the past 2 weeks
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="felt_inclined_harm" value="past_12_month"> Within the past 12 months
        </label>
    </div>
</div>

<div class="row" style="display:none" name="feelings_explanation_div">
    <label>Please explain the best you can the thoughts and feelings you were or are having.<span style="color:red"> * </span></label></br>
    <textarea class="form-control"></textarea></br>
</div>

<div class="row">
    <label>Legal History</label></br>
    <label>Have you ever been arrested?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="arrested_ever" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="arrested_ever" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="arrested_ever_yes_div">
    <label>How many times have you been arrested?<span style="color:red"> * </span></label></br>
    <?= generateDropdown('how_many_arrest', 'how_many_arrest') ?>
</div>

<div class="row" style="display:none" name="arrested_explanation_div">
    <label>Please explain the best you can. What charges were you arrested for? What year did the charges occur? What was the outcome of the charges?<span style="color:red"> * </span></label></br>
    <textarea class="form-control"></textarea></br>
</div>

<div class="row" style="display:none" name="monitoring_agency_div">
    <label>Are you being supervised or monitored by any monitoring agency such as: Parole, Probation or other monitoring program?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="monitor_agency" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="monitor_agency" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="sentence_length_div">
    <label>How long is your sentence to supervision?<span style="color:red"> * </span></label></br>
    <?= generateDropdown('How_long_is_your_sentence_to_supervision_', 'sentence_length') ?>
</div>

<div class="row" style="display:none" name="incarceration_div">
    <label>Have you ever been incarcerated?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="incarcerated" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="incarcerated" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="incarcerated_length_div">
    <label>If yes how many times incarcerated?<span style="color:red"> * </span></label></br>
    <?= generateDropdown('how_many_arrest', 'incarcerated_length') ?>
</div>

<div class="row" style="display:none" name="incarcerated_years_div">
    <label>How long, in total, have you spent incarcerated?<span style="color:red"> * </span></label></br>
    <?= generateDropdown('How_long_is_your_sentence_to_supervision_', 'incarcerated_years') ?>
</div>

<div class="row" style="display:none" name="protection_orders_div">
    <label>Are there any orders of protection against you?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="protection_orders" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="protection_orders" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="state_registry_div">
    <label>Are you listed on any state registry?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="state_registry" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="state_registry" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="state_registry_list_div">
    <label>If yes, which state registry?<span style="color:red"> * </span></label></br>
    <?= generateDropdown('State_Registry', 'state_registry_list') ?>
</div>

<div class="row" style="display:none" name="sex_offender_div">
    <label>If sex offender registry, choose level:<span style="color:red"> * </span></label></br>
    <?= generateDropdown('Sex_Offender', 'sex_offender') ?>
</div>

<div class="row">
    <label>Trauma History</label></br>
    <label>Have you ever experienced sexual/verbal/physical abuse and/or trauma?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="exp_ver_phy_abuse" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="exp_ver_phy_abuse" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="victimDiv">
    <label>What were you a victim of?<span style="color:red"> * </span></label></br>
    <?= generateCheckBox('Intake_Victim', 'Intake_Victim') ?>
    <label>Please explain anything checked above.</label></br>
    <textarea class="form-control" name="explain_victim"></textarea>
</div>

<div class="row">
    <label>Mental Health</label></br>
    <label>Have you ever received psychotherapy or mental health treatment before?<span style="color:red"> * </span></label>
    <div class="radio">
        <label>
            <input type="radio" name="mental_health_treat" value="yes"> Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="mental_health_treat" value="no"> No
        </label>
    </div>
</div>

<div class="row" style="display:none" name="mentalHealthYesDiv">
    <label>What mental health conditions were you treated for previously?<span style="color:red"> * </span></label></br>
    <input type="text" class="form-control" name="mentalHealthCondition"></br>
    <label>What kind of mental health treatment did you undergo?<span style="color:red"> * </span></label></br>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="mentalHealthTreatment[]" value="inpatient"> Inpatient
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="mentalHealthTreatment[]" value="outpatient"> Outpatient
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="mentalHealthTreatment[]" value="partialHospitaliation"> Partial hospitalization
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="mentalHealthTreatment[]" value="dayTreatment"> Day treatment
        </label>
    </div>
</div>

<div class="row" style="display:none" name="inPatientDiv">
    <label>How many times were you hospitalized for mental health? When was the last inpatient hospitalization? What was the condition you were treated for? Please explain the treatment?</label>
    <textarea class="form-control" name="inpatient_treatment_consist"></textarea></br>
</div>

<div class="row" style="display:none" name="outPatientDiv">
    <label>About when was your last outpatient treatment episode?</label></br>
    <input type="text" class="form-control datepicker" name="date_treat_outputpatient" style="width:50%"></br>
    <label>What type of outpatient treatment did you receive?</label></br>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="outpatient_treatment[]" value="Psychotherapy"> Psychotherapy
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="outpatient_treatment[]" value="family_therapy"> Family Therapy
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="outpatient_treatment[]" value="medication"> Medication
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="outpatient_treatment[]" value="other"> Other
        </label>
    </div>
    <label>Who was your outpatient therapist/doctor?</label></br>
    <input type="text" value="" name="therapist_doc" class="form-control" style="width:50%"></br>
    <label>Current and past medication use including dosage? When was the last time you took the prescribed medication?</label></br>
    <textarea class="form-control" name="prescribed_medication"></textarea>
</div>

<div class="row" style="display:none" name="partialHospitalDiv">
    <label>Partial Hospitalization - Name of program, date of last treatment?</label></br>
    <input type="text" class="form-control datepicker" name="name_pgm_last_treat" style="width:50%"></br>
</div>

<div class="row" style="display:none" name="dayTreatmentDiv">
    <label>Name of day treatment program, date of last treatment?</label></br>
    <input type="text" class="form-control datepicker" name="day_treat_name" style="width:50%"></br>
</div>


<div class="row" style="display:none" name="mentalHealthNoDiv">
    <label>Please explain what your current primary mental health concerns are and what is motivation to seek help?</label></br>
    <textarea name="explain_primary_mentalHealth" class="form-control"></textarea>
</div>

