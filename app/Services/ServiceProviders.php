<?php

use Twig\Environment;
use Bramus\Router\Router;
use App\Services\Services;
use Twig\Loader\FilesystemLoader;
use Symfony\Component\HttpFoundation\Request;


Services::set('loader', new FilesystemLoader('app/resources/templates'));
Services::set('twig', new Environment(Services::$register['loader']));
Services::set('request', Request::createFromGlobals());
Services::set('router', new Router());