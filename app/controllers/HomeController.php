<?php 
namespace Controllers;

use Models\Home;
use Systems\Controller;

class HomeController extends Controller
{
	private $model;
	function __construct()
	{
		parent::__construct();
		$this->model = new Home();
		$data = [];
	}

	public function index()
	{
		
		$data['user'] = $this->model->user();
		$data['projects'] = $this->model->project();
		$data['about'] = $this->model->about();
		$data['socials'] = $this->model->social();
		$this->load->view('index', $data);
		pr($data);
	}
}
?>