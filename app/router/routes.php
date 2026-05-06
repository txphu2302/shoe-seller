<?php
foreach (glob(__DIR__ . '/controller/**/*.php') as $controllerFile) {
    require_once $controllerFile;
}
require_once 'controller/user/UserController.php';
require_once 'Router.php';
$router = new Router();
$router->get('/user/homepage', 'UserController@homepage');
$router->get('/user/mainpage', 'UserController@mainpage');
$router->get('/user/orders', 'UserController@orders');
$router->get('/user/orderdetail', 'UserController@orderdetail');
$router->get('/user/community', 'UserController@community');
$router->get('/user/userinfo', 'UserController@userinfo');
$router->get('/user/review', 'UserController@review');
$router->get('/user/search', 'UserController@search');

//url Authorization
$router->get('Shoe-Seller/users/login', 'authController@login');
$router->get('Shoe-Seller/users/register', 'authController@register');
$router->get('Shoe-Seller/users/logout', 'authController@logout');















return $router;
?>