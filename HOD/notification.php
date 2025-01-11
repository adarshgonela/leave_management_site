<?php
session_start();
include_once('../db.php');
include_once('../auth/conn.php');
$error = "";
$rollnumber = $_SESSION['rollnumber'];

if (!isset($_SESSION['rollnumber'])) {
    header('Location: login.php');
    exit();
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
                                                                <li class="breadcrumb-item d-inline-block"><a href="notification.php" class="text-dark">Home</a></li>
                                                                <li class="breadcrumb-item d-inline-block active">Notification</li>
                                                            </ol>
                                                            <h4 class="text-dark">Notification</h4>
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
                                        <strong style="font-weight: 800; font-size: xx-large;">Notifications</strong>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $sql1 = "SELECT * FROM notifications WHERE torollnumber = '$rollnumber' AND DATE(notificationtime) = CURDATE()";
                                        $result1 = mysqli_query($conn, $sql1);

                                        while ($row = $result1->fetch_assoc()) {
                                            // Calculate the time difference in seconds
                                            $notification_time = strtotime($row['notificationtime']);
                                            $current_time = time();
                                            $time_diff = $current_time - $notification_time;

                                            // Convert time difference to more human-readable format
                                            if ($time_diff < 60) {
                                                // Less than a minute ago
                                                $time_display = $time_diff . " seconds ago";
                                            } elseif ($time_diff >= 60 && $time_diff < 3600) {
                                                // Less than an hour ago
                                                $minutes = floor($time_diff / 60);
                                                $time_display = $minutes . "m ago";
                                            } elseif ($time_diff >= 3600 && $time_diff < 86400) {
                                                // Less than a day ago
                                                $hours = floor($time_diff / 3600);
                                                $time_display = $hours . "h ago";
                                            } else {
                                                // More than a day ago
                                                $days = floor($time_diff / 86400);
                                                $time_display = $days . "d ago";
                                            }
                                        ?>
                                            <div class="flex justify-between py-6 px-4 bg-white/30 rounded-lg">
                                                <div class="flex items-center space-x-4">
                                                    <img src="../assets/img/notificationjpg.jpg" class="rounded-full h-14 w-14" alt="">
                                                    <div class="flex flex-col space-y-1">
                                                        <span class="font-bold">Alert ! Notification</span>
                                                        <span class="text-sm"><?php echo $row['notificationsmsg']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                                                    <?php echo $time_display; ?>
                                                </div>
                                            </div>
                                        <?php } ?>
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

    <?php include_once('common/footer.php'); ?>
</body>

</html>
