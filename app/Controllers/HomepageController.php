<?php

namespace App\Controllers;

use App\Models\User;

class HomepageController {
    public function index () {
    	session_start();
    	$admin = $logged = null;

    	if (isset($_SESSION['token'])) {
	    	$user = new User;
	    	$user->isAdmin() ? $admin = true : '';
	    	isset($user) ? $logged = true : $logged = false;
    	}

        echo twig()->render('homepage.html', compact('admin', 'logged')); 
    }
} 