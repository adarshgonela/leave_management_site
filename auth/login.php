<?php
// Include database connection
include_once('../db.php');

// Initialize messages
$message = '';
$registration_message = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the action is login or register
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        // Login logic
        $name = $_POST['name'];
        $rollno = $_POST['rollno'];

        if (!empty($name) && !empty($rollno)) {
            $sql = "SELECT * FROM user WHERE name = ? AND rollnumber = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ss", $name, $rollno);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $message = "Login successful! Welcome, Roll Number: " . htmlspecialchars($row['rollnumber']);
                } else {
                    $message = "Invalid credentials. Please try again.";
                }

                $stmt->close();
            } else {
                $message = "Error preparing the statement: " . $conn->error;
            }
        } else {
            $message = "Please fill in all fields.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
        // Registration logic
        $name = $_POST['reg_name'];
        $rollno = $_POST['reg_rollno'];

        if (!empty($name) && !empty($rollno)) {
            $sql = "INSERT INTO user (name, rollnumber) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ss", $name, $rollno);
                if ($stmt->execute()) {
                    $registration_message = "Registration successful! You can now log in.";
                } else {
                    $registration_message = "Registration failed: " . $conn->error;
                }

                $stmt->close();
            } else {
                $registration_message = "Error preparing the statement: " . $conn->error;
            }
        } else {
            $registration_message = "Please fill in all fields.";
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .form-group .message {
            text-align: center;
            font-size: 14px;
            color: #d9534f; /* Error color */
        }
        .form-group .message.success {
            color: #5cb85c; /* Success color */
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <!-- Display Login Message -->
    <?php if (!empty($message)): ?>
        <div class="form-group message <?php echo strpos($message, 'successful') !== false ? 'success' : ''; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="POST" action="../student/index.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="rollno">Roll Number:</label>
            <input type="text" id="rollno" name="rollno" required>
        </div>
        <div class="form-group">
            <button type="submit" name="action" value="login">Login</button>
        </div>
    </form>

    <div class="footer">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>
