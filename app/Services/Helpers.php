<?php

use App\Services\Services;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

function twig () {
    return Services::get('twig');
}

function request () {
    return Services::get('request');
}

function router () {
    return Services::get('router');
}
function em () {

    // Get connection variables
$app = require 'config.php';
    // Set connection variables
$params = require 'dbParams.php';

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array("app/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// Obtaining the entity manager
return $entityManager = EntityManager::create($params, $config);
}


