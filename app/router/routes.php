<?php
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
return $router;
?>