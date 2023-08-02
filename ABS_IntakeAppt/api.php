<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('class/config.php');

class API extends connection{
   public function __construct() {
	parent::__construct();
    }

}

if(isset($_POST['fname']) && $_POST['fname'] != ''){
       $api = new API;


       switch($requestMethod) {
        case 'POST':	
          $api->insertABSData($_POST);
          break;
        default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
      }
       
}

?>
