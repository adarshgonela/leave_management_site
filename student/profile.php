<?php 
include_once ('../db.php');
$sql="SELECT * FROM user where id=1";
$result=mysqli_query($conn,$sql);

while ($row=mysqli_fetch_assoc($result)) {
	$email=$row['email'];
	$name=$row['name'];
    $phno=$row['phno'];
    $rollnumber=$row['rollnumber'];
    $gender=$row['gender'];
    $address=$row['address'];
  


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
															<li class="breadcrumb-item d-inline-block active">Profile</li>
														</ol>
														<h4 class="text-dark">Profile</h4>
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
											<h4 class="card-title mb-0">Profile</h4>
										</div>
										<div class="card-body">
											<form>
												<div class="row">
                                                <div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Name</label>
															<input type="text" class="form-control" value="<?php echo $name ?>" >
														</div>
													</div>  
                                                    <div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Email</label>
															<input type="text" class="form-control" placeholder="<?php echo $email ?>" disabled>
														</div>
													</div>  
													<div class="col-sm-6">
														<div class="form-group">
															<label>
															Gender
															<span class="text-danger">*</span>
															</label>
                                                            <input type="text" class="form-control" placeholder="<?php echo $gender ?>" disabled>
														
															<!-- <select class="form-control select">
																<option value="">Select Gender</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select> -->
														</div>
													</div>
													<div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Phone Number</label>
															<input type="text" class="form-control" value="<?php echo $phno ?>" >
														</div>
													</div>
                                                    <div class="col-sm-6 leave-col">
														<div class="form-group">
															<label>Roll Number</label>
															<input type="text" class="form-control" placeholder="<?php echo $rollnumber ?>" disabled>
														</div>
													</div>
												</div>
												
										
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group mb-0">
															<label>Address</label>
															<input type="text" class="form-control" value="<?php echo $address ?>" >
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
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/Content-->
			<?php  } ?>
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