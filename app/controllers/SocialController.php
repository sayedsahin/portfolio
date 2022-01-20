<?php 
namespace Controllers;

use Systems\Controller;
use Libraries\Form;
use Models\Social;
use Systems\Session;

class SocialController extends Controller
{
	protected object $model;
	function __construct()
	{
		parent::__construct();
		$this->model = new Social;
		Session::init();
		$data = [];
	}

	public function index()
	{
		return view('social/index', [
			'socials' => $this->model->get(),
		]);
	}

	public function create()
	{
		return view('social/create');
	}

	public function store()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('name')->required()->length(1, 50);
		$valid->post('link')->required()->length(13, 50);
		$valid->post('icon')->required()->length(10, 10000);
		$valid->values['icon'] = $_POST['icon'];

		if ($valid->submit()) {
			$id = $this->model->insert($valid->values, 'id');
			!$id ?: redirect('/social')->with(['success' => 'Social Icon Submited Successfully']);
		}else {
			redirect()->back()->with(['errors' => $valid->errors]);
		}
	}

	public function edit(int $id=0)
	{
		$id ?: exit('404 not found') ;

		return view('social/edit', [
			'social' => $this->model->find($id),
		]);
	}

	public function update()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('id')->required()->length(1, 10);
		$valid->post('name')->required()->length(1, 50);
		$valid->post('link')->required()->length(13, 50);
		$valid->post('icon')->required()->length(10, 10000);
		$valid->values['icon'] = $_POST['icon'];

		if ($valid->submit()) {
			$id = $this->model->where('id', $valid->values['id'])
				->update($valid->values);

			!$id ?: redirect()->back()->with(['success' => 'Social Icon Updated Successfully']);
		}else {
			redirect()->back()->with(['errors' => $valid->errors]);
		}
	}

	public function delete(int $id=0)
	{
		$social = $this->model->find($id);
		$social ?: exit('404 not found') ;

		$delete = $this->model->delete($id);
		!$delete ?: redirect('/social')->with(['success' => 'Social Icon Deleted Successfully']);
	}
}