<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app = require '../../config.php';

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

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array("../../src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// Obtaining the entity manager
$entityManager = EntityManager::create($params, $config);