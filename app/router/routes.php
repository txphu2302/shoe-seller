<?php
$route = [
    '' => ['HomeController', 'index'],
    //home routes
    'home/about' => ['HomeController', 'about'],
    'home/contact' => ['HomeController', 'contact'],
    //admin routes
    'admin' => ['AdminController', 'index'],
    //authentication routes
    // legacy view paths kept for compatibility
    'views/users/login' => ['AuthController', 'login'],
    'views/users/register' => ['AuthController', 'register'],
    'views/users/logout' => ['AuthController', 'logout'],
    // preferred auth routes
    'auth/login' => ['AuthController', 'login'],
    'auth/register' => ['AuthController', 'register'],
    'auth/logout' => ['AuthController', 'logout'],
];
