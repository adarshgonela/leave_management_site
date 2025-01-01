<?php
// Start the session at the beginning
session_start();


include_once('../../db.php');

if (isset($_SESSION['rollnumber']) && isset($_REQUEST['status'])) {
    $rollnumber = $_REQUEST['studentrollnumber'];
    $updatedstatus = $_REQUEST['status'];
echo $rollnumber;
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
            // echo "Leave status updated successfully!";
            header("location: ../leave.php?msg=statusupdated successfully");
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the query: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
