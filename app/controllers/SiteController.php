<?php 
namespace Controllers;

use Libraries\Form;
use Models\Site;
use Systems\Controller;
use Systems\Session;

class SiteController extends Controller
{
	protected object $model;

	function __construct()
	{
		$this->model = new Site;
		Session::init();
		Session::auth();
		$data = [];
	}

	public function edit()
	{
		return view('site/edit', [
			'site' => $this->model->find(1),
		]);
	}

	public function update()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('title')->required()->length(0, 255);
		$valid->post('tagline')->length(0, 255);
		$valid->post('location')->length(0, 255);
		$valid->post('copyright')->length(0, 255);
		$valid->post('description')->length(0, 5000);
		$valid->post('credit')->length(0, 1000);

		$valid->values['copyright'] = $_POST['copyright'];

		$valid->submit() ?: redirect()->back()->with(['errors' => $valid->errors]);

		$update = $this->model->where('id', 1)
			->update($valid->values);
		!$update ?: redirect()->back()->with(['success' => 'site information updated successfully']);
	}
}