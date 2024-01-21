<?php
namespace App\Controllers;

class UserController
{
    private $UserService;

    public function __construct()
    {
        $this->UserService = new \App\Services\UserService();
    }
    
    public function signup()
    {
        
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            include '../views/user/signup.php';
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $user = new \App\Models\User();

            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->password_hash = $hashedPassword;

            $this->UserService->createUser($user);
                
            $this->login();
        }
    }

    public function login()
    {
        $dashboardController = new \App\Controllers\DashboardController();
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $user = new \App\Models\User();

            $user->email = $_POST['email'];
            $user->password_hash = $_POST['password'];

            $authenticateUser = $this->UserService->authenticateUser($user);

            if($authenticateUser) {
                $_SESSION['user_id'] = $authenticateUser->id;
                $_SESSION['user_role'] = $authenticateUser->role;
                
                if($_SESSION['user_role'] == 'trainer') {
                    $dashboardController->trainerDashboard();
                    exit();
                } else {
                    $dashboardController->dashboard();
                    exit();
                }
            } else {
                $errorMessage = "Invalid email or password";
                include '../views/user/login.php';
                exit();
            }
        }

        include '../views/user/login.php';
    }

    public function logout()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            session_destroy();
            $this->login();
            exit();
        }
    }
}
