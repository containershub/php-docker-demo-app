<?php

$router = new \App\Classes\Router;

$router->get('/', 'App\Controllers\IndexController@show');
$router->post('/user/create', 'App\Controllers\IndexController@storeUser');
$router->post('/user/sendmail', 'App\Controllers\IndexController@sendMail');
$router->post('/post/create', 'App\Controllers\IndexController@storePost');
