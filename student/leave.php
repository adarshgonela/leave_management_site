<?php 



?>
<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from dleohr.dreamstechnologies.com/template-1/dleohr-vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Dec 2024 03:17:35 GMT -->
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
		
		<title>student Dashboard</title>
				
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
			<?php  include_once ('common/header.php');  ?>
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
							include_once ('common/sidebar.php');  ?>
								
								<!-- /Sidebar -->
								
								
							</aside>
						</div>
						
						<div class="col-xl-9 col-lg-8 col-md-12">
							
							<div class="row">
								<div class="col-md-12">
									<div class="card ctm-border-radius shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0">Apply Leaves</h4>
										</div>
										<div class="card-body">
											<form>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>
															Leave Type
															<span class="text-danger">*</span>
															</label>
															<select class="form-control select">
																<option>Select Leave</option>
																<option>Sick Leave</option>
																<option>Personal Leave</option>
																<option>Emergency Leave</option>
																<option>vacation Leave</option>
																<option>casual Leave</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Remaining Leaves</label>
															<input type="text" class="form-control" placeholder="10" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>From</label>
															<input type="text" class="form-control datetimepicker">
														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>To</label>
															<input type="text" class="form-control datetimepicker">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>
															Half Day
															<span class="text-danger">*</span>
															</label>
															<select class="form-control select">
																<option>Select</option>
																<option>First Half</option>
																<option>Second Half</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Number of Days Leave</label>
															<input type="text" class="form-control" placeholder="2" disabled>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group mb-0">
															<label>Reason</label>
															<textarea class="form-control" rows=4></textarea>
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
								<div class="col-md-12">
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
														include_once ('../db.php');
														$sql="SELECT * FROM leaves where id=1";
														$result=mysqli_query($conn,$sql);
														
														while ($row=mysqli_fetch_assoc($result)) {
														$leavetype=$row['leavetype'];
															
															$rollnumber=$row['rollnumber'];
														$todate=$row['todate'];
														$fromdate=$row['fromdate'];
														$status=$row['status'];
														$reason=$row['reason'];


														
														
														
														?>

															<tr>
																<td>
																<?php  echo $rollnumber ?>
																</td>
																<td><?php  echo $leavetype ?></td>
																<td><?php  echo $fromdate ?></td>
																<td><?php  echo $todate ?></td>
																<!-- <td>3</td> -->
																<!-- <td>9</td> -->
																<td><?php  echo $reason ?></td>


																

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
		
		<!-- jQuery -->
		<script src="../assets/js/jquery-3.2.1.min.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="../assets/js/popper.min.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>
		<script src="../assets/js/bootstrap.min.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>
				
		<!-- Chart JS -->
		<script src="../assets/js/Chart.min.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>
		<script src="../assets/js/chart.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>
		
		<!-- Sticky sidebar JS -->
		<script src="../assets/plugins/theia-sticky-sidebar/ResizeSensor.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>		
		<script src="../assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>		
			
		<!-- Custom Js -->
		<script src="../assets/js/script.js" type="1c3b3b47cad5cf489fe0065f-text/javascript"></script>
		
	<script src="../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="1c3b3b47cad5cf489fe0065f-|49" defer></script></body>

<!-- Mirrored from dleohr.dreamstechnologies.com/template-1/dleohr-vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Dec 2024 03:17:42 GMT -->
</html>