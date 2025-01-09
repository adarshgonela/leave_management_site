<?php
session_start();
include_once('../db.php'); // Include your database connection file

// Set the number of records per page
$records_per_page = 10;

// Get the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Create MySQLi connection

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter parameters from the form
$filter_yearsem = isset($_GET['filter_yearsem']) ? $_GET['filter_yearsem'] : '';

// Construct the SQL query for the total count of students
$sql = "SELECT COUNT(*) FROM user WHERE role = 'student'";

// Add year filter if selected
if ($filter_yearsem) {
    $sql .= " AND yearsem = ''" . $conn->real_escape_string($filter_yearsem) . "'";
}

// Fetch the total number of students after applying the filter
$result = $conn->query($sql);

// Check if the query is successful
if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

$row = $result->fetch_row();
$total_students = $row[0];
$total_pages = ceil($total_students / $records_per_page);

// Construct the SQL query for the student data with pagination and filters
$sql = "SELECT * FROM user WHERE role = 'student'";

// Add year filter if selected
if ($filter_yearsem) {
    $sql .= " AND yearsem = '" . $conn->real_escape_string($filter_yearsem) . "'";
}

// Apply pagination
$sql .= " LIMIT $start_from, $records_per_page";

// Fetch the student data
$result = $conn->query($sql);

// Check if the query is successful
if (!$result) {
    die("Error in SQL query: " . $conn->error);
}

$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

$conn->close();
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
        <!-- /Header -->

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
                                                                <li class="breadcrumb-item d-inline-block"><a href="index.html" class="text-dark">Home</a></li>
                                                                <li class="breadcrumb-item d-inline-block active">Student List</li>
                                                            </ol>
                                                            <h4 class="text-dark">Student List</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar -->
                            <?php include_once('common/sidebar.php'); ?>
                            <!-- /Sidebar -->
                        </aside>
                    </div>

                    <div class="col-xl-9 col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ctm-border-radius shadow-sm grow">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Student List</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- Filter Form for Year -->
                                        <form method="get" action="">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Academic Year</label>
                                                        <select class="form-control" name="filter_yearsem">
                                                            <option value="">All</option>
                                                            <option value="1-1" <?php if ($filter_yearsem == '1-1') echo 'selected'; ?>>1-1</option>
                                                            <option value="1-2" <?php if ($filter_yearsem == '1-2') echo 'selected'; ?>>1-2</option>
                                                            <option value="2-1" <?php if ($filter_yearsem == '2-1') echo 'selected'; ?>>2-1</option>
                                                            <option value="2-2" <?php if ($filter_yearsem == '2-2') echo 'selected'; ?>>2-2</option>
                                                            <option value="3-1" <?php if ($filter_yearsem == '3-1') echo 'selected'; ?>>2-2</option>
                                                            <option value="3-2" <?php if ($filter_yearsem == '3-2') echo 'selected'; ?>>2-2</option>
                                                            <option value="4-1" <?php if ($filter_yearsem == '4-1') echo 'selected'; ?>>2-2</option>
                                                            <option value="4-2" <?php if ($filter_yearsem == '4-2') echo 'selected'; ?>>2-2</option>
                                                            <!-- Add more years as needed -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-theme button-1 text-white ctm-border-radius mt-4">Apply Filter</button>
                                            </div>
                                        </form>

                                        <div class="table-responsive">
                                            <table class="table custom-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Email</th>
                                                        <th>Name</th>
                                                        <th>Roll Number</th>
                                                        <th>Year/Sem</th>
                                                        <th>Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($students as $student): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($student['id']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['rollnumber']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['yearsem']); ?></td>
                                                            <td><?php echo htmlspecialchars($student['role']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="col-md-12">
                            <div class="pagination-container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                <a class="page-link" href="studentlist.php?page=<?php echo $i; ?>&filter_year=<?php echo urlencode($filter_year); ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </nav>
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

    <?php include_once('common/footer.php'); ?>
</body>

</html>
