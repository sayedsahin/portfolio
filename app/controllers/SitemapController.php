<?php 
namespace App\Controllers;

use App\Models\Project;

class SitemapController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->model = new Project();
	}

	public function index()
	{
		$links = $this->model->select('id')->where('visible', 1)->get();
		header('Content-type: application/xml');
		view('sitemap', ['links' => $links]);
	}
}