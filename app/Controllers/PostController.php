<?php

namespace App\Controllers;

class PostController {

    public function index () {
      echo twig()->render('index.html');
    }

    public function create () {
      echo twig()->render('posts/post-create.html');  
    }

    public function store () {
      /* $post = App\post;
      $post->setTitle('title');
      $entityManger->persist($post); */
     echo request()->get('kara');   
    }

    public function show ($id) {

    }
}