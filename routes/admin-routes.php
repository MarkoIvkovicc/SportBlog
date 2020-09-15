<?php

// Admin
// Dashboard
$router->get('/dashboard', '\App\Controllers\DashboardController@index');
$router->get('/dashboard/users', '\App\Controllers\DashboardController@usersIndex');
