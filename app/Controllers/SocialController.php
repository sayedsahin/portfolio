<?php
namespace App\Controllers;

use Bhitti\Validation\Validator;
use App\Models\Social;
use App\Middlewares\Authenticated;
use Bhitti\Http\Middleware\Attributes\Middleware;

#[Middleware(Authenticated::class)]
class SocialController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->model = new Social;
	}

	public function index()
	{
		return response()->view('social.index', [
			'socials' => $this->model->get(),
		]);
	}

	public function create()
	{
		return response()->view('social.create');
	}

	public function store()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['name', 'link', 'icon'])
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$inserted = $this->model->insert($data);

		if ($inserted) {
		    return response()->redirect('/socials')->with(['success' => 'Social Icon Submited Successfully']);
		}
		return response()->redirect()->back();
	}

	public function edit(int $id=0)
	{
		if (!$id) exit('404 not found');

		return response()->view('social.edit', [
			'social' => $this->model->find($id),
		]);
	}

	public function update(int $id=0)
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['id', 'name', 'link', 'icon'])
				->validated();
		} catch (\Bhitti\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$updated = $this->model->where('id', $data['id'])->update($data);

		if ($updated) {
		    return response()->redirect()->with(['success' => 'Social Icon Updated Successfully'])->back();
		}
		return response()->redirect()->back();
	}

	public function delete(int $id=0)
	{
		$social = $this->model->find($id);
		if (!$social) exit('404 not found');

		$delete = $this->model->where('id', $id)->delete();
		if ($delete) {
		    return response()->redirect('/socials')->with(['success' => 'Social Icon Deleted Successfully']);
		}
		return response()->redirect('/socials');
	}
}
