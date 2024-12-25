<?php 
session_start();
include_once ('../db.php');
$sql="SELECT * FROM user where id=1";
$result=mysqli_query($conn,$sql);

while ($row=mysqli_fetch_assoc($result)) {
	
	$name=$row['name'];




?>
<!DOCTYPE html>
<html lang="en">
	
<head>
	
		<!-- Required meta tags -->
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

			<!-- Header -->
			<?php  include_once ('common/navbar.php');  ?>
			<!-- /Header -->
			
			<!-- Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
							<aside class="sidebar sidebar-user">
								<div class="card ctm-border-radius shadow-sm grow">
									<div class="card-body py-4">
										<div class="row">
											<div class="col-md-12 mr-auto text-left">
												<div class="custom-search input-group">
													<div class="custom-breadcrumb">
														<ol class="breadcrumb no-bg-color d-inline-block p-0 m-0 mb-2">
															<li class="breadcrumb-item d-inline-block"><a href="index.html" class="text-dark">Home</a></li>
															<li class="breadcrumb-item d-inline-block active">Calendar</li>
														</ol>
														<h4 class="text-dark">Calendar</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Sidebar -->
								<?php   include_once ('common/sidebar.php');  ?>
								
								<!-- /Sidebar -->
								<div class="card ctm-border-radius shadow-sm grow">
									<div class="card-body">
										<a href="javascript:void(0)" class="btn btn-theme button-1 ctm-border-radius text-white btn-block" data-toggle="modal" data-target="#add_event"><span><i class="fe fe-plus"></i></span> Create New</a>
									</div>
								</div>
								<div class="card ctm-border-radius shadow-sm grow">
									<div class="card-body">
										<h4 class="card-title">Drag & Drop Event</h4>
										<div id="calendar-events" class="mb-3">
											<div class="calendar-events" data-class="bg-info"><i class="fa fa-circle text-info"></i> My Event One</div>
											<div class="calendar-events" data-class="bg-success"><i class="fa fa-circle text-success"></i> My Event Two</div>
											<div class="calendar-events" data-class="bg-danger"><i class="fa fa-circle text-danger"></i> My Event Three</div>
											<div class="calendar-events" data-class="bg-warning"><i class="fa fa-circle text-warning"></i> My Event Four</div>
										</div>
										<div class="checkbox  mb-3">
											<input id="drop-remove" type="checkbox">
											<label for="drop-remove">
											Remove after drop
											</label>
										</div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#add_new_event" class="btn mb-3 btn-theme text-white ctm-border-radius btn-block">
										<i class="fa fa-plus"></i> Add Category
										</a>
									</div>
								</div>
							</aside>
						</div>
				
						<div class="col-xl-9 col-lg-8  col-md-12">
							
							<div class="card ctm-border-radius shadow-sm grow">
								<div class="card-body">
									<div id="calendar"></div>
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
		
		<?php include_once('common/footer.php'); ?>

</body>

</html>