<?php 

namespace App\Controllers;

class AdminController {
  
    public function postsIndex () {
        echo twig()->render('admin/posts-index.html');
    }

    public function commentsIndex () {
        echo twig()->render('admin/comments-index.html');
    }

    public function usersIndex () {
        echo twig()->render('admin/users-index.html');
    }
}