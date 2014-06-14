<?php
	function deleteRR($recipeId,$reqSum){
		require_once("recipe.php");
		$ingre=new ingre;
		$ingre->__set(recipeId,$recipeId);
		$ingre->__set(requireSum,$reqSum);
		$ingre->deleteRR();
		$ingre=null;
		echo "<script>alert('删除成功！');location.href='index.php?action=showSonRecipes&id=".$recipeId."'</script>";
	}
?>