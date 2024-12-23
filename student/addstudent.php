<?php 
include_once ('../db.php');
$sql="SELECT * FROM user where id=1";
$result=mysqli_query($conn,$sql);

while ($row=mysqli_fetch_assoc($result)) {
	
	$name=$row['name'];
?>
<!DOCTYPE html>
<html lang="en">
	
<head>
	
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
						<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
							<aside class="sidebar sidebar-user">
								<div class="row">
								<div class="col-12">
								<div class="card ctm-border-radius shadow-sm grow">
									<div class="card-body py-4">
										<div class="row">
											<div class="col-md-12 mr-auto text-left">
												<div class="custom-search input-group">
													<div class="custom-breadcrumb">
														<ol class="breadcrumb no-bg-color d-inline-block p-0 m-0 mb-2">
															<li class="breadcrumb-item d-inline-block"><a href="index.html" class="text-dark">Home</a></li>
															<li class="breadcrumb-item d-inline-block active">students</li>
														</ol>
														<h4 class="text-dark">Add student</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
							</div>
								<!-- Sidebar -->
								<div class="sidebar-wrapper d-lg-block d-md-none d-none">
									<div class="card ctm-border-radius shadow-sm grow border-none">
										<div class="card-body">
											<div class="row no-gutters">
												<div class="col-6 align-items-center text-center">
													<a href="index.html" class="text-dark p-4 first-slider-btn ctm-border-right ctm-border-left ctm-border-top"><span class="lnr lnr-home pr-0 pb-lg-2 font-23"></span><span class="">Dashboard</span></a>												
												</div>
												
												<div class="col-6 align-items-center shadow-none text-center">												
													<a href="calendar.html" class="text-dark p-4 ctm-border-right"><span class="lnr lnr-calendar-full pr-0 pb-lg-2 font-23"></span><span class="">Calendar</span></a>												
												</div>
												<div class="col-6 align-items-center shadow-none text-center">											
													<a href="leave.html" class="text-dark p-4 ctm-border-right ctm-border-left"><span class="lnr lnr-briefcase pr-0 pb-lg-2 font-23"></span><span class="">Leave</span></a>											
												</div>
												
												<div class="col-6 align-items-center shadow-none text-center">												
													<a href="reports.html" class="text-dark p-4 ctm-border-right ctm-border-left"><span class="lnr lnr-rocket pr-0 pb-lg-2 font-23"></span><span class="">Reports</span></a>												
												</div>
												
										</div>
									</div>
								</div>
								
								<!-- /Sidebar -->
								<div class="card ctm-border-radius shadow-sm grow">
									<div class="card-header">
										<h4 class="card-title mb-0">Details Content</h4>
									</div>
									<div class="card-body">
										<div id="list-example" class="list-group border-none">
											<a class="list-group-item list-group-item-action border-none" href="javascript:void(0)">student details</a>
											
									</div>
								</div>
							</aside>
						</div>
						
						<div class="col-xl-9 col-lg-8  col-md-12">
							
							<div class="accordion add-employee" id="accordion-details">
								<div class="card shadow-sm grow ctm-border-radius">
									<div class="card-header" id="basic1">
										<h4 class="cursor-pointer mb-0">
											<a class=" coll-arrow d-block text-dark" href="javascript:void(0)" data-toggle="collapse" data-target="#basic-one" aria-expanded="true">
												Basic student Details
											<br><span class="ctm-text-sm">Organized and secure.</span>
											</a>
										</h4>
									</div>
									<div class="card-body p-0">
										<div id="basic-one" class="collapse show ctm-padding" aria-labelledby="basic1" data-parent="#accordion-details">
											<form>
												<div class="row">
													<div class="col form-group">
														<input type="text" class="form-control" placeholder="name">
													</div>
													<div class="col form-group">
														<input type="text" class="form-control" placeholder="roll">
													</div>
													<div class="col-12 form-group">
														<input type="email" class="form-control" placeholder="Email">
													</div>
												</div>
												<div class="col-12 form-group">
													<input type="email" class="form-control" placeholder="address">
												</div>
												<div class="row">
													<div class="col-md-12 form-group">
														<select class="form-control select">
															<option selected>gender </option>
															<option value="1">male</option>
															<option value="2">female</option>
															
														</select>
													
												</div>
													<div class="col-md-12">
														<div class=" custom-control custom-checkbox mb-0">
															<input type="checkbox" id="send-email" name="send-email" class="custom-control-input">
															<label class="mb-0 custom-control-label" for="send-email">Send them an invite email so they can log in immediately</label>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								
			<!--/Content-->
			
		</div>
		<!-- Inner Wrapper -->
		<?php   }  ?>
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