<?php 
namespace Models;
use Systems\Model;

class Contact extends Model
{
	protected string $table = 'contacts';

	function __construct()
	{
		parent::__construct();
	}
}
