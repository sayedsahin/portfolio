<?php 
namespace Systems;

use PDO;

class Database
{
	public object $pdo;
	function __construct()
	{
		if (!isset($this->pdo)) {
			try {
				$connection = new PDO(DB_CONNECTION.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$connection->exec("SET CHARACTER SET utf8");
				$this->pdo = $connection;
			} catch (PDOException $e) {
				die("Failed to connect with Database".$e->getMessage());
			}
		}
	}	
}