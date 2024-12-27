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
            // Hash the new password before storing it using PASSWORD_DEFAULT
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE user SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashedPassword, $email);

            if ($stmt->execute()) {
                header("Location: login.php?msg=Password updated successfully. Please log in.");
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
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            color:hsl(212, 89.20%, 63.50%);
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="email"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color:rgb(45, 192, 250);
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color:rgb(43, 149, 195);
        }
        .error {
            color: #ff4d4d;
            font-size: 14px;
            text-align: center;
        }
        .success {
            color: #4CAF50;
            font-size: 14px;
            text-align: center;
        }
        p {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if (!$showPasswordForm): ?>
            <h2>Verify Email</h2>
            <form action="" method="post">
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="hidden" name="verify_email">
                <input type="submit" value="Verify Email">
            </form>
            <?php if (!empty($errorMessage)): ?>
                <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
        <?php else: ?>
            <h2>Update Password</h2>
            <form action="" method="post">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="password" name="newpassword" placeholder="New Password" required>
                <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
                <input type="hidden" name="update_password">
                <input type="submit" value="Update Password">
            </form>
            <?php if (!empty($errorMessage)): ?>
                <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</body>
</html>
