<?php
// Include database connection
include('../db.php'); // make sure to define $conn here

// Define the number of records per page
$records_per_page = 10;

// Get the current page number from the query string (default is 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting record for the SQL query
$start_from = ($page - 1) * $records_per_page;

// Query to get the total number of records in the table
$total_records_query = "SELECT COUNT(*) FROM leaves";
$result = mysqli_query($conn, $total_records_query);
$row = mysqli_fetch_row($result);
$total_records = $row[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// Query to fetch the current page data
$query = "SELECT * FROM leaves LIMIT $start_from, $records_per_page";
$result = mysqli_query($conn, $query);

// Display the results
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . $row['studentrollnumber'] . "</td>
            <td>" . $row['fromdate'] . "</td>
            <td>" . $row['todate'] . "</td>
          </tr>";
}

echo "</table>";

// Pagination Links
echo "<div class='pagination'>";

// Previous Page Link
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "'>Previous</a> ";
}

// Page Links
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong> ";  // Current page
    } else {
        echo "<a href='?page=$i'>$i</a> ";
    }
}

// Next Page Link
if ($page < $total_pages) {
    echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
}

echo "</div>";

// Close the database connection
mysqli_close($conn);
?>
