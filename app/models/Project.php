<?php 
namespace Models;
use Systems\Model;

class Project extends Model
{
	// $table use one function one time. 2nd time not working
	protected string $table = 'projects';

	function __construct()
	{
		parent::__construct();
		
	}

	public function socials()
	{
		return parent::select('icon, link')->table('socials')->get();
	}

	public function project($id)
	{
		return parent::find($id);
	}
}