<?php 
namespace Controllers;

use Models\Home;
use Systems\Controller;
use Systems\Model;

class DashboardController extends Controller
{
	private $model;
	function __construct()
	{
		parent::__construct();
		$data = [];
	}

	public function index()
	{
		return view('dashboard/index');
	}

	public function user()
	{
		return view('dashboard/user');
	}
	public function password()
	{
		return view('dashboard/password');
	}

	public function projects()
	{
		$db = new Model();
		$data['projects'] = $db->select('id, name, description, thumb')->table('projects')->get();
		return view('dashboard/projects', $data);
	}

	public function projectadd()
	{
		return view('dashboard/project_add');
	}

}
?>