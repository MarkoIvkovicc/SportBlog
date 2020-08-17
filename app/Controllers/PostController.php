<?php

namespace App\Controllers;

use App\src\Post as Post;

use App\Services\Services;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class PostController
{
    
    public function index () {
      echo twig()->render('index.html');
    }

    public function create () {
      echo twig()->render('posts/post-create.html');  
    }

    public function store () {
      $post = new Post;
      $post->setTitle(request()->get('title'));
      $post->setBody(request()->get('body'));
      $post->setCreatedAt(new \DateTime('now'));

      

      em()->persist($post);
      em()->flush();

      return header("Location: /posts/".$post->getId());
    }

    public function show ($id) 
    {
      em()->find('app\src\Post', $id);
    }

    public function update ($id)
    {
      /* em()->merge($post); */
      em()->flush();
    }

    public function delete ($id)
    {
      $post = new Post;
      $post = $this->em()->find('app\src\Post', $id);
      em()->remove($post);
      em()->flush();

      header("Location: /");
    }
}