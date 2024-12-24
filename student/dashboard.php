<?php
session_start();
include_once('../auth/conn.php');
$rollnumber = $_SESSION['rollnumber'];
$sql = "SELECT * FROM user where rollnumber='$rollnumber'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

	$name = $row['name'];
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php  include_once('common/header.php'); ?>

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
			<div class="spinner-grow text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-warning" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-light" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-dark" role="status">
  <span class="sr-only">Loading...</span>
</div>
			<!-- Header -->
			<?php include_once('common/navbar.php');  ?>
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
								<?php include_once('common/sidebar.php') ?>

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
												<h4 class="card-title">Pending leaves</h4>
												<p class="card-text">700</p>
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
												<h4 class="card-title">Rejected Leaves</h4>
												<p class="card-text">2</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- / Widget -->

							<!-- Chart -->
							<!-- <div class="row">
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

							<!-- / Chart -->


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

	<script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="1c3b3b47cad5cf489fe0065f-|49" defer></script>
	<script src="../assets/js/script.js"></script>
</body>


	</html>