<?php 
namespace Systems;

use PDO;

class Database
{
	private string $dbhost = DB_HOST;
	private string $dbuser = DB_USER;
	private string $dbpass = DB_PASS;
	private string $dbname = DB_NAME;
	public object $pdo;
	function __construct()
	{
		if (!isset($this->pdo)) {
			try {
				$link = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$link->exec("SET CHARACTER SET utf8");
				$this->pdo = $link;
			} catch (PDOException $e) {
				die("Failed to connect with Database".$e->getMessage());
			}
		}
	}
	
	
}
?>