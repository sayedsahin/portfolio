<?php
namespace App\Controllers;

use App\Middlewares\Authenticated;
use Bhitti\Http\Middleware\Attributes\Middleware;

#[Middleware(Authenticated::class)]
class ImageController extends Controller
{

	public function store()
	{
	    $request = request();
		$id = db()->table('projects')->find($request->input('id'));

		if (!$id) {
		    exit('404 not found');
		}

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
					return response()->redirect()->with(['error' => "There was an error uploading your image !"])->back();
				} elseif (in_array($file_ext, $permited) === false) {
					return response()->redirect()->with(['error' => "You can upload only: ".implode(', ', $permited)." !"])->back();
				} elseif ($file_size > 1048576*3) {
					return response()->redirect()->with(['error' => "Image size should be less then 3MB !"])->back();
				}

				$image = 'assets/img/portfolio/'.$uniqid.'.'.$file_ext;

				if (move_uploaded_file($file_temp, $image)) {
					$response = db()->table('project_image')->insert([
						'project_id' => $id->id,
						'image' => $image
					]);
				}
			}
		}

		if ($response) {
			return response()->redirect()->with(['success' => 'Image Added Successfully'])->back();
		} else {
			return response()->redirect()->with(['error' => 'Image Uploaded Faild !'])->back();
		}
	}

	public function delete($id=0)
	{
		$image = db()->table('project_image')->find($id);
		if (!$image) {
		    exit('404 not found');
		}

		$delete = db()->table('project_image')->where('id', $image->id)->delete();
		if ($delete) {
			if (file_exists($image->image)) {
				unlink($image->image);
			}
		}
		return response()->redirect()->with(['success' => 'Image Deleted Successfully'])->back();
	}

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
