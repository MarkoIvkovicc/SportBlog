<?php

namespace App\Controllers;

use App\src\Comment;
use App\src\Post;
use App\src\User as UserEM;
use App\Models\User as UserModel;

class CommentsController
{
    //Post ID goes in parameter
    public function store ($id) {
      $em = em();
      $comment = new Comment;
      $UserModel = new UserModel;
      $userEM = $em->find(UserEM::class, $UserModel->getId());
      $post = $em->find(Post::class, $id);

      $comment->setBody(request()->get('body'));
      $comment->setCreatedAt(new \DateTime('now'));
      $comment->setUser($userEM);
      $comment->setPost($post);

      $em->persist($comment);
      $em->flush();

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

      return header("Location: /posts/".$comment->getPostId());
    }

    public function delete ($id)
    {
      $em = em();
      $comment = $em->find(Comment::class, $id);
      $postId = $comment->getPostId();
      $em->remove($comment);
      $em->flush();

      return header("Location: /posts/".$postId);
    }
} 