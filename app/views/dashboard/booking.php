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
        <div id='BookingMade' class="modal hidden fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-gray-800 bg-opacity-50 absolute inset-0"></div>
            <div class="bg-white p-6 rounded-md shadow-md z-10">
                <p>Booking has been made</p>
                <button onclick=redirectToDashboardPage()
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Close</button>
            </div>
        </div>
        <p class="px-2 pb-4 md:mx-12 text-xl font-bold">Book a Session</p>
        <div class='flex bg-white shadow-md justify-start md:justify-center rounded-lg overflow-x-scroll mx-auto py-4 px-2 md:mx-12'
            id="dateContainer">
        </div>
        <div class='flex my-2 bg-white shadow-md justify-start rounded-lg overflow-x-scroll mx-auto py-4 px-2 md:mx-12'
            id="timeContainer">
        </div>
        <div class='flex bg-white shadow-md justify-start md:justify-center rounded-lg overflow-x-scroll mx-auto py-4 px-2 md:mx-12'
            id="sessionContainer">
        </div>
        <div
            class='flex mt-4 bg-white shadow-md justify-start md:justify-center rounded-lg overflow-x-scroll mx-auto py-4 px-2 md:mx-12'>
            <?php foreach ($trainers as $trainer): ?>
            <div data-trainer-id="<?php echo $trainer->id; ?>"
                class='trainer-box flex cursor-pointer items-center px-4 py-4 rounded-md hover:bg-blue-600 hover:text-white'>
                <div class='text-center'>
                    <p class='my-3 font-bold'>Trainer</p>
                    <p class='text-sm'>
                        <?php echo $trainer->username ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class='mt-4 flex justify-center items-center'>
            <button id='buttonContainer'>
        </div>
    </div>
    <!--main view-->
</main>
<!-- end: Main -->

