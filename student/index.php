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
															<!-- <ol class="breadcrumb no-bg-color d-inline-block p-0 m-0 mb-2">
																<li class="breadcrumb-item d-inline-block"><a href="index.html" class="text-dark">Home</a></li>
																<li class="breadcrumb-item d-inline-block active">Dashboard</li>
															</ol> -->
															<h4 class="text-dark">Student Dashboard</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								<div class="user-card card shadow-sm bg-white text-center ctm-border-radius grow">
									<div class="user-info card-body">
										<div class="user-avatar mb-4">
											<img src="../assets/img/profiles/img-13.jpg" alt="User Avatar" class="img-fluid rounded-circle" width="100">
										</div>
										<div class="user-details">
											<h4><b>Welcome <?php echo $name ?></b></h4>
											<p>Sun, 29 Nov 2019</p>
										</div>
									</div>
								</div>
								<!-- Sidebar -->
								<?php  include_once('common/sidebar.php') ?>
								
								<!-- /Sidebar -->
								
							</aside>
						</div>
						
						<div class="col-xl-9 col-lg-8  col-md-12">
							<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm bg-white card grow">
									<div class="card-body">
										<marquee behavior="" direction="left">Every student should maintain 65% attendence</marquee>
									</div>
									<!-- <div class="card-body">
										<ul class="list-group list-group-horizontal-lg">
											<li class="list-group-item text-center active button-5"><a href="index.html" class="text-white">Admin Dashboard</a></li>
											<li class="list-group-item text-center button-6"><a class="text-dark" href="employees-dashboard.html">Employees Dashboard</a></li>
										</ul>
									</div> -->
								</div>
							<!-- Widget -->
							<div class="row">
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="card dash-widget ctm-border-radius shadow-sm grow">
										<div class="card-body">
											<div class="card-icon bg-primary">
												<i class="fa fa-users" aria-hidden="true"></i>
											</div>
											<div class="card-right">
												<h4 class="card-title">Pending   leaves</h4>
												<p class="card-text">25</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-6 col-sm-6 col-12">
									<div class="card dash-widget ctm-border-radius shadow-sm grow">
										<div class="card-body">
											<div class="card-icon bg-warning">
												<i class="fa fa-building-o"></i>
											</div>
											<div class="card-right">
												<h4 class="card-title">Remaining leaves</h4>
												<p class="card-text">30</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-6 col-sm-6 col-12">
									<div class="card dash-widget ctm-border-radius shadow-sm grow">
										<div class="card-body">
											<div class="card-icon bg-danger">
												<i class="fa fa-suitcase" aria-hidden="true"></i>
											</div>
											<div class="card-right">
												<h4 class="card-title">Approved Leaves</h4>
												<p class="card-text">3</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-6 col-sm-6 col-12">
									<div class="card dash-widget ctm-border-radius shadow-sm grow">
										<div class="card-body">
											<div class="card-icon bg-success">
												<i class="fa fa-money" aria-hidden="true"></i>
											</div>
											<div class="card-right">
												<h4 class="card-title">Salary</h4>
												<p class="card-text">$5.8M</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- / Widget -->
							
							<!-- Chart -->
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card ctm-border-radius shadow-sm flex-fill grow">
										<div class="card-header">
											<h4 class="card-title mb-0">Total Employees</h4>
										</div>
										<div class="card-body">
											<canvas id="pieChart"></canvas>
										</div>
									</div>
								</div>
								<!-- <div class="col-md-6 d-flex">
									<div class="card ctm-border-radius shadow-sm flex-fill grow">
										<div class="card-header">
											<h4 class="card-title mb-0">Total Salary By Unit</h4>
										</div>
										<div class="card-body">
											<canvas id="lineChart"></canvas>
										</div>
									</div>
								</div> -->
							</div>
							<!-- / Chart -->
							
							<div class="row">
								<div class="col-lg-6">
									<div class="card ctm-border-radius shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0 d-inline-block">Today</h4>
											<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="lnr lnr-sync"></i></a>
										</div>
										<div class="card-body recent-activ">
											<div class="recent-comment">
												<a href="javascript:void(0)" class="dash-card text-dark">
													<div class="dash-card-container">
														<div class="dash-card-icon text-primary">
															<i class="fa fa-birthday-cake" aria-hidden="true"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">No Birthdays Today</h6>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-dark">
													<div class="dash-card-container">
														<div class="dash-card-icon text-warning">
															<i class="fa fa-bed" aria-hidden="true"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Ralph Baker is off sick today</h6>
														</div>
														<div class="dash-card-avatars">
															<!-- <div class="e-avatar"><img class="img-fluid" src="../assets/img/profiles/img-9.jpg" alt="Avatar"></div> -->
															<div class="e-avatar"><img class="img-fluid" src="../assets/img/profiles/img-9.jpg" alt="Avatar"></div>
														
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-dark">
													<div class="dash-card-container">
														<div class="dash-card-icon text-success">
															<i class="fa fa-child" aria-hidden="true"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Ralph Baker is parenting leave today</h6>
														</div>
														<div class="dash-card-avatars">
															<div class="e-avatar"><img class="img-fluid" src="../assets/img/profiles/img-9.jpg" alt="Avatar"></div>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-dark">
													<div class="dash-card-container">
														<div class="dash-card-icon text-danger">
															<i class="fa fa-suitcase"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Danny ward is away today</h6>
														</div>
														<div class="dash-card-avatars">
															<div class="e-avatar"><img class="img-fluid" src="../assets/img/profiles/img-5.jpg" alt="Avatar"></div>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-dark">
													<div class="dash-card-container">
														<div class="dash-card-icon text-pink">
															<i class="fa fa-home" aria-hidden="true"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">You are working from home today</h6>
														</div>
														<div class="dash-card-avatars">
															<div class="e-avatar"><img class="img-fluid" src="../assets/img/profiles/img-6.jpg" alt="Maria Cotton"></div>
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-12 d-flex">
								
									<!-- Team Leads List -->
									<div class="card flex-fill team-lead shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0 d-inline-block">Team Leads </h4>
											<a href="employees.html" class="dash-card float-right mb-0 text-primary">Manage Team </a>
										</div>
										<div class="card-body">
											<div class="media mb-3">
												<div class="e-avatar avatar-online mr-3"><img src="../assets/img/profiles/img-6.jpg" alt="Maria Cotton" class="img-fluid"></div>
												<div class="media-body">
													<h6 class="m-0">Maria Cotton</h6>
													<p class="mb-0 ctm-text-sm">PHP</p>
												</div>
											</div>
											<hr>
											<div class="media mb-3">
												<div class="e-avatar avatar-online mr-3"><img class="img-fluid" src="../assets/img/profiles/img-5.jpg" alt="Linda Craver"></div>
												<div class="media-body">
													<h6 class="m-0">Danny Ward</h6>
													<p class="mb-0 ctm-text-sm">Design</p>
												</div>
											</div>
											<hr>
											<div class="media mb-3">
												<div class="e-avatar avatar-online mr-3"><img src="../assets/img/profiles/img-4.jpg" alt="Linda Craver" class="img-fluid"></div>
												<div class="media-body">
													<h6 class="m-0">Linda Craver</h6>
													<p class="mb-0 ctm-text-sm">IOS</p>
												</div>
											</div>
											<hr>
											<div class="media mb-3">
												<div class="e-avatar avatar-online mr-3"><img class="img-fluid" src="../assets/img/profiles/img-3.jpg" alt="Linda Craver"></div>
												<div class="media-body">
													<h6 class="m-0">Jenni Sims</h6>
													<p class="mb-0 ctm-text-sm">Android</p>
												</div>
											</div>
											<hr>
											<div class="media">
												<div class="e-avatar avatar-offline mr-3"><img class="img-fluid" src="../assets/img/profiles/img-2.jpg" alt="Linda Craver"></div>
												<div class="media-body">
													<h6 class="m-0">John Gibbs</h6>
													<p class="mb-0 ctm-text-sm">Business</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-6 col-md-12 d-flex">
								
									<!-- Recent Activities -->
									<div class="card recent-acti flex-fill shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0 d-inline-block">Recent Activities</h4>
											<a href="javascript:void(0)" class="d-inline-block float-right text-primary"><i class="lnr lnr-sync"></i></a>
										</div>
										<div class="card-body recent-activ admin-activ">
											<div class="recent-comment">
												<div class="notice-board">
													<div class="table-img">
														<div class="e-avatar mr-3"><img class="img-fluid" src="../assets/img/profiles/img-5.jpg" alt="Danny Ward"></div>
													</div>
													<div class="notice-body">
														<h6 class="mb-0">Lorem ipsum dolor sit amet, id id quo eruditi eloquentiam.</h6>
														<span class="ctm-text-sm">Danny Ward | 1 hour ago</span>
													</div>
												</div>
												<hr>
												<div class="notice-board">
													<div class="table-img">
														<div class="e-avatar mr-3"><img class="img-fluid" src="../assets/img/profiles/img-2.jpg" alt="John Gibbs"></div>
													</div>
													<div class="notice-body">
														<h6 class="mb-0">Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.</h6>
														<span class="ctm-text-sm">John Gibbs | 2 hour ago</span>
													</div>
												</div>
												<hr>
												<div class="notice-board">
													<div class="table-img">
														<div class="e-avatar mr-3"><img class="img-fluid" src="../assets/img/profiles/img-6.jpg" alt="Maria Cotton"></div>
													</div>
													<div class="notice-body">
														<h6 class="mb-0">Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.</h6>
														<span class="ctm-text-sm">Maria Cotton | 4 hour ago</span>
													</div>
												</div>
												<hr>
												<div class="notice-board">
													<div class="table-img">
														<div class="e-avatar mr-3"><img class="img-fluid" src="../assets/img/profiles/img-4.jpg" alt="Linda Craver"></div>
													</div>
													<div class="notice-body">
														<h6 class="mb-0">Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.</h6>
														<span class="ctm-text-sm">Linda Craver | 5 hour ago</span>
													</div>
												</div>
												<hr>
												<div class="notice-board">
													<div class="table-img">
														<div class="e-avatar mr-3"><img class="img-fluid" src="../assets/img/profiles/img-3.jpg" alt="Jenni Sims"></div>
													</div>
													<div class="notice-body">
														<h6 class="mb-0">Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.</h6>
														<span class="ctm-text-sm">Jenni Sims | 6 hour ago</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- / Recent Activities -->
								
								<div class="col-lg-6 col-md-12 d-flex">
								
									<!-- Today -->
									<div class="card flex-fill today-list shadow-sm grow">
										<div class="card-header">
											<h4 class="card-title mb-0 d-inline-block">Your Upcoming Leave</h4>
											<a href="leave.html" class="d-inline-block float-right text-primary"><i class="fa fa-suitcase"></i></a>
										</div>
										<div class="card-body recent-activ">
											<div class="recent-comment">
												<a href="javascript:void(0)" class="dash-card text-danger">
													<div class="dash-card-container">
														<div class="dash-card-icon">
															<i class="fa fa-suitcase"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Mon, 16 Dec 2019</h6>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-primary">
													<div class="dash-card-container">
														<div class="dash-card-icon">
															<i class="fa fa-suitcase"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Fri, 20 Dec 2019</h6>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-primary">
													<div class="dash-card-container">
														<div class="dash-card-icon">
															<i class="fa fa-suitcase"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Wed, 25 Dec 2019</h6>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-primary">
													<div class="dash-card-container">
														<div class="dash-card-icon">
															<i class="fa fa-suitcase"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Fri, 27 Dec 2019</h6>
														</div>
													</div>
												</a>
												<hr>
												<a href="javascript:void(0)" class="dash-card text-primary">
													<div class="dash-card-container">
														<div class="dash-card-icon">
															<i class="fa fa-suitcase"></i>
														</div>
														<div class="dash-card-content">
															<h6 class="mb-0">Tue, 31 Dec 2019</h6>
														</div>
													</div>
												</a>
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