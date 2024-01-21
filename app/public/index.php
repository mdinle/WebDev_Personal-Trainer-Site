<?php
session_start();

require '../vendor/autoload.php';

$router = new \App\Router();
// Define routes
$router->add('/', 'App\Controllers\HomeController', 'index');
$router->add('/about', 'App\Controllers\HomeController', 'about');
$router->add('/login', 'App\Controllers\UserController', 'login');
$router->add('/logout', 'App\Controllers\UserController', 'logout');
$router->add('/signup', 'App\Controllers\UserController', 'signup');
$router->add('/dashboard', 'App\Controllers\DashboardController', 'dashboard');
$router->add('/trainerdashboard', 'App\Controllers\DashboardController', 'trainerDashboard');
$router->add('/booking', 'App\Controllers\DashboardController', 'booking');
$router->add('/createbooking', 'App\Controllers\DashboardController', 'createBooking');
$router->add('/cancel-session', 'App\Controllers\DashboardController', 'cancelSession');
$router->add('/settings', 'App\Controllers\DashboardController', 'settings');
$router->add('/trainersetting', 'App\Controllers\DashboardController', 'trainersetting');
// Route request
$router->route($_SERVER['REQUEST_URI']);
