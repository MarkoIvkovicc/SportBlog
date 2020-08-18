<?php

namespace App\Controllers;

class AdminController {

    public function index () {
        echo twig()->render('layouts/admin/index.html');
    }
  public function postIndex () {
    echo twig()->render('layouts/admin/post-index.html');  
  }  
}