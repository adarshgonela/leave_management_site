<?php
session_start();
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
										<h4 class="card-title mb-0">Add Student</h4>
									</div>
									<div class="card-body">
										<form>
											<div class="row">
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Student Email</label>
														<input type="email" class="form-control" placeholder="Student Email">
													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Student Password</label>
														<input type="text" class="form-control datetimepicker" placeholder="Student Password">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Student Name</label>
														<input type="text" class="form-control datetimepicker" placeholder="Student Name">
													</div>
												</div>
												<div class="col-sm-6 leave-col">
													<div class="form-group">
														<label>Student confirm Password</label>
														<input type="text" class="form-control datetimepicker" placeholder="Student Confirm Password">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Student RollNumber</label>
														<input type="text" class="form-control datetimepicker" placeholder="Student RollNumber">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Role</label>
														<input type="text" class="form-control datetimepicker" value="student" disabled>
													</div>
												</div>
											</div>
											<div class="text-center">
												<a href="javascript:void(0);" class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Apply</a>
												<a href="javascript:void(0);" class="btn btn-danger text-white ctm-border-radius mt-4">Cancel</a>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- <div class="col-md-12">
									<div class="card ctm-border-radius shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0">Leave Details</h4>
										</div>
										<div class="card-body">
											<div class="employee-office-table">
												<div class="table-responsive">
													<table class="table custom-table mb-0">
														<thead>
															<tr>
																<th>Date</th>
																<th>Total Employees</th>
																<th>First Half</th>
																<th>Second Half</th>
																<th>Working From Home</th>
																<th>Absent</th>
																<th>Today Aways</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>05 May 2019</td>
																<td>7</td>
																<td>6</td>
																<td>6</td>
																<td>1</td>
																<td>0</td>
																<td>1</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div> -->
							<div class="col-md-12">

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