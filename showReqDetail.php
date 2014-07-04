<?php
	require_once("recipe.php");
	//
	function showReqDetail(){
		$reqSum=$_REQUEST[reqSum];
		if ($reqSum==""){
			print("参数不正确");
			return;
		}
		$r=new recipe;
		$r->__set(id,$_REQUEST[id]);
		$recipeName=$r->queryRI(name);

		print("<a href='index.php?action=deleteRR&id=".$_REQUEST[id]."&reqsum=".$_REQUEST[reqSum]."'>删除此产量配方</a>");
		$r=null;

		$ingre=new ingre;
		$ingre->__set(recipeId,$_REQUEST[id]);
		$allReqIngres=$ingre->queryReqIngres($reqSum);
		print("<table id=\"tab\" data-role=\"table\" data-mode=\"reflow\" class=\"ui-body-d table-stripe my-custom-breakpoint\">
				<thead>
					<tr>
						<th colspan='2'><h1>配方 $recipeName 产量 $_REQUEST[reqSum] - 副本</h1></th>
					</tr>
					<tr>
						<th>配料</th>
						<th>用量</th>
					</tr>
				</thead>
				<tbody>

				

			");
		foreach ($allReqIngres as $item) {
			print("<tr>
						<td>$item->name</td>
						<td>$item->metric</td>
					</tr>");
		}
		print("</tbody></table>");
		
	}
?>