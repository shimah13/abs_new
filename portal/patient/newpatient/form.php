<?php
include_once('./formUI.php');
$pid = $_REQUEST['pid'];
?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

</head>

<body>
    <div id="tabs">
        <ul>
            <li><a href="#referral_tab">Referral Form</a></li>
            <li><a href="#therapeutic_tab">Therapeutic Form</a></li>
            <!-- <li><a href="#medical_history_tab">Medical History</a></li> -->
            <li><a href="#notice_practice_tab">Notice of practice policies</a></li>
            <li><a href="#release_tab">Informed Consent For The Release Of Information</a></li>
        </ul>
        <div>
            <div class="panel-body p-0">
                <div class="tab-content">
                    <div id="referral_tab" class="tab-pane">
			<form id="referralForm" method="POST">
			    <input type = "hidden" name = "referralTab" value = "referralForm">
                            <?php referralTab($pid); ?>
                            <button type="button" class="submit btn btn-primary">Save &amp; Continue</button>
                        </form>
                    </div>
                    <div id="therapeutic_tab" class="tab-pane">
			<form id="therapeuticForm" method="POST">
			    <input type = "hidden" name = "therapeuticTab" value = "therapeuticForm">
                            <?php therapeuticTab($pid); ?>
                            <button type="button" class="submit btn btn-primary">Save &amp; Continue</button>
                        </form>
                    </div>
                    <!-- <div id="medical_history_tab" class="tab-pane">
                        <form id="medicalHistoryForm" method="POST">
                            <?php // medicalHistoryTab($pid); ?>
                            <button type="button" class="submit btn btn-primary">Save &amp; Continue</button>
                        </form>
                    </div> -->
                    <div id="notice_practice_tab" class="tab-pane">
                        <form id="noticePracticeForm" method="POST">
                            <?php noticePracticeTab($pid); ?>
                            <button type="button" class="submit btn btn-primary">Save &amp; Continue</button>
                        </form>
                    </div>
                    <div id="release_tab" class="tab-pane">
                        <form id="releaseForm" method="POST">
                            <?php releaseTab($pid); ?>
                            <button type="button" class="submit btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        $("#tabs").tabs({
            active: 0
        });

        $('#tabs li').click(function() {
            var data = $(this).find('a').attr('href');
            if (data == "#release_tab") {
                // Change authority name
            }
        });

        $('.datepicker').datepicker({
            maxDate: 0
        });

        $('#referralForm button.submit').on('click', function() {
            $.ajax({
                type: 'POST',
                url: './formAjax.php',
                data: $('#referralForm').serialize(),
                success: function(data) {
                    $("#tabs").tabs({
                        active: 1
                    });
                }
            });
        });

        $('#therapeuticForm button.submit').on('click', function() {
            $.ajax({
                type: 'POST',
                url: './formAjax.php',
                data: $('#therapeuticForm').serialize(),
                success: function(data) {
                    $("#tabs").tabs({
                        active: 2
                    });
                }
            });
        });

        $("#medicalHistoryForm button.submit").on('click', function() {
            $.ajax({
                type: 'post',
                url: './formAjax.php',
                data: $('#medicalHistoryForm').serialize(),
                success: function(data) {
                    $("#tabs").tabs({
                        active: 3
                    })
                }
            });
        });

        $('#noticePracticeForm button.submit').on('click', function() {
            $.ajax({
                type: 'POST',
                url: './formAjax.php',
                data: $('#noticePracticeForm').serialize(),
                success: function(data) {
                    $("#tabs").tabs({
                        active: 3
                    });
                }
            });
        });

        $('#releaseForm button.submit').on('click', function() {
            $.ajax({
                type: 'post',
                url: './formAjax.php',
                data: $('#releaseForm').serialize(),
                success: function(data) {
                    $("#tabs").tabs({
                        active: 3
                    })
                }
            });
        });

        $('input[name=payment_ifo]').on('change', function() {
            if ($(this).val() == 'med_insu') {
                $('div[name=insuranceComDiv]').css('display', 'block');
            } else {
                $('div[name=insuranceComDiv]').css('display', 'none');
            }
            console.log($(this).val());
            if ($(this).val() == 'Eap') {
                $('div[name=eapDiv]').css('display', 'block');
            } else {
                $('div[name=eapDiv]').css('display', 'none');
            }
        });

        $('input[name^=Who_Referred_You_to_ABS_]').on('change', function() {
            const referersAndDivs = [{
                    value: 'Patient',
                    div: 'lawyerDiv'
                },
                {
                    value: 'Employee',
                    div: 'childwelfareDiv'
                },
                {
                    value: 'Court',
                    div: 'courtDiv'
                },
                {
                    value: 'Walk-In',
                    div: 'DMVDiv'
                },
                {
                    value: 'Newspaper',
                    div: 'probationDiv'
                },
                {
                    value: 'Radio',
                    div: 'doctorDiv'
                },
                {
                    value: 'T.V.',
                    div: 'eapDiv'
                },
                {
                    value: 'hospital',
                    div: 'hospitalDiv'
                },
                {
                    value: 'Direct Mail',
                    div: 'newyorkPblmGambDiv'
                },
                {
                    value: 'Coupon',
                    div: 'paroleDiv'
                },
                {
                    value: 'Referral Card',
                    div: 'socialWorkerDiv'
                },
            ];

            var referer = this;

            referersAndDivs.forEach(function(item) {
                var div = $('div[name=' + item.div + ']')
                if ($(referer).val() === item.value) {
                    var checked = $(referer).is(':checked');
                    div.css('display', checked ? 'block' : 'none');
                }
            });
        });

        $('input[name=countyName]').on('change', function() {
            $('div.county_courts').css('display', 'none');
            var div = $('div.county_courts[name="' + $(this).val() + '"]').css('display', 'block');
        });

        $('input[name="treatment_plan"]').attr('disabled', true);
        $('input[name="intake_diagnoses"]').on('change', function() {
            $('input[name="treatment_plan"]').attr('disabled', false);
            var plan = $(this).val().split('|');
            if (plan.length > 0) {
                plan = plan[0];
            }
            $('input[name="treatment_plan"][value="' + plan + '"]').attr('checked', true);
            $('input[name="treatment_plan"]:not(:checked)').attr('disabled', true);
        });

        $(document).on('change', 'select[name=living_environment]', function() {
            if ($(this).val() == 'apartment') {
                $('div[name=aptnumber]').css('display', 'block');
            } else
                $('div[name=aptnumber]').css('display', 'none');

            if ($(this).val() == '3_quater') {
                $('div[name=quaHouse]').css('display', 'block');
            } else
                $('div[name=quaHouse]').css('display', 'none');

            if ($(this).val() == 'half_way') {
                $('div[name=halfHouse]').css('display', 'block');
            } else
                $('div[name=halfHouse]').css('display', 'none');

            if ($(this).val() == 'Shelter') {
                $('div[name=shelterName]').css('display', 'block');
            } else
                $('div[name=shelterName]').css('display', 'none');
        });

        $(document).on('change', 'input[name^=therapSupportList]', function() {
            if ($(this).val() == 'employeement') {
                $('div[name=employeementDiv]').css('display', 'block');
            } else {
                $('div[name=employeementDiv]').css('display', 'none');
            }

            if ($(this).val() == 'unemployeement') {
                $('div[name=unemployeementDiv]').css('display', 'block');
            } else {
                $('div[name=unemployeementDiv]').css('display', 'none');
            }

            if ($(this).val() == 'pub_assistance') {
                $('div[name=publicAssistanceDiv]').css('display', 'block');
            } else {
                $('div[name=publicAssistanceDiv]').css('display', 'none');
            }

            if ($(this).val() == 'fam_support') {
                $('div[name=family_sup_div]').css('display', 'block');
            } else {
                $('div[name=family_sup_div]').css('display', 'none');
            }

            if ($(this).val() == 'ssi_ssd') {
                $('div[name=ssi_ssd_div]').css('display', 'block');
            } else {
                $('div[name=ssi_ssd_div]').css('display', 'none');
            }

        });
        $(document).on('change', 'input[name^=education_level_list]', function() {
            if ($(this).val() == 'college') {
                $('div[name=college_list_div]').css('display', 'block');
            } else {
                $('div[name=college_list_div]').css('display', 'none');
            }

        });

        $(document).on('change', 'input[name^=fam_relationship_list]', function() {
            if ($(this).val() == 'Divorced' || $(this).val() == 'Widowed') {
                $('div[name=DivorcedDiv]').css('display', 'block');
            } else {
                $('div[name=DivorcedDiv]').css('display', 'none');
            }

            if ($(this).val() == 'currently_married') {
                $('div[name=currentMarriedDiv]').css('display', 'block');
            } else {
                $('div[name=currentMarriedDiv]').css('display', 'none');
            }

            if ($(this).val() == 'single_never_married') {
                $('div[name=lastRelationShipDiv]').css('display', 'block');
            } else {
                $('div[name=lastRelationShipDiv]').css('display', 'none');
            }

        });
        $(document).on('change', 'select[name^=how_many_children]', function() {
            $.ajax({
                type: 'post',
                url: 'formUI.php?fn=getChildrenOptionList',
                data: {
                    'count': $(this).val()
                },
                success: function(data) {
                    $('div[name=children_custody_list_div]').empty();
                    $('div[name=children_custody_list_div]').append(data);
                }
            });
        });

        $(document).on('change', 'input[name^=fam_support_recovery]', function() {
            if ($(this).val() == 'yes') {
                $("div[name=fam_support_recovery_div]").css('display', 'block');
            } else {
                $("div[name=fam_support_recovery_div]").css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=fam_mem_willing_part]', function() {
            if ($(this).val() == 'yes') {
                $("div[name=fam_mem_willing_part_div]").css('display', 'block');
            } else {
                $("div[name=fam_mem_willing_part_div]").css('display', 'none');
            }
        });


        $(document).on('change', 'input[name^=fam_sub_abuse]', function() {
            if ($(this).val() == 'yes') {
                $("div[name=fam_sub_abuse_div]").css('display', 'block');
            } else {
                $("div[name=fam_sub_abuse_div]").css('display', 'none');
            }
        });


        $(document).on('change', 'input[name^=primary_care_doc]', function() {
            if ($(this).val() == 'yes') {
                $("div[name=primary_care_doc_div]").css('display', 'block');
            } else {
                $("div[name=primary_care_doc_div]").css('display', 'none');
            }
        });


        $(document).on('change', 'input[name^=curr_health]', function() {
            if ($(this).val() == 'good') {
                $("div[name=curr_health_good_div]").css('display', 'block');
                $("div[name=curr_health_fair_div]").css('display', 'none');
            } else if ($(this).val() == 'fair' || $(this).val() == 'poor') {
                $("div[name=curr_health_good_div]").css('display', 'block');
                $("div[name=curr_health_fair_div]").css('display', 'block');
            }
        });


        $(document).on('change', 'input[name^=curr_pres_med]', function() {
            if ($(this).val() == 'yes') {
                $("div[name=curr_pre_med_div]").css('display', 'block');
            } else
                $("div[name=curr_pre_med_div]").css('display', 'none');
        });
        $(document).on('change', 'input[name^=do_you_take_med_as_pres]', function() {
            if ($(this).val() == 'no') {
                $("div[name=do_you_take_med_as_pres_div]").css('display', 'block');
            } else
                $("div[name=do_you_take_med_as_pres_div]").css('display', 'none');
        });


        $(document).on('change', 'input[name^=being_referred_for_services]', function() {
            if ($(this).val() == 'anger_mgmt' && $(this).is(':checked')) {
                $('div[name=being_rf_for_services_anger_mgmt_div]').css('display', 'block');
            } else if ($(this).val() == 'anger_mgmt' && !($(this).is(':checked'))) {
                $('div[name=being_rf_for_services_anger_mgmt_div]').css('display', 'none');
            }

            if ($(this).val() == 'alcohol_drug' && $(this).is(':checked')) {
                $('div[name=alcohol_drug_abuse_div]').css('display', 'block');
            } else if ($(this).val() == 'alcohol_drug' && !($(this).is(':checked'))) {
                $('div[name=alcohol_drug_abuse_div]').css('display', 'none');
            }

            if ($(this).val() == 'dwi_dui' && $(this).is(':checked')) {
                $('div[name=dwi_dui_div]').css('display', 'block');
            } else if ($(this).val() == 'dwi_dui' && !($(this).is(':checked'))) {
                $('div[name=dwi_dui_div]').css('display', 'none');
            }
            if ($(this).val() == 'gam_pblm' && $(this).is(':checked')) {
                $('div[name=gam_pblm_div]').css('display', 'block');
            } else if ($(this).val() == 'gam_pblm' && !($(this).is(':checked'))) {
                $('div[name=gam_pblm_div]').css('display', 'none');
            }
            if ($(this).val() == 'sex_behav' && $(this).is(':checked')) {
                $('div[name=sex_behav_div]').css('display', 'block');
            } else if ($(this).val() == 'sex_behav' && !($(this).is(':checked'))) {
                $('div[name=sex_behav_div]').css('display', 'none');
            }
            if ($(this).val() == 'domestic_violence' && $(this).is(':checked')) {
                $('div[name=domestic_violence_div]').css('display', 'block');
            } else if ($(this).val() == 'domestic_violence' && !($(this).is(':checked'))) {
                $('div[name=domestic_violence_div]').css('display', 'none');
            }

            if ($(this).val() == 'parent_issue' && $(this).is(':checked')) {
                $('div[name=parenting_issues_div]').css('display', 'block');
            } else if ($(this).val() == 'parent_issue' && !($(this).is(':checked'))) {
                $('div[name=parenting_issues_div]').css('display', 'none');
            }

            if ($(this).val() == 'non_checm_addiction' && $(this).is(':checked')) {
                $('div[name=non_chemical_addiction_div]').css('display', 'block');
            } else if ($(this).val() == 'non_checm_addiction' && !($(this).is(':checked'))) {
                $('div[name=non_chemical_addiction_div]').css('display', 'none');
            }

        });

        $(document).on('change', 'input[name^=physically_hurt]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=injuriesSustainDiv]').css('display', 'block');
            } else {
                $('div[name=injuriesSustainDiv]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=physical_confrontation]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=physical_confrontationDiv]').css('display', 'block');
            } else {
                $('div[name=physical_confrontationDiv]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=Intake_suicide]', function() {
            if ($(this).val() == 'attemptedsuicide') {
                $('div[name=last_attempt_explanation_div]').css('display', 'block');
                $('div[name=felt_inclined_div]').css('display', 'block');
                $('div[name=feelings_explanation_div]').css('display', 'none');
            } else if ($(this).val() == 'suicidalthoughts') {
                $('div[name=last_attempt_explanation_div]').css('display', 'none');
                $('div[name=felt_inclined_div]').css('display', 'block');
                $('div[name=feelings_explanation_div]').css('display', 'block');
            } else {
                $('div[name=last_attempt_explanation_div]').css('display', 'none');
                $('div[name=felt_inclined_div]').css('display', 'none');
                $('div[name=feelings_explanation_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=arrested_ever]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=arrested_ever_yes_div]').css('display', 'block');
            } else {
                $('div[name=arrested_ever_yes_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'select[name^=how_many_arrest]', function() {
            if ($(this).val() != '') {
                $('div[name=arrested_explanation_div]').css('display', 'block');
                $('div[name=monitoring_agency_div]').css('display', 'block');
                $('div[name=incarceration_div]').css('display', 'block');
                $('div[name=protection_orders_div]').css('display', 'block');
                $('div[name=state_registry_div]').css('display', 'block');
            } else {
                $('div[name=arrested_explanation_div]').css('display', 'none');
                $('div[name=monitoring_agency_div]').css('display', 'none');
                $('div[name=incarceration_div]').css('display', 'none');
                $('div[name=protection_orders_div]').css('display', 'none');
                $('div[name=state_registry_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=monitor_agency]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=sentence_length_div]').css('display', 'block');
            } else {
                $('div[name=sentence_length_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=incarcerated]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=incarcerated_length_div]').css('display', 'block');
                $('div[name=incarcerated_years_div]').css('display', 'block');
            } else {
                $('div[name=incarcerated_length_div]').css('display', 'none');
                $('div[name=incarcerated_years_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=state_registry]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=state_registry_list_div]').css('display', 'block');
            } else {
                $('div[name=state_registry_list_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'select[name^=state_registry_list]', function() {
            if ($(this).val() == '1') {
                $('div[name=sex_offender_div]').css('display', 'block');
            } else {
                $('div[name=sex_offender_div]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=exp_ver_phy_abuse]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=victimDiv]').css('display', 'block');
            } else {
                $('div[name=victimDiv]').css('display', 'none');
            }
        });

        $(document).on('change', 'input[name^=mental_health_treat]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=mentalHealthYesDiv]').css('display', 'block');
                $('div[name=mentalHealthNoDiv]').css('display', 'none');
            } else {
                $('div[name=mentalHealthYesDiv]').css('display', 'none');
                $('div[name=mentalHealthNoDiv]').css('display', 'block');
            }
        });
        $(document).on('change', 'input[name^=mentalHealthTreatment]', function() {
            if ($(this).val() == 'inpatient' && $(this).is(':checked')) {
                $('div[name=inPatientDiv]').css('display', 'block');
            } else if ($(this).val() == 'inpatient' && !($(this).is(':checked'))) {
                $('div[name=inPatientDiv]').css('display', 'none');
            }

            if ($(this).val() == 'outpatient' && $(this).is(':checked')) {
                $('div[name=outPatientDiv]').css('display', 'block');
            } else if ($(this).val() == 'outpatient' && !($(this).is(':checked'))) {
                $('div[name=outPatientDiv]').css('display', 'none');
            }

            if ($(this).val() == 'partialHospitaliation' && $(this).is(':checked')) {
                $('div[name=partialHospitalDiv]').css('display', 'block');
            } else if ($(this).val() == 'partialHospitaliation' && !($(this).is(':checked'))) {
                $('div[name=partialHospitalDiv]').css('display', 'none');
            }

            if ($(this).val() == 'dayTreatment' && $(this).is(':checked')) {
                $('div[name=dayTreatmentDiv]').css('display', 'block');
            } else if ($(this).val() == 'dayTreatment' && !($(this).is(':checked'))) {
                $('div[name=dayTreatmentDiv]').css('display', 'none');
            }
        });
        $(document).on('change', 'input[name^=recent_hospitalization]', function() {
            if ($(this).val() == 'yes') {
                $('div[name=recent_hospitalizationDiv]').css('display', 'block');
            } else {
                $('div[name=recent_hospitalizationDiv]').css('display', 'none');
            }
        });


        $(document).on('change', 'input[name^=perception_orientation]', function() {
            if ($(this).val() == 'disoriented') {
                $('div[name=disorientedDiv]').css('display', 'block');
            } else {
                $('div[name=disorientedDiv]').css('display', 'none');
            }
        });
    });
</script>

</html>
