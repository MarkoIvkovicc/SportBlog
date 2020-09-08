<?php

// Admin
// Dashboard
$router->get('/dashboard/admin', function() {
    echo twig()->render('admin/admin-index.html');
});
$router->get('/dashboard/posts', '\App\Controllers\DashboardController@postsIndex');
$router->get('/dashboard/users', '\App\Controllers\DashboardController@usersIndex');

//Users
$router->get('/users', '\App\Controllers\UsersController@index');
