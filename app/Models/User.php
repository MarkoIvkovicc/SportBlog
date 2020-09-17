<?php

namespace App\Models;

use App\Middlewares\Authentication;

class User
{
    private const ADMIN = 'admin';
    private const USER = 'user';

    private $id;
    private $name;
    private $email;
    private $role;

    public function __construct()
    {
        $authentication = new Authentication;
        $user = $authentication->getUser();

        if (isset($user)) {
            $this->id = $user['id']->getValue();
            $this->name = $user['name']->getValue();
            $this->email = $user['email']->getValue();
            $this->role = $user['role']->getValue();            
        }

    }

    public function isAdmin()
    {
        return (strcmp($this->role, self::ADMIN) !== 0) ? false : true;
    }

    public function isUser()
    {
        return (strcmp($this->role, self::USER) !== 0) ? false : true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }
}