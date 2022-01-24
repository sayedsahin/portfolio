<?php 

namespace Controllers;

use Systems\Controller;
use Systems\Model;
use Systems\Session;

class ImageController extends Controller
{
	protected object $model;
	function __construct()
	{
		Session::init();
		Session::auth();
		$this->model = new Model();
	}

	public function create()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit('request error');
		$id = $this->model->select('id')->table('projects')->find($_POST['id']);
		$id ?: exit('404 not found');
		$files = $this->reArrayFiles($_FILES['images']);
		$response = [];
		foreach ($files as $file) {
			if (!empty($file['name'])) {
				$file_name = $file['name'];
				$file_size = $file['size'];
				$file_error = $file['error'];
				$file_temp = $file['tmp_name'];
				$permited = ['jpg', 'jpeg', 'png'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$uniqid = uniqid();

				if ($file_error !== 0) {
					$msg = "There was an error uploading your image !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}elseif (in_array($file_ext, $permited) === false) {
					$msg = "You can upload only: ".implode(', ', $permited)." !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}elseif ($file_size > 1048576*3) {
					$msg = "Image size should be less then 3MB !";
					redirect()->back()->with(['error' => $msg]);
					exit;
				}

				$image = 'public/assets/img/portfolio/'.$uniqid.'.'.$file_ext;

				if (move_uploaded_file($file_temp, $image)) {
					$response = $this->model->table('project_image')->insert([
						'project_id' => $id['id'],
						'image' => $image
					]);
				}
				

			}
			
		}
		if ($response) {
			redirect()->back()->with(['success' => 'Image Added Successfully']);
		}else{
			redirect()->back()->with(['error' => 'Image Uploaded Faild !']);
		}
	}

	public function delete($id=0)
	{
		$image = $this->model->table('project_image')->find($id);
		$image ?: exit('404 not found');
		$delete = $this->model->table('project_image')->delete($image['id']);
		if ($delete) {
			if (file_exists($image['image'])) {
				unlink($image['image']);
			}
		}
		redirect()->back()->with(['success' => 'Image Deleted Successfully']);
	}

	// https://www.php.net/manual/en/features.file-upload.multiple.php#53240
	public function reArrayFiles($file) {

	    $file_ary = array();
	    $file_count = count($file['name']);
	    $file_keys = array_keys($file);

	    for ($i=0; $i<$file_count; $i++) {
	        foreach ($file_keys as $key) {
	            $file_ary[$i][$key] = $file[$key][$i];
	        }
	    }

	    return $file_ary;
	}
}