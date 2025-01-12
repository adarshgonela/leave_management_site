<?php
// Start the session at the beginning
session_start();
include_once('../../db.php');

if (isset($_SESSION['rollnumber']) && isset($_REQUEST['status'])) {
    $roll = $_SESSION['rollnumber'];
    $rollnumber = $_REQUEST['studentrollnumber'];
    $updatedstatus = $_REQUEST['status'];

    // Sanitize input using prepared statements
    $updatedstatus = mysqli_real_escape_string($conn, $updatedstatus);

    // Prepare the SQL query to update the leave status using prepared statements
    $sql = "UPDATE leaves SET status = ? WHERE studentrollnumber = ?";

    // Initialize prepared statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ss", $updatedstatus, $rollnumber);

        // Try to execute the statement and check if it succeeds
        if (mysqli_stmt_execute($stmt)) {
            echo "Status updated successfully.<br>";
        } else {
            echo "Error updating status: " . mysqli_error($conn) . "<br>";
        }

        // If the status is "rejected", handle updating the remaining leaves
        if ($updatedstatus == 'rejected') {
            // Get the current status, number of days taken, remaining leaves, and total leaves
            $getLeaveQuery = "SELECT status, noofdaystaken FROM leaves WHERE studentrollnumber = ?";
            $getUserQuery = "SELECT remainingleaves, totalleaves FROM user WHERE rollnumber = ?";

            // Fetch the leave request details and user details
            if ($leaveStmt = mysqli_prepare($conn, $getLeaveQuery)) {
                mysqli_stmt_bind_param($leaveStmt, "s", $rollnumber);
                mysqli_stmt_execute($leaveStmt);
                mysqli_stmt_bind_result($leaveStmt, $currentStatus, $noofdaystaken);
                mysqli_stmt_fetch($leaveStmt);
                mysqli_stmt_close($leaveStmt);
            } else {
                echo "Error retrieving leave details: " . mysqli_error($conn) . "<br>";
            }

            if ($userStmt = mysqli_prepare($conn, $getUserQuery)) {
                mysqli_stmt_bind_param($userStmt, "s", $rollnumber);
                mysqli_stmt_execute($userStmt);
                mysqli_stmt_bind_result($userStmt, $remainingleaves, $totalleaves);
                mysqli_stmt_fetch($userStmt);
                mysqli_stmt_close($userStmt);
            } else {
                echo "Error retrieving user details: " . mysqli_error($conn) . "<br>";
            }

            // Only update the remaining leaves if it hasn't been rejected before
            if ($currentStatus != 'rejected') {
                // Calculate the new remaining leaves (add the days taken back)
                $newRemainingLeaves = $remainingleaves + $noofdaystaken;

                // Ensure the new remaining leaves don't exceed total leaves
                if ($newRemainingLeaves > $totalleaves) {
                    $newRemainingLeaves = $totalleaves; // Set remaining leaves to total leaves if it exceeds
                }

                // Update the user's remaining leaves in the user table
                $updateLeavesQuery = "UPDATE user SET remainingleaves = ? WHERE rollnumber = ?";

                if ($updateStmt = mysqli_prepare($conn, $updateLeavesQuery)) {
                    mysqli_stmt_bind_param($updateStmt, "is", $newRemainingLeaves, $rollnumber);
                    mysqli_stmt_execute($updateStmt);
                    mysqli_stmt_close($updateStmt);
                } else {
                    echo "Error updating remaining leaves: " . mysqli_error($conn) . "<br>";
                }
            }
        }

        // Only insert notification after successful status update
        if ($updatedstatus == 'approved' || $updatedstatus == 'rejected') {
            $notificationsmsg = "Your leave request has been " . $updatedstatus;
            $sql1 = "INSERT INTO notifications(notificationsmsg, fromrollnumber, torollnumber, notificationtime) 
                    VALUES (?, ?, ?, NOW())";

            if ($notifStmt = mysqli_prepare($conn, $sql1)) {
                mysqli_stmt_bind_param($notifStmt, "sss", $notificationsmsg, $roll, $rollnumber);
                mysqli_stmt_execute($notifStmt);
                mysqli_stmt_close($notifStmt);
            } else {
                echo "Error inserting notification: " . mysqli_error($conn) . "<br>";
            }
        }

        // Redirect after successful update
        header("location: ../leave.php?msg=statusupdatedsuccessfully");

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the query: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Session or request parameters are missing.<br>";
}

// Close the database connection
mysqli_close($conn);
?>
