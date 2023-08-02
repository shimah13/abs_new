<?php
/**
 *@author Zeoner <services@zeoner.com>
 *Function to create and save zoom call details
 *
 *
 * **/

include_once __DIR__."/../../globals.php";
include_once 'zoom/api.php';
include_once $GLOBALS['vendor_dir'] ."/autoload.php";
include_once $GLOBALS['srcdir'] ."/groups.inc.php";
require_once(__DIR__ . "/../../../src/Common/Crypto/CryptoGen.php");

use PHPMailer\PHPMailer\PHPMailer;
use OpenEMR\Common\Crypto\CryptoGen;
use Mpdf\Mpdf;

//Create zoom meeting
function zoom_meeting($eid){
    $args=sqlQuery("select * from openemr_postcalendar_events where pc_eid=".$eid);

    $z=new API();
    $user_data=sqlQuery("select zoom_user_id from users where id=".$args['pc_aid']);
    $user = $user_data['zoom_user_id'];
        if(!empty($user)){
                $token = $z->zoom_jwt_token();
                $url='users/'.$user.'/meetings';
                $type='GET';
		$params = array();
		$response=$z->curl_Call($url,$type,$params,$token,true);
		$response = json_decode($response);
		sqlQuery("update openemr_postcalendar_events set meeting_link='".$response->meetings[3]->join_url."' where pc_eid=".$eid);
                return true;
          }
          else{

                  Die("Provider Doesn't have Active Zoom Account");
          }
}
//end of zoom meeting

function google_meeting($eid) {
$clientID = '356874286884-l4b45edkojdj11ug1dvnlt76ghslbf9h.apps.googleusercontent.com';
$clientSecret = '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';
$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/absemr/sites/default/oauth2callback.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirect_uri);
$client->addScope(Google_Service_Calendar::CALENDAR);
if (!isset($_GET['code'])) {
  $authUrl = $client->createAuthUrl();
  echo '<script>window.open("' . $authUrl . '","_blank","width=600,height=400");</script>';die();
  exit;
}
$client->authenticate($_GET['code']);
$accessToken = $client->getAccessToken();
$_SESSION['access_token'] = $accessToken;
header('Location:/var/www/html/absemr/interface/main/calendar/zoom_functions.php');
exit;
}
//Create docuemnt for appointment comments - group theraphy
function createDocument($fileContent = "", $fileName = "comments", $eid, $groupId) {
	$config_mpdf = array(
                'tempDir' => __DIR__ . '/tmp',
		'format' => $GLOBALS['pdf_size'],
		'margin_left' => $GLOBALS['pdf_left_margin'],
                'margin_right' => $GLOBALS['pdf_right_margin'],
                'margin_top' => $GLOBALS['pdf_top_margin'],
                'margin_bottom' => $GLOBALS['pdf_bottom_margin'],
                'setAutoBottomMargin' => 'stretch',
                'setAutoTopMargin' => 'stretch',
                'margin_header' => $GLOBALS['pdf_bottom_margin'],
                'margin_footer' => $GLOBALS['pdf_bottom_margin'],
	);
	ob_start();
	$groupParticipants = getParticipants($groupId, true);
	foreach($groupParticipants as $key => $value){
		$pid = $value['pid'];
		$pdf = new mPDF($config_mpdf);
	        $pdf->SetDisplayMode('real');
	        $pdf->SetHTMLHeader("<br><br><br><br><br><br>");
	        $html = '<html><body  style="background-color: white;border: 1px solid #041779;font-family:sans-serif;font-size:12px;padding-top:10px">';
	        $html .= '<div id="content" style="padding-left:40px;padding-right:40px;padding-top:-50px;">'.$fileContent.'</div>';
        	$html .= '</body></html>';
	        $pdf->SetHTMLFooter("<br><br><br><br><br><br>");
        	$pdf->WriteHTML($html);
		$file_name = $fileName."_".$eid."_".$groupId."_".$pid.".pdf";
		$path = dirname(dirname(__FILE__))."interface/main/calendar";
	    	chmod($path, 0755);
		$pdf->Output($file_name);
		$body = "Hi, here we attached the consolidation Group Theraphy appointment notes, Please find the attachment.";
		//echo $body;die();
		sendEmail("Group Theraphy Notes", $value['email'], $body, "./".$file_name);
		//Encrypt and store - to view document in Documents section
	        $tmpfile = fopen("./".$file_name, "r");
		$filetext1 = fread($tmpfile, filesize("./".$file_name));
		$cryptoGen = new CryptoGen();
        	$filetext1 = $cryptoGen->encryptStandard($filetext1, 'ABS@123#');
	        $category_sql = sqlQuery("select id from categories where name='Group Theraphy Comments'");
        	$category = $category_sql['id'];
	        $d = new Document();
        	$owner = $d->manual_set_owner;
                    $rc = $d->createDocument(
                        $pid,
                        $category,
                        $file_name,
                        'application/pdf',
                        $filetext1,
                         '',
                        1 ,
                        $owner,
                        $route
		    );

	         if ($rc){
        	        print_r($rc);
	         }else{
	             unlink($file_name);
		 }
	}
 
}


