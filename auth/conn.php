<?php  
$timezone = new DateTimeZone('Asia/Kolkata');

$date = new DateTime('now', $timezone);

$datee=$date->format('d-m-Y H:i:s');

include_once("../db.php");
function input($key) {
	global $_REQUEST;
	if(isset($_REQUEST[$key]) && $_REQUEST[$key] && trim($_REQUEST[$key])!=""){
		return trim($_REQUEST[$key]);
	}
	return null;
	
}
?>