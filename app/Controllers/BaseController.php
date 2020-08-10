<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController {
    
    //Twig loader
    public $loader;
    // Twig
    public $twig;


    public function __construct () {
        $loader = new FilesystemLoader('app/resources/templates');
        $twig = new Environment($loader);
        $this->loader = $loader;
        $this->twig = $twig;
    }
}