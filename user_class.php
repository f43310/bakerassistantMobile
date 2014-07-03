<?php
	require_once("class_database.php");

	class user
	{
		private $user_id;
		private $username;
		private $password;

		// 方法
		// __get(): 获取属性值
 		function __get($property_name){
 			if (isset($property_name)){
 				return $this->$property_name;		// 这里的 property_name 前必须加 $
 			}else{
 				return null;
 			}

 		}

 		// __set(): 设置属性值
 		function __set($property_name, $value){
 			$this->$property_name=$value;			// 这里的 property_name 前必须加 $
 		}

 		// __construct : 构造函数
 		function __construct(){

 		}

 		// __destruct : 析构函数
 		function __destruct(){

 		}

 		function queryRows(){
 			$sql="SELECT username,password FROM user ";
 			$sql.="where username='$this->username'";
 			// echo $sql;
 			$db=new database;
 			$rows=$db->queryRows($sql);
 			$db=mull;
 			return $rows;
 		}

 		function query(){
 			$sql="SELECT username,password FROM user ";
 			$sql.="where username='$this->username'";
 			$db=new database;
 			$user=$db->query($sql);
 			$db=null;
 			return $user;
 		}

 		function queryId(){
 			$sql="SELECT user_id FROM user ";
 			$sql.="where username='$this->username'";
 			$db=new database;
 			$user_id=$db->executeSFOR($sql);
 			$db=null;
 			return $user_id->user_id;

 		}

 		function add(){
 			$sql="INSERT INTO user (username,password)";
 			$sql.=" VALUES('$this->username','$this->password')";
 			echo $sql;
 			$db=new database;
 			$db->execute($sql);
 			$db=null;
 		}
	}
?>