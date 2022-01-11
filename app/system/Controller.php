<?php 
namespace System;

class Controller
{
	protected object $load;
	function __construct()
	{
		$this->load = new Load();
	}
}
?>