<?php  
date_default_timezone_set("Asia/Calcutta");

include "../db.php";
function input($key) {
	global $_REQUEST;
	if(isset($_REQUEST[$key]) && $_REQUEST[$key] && trim($_REQUEST[$key])!=""){
		return trim($_REQUEST[$key]);
	}
	return null;
	
}
?>