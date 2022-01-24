<?php 
namespace Systems;

use PDO;

class Database
{
	private string $dbhost = DB_HOST;
	private string $dbtype = DB_TYPE;
	private int	   $dbport = DB_PORT;
	private string $dbuser = DB_USER;
	private string $dbpass = DB_PASS;
	private string $dbname = DB_NAME;
	public  object $pdo;
	function __construct()
	{
		if (!isset($this->pdo)) {
			try {
				$connection = new PDO($this->dbtype.":host=".$this->dbhost.";port=".$this->dbport.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$connection->exec("SET CHARACTER SET utf8");
				$this->pdo = $connection;
			} catch (PDOException $e) {
				die("Failed to connect with Database".$e->getMessage());
			}
		}
	}
	
	
}
?>