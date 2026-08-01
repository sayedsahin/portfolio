<?php
namespace App\Models;
use Bhitti\Database\QueryBuilder;

class Project extends QueryBuilder
{
	protected string $defaultTable = 'projects';

	public function socials()
	{
		return $this->select('icon, link')->table('socials')->get();
	}

	public function project(int $id)
	{
		return $this->find($id);
	}
}
