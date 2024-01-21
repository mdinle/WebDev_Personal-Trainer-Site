<?php
include __DIR__ . '/../dashboardcomponents/sidebar.php';
?>
<!-- start: Main -->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <?php
include __DIR__ . '/../dashboardcomponents/header.php';
?>
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
                    <div class="font-medium">My Sessions</div>
                </div>
                <!--Data upcoming and completed -->
                <div class="flex items-center mb-4 session-tab">
                    <button type="button" data-tab="session" data-tab-page="Upcoming" onclick="openTab('Upcoming')"
                        class="tab-button bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 rounded-tl-md rounded-bl-md hover:text-gray-600 active">Upcoming</button>
                    <button type="button" data-tab="session" data-tab-page="Completed" onclick="openTab('Completed')"
                        class="tab-button bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 hover:text-gray-600">Completed</button>
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
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                    Cancel Session</th>
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
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <button
                                        data-session-id="<?php echo $session->id; ?>"
                                        data-sessionStartTime="<?php echo $session->start_time; ?>"
                                        class="cancel-button inline-block p-1 rounded bg-red-300 text-white cursor-pointer hover:bg-red-500 font-medium text-[12px] leading-none">Cancel
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!--table upcoming end-->
                    <!--table completed-->
                    <table class="w-full min-w-[540px] hidden tab-content" data-tab-for="session" id="Completed">
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
                            <?php foreach ($completedSessions as $session): ?>
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
                    <!--table completed end-->
                </div>
                <!--Data upcoming and completed -->
            </div>
        </div>
        <!--tabel-->
        <!-- cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- upcoming sessions -->
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="text-2xl font-semibold mb-1">
                            <?php
                                $numberOfSessions = count($upcomingSessions);
echo $numberOfSessions;
?>
                        </div>
                        <div class="text-sm font-medium text-gray-400">Upcoming sessions</div>
                    </div>
                </div>
                <a onclick=redirectToBookingPage()
                    class="text-blue-500 cursor-pointer font-medium text-sm hover:text-blue-600">Book a
                    Session</a>
            </div>
            <!-- upcoming sessions -->
            <!--Completed Sessions-->
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">
                                <?php
                            $numberOfSessions = count($completedSessions);
echo $numberOfSessions;
?>
                            </div>
                        </div>
                        <div class="text-sm font-medium text-gray-400">Completed Sessions</div>
                    </div>
                </div>
            </div>
            <!--Completed Sessions-->
            <!--My Goal-->
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="text-2xl font-semibold mb-1">86 kg</div>
                        <div class="text-sm font-medium text-gray-400">My Goal</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-full bg-gray-100 rounded-full h-4">
                        <div class="h-full bg-blue-500 rounded-full p-1" style="width: 60%;">
                            <div class="w-2 h-2 rounded-full bg-white ml-auto"></div>
                        </div>
                    </div>
                    <span class="text-sm font-medium text-gray-600 ml-4">60%</span>
                </div>
                <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
            </div>
            <!--My Goal-->
        </div>
        <!-- cards -->
    </div>
    <!--main view-->
</main>
<!-- end: Main -->

<script>
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

    //cancel button
    const cancelButtons = document.querySelectorAll('.cancel-button');
    const cancelModal = document.getElementById('cancelModal');
    const closeModalButton = document.querySelector('.close');

    cancelButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const sessionId = button.dataset.sessionId;
            const sessionStartTime = new Date(button.dataset.sessionstarttime);

            // Calculate the time difference in hours
            const timeDifference = (sessionStartTime - new Date()) / (1000 * 60 * 60);

            if (timeDifference <= 24) {
                // Show the pop-up message
                cancelModal.classList.remove('hidden');
            } else {
                try {
                    // Make the fetch request to cancel the session
                    const response = await fetch('/cancel-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            sessionId: sessionId
                        }),
                    });

                    if (!response.ok) {
                        // Handle non-successful HTTP responses
                        const errorMessage = await response.text();
                        throw new Error(`Cancellation error: ${errorMessage}`);
                    }

                    // Remove the HTML element from the DOM
                    button.closest('tr').remove();
                } catch (error) {
                    // Handle errors here, e.g., display an alert
                    console.error(error.message);
                }
            }
        });
    });

    // Close the modal when the close button is clicked
    closeModalButton.addEventListener('click', () => {
        cancelModal.classList.add('hidden');
    });

    // Close the modal if the user clicks outside of it
    window.addEventListener('click', (event) => {
        if (event.target === cancelModal) {
            cancelModal.classList.add('hidden');
        }
    });
    // end cancel button
</script>

</html>