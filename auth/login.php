<?php
session_start();
$error = "";
include_once('conn.php');
if (isset($_POST['login'])) {
    $rollnumber = $_REQUEST['rollnumber'];
	$password=$_REQUEST['password'];
    $sql = "SELECT * FROM user WHERE rollnumber='$rollnumber' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
		$_SESSION['rollnumber']=$row['rollnumber'];
		$_SESSION['role']=$row['role'];
        if ($role == "student") {
            header("location: ../student/dashboard.php");  // Redirect to student dashboard
            exit();
        } elseif ($role == 'hod') {
            header('Location: ../HOD/dashboard.php');  // Redirect to HOD dashboard
            exit();
        }
    } else {
        $error= "No user found with this roll number or password may be wrong";
    }
}


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
		
		<title>Login Page</title>
		
		
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
								<h1>Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
									<!-- Error Message Display -->
									<?php if ($error): ?>
									<div class="alert alert-danger" role="alert">
										<?php echo $error; ?>
									</div>
								<?php endif; ?>
								<!-- Form -->
								<form action="login.php" method="post">
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Rollnumber" name="rollnumber">
									</div>
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Password" name="password">
										<input type="hidden" name="login">
									</div>
									<div class="form-group">
										<button class="btn btn-theme button-1 text-white ctm-border-radius btn-block" type="submit">Login</button>
									</div>
								</form>
								<!-- /Form -->
								
								<div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a></div>
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>
								<div class="text-center dont-have">Don’t have an account? <a href="register.php">Register</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="../assets/js/jquery-3.2.1.min.js" type="80b9a2d338849452d60ff236-text/javascript"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="../assets/js/popper.min.js" type="80b9a2d338849452d60ff236-text/javascript"></script>
		<script src="../assets/js/bootstrap.min.js" type="80b9a2d338849452d60ff236-text/javascript"></script>
		
		<!-- Sticky sidebar JS -->
		<script src="../assets/plugins/theia-sticky-sidebar/ResizeSensor.js" type="80b9a2d338849452d60ff236-text/javascript"></script>		
		<script src="../assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js" type="80b9a2d338849452d60ff236-text/javascript"></script>		
					
		<!-- Custom Js -->
		<script src="../assets/js/script.js" type="80b9a2d338849452d60ff236-text/javascript"></script>
		
	<script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="80b9a2d338849452d60ff236-|49" defer></script></body>

</html>