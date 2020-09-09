<?php

// Admin
// Dashboard
$router->get('/dashboard', '\App\Controllers\DashboardController@index');
$router->get('/dashboard/posts', '\App\Controllers\DashboardController@postsIndex');
$router->get('/dashboard/users', '\App\Controllers\DashboardController@usersIndex');

//Users
$router->get('/users', '\App\Controllers\UsersController@index');