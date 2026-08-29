<?php
namespace App\Controllers;

use Bhitti\Validation\Validator;
use App\Models\User;
use Bhitti\Session\Session;
use App\Middlewares\Authenticated;
use App\Traits\ImageCustomize;
use Bhitti\Http\Middleware\Attributes\Middleware;

#[Middleware(Authenticated::class)]
class UserController extends Controller
{
	use ImageCustomize;
	protected object $model;
	protected int $id;
	function __construct()
	{
		$this->id = Session::get('auth_user_id');
	}
	public function edit()
	{
		return response()->view('user.edit', [
			'user' => User::query()->select('*')->find($this->id),
			'about' => db()->table('abouts')
				->where('user_id', $this->id)
				->first(),
		]);
	}

	public function name()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['name'])
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return $this->errors($e->errors());
		}

		$id = User::query()->where('id', $this->id)->update($data);
		if ($id) {
		    return $this->success('Name');
		}
	}

	public function email()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['email'])
				->email('email')
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return $this->errors($e->errors());
		}

		$id = User::query()->where('id', $this->id)->update($data);
		if ($id) {
		    return $this->success('Email');
		}
	}

	public function contact()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['contact'])
				->min('contact', 10)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return $this->errors($e->errors());
		}

		$id = User::query()->where('id', $this->id)->update($data);
		if ($id) {
		    return $this->success('Phone');
		}
	}

	public function info()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['info'])
				->min('info', 10)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return $this->errors($e->errors());
		}

		$id = User::query()->where('id', $this->id)->update($data);
		if ($id) {
		    return $this->success('Skill');
		}
	}

	public function avatar()
	{
		$request = request();
		if (empty($_FILES['avatar']['name'])) {
		    return response()->redirect()->with(['error' => 'avatar is empty !'])->back();
		}

		$file_name = $_FILES['avatar']['name'];
		$file_size = $_FILES['avatar']['size'];
		$file_error = $_FILES['avatar']['error'];
		$file_temp = $_FILES['avatar']['tmp_name'];
		$permited = ['jpg', 'jpeg', 'png', 'jfif', 'svg'];

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

		$avatar = 'assets/img/'.$uniqid.'.'.$file_ext;
		$thumb = 'assets/img/'.$uniqid.'_thumb.'.$file_ext;

		if(move_uploaded_file($file_temp, $avatar)){

			$user = User::query()->select('avatar', 'avatar_thumb')->find($this->id);
			if (file_exists($user->avatar)) {
				unlink($user->avatar);
				if (file_exists($user->avatar_thumb)) {
					unlink($user->avatar_thumb);
				}
			}
		}

		if ($file_ext !== 'svg') {
			// helper(['resize_image']);
			$thumbnile = $this->resize_image($avatar, 400, 400);

			if ($file_ext === 'jpg' || $file_ext === 'jpeg' || $file_ext === 'jfif') {
				imagejpeg($thumbnile, $thumb);
			} elseif ($file_ext == 'png') {
				imagepng($thumbnile, $thumb);
			}
		} else {
			$thumb = $avatar;
		}

		User::query()->where('id', $this->id)->update([
			'avatar' => $avatar,
			'avatar_thumb' => $thumb
		]);
		return response()->redirect()->with(['success' => 'Avatar has been updated'])->back();
	}

	public function about()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['user_id', 'about_1'])
				->min('about_1', 10)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return $this->errors($e->errors());
		}

		$id = db()->table('abouts')
			->where('user_id', $data['user_id'])
			->update([
				'about_1' => $data['about_1']
			]);
		if ($id) {
		    return $this->success('About');
		}
	}

	public function experience()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['user_id', 'about_2'])
				->min('about_2', 10)
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return $this->errors($e->errors());
		}

		$id = db()->table('abouts')
			->where('user_id', $data['user_id'])
			->update([
				'about_2' => $data['about_2']
			]);
		if ($id) {
		    return $this->success('Experience');
		}
	}

	public function success($input)
	{
		return response()->redirect()->with(['success' => $input.' Updated Successfully'])->back();
	}

	public function errors($errors)
	{
		return response()->redirect()->with(['errors' => $errors])->back();
	}
}
