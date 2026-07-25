<?php 
namespace App\Models;
use App\Systems\QueryBuilder;

class Home extends QueryBuilder
{
	public function user()
	{
		return $this->table('users')->where('id', 1)->first();
	}

	public function project()
	{
		return $this->select('id, thumb')->table('projects')->order('id DESC')->get();
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