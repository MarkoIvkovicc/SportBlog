<?php

// Get connection variables
$app = require 'config.php';

// Set connection variables
$params = array(
    'dbname' => $app['name'],
    'user' => $app['username'],
    'password' => $app['password'],
    'host' => $app['host'],
    'port' => $app['port'],
    'driver' => $app['driver'],
);

//Router
$router = new \Bramus\Router\Router();

require 'routes.php';