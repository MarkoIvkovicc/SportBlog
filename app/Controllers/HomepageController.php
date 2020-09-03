<?php

namespace App\Controllers;

class HomepageController {
    public function index () {
        $posts = em()->getRepository('App\src\Post')->findAll();
        echo twig()->render('index.html'); 
    }
} 