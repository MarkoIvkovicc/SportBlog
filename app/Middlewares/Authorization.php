<?php

namespace App\Middlewares;

use Lcobucci\JWT\Parser;

class Authorization
{
	const ADMIN = 'admin';
	const USER = 'user';

	public function isAdmin()
	{
		session_start();

		$token = (new Parser())->parse((string) $_SESSION['token']);

		if(strcmp($token->getClaim('role'), self::ADMIN) !== 0)
		{
			echo "401, Forbidden";
		}
	}

	public function isUser()
	{
		session_start();

		$token = (new Parser())->parse((string) $_SESSION['token']);

		if(strcmp($token->getClaim('role'), self::USER) !== 0)
		{
			echo "401, Forbidden";
		}
	}
}