<?php

namespace App\Middlewares;

use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

class Authentication
{
	public function passed()
	{
		session_start();
		
		if (! isset($_SESSION['token']))
		{	
			return false; //with message: Your token is not valid. Please log in again.
		}

		$token = $this->parseToken();

		$data = new ValidationData();

		if (! $token->validate($data))
		{
			return false;
		}

		return true;
	}

	public function getUser()
	{
		if ($this->passed())
		{
			return $this->parseToken()->getClaims();
		}
	}

	private function parseToken()
	{
		return (new Parser())->parse((string) $_SESSION['token']);
	}
}