<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Dashboard</title>
</head>

<!-- start: Sidebar -->
<div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
        <img src="/img/Mohamed_D.png" alt="" class="w-8 h-8 rounded object-cover">
        <span class="text-lg font-bold text-white ml-3">Mohamed D - Fitness</span>
    </a>
    <ul class="mt-4">
        <li class="mb-1 group active">
            <a onclick="redirectToTrainerDashboardPage()"
                class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a onclick=redirectToTrainerSettingsPage()
                class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-settings-2-line mr-3 text-lg"></i>
                <span class="text-sm">Settings</span>
            </a>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end: Sidebar -->

<!--header-->
<div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30 relative">
    <!--sidebar toggle-->
    <button type="button" class="text-lg text-gray-600 sidebar-toggle">
        <i class="ri-menu-line"></i>
    </button>
    <!--sidebar toggle-->
    <!-- profile -->
    <ul class="ml-auto flex items-center">
        <li class="dropdown mr-5">
            <button type="button" class="dropdown-toggle flex items-center">
                <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
            </button>
            <ul
                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute">
                <li>
                    <a onclick=redirectToTrainerSettingsPage()
                        class="cursor-pointer flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                </li>
                <li>
                    <a onclick=redirectToTrainerSettingsPage()
                        class="cursor-pointer flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                </li>
                <li>
                    <button id='destroySessionButton'
                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</button>
                </li>
            </ul>
        </li>
    </ul>
    <!-- profile -->
</div>
<!--header-->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <!--main view-->
    <div class="p-6">
        <div id="cancelModal"
            class="modal hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
            <div class="modal-content bg-white rounded-md p-4 w-64">
                <span class="close cursor-pointer absolute top-2 right-2">&times;</span>
                <p class="text-center">Cancellation is not allowed within 24 hours of the session.</p>
            </div>
        </div>
        <!--tabel-->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Agenda</div>
                </div>
                <!--Data upcoming and completed -->
                <div class="flex items-center mb-4 session-tab">
                    <button type="button" data-tab="session" data-tab-page="Upcoming" onclick="openTab('Upcoming')"
                        class="tab-button bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 rounded-tl-md rounded-bl-md hover:text-gray-600 active">Upcoming</button>
                </div>
                <div class="overflow-x-auto">
                    <!--table upcoming-->
                    <table class="w-full min-w-[540px] tab-content" data-tab-for="session" id="Upcoming">
                        <thead>
                            <tr>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                    Date</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Length</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($upcomingSessions as $session): ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">
                                            <?php
                                            $startDateTime = new DateTime($session->start_time);
                                $formattedDate = $startDateTime->format('d-M-y | h:i a');
                                echo $formattedDate;
                                ?></a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">
                                        <?php
                                        $startDateTime = new DateTime($session->start_time);
                                $endDateTime = new DateTime($session->end_time);
                                $timestampDifference = $endDateTime->getTimestamp() - $startDateTime->getTimestamp();
                                $minutesDifference = ceil($timestampDifference / 60);
                                echo $minutesDifference . 'min';
                                ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!--table upcoming end-->
                </div>
                <!--Data upcoming and completed -->
            </div>
        </div>
        <!--tabel-->
    </div>
    <!--main view-->
</main>
<!-- end: Main -->

<script>
    $(document).ready(function() {
        $("#destroySessionButton").click(function() {
            $.ajax({
                url: "logout",
                method: "POST",
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    function redirectToTrainerDashboardPage() {
        window.location.href = 'trainerdashboard';
    }

    function redirectToTrainerSettingsPage() {
        window.location.href = 'trainersetting';
    }

    // start: Sidebar
    const sidebarToggle = document.querySelector('.sidebar-toggle')
    const sidebarOverlay = document.querySelector('.sidebar-overlay')
    const sidebarMenu = document.querySelector('.sidebar-menu')
    const main = document.querySelector('.main')
    sidebarToggle.addEventListener('click', function(e) {
        e.preventDefault()
        main.classList.toggle('active')
        sidebarOverlay.classList.toggle('hidden')
        sidebarMenu.classList.toggle('-translate-x-full')
    })
    sidebarOverlay.addEventListener('click', function(e) {
        e.preventDefault()
        main.classList.add('active')
        sidebarOverlay.classList.add('hidden')
        sidebarMenu.classList.add('-translate-x-full')
    })
    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault()
            const parent = item.closest('.group')
            if (parent.classList.contains('selected')) {
                parent.classList.remove('selected')
            } else {
                document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(i) {
                    i.closest('.group').classList.remove('selected')
                })
                parent.classList.add('selected')
            }
        })
    })
    // end: Sidebar
    // tab switch
    function openTab(tabId) {
        // Hide all tab contents
        var tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(function(tabContent) {
            tabContent.classList.add('hidden');
        });

        // Show the selected tab content
        var selectedTabContent = document.getElementById(tabId);
        if (selectedTabContent) {
            selectedTabContent.classList.remove('hidden');
        }

        // Remove active class from all buttons
        var buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(function(button) {
            button.classList.remove('active');
        });

        // Add active class to the clicked button
        var clickedButton = document.querySelector('.tab-button[data-tab-page="' + tabId + '"]');
        if (clickedButton) {
            clickedButton.classList.add('active');
        }
    }
    // end tabswitch

    // profile dropdown
    document.addEventListener("DOMContentLoaded", function() {
        var dropdownToggle = document.querySelector('.dropdown-toggle');
        var dropdownMenu = document.querySelector('.dropdown-menu');

        dropdownToggle.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
    // end profile dropdown
</script>