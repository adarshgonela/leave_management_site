<?php
session_start();
include_once('../db.php');
$rollnumber = $_REQUEST['rollnumber'];
$sql = "SELECT * FROM user where rollnumber='$rollnumber'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$email = $row['email'];
$name = $row['name'];
$phno = $row['phno'];
$gender = $row['gender'];
$address = $row['address'];
$id = $row['id'];
$department = $row['department'];
$yearsem = $row['yearsem'];
$image = $row['profileimg'];

$base64Image = base64_encode($image);

// if (isset($_POST['update'])) {
// 	$new_email = $_REQUEST['email'];
// 	$new_name = $_REQUEST['name'];
// 	$new_phno = $_REQUEST['phno'];
// 	$new_rollnumber = $_REQUEST['rollnumber'];
// 	$new_gender = $_REQUEST['gender'];
// 	$new_address = $_REQUEST['address'];
// 	$new_department = $_REQUEST['department'];
// 	$new_yearsem = $_REQUEST['yearsem'];
// 	$user_id = $_REQUEST['id'];

//   if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
// 	$imageTmpName = $_FILES['image']['tmp_name'];
// 	$imageData = file_get_contents($imageTmpName);
// } else {
// 	$imageData = null;  
// }
// 	$sql = "UPDATE user SET email = ?, name = ?, phno = ?, rollnumber = ?, gender = ?, address = ?, department = ?, yearsem = ?, profileimg = ? WHERE id = ?";

// 	$stmt = $conn->prepare($sql);

// 	// Check if the statement was prepared successfully
// 	if ($stmt === false) {
// 		die("Error preparing the statement: " . $conn->error);
// 	}

// 	// Bind the parameters to the statement
// 	$stmt->bind_param("sssssssssi", $new_email, $new_name, $new_phno, $new_rollnumber, $new_gender, $new_address, $new_department, $new_yearsem, $imageData, $user_id);

// 	// Execute the query
// 	if ($stmt->execute()) {
// 		echo "Record updated successfully";
// 	} else {
// 		echo "Error updating record: " . $stmt->error;
// 	}

// 	// Close the statement and connection
// 	$stmt->close();
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include_once('common/header.php'); ?>
</head>

