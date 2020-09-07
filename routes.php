<?php

// Homepage
$router->get('/', '\App\Controllers\HomepageController@index');

// Admin
$router->get('/dashboard', function() {
    echo twig()->render('admin/admin-index.html');
});
$router->get('/dashboard/posts', '\App\Controllers\DashboardController@postsIndex');
$router->get('/dashboard/comments', '\App\Controllers\DashboardController@commentsIndex');
$router->get('/dashboard/users', '\App\Controllers\DashboardController@usersIndex');

// Posts
// Routes for anonymous visitors
$router->get('/posts', '\App\Controllers\PostsController@index');
// Route for Admins and post owners only
$router->get('/posts/create', '\App\Controllers\PostsController@create');
$router->post('/posts', '\App\Controllers\PostsController@store');
$router->get('/editPost/{id}', '\App\Controllers\PostsController@edit');
$router->post('/updatePost/{id}', '\App\Controllers\PostsController@update');
$router->post('/deletePost/{id}', '\App\Controllers\PostsController@delete');
$router->get('/posts/{id}', '\App\Controllers\PostsController@show');

//Comments
// Route for admins and comment owners
$router->get('/editComment/{id}', '\App\Controllers\CommentsController@edit');
$router->post('/updateComment/{id}', '\App\Controllers\CommentsController@update');
$router->post('/deleteComment/{id}', '\App\Controllers\CommentsController@delete');
$router->post('/comments/{id}', '\App\Controllers\CommentsController@store');


//Users
// Route for Admins only !!!
$router->get('/users', '\App\Controllers\UsersController@index');
// Routes for Admins and profile owners only !!!
$router->get('/users/{id}/edit', '\App\Controllers\UsersController@edit');
$router->get('/users/{id}', '\App\Controllers\UsersController@show');
$router->post('/users/{id}', '\App\Controllers\UsersController@update');
$router->delete('/users/{id}', '\App\Controllers\UsersController@delete');
$router->post('/users', '\App\Controllers\UsersController@store');

// Auth
$router->get('/login', '\App\Controllers\AuthController@loginForm');
$router->post('/login', '\App\Controllers\AuthController@login');
$router->get('/logout', '\App\Controllers\AuthController@logout');
$router->get('/register', '\App\Controllers\AuthController@registerForm');
