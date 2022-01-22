<?php 
namespace Models;
use Systems\Model;

class Site extends Model
{
	// $table use one function one time. 2nd time not working
	protected string $table = 'sites';

	function __construct()
	{
		parent::__construct();
	}
}
