<?php

// Posts
// Loged user or admin
$router->get('/posts/create', '\App\Controllers\PostsController@create');
$router->post('/posts', '\App\Controllers\PostsController@store');
// Route for admins and post owners only
$router->get('/editPost/{id}', '\App\Controllers\PostsController@edit');
$router->post('/updatePost/{id}', '\App\Controllers\PostsController@update');
$router->post('/deletePost/{id}', '\App\Controllers\PostsController@delete');

//Comments
// Route for admins and comment owners
$router->get('/editComment/{id}', '\App\Controllers\CommentsController@edit');
$router->post('/updateComment/{id}', '\App\Controllers\CommentsController@update');
$router->post('/deleteComment/{id}', '\App\Controllers\CommentsController@delete');
// Loged user or admin
$router->post('/comments/{id}', '\App\Controllers\CommentsController@store');

//Users
// Routes for admins and profile owners only !!!
$router->get('/editUser/{id}', '\App\Controllers\UsersController@edit');
$router->get('/users/{id}', '\App\Controllers\UsersController@show');
$router->post('/updateUser/{id}', '\App\Controllers\UsersController@update');
$router->post('/deleteUser/{id}', '\App\Controllers\UsersController@delete');