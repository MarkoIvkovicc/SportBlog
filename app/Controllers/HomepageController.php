<?php

namespace App\Controllers;

use App\Models\User;


class HomepageController {
    public function index () {
            echo twig()->render('homepage.html'); 
    }
} 