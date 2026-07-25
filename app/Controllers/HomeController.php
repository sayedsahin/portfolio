<?php 
namespace App\Controllers;

use App\Middlewares\Authenticated;
use App\Validation\Validator;
use App\Models\Home;

class HomeController extends Controller
{
	function __construct()
	{
		// $this->middleware(Authenticated::class);
	}

	public function index()
	{
		$data = $this->homeData();
		$data['user'] = Home::query()->user();
		return view('index', $data);
	}

	public function project(int $id)
	{
		$data = $this->homeData();
		return view('project.show', $data);
	}

	public function contact()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['name', 'email', 'body'])
				->email('email')
				->validated();
		} catch (\App\Validation\ValidationException $e) {
			return response()->redirect('/#submitMessage')->with(['errors' => $e->errors()]);
		}
		
		$data['phone'] = $request->input('phone') ?? '';
		$inserted = db()->table('messages')->insert($data);

		if ($inserted) {
		    return response()->redirect('/#submitMessage')->with(['success' => 'email has been sent']);
		}
		return response()->redirect('/#submitMessage')->with(['error' => 'email not sent']);
	}

	private function homeData() : array
	{
		$data['projects'] = Home::query()->project();
		$data['about'] = Home::query()->about();
		$data['socials'] = Home::query()->social();
		$data['site'] = Home::query()->table('sites')->find(1);
		return $data;
	}
}