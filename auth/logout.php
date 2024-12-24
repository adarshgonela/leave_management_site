<?php
session_start();

$_SESSION['rollnumber'] = null;
session_destroy();
header("location: login.php?msg=logout successful");
exit();
