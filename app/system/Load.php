<?php 
namespace System;
class Load
{
	
	function __construct()
	{
		
	}
	public function view($fileName, $data = false)
	{
		if ($data == true) {
			extract($data);
		}
		include 'app/views/'.$fileName.'.php';
	}
	public function model($model)
	{
		$loadModel = 'Models\\'.$model;
		return new $loadModel();
	}
	public function validation($fileName)
	{
		$load = 'Libraries\\'.$fileName;
		return new $load();
	}
}
?>