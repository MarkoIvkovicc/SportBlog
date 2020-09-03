<?php

namespace App\Controllers;

use App\src\Comment;

class CommentsController
{
        //Post ID goes in parameter
    public function store ($id) {
      $comment = new Comment;

      $comment->setPostId($id);
      $comment->setOwnerId($_SESSION['token']['id']);
      $comment->setBody(request()->get('body'));
      $comment->setCreatedAt(new \DateTime('now'));

      em()->persist($comment);
      em()->flush();

      return header("Location: /posts/".$id);
    }

    public function edit ($id)
    {
      $comment = em()->find(Comment::class, $id);
      echo twig()->render('comments/comment-edit.html', compact('comment'));
    }

    public function update ($id)
    {
      $em = em();
      $comment = $em->find(Comment::class, $id);

      $comment->getBody() != request()->get('body') ? $comment->setBody(request()->get('body')) : '';
      $comment->setCreatedAt(new \DateTime('now'));
      $em->merge($comment);
      $em->flush();

      return header("Location: /posts/".$comment->getId());
    }

    public function delete ($id)
    {
      $em = em();
      $comment = $em->find(Comment::class, $id);
      $em->remove($comment);
      $em->flush();

      return header("Location: /");
    }
} 