<?php
if(!defined('ROOT_PATH')){
	header("HTTP/1.0 404 Not Found");
	exit;
}


func_need_login();	/**< 判断用户是否已登录 */
func_need_admin();	/**< 判断用户是否有管理权限 */
$token = isset($_GET['token'])?$_GET['token']:null;
if(func_verify_token($token)){	/**< 验证token */
	if(!isset($_GET['uid'])){
		echo "没有用户id";
		exit;
	}else{
		$user = new User('', '');
		if(!($user->isExistU($user->getUsernameU($_GET['uid'])))){
			echo "用户不存在!";
			exit;
		}
		$username = $user->getUsernameU($_GET['uid']);
		unset($user);
		$user = new User($username,'');
		if($user->delete()){
			echo "删除成功!";
		}else{
			echo "删除失败!";
		}
		unset($user);
	}
}else{
	echo "没有权限!";
}
