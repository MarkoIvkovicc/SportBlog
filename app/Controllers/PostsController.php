<?php

namespace App\Controllers;

use App\src\Post as Post;
use App\src\Comment;
use App\src\User as UserEM;
use App\Models\User as UserModel;

class PostsController
{
    public function index () {
      $posts = em()->getRepository(Post::class)->findAll();
      echo twig()->render('homepage.html', compact('posts'));
    }

    public function create () {
      echo twig()->render('posts/post-create.html');  
    }

    public function store () {
      $em = em();
      $post = new Post;
      $UserModel = new UserModel;
      $userEM = $em->find(UserEM::class, $UserModel->getId());
      
      $post->setTitle(request()->get('title'));
      $post->setBody(request()->get('body'));
      $post->setUser($userEM);
      $post->setCreatedAt(new \DateTime);

      $em->persist($post);
      $em->flush();

      return header("Location: /posts/" . $post->getId());
    }

    public function show ($id) 
    {
      $post = em()->find(Post::class, $id);
      $comments = $this->getCommentsByPostId($id);
      echo twig()->render('posts/post-show.html', compact('post', 'comments'));
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

      return header("Location: /dashboard");
    }

    //Post ID goes in parameter
    public function getCommentsByPostId($id) {
      $comments = em()->getRepository(Comment::class)->findBy(array('postId' => $id));
      return $comments;
    }
}