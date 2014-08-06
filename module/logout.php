<?php
if(!defined('ROOT_PATH')){
	header("HTTP/1.0 404 Not Found");
	exit;
}


func_need_login();
$token = isset($_GET['token'])?$_GET['token']:null;
if(func_verify_token($token)){
	$user = new User('', '');
	$user->logout();
	unset($user);
	func_gohome();
}else{
	echo "没有权限!";
}
