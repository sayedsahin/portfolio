<?php 
namespace Controllers;

use Libraries\Form;
use Models\User;
use Systems\Controller;
use Systems\Session;

class UserController extends Controller
{
	protected object $model;
	protected int $id;
	function __construct()
	{
		parent::__construct();
		$this->model = new User;
		Session::init();
		Session::auth();
		$this->id = Session::get('id');
		$data = [];
	}
	public function edit()
	{
		return view('user/edit', [
			'user' => $this->model->find($this->id),
			'about' => $this->model->table('abouts')
				->where('user_id', $this->id)
				->get('single'),
		]);
	}

	public function name()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('name')->required();

		$valid->submit() ?: exit($this->errors($valid->errors));

		$id = $this->model->where('id', $this->id)->update($valid->values);
		!$id ?: $this->success('Name');
	}

	public function email()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('email')->required()->email();

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->where('id', $this->id)->update($valid->values);
		!$id ?: $this->success('Email');
	}

	public function contact()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('contact')->required()->length(10, 30);

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->where('id', $this->id)->update($valid->values);
		!$id ?: $this->success('Phone');
	}

	public function info()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('info')->required()->length(10, 250);

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->where('id', $this->id)->update($valid->values);
		!$id ?: $this->success('Skill');
	}

	public function avatar()
	{
	    
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$_FILES['avatar']['name'] ?: exit(redirect()->back()->with(['error' => 'avatar is empty !']));

		$file_name = $_FILES['avatar']['name'];
		$file_size = $_FILES['avatar']['size'];
		$file_error = $_FILES['avatar']['error'];
		$file_temp = $_FILES['avatar']['tmp_name'];
		$permited = ['jpg', 'jpeg', 'png', 'jfif', 'svg'];

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

		$avatar = 'public/assets/img/'.$uniqid.'.'.$file_ext;
		$thumb = 'public/assets/img/'.$uniqid.'_thumb.'.$file_ext;

		if(move_uploaded_file($file_temp, $avatar)){

			$user = $this->model->find($this->id);

			if (file_exists($user['avatar'])) {
				unlink($user['avatar']);
				if (file_exists($user['avatar_thumb'])) {
					unlink($user['avatar_thumb']);
				}
			}
		}

		if ($file_ext !== 'svg') {

			helper(['resize_image']);
			$thumbnile = resize_image($avatar, 400, 400);

			if ($file_ext === 'jpg' || $file_ext === 'jpeg' || $file_ext === 'jfif') {
				imagejpeg($thumbnile, $thumb);
			}elseif ($file_ext == 'png') {
				//header('Content-Type: image/png');
				imagepng($thumbnile, $thumb);
			}
		}else{
			$thumb = $avatar;
		}
		
		

		$id = $this->model->where('id', $this->id)->update([
			'avatar' => $avatar,
			'avatar_thumb' => $thumb
		]);
		redirect()->back()->with(['success' => 'Avatar has been updated']);
	}

	public function about()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('user_id')->required()->length(1, 10);
		$valid->post('about_1')->required()->length(10, 5000);

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->table('abouts')
			->where('user_id', $valid->values['user_id'])
			->update([
				'about_1' => $valid->values['about_1']
			]);
		!$id ?: $this->success('About');
	}

	public function experience()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('user_id')->required()->length(1, 10);
		$valid->post('about_2')->required()->length(10, 5000);

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->table('abouts')
			->where('user_id', $valid->values['user_id'])
			->update([
				'about_2' => $valid->values['about_2']
			]);
		!$id ?: $this->success('Experience');
	}

	public function success($input)
	{
		return redirect()->back()->with(['success' => $input.' Updated Successfully']);
	}

	public function errors($errors)
	{
		return redirect()->back()->with(['errors' => $errors]);
	}
}