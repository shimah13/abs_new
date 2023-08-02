<?php

/***
 *
 *
 * */

if($_GET['func']){
	$_GET['func']();
}

function getPricePlans(){
	$data = sqlStatement("select * from list_options where list_id = ?", ['pricelevel']);	
	for ($iter = 0; $row = sqlFetchArray($data); $iter++) {
                $result[$iter]['value'] = $row['title'];
                $result[$iter]['code'] = $row['option_id'];
        }
        echo json_encode($result);
}
?>
