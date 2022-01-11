<?php 
namespace Libraries;
use Systems\Session;

class Redirect
{
	protected string $link;
	protected array $messege = [];
	public function __construct(string $link)
	{
		Session::init();
		$this->link=$link;
	}
	public function __destruct()
	{
		$this->redirect();
	}
	public function with(array $msg)
	{
		$this->messege = $msg;
		return $this;
	}
	public function back() 
	{
		if (isset($_SERVER['HTTP_REFERER'])) {
			$url = $_SERVER['HTTP_REFERER'];
			$host = parse_url($url, PHP_URL_HOST);
			$base = parse_url(BASE_URL, PHP_URL_HOST);
			if ($host == $base) {
				$this->link = $url;
			}else{
				$this->link = BASE_URL;
			}
	         
	    }else{
	    	$this->link = BASE_URL; 
	    }
	    return $this;
	}
	public function redirect()
	{
		if (!empty($this->link)) {
			if (isAjax()) {
				foreach ($this->messege as $key => $value) {
					echo $key.' = '.$value.'<br>';
				}
			}else {
				if (!empty($this->messege)) {
					$_SESSION['messege'] = $this->messege;
				}
				header("Location: " . $this->link);
			}
			
		}else{
			foreach ($this->messege as $key => $value) {
				echo $key.' = '.$value.'<br>';
			}
		}
		exit();
	}

}
 ?>