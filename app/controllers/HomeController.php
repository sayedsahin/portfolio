<?php 
namespace Controllers;

use Systems\Controller;

class HomeController extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "your website is live";
	}
}
?>