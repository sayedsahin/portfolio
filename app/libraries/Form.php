<?php 
namespace Libraries;

use Systems\Session;

class Form
{
	public $currentValue;
	public $values = [];
	public $errors = [];

	public function post($key)
	{
		$this->values[$key] = trim(stripcslashes(htmlspecialchars($_POST[$key])));
		$this->currentValue = $key;
		return $this;
	}
	public function get($key)
	{
		$this->values[$key] = trim(stripcslashes(htmlspecialchars($_GET[$key])));
		$this->currentValue = $key;
		return $this;
	}
	public function isEmpty()
	{
		if (empty($this->values[$this->currentValue])) {
			$this->errors[$this->currentValue] = "Filled must not be empty !";
		}
		return $this;
	}
	public function isCatEmpty()
	{
		if ($this->values[$this->currentValue] == 0) {
			$this->errors[$this->currentValue] = "Filled must not be empty !";
		}
		return $this;
	}
	public function length($min = 0, $max = 100)
	{
		if (strlen($this->values[$this->currentValue]) < $min OR strlen($this->values[$this->currentValue]) > $max) {
			$this->errors[$this->currentValue] = "Min ".$min." and max ".$max." characters ! ";
		}
		return $this;
	}
	public function length_utf8($min = 0, $max = 100)
	{
		if (mb_strlen($this->values[$this->currentValue]) < $min OR mb_strlen($this->values[$this->currentValue]) > $max) {
			$this->errors[$this->currentValue] = "Min ".$min." and max ".$max." characters ! ";
		}
		return $this;
	}
	public function validEmail()
	{
		if (!filter_var($this->values[$this->currentValue], FILTER_VALIDATE_EMAIL)) {
			$this->errors[$this->currentValue] = "This email is not valid !";
		}
		return $this;
	}
	public function pregMatch()
	{
		if (preg_match('/[^a-z0-9_-]+/i', $this->values[$this->currentValue])) {
			$this->errors[$this->currentValue] = "Only use A-Z a-z 0-9 _ - ";
		}
		return $this;
	}
	public function submit()
	{
		if (empty($this->errors)) {
			return true;
		}else{
			return false;
		}
	}
	//Extra Function
	public function check($db, $table, $key, $value)
	{
		$data = [
			'where' => [$key => $value],
			'type'  => 'count'
		];
		$count = $db->select($table, $data);
		if ($count > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function msg($msg, $link='')
	{
		$fullmsg = "";
		if (is_array($msg)) { 
			$fullmsg .= '<p class="alert alert-danger d-inline-block">';
			foreach ($msg as $key => $value) {
                $fullmsg .= "* ".$value." (".$key.")<br>";
            }
            $fullmsg .= '</p>';
		}else{
			$color = (strpos($msg, '!') != false) ? 'danger' : 'success' ;
			$fullmsg .= '<p class="alert alert-'.$color.' d-inline-block">'.$msg.'</p>';
		}

		// if (isset($_POST['ajax']) || isset($_GET['ajax'])) {
		if (isAjax()) {
			echo $fullmsg;
		}else{
			Session::set("msg", $fullmsg);
			if (!empty($link)) {
				header("Location: ".BASE_URL.$link);
			}else{
				$this->back();
			}
		}
	}
	public function back()
	{
		if (isset($_SERVER['HTTP_REFERER'])) {
			$url = $_SERVER['HTTP_REFERER'];
			$host = parse_url($url, PHP_URL_HOST);
			$base = parse_url(BASE_URL, PHP_URL_HOST);
			if ($host == $base) {
				Session::set("link", $url);
			}else{
				Session::set("link", BASE_URL);
			}
	         
	    }else{
	    	Session::set("link", BASE_URL); 
	    }
	    header("Location:".Session::get("link"));
	}
}

?>