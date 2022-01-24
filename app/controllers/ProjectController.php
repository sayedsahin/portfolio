<?php 
namespace Controllers;

use Libraries\Form;
use Models\Project;
use Systems\Controller;
use Systems\Model;
use Systems\Session;

class ProjectController extends Controller
{
	protected object $model;
	protected int $id;
	function __construct()
	{
		Session::init();
		Session::auth();
		$this->id = Session::get('id');
		$this->model = new Project();
		$data = [];
	}

	public function index()
	{
		$data['projects'] = $this->model->select('id, name, description, thumb')->get();
		return view('project/index', $data);
	}

	public function create()
	{
		return view('project/create');
	}

	public function show(int $id=0)
	{
		$data['project'] = $this->model->project($id);
		$data['socials'] = $this->model->socials();
		$data['site'] = $this->model->table('sites')->find(1);
		$data['images'] = $this->model->table('project_image')->where('project_id', $id)->get();

		return view('project/show', $data);
	}

	public function store()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('name')->required()->length(3, 100);
		$valid->post('source')->length(0, 250);
		$valid->post('preview')->length(0, 250);
		$valid->post('description')->length(0, 1000);
		if ($valid->submit()) {
			if (!empty($_FILES['image']['name'])) {
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_error = $_FILES['image']['error'];
				$file_temp = $_FILES['image']['tmp_name'];
				$permited = ['jpg', 'jpeg', 'png'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$uniqid = uniqid();

				if ($file_error !== 0) {
					$msg = "There was an error uploading your image !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}elseif (in_array($file_ext, $permited) === false) {
					$msg = "You can upload only: ".implode(', ', $permited)." !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}elseif ($file_size > 1048576*3) {
					$msg = "Image size should be less then 3MB !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}

				$valid->values['image'] = $image = 'public/assets/img/portfolio/'.$uniqid.'.'.$file_ext;
				$valid->values['thumb'] = $thumb = 'public/assets/img/portfolio/'.$uniqid.'_thumb.'.$file_ext;

				move_uploaded_file($file_temp, $image);
				helper(['resize_image']);
				$thumbnile = resize_image($image, 400, 288);
				if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
					imagejpeg($thumbnile, $thumb);
				}elseif ($file_ext == 'png') {
					//header('Content-Type: image/png');
					imagepng($thumbnile, $thumb);
				}

			}
			$valid->values['user_id'] = $this->id;
			$id = $this->model->insert($valid->values, 'id');
			redirect('/project')->with(['success' => 'Project Submited Successfully']);
		}else {
			redirect()->back()->with(['errors' => $valid->errors]);
		}
	}

	public function edit(int $id=0)
	{
		$id ?: exit('404 not found') ;

		$data['project'] = $this->model->project($id);
		$data['images'] = $this->model->table('project_image')->where('project_id', $id)->get();
		return view('project/edit', $data);
	}

	public function update()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('id')->required();
		$valid->post('name')->required()->length(3, 100);
		$valid->post('source')->length(0, 250);
		$valid->post('preview')->length(0, 250);
		$valid->post('description')->length(0, 1000);
		if ($valid->submit()) {
			if (!empty($_FILES['image']['name'])) {
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_error = $_FILES['image']['error'];
				$file_temp = $_FILES['image']['tmp_name'];
				$permited = ['jpg', 'jpeg', 'png'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$uniqid = uniqid();

				if ($file_error !== 0) {
					$msg = "There was an error uploading your image !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}elseif (in_array($file_ext, $permited) === false) {
					$msg = "You can upload only: ".implode(', ', $permited)." !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}elseif ($file_size > 1048576*3) {
					$msg = "Image size should be less then 3MB !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}

				$valid->values['image'] = $image = 'public/assets/img/portfolio/'.$uniqid.'.'.$file_ext;
				$valid->values['thumb'] = $thumb = 'public/assets/img/portfolio/'.$uniqid.'_thumb.'.$file_ext;

				if(move_uploaded_file($file_temp, $image)){

					$project = $this->model->project($valid->values['id']);

					if (file_exists($project['image'])) {
						unlink($project['image']);
						unlink($project['thumb']);
					}
				}
				helper(['resize_image']);
				$thumbnile = resize_image($image, 400, 288);
				if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
					imagejpeg($thumbnile, $thumb);
				}elseif ($file_ext == 'png') {
					//header('Content-Type: image/png');
					imagepng($thumbnile, $thumb);
				}

			}
			$id = $this->model->where('id', $valid->values['id'])->update($valid->values);
			redirect()->back()->with(['success' => 'Project Updated Successfully']);
		}else {
			redirect()->back()->with(['errors' => $valid->errors]);
		}
	}
	
	public function delete($id = 0)
	{

		$project = $this->model->project($id);
		$project ?: exit('404 not found') ;

		$images = $this->model->table('project_image')
				->where('project_id', $id)
				->get();

		if ($images) {
			foreach ($images as $key => $image) {
				if (file_exists($image['image'])) {
					unlink($image['image']);
				}
			}
		}

		$delete = $this->model->table('projects')->delete($project['id']);
		if ($delete) {
			if (file_exists($project['image'])) {
				unlink($project['image']);
				unlink($project['thumb']);
			}
		}
		redirect('/project')->with(['success' => 'Project Deleted Successfully']);
	}
}