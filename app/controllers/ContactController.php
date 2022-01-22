<?php 
namespace Controllers;

use Libraries\Form;
use Models\Contact;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\isHTML;
use Systems\Controller;
use Systems\Session;

class ContactController extends Controller
{
	protected object $model;
	function __construct()
	{
		parent::__construct();
		$this->model = new Contact;
		Session::init();
		$data = [];
	}

	public function index()
	{
		helper(['message', 'text']);
		return view('contact/index', [
			'contacts' => $this->model->limit(100)->get(),
		]);

	}

	public function store()
	{
		$_SERVER['REQUEST_METHOD'] === 'POST' ?: exit;
		$valid = new Form();
		$valid->post('name')->required()->length_utf8(0, 255);
		$valid->post('email')->required()->email()->length_utf8(0, 255);
		$valid->post('phone')->length_utf8(0, 255);
		$valid->post('message')->required();

		$valid->submit() ?: redirect('/#submitMessage')->with(['errors' => $valid->errors]);

		$id = $this->model->insert($valid->values, 'id');
		$email = !$id ?: $this->email($valid->values);

		!$email ?: Session::set('message', ['success' => 'Email Has Been Sent']);
		exit( '<script>window.location.href = "/#submitMessage"</script>');

		// !$email ?: redirect('/#submitMessage')->with(['success' => 'email has been sent']);
	}

	public function delete(int $id=0)
	{
		$message = $this->model->find($id);
		$message ?: exit('404 not found') ;

		$delete = $this->model->delete($id);
		!$delete ?: redirect('/contact')->with(['success' => 'message has been deleted']);
	}

	public function email(array $data)
	{
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

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
			$mail->Subject = 'Here is the subject';

			ob_start();
			view('email/leemunroe', ['email' => $data]);
			$body = ob_get_clean();

			$mail->Body    = $body;
			$mail->AltBody = $data['message'];

			$mail->send();

			return true;
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}