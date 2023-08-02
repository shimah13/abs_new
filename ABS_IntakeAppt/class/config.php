<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class connection{

private $server='localhost';
private $db='absopenemr';
private $user='absopenemr';
private $pwd='HdTp87iU82ExVrF!@#';
protected $conn;
private $algo;          // Algorithm setting from globals
private $algo_constant; // Standard algorithm constant, if exists
private $options;       // Standardized array of options


function __construct(){

	$this->conn=new mysqli($this->server,$this->user,$this->pwd,$this->db);

     $this->algo = $this->select('globals', ['gl_name'], ['gbl_auth_hash_algo'], ['gl_value']);
if ($this->algo == "SHA512HASH") {
            if (CRYPT_SHA512 != 1) {
                $this->algo == "DEFAULT";
                error_log("OpenEMR WARNING: SHA512HASH not supported, so using DEFAULT instead");
            }
        }

        // If set to php default algorithm, then figure out what it is.
        //  This basically resolves what PHP is using as PASSWORD_DEFAULT,
        //  which has been PASSWORD_BCRYPT since PHP 5.5. In future PHP versions,
        //  though, it will likely change to one of the Argon2 algorithms. And
        //  in this case, the below block of code will automatically support this
        //  transition.
        if ($this->algo == "DEFAULT") {
            if (PASSWORD_DEFAULT == PASSWORD_BCRYPT) {
                $this->algo = "BCRYPT";
            } elseif (PASSWORD_DEFAULT == PASSWORD_ARGON2I) {
                $this->algo = "ARGON2I";
            } elseif (PASSWORD_DEFAULT == PASSWORD_ARGON2ID) {
                $this->algo = "ARGON2ID";
            } elseif (PASSWORD_DEFAULT == "") {
                // In theory, should never get here, however:
                //  php 7.4 changed to using strings rather than integers for these constants
                //   and notably appears to have left PASSWORD_DEFAULT blank in several php 7.4
                //   releases rather than setting it to a default (this was fixed in php8).
                //   So, in this situation, best to default to php 7.4 default protocol
                //   (since will only get here in php 7.4), which is BCRYPT.
                $this->algo = "BCRYPT";
            } else {
                // $this->algo will stay "DEFAULT", which should never happen.
                // But if this does happen, will then not support any custom
                // options in below code since not sure what the algorithm is.
            }
        }

        // Ensure things don't break by only using a supported algorithm
        if (($this->algo == "ARGON2ID") && (!defined('PASSWORD_ARGON2ID'))) {
            // argon2id not supported, so will try argon2i instead
            $this->algo = "ARGON2I";
            error_log("OpenEMR WARNING: ARGON2ID not supported, so using ARGON2I instead");
        }
        if (($this->algo == "ARGON2I") && (!defined('PASSWORD_ARGON2I'))) {
            // argon2i not supported, so will use bcrypt instead
            $this->algo = "BCRYPT";
            error_log("OpenEMR WARNING: ARGON2I not supported, so using BCRYPT instead");
        }

        // Now can safely set up the algorithm and algorithm options
        if (($this->algo == "ARGON2ID") || ($this->algo == "ARGON2I")) {
            // Argon2
            if ($this->algo == "ARGON2ID") {
                // Using argon2ID
                $this->algo_constant = PASSWORD_ARGON2ID;
            }
            if ($this->algo == "ARGON2I") {
                // Using argon2I
                $this->algo_constant = PASSWORD_ARGON2I;
            }
            // Set up Argon2 options
            $temp_array = [];
            if (($GLOBALS['gbl_auth_argon_hash_memory_cost'] != "DEFAULT") && (check_integer($GLOBALS['gbl_auth_argon_hash_memory_cost']))) {
                $temp_array['memory_cost'] = $GLOBALS['gbl_auth_argon_hash_memory_cost'];
            }
            if (($GLOBALS['gbl_auth_argon_hash_time_cost'] != "DEFAULT") && (check_integer($GLOBALS['gbl_auth_argon_hash_time_cost']))) {
                $temp_array['time_cost'] = $GLOBALS['gbl_auth_argon_hash_time_cost'];
            }
            if (($GLOBALS['gbl_auth_argon_hash_thread_cost'] != "DEFAULT") && (check_integer($GLOBALS['gbl_auth_argon_hash_thread_cost']))) {
                $temp_array['threads'] = $GLOBALS['gbl_auth_argon_hash_thread_cost'];
            }
            if (!empty($temp_array)) {
                $this->options = $temp_array;
            }
        } elseif ($this->algo == "BCRYPT") {
            // Bcrypt - Using bcrypt and set up bcrypt options
            $this->algo_constant = PASSWORD_BCRYPT;
            if (($GLOBALS['gbl_auth_bcrypt_hash_cost'] != "DEFAULT") && (check_integer($GLOBALS['gbl_auth_bcrypt_hash_cost']))) {
                $this->options = ['cost' => $GLOBALS['gbl_auth_bcrypt_hash_cost']];
            }
        } elseif ($this->algo == "SHA512HASH") {
            // SHA512HASH - Using crypt and set up crypt option for this algo
            $this->algo_constant = $this->algo;
            if (check_integer($GLOBALS['gbl_auth_sha512_rounds'])) {
                $this->options = ['rounds' => $GLOBALS['gbl_auth_sha512_rounds']];
            } else {
                $this->options = ['rounds' => 100000];
            }
        } else {
            // This should never happen.
            //  Will only happen if unable to map the DEFAULT setting above or if using a invalid setting other than
            //   BCRYPT, ARGON2I, or ARGON2ID.
            // If this happens, then will just go with PHP Default (ie. go with default php algorithm and options).
            $this->algo_constant = PASSWORD_DEFAULT;
            error_log("OpenEMR WARNING: Unable to resolve hashing preference, so using PHP Default");
        }
}

function getconn(){
if($this->conn){
return $this->conn;
}
else
{
$this->conn = new mysqli($this->server,$this->user,$this->pwd,$this->db);
return $this->conn;
}
}

//select process
function select($table,$condition,$values,$columns=array('*')){
$qry="select ".implode(",",$columns)." from ".$table." where ".$this->columns_string($condition,$values);
$res=$this->conn->query($qry);
$data=array();
if($res->num_rows>0){
while($row=$res->fetch_assoc()){
$data[]=$row;
}
}
return $data;
}


function insert($table,$column,$data){
$qry="insert into ".$table."(".implode(",",$column).") values("."'".implode("'".','."'",$data)."'".")";
if($this->conn->query($qry) === TRUE)
{
if($table =="patient_tracker_element")
     return $this->conn;
else
return $this->conn->insert_id;

}
else
return 0;

}

function update($table,$column,$data,$con_column,$value){
$qry="update ".$table." set ";
$qry.=$this->update_string($column,$data);
if($table !='sequences')
$qry.=" where ".$con_column." = '".$value."'";

if($this->conn->query($qry) === TRUE)
return 1;
else
return 0;

}



function maxid($table,$column,$as){
$qry="select max(".$column.")+1 $as from ".$table;
$res=$this->conn->query($qry);
if($res->num_rows>0){
while($row=$res->fetch_assoc()){
$data=$row;
}
}
return $data;

}

function columns_string($condition,$values){
$str=1;
foreach($condition as $c => $con){
$arr[]=$con." = '".$values[$c]."'";
}
if(isset($arr))
$str=implode(" and ",$arr);
return $str;

}

function update_string($column,$data){
$str='';
foreach($column as $c => $col){
if(!empty($str))
$str.=", ".$col." = '".$data[$c]."' ";
else
$str.=$col." = '".$data[$c]."' ";
}

return $str;
}

function ABSFileUpload($fileName,$pid){
        $uploadStatus = move_uploaded_file($filename,'/var/www/html/absemr/sites/default/documents/'.$pid.'/'.$filename);
        return $uploadStatus;
}

function insertPatient($formData){

    $checkPatientEmail = mysqli_query($this->conn,'select pid from patient_data where email='.$formData['email']);
    $checkPatientID = mysqli_fetch_array($checkPatientEmail);

    if($checkPatientID['pid'] == ''){
    $DOB = date('Y-m-d',strtotime($formData['DOB']));

    $patientQuery = 'SELECT MAX(pid)+1 AS pid FROM patient_data';
    $patientData = mysqli_query($this->conn, $patientQuery);

    $pid = mysqli_fetch_array($patientData);

    $patientInsert = $this->insert('patient_data',['fname','lname','phone_cell','email','sex','insured','DOB','referral_source','pid','pubpid','allow_patient_portal','email_direct','hipaa_allowemail'],[$formData['fname'],$formData['lname'],$formData['phone'],$formData['email'],$formData['gender'],$formData['insurance'],$DOB,'',$pid['pid'],$pid['pid'],'YES',$formData['email'],'YES']);

    //$documentInsert = $this->insert('');
    $passWord = $this->generatePortalPassword();
    $hashPassword =  $this->passwordHash($passWord);
    $insertPoralCredentials = $this->insert('patient_access_onsite', ['portal_username', 'portal_login_username','portal_pwd','portal_pwd_status','pid'],[$formData['fname'].$pid['pid'], $formData['fname'].$pid['pid'], $hashPassword, 0,$pid['pid']]);
    $htmlMsg = $this->htmlMsg($formData['fname'].$pid['pid'], $passWord, $formData['email']);
    $email = $this->sendEmail($formData['email'], $formData['fname'] . ' ' . $formData['lname'], $htmlMsg);
    return $pid['pid'];
    }else{
        return $checkPatientID['pid'];
    }

}

function insertAppointment($formData,$pid){
    $facility_id = 3;
    $title = "'"."Intake-Evaluation"."'";
    $pc_catid=12;
    $user = 13;
    $status = "'"."-"."'";
    $formData['appDate'] = str_replace('-', '/', $formData['appDate']);
    $apptDate = "'".date('Y-m-d',strtotime($formData['appDate']))."'";
    $pcEndDate = "0000-00-00";
    $startTime = "'".$formData['startTime']."'";
    $endTime = "'".$formData['endTime']."'";

    $time = "'".date('Y-m-d H:i:s')."'";
$pc_recurrspec = "'" .'a:6:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";s:6:"exdate";N;}'."'";
$pc_location = "'" . 'a:6:{s:14:"event_location";s:0:"";s:13:"event_street1";s:0:"";s:13:"event_street2";s:0:"";s:10:"event_city";s:0:"";s:11:"event_state";s:0:"";s:12:"event_postal";s:0:"";}' . "'";

    //$column=[`pc_time`, `pc_sharing`,`pc_catid`, `pc_multiple`, `pc_aid`, `pc_pid`, `pc_title`, `pc_hometext`,`pc_informant`, `pc_eventDate`, `pc_endDate`, `pc_duration`,`pc_recurrtype`, `pc_recurrspec`, `pc_startTime`, `pc_endTime`, `pc_alldayevent`,`pc_apptstatus`, `pc_prefcatid`, `pc_location`, `pc_facility`,`pc_billing_location`,`pc_room`,`pc_eventstatus`, `pc_location`];
    //$data=[$time,1,$pc_catid,0,'13',$pid,$title,'','',$apptDate,'0000-00-00',900,0,$pc_recurrspec,$startTime,$endTime,0,$status,0,'',$facility_id,$facility_id,'',1,$pc_location];
    // $appointmentInsert = $this->insert('openemr_postcalendar_events',$column,$data);
    //
    if (!$this->conn->query("insert into openemr_postcalendar_events(`pc_time`, `pc_sharing`,`pc_catid`, `pc_multiple`, `pc_aid`, `pc_pid`, `pc_title`, `pc_hometext`,`pc_informant`, `pc_eventDate`, `pc_duration`,`pc_recurrtype`, `pc_recurrspec`, `pc_startTime`, `pc_endTime`, `pc_alldayevent`,`pc_apptstatus`, `pc_prefcatid`, `pc_location`, `pc_facility`,`pc_billing_location`,`pc_room`,`pc_eventstatus`) values($time,1,$pc_catid,0, $user,$pid,$title,'','',$apptDate, 900,0,$pc_recurrspec,$startTime,$endTime,0,$status,0,$pc_location,$facility_id,$facility_id,'',1)")){
    
      echo("Error description: " . $this->conn -> error);
    }
}

function insertABSData($formData){

	if(isset($formData['otherInsuranceCompany']) && isset($formData['newInsuranceCompany']) && $formData['newInsuranceCompany'] != ''){
	            $insQuery = 'SELECT MAX(id)+1 AS id FROM insurance_companies';
		    $insData = mysqli_query($this->conn, $insQuery);
		    $id = mysqli_fetch_array($insData);
		    $returnID = $this->insert('insurance_companies', ['id', 'name'], [$id['id'], $formData['newInsuranceCompany']]);
	}	
	$formData['insuranceName'] = $id['id'] ?? $formData['insuranceCompanies'];
	$apptDate = date('Y-m-d',strtotime($formData['appDate']));
        $DOB = date('Y-m-d',strtotime($formData['DOB']));
        $treatmentName = (isset($formData['treatment_name'])) ? json_encode($formData['treatment_name']) : '';
        $referralSource = (isset($formData['referral_source'])) ? json_encode($formData['referral_source']) : '';
	//$pid = checkMailExist($formData['email']);
	//if($pid == 0){
	
	$pid = $this->insertPatient($formData);
        $returnID = $this->insert('abs_form_data', ['pid','fname','lname','phone','email','gender','insurance','apptDate','apptTime','DOB','referral_source_name','referral_source_phone','referral_source_email','insurance_name','insuranceID','referral_source','treatment_name'], [$pid, $formData['fname'],$formData['lname'],$formData['phone'],$formData['email'],$formData['gender'],$formData['insurance'],$apptDate,$formData['appTime'],$DOB,$formData['referralSourceName'],$formData['referralSourcePhone'],$formData['referralSourceEmail'],$formData['insuranceName'],$formData['insuranceID'],$referralSource,$treatmentName]);

	$this->insert('patient_referral_form', ['Who_Referred_You_to_ABS_', 'pid', 'prob_offc_name', 'prob_offc_ph', 'prob_offc_email'], [implode('|', $formData['referral_source']), $pid, $formData['referralSourceName'], $formData['referralSourcePhone'], $formData['referralSourceEmail']]);


	// insurance da
	$this->insert('insurance_data', ['pid', 'type', 'provider', 'policy_number'], [$pid, 'primary', $formData['insuranceName'], $formData['insuranceID']]);
	/*}else{
	//Exist patient
	$getLastThreePenalty = $this->conn->query("select fee, encounter from billing where pid = '".$pid."' and activity = 1 and code = 'fine' order by id desc limit 3");
	$data = array();
	if($getLastThreePenalty->num_rows>0){
		$billingEntry = 1;
		$payAmtCount = 0;
		while($row = $getLastThreePenalty->fetch_assoc()){
			$paid = 0;
			$qry = $this->conn->query("select amount2, amount1 from payments where encounter = '".$row['encounter']."'");
			if($qry->num_rows>0){
				while($row1 = $qry->fetch_assoc()){
					//more than one payment
					$paid += $row1['amount2'] + $row1['amount1'];
				}
				if($paid >= $row['fee']){
					//check paid amount for encounter is greater than or equals to billing amount
					$payAmtCount++;
				}
			}
			$billingEntry++;
		}
		if($payAmtCount < $billingEntry)
			return "penalty_pending";	

	}

	}*/
	$appointmentID = $this->insertAppointment($formData,$pid);

        return $returnID;

}

//Email sending
function sendEmail ($pt_email, $pt_name, $htmlMsg){
    $getSenderEmail = $this->select('globals', ['gl_name'], ['api_sender_mail'], ['gl_value']);
    $getSenderPassword = $this->select('globals', ['gl_name'], ['api_sender_pass'], ['gl_value']);
    $getSenderName = $this->select('globals', ['gl_name'], ['api_sender_name'], ['gl_value']);
    if (empty($pt_email) || empty($getSenderEmail[0]['gl_value'])) {
        return false;
    }
    if (!($this->validEmail($pt_email))) {
        return false;
    }

    if (!($this->validEmail($getSenderEmail[0]['gl_value']))) {
        return false;
    }

    $mail = new PHPMailer();
    $email_subject = 'no-reply';
    $email_sender = $getSenderEmail[0]['gl_value'];
    $mail->isSMTP();
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPAuth = true;
    $mail->Username = $getSenderEmail[0]['gl_value'];
    $mail->From = $getSenderEmail[0]['gl_value'];
    $mail->FromName = $getSenderName[0]['gl_value'];
    $mail->Password = $getSenderPassword[0]['gl_value'];
    
    //$mail->AddReplyTo($email_sender, $email_sender);
    //$mail->SetFrom($email_sender, $email_sender);
    $mail->AddAddress($pt_email, $pt_name);
    $mail->Subject = $email_subject;
    $mail->MsgHTML($htmlMsg);
    //$mail->AltBody = $plainMsg;
    $mail->IsHTML(true);
    if ($mail->Send()) {
          return true;
    } else {
        $email_status = $mail->ErrorInfo;
        error_log("EMAIL ERROR: " . errorLogEscape($email_status), 0);
        return false;
    }

}

//Validate Email
function validEmail($email)
{
    if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email)) {
        return true;
    }

    return false;
}


