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
		$data['projects'] = Home::query()->projects();
		$data['user'] = Home::query()->user();

        $captcha = $this->generateCaptcha('send_message');
        $data['captchaQuestion'] = $captcha['question'];

		return view('home', $data);
	}

	public function project(int $id)
	{
		$data = $this->homeData();
		$data['project'] = Home::query()->project($id);
		$data['images'] = db()->table('project_image')->where('project_id', $id)->get();
		return view('project.show', $data);
	}

	public function contact()
	{
		$request = request();
		try {
			$validated = Validator::make($request->all())
				->required(['name', 'email', 'body', 'captcha_answer'])
                ->int('captcha_answer')
				->email('email')
				->validated();
		} catch (\App\Validation\ValidationException $e) {
			return response()->redirect('/#submitMessage')->with(['errors' => $e->errors()]);
		}

        if (! $this->validateCaptcha('send_message', $validated['captcha_answer'])) {
                return response()->redirect('/#submitMessage')->with(['error' => 'Incorrect answer. Please try again.']);
        }

        unset($validated['captcha_answer']);

		$validated['phone'] = $request->input('phone') ?? '';
		$inserted = db()->table('messages')->insert($validated);

		if ($inserted) {
		    return response()->redirect('/#submitMessage')->with(['success' => 'email has been sent']);
		}
		return response()->redirect('/#submitMessage')->with(['error' => 'email not sent']);
	}

	private function homeData() : array
	{
		$data['about'] = Home::query()->about();
		$data['socials'] = Home::query()->social();
		$data['site'] = Home::query()->table('sites')->find(1);
		return $data;
	}

    protected function generateCaptcha(string $context): array {
        $min = 1;
        $max = 10;

        $num1 = rand($min, $max);
        $num2 = rand($min, $max);

        // Randomly choose addition or subtraction
        $isAddition = (bool) rand(0, 1);

        if ($isAddition) {
            $question = "$num1 + $num2 = ?";
            $answer = $num1 + $num2;
        } else {
            // Ensure first number is larger for positive result
            if ($num1 < $num2) {
                [$num1, $num2] = [$num2, $num1];
            }
            $question = "$num1 - $num2 = ?";
            $answer = $num1 - $num2;
        }

        // Store answer in session
        session()->set("captcha_{$context}", $answer);

        return [
            'question' => $question,
            'answer' => $answer,
        ];
    }

    protected function validateCaptcha(string $context, int $answer): bool {
        $expected = session()->get("captcha_{$context}");

        if ($expected === null) {
            return false;
        }

        // Clear the captcha from session after validation
        session()->forget("captcha_{$context}");

        return $answer === (int) $expected;
    }
}
