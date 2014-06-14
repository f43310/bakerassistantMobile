<?php
	
	//

	function showSonRecipes(){
			require_once("recipe.php");
			$r=new recipe;
			$r->__set(id, $_REQUEST[id]);
			$recipeName=$r->queryRI(name);
			// echo $recipeName;
			$r=null;

			print("<h1>配方 $recipeName 所有产量列表</h1>");
			print("<ul data-role='listview' data-inset='true'>");
			$ingre=new ingre;
			$ingre->__set(recipeId,$_REQUEST[id]);
			$all_reqs = $ingre->queryReq();
			$ingre=null;
			foreach ($all_reqs as $item) {
				print("<li><a href='index.php?action=showReqDetail&id=".$_REQUEST[id]."&reqSum=".$item->requireSum."'>$item->requireSum</a></li>");
			}
	
			print("</ul>");
	}
?>