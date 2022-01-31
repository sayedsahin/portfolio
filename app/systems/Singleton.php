<?php 

namespace Systems;

class Singleton
{
	private static $instance = null;

	private function __construct()
	{
		
	}

	public static function getInstance()
	{
		if (static::$instance === null) {
			try {
				static::$instance = new \PDO(DB_CONNECTION.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
				static::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				static::$instance->exec("SET CHARACTER SET utf8");
			} catch (\PDOException $e) {
				die("Connection failed:  ".$e->getMessage());
			}
		}
		return static::$instance;
	}

}