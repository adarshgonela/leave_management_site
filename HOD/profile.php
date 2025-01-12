<?php
session_start();
include_once('../db.php');

// Fetch user details
$rollnumber = $_SESSION['rollnumber'];
$sql = "SELECT * FROM user WHERE rollnumber='$rollnumber'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];
$name = $row['name'];
$phno = $row['phno'];
$gender = $row['gender'];
$address = $row['address'];
$id = $row['id'];
$image = $row['profileimg']; // Original profile image (binary)

// Handle form submission
if (isset($_POST['update'])) {
    $new_email = $_REQUEST['email'];
    $new_name = $_REQUEST['name'];
    $new_phno = $_REQUEST['phno'];
    $new_rollnumber = $_REQUEST['rollnumber'];
    $new_gender = $_REQUEST['gender'];
    $new_address = $_REQUEST['address'];
    $user_id = $_REQUEST['id'];

  // Check if an image file has been uploaded
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
	$imageTmpName = $_FILES['image']['tmp_name'];
	$imageData = file_get_contents($imageTmpName);
} else {
	// Handle the case where no file is uploaded (use existing image or set $imageData to null)
	$imageData = null;  // Or you can leave it empty and rely on existing image in database
}
    // Update query with the new fields
    $sql = "UPDATE user SET email = ?, name = ?, phno = ?, rollnumber = ?, gender = ?, address = ?, profileimg = ? WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters to the statement
    $stmt->bind_param("sssssssi", $new_email, $new_name, $new_phno, $new_rollnumber, $new_gender, $new_address, $imageData, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
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
        <?php include_once('common/navbar.php'); ?>
        
        <!-- Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
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
                            <?php include_once('common/sidebar.php'); ?>
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
                                        <form action="profile.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                                            <div class="col-12">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image"/>
                                                        <label for="imageUpload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" alt="No Profile Img" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $name ?>" name="name" >
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" value="<?php echo $email ?>" name="email" readonly>
                                                    </div>
                                                </div>  
												<div class="col-sm-6">
														<div class="form-group">
															<label>
																Gender
																<span class="text-danger"></span>
															</label>

															<select class="form-control select" name="gender" value="<?php echo $gender; ?>" >
																<option value=""><?php echo $gender ?></option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div>
													</div>
													
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control" value="<?php echo $phno ?>" name="phno">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 leave-col">
                                                    <div class="form-group">
                                                        <label>Roll Number</label>
                                                        <input type="text" class="form-control" value="<?php echo $rollnumber ?>" name="rollnumber" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-0">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" value="<?php echo $address ?>" name="address">
                                                        <input type="hidden" name="update">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button class="btn btn-theme button-1 text-white ctm-border-radius mt-4" type="submit">Update Details</button>
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
        <!-- Inner Wrapper -->
        <div class="sidebar-overlay" id="sidebar_overlay"></div>
        
        <?php include_once('common/footer.php'); ?>
    </body>
</html>
