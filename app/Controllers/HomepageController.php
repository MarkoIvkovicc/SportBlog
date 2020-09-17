<?php

namespace App\Controllers;

use App\src\User;
use App\Models\User as UserModel;
use App\src\Post;
use DateTime;
use DateInterval;

class HomepageController {
    public function index () {
        //Get Last 4 Created Posts
        $last4 = em()->getRepository(Post::class)->findBy(array(),array('id'=>'DESC'),4,0);

        $lastPost = $last4[0];
        $last3Posts = array_slice($last4, 1);

        //Get Last 4 Created Posts Older Than 31 Days
        $now = new DateTime();
        $back = $now->sub(DateInterval::createFromDateString('31 days'));
        $back = $back->format('y-m-d H:i');

        $pastMonth = em()->createQuery("SELECT p FROM App\src\Post p WHERE p.createdAt < '$back' ORDER BY p.createdAt DESC")->setMaxResults(4)->getResult();

        $pastMonthFirst2 = array_slice($pastMonth, 0, 2);
        $pastMonthLast2 = array_slice($pastMonth, 2, 2);

    	session_start();
    	$admin = $logged = null;

    	if (isset($_SESSION['token'])) {
	    	$user = new UserModel;
	    	$user->isAdmin() ? $admin = true : '';
	    	isset($user) ? $logged = true : $logged = false;
    	}

        // die(var_dump($lastPost));

        // wordwrap($text, 8, "\n", false);

        echo twig()->render('homepage.html', compact('admin', 'logged', 'lastPost', 'last3Posts', 'pastMonthFirst2', 'pastMonthLast2')); 
    }
} 