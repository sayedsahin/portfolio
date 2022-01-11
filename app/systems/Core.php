<?php 

namespace Systems;

class Core
{
	public string|array $url;
	public string $controller = "HomeController";
	public string $method = "index";
	public string $path = "app/controllers/";
	public object $ctlr;
	function __construct()
	{

		$this->getUrl();
		$this->loadController();
		$this->loadMethod();
	}
	public function getUrl()
	{
		if (isset($_GET['url'])) {
			$this->url = $_GET['url'];
			$this->url = rtrim($this->url, '/');
			$this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL));
		}else{
			unset($this->url);
		}
	}
	public function loadController()
	{
		if (!isset($this->url[0])) {
			$this->ctlr = new \Controllers\Homecontroller();
		}else{
			$this->controller = ucwords($this->url[0]).'Controller';
			$file = $this->path.$this->controller.'.php';
			if (file_exists($file)) {
				$ctr = 'Controllers\\'.$this->controller;
				$this->ctlr = new $ctr();
			}else{
				header("Location: ".BASE_URL);
			}
		}
	}
	public function loadMethod()
	{
		if(isset($this->url[3])){
			$this->method = $this->url[1]; //old $a
			if (method_exists($this->ctlr, $this->method)) {
				$this->ctlr->{$this->method}($this->url[2], $this->url[3]);
			}else{
				header("Location: ".BASE_URL);
			}
		}elseif (isset($this->url[2])) {
			$this->method = $this->url[1]; //old $a
			if (method_exists($this->ctlr, $this->method)) {
				$this->ctlr->{$this->method}($this->url[2]);
			}else{
				header("Location: ".BASE_URL);
			}			
		}else{
			if (isset($this->url[1])) {
				$this->method = $this->url[1]; //old $a
				if (method_exists($this->ctlr, $this->method)) {
					$this->ctlr->{$this->method}();
				}else{
					header("Location: ".BASE_URL);
				}
			}else{
				if (method_exists($this->ctlr, $this->method)) {
					$this->ctlr->{$this->method}();
				}else{
					header("Location: ".BASE_URL);
				}
			}
		}
	}
}
?>