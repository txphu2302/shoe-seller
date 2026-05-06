<?php
$route = [
    '' => ['HomeController', 'index'],
    //home routes
    'home/about' => ['HomeController', 'about'],
    'home/contact' => ['HomeController', 'contact'],
    //admin routes
    'admin' => ['AdminController', 'index'],
    //authentication routes
    'auth/login' => [authController::class, 'login'],
    'auth/register' => [authController::class, 'register'],
    'auth/logout' => [authController::class, 'logout'],
    //
    'users/login' => [authController::class, 'login'],
    'users/register' => [authController::class, 'register'],
    'users/logout' => [authController::class, 'logout'],
];
