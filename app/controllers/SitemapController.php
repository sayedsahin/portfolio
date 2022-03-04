<?php 
namespace Controllers;

use Systems\Controller;
use Models\Project;

class SitemapController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->model = new Project();
	}

	public function index()
	{
		$links = $this->model->select('id')->where('visible', 1) ->get();
		header('Content-type: application/xml');
		echo view('sitemap', ['links' => $links]);
	}
}