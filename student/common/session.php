<?php 
   $rollnumber= $_SESSION['rollnumber'];
   $role=$_SESSION['role'];
    if(!isset($_SESSION['rollnumber'])) {
        header("Location: ../auth/login.php?error=Please login");
        exit();
    }

    ?>