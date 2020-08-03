<?php

//Create connection to database
$app['conifg'] = require 'config.php';

require 'core/Connection.php';

//Router
$router = new \Bramus\Router\Router();

//
require 'routes.php';

$connection = Connection::getConnected($app['config']['database']);