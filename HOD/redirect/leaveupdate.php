<?php
// Start the session at the beginning
session_start();
include_once('../../db.php');

if (isset($_SESSION['rollnumber']) && isset($_REQUEST['status'])) {
    $rollnumber = $_REQUEST['studentrollnumber'];
    $updatedstatus = $_REQUEST['status'];
    
    // Sanitize input using prepared statements (this is better than real_escape_string)
    $updatedstatus = mysqli_real_escape_string($conn, $updatedstatus);

    // Prepare the SQL query to update the leave status using prepared statements
    $sql = "UPDATE leaves SET status = ? WHERE studentrollnumber = ?";

    // Initialize prepared statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ss", $updatedstatus, $rollnumber);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If the status is "rejected", update the remaining leaves in the user table
            if ($updatedstatus == 'rejected') {
                // Get the current status and the number of days taken from the leave request
                $getLeaveQuery = "SELECT status, noofdaystaken FROM leaves WHERE studentrollnumber = ?";

                if ($leaveStmt = mysqli_prepare($conn, $getLeaveQuery)) {
                    mysqli_stmt_bind_param($leaveStmt, "s", $rollnumber);
                    mysqli_stmt_execute($leaveStmt);
                    mysqli_stmt_bind_result($leaveStmt, $currentStatus, $noofdaystaken);
                    mysqli_stmt_fetch($leaveStmt);
                    mysqli_stmt_close($leaveStmt);

                    // Check if the status was not already 'rejected'
                    if ($currentStatus != 'rejected' && isset($noofdaystaken)) {
                        // Update the user's remaining leaves only if the status wasn't already 'rejected'
                        $updateLeavesQuery = "UPDATE user SET remainingleaves = remainingleaves + ? WHERE rollnumber = ?";

                        if ($updateStmt = mysqli_prepare($conn, $updateLeavesQuery)) {
                            mysqli_stmt_bind_param($updateStmt, "is", $noofdaystaken, $rollnumber);
                            mysqli_stmt_execute($updateStmt);
                            mysqli_stmt_close($updateStmt);
                        } else {
                           echo  "Error updating remaining leaves: " . mysqli_error($conn);
                        }
                    }
                } else {
                   echo  "Error retrieving leave details: " . mysqli_error($conn);
                }
            }

            // Redirect with success message
            header("location: ../leave.php?msg=statusupdatedsuccessfully");
        } else {
           echo  "Error updating status: " . mysqli_error($conn);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
       echo  "Error preparing the query: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
