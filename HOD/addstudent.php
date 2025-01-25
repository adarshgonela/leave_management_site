<?php
session_start();
$error="";
include('../db.php');
include_once('title.php');

if (isset($_POST['student'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $confirm_password = $_POST['confirm_password'];
    $rollnumber = $_POST['rollnumber'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $yearsem = $_POST['yearsem'];

    // Validation (ensure that password and confirm_password match)
    if ($password !== $confirm_password) {
        $error= "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $sql = "INSERT INTO user (email, password, name, rollnumber, role, department, yearsem,totalleaves,remainingleaves) 
                VALUES ('$email', '$hashed_password', '$name', '$rollnumber', '$role', '$department', '$yearsem','$totalleaves','$totalleaves')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            $error= "New student added successfully!";
        } else {
            $error= "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the connection
// $conn->close();
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
                                                                <li class="breadcrumb-item d-inline-block"><a href="dashboard.php" class="text-dark">Home</a></li>
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
                                    <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                                        <form action="addstudent.php" method="post">
                                            <div class="row">
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Student Email</label>
                                                        <input type="hidden" name="student">
                                                        <input type="email" class="form-control" placeholder="Student Email" name="email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Student Password</label>
                                                        <input type="password" class="form-control datetimepicker" placeholder="Student Password" name="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Student Name</label>
                                                        <input type="text" class="form-control datetimepicker" placeholder="Student Name" name="name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Student confirm Password</label>
                                                        <input type="password" class="form-control datetimepicker" placeholder="Student Confirm Password" name="confirm_password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Student RollNumber</label>
                                                        <input type="text" class="form-control datetimepicker" placeholder="Student RollNumber" name ="rollnumber">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select class="form-control select" name="role">
                                                            <option>Select</option>
                                                            <option value="student">student</option>
                                                            <option value="class incharge">class incharge</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Department
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control select" name="department">
                                                            <option>Select</option>
                                                            <option value="ECE">ECE</option>
                                                            <option value="CSE">CSE</option>
                                                            <option value="CIVIL">CIVIL</option>
                                                            <option value="MECH">MECH</option>
                                                            <option value="CSD">CSD</option>
                                                            <option value="AIML">AIML</option>


                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>
                                                            year and sem
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control select" name="yearsem">
                                                            <option>Select</option>
                                                            <option value="1-1">1-1</option>
                                                            <option value="1-2">1-2</option>
                                                            <option value="2-1">2-1</option>
                                                            <option value="2-2">2-2</option>
                                                            <option value="3-1">3-1</option>
                                                            <option value="3-2">3-2</option>
                                                            <option value="4-1">4-1</option>
                                                            <option value="4-2">4-2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <input type="submit" value="Add Student" class="btn btn-theme button-1 text-white ctm-border-radius mt-4">
                                                <a href="addstudent.php" class="btn btn-danger text-white ctm-border-radius mt-4">Cancel</a>
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