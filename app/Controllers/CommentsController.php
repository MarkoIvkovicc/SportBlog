<?php

namespace App\Controllers;

use App\src\Comment;

class CommentsController
{
    public function index () {
      echo twig()->render('layouts/admin/comments/comment-index.html');  
    }

    public function store () {
      $comment = new Comment;
     // Comment owner
      $comment->setBody(request()->get('body'));

      em()->persist($comment);
      em()->flush();

      return header("Location: /posts/".$comment->getId());
    }

    public function edit ($id)
    {
      $comment = em()->find('App\src\Post', $id);
      echo twig()->render('posts/comment-edit.html', compact('comment'));
    }

    public function update ($id)
    {
      $comment = em()->find('App\src\Comment', $id);

      $comment->getBody() != request()->get('body') ? $comment->setBody(request()->get('body')) : '';
      $comment->setCreatedAt(new \DateTime('now'));
      em()->merge($comment);
      em()->flush();

      return header("Location: /posts/".$comment->getId());
    }

    public function delete ($id)
    {
      $comment = new Comment;
      $comment = em()->find('app\src\Post', $id);
      em()->remove($comment);
      em()->flush();

      header("Location: /");
    }
} 