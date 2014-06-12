<?php
	require_once("recipe.php");
	//

	function showSonRecipes(){
			print("<h4>$_REQUEST[recipeName]</h4>");
			print("<ul data-role='listview' data-inset='true'>");
			$ingre=new ingre;
			$ingre->__set(recipeId,$_REQUEST[recipeId]);
			$all_reqs = $ingre->queryReq();
			$ingre=null;
			foreach ($all_reqs as $item) {
				print("<li><a href='index.php?action=showReqDetail&id=".$_REQUEST[recipeId]."&reqSum=".$item->requireSum."'>$item->requireSum</a></li>");
			}
	
			print("</ul>");
	}
?>