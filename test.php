<?php  
include_once('db.php');


$sql1 = "SELECT rollnumber from user where role = 'student'";
$result1 = mysqli_query($conn, $sql1);
while ($row1 = mysqli_fetch_assoc($result1)) {
    $userroll = $row1['rollnumber'];
    echo $userroll;
}

?>