<?php


/* use App\Services\Services;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager; */

require 'app/Services/ServiceProviders.php';
require 'app/Services/Helpers.php';


$entityManager = em();

//Router
$router = router();
require 'routes.php';
$router->run();




