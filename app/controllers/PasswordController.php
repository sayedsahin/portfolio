<?php

namespace Controllers;

use Libraries\Form;
use Models\User;
use Systems\Controller;
use Systems\Session;

class PasswordController extends Controller
{
	protected object $model;
	protected int $id;
	function __construct()
	{
		parent::__construct();
		Session::init();
		Session::auth();
		$this->model = new User;
		$this->id = Session::get('id');
		$data = [];
	}

	public function edit()
	{
		return view('password/edit');
	}

	public function update()
	{
		// $this->checkUserId($id);
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$input = new Form;
		$input->post('old-password')->required();
		$input->post('password')->required()->length(6, 100);
		$input->post('confirm-password')->required();
		
		$input->submit() ?: exit(redirect()->back()->with(['errors' => $input->errors]));


		$oldpassword = $input->values['old-password'];
		$newpassword = $input->values['password'];
		$renewpassword = $input->values['confirm-password'];

		$newpassword === $renewpassword ?: exit(redirect()->back()->with(['error' => 'password confirm does not match']));
		$oldpassword !== $newpassword ?: exit(redirect()->back()->with(['error' => 'old-password and new-passowrd is same']));


		$user = $this->model->where('id', $this->id)
			->where('password', md5($oldpassword))
			->get('count');

		$user ?: exit(redirect()->back()->with(['error' => 'Incorrect Old Password']));

		$update = $this->model->where('id', $this->id)->update([
			'password' => md5($newpassword),
		]);

		if ($update) {
			return redirect()->back()->with(['success' => 'password updated successfully']);
		}else{
			return redirect()->back()->with(['error' => 'Error ! Password Not Updated']);
		}
	}
}