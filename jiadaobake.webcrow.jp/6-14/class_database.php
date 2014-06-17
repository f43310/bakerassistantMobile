<?php
/*
 * Created on 2014-5-23
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 	require_once("sys_conf.inc");			// 包含系统配置文件
 	class database{
 		// 属性
 		private $host;				// 服务器名
 		private $user;				// 用户名
 		private $pwd;				// 密码
 		private $name;				// 数据库名
 		private $connection; 		// 连接标识

 		// 方法
 		// __get(): 获取属性值
 		function __get($property_name){
 			if (isset($property_name)){
 				return $this->property_name;
 			}else{
 				return null;
 			}

 		}

 		// __set(): 设置属性值
 		function __set($property_name, $value){
 			$this->property_name=$value;

 		}

 		// __construct: 构造函数，建立连接
 		function __construct(){
 			$this->host=sys_conf::$DBHOST;
 			$this->user=sys_conf::$DBUSER;
 			$this->pwd=sys_conf::$DBPWD;
 			$this->name=sys_conf::$DBNAME;

 			$this->connection=mysql_connect($this->host, $this->user, $this->pwd);	// 连接数据库
 			mysql_select_db($this->name, $this->connection);						// 选择数据库
 			mysql_query("set names utf8");											//选择数据库编码，这句很重要!!!utf8不能写成utf-8否则会出现乱码
 		}

 		// __destruct: 析构函数，断开连接
 		function __destruct(){
 			mysql_close($this->connection);
 		}

 		// 增删改：参数$sql 为 insert 语句
 		function execute($sql){
 			mysql_query($sql);
 		}// execute

 		 // 查：参数$sql 为 select 语句 结果为单条
 		function executeSFOR($sql){
 			$oneResult=mysql_query($sql, $this->connection);
 			return mysql_fetch_object($oneResult);
 		}// execute

 		// 查： 参数 $sql 为 insert 语句
 		// 返回值为对象数组，数组中的每一个元素为一行记录构成的对象
 		function query($sql){
 			$result_array=array();							// 返回数组
 			$i=0;												// 数组下标
 			$query_result=mysql_query($sql, $this->connection);	// 查询数据
 			while($row=mysql_fetch_object($query_result)){
 				$result_array[$i++]=$row;
 			}//while
 			return $result_array;
 		}// query
 	}// class database
?>
