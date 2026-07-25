<?php 
namespace App\Models;
use App\Systems\QueryBuilder;

class Project extends QueryBuilder
{
	protected string $defaultTable = 'projects';

	public function socials()
	{
		return $this->select('icon, link')->table('socials')->get();
	}

	public function project($id)
	{
		return $this->find($id);
	}
}