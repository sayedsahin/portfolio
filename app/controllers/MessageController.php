<?php 
namespace Controllers;

use Libraries\Form;
use Models\Message;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\isHTML;
use Systems\Controller;
use Systems\Session;

class MessageController extends Controller
{
	protected object $model;
	function __construct()
	{
		$this->model = new Message;
		Session::init();
		Session::auth();
		$data = [];
	}

	public function index()
	{
		helper(['message', 'text', 'time']);
		return view('message/index', [
			'messages' => $this->model->limit(0, 100)->order('id DESC')->get(),
		]);

	}

	public function show($id=0)
	{
		helper(['time', 'message', 'text']);
		$data['message'] = $this->model->find($id);
		$data['replies'] = $this->model->table('replies')
			->where('message_id', $id)
			->get();
	    return view('message/show', $data);
	}

	public function reply()
	{
	    $_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('message_id')->required();
		$valid->post('body')->required();
		$valid->post('name')->required();
		$valid->post('email')->required()->email();
		$valid->post('subject');

		$valid->submit() ?: redirect()->back()->with(['errors' => $valid->errors]);

		$id = $this->model->table('replies')->insert([
			'message_id' => $valid->values['message_id'],
			'body' => $valid->values['body']
		], 'id');
		$id = !$id ?: $this->email($valid->values);

		!$id ?: Session::set('message', ['success' => 'Reply Has Been Sent']);
		exit('<script>window.location.href = "/messages/'.$valid->values['message_id'].'"</script>');
	}

	public function delete(int $id=0)
	{
		$message = $this->model->find($id);
		$message ?: exit('404 not found') ;

		$delete = $this->model->delete($id);
		!$delete ?: redirect('/messages')->with(['success' => 'message has been deleted']);
	}

	public function new()
	{
		helper(['message']);
	    return view('message/new');
	}

	public function sendMessage()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('email')->required()->email();
		$valid->post('subject')->required();
		$valid->post('body')->required();

		$valid->submit() ?: redirect()->back()->with(['errors' => $valid->errors]);
		$valid->values['name'] = strstr($valid->values['email'], '@', true);

		$email = $this->email($valid->values);

		!$email ?: Session::set('message', ['success' => 'Mail Has Been Sent']);
		exit('<script>window.location.href = "/messages/new"</script>');
	}

	public function email(array $data)
	{
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);
		$mail->CharSet = "UTF-8";

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'e48e72cf893080';                     //SMTP username
			$mail->Password   = '0d90a2ccaadc2d';                               //SMTP password
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('sahin.sayed1@gmail.com', 'Mailer');
			$mail->addAddress($data['email'], $data['name']);     //Add a recipient
			// $mail->addAddress('ellen@example.com');               //Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $data['subject'];

			ob_start();
			view('email/leemunroe', ['email' => $data]);
			$body = ob_get_clean();

			$mail->Body    = $body;
			$mail->AltBody = $data['body'];

			$mail->send();

			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}