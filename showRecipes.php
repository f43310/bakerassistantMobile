<?php
	function showRecipes(){
		require_once("recipe.php");
		$r=new recipe;
		$cond="";
		$all_recipes=$r::query($cond);

		print("<a href=\"index.php?action=addNew\">添加配方</a>");
		print("<ul data-role=\"listview\" data-filter=\"true\">");
		foreach ($all_recipes as $item) {
			print("<li><a href=\"#\">$item->name</a></li>");
		}
		print("</ul>");
		$r=null;
	}
?>
