<?php
namespace App\Controllers;

use Bhitti\Validation\Validator;
use App\Models\User;
use Bhitti\Session\Session;
use App\Middlewares\Authenticated;
use Bhitti\Http\Middleware\Attributes\Middleware;

#[Middleware(Authenticated::class)]
class PasswordController extends Controller
{
	protected object $model;
	protected int $id;
	function __construct()
	{
		$this->model = new User;
		$this->id = Session::get('auth_user_id');
	}

	public function edit()
	{
		return response()->view('password.edit');
	}

	public function update()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['old-password', 'password', 'confirm-password'])
				->min('password', 6)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$oldPassword = $data['old-password'];
		$newPassword = $data['password'];
		$renewPassword = $data['confirm-password'];

		if ($newPassword !== $renewPassword) {
		    return response()->redirect()->with(['error' => 'password confirm does not match'])->back();
		}
		if ($oldPassword === $newPassword) {
		    return response()->redirect()->with(['error' => 'old-password and new-password is same'])->back();
		}


		$user = $this->model->select('id', 'email', 'password')->where('id', $this->id)
			->first();
		if (!$user || !password_verify($oldPassword, $user->password)) {
			return response()
				->redirect()
				->with(['error' => 'Incorrect User or Password'])
				->back();
		}

		$newPassword = $password = password_hash($newPassword, PASSWORD_DEFAULT);
		$update = $this->model->where('id', $this->id)->update([
			'password' => $newPassword,
		]);

		if ($update) {
			return response()->redirect()->with(['success' => 'password updated successfully'])->back();
		} else {
			return response()->redirect()->with(['error' => 'Error ! Password Not Updated'])->back();
		}
	}
}
