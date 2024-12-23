<?php
$prod = false;
if($prod){
    $sname = "sql110.infinityfree.com";
    $uname = "if0_37109576";
    $password = "CVHLnsQrK3WPcC";
    $db_name = "if0_37109576_mysareeswebsite";
}
else{
    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "lmsbtch";
}


$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}