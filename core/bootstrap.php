<?php

use Bramus\Router\Router;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Request;

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
    'path' => __DIR__ . '/db.mysql',
);

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array("src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// Obtaining the entity manager
$entityManager = EntityManager::create($params, $config);

//Router
$router = new Router();
require 'routes.php';
$router->run();

// Twig


//Base Controller
/* $baseController = new BaseController(); */

// Request 

