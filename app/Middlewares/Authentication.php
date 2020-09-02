<?php

namespace App\Middlewares;

use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

class Authentication
{
	public static function authenticateUser()
	{
		return self::validateToken();
	}

	private static function validateToken()
	{
		session_start();

		if (! isset($_SESSION['token']))
		{
			header('location: /login'); //with message: Your token is not valid. Please log in again.
		}

		$token = (new Parser())->parse((string) $_SESSION['token']);

		$data = new ValidationData();

		if (! $token->validate($data))
		{
			header('location: /login'); //with message: Your token is not valid. Please log in again.
		}

		return $token->getClaims();
	}
}