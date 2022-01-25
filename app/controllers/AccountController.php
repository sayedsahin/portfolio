<?php 
namespace Controllers;

use Libraries\Form;
use Models\User;
use Systems\Controller;
use Systems\Session;

class AccountController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->model = new User;
		Session::init();
		$data = [];
	}

	public function index()
	{
		Session::guest();
		return view('account/login');
	}

	public function login()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$input = new Form;
		$input->post('email')->required()->email();
		$input->post('password')->required();

		$input->submit() ?: exit(redirect()->back()->with(['errors' => $input->errors]));
	
		$email = $input->values['email'];
		$password = $input->values['password'];

		$user = $this->model->where('email', $email)
			->where('password', md5($password))
			->get('single');
		$user ?: exit(redirect()->back()->with(['error' => 'Incorrect Email or Password']));

		Session::set("login", true);
		Session::set("id", $user['id']);
		Session::set("name", $user['name']);
		Session::set("avatar", $user['avatar']);
		return redirect('/dashboard');
	}

	public function logout()
	{
		Session::destroy();
		return redirect('/');
	}
}