<?php

	spl_autoload_register(function($class){
		include_once 'app/'.$class.'.php';
	});

	include_once 'app/config/config.php';
	include_once 'app/system/Utility.php';

	$main = new System\Core(); 
?>