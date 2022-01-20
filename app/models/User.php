<?php 
namespace Models;
use Systems\Model;

class User extends Model
{
	// $table use one function one time. 2nd time not working
	protected string $table = 'users';

	function __construct()
	{
		parent::__construct();
		
	}
}
?>