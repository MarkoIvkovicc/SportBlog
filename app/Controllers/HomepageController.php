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
        unset($last4[0]);
        $last3Posts = $last4;

        //Get Last 4 Created Posts Older Than 31 Days
        $now = new DateTime();
        $back = $now->sub(DateInterval::createFromDateString('31 days'));
        $back = $back->format('y-m-d H:i');

        $pastMonth = em()->createQuery("SELECT p FROM App\src\Post p WHERE p.createdAt < '$back' ORDER BY p.createdAt DESC")->setMaxResults(4)->getResult();

        $pastMonthFirst2 = array_slice($pastMonth, 0, 2);
        $pastMonthLast2 = array_slice($pastMonth, 2, 2);
        
        //Check if user is admin and if it is logged
        startSession();
    	$admin = $logged = null;

    	if (isset($_SESSION['token'])) {
	    	$user = new UserModel;
	    	$user->isAdmin() ? $admin = true : '';
	    	isset($user) ? $logged = true : $logged = false;
    	}

        //Setting time needed to read post
        $readTime[] = $this->minRead($lastPost->getBody());
        foreach ($last3Posts as $post) {
            $readTime[] = $this->minRead($post->getBody());
        }
        foreach ($pastMonth as $post) {
            $readTime[] = $this->minRead($post->getBody());
        }

        echo twig()->render('homepage.html', compact('admin', 'logged', 'lastPost', 'last3Posts', 'pastMonthFirst2', 'pastMonthLast2', 'readTime')); 
    }

    private function minRead($srtlen) {
        $srtlen = strlen($srtlen);
        switch ($srtlen) {
            case $srtlen < 2000:
                $min = 1;
                break;
            case $srtlen < 2400:
                $min = 2;
                break;
            case $srtlen < 2800:
                $min = 3;
                break;
            case $srtlen < 3200:
                $min = 4;
                break;
            case $srtlen < 3600:
                $min = 5;
                break;
            case $srtlen >= 3600:
                $min = '5+';
                break;
            default:
                $min = 'Nan';
                break;
        }

        return $min;
    }
} 