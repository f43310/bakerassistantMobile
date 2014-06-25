<?php
	session_start();
	$_SESSION["username"]=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	$username_S=$_SESSION["username"];


	require_once("user_class.php");
	$user=new user;
	$user->__set(username,$username_S);
	$user->__set(password,$password);
	$rows=$user->queryRows();
	// 对于老用户
	if($rows!=0){
		$all_user=$user->query();
		foreach ($all_user as $item) {
			if ($item->password==$password){
				$_SESSION["loginSuccess"]=1;
				echo "<script>location='index.php';</script>";
			}
		}
		require("relogin.php");
	}

	// 对于新用户，将其信息写入数据库
	else{
		$user->add();
		$_SESSION["loginSuccess"]=1;
		echo "<script>location='index.php';</script>";
	}
	// $user=null;
	// if ($_REQUEST['submit']=="提  交"){
	// 	if($_REQUEST[username]=="" || $_REQUEST[password]==""){
	// 		echo "你填写的信息不完整";
	// 		return;
	// 	}else{
	// 		if ($_REQUEST[username]=="bakemaster" && $_REQUEST[password]=="H6bV^V4l"){
	// 			$_SESSION["loginSuccess"]=1;
	// 			// echo "loginSuccess: ".$_SESSION["loginSuccess"];
	// 			echo "<script>location='index.php';</script>";
	// 			return;
	// 		}else{
	// 			echo "用户名密码不正确";
	// 			return;
	// 		}
	// 	}
	// }
	
?>