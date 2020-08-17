<?php


$router->get('/', '\App\Controllers\PostController@index');
$router->get('/posts/create', '\App\Controllers\PostController@create');
$router->get('/posts/{id}', '\App\Controllers\PostController@show');
$router->post('/posts', '\App\Controllers\PostController@store');
$router->post('/updatePost/{id}', '\App\Controllers\PostController@update');
$router->post('/deletePost/{id}', '\App\Controllers\PostController@delete');
