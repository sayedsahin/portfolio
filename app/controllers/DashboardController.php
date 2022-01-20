<?php 
namespace Controllers;

use Models\Home;
use Systems\Session;
use Systems\Controller;
use Systems\Model;

class DashboardController extends Controller
{
	private $model;
	function __construct()
	{
		parent::__construct();
		Session::init();
		Session::auth();
		$data = [];
	}

	public function index()
	{
		return view('dashboard/index');
	}
	
	public function password()
	{
		return view('dashboard/password');
	}

}
?>