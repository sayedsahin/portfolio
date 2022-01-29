<?php
// Dependency Injection

interface DatabaseInterface
{
	public function connect();
}

class Model
{
	protected $db;
	
	function __construct(DatabaseInterface $db)
	{
		$this->db = $db;
	}

	public function connected()
	{
		return $this->db->connect();
	}
}

class MySqlDB implements DatabaseInterface
{
	
	public function connect()
	{
		return "mysql connected";
	}
}

class PgSqlDB implements DatabaseInterface
{
	
	public function connect()
	{
		return "pgsql connected";
	}
}


$mysql = new MySqlDB();
$pgsql = new PgSqlDB();
$model = new Model($mysql);
echo $model->connected();