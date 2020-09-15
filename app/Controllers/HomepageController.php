<?php

namespace App\Controllers;

use App\src\User;
use App\Models\User as UserModel;

class HomepageController {
    public function index () {

        $queryLast4 = 'SELECT * FROM Posts ORDER BY id DESC LIMIT 4';
        
        $statLast4 = em()->getConnection()->prepare($queryLast4);
        $statLast4->execute();

        $fetchLast4 = $statLast4->fetchAll();

        foreach ($fetchLast4 as $key => $value) {
            $usersId = array_shift(em()->getRepository(User::class)->findBy(array('id' => $value['owner_id'])));
            $usersImg[] = $usersId->getImage();
            $usersName[] = $usersId->getName();
        }

    	// session_start();
    	$admin = $logged = null;

    	if (isset($_SESSION['token'])) {
	    	$user = new UserModel;
	    	$user->isAdmin() ? $admin = true : '';
	    	isset($user) ? $logged = true : $logged = false;
    	}

        echo twig()->render('homepage.html', compact('admin', 'logged', 'fetchLast4', 'usersImg', 'usersName')); 
    }
} 