<body>

	<!-- Inner wrapper -->
	<div class="inner-wrapper">


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


											<div class="col-12">
												<div class="avatar-upload">
													<div class="avatar-edit">
														<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
														<label for="imageUpload"></label>
													</div>
													<div class="avatar-preview">
														<!-- <div id="imagePreview"> -->
															<img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="No Profile Img">

														<!-- </div> -->
													</div>
												</div>
											</div>






											<div class="row">

												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Name</label>
														<input type="text" class="form-control" value="<?php echo $name ?>" name="name" disabled>

													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Email</label>
														<input type="email" class="form-control" value="<?php echo $email ?>" name="email" disabled>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>
															Gender
															<span class="text-danger">*</span>
														</label>

														<select class="form-control select" name="gender" value="<?php echo $gender ?>" disabled>
															<option value=""><?php echo $gender ?></option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" class="form-control" value="<?php echo $phno ?>" name="phno" disabled>
													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Roll Number</label>
														<input type="text" class="form-control" value="<?php echo $rollnumber ?>" name="rollnumber" disabled>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>
															Department
															<span class="text-danger">*</span>
														</label>
														<select class="form-control select" name="department" disabled>
															<option><?php echo $department; ?></option>
															<option value="ECE">ECE</option>
															<option value="CSE">CSE</option>
															<option value="CIVIL">CIVIL</option>
															<option value="MECH">MECH</option>
															<option value="CSD">CSD</option>
															<option value="AIML">AIML</option>


														</select>
													</div>
												</div>
											</div>




											<div class="col-sm-6">
												<div class="form-group">
													<label>
														year and sem
														<span class="text-danger">*</span>
													</label>
													<select class="form-control select" name="yearsem" disabled>
														<option><?php echo $yearsem; ?></option>
														<option value="1-1">1-1</option>
														<option value="1-2">1-2</option>
														<option value="2-1">2-1</option>
														<option value="2-2">2-2</option>
														<option value="3-1">3-1</option>
														<option value="3-2">3-2</option>
														<option value="4-1">4-1</option>
														<option value="4-2">4-2</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group mb-0">
														<label>Address</label>
														<input type="text" class="form-control" value="<?php echo $address ?>" name="address" disabled>
														<input type="hidden" name="update">
													</div>
												</div>
											</div>
											<!-- <div class="text-center">
												<button class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Update Details</button>
												<a href="profile.php" class="btn btn-danger text-white ctm-border-radius mt-4" name="cancel">Cancel</a>
											</div> -->

										</form>

									</div>
									<div class="card-body">
										<div class="employee-office-table">
											<div class="table-responsive">
												<table class="table custom-table mb-0">
													<thead>
														<tr>
															<th>Roll Number</th>
															<th>Leave Type</th>
															<th>From</th>
															<th>To</th>
															<th>Days</th>
															<th>Reason</th>
															<th>Status</th>
															<!-- <th class="text-right">Action</th> -->
															<th>Applying Time</th>
														</tr>
													</thead>
													<tbody>
														<?php
														include_once('../db.php');
														$limit = 10;
														$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
														$offset = ($page - 1) * $limit;

														// Get total number of leaves
														$result = $conn->query("SELECT COUNT(*) AS total FROM leaves WHERE studentrollnumber = '$rollnumber'");
														$row = $result->fetch_assoc();
														$total_rows = $row['total'];
														$total_pages = ceil($total_rows / $limit); // For example: 50/10 = 5 pages

														// Fetch leaves data with pagination
														$sql = "SELECT * FROM leaves WHERE studentrollnumber = '$rollnumber' ORDER BY id DESC LIMIT $offset, $limit";


														$result = mysqli_query($conn, $sql);

														while ($row = mysqli_fetch_assoc($result)) {
															$leavetype = $row['leavetype'];
															$rollnumber = $row['studentrollnumber'];
															$todate = $row['todate'];
															$fromdate = $row['fromdate'];
															$days = $row['noofdaystaken'];
															$status = $row['status'];
															$reason = $row['reason'];
															$time = $row['applyingtime'];

															// Get student name or other info from the user table, if needed
															$user_sql = "SELECT name FROM user WHERE rollnumber = '$rollnumber'";
															$user_result = mysqli_query($conn, $user_sql);
															$user_row = mysqli_fetch_assoc($user_result);
															// $student_name = $user_row['name'];
														?>
															<tr>
																<td><?php echo $rollnumber; ?></td>
																<td><?php echo $leavetype; ?></td>
																<td><?php echo $fromdate; ?></td>
																<td><?php echo $todate; ?></td>
																<td><?php echo $days; ?></td>
																<td><?php echo $reason; ?></td>
																<form action="redirect/leaveupdate.php?studentrollnumber=<?php echo $rollnumber; ?>" method="POST">
																	<td class="btn btn-theme ctm-border-radius text-white btn-sm">
																		<?php echo $status; ?>
																	</td>
																</form>
																<td><?php echo $time; ?></td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

												<!-- Pagination controls -->
												<nav aria-label="Page navigation example">
													<ul class="pagination justify-content-center">
														<li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
															<a class="page-link" href="<?php echo ($page > 1) ? '?page=' . ($page - 1) : '#'; ?>">Previous</a>
														</li>

														<?php
														// Loop through all the page numbers
														for ($i = 1; $i <= $total_pages; $i++) {
															if ($i == $page) {
																echo "<li class='page-item active'><span class='page-link'>$i</span></li>"; // Current page
															} else {
																echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
															}
														}
														?>

														<li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
															<a class="page-link" href="<?php echo ($page < $total_pages) ? '?page=' . ($page + 1) : '#'; ?>">Next</a>
														</li>
													</ul>
												</nav>

											</div>
										</div>
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