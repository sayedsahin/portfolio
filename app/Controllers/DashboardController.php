<?php 
namespace App\Controllers;

use App\Middlewares\Authenticated;

class DashboardController extends Controller
{
	private $model;
	function __construct()
	{
		$this->middleware(Authenticated::class);
		$data = [];
	}

	public function index()
	{
		return view('dashboard.index');
	}
}