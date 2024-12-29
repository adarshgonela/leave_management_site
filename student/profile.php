<?php 
include_once('../db.php');

// Ensure user is logged in (optional)
session_start();
$rollnumber = $_SESSION['rollnumber']; // Assuming rollnumber is stored in session

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated_name = trim($_POST['name']);
    $updated_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $updated_phno = preg_match('/^[0-9]+$/', $_POST['phno']) ? $_POST['phno'] : null;
    $updated_gender = in_array($_POST['gender'], ['Male', 'Female', 'Other']) ? $_POST['gender'] : null;
    $updated_address = trim($_POST['address']);
    $updated_dob = $_POST['dob']; // Validate date format if necessary

    // Check for valid input
    if ($updated_name && $updated_email && $updated_phno && $updated_gender && $updated_address && $updated_dob) {
        $update_sql = "UPDATE user SET name = ?, email = ?, phno = ?, gender = ?, address = ?, dob = ? WHERE rollnumber = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssssss", $updated_name, $updated_email, $updated_phno, $updated_gender, $updated_address, $updated_dob, $rollnumber);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Profile updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update profile: " . $conn->error;
        }

        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid input. Please check your data.";
    }
}


// Fetch current user data based on rollnumber
$sql = "SELECT name, email, phno, gender, address, dob FROM user WHERE rollnumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $rollnumber);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $email = $row['email'];
    $phno = $row['phno'];
    $gender = $row['gender'];
    $address = $row['address'];
    $dob = $row['dob']; // Fetching `dob`
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/lnr-icon.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Student Dashboard</title>
</head>
<body>
    <div class="inner-wrapper">
        <?php include_once('common/header.php'); ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
                        <?php include_once('common/sidebar.php'); ?>
                    </div>

                    <div class="col-xl-9 col-lg-8 col-md-12">
                        <div class="card ctm-border-radius shadow-sm grow">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Profile</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-sm-6 leave-col">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 leave-col">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $email ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender" required>
                                                    <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                    <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                    <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 leave-col">
    <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
    </div>
</div>


                                        <div class="col-sm-6 leave-col">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name="phno" value="<?php echo $phno ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 leave-col">
                                            <div class="form-group">
                                                <label>Roll Number</label>
                                                <input type="text" class="form-control" name="rollnumber" value="<?php echo $rollnumber ?>" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-0">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" value="<?php echo $address ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-theme text-white ctm-border-radius mt-4">Update</button>
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

    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