<script>
    var currentDate = new Date();
    var selectedDate = '';
    var selectedTime = '';
    var selectedSession = '';
    var selectedTrainer = '';

    function redirectToDashboardPage() {
        window.location.href = 'dashboard';
    }

    // date selection
    for (var i = 0; i < 7; i++) {
        var currentDay = new Date(currentDate);
        currentDay.setDate(currentDay.getDate() + i);

        var day = {
            weekday: 'short',
        };
        var month = {
            month: 'short',
        }
        var currentDayString = currentDay.toLocaleDateString('en-US', day);
        var currentNumber = currentDay.getDate();
        var currentMonth = currentDay.toLocaleDateString('en-US', month)

        var dateBox = document.createElement('div');
        dateBox.className =
            'flex group date-box rounded-lg mx-1 transition-all duration-300 cursor-pointer justify-center w-16';
        dateBox.onclick = function() {
            selectDate(this);
        };

        dateBox.innerHTML = `
        <div class='flex items-center px-4 py-4 rounded-md hover:bg-blue-600 hover:text-white'>
            <div class='text-center'>
                <p class='text-sm'>${currentDayString}</p>
                <p class='my-3 font-bold'>${currentNumber}</p>
                <p class='text-sm'>${currentMonth}</p>
            </div>
        </div>
    `;

        function selectDate(element) {

            var allBoxes = document.querySelectorAll('.date-box');
            allBoxes.forEach(function(box) {
                box.style.backgroundColor = 'white';
            });

            element.style.backgroundColor = 'lightblue'

            selectedDate = {
                day: element.querySelector('.text-gray-900.text-sm').textContent,
                date: element.querySelector('.text-gray-900.my-3.font-bold').textContent,
                month: element.querySelector('.text-gray-800.text-sm').textContent,
            };

        }

        document.getElementById('dateContainer').appendChild(dateBox);


    }
    // end date selection

    var session = 15;

    // session selection
    for (var i = 0; i < 4; i++) {

        session += 15;

        var sessionBox = document.createElement('div');
        sessionBox.className =
            'flex group session-box rounded-lg mx-1 transition-all duration-300 cursor-pointer justify-center w-16';
        sessionBox.onclick = function() {
            selectSession(this);
        };

        sessionBox.innerHTML = `
        <div class='flex items-center px-4 py-4 rounded-md hover:bg-blue-600 hover:text-white'>
            <div class='text-center'>
            <p class='my-3 font-bold'>${session}</p>
            <p class='text-sm'>Min</p>
            </div>
        </div>
    `;



        function selectSession(element) {

            var allBoxes = document.querySelectorAll('.session-box');
            allBoxes.forEach(function(box) {
                box.style.backgroundColor = 'white';
            });

            element.style.backgroundColor = 'lightblue'

            selectedSession = parseInt(element.querySelector('p').textContent);

        }

        document.getElementById('sessionContainer').appendChild(sessionBox);
    }
    // end session selection

    // time selection
    for (var hour = 7; hour <= 22; hour++) {
        var currentTime = new Date();
        currentTime.setHours(hour, 0, 0, 0);

        var options = {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        };
        var timeString = currentTime.toLocaleTimeString('en-US', options);

        var timeBox = document.createElement('div');
        timeBox.className =
            'flex group time-box rounded-lg mx-1 transition-all duration-300 cursor-pointer justify-center w-16';
        timeBox.onclick = function() {
            selectTime(this);
        };

        timeBox.innerHTML = `
                <div class='flex items-center flex-col px-4 py-4 hover:bg-blue-600 hover:text-white rounded-md'>
                    <p class='text-sm'>${timeString}</p>
                </div>
            `;

        document.getElementById('timeContainer').appendChild(timeBox);

        function selectTime(element) {
            var allBoxes = document.querySelectorAll('.time-box');
            allBoxes.forEach(function(box) {
                box.style.backgroundColor = 'white';
            });

            element.style.backgroundColor = 'lightblue'

            selectedTime = element.querySelector('.text-gray-900.text-sm').textContent;

        }
    }
    // end time selection

    // trainer selection

    var selectedTrainer;

    document.addEventListener('DOMContentLoaded', function() {
        var trainerButtons = document.querySelectorAll('.trainer-box');
        trainerButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                selectTrainer(this);
            });
        });
    });

    // When a trainer is selected
    function selectTrainer(element) {
        var allButtons = document.querySelectorAll('.trainer-box');

        allButtons.forEach(function(box) {
            box.style.backgroundColor = 'white';
        });

        // Add 'selected' class to the clicked button
        element.style.backgroundColor = 'lightblue'

        selectedTrainer = element.dataset.trainerId;

        console.log(selectedTrainer)
    }
    // trainer selection

    // send data
    var bookSessionButton = document.createElement('div');
    bookSessionButton.className =
        'flex justify-center items-center';
    bookSessionButton.innerHTML = `
    <button id="bookSessionBtn" class="bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white hover:text-gray-100 rounded-md">
        Book Session
    </button>`;

    document.getElementById('buttonContainer').appendChild(bookSessionButton);

    // Event listener for Book Session button
    document.getElementById('bookSessionBtn').addEventListener('click', function() {
        // Check if all options are selected
        if (!selectedDate || !selectedTime || !selectedSession) {
            // Show a popup to inform the user to fill out all options
            alert('Please select a date, time, and session duration.');
            return;
        }

        // Usage
        if (!selectedTrainer) {
            alert('Please select a trainer.');
            return;
        }

        console.log(selectedTrainer);

        // If all options are selected, proceed to make the POST request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/createbooking', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response && response.success) {
                        handleSuccess();
                    } else if (response && response.error) {
                        // Time range already exists, display an error message
                        alert('Error: ' + response.error);
                    } else {
                        console.error('Invalid JSON structure in response');
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }
            }
        };

        // Prepare the data to send
        var postData = 'selectedDate=' + encodeURIComponent(JSON.stringify(selectedDate)) +
            '&selectedTime=' + encodeURIComponent(selectedTime) +
            '&selectedSession=' + encodeURIComponent(selectedSession) +
            '&selectedTrainer=' + encodeURIComponent(selectedTrainer);

        // Send the data
        xhr.send(postData);
    });

    const successModal = document.getElementById('BookingMade');

    function handleSuccess() {
        successModal.classList.remove('hidden');
    }
    // send data

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