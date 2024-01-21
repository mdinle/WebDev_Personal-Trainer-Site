<?php
namespace App\Controllers;

use DateTime;
use DateInterval;

class DashboardController
{
    private $BookingService;
    private $UserService;

    public function __construct()
    {
        $this->BookingService = new \App\Services\BookingService();
        $this->UserService = new \App\Services\UserService();
    }

    public function dashboard()
    {
        $userController = new \App\Controllers\UserController();

        // Check if the user is not logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page
            $userController->login();
            exit();
        }

        if($_SESSION['user_role'] == 'user') {
            $upcomingSessions = $this->BookingService->getAllUpcomingById($_SESSION['user_id']);
            $completedSessions = $this->BookingService->getAllCompletedById($_SESSION['user_id']);
            include '../views/dashboard/dashboard.php';
        } else {
            $this->trainerDashboard();
        }
    }

    public function trainerDashboard()
    {
        $userController = new \App\Controllers\UserController();

        // Check if the user is not logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page
            $userController->login();
            exit();
        }
        if($_SESSION['user_role'] == 'trainer') {
            $upcomingSessions = $this->BookingService->getAllUpcomingByIdForTrainer($_SESSION['user_id']);
            include '../views/dashboard/trainerdashboard.php';
        } else {
            $this->dashboard();
            exit();
        }
    }

    public function booking()
    {
        $userController = new \App\Controllers\UserController();
        
        if (!isset($_SESSION['user_id'])) {
            $userController->login();
            exit();
        }
        
        if($_SESSION['user_role'] == 'user') {
            $trainers = $this->BookingService->getAllTrainers();
            include '../views/dashboard/booking.php';
        } else {
            $this->trainerDashboard();
        }
        
    }

    public function createBooking()
    {
        if (isset($_POST['selectedDate']) && isset($_POST['selectedTime']) && isset($_POST['selectedSession'])) {
            $selectedDate = $_POST['selectedDate'];
            $selectedTime = $_POST['selectedTime'];
            $selectedSession = $_POST['selectedSession'];
            $trainer_id = $_POST['selectedTrainer'];

            $decodedDate = json_decode($selectedDate, true);

            if ($decodedDate === null) {
                echo 'Error: Failed to decode JSON string.';
                return;
            }

            $day = $decodedDate['day'];
            $date = $decodedDate['date'];
            $month = $decodedDate['month'];

            $combinedDateTime = $day . ' ' . $date . ' ' . $month . ' ' . $selectedTime;

            $dateTime = DateTime::createFromFormat('D d M g:i A', $combinedDateTime);

            if ($dateTime === false) {
                echo 'Error: Failed to create DateTime object.';
                return;
            }

            $endTime = clone $dateTime;
            $endTime->add(new DateInterval('PT' . $selectedSession . 'M'));

            $formattedStartTime = $dateTime->format('Y-m-d H:i:s');
            $formattedEndTime = $endTime->format('Y-m-d H:i:s');

            $trainingsession = new \App\Models\TrainingSession();

            $trainingsession->user_id = $_SESSION['user_id'];
            $trainingsession->trainer_id = $trainer_id;
            $trainingsession->start_time = $formattedStartTime;
            $trainingsession->end_time = $formattedEndTime;

            $this->BookingService->createBooking($trainingsession);
        }
    }

    public function cancelSession()
    {
        $jsonPayload = json_decode(file_get_contents('php://input'), true);
        $sessionId = $jsonPayload['sessionId'] ?? null;


        $success = $this->BookingService->deleteSession($sessionId, $_SESSION['user_id']);
    
        echo json_encode(['success' => $success]);
    }

    public function settings()
    {
        $userController = new \App\Controllers\UserController();

        // Check if the user is not logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page
            $userController->login();
            exit();
        }
        
        if($_SESSION['user_role'] == 'user') {
            if($_SERVER['REQUEST_METHOD'] == "GET") {
                include '../views/dashboard/settings.php';
            }

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $passwordChanged = $this->UserService->changePassword($hashedPassword, $_SESSION['user_id']);

                if($passwordChanged) {
                    $successMessage = 'Password Updated';
                    include '../views/dashboard/settings.php';
                }

            }
        } else {
            $this->trainersetting();
        }
    }

    public function trainersetting()
    {
        $userController = new \App\Controllers\UserController();

        // Check if the user is not logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login page
            $userController->login();
            exit();
        }
        
        if($_SESSION['user_role'] == 'trainer') {
            if($_SERVER['REQUEST_METHOD'] == "GET") {
                include '../views/dashboard/trainersetting.php';
            }

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $passwordChanged = $this->UserService->changePassword($hashedPassword, $_SESSION['user_id']);

                if($passwordChanged) {
                    $successMessage = 'Password Updated';
                    include '../views/dashboard/trainersetting.php';
                }

            }
        } else {
            $this->settings();
        }
    }
}
