<?php
namespace App\Controllers;

class DashboardController extends Controller
{

	public function index()
	{
		return response()->view('dashboard.index');
	}
}
