<?php
session_start();
$error = "";
include_once('../db.php');
include_once('../auth/conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include_once('common/header.php'); ?>
	<style>
		@media print {
			body * {
				visibility: hidden;
			}
			#reportTable, #reportTable * {
				visibility: visible;
			}
			#reportTable {
				position: absolute;
				top: 0;
				left: 0;
			}
		}
	</style>
</head>

<body>
	<div class="inner-wrapper">
		<?php include_once('common/navbar.php'); ?>
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
															<h4 class="text-dark">Leave</h4>
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
										<h4 class="card-title mb-0">Today Leaves</h4>
										<div class="float-right">
											<button class="btn btn-primary btn-sm" onclick="downloadCSV()">Download</button>
											<button class="btn btn-secondary btn-sm" onclick="printReport()">Print</button>
										</div>
									</div>
									<div class="card-body">
										<div class="employee-office-table">
											<div class="table-responsive">
												<table id="reportTable" class="table custom-table mb-0">
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
														$result = $conn->query("SELECT COUNT(*) AS total FROM leaves");
														$row = $result->fetch_assoc();
														$total_rows = $row['total'];
														$total_pages = ceil($total_rows / $limit);
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
														?>
															<tr>
																<td><?php echo $rollnumber; ?></td>
																<td><?php echo $leavetype; ?></td>
																<td><?php echo $fromdate; ?></td>
																<td><?php echo $todate; ?></td>
																<td><?php echo $days; ?></td>
																<td><?php echo $reason; ?></td>
																<td>
																	<span class="badge 
																		<?php 
																		// echo ($status === 'approved') ? 'badge-success' : 
																		// 	 (($status === 'rejected') ? 'badge-danger' : 'badge-warning'); ?>">
																		<?php echo ucfirst($status); ?>
																	</span>
																</td>
																<td><?php echo $time; ?></td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
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
		</div>

	</div>
	<div class="sidebar-overlay" id="sidebar_overlay"></div>
	<?php include_once('common/footer.php'); ?>
	<script>
		// Print the report
		function printReport() {
			window.print();
		}

		// Download the table as CSV
		function downloadCSV() {
			const table = document.getElementById('reportTable');
			let csv = [];
			for (let row of table.rows) {
				let cols = [...row.cells].map(cell => "${cell.innerText}");
				csv.push(cols.join(','));
			}
			let csvContent = csv.join('\n');
			let blob = new Blob([csvContent], { type: 'text/csv' });
			let url = URL.createObjectURL(blob);

			let a = document.createElement('a');
			a.href = url;
			a.download = 'report.csv';
			a.click();
		}
	</script>
</body>

</html>