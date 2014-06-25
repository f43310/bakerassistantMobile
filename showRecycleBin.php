<?php
session_start();
function showRecycleBin(){
		require_once("recipe.php");
		$r=new recipe;
		$cond="deleted=1";
		$all_recipes=$r::query($cond);
		$_SESSION["deleted"]=1;
		// echo $_SESSION["deleted"];
		// print("<a href=\"index.php?action=addNew\" data-ajax=\"false\">添加配方</a>");
		print("<ul data-role=\"listview\" data-filter=\"true\">");
		foreach ($all_recipes as $item) {
			print("<li><a href=\"index.php?action=showDetail&id=".$item->id."\" data-ajax=\"false\">$item->name</a><a href='index.php?action=revert&id=".$item->id."' data-icon='back'>还原</a></li>");
		}
		print("</ul>");
		$r=null;
}
?>