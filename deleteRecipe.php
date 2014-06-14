<?php
function deleteR($recipeId){
	require_once("recipe.php");
	if ($recipeId=="") {
		echo "请选择要删除的配方！<br />";
	}
	else{
		$r=new recipe;
		$r->__set(id,$recipeId);
		$r->delete();
		// echo "配方表删除成功!<br />";
		$r=null;

		$ingre=new ingre;
		$ingre->__set(recipeId,$recipeId);
		$ingre->delete();
		
		$ingre=null;
		echo "<script>alert('删除成功！');location.href='index.php'</script>";
	}
}
?>