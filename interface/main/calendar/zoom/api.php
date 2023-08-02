<?php
include_once('./../../../interface/globals.php');

class API{


//JWT token generation
public static function zoom_jwt_token(){

	$curl = curl_init();
$key = $GLOBALS['zoom_api_key'];
$secret = $GLOBALS['zoom_secret_key'];
$acc_id = $GLOBALS['zoom_account_id'];
$authKey = base64_encode($key.":".$secret);
$requestURL='https://zoom.us/oauth/token?grant_type=account_credentials&account_id='.$acc_id;

$postFields = http_build_query(array("grant_type"=>"account_credentials", "account_id"=>$acc_id));

curl_setopt_array($curl, array(
  CURLOPT_URL => $requestURL,
  CURLOPT_USERPWD => $key . ":" . $secret,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic ".$authKey,
  ),
  CURLOPT_POSTFIELDS => $postFields,
));

$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

if ($err) {
 echo "cURL Error #:" . $err;
} else {
        $res = json_decode($response);
        return $res->access_token;
}

}

public static function curl_Call($url,$type,$params=array(),$token,$json=false){
$curl = curl_init();
$requestURL='https://api.zoom.us/v2/'.$url;
if($json){
        $postFields=json_encode($params);
}
else
$postFields = http_build_query($params);

curl_setopt_array($curl, array(
  CURLOPT_URL => $requestURL,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => $type,
  CURLOPT_POSTFIELDS => $postFields,
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".$token,
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}


}




}
//end pf api class

?>

