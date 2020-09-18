<?php

namespace App\Controllers;

use App\src\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class AuthController
{
	public function loginForm()
	{
        startSession();
        isset($_SESSION['token']) ? header('Location: /') : '';
		echo twig()->render('auth/loginForm.html');
	}

    public function failLoginForm()
    {
        startSession();
        isset($_SESSION['token']) ? header('Location: /') : '';
        $fail = true;
        echo twig()->render('auth/loginForm.html', compact('fail'));
    }

	public function login()
    {
    	$credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password') 
        ];

    	$token = $this->authenticate($credentials);

    	session_start();
        session_regenerate_id(true);

    	$_SESSION['token'] = $token->__toString();

    	header('location:/');
    }

    public function logout()
    {
        // start a session
        startSession();
 
        // destroy everything in this session
        unset($_SESSION);
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"],$params["httponly"]
            );
        }
        session_destroy();

        header('location:/login');
    }

    public function registerForm()
    {
        startSession();
        isset($_SESSION['token']) ? header('Location: /') : '';
    	echo twig()->render('auth/registerForm.html');
    }

    public function authenticate($credentials)
    {
    	$em = em();

    	$qb = $em->createQueryBuilder()
    		->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $credentials['email']);

        $query = $qb->getQuery();

        $user = $query->getOneOrNullResult();

        if(!isset($user) || password_verify($credentials['password'], $user->getPassword()) != true)
        {
            return header('Location: /failLogin');
        }
        
        $token = $this->makeToken($user);

        return $token;	
    }

    private function makeToken($user)
    {
    	$time = time();

    	$signer = new Sha256();

    	$token = (new Builder())->issuedBy('SportBlog') // Configures the issuer (iss claim)
                        ->permittedFor('SportBlog') // Configures the audience (aud claim)
                        ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                        ->canOnlyBeUsedAfter($time) // Configures the time that the token can be used (nbf claim)
                        ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
                        ->withClaim('id', $user->getId()) // Configures a new claim, called "uid"
                        ->withClaim('name', $user->getName()) // Configures a new claim, called "name"
                        ->withClaim('email', $user->getEmail()) // Configures a new claim, called "email"
                        ->withClaim('role', $user->getRole()) // Configures a new claim, called "role"
                        ->getToken($signer, new Key('cika paja pojeo jaja')); // Retrieves the generated token

        return $token;
    }
}