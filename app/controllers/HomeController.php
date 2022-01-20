<?php 
namespace Controllers;

use Models\Home;
use Systems\Controller;
use Systems\Session;

class HomeController extends Controller
{
	private $model;
	function __construct()
	{
		parent::__construct();
		Session::init();
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
	}

	public function project(int $id=0)
	{
		$data['project'] = $this->model->table('projects')->find($id);
		$data['socials'] = $this->model->select('icon, link')->table('socials')->get();
		$data['images'] = $this->model->table('project_image')->where('project_id', $id)->get();

		return view('project/show', $data);
	}
}
?>