// Send email functionality
function sendEmail($subject, $to, $body, $attachment=null){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPAuth = true;
    //$mail->SMTPDebug = 2;
    $mail->Username = $GLOBALS['patient_reminder_sender_email'];
    $mail->From = $GLOBALS['patient_reminder_sender_email'];
    $mail->FromName = $GLOBALS['patient_reminder_sender_email'];
    //// Set up crypto object
    $cryptoGen = new CryptoGen();
    $mail->Password = $cryptoGen->decryptStandard($GLOBALS['SMTP_PASS']);
    $mail->AddAddress($to);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->IsHTML(true);
    if(!empty($attachment)&& $attachment != null){
	$mail->addAttachment($attachment);
    }
    if ($mail->Send()) {
          return true;
    } else {
        $email_status = $mail->ErrorInfo;
        error_log("EMAIL ERROR: " . errorLogEscape($email_status), 0);
        return false;
    }
}

//Check patient or group having future appointments
function enableVideoButton($callFrom = 'dashboard', $pid) {
		$meetingUrl = '';
		$getMeetingUrl = sqlQuery("select meeting_link, pc_startTime from openemr_postcalendar_events where pc_pid = ? and pc_eventDate >= ? and meeting_link IS NOT NULL and pc_startTime > now() order by pc_startTime asc limit 1", [$pid, date('Y-m-d')]);

                //whether patient in only one group
		$checkForGroup = sqlQuery("select ope.meeting_link, ope.pc_startTime from therapy_groups_participants tg left join openemr_postcalendar_events ope on ope.pc_gid = tg.group_id where tg.pid = ? and ope.pc_eventDate >= ? and ope.meeting_link IS NOT NULL  and ope.pc_startTime > now() order by ope.pc_startTime asc limit 1", [$pid, date('Y-m-d')]);
		if(!empty($getMeetingUrl) && $getMeetingUrl['meeting_link'] != '' && !empty($checkForGroup) && $checkForGroup['meeting_link'] != ''){
			//needs time compare - set earlistone in url
			if(strtotime($getMeetingUrl['pc_startTime']) > strtotime($checkForGroup['pc_startTime']))
				$meetingUrl = $checkForGroup['meeting_link'];
			else
                   	        $meetingUrl = $getMeetingUrl['meeting_link'];
                }else if(!empty($checkForGroup) && $checkForGroup['meeting_link'] != ''){
                         $meetingUrl = $checkForGroup['meeting_link'];
		}else if(!empty($getMeetingUrl) && $getMeetingUrl['meeting_link'] != ''){
			$meetingUrl = $getMeetingUrl['meeting_link'];
		}
		// Send button or url based on call - either from dashboard or portal
		if($callFrom == 'dashboard'){
			$button = $disableButton = '';
			$getPatientBalance = get_patient_balance($pid);
                        if($getPatientBalance > 0)
				$disableButton = 'disabled';
			if($meetingUrl != '')
                        	$button = '<div style = "margin-bottom:10px"><a class = "btn btn-primary" href ="' . $meetingUrl . '" target = "_blank" '.$disableButton.'>Video</a></div>';
			return $button;
		} else {
			$data = [];
			//if($meetingUrl != ''){
				$data['meetingUrl'] = $meetingUrl;
				$getPatientBalance = get_patient_balance($pid);
                                if($getPatientBalance > 0)
                                        $data['meetingUrl'] = "move_to_payment";
				$data['patientBalanceStatus'] = true;	
			//}
			return json_encode($data, true);
		}
}

?>