function htmlMsg($username, $password, $trustedEmail){
$getPortalAdd = $this->select('globals', ['gl_name'], ['portal_onsite_two_address'], ['gl_value']);
	$portal = $getPortalAdd[0]['gl_value'];
$msg = "<html><body><div class='wrapper'><strong>Portal Account Name : </strong>";
$msg .= $username."<br /><br /><strong>Login User Name : </strong>";
$msg .= $username."<br /><strong>Password : </strong>";
$msg .= $password."<br /><br />";
$msg .= "Patient Portal Web Address : <br /><a href='".$portal."' target='_blank'>".$portal."</a><br /><br />";
$msg .= "<strong>Login Trusted Email</strong> : ".$trustedEmail;
$msg .= "<br /><br /><strong>You may be required to change your password during first login.</strong><br />This is required for your security as well as ours.<br />";
$msg .= "Afterwards however, you may change your portal credentials anytime from portal menu.<br /><br />";
$msg .= "Thank you for allowing us to serve you.";
$msg .= "</div></body></html>";
return $msg;
}


function produceRandomString($length = 26, $alphabet = 'abcdefghijklmnopqrstuvwxyz234567')
{

        $str = '';
        $alphamax = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; ++$i) {
            try {
                $str .= $alphabet[random_int(0, $alphamax)];
            } catch (Error $e) {
                error_log('OpenEMR Error : Encryption is not working because of random_int() Error: ' . errorLogEscape($e->getMessage()));
                return '';
            } catch (Exception $e) {
                error_log('OpenEMR Error : Encryption is not working because of random_int() Exception: ' . errorLogEscape($e->getMessage()));
                return '';
            }
	}
        return $str;
    }

