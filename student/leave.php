<?php
session_start();
include_once('../db.php');
include_once('../auth/conn.php');
include_once('title.php');
$error = "";
// Check if the user is logged in
if (!isset($_SESSION['rollnumber'])) {
    header('Location: login.php');
    exit();
}

$studentrollnumber = $_SESSION['rollnumber'];

// Fetch user information
$sql = "SELECT * FROM user WHERE rollnumber = '$studentrollnumber'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$remaining_leaves = $row['remainingleaves'];
$dept = $row['department'];
$yearsem = $row['yearsem'];
$remaining_leave1 = $row['remainingleaves'];
$attendencedb = $row['attendence'];

// if ($attendencedb <= $attendencelimit ) {//60< 75
if ($remaining_leaves <= $remainingleaveslimit ) {//60< 75

    $error = " your Atttendence is below 75% ,you cannot apply leaves";
} else {
   

    if (empty($dept) || empty($yearsem)) {
        $error = "Please fill all details in your profile to apply for leave.";
    }
    if (isset($_POST['leave'])) {
        $leavetype = mysqli_real_escape_string($conn, $_REQUEST['leavetype']);
        $reason = mysqli_real_escape_string($conn, $_REQUEST['reason']);
        $todate = mysqli_real_escape_string($conn, $_REQUEST['todate']);
        $fromdate = mysqli_real_escape_string($conn, $_REQUEST['fromdate']);

        // Calculate the number of days
        $startDate = new DateTime($fromdate);
        $endDate = new DateTime($todate);
        $interval = $startDate->diff($endDate);
        $days = $interval->days;

        // Validate date range
        if (strtotime($fromdate) > strtotime($todate)) {
            $error = "The from date cannot be after the to date.";
        }

        // Check if the student has enough leave balance
        if ($remaining_leaves < $days) {
            $error = "You do not have enough leaves.";
        }

        // Insert the leave request
        if (empty($error)) {
            // Query to get HOD and Class Incharge
            $sql1 = "SELECT * FROM user WHERE role='hod' AND department='$dept'";
            $result1 = mysqli_query($conn, $sql1);

            $hod = mysqli_fetch_assoc($result1);
            $hodrollnumber = $hod['rollnumber'];

            $sql2 = "SELECT * FROM user WHERE role='classincharge' AND department='$dept'";
            $result2 = mysqli_query($conn, $sql2);

            $classincharge = mysqli_fetch_assoc($result2);
            $classinchargerollnumber = $classincharge['rollnumber'];

            // Insert the leave request into database
            $sql = "INSERT INTO leaves (studentrollnumber, leavetype, reason, todate, fromdate, hodrollnumber, classinchargerollnumber, status, applyingtime, noofdaystaken)
                VALUES ('$studentrollnumber', '$leavetype', '$reason', '$todate', '$fromdate', '$hodrollnumber', '$classinchargerollnumber', 'pending', NOW(), '$days')";

            if (mysqli_query($conn, $sql)) {
                // Update remaining leaves
                $new_remaining_leaves = $remaining_leaves - $days;
                $update_sql = "UPDATE user SET remainingleaves='$new_remaining_leaves' WHERE rollnumber='$studentrollnumber'";
                if (mysqli_query($conn, $update_sql)) {

                    // Assuming you have the student's roll number and the HOD's roll number stored
                    // $studentRollNumber = $roll; // student's roll number
                    // $hodRollNumber = $hodRoll; // HOD's roll number (you should define this)

                    $notificationsmsg = "You have a new leave request from student  $studentrollnumber";

                    // Prepare the SQL query to insert the notification
                    $sql1 = "INSERT INTO notifications(notificationsmsg, fromrollnumber, torollnumber, notificationtime) 
         VALUES (?, ?, ?, NOW())";

                    // Check if the SQL statement is prepared
                    if ($notifStmt = mysqli_prepare($conn, $sql1)) {
                        // Bind parameters to the prepared statement
                        mysqli_stmt_bind_param($notifStmt, "sss", $notificationsmsg, $studentrollnumber, $hodrollnumber);

                        // Execute the prepared statement
                        mysqli_stmt_execute($notifStmt);

                        // Close the statement
                        mysqli_stmt_close($notifStmt);
                    } else {
                        // If there is an error in preparing the statement
                        echo "Error inserting notification: " . mysqli_error($conn) . "<br>";
                    }


                    header('Location: leave.php?msg=leave applied');
                    exit();
                } else {
                    $error = "Error updating the number of leaves. Please try again.";
                }
            } else {
                $error = "Error applying for leave. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once('common/header.php'); ?>
</head>

<body>
    <div class="inner-wrapper">
        <?php include_once('common/navbar.php');  ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
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
                            <?php include_once('common/sidebar.php'); ?>
                        </aside>
                    </div>

                    <div class="col-xl-9 col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ctm-border-radius shadow-sm grow">
                                    <div class="card-header">
                                        <?php if ($error): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php endif; ?>
                                        <h4 class="card-title mb-0">Apply Leaves</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="leave.php" method="post">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Leave Type<span class="text-danger">*</span></label>
                                                        <select class="form-control select" name="leavetype">
                                                            <option>Select Leave</option>
                                                            <option value="sick leaves">Sick Leave</option>
                                                            <option value="Personal Leave">Personal Leave</option>
                                                            <option value="Emergency Leave">Emergency Leave</option>
                                                            <option value="vacation Leave">Vacation Leave</option>
                                                            <option value="casual Leave">Casual Leave</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Remaining Leaves</label>
                                                        <input type="text" class="form-control" value="<?php echo $remaining_leave1 ?>" disabled>
                                                        <input type="hidden" name="leave">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>From</label>
                                                        <input type="date" class="form-control" name="fromdate">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>To</label>
                                                        <input type="date" class="form-control" name="todate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Department</label>
                                                        <input type="text" class="form-control" value="<?php echo $dept ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Year and Semester</label>
                                                        <input type="text" class="form-control" value="<?php echo $yearsem ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                        <label>Reason</label>
                                                        <textarea class="form-control" rows=4 name="reason"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Apply</button>
                                                <a href="javascript:void(0);" class="btn btn-danger text-white ctm-border-radius mt-4">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" id="sidebar_overlay"></div>
    <?php include_once('common/footer.php'); ?>
</body>

</html>