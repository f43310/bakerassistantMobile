<?php

// 添加配方名子到数据库表 recipes
//
if ($_POST['recipeName']=="" || $_POST['recipeName']==NULL) {
	echo "<font color=red>添加失败，请把信息填写完整</font><br />";
	echo "<a href=\"javascript:history.go(-1)\">重试</a>";
}else{
	$r = new recipe;
	$r->__set('name', $_POST['recipeName']);
	// echo $r->__get('name')."<br />";			// 调试
	echo $r->add();
	$r=NULL;
	echo "配方 <font color=red>$_POST[recipeName]</font> 添加成功！<br />";
}

// 添加配方原料到数据库表 ingres
//
// var_dump($_POST);		// 调试
// echo "<br />";			// 调试		
$rowsNum = (count($_POST)-4)/3;			// 通过公式计算要插入数据库原料表中的个数, "4"代表其它和原料无关的元素 "3"代表配方表的三个属性 

for ($i =0; $i < $rowsNum; $i++){
	// echo $_POST['ingre'.($i+1)];
	$ingre = new ingre;			// 建立一个配方对象
	$ingre->__set('ingreName',$_POST['ingre'.($i+1)]);
	$ingre->__set('metric',$_POST['metric'.($i+1)]);
	$ingre->__set('percent',$_POST['percent'.($i+1)]);
	$ingre->__set('name',$_POST['recipeName']);
	$ingre->__set('sum',$_POST['sum']);
	$ingre->__set('perSum',$_POST['perSum']);
	$ingre->add();
	$ingre=NULL;
	echo "原料: ".$_POST['ingre'.($i+1)]."  用量: ".$_POST['metric'.($i+1)]."  百分比: ".$_POST['percent'.($i+1)]." 添加成功！<br />";
}

echo "总量: ".$_POST['sum']." 百分比: ".$_POST['perSum']." 添加成功！<br />";
echo "<script>location.href='show_recipes.php';</script>";


?>
