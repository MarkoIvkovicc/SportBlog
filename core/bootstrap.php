<?php


use App\Services\Services;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require 'app/Services/ServiceProviders.php';
require 'app/Services/Helpers.php';


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
$config = Setup::createAnnotationMetadataConfiguration(array("app/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// Obtaining the entity manager
$entityManager = EntityManager::create($params, $config);

//Router
$router = router();
require 'routes.php';
$router->run();




