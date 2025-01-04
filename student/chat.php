<?php
session_start();
include_once('../db.php');
include_once('../auth/conn.php');
$error = "";
// Check if the user is logged in
if (!isset($_SESSION['rollnumber'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['leave'])) {
    // Sanitize roll number from session
    $studentrollnumber = mysqli_real_escape_string($conn, $_SESSION['rollnumber']);

    // Query to get user information (department of the student)
    $sql = "SELECT * FROM user WHERE rollnumber='$studentrollnumber'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    // Fetch user data
    $row = mysqli_fetch_assoc($result);
    $dept = $row['department']; // Get the department of the student

    // Query to fetch HOD information from the same department
    $sql1 = "SELECT * FROM user WHERE role='hod' AND department='$dept'";
    $result1 = mysqli_query($conn, $sql1);

    if (!$result1 || mysqli_num_rows($result1) == 0) {
        die('Error: HOD not found for the department');
    }

    // Fetch HOD data
    $row1 = mysqli_fetch_assoc($result1);
    $hodrollnumber = $row1['rollnumber'];

    // Query to fetch Class Incharge information from the same department
    $sql2 = "SELECT * FROM user WHERE role='classincharge' AND department='$dept'";
    $result2 = mysqli_query($conn, $sql2);

    if (!$result2 || mysqli_num_rows($result2) == 0) {
        die('Error: Class Incharge not found for the department');
    }

    // Fetch Class Incharge data
    $row2 = mysqli_fetch_assoc($result2);
    $classinchargerollnumber = $row2['rollnumber'];

    $leavetype = mysqli_real_escape_string($conn, $_REQUEST['leavetype']);
    $reason = mysqli_real_escape_string($conn, $_REQUEST['reason']);
    $todate = mysqli_real_escape_string($conn, $_REQUEST['todate']);
    $fromdate = mysqli_real_escape_string($conn, $_REQUEST['fromdate']);


    $startDate = new DateTime($fromdate);
    $endDate = new DateTime($todate);

    $interval = $startDate->diff($endDate);

    $days = $interval->days;

    // echo $days;
    // Validate date range
    if (strtotime($fromdate) > strtotime($todate)) {
        $error = "The from date cannot be after the to date.";
        exit();
    }

    $date = DateTime::createFromFormat('Y-m-d', $fromdate);
    $fromdaterev = $date->format('d-m-Y');
    $date = DateTime::createFromFormat('Y-m-d', $todate);
    $todaterev = $date->format('d-m-Y');

    // Insert the leave request
    $sql = "INSERT INTO leaves (studentrollnumber, leavetype, reason, todate, fromdate, hodrollnumber, classinchargerollnumber,status,applyingtime,noofdaystaken) 
            VALUES ('$studentrollnumber', '$leavetype', '$reason', '$todaterev', '$fromdaterev', '$hodrollnumber', '$classinchargerollnumber','pending','$datee','$days')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $error = "Leave applied successfully.";
        // Optionally redirect to a confirmation page
        header('Location: leave.php?msg=leave applied');
        exit();
    } else {
        $error = "Error applying for leave. Please try again.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('common/header.php'); ?>

</head>

<body>

    <!-- Inner wrapper -->
    <div class="inner-wrapper">
        <!-- Header -->
        <?php include_once('common/navbar.php');  ?>
        <!-- /Header -->

        <!-- Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
                        <aside class="sidebar sidebar-user">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card ctm-border-radius shadow-sm grow">
                                        <div class="card-body py-4">
                                            <div class="row">
                                                <div class="col-md-12 mr-auto text-left">
                                                    <div class="custom-search input-group">
                                                        <div class="custom-breadcrumb">
                                                            <ol class="breadcrumb no-bg-color d-inline-block p-0 m-0 mb-2">
                                                                <li class="breadcrumb-item d-inline-block"><a href="index.html" class="text-dark">Home</a></li>
                                                                <li class="breadcrumb-item d-inline-block active">Leave</li>
                                                            </ol>
                                                            <h4 class="text-dark">Leave</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar -->
                            <?php
                            include_once('common/sidebar.php');  ?>

                            <!-- /Sidebar -->


                        </aside>
                    </div>

                    <div class="col-xl-9 col-lg-8 col-md-12">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ctm-border-radius shadow-sm grow">
                                    <div class="card-header">
                                        <strong>Chat With Us To Resolve Queries</strong>
                                    </div>
                                    <div class="card-body">

                                        <?php
                                        include_once('../db.php');
                                        $roll = $_SESSION['rollnumber'];

                                        // Fetch department and HOD details in one query block
                                        $sql = "SELECT u.department, h.name, h.email FROM user u 
                                        LEFT JOIN user h ON u.department = h.department AND h.role = 'hod' 
                                        WHERE u.rollnumber = '$roll'";

                                        $result = mysqli_query($conn, $sql);
                                        $row = $result->fetch_assoc();

                                        $dept = $row['department'];
                                        $hodName = $row['name'];
                                        $hodEmail = $row['email'];
                                        ?>


                                        <b>If you have any updates or queries please send info your HOD <strong><?PHP echo $hodName ?></strong> and this is the mail id <strong><a href=""><?php echo $hodEmail ?></a></strong> </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Content-->

    </div>
    <!-- Inner Wrapper -->

    <div class="sidebar-overlay" id="sidebar_overlay"></div>

    <?php include_once('common/footer.php'); ?>
</body>

</html>