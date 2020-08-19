<?php

namespace App\Controllers;

use App\src\Post as Post;

class PostController
{
    
    public function index () {
      $posts = em()->getRepository(Post::class)->findAll();
      echo twig()->render('index.html');
    }

    public function create () {
      echo twig()->render('posts/post-create.html');  
    }

    public function store () {
      $post = new Post;
      $post->setTitle(request()->get('title'));
      $post->setBody(request()->get('body'));

      em()->persist($post);
      em()->flush();

      return header("Location: /posts/".$post->getId());
    }

    public function show ($id) 
    {
      $post = em()->find(Post::class, $id);
      echo twig()->render('posts/post-show.html', compact('post'));
    }

    public function edit ($id)
    {
      $post = em()->find(Post::class, $id);
      echo twig()->render('posts/post-edit.html', compact('post'));
    }

    public function update ($id)
    {
      $em = em();
      $post = $em->find(Post::class, $id);

      $post->getTitle() != request()->get('title') ? $post->setTitle(request()->get('title')) : '';
      $post->getBody() != request()->get('body') ? $post->setBody(request()->get('body')) : '';

      $em->merge($post);
      $em->flush();

      return header("Location: /posts/".$post->getId());
    }

    public function delete ($id)
    {
      $em = em();
      $post = $em->find(Post::class, $id);

      $em->remove($post);
      $em->flush();

      header("Location: /");
    }
}