<?php 
namespace Models;
use Systems\Model;

class Home extends Model
{
	protected string $table = '';

	function __construct()
	{
		parent::__construct();
		
	}

	public function user()
	{
		return parent::table('users')->where('id', 1)->get('single');
	}

	public function project()
	{
		return parent::select('id, thumb')->table('projects')->order('id DESC')->get();
	}

	public function about()
	{
		return parent::select('about_1, about_2')->table('abouts')->where('id', 1)->get('single');
	}

	public function social()
	{
		return parent::select('icon, link')->table('socials')->get();
	}
}
?>