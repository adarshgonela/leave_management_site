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
		<link href="https://cdn.jsdelivr.net/npm/twcomponents@latest/dist/twcomponents.min.css" rel="stylesheet">

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
								
							
							</aside>
						</div>
				
						<div class="col-xl-9 col-lg-8  col-md-12">
							
							<div class="card ctm-border-radius shadow-sm grow">
								<div class="card-body">
									<div id="calendar">

<!-- component -->
<style> 
    .bg-gradient::after {
        background: radial-gradient(600px circle at var(--mouse-x) var(--mouse-y), rgba(0, 0, 0, 0.6), transparent 20%);
    }
</style>

<div class="flex flex-col items-center justify-center min-h-screen px-6" style="background-color:#3e007c;">
    <h1 class="text-2xl font-bold text-center text-white">Calendar </h1>
    <!-- <p class="flex items-end mt-2 text-base text-center text-gray-400 gap-x-2">Built using HTML, Tailwind CSS, and JavaScript. Like and Share for more awesome content
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-500 shrink-0">
            <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
        </svg>
    </p> -->

    <!-- Month Navigation -->
    <div class="flex items-center mt-6 text-white">
        <button id="prevMonth" class="px-4 py-2 bg-gray-800 rounded-md hover:bg-gray-700">Prev</button>
        <h2 id="monthName" class="mx-6 text-2xl"></h2>
        <button id="nextMonth" class="px-4 py-2 bg-gray-800 rounded-md hover:bg-gray-700">Next</button>
    </div>

    <!-- Calendar Grid -->
    <div class="grid w-full max-w-xl grid-cols-7 gap-6 mx-auto mt-6">
        <p class="flex items-center justify-center h-16 text-gray-300">Sa</p>
        <p class="flex items-center justify-center h-16 text-gray-300">Fr</p>
        <p class="flex items-center justify-center h-16 text-gray-300">Th</p>
        <p class="flex items-center justify-center h-16 text-gray-300">We</p>
        <p class="flex items-center justify-center h-16 text-gray-300">Tu</p>
        <p class="flex items-center justify-center h-16 text-gray-300">Mo</p>
        <p class="flex items-center justify-center h-16 text-gray-300">Su</p>
    </div>

    <div id="daysGrid" class="grid w-full max-w-xl grid-cols-7 gap-6 mx-auto"></div>
</div>

<script>
    // Define current month and year
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // DOM elements
    const monthNameElement = document.getElementById("monthName");
    const daysGrid = document.getElementById("daysGrid");
    const prevMonthButton = document.getElementById("prevMonth");
    const nextMonthButton = document.getElementById("nextMonth");

    // Days of the week headers
    const daysOfWeek = ['Sa', 'Fr', 'Th', 'We', 'Tu', 'Mo', 'Su'];

    // Function to render the calendar for the current month and year
    function renderCalendar() {
        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startDay = firstDay.getDay(); // Day of the week for the 1st day of the month

        // Update the month name
        monthNameElement.textContent = `${firstDay.toLocaleString('default', { month: 'long' })} ${currentYear}`;

        // Clear the previous grid
        daysGrid.innerHTML = '';

        // Add empty divs before the first day
        for (let i = 0; i < startDay; i++) {
            daysGrid.innerHTML += `<div class="h-12"></div>`;
        }

        // Add day numbers
        for (let i = 1; i <= daysInMonth; i++) {
            const dayElement = document.createElement("div");
            dayElement.classList.add("relative", "w-full", "h-12", "cursor-pointer", "hover:scale-110", "box", "bg-gradient", "after:absolute", "after:inset-0", "after:z-10", "after:h-full", "after:w-full", "after:transition-opacity", "after:duration-500", "hover:bg-white");

            dayElement.innerHTML = `
                <div class="absolute inset-[3px] z-20 flex items-center justify-center bg-black-900 text-white font-weight-normal">${i}</div>
            `;
            daysGrid.appendChild(dayElement);
        }
    }

    // Function to move to the next month
    nextMonthButton.addEventListener("click", () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    });

    // Function to move to the previous month
    prevMonthButton.addEventListener("click", () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    });

    // Initialize the calendar
    renderCalendar();

    // Mouse tracking effect for hover on dates
    document.body.onmousemove = e => {
        for (const date of document.getElementsByClassName("box")) {
            const rect = date.getBoundingClientRect(),
                  x = e.clientX - rect.left,
                  y = e.clientY - rect.top;

            date.style.setProperty("--mouse-x", `${x}px`);
            date.style.setProperty("--mouse-y", `${y}px`);
        }
    };
</script>


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
		<?php   }  ?>
		<div class="sidebar-overlay" id="sidebar_overlay"></div>
		
		
		<?php include_once('common/footer.php'); ?>

</body>

</html>