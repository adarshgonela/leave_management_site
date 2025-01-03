<?php
session_start();
include_once('../db.php');


$rollnumber=$_SESSION['rollnumber'];
	$sql = "SELECT * FROM user where rollnumber='$rollnumber'";
	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($result);
		$email = $row['email'];
		$name = $row['name'];
		$phno = $row['phno'];
		// $rollnumber = $row['rollnumber'];
		$gender = $row['gender'];
		$address = $row['address'];
		$id = $row['id'];
		$image=$row['profileimg'];

if (isset($_POST['update'])) {
	$new_email = $_REQUEST['email'];
    $new_name = $_REQUEST['name'];
    $new_phno = $_REQUEST['phno'];
    $new_rollnumber = $_REQUEST['rollnumber'];
    $new_gender = $_REQUEST['gender'];
    $new_address = $_REQUEST['address'];
    $user_id = $_REQUEST['id'];

	// echo $new_email;
	// echo $new_name;
	// echo $new_address;
	// echo $new_gender;


	
$profileimg = $_FILES["profileimg"]["name"];
$profileimg = $_FILES["profileimg"]["tmp_name"];



	$sql = "UPDATE user SET email = ?, name = ?, phno = ?, rollnumber = ?, gender = ?, address = ?,profileimg=?  WHERE id = ?";

	// Prepare the statement
	$stmt = $conn->prepare($sql);
	
	// Check if the statement was prepared successfully
	if ($stmt === false) {
		die("Error preparing the statement: " . $conn->error);
	}
	
	// Bind the parameters to the statement
	$stmt->bind_param("sssssssi", $new_email, $new_name, $new_phno, $new_rollnumber, $new_gender, $new_address, $profileimg,$user_id);
	
	// Execute the query
	if ($stmt->execute()) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $stmt->error;
	}
	
	// Close the statement and connection
	$stmt->close();
	// $conn->close();
		

	// $rollnumber=$_SESSION['rollnumber'];
	// $sql = "SELECT * FROM user where rollnumber='$rollnumber'";
	// $result = mysqli_query($conn, $sql);

	// $row = mysqli_fetch_assoc($result);
	// 	$email = $row['email'];
	// 	$name = $row['name'];
	// 	$phno = $row['phno'];
	// 	// $rollnumber = $row['rollnumber'];
	// 	$gender = $row['gender'];
	// 	$address = $row['address'];
	// 	$id = $row['id'];

    
	// header("location: profile.php");
} 

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php include_once('common/header.php'); ?>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.min.js"></script>
		<script src="../assets/js/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>

		<!-- Inner wrapper -->
		<div class="inner-wrapper">

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

			<!-- Header -->
			<?php include_once('common/navbar.php');  ?>
			<!-- /Header -->

			<!-- Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class=" col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
							<aside class="sidebar sidebar-user">
								<div class="row">
									<div class="col-md-12">
										<div class="card ctm-border-radius shadow-sm grow">
											<div class="card-body py-4">
												<div class="row">
													<div class="col-md-12 mr-auto text-left">
														<div class="custom-search input-group">
															<div class="custom-breadcrumb">
																<ol class="breadcrumb no-bg-color d-inline-block p-0 m-0 mb-2">
																	<li class="breadcrumb-item d-inline-block"><a href="dashboard.php" class="text-dark">Home</a></li>
																	<li class="breadcrumb-item d-inline-block active">Profile</li>
																</ol>
																<h4 class="text-dark">Profile</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Sidebar -->
								<?php
								include_once('common/sidebar.php');  ?>

								<!-- /Sidebar -->


							</aside>
						</div>

						<div class="col-xl-9 col-lg-8 col-md-12">

							<div class="row">
								<div class="col-md-12">
									<div class="card ctm-border-radius shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0">Profile</h4>
										</div>
										<div class="card-body">
											<form action="profile.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
											<div class="row">
													<div class="col-12">
														<div class="avatar-upload">
															<div class="avatar-edit">
																<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
																<label for="imageUpload"></label>
															</div>
															<div class="avatar-preview">
																<div id="imagePreview">
																	
																</div>
															</div>
														</div>
													</div>
													
												</div>
												<div class="row">

													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Name</label>
															<input type="text" class="form-control" value="<?php echo $name ?>" name="name">

														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Email</label>
															<input type="email" class="form-control" value="<?php echo $email ?>" name="email">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>
																Gender
																<span class="text-danger">*</span>
															</label>
															<input type="text" class="form-control" value="<?php echo $gender ?>" name="gender" >

															<!-- <select class="form-control select">
																<option value="">Select Gender</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select> -->
														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Phone Number</label>
															<input type="number" class="form-control" value="<?php echo $phno ?>" name="phno">
														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Roll Number</label>
															<input type="text" class="form-control" value="<?php echo $rollnumber ?>" name="rollnumber">
														</div>
													</div>
												</div>


												<div class="row">
													<div class="col-sm-12">
														<div class="form-group mb-0">
															<label>Address</label>
															<input type="text" class="form-control" value="<?php echo $address ?>" name="address">
															<input type="hidden" name="update">
														</div>
													</div>
												</div>
												<div class="text-center">
													<button class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Update Details</button>
													<a href="profile.php" class="btn btn-danger text-white ctm-border-radius mt-4" name="cancel">Cancel</a>
												</div>
											</form>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/Content-->
		</div>
		<!-- Inner Wrapper -->

		<div class="sidebar-overlay" id="sidebar_overlay"></div>
		<?php include_once('common/footer.php'); ?>
	</body>

	</html>