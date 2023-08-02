<?php
$servername = "localhost";
$username = "absopenemr";
$password = "HdTp87iU82ExVrF!@#";
$database = "absopenemr";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$inTimeArr = $outTimeArr = [];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if($_REQUEST['date']!=''){

$requestedDate = str_replace('-', '/', $_REQUEST['date']);
$date = date('Y-m-d', strtotime($requestedDate));
$user = "SAVAI";

$getUserID = $conn->query("select id from users where username='".$user."'");
$userIDArr = mysqli_fetch_array($getUserID);

/**
 *Check for direct availability on event date
 */
//Get Availability Start Time
$inTimeQuery = "select op.pc_startTime from openemr_postcalendar_events op left join users us on us.id = op.pc_aid where op.pc_eventDate = '".$date."' and us.username = '".$user."' and op.pc_catid = 2 and pc_recurrtype = 0 order by pc_startTime asc";


$inTimeData = $conn->query($inTimeQuery);

$inTimeArr = mysqli_fetch_array($inTimeData);
if(!empty($inTimeArr)){
	//Get AVailability End Time
	$outTimeQuery = "select op.pc_startTime from openemr_postcalendar_events op left join users us on us.id = op.pc_aid where op.pc_eventDate = '".$date."' and us.username = '".$user."' and op.pc_catid = 3 and pc_recurrtype = 0 order by pc_startTime asc";
	$outTimeData = $conn->query($outTimeQuery);

	$outTimeArr = mysqli_fetch_array($outTimeData);

	//If out time not created then get globals
	if(empty($outTimeArr)){
		$globalCalEndQry = $conn->query("select gl_value from globals where gl_name = 'schedule_end'");
		$globalCalEnd = mysqli_fetch_array($globalCalEndQry);
		$outTimeArr = [$globalCalEnd['gl_value'].":00:00"];
	}
}

/**
 *
 *Direct availability check ends
 */
/***
 *
 *Check repeat events
 *
 */
if(empty($inTimeArr)) {
	$datetime = DateTime::createFromFormat('Y-m-d', $date);
	$day = $datetime->format('N');
	$inTimeQuery = $conn->query("select op.pc_startTime, op.pc_recurrspec, op.pc_eventDate, op.pc_endDate from openemr_postcalendar_events op left join users us on us.id = op.pc_aid where op.pc_eventDate <= '".$date."' and us.username = '".$user."' and op.pc_catid = 2 and pc_endDate >= '".$date."' and pc_recurrtype != 0 order by pc_startTime asc");
	$inTimeArr = mysqli_fetch_array($inTimeQuery);

	//Check date falls under repeat events
	if(!empty($inTimeArr)){
		$getRecurr = explode(";", $inTimeArr['pc_recurrspec']);
		$getRecDayArr = explode(":", $getRecurr[1]);
 		$getRecDay = explode(",", str_replace('"',"",$getRecDayArr[2]));
		//Check DAY false under repeat events, normay daytime calculated from sun-0, but openemr sun-1
		if(in_array($day+1, $getRecDay)){
			$outTimeQry = $conn->query("select op.pc_startTime  from openemr_postcalendar_events op left join users us on us.id = op.pc_aid where op.pc_eventDate = '".$inTimeArr['pc_eventDate']."' and us.username = '".$user."' and op.pc_catid = 3 and pc_endDate = '".$inTimeArr['pc_endDate']."' order by pc_startTime asc");
			$outTimeArr = mysqli_fetch_array($outTimeQry);
			//If out time not created then get globals
			if(empty($outTimeArr)){
		                $globalCalEndQry = $conn->query("select gl_value from globals where gl_name = 'schedule_end'");
                		$globalCalEnd = mysqli_fetch_array($globalCalEndQry);
				//$outTimeArr['pc_startTime'] = date("H:i:s", mktime($globalCalEnd['gl_value'],0,0,0,0,0));
				$outTimeArr['pc_startTime'] = $globalCalEnd['gl_value'].":00:00";
        		}
		} else {
			echo "";
			exit();
		}
	
	}else{
		echo "";
		exit();	
	}
	
}
$globalIntervalQuery = $conn->query("select gl_value from globals where gl_name = 'calendar_interval'");

$globalInterval = mysqli_fetch_array($globalIntervalQuery);
$availDiff = round(abs(strtotime($outTimeArr['pc_startTime']) - strtotime($inTimeArr['pc_startTime'])) / 60,2);
$slotCount = $availDiff/$globalInterval['gl_value'];

$startTime = $inTimeArr['pc_startTime'];
for($i=0;$i<$slotCount;$i++){
	
	$outTimeInterval = strtotime("+". $globalInterval['gl_value']. " minutes", strtotime($startTime));
	$checkAppointment = $conn->query("select pc_eid from openemr_postcalendar_events where pc_eventDate='".$date."' and pc_aid='".$userIDArr['id']."' and pc_facility=3 and pc_startTime='".date('H:i:s', strtotime($startTime))."'");
	$checkAppArr = mysqli_fetch_array($checkAppointment);
	if(empty($checkAppArr['pc_eid'])){
		$dispArray[] = "<button type='button' class='btn btn-primary timeSlot' name='timeSlot_".$i."' id='timeSlot_".$i."' data-starttime='".date('H:i:s', strtotime($startTime))."' data-endtime='".date('H:i:s', $outTimeInterval)."'>".date('h:i A', strtotime($startTime)) . " - " . date('h:i A', $outTimeInterval)."</button>";
	}
	$startTime = date('h:i a', $outTimeInterval);
}

echo json_encode($dispArray);
//print_r($availDiff/$globalInterval['gl_value']);die();


}
?>
