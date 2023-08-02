<?php

/**
 *
 * form submit functionality
 * */
#!/usr/bin/php
$_SERVER['HTTP_HOST'] = 'localhost';
$_GET['site'] = 'default';
$ignoreAuth = true;
include_once('../../../interface/globals.php');
include_once("../../../library/sql.inc");

/*if(isset($_POST['referral'])){
//	$args = [$_POST['fname'], $_POST['lname'], $_POST['DOB'], $_POST['email'], $_POST['age'], $_POST['gender'], $_POST['ethnicity'], $_POST['religion'], $_POST['ph_no1'], $_POST['ph_no2'], $_POST['adr1'], $_POST['Adr2'], $_POST['state'], $_POST['city'], $_POST['zip'], $_POST['living_environment'], $_POST['payment_ifo'], $_POST['insurance_comapny'], $_POST['insuranceID'], $_POST['eap_pgms'],$_POST['eap_contact_person'], $_POST['eap_contact_person_email'], $_POST['eap_contact_person_phone'], $_POST['voucher_number'], $_POST['no_of_sessions'], $_POST['having_primary_insurance']];
	
//	sqlInsert("insert into patient_referral_form(fname, lname, DOB, email, age, gender, ethnicity, religion, ph_1,ph_2, addr1, addr2, state,city,postal,living_in, intend_to_pay, insurance_comapny,insuranceID, eap_pgm, eap_contact_person, eap_contact_person_email, eap_contact_person_phone, voucher_number, no_of_sessions, having_primary_insurance) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $args);

	$args = array(
    $_POST['ethnicity'],
    $_POST['religion'],
    $_POST['ph_no1'],
    $_POST['ph_no2'],
    $_POST['adr1'],
    $_POST['Adr2'],
    $_POST['city'],
    $_POST['state'],
    $_POST['zip'],
    $_POST['living_environment'],
    $_POST['payment_ifo'],
    $_POST['insurance_comapny'],
    $_POST['insuranceID'],
    $_POST['eap_pgms'],
    $_POST['eap_contact_person'],
    $_POST['eap_contact_email'],
    $_POST['eap_contact_phone'],
    $_POST['eap_voucher'],
    $_POST['eap_session'],
    $_POST['eap_med_ins'],
    $_POST['involved_agencies'],
    $_POST['lawyerDiv_info'],
    $_POST['caseType_info '],
    $_POST['lawyer_attroney_name'],
    $_POST['lawyer_attroney_addr'],
    $_POST['lawyer_attroney_phone'],
    $_POST['lawyer_attroney_email'],
    $_POST['childwelfare'],
    $_POST['welfare_worker_name'],
    $_POST['welfare_worker_addr'],
    $_POST['welfare_worker_ph'],
    $_POST['welfare_worker_email'],
    json_encode($_POST['courtCase'],true),
    $_POST['dmv'],
    $_POST['prob_courtCase'],
    $_POST['prob_offc_name'],
    $_POST['prob_offc_ph'],
    $_POST['prob_offc_email'],
    $_POST['doc_name'],
    $_POST['doc_phone'],
    $_POST['doc_email'],
    $_POST['hospital_name'],
    $_POST['parole_offc_name'],
    $_POST['parole_offc_ph'],
    $_POST['parole_offc_email'],
    $_POST['social_worker_name'],
    $_POST['social_worker_ph'],
    $_POST['social_worker_email']
	);

	sqlInsert("insert into patient_referral_form
    (ethnicity,
    religion,
    ph_no1,
    ph_no2,
    adr1,
    Adr2,
    city,
    state,
    zip,
    living_environment,
    payment_ifo,
    insurance_comapny,
    insuranceID,
    eap_pgms,
    eap_contact_person,
    eap_contact_email,
    eap_contact_phone,
    eap_voucher,
    eap_session,
    eap_med_ins,
    involved_agencies,
    lawyerDiv_info,
    caseType_info ,
    lawyer_attroney_name,
    lawyer_attroney_addr,
    lawyer_attroney_phone,
    lawyer_attroney_email,
    childwelfare,
    welfare_worker_name,
    welfare_worker_addr,
    welfare_worker_ph,
    welfare_worker_email,
    courtCase,
    dmv,
    prob_courtCase,
    prob_offc_name,
    prob_offc_ph,
    prob_offc_email,
    doc_name,
    doc_phone,
    doc_email,
    hospital_name,
    parole_offc_name,
    parole_offc_ph,
    parole_offc_email,
    social_worker_name,
    social_worker_ph,
    social_worker_email)
  values(
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?
)", $args);
	echo "success";
	exit();
}
/*if(isset($_POST['therapeutic'])){

}*/

//include_once(__DIR__.'/../../../src/Services/SocialHistoryService.php');
//echo __DIR__.'/../../../Src/Services/SocialHistoryService.php';
use OpenEMR\Services\SocialHistoryService;
include_once(__DIR__.'/../../../library/api.inc');

if(isset($_POST['referralTab'])){
	/*unset($_POST['referral']);
	unset($_POST['ph_no1']);
	unset($_POST['ph_no2']);
	if(is_array($_POST['Who_Referred_You_to_ABS_'])){
		$_POST['Who_Referred_You_to_ABS_'] = implode('|', $_POST['Who_Referred_You_to_ABS_']);
	}
	$socialHistoryService = new SocialHistoryService();
	return $socialHistoryService->updateHistoryDataForPatientPid($_POST['pid'], $_POST);*/

	foreach($_POST as $key => $value) {
		if(is_array($_POST[$key])) {
			$_POST[$key]  = implode('|', $_POST[$key]);
		}
}
//changingOfValues();
unset($_POST['referralTab']);
formSubmit('patient_referral_form', $_POST, '');

}

if(isset($_POST['therapeuticTab'])){
        foreach($_POST as $key => $value) {
                if(is_array($_POST[$key])) {
                        $_POST[$key]  = implode('|', $_POST[$key]);
                }
	}
//changingOfValues();
unset($_POST['therapeuticTab']);
formSubmit('patient_therapeutic_form', $_POST, '');

}

?>
