<?php 
namespace Models;
use Systems\Model;

class User extends Model
{
	protected string $table = 'users';

	function __construct()
	{
		parent::__construct();
		
	}
}
?>