<?php 

namespace App\Controllers;

use App\src\Post;
use App\src\User;
use App\Models\User as UserModel;

class DashboardController {
  
    public function postsIndex () {
        $user = new UserModel;

        if ($user->isAdmin()) {
            $posts = em()->getRepository(Post::class)->findAll();
        } elseif ($user->isUser()) {
            $posts = em()->getRepository(Post::class)->findBy(array('user' => $user->getId()));
        }

        $user->isAdmin() ? $admin = true : $admin = false;

        echo twig()->render('admin/posts-index.html', compact('posts', 'admin', 'user'));
    }

    public function usersIndex () {
        $users = em()->getRepository(User::class)->findAll();

        $user = new UserModel;
        $user->isAdmin() ? $admin = true : $admin = false;

        echo twig()->render('admin/users-index.html', compact('users', 'admin', 'user'));
    }

    public function index () {
        $user = new UserModel;        
        $user->isAdmin() ? $admin = true : $admin = false;

        //Total tables counts
        $queryTotal = 'SELECT
           (SELECT COUNT(u.id) FROM users u) as usersCount, 
           (SELECT COUNT(p.id) FROM posts p) as postsCount,
           (SELECT COUNT(c.id) FROM comments c) as commentsCount';
        
        $statTotal = em()->getConnection()->prepare($queryTotal);
        $statTotal->execute();

        $countsTotal = $statTotal->fetchAll();
        $countsTotal = array_shift($countsTotal);

        //Last month counts
        $queryLastMonth = "SELECT
           (SELECT COUNT(u.id) FROM users u WHERE u.created_at>now() - interval 1 month) as usersLastMonthCount, 
           (SELECT COUNT(p.id) FROM posts p WHERE p.created_at>now() - interval 1 month) as postsLastMonthCount,
           (SELECT COUNT(c.id) FROM comments c WHERE c.created_at>now() - interval 1 month) as commentsLastMonthCount";


        $statLastMonth = em()->getConnection()->prepare($queryLastMonth);
        $statLastMonth->execute();

        $countsLastMonth = $statLastMonth->fetchAll();
        $countsLastMonth = array_shift($countsLastMonth);

    //Graphs
        //Last three months count
        $queryLast3Months = "SELECT 
            (SELECT COUNT(p.id) FROM posts p WHERE MONTH(p.created_at) = MONTH(CURRENT_DATE())
            AND YEAR(p.created_at) = YEAR(CURRENT_DATE())) AS postsThisMonth,
            (SELECT COUNT(p.id) FROM posts p WHERE MONTH(p.created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
            AND YEAR(p.created_at) = YEAR(CURRENT_DATE())) AS postsLastMonth,
            (SELECT COUNT(p.id) FROM posts p WHERE MONTH(p.created_at) = MONTH(CURRENT_DATE() - INTERVAL 2 MONTH) 
            AND YEAR(p.created_at) = YEAR(CURRENT_DATE())) AS postsBefore2Month,
            (SELECT COUNT(c.id) FROM comments c WHERE MONTH(c.created_at) = MONTH(CURRENT_DATE())
            AND YEAR(c.created_at) = YEAR(CURRENT_DATE())) AS commentsThisMonth,
            (SELECT COUNT(c.id) FROM comments c WHERE MONTH(c.created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
            AND YEAR(c.created_at) = YEAR(CURRENT_DATE())) AS commentsLastMonth,
            (SELECT COUNT(c.id) FROM comments c WHERE MONTH(c.created_at) = MONTH(CURRENT_DATE() - INTERVAL 2 MONTH) 
            AND YEAR(c.created_at) = YEAR(CURRENT_DATE())) AS commentsBefore2Month,
            (SELECT COUNT(u.id) FROM users u WHERE MONTH(u.created_at) = MONTH(CURRENT_DATE())
            AND YEAR(u.created_at) = YEAR(CURRENT_DATE())) AS usersThisMonth,
            (SELECT COUNT(u.id) FROM users u WHERE MONTH(u.created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
            AND YEAR(u.created_at) = YEAR(CURRENT_DATE())) AS usersLastMonth,
            (SELECT COUNT(u.id) FROM users u WHERE MONTH(u.created_at) = MONTH(CURRENT_DATE() - INTERVAL 2 MONTH) 
            AND YEAR(u.created_at) = YEAR(CURRENT_DATE())) AS usersBefore2Month,
            (SELECT COUNT(u.id) FROM users u WHERE MONTH(u.created_at) = MONTH(CURRENT_DATE() - INTERVAL 3 MONTH) 
            AND YEAR(u.created_at) = YEAR(CURRENT_DATE())) AS usersBefore3Month,
            (SELECT COUNT(u.id) FROM users u WHERE MONTH(u.created_at) = MONTH(CURRENT_DATE() - INTERVAL 4 MONTH) 
            AND YEAR(u.created_at) = YEAR(CURRENT_DATE())) AS usersBefore4Month,
            (SELECT COUNT(u.id) FROM users u WHERE MONTH(u.created_at) = MONTH(CURRENT_DATE() - INTERVAL 5 MONTH) 
            AND YEAR(u.created_at) = YEAR(CURRENT_DATE())) AS usersBefore5Month";

        $statLast3Months = em()->getConnection()->prepare($queryLast3Months);
        $statLast3Months->execute();

        $countsLast3Months = $statLast3Months->fetchAll();
        $countsLast3Months = array_shift($countsLast3Months);
        
        echo twig()->render('layouts/admin/admin-layout.html', compact('countsTotal', 'countsLastMonth', 'countsLast3Months', 'user', 'admin'));
    }
}