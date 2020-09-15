<?php

namespace App\Controllers;

use App\src\Post as Post;
use App\src\Comment;
use App\src\User as UserEM;
use App\Models\User as UserModel;

class PostsController
  {
    public function index () {
      session_start();
      $admin = $logged = $user = null;

    	if (isset($_SESSION['token'])) {
	    	$user = new UserModel;
	    	$user->isAdmin() ? $admin = true : '';
	    	isset($user) ? $logged = true : $logged = false;
    	}
    
      $posts = em()->getRepository(Post::class)->findAll();
      echo twig()->render('posts/index-posts.html', compact('posts', 'admin', 'logged', 'user'));
  }

    public function create () {
      $user = new UserModel;        
      $user->isAdmin() ? $admin = true : $admin = false;

      echo twig()->render('posts/post-create.html', compact('admin'));  
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
      $user = new UserModel;
      $user->isAdmin() ? $admin = true : $admin = false;
      isset($user) ? $logged = true : $logged = false;
      
      echo twig()->render('posts/post-show.html', compact('post', 'comments', 'user', 'admin', 'logged'));
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

      isset($_SERVER['HTTP_REFERER']) ? $explode = explode('/', $_SERVER['HTTP_REFERER']) : '';
      $explode[3] == 'dashboard' ? $route = '/dashboard/posts' : $route = '/posts';

      return header("Location: " . $route);
    }

    //Post ID goes in parameter
    public function getCommentsByPostId($id) {
      $comments = em()->getRepository(Comment::class)->findBy(array('postId' => $id));
      return $comments;
    }
}