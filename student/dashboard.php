<?php
session_start();
include_once('title.php');
include_once('../student/common/session.php');
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
																<h4 class="text-dark"><?php echo $title ?> Dashboard</h4>
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
										<div class="user-avatar mb-4 d-flex justify-content-center align-items-center">

											<?php
											// include_once('../../db.php');
											$sql = "SELECT profileimg FROM user WHERE rollnumber='$rollnumber'";
											$result = mysqli_query($conn, $sql);
											$row = $result->fetch_assoc();
											?>

											<img src="data:image/jpeg;base64,<?php echo base64_encode($row['profileimg']); ?>" alt="No Profile Img" class="img-fluid rounded-circle" width="100">
										</div>
										<div class="user-details">
											<h4 style="font-weight: 500;"><b> <?php echo $name ?></b></h4>
											<p><?php echo $rollnumber; ?></p>
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
									<marquee style="font-weight: 500;font-size: larger;" behavior="" direction="left">Every student should maintain 65% attendence</marquee>
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

												<?php
												$sql = "SELECT COUNT(*) AS count
												FROM leaves l
												JOIN user u ON l.studentrollnumber = u.rollnumber
												WHERE l.status = 'pending'
												AND l.studentrollnumber = '$rollnumber'
												AND (u.role = 'student' OR u.role = 'classincharge')";


												$result = mysqli_query($conn, $sql);
												$row = $result->fetch_assoc();

												?>
												<h4 class="card-title"><a href="allleaves.php?status=pending">Pending leaves</a></h4>
												<p class="card-text"><?php echo $row['count']; ?></p>
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
												<?php
												$sql = "SELECT COUNT(*) AS count
												FROM leaves l
												JOIN user u ON l.studentrollnumber = u.rollnumber
												WHERE l.status = 'approved'
												AND l.studentrollnumber = '$rollnumber'
												AND (u.role = 'student' OR u.role = 'classincharge')";


												$result = mysqli_query($conn, $sql);
												$row = $result->fetch_assoc();

												?>
												<h4 class="card-title"><a href="allleaves.php?status=approved">Approved Leaves</a></h4>
												<p class="card-text"><?php echo $row['count']; ?></p>
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
												<?php
												$sql = "SELECT COUNT(*) AS count
												FROM leaves l
												JOIN user u ON l.studentrollnumber = u.rollnumber
												WHERE l.status = 'rejected'
												AND l.studentrollnumber = '$rollnumber'
												AND (u.role = 'student' OR u.role = 'classincharge')";


												$result = mysqli_query($conn, $sql);
												$row = $result->fetch_assoc();

												?>
												<h4 class="card-title"><a href="allleaves.php?status=rejected">Rejected Leaves</a></h4>
												<p class="card-text"><?php echo $row['count']; ?></p>
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
												<?php
												// Assuming you already have the session started and the database connection established

												// Get the roll number of the logged-in student
												$studentrollnumber = mysqli_real_escape_string($conn, $_SESSION['rollnumber']);

												// SQL query to fetch the remainingleaves for the student
												$sql = "SELECT remainingleaves FROM user WHERE rollnumber = '$studentrollnumber'";

												// Execute the query
												$result = mysqli_query($conn, $sql);

												$row = mysqli_fetch_assoc($result);
												$remainingleaves = $row['remainingleaves'];
												?>

												<h4 class="card-title">Remaining leaves</h4>
												<p class="card-text"><?php echo $row['remainingleaves'] ?></p>
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

	<?php include_once('common/footer.php'); ?>
	</body>


	</html>