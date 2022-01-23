<?php 
namespace Controllers;

use Libraries\Form;
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
		helper(['message']);
		$data['user'] = $this->model->user();
		$data['projects'] = $this->model->project();
		$data['about'] = $this->model->about();
		$data['socials'] = $this->model->social();
		$data['site'] = $this->model->table('sites')->find(1);
		$this->load->view('index', $data);
	}

	public function project(int $id=0)
	{
		$data['project'] = $this->model->table('projects')->find($id);
		$data['socials'] = $this->model->select('icon, link')->table('socials')->get();
		$data['images'] = $this->model->table('project_image')->where('project_id', $id)->get();
		$data['site'] = $this->model->table('sites')->find(1);

		return view('project/show', $data);
	}

	public function contact()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('name')->required()->length_utf8(0, 255);
		$valid->post('email')->required()->email()->length_utf8(0, 255);
		$valid->post('phone')->length_utf8(0, 255);
		$valid->post('body')->required();

		$valid->submit() ?: redirect('/#submitMessage')->with(['errors' => $valid->errors]);

		$id = $this->model->table('messages')->insert($valid->values, 'id');

		return !$id ?: redirect('/#submitMessage')->with(['success' => 'email has been sent']);
	}
}
?>