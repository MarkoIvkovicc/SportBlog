<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PostController extends BaseController {
    
    public function index () {
      echo  $this->twig->render('index.html');
    }
}
