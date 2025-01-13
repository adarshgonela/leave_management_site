<?php 
session_start();
include_once('../db.php');
$sql = "SELECT * FROM user WHERE id=1";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/twcomponents@latest/dist/twcomponents.min.css" rel="stylesheet">
    <?php include_once('common/header.php'); ?>
</head>

<body>
    <div class="inner-wrapper">
        <?php include_once('common/navbar.php'); ?>
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
                                                        <li class="breadcrumb-item d-inline-block">
                                                            <a href="index.html" class="text-dark">Home</a>
                                                        </li>
                                                        <li class="breadcrumb-item d-inline-block active">Calendar</li>
                                                    </ol>
                                                    <h4 class="text-dark">Calendar</h4>
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
                        <div class="card ctm-border-radius shadow-sm grow">
                            <div class="card-body">
                                <div id="calendar">
                                    <style>
                                        .holiday-text {
                                            color: red !important;
                                            font-weight: bold;
                                            font-size: 12px;
                                        }
                                        .festival-text {
                                            color: gold !important;
                                            font-weight: bold;
                                            font-size: 12px;
                                        }
                                        .sunday-day {
                                            color: red !important;
                                            font-weight: bold;
                                        }
                                        .day-number {
                                            color: white !important;
                                            font-weight: bold;
                                        }
                                        .event-name {
                                            position: absolute;
                                            bottom: -16px; 
                                            left: 50%;
                                            transform: translateX(-50%);
                                            font-size: 12px;
                                            color: white;
                                            text-align: center;
                                        }
                                        .sunday-number {
                                            color: red !important;
                                        }
                                        .bg-gradient::after {
                                            background: radial-gradient(600px circle at var(--mouse-x) var(--mouse-y), rgba(0, 0, 0, 0.6), transparent 20%);
                                        }
                                    </style>

                                    <div class="flex flex-col items-center justify-center min-h-screen px-6" style="background-color:#3e007c;">
                                        <h1 class="text-2xl font-bold text-center text-white">Calendar</h1>

                                        <div class="flex items-center mt-6 text-white">
                                            <button id="prevMonth" class="px-4 py-2 bg-gray-800 rounded-md hover:bg-gray-700">Prev</button>
                                            <h2 id="monthName" class="mx-6 text-2xl"></h2>
                                            <button id="nextMonth" class="px-4 py-2 bg-gray-800 rounded-md hover:bg-gray-700">Next</button>
                                        </div>
                                        <div class="grid w-full max-w-xl grid-cols-7 gap-6 mx-auto mt-6">
                                            <p class="flex items-center justify-center h-16 text-gray-300 sunday-day">Sa</p>
                                            <p class="flex items-center justify-center h-16 text-gray-300">Fr</p>
                                            <p class="flex items-center justify-center h-16 text-gray-300">Th</p>
                                            <p class="flex items-center justify-center h-16 text-gray-300">We</p>
                                            <p class="flex items-center justify-center h-16 text-gray-300">Tu</p>
                                            <p class="flex items-center justify-center h-16 text-gray-300">Mo</p>
                                            <p class="flex items-center justify-center h-16 text-gray-300 sunday-day">Su</p>
                                        </div>
                                        <div id="daysGrid" class="grid w-full max-w-xl grid-cols-7 gap-6 mx-auto"></div>
                                    </div>

                                    <script>
                                        let currentDate = new Date();
                                        let currentMonth = currentDate.getMonth();
                                        let currentYear = currentDate.getFullYear();
                                        const publicHolidays = [
                                            { date: '2025-01-26', name: 'Republic Day', type: 'public' },
                                            { date: '2025-08-15', name: 'Independence Day', type: 'public' },
                                            { date: '2025-10-02', name: 'Gandhi Jayanti', type: 'public' },
                                        ];
                                        const festivals = [
                                            { date: '2025-03-25', name: 'Holi', type: 'festival' },
                                            { date: '2025-10-24', name: 'Diwali', type: 'festival' },
                                            { date: '2025-12-31', name: 'New Year Eve', type: 'festival' },
                                        ];

                                        // DOM elements
                                        const monthNameElement = document.getElementById("monthName");
                                        const daysGrid = document.getElementById("daysGrid");
                                        const prevMonthButton = document.getElementById("prevMonth");
                                        const nextMonthButton = document.getElementById("nextMonth");

                                        function renderCalendar() {
                                            const firstDay = new Date(currentYear, currentMonth, 1);
                                            const lastDay = new Date(currentYear, currentMonth + 1, 0);
                                            const daysInMonth = lastDay.getDate();
                                            const startDay = firstDay.getDay();

                                            monthNameElement.textContent = `${firstDay.toLocaleString('default', { month: 'long' })} ${currentYear}`;

                                            daysGrid.innerHTML = '';

                                            for (let i = 0; i < startDay; i++) {
                                                daysGrid.innerHTML += `<div class="h-12"></div>`;
                                            }

                                            for (let i = 1; i <= daysInMonth; i++) {
                                                const date = new Date(currentYear, currentMonth, i);
                                                const formattedDate = date.toISOString().split('T')[0];
                                                const holiday = publicHolidays.find(h => h.date === formattedDate);
                                                const festival = festivals.find(f => f.date === formattedDate);

                                                const dayElement = document.createElement("div");
                                                dayElement.classList.add("relative", "w-full", "h-12", "cursor-pointer", "hover:scale-110", "box", "bg-gradient");

                                                if (date.getDay() === 0) { 
                                                    dayElement.classList.add('sunday-number');
                                                }

                                                dayElement.innerHTML = `
                                                    <div class="absolute inset-[3px] z-20 flex items-center justify-center day-number">${i}</div>`;
                                                if (holiday) {
                                                    dayElement.innerHTML += `<div class="event-name holiday-text">${holiday.name}</div>`;
                                                }
                                                if (festival) {
                                                    dayElement.innerHTML += `<div class="event-name festival-text">${festival.name}</div>`;
                                                }

                                                daysGrid.appendChild(dayElement);
                                            }
                                        }

                                        prevMonthButton.addEventListener("click", () => {
                                            currentMonth--;
                                            if (currentMonth < 0) {
                                                currentMonth = 11;
                                                currentYear--;
                                            }
                                            renderCalendar();
                                        });

                                        nextMonthButton.addEventListener("click", () => {
                                            currentMonth++;
                                            if (currentMonth > 11) {
                                                currentMonth = 0;
                                                currentYear++;
                                            }
                                            renderCalendar();
                                        });

                                        renderCalendar();
                                    </script>
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
</body>

</html>
<?php } ?>