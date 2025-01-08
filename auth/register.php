<?php
$error = "";
$success_message = "";
include_once('../db.php');

if (isset($_POST['register'])) { 
    // Get and sanitize input
    $name = trim($_REQUEST['name']);
    $email = trim($_REQUEST['email']);
    $rollnumber = trim($_REQUEST['rollnumber']);
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];

    // Validate form fields
    if (empty($name) || empty($email) || empty($rollnumber) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } elseif (strlen($password) < 8) {
        $error_message = "Password must be at least 8 characters long!";
    } else {
        // Check if the email or roll number already exists in the database
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? OR rollnumber = ?");
        $stmt->bind_param("ss", $email, $rollnumber);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If email or roll number exists
            $error_message = "Email or Roll Number is already registered!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and execute the insert statement
            $stmt = $conn->prepare("INSERT INTO user (name, email, rollnumber, password, role) VALUES (?, ?, ?, ?, ?)");
            $role = 'student'; // Assuming role is always 'student' for new users
            $stmt->bind_param("sssss", $name, $email, $rollnumber, $hashed_password, $role);

            if ($stmt->execute()) {
                // Success
                $success_message = "New record created successfully!";
            } else {
                // Error inserting record
                error_log("Error inserting record: " . $stmt->error);
                $error_message = "Something went wrong. Please try again later.";
            }
        }
    }
}

mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
	
<head>
	
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Favicon -->
		<link rel="icon" type="image/x-icon" href="../assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		
		<!-- Linearicon Font -->
		<link rel="stylesheet" href="../assets/css/lnr-icon.css">
				
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
				
		<!-- Custom CSS -->
		<link rel="stylesheet" href="../assets/css/style.css">
		
		<title>Register Page</title>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
	</head>
	<body>
			
			<!-- Loader -->
			<!-- <div id="loader-wrapper">
				
				<div class="loader">
				  <div class="dot"></div>
				  <div class="dot"></div>
				  <div class="dot"></div>
				  <div class="dot"></div>
				  <div class="dot"></div>
				</div>
			</div> -->

		<!-- Main Wrapper -->
		<div class="inner-wrapper login-body">
			<div class="login-wrapper">
				<div class="container">
					<div class="loginbox shadow-sm grow">
						<div class="login-left">
							<img class="img-fluid" src="../assets/logoelms.png" alt="Logo">
						</div>
						<div class="login-right">
							<div class="login-right-wrap">
								<h1>Register</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								<?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
								<!-- Form -->
								<form action="register.php" method="post">
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Name" name="name">
									</div>
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Rollnumber" name="rollnumber">
									</div>
									<div class="form-group">
										<input class="form-control" type="email" placeholder="Email" name="email">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" placeholder="Password" name="password">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" placeholder="Confirm Password" name="confirm_password">
										<input type="hidden" name="register">
									</div>
									<div class="form-group mb-0">
										<button class="btn btn-theme button-1 text-white ctm-border-radius btn-block" type="submit">Register</button>
									</div>
								</form>
								<!-- /Form -->
								
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>
								
								<!-- Social Login -->
								<!-- <div class="social-login">
									<span>Register with</span>
									<a href="javascript:void(0)" class="facebook"><i class="fa fa-facebook"></i></a><a href="javascript:void(0)" class="google"><i class="fa fa-google"></i></a>
								</div> -->
								<!-- /Social Login -->
								
								<div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="../assets/js/jquery-3.2.1.min.js" type="bd0355dbdceaf9287807af7b-text/javascript"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="../assets/js/popper.min.js" type="bd0355dbdceaf9287807af7b-text/javascript"></script>
		<script src="../assets/js/bootstrap.min.js" type="bd0355dbdceaf9287807af7b-text/javascript"></script>
		
		<!-- Sticky sidebar JS -->
		<script src="../assets/plugins/theia-sticky-sidebar/ResizeSensor.js" type="bd0355dbdceaf9287807af7b-text/javascript"></script>		
		<script src="../assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js" type="bd0355dbdceaf9287807af7b-text/javascript"></script>		
					
		<!-- Custom Js -->
		<script src="../assets/js/script.js" type="bd0355dbdceaf9287807af7b-text/javascript"></script>
		
	<script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="bd0355dbdceaf9287807af7b-|49" defer></script></body>

</html>