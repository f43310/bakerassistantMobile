<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>浏览配方</title>
<script type="text/javascript">

</script>
</head>

<body>
<?php
/*
 * Created on 2014-5-27
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 include_once("recipe.php");			// 包含配方类

 // 删除配方
 $action=$_GET['action'];
 $name=$_GET['name'];
 // echo $action;				// 调试
 // echo $name;
 if ($action=="del" && $name != ""){
 	// echo "进入";				// 调试
 	$r=new recipe;
 	$r->__set(name,$name);
 	// echo $r->__get(name);				// 调试
 	$r->delete();
 	$r=null;
 	$ingr=new ingre;
 	$ingr->__set('recipeName',$name);
 	$ingr->delete();
 	$ingr=null;
 	echo "<script>location.href='".$_SERVER['PHP_SELF']."';</script>";
 }

 echo "
 	<table align=center>
 		<tr>
 			<td><a href=addNew.html>添加配方</a></td>
 			<td>
 				<form method='post' action='".$_SERVER[PHP_SELF]."' >
				 	<input type=text name=recipeName id=recipeName />
				 	<input type=submit name=submit value=\"查询配方\" />
 				</from>
 			</td>
 		</tr>
 	</table>

 	";

if ($_POST[recipeName]!="") $cond = "name='$_POST[recipeName]'";

echo "
	<table align=center border=1 width=300 cellpadding=5 cellspacing=0>
		<tr>
			<td></td>
			<td>名称</td>
			<td></td>
		</tr>
";
$r=new recipe;
$all_recipes=$r::query($cond);
$i=1;
foreach ($all_recipes as $item) {
	echo '<tr><td>'.$i.'</td><td><a href="show_ingres.php?name=', urlencode($item->name) ,'">'.$item->name.'</a></td><td><a onclick="return confirm(\'确认删除吗？\');" href="'.$_SERVER['PHP_SELF'].'?action=del&name='.$item->name.'">删除</a></td></tr>';
	$i++;
}

echo "</table>";


?>
</body>
</html>