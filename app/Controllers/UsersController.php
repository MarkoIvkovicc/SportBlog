<?php

namespace App\Controllers;

use App\src\User;

class UsersController {

    public function index() 
    {
      $users = em()->getRepository(User::class)->findAll();

      echo twig()->render('users/index.html', compact('users'));
    }

    public function create()
    {
      echo twig()->render('users/create.html');  
    }

    public function store() {
      $em = em();

      $user = new User;

      $user->setName(request()->get('name'))
        ->setEmail(request()->get('email'))
        ->setPassword(request()->get('password'))
        ->setRole(request()->get('role'))
        ->setCreatedAt(new \DateTime('now'));

      $em->persist($user);

      $em->flush();

      return header("Location: /users/" . $user->getId());
    }

    public function show ($id) {
      $user = em()->find(User::class, $id);

      echo twig()->render('users/show.html', compact('user'));
    }

    public function update($id)
    {
      $em = em();

      $user = $em->find(User::class, $id); 

      $user->setName(request()->get('name'))
        ->setEmail(request()->get('email'))
        ->setPassword(request()->get('password'))
        ->setRole(request()->get('role'));

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

      echo twig()->render('users/edit.html', compact('user'));
    }
}