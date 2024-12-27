<?php
session_start();
$error = "";
include_once('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $rollnumber = mysqli_real_escape_string($conn, $_POST['rollnumber']);
    $password = $_POST['password']; // Don't escape passwords directly as they are used for verification later

    // Validate input
    if (empty($rollnumber)) {
        $error = "Roll number is required.";
    } elseif (empty($password)) {
        $error = "Password is required.";
    } else {
        // Query to fetch user by roll number
        $sql = "SELECT * FROM user WHERE rollnumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rollnumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Check if the password matches the hashed password in the database
            if (password_verify($password, $row['password'])) {
                $_SESSION['rollnumber'] = $row['rollnumber']; // Store roll number in session
                $role = $row['role'];

                // Redirect based on the role
                if ($role === "student") {
                    header("Location: ../student/index.php"); // Redirect to student dashboard
                    exit();
                } elseif ($role === "hod") {
                    header("Location: ../HOD/dashboard.php"); // Redirect to HOD dashboard
                    exit();
                }
            } else {
                $error = "Invalid password. Please try again.";
            }
        } else {
            $error = "No user found with this roll number.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="inner-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox shadow-sm grow">
                    <div class="login-left">
                        <img class="img-fluid" src="assets/img/logo.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Error Message -->
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Login Form -->
                            <form action="" method="POST">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Roll Number" name="rollnumber" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-theme button-1 text-white ctm-border-radius btn-block" type="submit" name="login">Login</button>
                                </div>
                            </form>

                            <div class="text-center forgotpass">
                                <a href="password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center dont-have">
                                Don’t have an account? <a href="register.php">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
