<?php

//include connection file 
include_once("connect/db_cls_connect.php");
//require('recaptcha/src/autoload.php');
$db = new dbObj();
$connString =  $db->getConnstring();
 
$params = $_REQUEST;
$action = $params['action'] !='' ? $params['action'] : '';
$empCls = new Employee($connString);
 
switch($action) {
 case 'register':
	$empCls->register();
 break;
 default:
 return;
 class Employee {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	function register() {
		if(isset($_POST['register_button'])) {
			if (!isset($_POST['g-recaptcha-response'])) {
				throw new \Exception('ReCaptcha is not set.');
			}
			
			$recaptcha_secret_key = 'your secret key';
			$recaptcha = new \ReCaptcha\ReCaptcha($recaptcha_secret_key, new \ReCaptcha\RequestMethod\CurlPost());
			$response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
			if (!$response->isSuccess()) {
				throw new \Exception('ReCaptcha was not validated.');
			}
			
			$user_email = mysqli_real_escape_string($this->conn, trim($_POST['email']));
			$f_name = mysqli_real_escape_string($this->conn, trim($_POST['f_name']));
			$l_name = mysqli_real_escape_string($this->conn, trim($_POST['l_name']));
			$user_password = mysqli_real_escape_string($this->conn, trim($_POST['password']));
			$user_name= $f_name. ' '.$l_name;
			$sql = "INSERT INTO `tbl_users` (`user`, `password`, `email`, `profile_photo`, `active`) VALUES
					('".$user_name."', '".$user_password."', '".$user_email."', NULL, 1);";
			$resultset = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
			//$row = mysqli_fetch_assoc($resultset);
			if($resultset){
				echo "1";
			} else {
				echo "Ohhh ! Something Wrong."; // wrong details
			}
		}
	}
}
}
?>