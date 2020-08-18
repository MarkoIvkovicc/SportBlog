<?php


$router->get('/', '\App\Controllers\PostController@index');
$router->get('/posts/create', '\App\Controllers\PostController@create');
$router->get('/posts/{id}', '\App\Controllers\PostController@show');
$router->post('/posts', '\App\Controllers\PostController@store');

//Users
$router->get('/users', '\App\Controllers\UsersController@index');
$router->post('/users', '\App\Controllers\UsersController@store');
$router->get('/users/{id}', '\App\Controllers\UsersController@show');
$router->get('/users/create', '\App\Controllers\UsersController@create');
$router->patch('/users/{id}', '\App\Controllers\UsersController@update');
$router->delete('/users/{id}', '\App\Controllers\UsersController@delete');