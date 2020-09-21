<?php

namespace App\Controllers;

use App\src\User;
use App\Models\User as UserModel;
use App\src\Post;

class UsersController {
  
    public function create()
    {
      echo twig()->render('users/create.html');  
    }

    public function store() {
      $em = em();
      $user = new User;

      $checkIfUsernameExist = em()->getRepository(User::class)->findBy(array('name' => request()->get('name')));
      $checkIfEmailExist = em()->getRepository(User::class)->findBy(array('email' => request()->get('email')));

      if ($checkIfUsernameExist) {
        $msgUsername = true;
        echo twig()->render('auth/registerForm.html', compact('msgUsername')); return;
      } elseif ($checkIfEmailExist) {
        $msgEmail = true;
        echo twig()->render('auth/registerForm.html', compact('msgEmail')); return;
      } elseif (strlen(request()->get('password')) < 4) {
        $msgPassword = true;
        echo twig()->render('auth/registerForm.html', compact('msgPassword')); return;
      }

      $user->setName(request()->get('name'))
        ->setEmail(request()->get('email'))
        ->setPassword(password_hash(request()->get('password'), PASSWORD_BCRYPT))
        ->setRole('user')
        ->setCreatedAt(new \DateTime('now'));

      $em->persist($user);
      $em->flush();
      
      return header('Location: /login');
    }

    public function show ($id) {
      $user = em()->find(User::class, $id);
      $userModel = null;

      if (! $user) {
        echo twig()->render('http-codes/404.html');
        exit();
      }

      startSession();
      $admin = $logged = null;

      if (isset($_SESSION['token'])) {
        $userModel = new UserModel;
        $userModel->isAdmin() ? $admin = true : $admin = false;
        $userModel->getId() != null ? $logged = true : $logged = false;
      }

      $posts = em()->getRepository(Post::class)->findBy(array('user' => $user));

      echo twig()->render('users/show.html', compact('user', 'logged', 'admin', 'userModel', 'posts'));
    }

    public function update($id)
    {
      $em = em();
      $user = $em->find(User::class, $id);

      $user->setName(request()->get('username'))
        ->setEmail(request()->get('email'));

      if (request()->get('old-password') != null) {
        $oldPass = $user->getPassword();
        $userModel = new UserModel;
        $userModel->isAdmin() ? $admin = true : $admin = false;

        if (password_verify(request()->get('old-password'), $oldPass)) {
          if (strlen(request()->get('new-password')) < 4) {
            $msgNewPwd = true;
            echo twig()->render('users/edit.html', compact('user', 'admin', 'msgNewPwd')); return;
          } else {
            $user->setPassword(password_hash(request()->get('new-password'), PASSWORD_BCRYPT));
          }
        } else {
          $msgOldPwd = true;
          echo twig()->render('users/edit.html', compact('user', 'admin', 'msgOldPwd')); return;
        }
      }

      request()->get('role') ? $user->setRole(request()->get('role')) : '';

      if ($_FILES["image"]["name"] != '') {
        $storage = new StorageController;
        if ($user->getImage() != null) {
          $storage->deleteImage($user->getImage());
        }
        
        $user->setImage($storage->getImage('user', $id));
      }

      $em->merge($user);
      $em->flush();

      return header("Location: /users/" . $user->getId());
    }

    public function delete($id)
    {
      $em = em();
      $user = $em->find(User::class, $id);

      $em->remove($user);
      $em->flush();

      header("Location: /users");
    }

    public function edit($id)
    {
      $em = em();
      $user = $em->find(User::class, $id);
      $userModel = new UserModel;

      if (! $user) {
        echo twig()->render('http-codes/404.html');
        exit();
      }

      $userModel->isAdmin() ? $admin = true : $admin = false;

      echo twig()->render('users/edit.html', compact('user', 'admin'));
    }
}