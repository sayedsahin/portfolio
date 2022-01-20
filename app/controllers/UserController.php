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
		$id = 1;
		$valid = new Form();
		$valid->post('name')->required();

		$valid->submit() ?: exit($this->errors($valid->errors));

		$id = $this->model->where('id', $id)->update($valid->values);
		!$id ?: $this->success('Name');
	}

	public function email()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$id = 1;
		$valid = new Form();
		$valid->post('email')->required()->email();

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->where('id', $id)->update($valid->values);
		!$id ?: $this->success('Email');
	}

	public function contact()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$id = 1;
		$valid = new Form();
		$valid->post('contact')->required()->length(10, 30);

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->where('id', $id)->update($valid->values);
		!$id ?: $this->success('Phone');
	}

	public function info()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$id = 1;
		$valid = new Form();
		$valid->post('info')->required()->length(10, 250);

		$valid->submit() ?: exit($this->errors($valid->errors));
		
		$id = $this->model->where('id', $id)->update($valid->values);
		!$id ?: $this->success('Skill');
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