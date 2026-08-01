<?php
namespace App\Models;
use Bhitti\Database\QueryBuilder;

class Home extends QueryBuilder
{
	public function user()
	{
		return $this->table('users')->where('id', 1)->first();
	}

	public function project(int $id)
	{
		return $this->table('projects')->find($id);
	}

	public function projects()
	{
		return $this->select('id, thumb')->table('projects')->where('visible', 1)->order('id DESC')->get();
	}

	public function about()
	{
		return $this->select('about_1, about_2')->table('abouts')->where('id', 1)->first();
	}

	public function social()
	{
		return $this->select('icon, link')->table('socials')->get();
	}
}
