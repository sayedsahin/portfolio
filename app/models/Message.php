<?php 
namespace Models;
use Systems\Model;

class Message extends Model
{
	protected string $table = 'messages';

	function __construct()
	{
		parent::__construct();
	}
}
