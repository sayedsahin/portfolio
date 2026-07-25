<?php 
namespace App\Controllers;

use App\Middlewares\Guest;
use App\Validation\Validator;
use App\Models\User;
use App\Supports\Auth;
use App\Systems\Session\Cookie;
use App\Systems\Session\RememberToken;
use App\Systems\Session\Session;

class AccountController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->model = new User;
		$data = [];
	}

	public function index()
	{
		$this->middleware(Guest::class);
		return view('auth.login');
	}

	public function login()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->bail()
				->required(['email', 'password'])
				->email('email')
				->validated();
		} catch (\App\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$email = $data['email'];
		$password = $data['password'];

		$user = db()->table('users')
			->where('email', $email)
			->first();

		if (!$user || !password_verify($password, $user->password)) {
			return response()
				->redirect()
				->with(['error' => 'Incorrect User or Password'])
				->back();
		}

		Auth::login((int) $user->id);

		if ($data['remember'] ?? false) {

			$token = RememberToken::generate();

			db()->table('remember_tokens')->insert([
				'user_id'    => $user->id,
				'token_hash' => $token['hash'],
				'expires_at' => date('Y-m-d H:i:s', time() + 86400 * 30),
				'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
				'created_at' => date('Y-m-d H:i:s'),
			]);

			Cookie::set(
				'remember_token',
				$token['raw'],
				86400 * 30,
				'Lax'
			);
		}
		return response()->redirect('/');
	}

	public function logout()
	{
		Session::destroy();
		return response()->redirect('/');
	}
}