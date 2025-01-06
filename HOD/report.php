<?php
session_start();
$error = "";
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
															<th>Days</th>
															<!-- <th>Remaining Days</th> -->
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
														$result = $conn->query("SELECT COUNT(*) AS total FROM leaves");
														$row = $result->fetch_assoc();
														$total_rows = $row['total'];
														$total_pages = ceil($total_rows / $limit); // For example: 50/10 = 5 pages

														// Fetch leaves data with pagination
														$sql = "SELECT * FROM leaves ORDER BY id DESC LIMIT $offset, $limit";

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
																	<td>
																		<select class="btn btn-theme ctm-border-radius text-white btn-sm" name="status">
																			<option value="<?php echo $status; ?>"><?php echo $status; ?></option>
																			<option value="pending">Pending</option>
																			<option value="Approved">Approved</option>
																			<option value="rejected">Rejected</option>
																		</select>
																	</td>
																	<!-- <td class="text-right text-danger">
																		<button type="submit" class="btn btn-sm btn-outline-danger">
																			<span class="lnr lnr-trash"></span> Update
																		</button>
																	</td> -->
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
	<?php include_once('common/footer.php') ?>
</body>

</html>