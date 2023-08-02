<?php
include_once(__DIR__.'/api.php');
$api = new API;
$insuranceCompanies = $api->getInsuranceCompanies();
?>
<html>
    <head>
        <title>ABS Intake Appointment Form</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
    <style>
        .inputSpace{
            margin-bottom: 20px;
        }
        .hide{
            display: none;
        }
        th, td {
  padding: 15px;
}
        
    </style>
    
    </head>
    <body>

        <div class="row" style="text-align: center;padding: 40px;">
            <h2>ABS Intake Appointment Form</h2>
        </div>

        <div class="container">
            <form method="POST" id="absIntakeForm" action="api.php">

            <div class="row">
                <div class="col-md-6">
                    <label>Appointment Date *</label>
                    <input type="text" class="form-control datepicker" name="appDate" id="appDate" autocomplete="off" required>
                    <input type="hidden" class="startTime" name="startTime" id="startTime">
                    <input type="hidden" class="endTime" name="endTime" id="endTime">
                </div>
                <div class="col-md-6" id="timeSection">
                </div>
            </div>

            <div class="row inputSpace">
                <div class="col-md-6 mt-3">

                    <label for="fname" class="form-label">Patient First Name *</label>
                    <input type="text" class="form-control inputSpace" name="fname" id="fname" autocomplete="off" required>

                    <label for="phone" class="form-label">Patient Phone *</label>
                    <input type="text" class="form-control inputSpace" name="phone" id="phone" autocomplete="off" required>

                    <label for="insurance" class="form-label">Patient Insurance *</label>
                    <select class="form-control" name="insurance" id="insurance" required>
                        <option value="insured">Insured</option>
                        <option value="non_insured">Non-Insured</option>
                    </select>

                </div>
                <div class="col-md-6 mt-3">

                    <label for="lname" class="form-label">Patient Last Name *</label>
                    <input type="text" class="form-control inputSpace" name="lname" id="lname" autocomplete="off" required>

                    <label for="email" class="form-label">Patient Email *</label>
                    <input type="text" class="form-control inputSpace" name="email" id="email" autocomplete="off" required>

                    <label for="gender" class="form-label">Patient Gender *</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-3">

                    <!----------- Treatment Name Section ------------>
                    
                    <label for="treatmentName" class="form-label">What programs would you like to attend?</label>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="general_mental_health" name="treatment_name[]">
                        <label class="form-check-label" for="general_mental_health">
                            General Mental Health
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="anger_management_stabilization_program" name="treatment_name[]">
                        <label class="form-check-label" for="anger_management_stabilization_program">
                            Anger Management & Stabilization Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="violence_prevention" name="treatment_name[]">
                        <label class="form-check-label" for="violence_prevention">
                            Violence Prevention and Intervention Program/Domestic Violence/Batterers' Intervention Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sexual_behavior_program" name="treatment_name[]">
                        <label class="form-check-label" for="sexual_behavior_program">
                            Sexual Behavior Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="drinking_driving_program" name="treatment_name[]">
                        <label class="form-check-label" for="drinking_driving_program">
                            Drinking Driving Counseling Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Addictions_counselling" name="treatment_name[]">
                        <label class="form-check-label" for="drinking_driving_program">
                            Addictions Counseling
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="conflict_resolution_program" name="treatment_name[]">
                        <label class="form-check-label" for="conflict_resolution_program">
                            Conflict Resolution Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="impulsive_gambling_program" name="treatment_name[]">
                        <label class="form-check-label" for="impulsive_gambling_program">
                            Impulsive Gambling Counseling Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="supportive_parenting_program" name="treatment_name[]">
                        <label class="form-check-label" for="supportive_parenting_program">
                            Supportive Parenting Counseling Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="women_stress_emotional_support_program" name="treatment_name[]">
                        <label class="form-check-label" for="women_stress_emotional_support_program">
                            Women’s Stress & Emotional Support Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="men_stress_emotional_support_program" name="treatment_name[]">
                        <label class="form-check-label" for="men_stress_emotional_support_program">
                            Men’s Stress & Emotional Support Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="digital_electronic_addiction_recovery_program" name="treatment_name[]">
                        <label class="form-check-label" for="digital_electronic_addiction_recovery_program">
                            Digital Electronic Addiction Recovery Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="emotional_eating_healthful_life_program" name="treatment_name[]">
                        <label class="form-check-label" for="emotional_eating_healthful_life_program">
                            Emotional Eating & Healthful Life Counseling Program
                        </label>
                    </div><br>

                    <!--------- Referral Source Section ---------->

                    <label for="referralSource" class="form-label">Who is referring you to the program?</label>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="self_referral" id="self_referral" name="referral_source[]">
                        <label class="form-check-label" for="self_referral">
                            Self Referral
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="employee_assistant_program" name="referral_source[]">
                        <label class="form-check-label" for="employee_assistant_program">
                            Employee Assistant Program
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="criminal_court" name="referral_source[]">
                        <label class="form-check-label" for="criminal_court">
                            Criminal Court
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="supreme_court" name="referral_source[]">
                        <label class="form-check-label" for="supreme_court">
                            Supreme Court
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="family_court" name="referral_source[]">
                        <label class="form-check-label" for="family_court">
                            Family Court
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="attorney" name="referral_source[]">
                        <label class="form-check-label" for="attorney">
                            Attorney
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="probation_parole_officer" name="referral_source[]">
                        <label class="form-check-label" for="probation_parole_officer">
                            Probation / Parole Officer
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="social_worker" name="referral_source[]">
                        <label class="form-check-label" for="social_worker">
                            Social Worker
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="case_manager" name="referral_source[]">
                        <label class="form-check-label" for="case_manager">
                            Case Manager
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="child_welfare_worker" name="referral_source[]">
                        <label class="form-check-label" for="child_welfare_worker">
                            Child Welfare Worker/ACS
                        </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="doctor" name="referral_source[]">
                        <label class="form-check-label" for="doctor">
                            Doctor
                        </label>
                    </div><br>
                    
                    <label for="referralSourceName" class="form-label">What is the name of the referral agency and or contact person? for example (P.O's Name) or (EAP program name) if self referral type N/A</label>
                    <input type="text" class="form-control inputSpace" name="referralSourceName" id="referralSourceName" autocomplete="off">

                    <label for="referralSourcePhone" class="form-label">What is the phone number of the referral contact person?</label>
                    <input type="text" class="form-control inputSpace" name="referralSourcePhone" id="referralSourcePhone" autocomplete="off">

                    <label for="referralSourceEmail" class="form-label">What is the email address of the referral contact person?</label>
                    <input type="text" class="form-control inputSpace" name="referralSourceEmail" id="referralSourceEmail" autocomplete="off">

		    <div style = "margin-bottom:10px">
                    <label for="insuranceName" class="form-label">If you have active insurance and would like to use it, what is the name of your insurance company? If you have Medicaid please know that Medicaid is not insurance. You must present what Medicaid plan you have benefits with. If no insurance type N/A</label>
		    <!--<input type="text" class="form-control inputSpace" name="insuranceName" id="insuranceName" autocomplete="off">-->
			
		    <?php
			echo $insuranceCompanies;
		    ?>
		    <input type = "checkbox" name = "otherInsuranceCompany" id = "otherInsuranceCompany"> * If your insurance company is not listed. Please click the check box and add your insurance company in the box below.
		    <input type = "text" name = "newInsuranceCompany" id = "newInsuranceCompany" style = "display:none" class = "form-control">
		    </div>

                    <label for="insuranceID" class="form-label">What is your insurance ID number? If you have approved EAP benefits please provide the EAP voucher or authorization number and upload all paperwork. If no insurance type N/A. *</label>
                    <input type="text" class="form-control inputSpace" name="insuranceID" id="insuranceID" autocomplete="off">

                    <label for="DOB" class="form-label">What is your date of birth? *</label>
                    <input type="text" class="form-control inputSpace" name="DOB" id="DOB" autocomplete="off" required>

                    <label>Please verify that your insurance is active and that you have mental health benefits. To save time please upload a pic of your active insurance card and any other documentation.</label>
                    <input type="file" class="form-control inputSpace" name="insuranceFile" id="insuranceFile">

                    <label>If you are referred by a family court or criminal court or you are an attorney making a referral please submit the indictment and or petition or court order and or arrest records if available.</label>
                    <input type="file" class="form-control inputSpace" name="referralSourceFile" id="referralSourceFile">

                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <button name="submit" type="submit" id="submit" class="btn btn-success" style="margin-right:5px"> Submit</button>
                    <button name="cancel" type="button" id="cancel" class="btn btn-danger" style="margin-right:5px"> Cancel</button>
                </div>
            </div>

            <div class='container-fluid table-responsive '>
                <div id="availableSlotsModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" id="contentbody">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title"><b style = "color:white">Available Slots</b></h4>
                            </div>
                            <div class="modal-body bgColorWhite">
                                <div class="table table-responsive" id = "availabilitySlotsTable">
                                    <!--Append result-->
                                </div>
                                <div class="modal-footer" style="background-color:white" >
                                    <div class="text-center">
                                        <button type="button" class="btn btn-default" id = "close" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </body>
    <script>
    $(document).ready(function() {
        $("#appDate").datepicker({
                onSelect: function(dateText) {
                $.ajax({
                type: "POST",
                url: "getAvailabilityApi.php?date="+dateText,
                dataType: "json",
		success: function (result) {
			console.log(result);
                        //var count = Math.round(parseInt(result.length)/2);
                        var element = '<tr>';
                        if($.trim(result) != '' && $.trim(result) != null){
                        $.each(result, function(key, val){
                                key++;
                                element += '<td style=""><span class="label label-danger">'+val+'</span></td>';
                                if(key%2 == 0){
                                        element += '</tr><tr>';
                                }
                        });
                        
                        }else{
                            element += '<td style="padding-left:70px;"><span class="label label-danger"><b>There is No Availability For the Doctor</b></td>';
                        }
                        element += "</tr>";
                        $("#availabilitySlotsTable").html(element);
                        $("#availableSlotsModal").modal('show');
                }
		});
                },
                dateFormat: 'mm-dd-yy',
		minDate : "+1D",
		beforeShowDay : function(date){ return[(date.getDay() == 1 || date.getDay() == 2),""];},
        });

        $("#DOB").datepicker({
            maxDate : 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "-70:+0",
            dateFormat: 'mm-dd-yy'
        });

        $(document).on('click', '#close',function(){
                $("#availableSlotsModal").modal('hide');
        });

        $('#absIntakeForm').submit(function() {
            //if($("#appDate,#fname,#email,#phone,#insurance,#gender").val() != ''){

                //var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $('form').serialize(),
		success: function(result) {
		    /*if(result.trim() == "penalty_pending"){
			    alert("Kindly pay the existing penalty amount");
			    return false;
		    }else*/
                    alert("Thank You for scheduling your appointment at ABS. Please check your email for directions on how to access the ABS Confidential telemedicine portal and your documents. Thank you.");location.reload();
                    /*var w = window.open('','','width=100,height=100');
                    w.document.write('HI');
                    w.focus();
                    setTimeout(function() {w.close();}, 5000);*/
                }
            })
              return false;
        /*}else{
            alert("Please Fill All Fields Before submitting Form");
        }*/
        });

        $(document).on('click',".timeSlot",function(){
            var startTime = $(this).data('starttime');
            var endTime = $(this).data('endtime');

            $("#startTime").val(startTime);
            $("#endTime").val(endTime);

            $("#availableSlotsModal").modal('hide');
        });
	
	$(document).on('click', '#otherInsuranceCompany', function(){
		if($(this).is(':checked')){
			$("#newInsuranceCompany").css('display', 'block');
		}else
			$("#newInsuranceCompany").css('display', 'none');
	});
    });
    </script>
    </html>
