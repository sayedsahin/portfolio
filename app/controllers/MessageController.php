<?php 
namespace App\Controllers;

use App\Validation\Validator;
use App\Models\Message;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Systems\Session\Session;
use App\Middlewares\Authenticated;

class MessageController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->middleware(Authenticated::class);
	}

	public function index()
	{
		$messages = Message::query()->limit(100, 0)->order('id DESC')->get();
		// dd($messages);
		return view('message.index', [
			'messages' => $messages,
		]);
	}

	public function show($id=0)
	{
		// helper(['time', 'message', 'text']);
		$data['message'] = Message::query()->find($id);
		$data['replies'] = Message::query()->table('replies')
			->where('message_id', $id)
			->get();
	    return view('message.show', $data);
	}

	public function reply()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['message_id', 'body', 'name', 'email'])
				->email('email')
				->validated();
		} catch (\App\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}
		
		$data['subject'] = $request->input('subject') ?? '';

		$inserted = Message::query()->table('replies')->insert([
			'message_id' => $data['message_id'],
			'body' => $data['body']
		]);
		
		if ($inserted) {
		    $this->email($data);
		    Session::set('message', ['success' => 'Reply Has Been Sent']);
		}
		
		return response()->redirect('/messages/'.$data['message_id']);
	}

	public function delete(int $id=0)
	{
		$message = Message::query()->find($id);
		if (!$message) exit('404 not found');

		$delete = Message::query()->where('id', $id)->delete();
		if ($delete) {
		    return response()->redirect('/messages')->with(['success' => 'message has been deleted']);
		}
		return response()->redirect('/messages');
	}

	public function new()
	{
		// helper(['message']);
	    return view('message.new');
	}

	public function sendMessage()
	{
		$request = request();
		try {
			$data = Validator::make($request->all())
				->required(['email', 'subject', 'body'])
				->email('email')
				->validated();
		} catch (\App\Validation\ValidationException $e) {
			return response()->redirect()->with(['errors' => $e->errors()])->back();
		}

		$data['name'] = strstr($data['email'], '@', true);

		$emailSent = $this->email($data);

		if ($emailSent) {
		    Session::set('message', ['success' => 'Mail Has Been Sent']);
		}
		return response()->redirect('/messages/new');
	}

	public function email(array $data)
	{
		$mail = new PHPMailer(true);
		$mail->CharSet = "UTF-8";

		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host       = 'smtp.mailtrap.io';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'e48e72cf893080';
			$mail->Password   = '0d90a2ccaadc2d';
			$mail->Port       = 2525;

			$mail->setFrom('sahin.sayed1@gmail.com', 'Mailer');
			$mail->addAddress($data['email'], $data['name']);

			$mail->isHTML(true);
			$mail->Subject = $data['subject'];

			ob_start();
			view('email.leemunroe', ['email' => $data]);
			$body = ob_get_clean();

			$mail->Body    = $body;
			$mail->AltBody = $data['body'];

			$mail->send();

			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
	}
}