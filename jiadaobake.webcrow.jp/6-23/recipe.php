<?php
/*
 * Created on 2014-5-23
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
	require("class_database.php");
	class recipe
	{
		// 属性
		private $id;					// 配方id
		private $name;					// 配方名称
		private $instructions;			// 制作说明
		private $temperatureU;			// 上火
		private $temperatureD;			// 下火
		private $cooktime;				// 烘烤时间

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

 		// add : 把配方对象写入数据库
 		function add(){
 			$db = new database;
 			$sql = "INSERT INTO recipes (name,instructions,temperatureU,temperatureD,cooktime) ";
 			$sql.= "VALUES ('$this->name','$this->instructions','$this->temperatureU','$this->temperatureD','$this->cooktime')";
 			// var_dump($this->name);			// 调试
 			// echo $this->name."<br />";	    // 调试
 			// echo $sql."<br />";				// 调试
 			// exit;							// 调试
			$db->execute($sql);
 			$db=NULL;
 		}



 		// delete : 从数据库删除对象
 		function delete(){
 			$db = new database;
 			$sql = "DELETE FROM recipes ";
 			$sql .= "WHERE id=$this->id";
 			// echo $sql;				// 调试
 			$db->execute($sql);
 			$db=NULL;
 		}

 		// update : 修改配方信息
 		function update(){
 			$db=new database;
 			$sql= "UPDATE recipes SET ";
 			$sql.="instructions='$this->instructions',temperatureU=$this->temperatureU,temperatureD=$this->temperatureD,cooktime=$this->cooktime ";
 			$sql.="where id =$this->id";
 			$db->execute($sql);
 			$db=null;
 		}

 		// query
 		static function query($condition){
 			if (($condition=="") || ($condition==NULL)) $condition="";
 			else $condition="where ".$condition;
 			$db= new database;
 			$sql = "SELECT *FROM recipes ".$condition;
 			// echo $sql;								// 调试
 			$arr_recipes=$db->query($sql);
 			return $arr_recipes;
 			$db=NULL;
 		}

 		// queryID
 		function queryId(){
 			$db=new database;
 			$sql= "SELECT id FROM recipes WHERE name='$this->name'";
 			// echo $sql;
 			$row=$db->executeSFOR($sql);
 			return $row->id;
 			$db=null;
 		}

 		// queryName
 		function queryRI($condition){
 			$db=new database;
 			$sql="SELECT *FROM recipes WHERE id=$this->id";
 			// echo $sql."<br>";
 			$row=$db->executeSFOR($sql);
 			return $row->$condition;
 			$db=null;
 		}

 		// generate : 生成子配方
 		function generate($requireSum){
 			$baseIngre=$requireSum/$this->perSum;		// 根据配料总量除以烘焙百分比总量得到烘焙百分比参照量；例如：面粉，鸡蛋等
 			$newMetric=$baseIngre*$this->percent;		// 然后根据烘焙百分比算出其余原料新的用量
 		}
	}

	// 原料类，
	class ingre
	{
		// 属性
		//
		private $name;					// 原料名称
		private $recipeName;			// 配方名称
		private $recipeId;					// 配方id
		private $metric;				// 用量
		private $percent;				// 百分比
		private $sum;					// 原料总量
		private $perSum;				// 百分比总量
		private $requireSum;

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

 		 // add : 把原料信息写入原料表
 		 function add(){
 			$db = new database;
		 	$sql = "INSERT INTO ingres(name,recipeName,recipeId,metric,percent,sum,perSum) ";
			$sql.= "VALUES ('$this->name','$this->recipeName','$this->recipeId','$this->metric','$this->percent','$this->sum','$this->perSum')";
 			$db->execute($sql);
 			$db=NULL;
 		}
 		function addreq(){
 			$db = new database;
		 	$sql = "INSERT INTO ingres(name,recipeName,recipeId,metric,percent,sum,perSum,requireSum) ";
			$sql.= "VALUES ('$this->name','$this->recipeName',$this->recipeId,$this->metric,$this->percent,0,$this->perSum,$this->requireSum)";
 			$db->execute($sql);
 			$db=NULL;
 		}

 		 	// delete : 从数据库删除对象
 		function delete(){
 			$db = new database;
 			$sql = "DELETE FROM ingres ";
 			$sql .= "WHERE recipeId=$this->recipeId";
 			$db->execute($sql);
 			$db=NULL;
 		}

 		//
 		function deleteRR(){
 			$db = new database;
 			$sql = "DELETE FROM ingres ";
 			$sql.= "WHERE recipeId=$this->recipeId and requireSum=$this->requireSum";
 			$db->execute($sql);
 			$db=NULL;
 		}
 		 		// query
 		static function query($condition){
 			if (($condition=="") || ($condition==NULL)) $condition="";
 			else $condition="where ".$condition;
 			$db= new database;
 			$sql = "SELECT *FROM ingres ".$condition;
 			// echo $sql;								// 调试
 			// exit;
 			$arr_ingres=$db->query($sql);
 			return $arr_ingres;
 			$db=NULL;
 		}

 		 		 		// query condition is recipeId
 		function queryRID(){
 			$db= new database;
 			$sql = "SELECT *FROM ingres WHERE recipeId=$this->recipeId and sum>0";
 			// echo $sql;								// 调试
 			// exit;
 			$arr_ingres=$db->query($sql);
 			return $arr_ingres;
 			$db=NULL;
 		}

 		 // 查询相关配方的保存的需求产量
 		function queryReq(){
 			$db= new database;
 			$sql = "SELECT requireSum FROM ingres where recipeId=$this->recipeId and requireSum>0 GROUP BY requireSum";
 			// echo $sql;								// 调试
 			// exit;
 			$arr_ingres=$db->query($sql);
 			return $arr_ingres;
 			$db=NULL;
 		}

 		 // query
 		function queryReqIngres($req){
 			$db= new database;
 			$sql = "SELECT *FROM ingres where recipeId=$this->recipeId and requireSum=".$req." and sum =0";
 			// echo $sql;								// 调试
 			// exit;
 			$arr_ingres=$db->query($sql);
 			return $arr_ingres;
 			$db=NULL;
 		}

	}

	// // 新原料类
	// class reqIngre extends ingre
	// {
	// 	private $requireSum;

	// 	// 方法
	// 	// __get(): 获取属性值
 // 		function __get($property_name){
 // 			if (isset($property_name)){
 // 				return $this->$property_name;		// 这里的 property_name 前必须加 $
 // 			}else{
 // 				return null;
 // 			}

 // 		}

 // 		// __set(): 设置属性值
 // 		function __set($property_name, $value){
 // 			parent::__set($property_name, $value);
 // 			$this->$property_name=$value;			// 这里的 property_name 前必须加 $
 // 		}
	// 	// 重载父类的方法，向数据库增加一条原料信息
	// 	function add(){
	// 		$db = new database;
	// 	 	$sql = "INSERT INTO ingres(name,recipeName,metric,percent,sum,perSum,requireSum) ";
	// 		$sql.= "VALUES ('parent::ingreName','parent::name','parent::metric','parent::percent','parent::sum','parent::perSum','$this->requireSum'";
 // 			$db->execute($sql);
 // 			$db=NULL;
	// 	}
	// }

?>
