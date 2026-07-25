<?php 
namespace App\Controllers;

use App\Validation\Validator;
use App\Models\Site;
use App\Systems\Session\Session;
use App\Middlewares\Authenticated;

class SiteController extends Controller
{
	protected object $model;

	function __construct()
	{
		$this->model = new Site;
		$this->middleware(Authenticated::class);
	}

	public function edit()
	{
		return view('site.edit', [
			'site' => $this->model->find(1),
		]);
	}

	public function update()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['title'])
				->validated();
		} catch (\App\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$data['tagline'] = $request->input('tagline') ?? '';
		$data['location'] = $request->input('location') ?? '';
		$data['copyright'] = $request->input('copyright') ?? '';
		$data['description'] = $request->input('description') ?? '';
		$data['credit'] = $request->input('credit') ?? '';

		$update = $this->model->where('id', 1)->update($data);
		
		if ($update) {
		    return response()->redirect()->with(['success' => 'site information updated successfully'])->back();
		}
		return response()->redirect()->back();
	}
}