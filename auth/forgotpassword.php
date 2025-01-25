<?php
include_once('../db.php');

$errorMessage = '';
$successMessage = '';
$email = '';
$showPasswordForm = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['verify_email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $showPasswordForm = true;
        } else {
            $errorMessage = "Email not found! Please try again.";
        }
    }
    if (isset($_POST['update_password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $newPassword = $_POST['newpassword'];
        $confirmPassword = $_POST['confirmpassword'];

        if ($newPassword === $confirmPassword) {
            // Hash the password before saving to the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE user SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashedPassword, $email);

            if ($stmt->execute()) {
                $successMessage = "Password updated successfully!";
                header("Location: ../auth/login.php?msg=Password updated successfully. Please log in.");
                exit();
            } else {
                $errorMessage = "Failed to update the password. Please try again.";
            }
        } else {
            $errorMessage = "Passwords do not match. Please try again.";
            $showPasswordForm = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Forgot Password</title>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
        <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center justify-content-center bg-primary text-white">
                <img class="img-fluid p-3" src="../assets/logoelms.png" alt="Logo">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <?php if (!$showPasswordForm): ?>
                        <h1 class="card-title h4 text-center">Forgot Password?</h1>
                     
                        <form method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <input type="hidden" name="verify_email">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Verify Email</button>
                            </div>
                        </form>
                        <?php if (!empty($errorMessage)): ?>
                            <p class="text-danger text-center mt-2"><?php echo htmlspecialchars($errorMessage); ?></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <h1 class="card-title h4 text-center">Reset Password</h1>
                        <form method="post">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            <div class="mb-3">
                                <label for="newpassword" class="form-label">New Password</label>
                                <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <input type="hidden" name="update_password">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                        <?php if (!empty($errorMessage)): ?>
                            <p class="text-danger text-center mt-2"><?php echo htmlspecialchars($errorMessage); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>