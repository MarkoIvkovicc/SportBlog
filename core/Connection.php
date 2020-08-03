<?php

use Nette\Database\Connection;

class Connection{
	public static function getConnected ($config) {
		return new Connection(
			$config['connection'] . ';dbname=' . $config['name'],
			$config['username'],
			$config['password']
		);
	}
}