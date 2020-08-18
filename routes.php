<?php

// Posts

$router->get('/', '\App\Controllers\PostController@index');
$router->get('/posts/create', '\App\Controllers\PostController@create');
$router->get('/posts/{id}', '\App\Controllers\PostController@show');
$router->post('/posts', '\App\Controllers\PostController@store');
$router->get('/editPost/{id}', '\App\Controllers\PostController@edit');
$router->post('/updatePost/{id}', '\App\Controllers\PostController@update');
$router->post('/deletePost/{id}', '\App\Controllers\PostController@delete');

// Admin

$router->get('/admin', '\App\Controllers\AdminController@index');

$router->get('/admin/posts', '\App\Controllers\AdminController@postIndex');
$router->get('/admin/posts/{id}/edit', '\App\Controllers\AdminController@postEdit');
$router->patch('/admin/posts/{id}', '\App\Controllers\AdminController@postUpdate');
$router->delete('/admin/posts/{id}', '\App\Controllers\AdminController@postDelete');

$router->get('/admin/comments', '\App\Controllers\AdminController@commentIndex');
$router->get('/admin/comments/{id}/edit', '\App\Controllers\AdminController@commentEdit');
$router->patch('/admin/comments/{id}', '\App\Controllers\AdminController@commentUpdate');
$router->delete('/admin/comments/{id}', '\App\Controllers\AdminController@commentDelete');

$router->get('/admin/users', '\App\Controllers\AdminController@userIndex');
$router->get('/admin/users/{id}/edit', '\App\Controllers\AdminController@userEdit');
$router->patch('/admin/users/{id}', '\App\Controllers\AdminController@userUpdate');
$router->delete('/admin/users/{id}', '\App\Controllers\AdminController@userDelete');

// Users
$router->get('/users/{id}/edit', '\App\Controllers\UsersController@edit');
$router->get('/users', '\App\Controllers\UsersController@index');
$router->post('/users', '\App\Controllers\UsersController@store');
$router->get('/users/{id}', '\App\Controllers\UsersController@show');
$router->post('/users/{id}', '\App\Controllers\UsersController@update');
$router->get('/users/create', '\App\Controllers\UsersController@create');
$router->delete('/users/{id}', '\App\Controllers\UsersController@delete');
