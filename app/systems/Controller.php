<?php 
namespace Systems;

class Controller
{
	protected object $load;
	function __construct()
	{
		$this->load = new Load();
	}
}
?>