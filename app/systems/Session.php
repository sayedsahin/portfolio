<?php
namespace Systems;
class Session{
	public static function init(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}
	 
	public static function set($key, $val)
	{
		$_SESSION[$key] = $val;
	}

	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}
	public static function auth()
	{
		self::init();
		if (self::get("login") == false) {
			self::destroy();
			if (!isset($_GET['ajax'])) {
				header("Location:".BASE_URL."/account/login");
			}else{
				echo "login";
			}
			exit();
		}
	}
	public static function guest()
	{
		self::init();
		if (self::get("login") == true) {
			header("Location:".BASE_URL);
			exit();
		}
	}
	public static function isAdmin()
	{
		self::init();
		if (self::get("level") != 1) {
			header("Location:".BASE_URL."/Admin");
			exit();
		}
	}
	public static function isAdminEditor()
	{
		self::init();
		if (self::get("level") != 1 && self::get("level") != 2) {
			header("Location:".BASE_URL."/Admin");
			exit();
		}
	}
	public static function destroy()
	{
		session_destroy();
	}
	public static function parameterNull($id)
	{
		if ($id == NULL) {
			header("Location:".BASE_URL);
			exit();
		}
	}
	public static function userAccess($id, $cond_name, $table, $db)
	{
		$cond = [
			'select' => 'user_id',
			'where' => [$cond_name => $id],
			'type'	=> 'single',
			'limit' => '1'
		];
		$getuserid = $db->select($table, $cond);
		$user_id = $getuserid['user_id'];
		if (self::get('userId') != $user_id && self::get('level') != 5) {
			header("Location:".BASE_URL);
			exit();
		}
	}
}
?>