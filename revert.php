<?php
	// 将垃圾筒配方回收
function revert($recipeId){
	require_once("recipe.php");
	
		$r=new recipe;
		$r->__set(id,$recipeId);
		$r->switchDel("deleted=0");
		$r=null;
		echo "<script>alert('还原成功！');location.href='index.php'</script>";
}
?>