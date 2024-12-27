<?php
session_start();
include_once('../auth/conn.php');
$error="";
// Check if the user is logged in
if (!isset($_SESSION['rollnumber'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['leave'])) {
    // Sanitize roll number from session
    $studentrollnumber = mysqli_real_escape_string($conn, $_SESSION['rollnumber']);
    
    // Query to get user information (department of the student)
    $sql = "SELECT * FROM user WHERE rollnumber='$studentrollnumber'";
    $result = mysqli_query($conn, $sql);
    
    // Check if the query was successful
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }
    
    // Fetch user data
    $row = mysqli_fetch_assoc($result);
    $dept = $row['department']; // Get the department of the student
    
    // Query to fetch HOD information from the same department
    $sql1 = "SELECT * FROM user WHERE role='hod' AND department='$dept'";
    $result1 = mysqli_query($conn, $sql1);
    
    if (!$result1 || mysqli_num_rows($result1) == 0) {
        die('Error: HOD not found for the department');
    }
    
    // Fetch HOD data
    $row1 = mysqli_fetch_assoc($result1);
    $hodrollnumber = $row1['rollnumber']; 

    // Query to fetch Class Incharge information from the same department
    $sql2 = "SELECT * FROM user WHERE role='classincharge' AND department='$dept'";
    $result2 = mysqli_query($conn, $sql2);
    
    if (!$result2 || mysqli_num_rows($result2) == 0) {
        die('Error: Class Incharge not found for the department');
    }

    // Fetch Class Incharge data
    $row2 = mysqli_fetch_assoc($result2);
    $classinchargerollnumber = $row2['rollnumber']; 

    $leavetype = mysqli_real_escape_string($conn, $_REQUEST['leavetype']);
    $reason = mysqli_real_escape_string($conn, $_REQUEST['reason']);
    $todate = mysqli_real_escape_string($conn, $_REQUEST['todate']);
    $fromdate = mysqli_real_escape_string($conn, $_REQUEST['fromdate']);

    // Validate date range
    if (strtotime($fromdate) > strtotime($todate)) {
        $error= "The from date cannot be after the to date.";
        exit();
    }

    // Insert the leave request
    $sql = "INSERT INTO leaves (studentrollnumber, leavetype, reason, todate, fromdate, hodrollnumber, classinchargerollnumber,status,applyingtime) 
            VALUES ('$studentrollnumber', '$leavetype', '$reason', '$todate', '$fromdate', '$hodrollnumber', '$classinchargerollnumber','pending',NOW())";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $error= "Leave applied successfully.";
        // Optionally redirect to a confirmation page
        header('Location: leave.php?msg=leave applied');
        exit();
    } else {
        $error= "Error applying for leave. Please try again.";
    }  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Required meta tags -->
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
																<li class="breadcrumb-item d-inline-block"><a href="index.html" class="text-dark">Home</a></li>
																<li class="breadcrumb-item d-inline-block active">Leave</li>
															</ol>
															<h4 class="text-dark">Leave</h4>
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
													 <!-- Error Message Display -->

								 <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
										<h4 class="card-title mb-0">Apply Leaves</h4>
									</div>
									<div class="card-body">
							

										<form action="leave.php" method="post">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>
															Leave Type
															<span class="text-danger">*</span>
														</label>
														<select class="form-control select" name="leavetype">
															<option>Select Leave</option>
															<option value="sick leaves">Sick Leave</option>
															<option value="Personal Leave">Personal Leave</option>
															<option value="Emergency Leave">Emergency Leave</option>
															<option value="vacation Leave">vacation Leave</option>
															<option value="casual Leave">casual Leave</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Remaining Leaves</label>
														<input type="text" class="form-control" placeholder="10"  disabled>
														<input type="hidden" name="leave">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>From</label>
														<input type="date" class="form-control datetimepicker" name="fromdate">
													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>To</label>
														<input type="date" class="form-control datetimepicker" name="todate">
													</div>
												</div>
											</div>
											<div class="row">
												<?php
												$sql = "SELECT * FROM user";
												$result = mysqli_query($conn, $sql);
												$row = mysqli_fetch_assoc($result);

												?>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Department</label>
														<input type="text" class="form-control datetimepicker" placeholder="<?php echo $row['department']; ?>" disabled>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Year and Semister</label>
														<input type="text" class="form-control datetimepicker" placeholder="<?php echo $row['yearsem']; ?>" disabled>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group mb-0">
														<label>Reason</label>
														<textarea class="form-control" rows=4 name="reason"></textarea>
													</div>
												</div>
											</div>
											<div class="text-center">
												<button type="submit" class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Apply</button>
												<a href="javascript:void(0);" class="btn btn-danger text-white ctm-border-radius mt-4">Cancel</a>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="card ctm-border-radius shadow-sm grow">
									<div class="card-header">
										<h4 class="card-title mb-0">Today Leaves</h4>
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
															<!-- <th>Days</th> -->
															<!-- <th>Remaining Days</th> -->
															<th>Reason</th>
															<th>Status</th>
															<th class="text-right">Action</th>

														</tr>
													</thead>
													<tbody>
														<?php
														include_once('../db.php');
														$sql = "SELECT * FROM leaves where id=1";
														$result = mysqli_query($conn, $sql);

														while ($row = mysqli_fetch_assoc($result)) {
															$leavetype = $row['leavetype'];

															$rollnumber = $row['rollnumber'];
															$todate = $row['todate'];
															$fromdate = $row['fromdate'];
															$status = $row['status'];
															$reason = $row['reason'];





														?>

															<tr>
																<td>
																	<?php echo $rollnumber ?>
																</td>
																<td><?php echo $leavetype ?></td>
																<td><?php echo $fromdate ?></td>
																<td><?php echo $todate ?></td>
																<!-- <td>3</td> -->
																<!-- <td>9</td> -->
																<td><?php echo $reason ?></td>




																<td><a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm">Approved</a></td>
																<td class="text-right text-danger"><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete">
																		<span class="lnr lnr-trash"></span> Delete
																	</a></td>
																<td class="text-right text-danger"><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete">
																		<span class="lnr lnr-trash"></span> Update
																	</a></td>
															</tr>
														<?php  }  ?>
													</tbody>
												</table>
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