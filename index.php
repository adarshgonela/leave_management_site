<?php 
   include_once ('student/common/session.php');
    if(!isset($_SESSION['rollnumber'])) {
        header("Location: /auth/login.php?error=Please login");
        exit();
    }else{
        $rollnumber = $_SESSION['rollnumber'];
        $role = $_SESSION['role'];
        if ($role == "student") {
            header("location: student/dashboard.php");
        }elseif ($role == "hod") {
            header("location: HOD/dashboard.php");
        }
    }


    ?>