function generatePortalPassword()
{

     $success = false;
     $i = 0;
     while (!$success) {
	     $the_password = $this->produceRandomString(12, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%");
         if (empty($the_password)) {
             // Something is seriously wrong with the random generator
             error_log('OpenEMR Error : OpenEMR is not working because unable to create a random unique token.');
             die("OpenEMR Error : OpenEMR is not working because unable to create a random unique token.");
         }
         $i++;
         if ($i > 1000) {
             // Something is seriously wrong since 1000 tries have not created a valid password
             error_log('OpenEMR Error : OpenEMR is not working because unable to create a random unique token.');
             die("OpenEMR Error : OpenEMR is not working because unable to create a random unique token.");
         }
         if (
             preg_match('/[A-Z]/', $the_password) &&
             preg_match('/[a-z]/', $the_password) &&
             preg_match('/[0-9]/', $the_password) &&
             preg_match('/[@#$%]/', $the_password)
         ) {
             // Password passes criteria
             $success = true;
         }
     }
     return $the_password;
}

function password_hash($password, $algo, $options = array())
{
    if (! function_exists('crypt')) {
        trigger_error("Crypt must be loaded for password_hash to function", E_USER_WARNING);
        return null;
    }

    if (! is_string($password)) {
        trigger_error("password_hash(): Password must be a string", E_USER_WARNING);
        return null;
    }

    if (! is_int($algo)) {
        trigger_error("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given", E_USER_WARNING);
        return null;
    }

    switch ($algo) {
        case PASSWORD_BCRYPT:
            // Note that this is a C constant, but not exposed to PHP, so we don't define it here.
            $cost = 10;
            if (isset($options ['cost'])) {
                $cost = $options ['cost'];
                if ($cost < 4 || $cost > 31) {
                    trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);
                    return null;
                }
            }

            $required_salt_len = 22;
            $hash_format = sprintf("$2y$%02d$", $cost);
            break;
        default:
            trigger_error(sprintf("password_hash(): Unknown password hashing algorithm: %s", $algo), E_USER_WARNING);
            return null;
    }

    if (isset($options ['salt'])) {
        switch (gettype($options ['salt'])) {
            case 'NULL':
            case 'boolean':
            case 'integer':
            case 'double':
            case 'string':
                $salt = (string) $options ['salt'];
                break;
            case 'object':
                if (method_exists($options ['salt'], '__tostring')) {
                    $salt = (string) $options ['salt'];
                    break;
                }

                //NOTE FALL-THROUGH CASE HERE. POSSIBLE BUG.
            case 'array':
            case 'resource':
            default:
                trigger_error('password_hash(): Non-string salt parameter supplied', E_USER_WARNING);
                return null;
        }

        if (strlen($salt) < $required_salt_len) {
            trigger_error(sprintf("password_hash(): Provided salt is too short: %d expecting %d", strlen($salt), $required_salt_len), E_USER_WARNING);
            return null;
        } elseif (0 == preg_match('#^[a-zA-Z0-9./]+$#D', $salt)) {
            $salt = str_replace('+', '.', base64_encode($salt));
        }
    } else {
        $salt = __password_make_salt($required_salt_len);
    }

    $salt = substr($salt, 0, $required_salt_len);

    $hash = $hash_format . $salt;

    $ret = crypt($password, $hash);

    if (! is_string($ret) || strlen($ret) < 13) {
        return false;
    }

    return $ret;
}
function passwordHash(&$password)
{
    // Process SHA512HASH algo separately, since uses crypt
    if ($this->options == "SHA512HASH") {
        // Create salt
        $salt = produceRandomString(16, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");

        // Create hash
        return crypt($password, '$6$rounds=' . $this->options['rounds'] . '$' . $salt . '$');
    }

    // Process algos supported by standard password_hash
    if (empty($this->options)) {
        return password_hash($password, $this->algo_constant);
    } else {
        return password_hash($password, $this->algo_constant, $this->options);
    }
}

//Check mail id already exits
function checkMailExist($email) {
	$getPid = $this->select('patient_data', ['email', 'email_direct'], [$email, $email], ['pid']);	
	$patientExist = 0;
	if($getPid[0]['pid'] > 0)
		$patientExist = $getPid[0]['pid'];
	return $patientExist;
}

function insertDocument($file){

}

function getInsuranceCompanies() {

	$res = mysqli_query($this->conn,'select id,name from insurance_companies');
	//$checkPatientID = mysqli_fetch_array($checkPatientEmail);
	$data="";
	if($res->num_rows>0){
		$data .= "<select name = 'insuranceCompanies' id = 'insuranceCompanies' class = 'form-control'><option value=''>--Select--</option>";
		while($row=$res->fetch_assoc()){
			$data .= "<option value = '".$row['id']."'>".$row['name']."</option>";
		}
		$data .= "</select>";
	}	
	return $data;	
}
}

?>
