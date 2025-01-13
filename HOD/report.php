<?php
session_start();
$error = "";
include_once('../db.php');
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
                                                                <li class="breadcrumb-item d-inline-block active">Leave</li>
                                                            </ol>
                                                            <h4 class="text-dark">Reports</h4>
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
                                        <h4 class="card-title mb-0">Reports</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="button-container" style="text-align: right;">
                                            <button class="btn btn-primary btn-sm" onclick="downloadPDF()">Download</button>
                                            <button class="btn btn-info btn-sm" onclick="window.print()">Print</button>

                                            <div class="table-responsive">
                                                <table class="table custom-table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Roll Number</th>
                                                            <th>Leave Type</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Days</th>
                                                            <th>Reason</th>
                                                            <th>Status</th>
                                                            <th>Applying Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include_once('../db.php');
                                                        $limit = 10;
                                                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                                        $offset = ($page - 1) * $limit;

                                                        // Get total number of leaves
                                                        $result = $conn->query("SELECT COUNT(*) AS total FROM leaves");
                                                        $row = $result->fetch_assoc();
                                                        $total_rows = $row['total'];
                                                        $total_pages = ceil($total_rows / $limit);

                                                        // Fetch leaves data with pagination
                                                        $sql = "SELECT * FROM leaves ORDER BY id DESC LIMIT $offset, $limit";
                                                        $result = mysqli_query($conn, $sql);

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $leavetype = $row['leavetype'];
                                                            $rollnumber = $row['studentrollnumber'];
                                                            $todate = $row['todate'];
                                                            $fromdate = $row['fromdate'];
                                                            $days = $row['noofdaystaken'];
                                                            $status = $row['status'];
                                                            $reason = $row['reason'];
                                                            $time = $row['applyingtime'];

                                                            // Get student name or other info from the user table, if needed
                                                            $user_sql = "SELECT name FROM user WHERE rollnumber = '$rollnumber'";
                                                            $user_result = mysqli_query($conn, $user_sql);
                                                            $user_row = mysqli_fetch_assoc($user_result);
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $rollnumber; ?></td>
                                                                <td><?php echo $leavetype; ?></td>
                                                                <td><?php echo $fromdate; ?></td>
                                                                <td><?php echo $todate; ?></td>
                                                                <td><?php echo $days; ?></td>
                                                                <td><?php echo $reason; ?></td>
                                                                <td><?php echo ucfirst($status); ?></td>
                                                                <td><?php echo $time; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Pagination controls -->
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                                        <a class="page-link" href="<?php echo ($page > 1) ? '?page=' . ($page - 1) : '#'; ?>">Previous</a>
                                                    </li>

                                                    <?php
                                                    for ($i = 1; $i <= $total_pages; $i++) {
                                                        if ($i == $page) {
                                                            echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
                                                        } else {
                                                            echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                                                        }
                                                    }
                                                    ?>

                                                    <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                                                        <a class="page-link" href="<?php echo ($page < $total_pages) ? '?page=' . ($page + 1) : '#'; ?>">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
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
    <?php include_once('common/footer.php') ?>

    <!-- Include jsPDF and autoTable libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.18/jspdf.plugin.autotable.js"></script>

    <script>
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Add a title or heading for the report
            doc.setFontSize(18);
            doc.text("Leave Report", 14, 15); // X=14, Y=15 for positioning

            // Table headers
            const tableHeaders = ["Roll Number", "Leave Type", "From", "To", "Days", "Reason", "Status", "Applying Time"];

            // Fetch all leave data (without pagination)
            const allLeaves = <?php
                $sql = "SELECT * FROM leaves ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                echo json_encode($data);
            ?>;

            // Create the table using autoTable
            const rows = allLeaves.map(row => [
                row.studentrollnumber,
                row.leavetype,
                row.fromdate,
                row.todate,
                row.noofdaystaken,
                row.reason,
                row.status,
                row.applyingtime
            ]);

            // Add the table to the PDF
            doc.autoTable({
                head: [tableHeaders],
                body: rows,
                startY: 30, // Start after the heading
            });

            // Save the PDF
            doc.save('leave_report.pdf');
        }
    </script>

</body>

</html>
