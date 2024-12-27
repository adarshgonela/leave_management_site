<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: login.php?msg=logout_successful");
exit();
?>
<?php $pnf=$smt('email') ?>
<?php echo $pnf ?>
<?php ?>
