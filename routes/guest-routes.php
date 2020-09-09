<?php

// Homepage
$router->get('/', '\App\Controllers\HomepageController@index');

// Auth
$router->get('/login', '\App\Controllers\AuthController@loginForm');
$router->post('/login', '\App\Controllers\AuthController@login');
$router->get('/logout', '\App\Controllers\AuthController@logout');
$router->get('/register', '\App\Controllers\AuthController@registerForm');

// Posts
$router->get('/posts', '\App\Controllers\PostsController@index');
$router->get('/posts/{id}', '\App\Controllers\PostsController@show');

// Users
$router->post('/users', '\App\Controllers\UsersController@store');