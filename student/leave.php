<?php
session_start();
include_once('../db.php');
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
    $noofleaves = $row['remainingleaves']; // Get current number of leaves of the student
    
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


    $startDate = new DateTime($fromdate);
    $endDate = new DateTime($todate);

    $interval = $startDate->diff($endDate);

    $days = $interval->days;

    // Validate date range
    if (strtotime($fromdate) > strtotime($todate)) {
        $error = "The from date cannot be after the to date.";
        exit();
    }

    $date = DateTime::createFromFormat('Y-m-d', $fromdate);
    $fromdaterev = $date->format('d-m-Y');
    $date = DateTime::createFromFormat('Y-m-d', $todate);
    $todaterev = $date->format('d-m-Y');

    // Check if the student has enough leave balance
    if ($noofleaves < $days) {
        $error = "You do not have enough leaves.";
        exit();
    }

    // Insert the leave request
    $sql = "INSERT INTO leaves (studentrollnumber, leavetype, reason, todate, fromdate, hodrollnumber, classinchargerollnumber, status, applyingtime, noofdaystaken) 
            VALUES ('$studentrollnumber', '$leavetype', '$reason', '$todaterev', '$fromdaterev', '$hodrollnumber', '$classinchargerollnumber', 'pending', NOW(), '$days')";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        // Update the remaining leaves
        $newnoofleaves = $noofleaves - $days;
        $update_sql = "UPDATE user SET remainingleaves='$newnoofleaves' WHERE rollnumber='$studentrollnumber'";
        $update_result = mysqli_query($conn, $update_sql);
        
        if ($update_result) {
            $error = "Leave applied successfully. Remaining leaves: $newnoofleaves";
            // Optionally redirect to a confirmation page
            header('Location: leave.php?msg=leave applied');
            exit();
        } else {
            $error = "Error updating the number of leaves. Please try again.";
        }
    } else {
        $error = "Error applying for leave. Please try again.";
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

														<?php
$studentrollnumber = mysqli_real_escape_string($conn, $_SESSION['rollnumber']);
$sql = "SELECT remainingleaves FROM user WHERE rollnumber = '$studentrollnumber'";
$result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $remaining_leaves = $row['remainingleaves'];
?>


														<input type="text" class="form-control" value="<?php echo $remaining_leaves?>"  disabled>
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
															<th>Date Applied</th>
															<th>Leave Type</th>
															<th>From</th>
															<th>To</th>
															<!-- <th>Days</th> -->
															<!-- <th>Remaining Days</th> -->
															<th>Reason</th>
															<th>Status</th>
															<!-- <th class="text-right">Action</th> -->

														</tr>
													</thead>
													<tbody>
														<?php
														include_once('../db.php');
														$limit = 10;
														$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
														$offset = ($page - 1) * $limit;

														$result = $conn->query("SELECT COUNT(*) AS total FROM leaves WHERE studentrollnumber = '$rollnumber'");
														$row = $result->fetch_assoc();
														$total_rows = $row['total'];
														$total_pages = ceil($total_rows / $limit); //50/10=5

														$sql = "SELECT * FROM leaves WHERE studentrollnumber = '$rollnumber' AND DATE(applyingtime) = CURDATE() LIMIT $offset, $limit";

														$result = mysqli_query($conn, $sql);

														while ($row = mysqli_fetch_assoc($result)) {
															$leavetype = $row['leavetype'];
															$rollnumber = $row['studentrollnumber'];
															$todate = $row['todate'];
															$fromdate = $row['fromdate'];
															$status = $row['status'];
															$reason = $row['reason'];
														?>
															<tr>
																<td>
																	<?php echo $rollnumber ?>
																</td>
																<td><?php  echo $row['applyingtime']?></td>
																<td><?php echo $leavetype ?></td>
																<td><?php echo $fromdate ?></td>
																<td><?php echo $todate ?></td>
																<td><?php echo $reason ?></td>
																<td><a href="javascript:void(0)" class="btn btn-theme ctm-border-radius text-white btn-sm">Approved</a></td>
																<!-- <td class="text-right text-danger"><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete">
																		<span class="lnr lnr-trash"></span> Delete
																	</a></td>
																<td class="text-right text-danger"><a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#delete">
																		<span class="lnr lnr-trash"></span> Update
																	</a></td> -->
															</tr>
														<?php  }  ?>
													</tbody>
												</table>
												<nav aria-label="Page navigation example">
													<ul class="pagination justify-content-center">
														<li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
															<a class="page-link" href="<?php echo ($page > 1) ? '?page=' . ($page - 1) : '#'; ?>">Previous</a>
														</li>

														<?php
														for ($i = 1; $i <= $total_pages; $i++) {
															if ($i == $page) {
																echo "<li class='page-item active'><span class='page-link'>$i</span></li>";  // Current page
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