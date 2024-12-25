<?php 
    // session_start();
    // global  $rollnumber;
   $rollnumber= $_SESSION['rollnumber'];
    if(!isset($_SESSION['rollnumber'])) {
        // If user is not logged in, redirect to login page
        header("Location: ../auth/login.php?error=Please login");
        exit();
    }

    ?>