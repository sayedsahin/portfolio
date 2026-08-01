<?php
namespace App\Controllers;

use Bhitti\Validation\Validator;
use App\Models\Project;
use Bhitti\Session\Session;
use App\Middlewares\Authenticated;
use App\Traits\ImageCustomize;
use Bhitti\Http\Middleware\Attributes\Middleware;

#[Middleware(Authenticated::class)]
class ProjectController extends Controller
{
	use ImageCustomize;

	protected object $model;
	protected int $id;
	function __construct()
	{
		$this->id = Session::get('auth_user_id');
		$this->model = new Project();
	}

	public function index()
	{
		$data['projects'] = $this->model->select('id, name, description, thumb')->order('id DESC')->get();
		return view('project.index', $data);
	}

	public function create()
	{
		return view('project.create');
	}

	public function show(int $id=0)
	{
		$data['project'] = $this->model->project($id);
		$data['socials'] = $this->model->socials();
		$data['site'] = db()->table('sites')->find(1);
		$data['images'] = db()->table('project_image')->where('project_id', $id)->get();

		return view('project.show', $data);
	}

	public function store()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['name'])
				->min('name', 3)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$data['source'] = $request->input('source') ?? '';
		$data['preview'] = $request->input('preview') ?? '';
		$data['description'] = $request->input('description') ?? '';

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
				return response()->redirect()->with(['error' => "There was an error uploading your image !"])->back();
			} elseif (in_array($file_ext, $permited) === false) {
				return response()->redirect()->with(['error' => "You can upload only: ".implode(', ', $permited)." !"])->back();
			} elseif ($file_size > 1048576*3) {
				return response()->redirect()->with(['error' => "Image size should be less then 3MB !"])->back();
			}

			$data['image'] = $image = 'assets/img/portfolio/'.$uniqid.'.'.$file_ext;
			$data['thumb'] = $thumb = 'assets/img/portfolio/'.$uniqid.'_thumb.'.$file_ext;

			move_uploaded_file($file_temp, $image);
			// helper(['resize_image']);
			$thumbnile = $this->resize_image($image, 400, 288);
			if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
				imagejpeg($thumbnile, $thumb);
			} elseif ($file_ext == 'png') {
				imagepng($thumbnile, $thumb);
			}
		}

		$data['user_id'] = $this->id;
		$this->model->insert($data);
		return response()->redirect('/projects')->with(['success' => 'Project Submited Successfully']);
	}

	public function edit(int $id=0)
	{
		if (!$id) exit('404 not found');

		$data['project'] = $this->model->project($id);
		$data['images'] = db()->table('project_image')->where('project_id', $id)->get();
		return view('project.edit', $data);
	}

	public function update(int $id=0)
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['id', 'name'])
				->min('name', 3)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$data['source'] = $request->input('source') ?? '';
		$data['preview'] = $request->input('preview') ?? '';
		$data['description'] = $request->input('description') ?? '';
		$data['visible'] = $request->input('visible') ? 1 : 0;

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
				return response()->redirect()->with(['error' => "There was an error uploading your image !"])->back();
			} elseif (in_array($file_ext, $permited) === false) {
				return response()->redirect()->with(['error' => "You can upload only: ".implode(', ', $permited)." !"])->back();
			} elseif ($file_size > 1048576*3) {
				return response()->redirect()->with(['error' => "Image size should be less then 3MB !"])->back();
			}

			$data['image'] = $image = 'assets/img/portfolio/'.$uniqid.'.'.$file_ext;
			$data['thumb'] = $thumb = 'assets/img/portfolio/'.$uniqid.'_thumb.'.$file_ext;

			if(move_uploaded_file($file_temp, $image)){
				$project = $this->model->project($data['id']);

				if (file_exists($project->image)) {
					unlink($project->image);
					unlink($project->thumb);
				}
			}
			// helper(['resize_image']);
			$thumbnile = $this->resize_image($image, 400, 288);
			if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
				imagejpeg($thumbnile, $thumb);
			} elseif ($file_ext == 'png') {
				imagepng($thumbnile, $thumb);
			}
		}

		$this->model->where('id', $data['id'])->update($data);
		return response()->redirect()->with(['success' => 'Project Updated Successfully'])->back();
	}

	public function delete($id = 0)
	{
		$project = $this->model->project($id);
		if (!$project) exit('404 not found');

		$images = db()->table('project_image')
				->where('project_id', $id)
				->get();

		if ($images) {
			foreach ($images as $key => $image) {
				if (file_exists($image->image)) {
					unlink($image->image);
				}
			}
		}

		$delete = db()->table('projects')->where('id', $project->id)->delete();
		if ($delete) {
			if (file_exists($project->image)) {
				unlink($project->image);
				unlink($project->thumb);
			}
		}
		return response()->redirect('/projects')->with(['success' => 'Project Deleted Successfully']);
	}
}
