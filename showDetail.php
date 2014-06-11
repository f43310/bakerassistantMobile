<?php
	require_once("recipe.php");
	// showDetail()
	function showDetail(){
		print("<form method='post' action='index.php?action=saveSonR'>");
		$r=new recipe;
		if ($_REQUEST[id] == ""){
			print("信息不完整!");
			return;
		}else{
			$r->__set(id,$_REQUEST[id]);
			$recipeName=$r->queryRI(name);
			$instruc=$r->queryRI(instructions);
			$temperatureU=$r->queryRI(temperatureU);
			$temperatureD=$r->queryRI(temperatureD);
			$cooktime=$r->queryRI(cooktime);
			$r=null;

			// 显示配料详情
			$ingre=new ingre;
			$ingre->__set(recipeId, $_REQUEST[id]);
			$all_ingres=$ingre->queryRID();
			$ingre=null;

		}

		

		
		print("<table data-role='table' data-mode='reflow' class='ui-body-d table-stripe my-custom-breakpoint'>
			   <thead>
					<tr>
						<th></th>
						<th class='theadth1'>配方 $recipeName - 原始</th>
						<th></th>
					</tr>
					<tr>
						<th>配料</th>
						<th>用量</th>
						<th>百分比</th>
					</tr>
			   </thead>
			   <tbody>");
		$i=1;
		foreach ($all_ingres as $item) {
				print("
				<tr>
					<td class='ui-field-contain'><input type='text' name='ingre".$i."' id='ingre".$i."' value=\"$item->name\"></td>
					<td class='ui-field-contain'><input type='text' name='metric".$i."' id='metric".$i."'  value=\"$item->metric\"></td>
					<td class='ui-field-contain'><input type='text' name='percent".$i."' id='percent".$i."'  value=\"$item->percent\"></td>
				</tr>
				");
				$i++;
				$sum=$item->sum;
				$percentSum=$item->perSum;
		}


		print("
			   </tbody>
			   </table>
			");

		print("<ul data-role='listview' data-inset='true'>
				<li class='ui-field-contain'>
					<label for='sum'>总产量</label>
					<input type='text' name='sum' id='sum' value=\"$sum\">
				</li>
				<li class='ui-field-contain'>
					<label for='percentSum'>总百分比</label>
					<input type='text' name='percentSum' id='percentSum' value=\"$percentSum\">
				</li>
				<li class='ui-field-contain'>
					<label for='temperatureU'>上火</label>
					<input type='text' name='temperatureU' id='temperatureU' value=\"$temperatureU\">
				</li>
				<li class='ui-field-contain'>
					<label for='temperatureD'>下火</label>
					<input type='text' name='temperatureD' id='temperatureD' value=\"$temperatureD\">
				</li>
				<li class='ui-field-contain'>
					<label for='cooktime'>烘焙时间</label>
					<input type='text' name='cooktime' id='cooktime' value=\"$cooktime\">
				</li>
				<li class='ui-field-contain'>
					<label for='instruc'>制作说明:</label>
					<textarea cols='80' rows='8' name='instruc' id='instruc'>$instruc</textarea>
				</li>
				<li class='ui-field-contain'>
					<label for='requireSum'>需求总量</label>
					<input type='number' name='requireSum' id='requireSum'>
				</li>
				<li class='ui-field-contain'>
					<input type='hidden' name='recipeName' id='recipeName' value=\"$recipeName\">
					<input type='hidden' name='recipeId' id='recipeId' value=\"$_REQUEST[id]\">
					<input type='button' name='generateRecipe' id='generateRecipe' value='生成配方' data-inline='true'>
					<input type='submit' name='submit' id='saveSonRecipe' value='保存子配方' data-inline='true' disabled=\"disabled\">
					<input type='submit' name='submit' id='updateRecipe' value='保存修改配方' data-inline='true'>
					<input type='submit' name='submit' id='updateRecipe' value='查看生成的子配方' data-inline='true'>
				</li>

			  </ul>
			");
		print("</form>");
	}

	// saveSonR
	function saveSonR(){

		// print("<pre>");
		// var_dump($_REQUEST);
		// print("<pre>");
		if ($_REQUEST[submit]=="保存修改配方"){
			$r=new recipe;
			$r->__set(id,$_REQUEST[recipeId]);
			$r->__set(instructions,$_REQUEST[instruc]);
			$r->__set(temperatureU,$_REQUEST[temperatureU]);
			$r->__set(temperatureD,$_REQUEST[temperatureD]);
			$r->__set(cooktime,$_REQUEST[cooktime]);
			$r->update();
			$r=null;
			print("修改成功！");

		}else if($_REQUEST[submit]=="保存子配方"){
			
			// 要插入ingres表的总行数等于($_REQUEST总数-多余的项)/3
			$rowsNum = (count($_REQUEST) - 11)/3;
			for($i=1;$i<=$rowsNum;$i++){
				$ingre=new ingre;
				$ingre->__set(name,$_REQUEST['ingre'.$i]);
				$ingre->__set(metric,$_REQUEST['metric'.$i]);
				$ingre->__set(percent,$_REQUEST['percent'.$i]);
				$ingre->__set(recipeId,$_REQUEST[recipeId]);
				$ingre->__set(recipeName,$_REQUEST[recipeName]);
				$ingre->__set(requireSum,$_REQUEST[requireSum]);
				$ingre->__set(perSum,$_REQUEST[percentSum]);
				$ingre->addreq();
				$ingre=null;
				print("保存子配方成功！");

			}
		}else if ($_REQUEST[submit]=="查看生成的子配方"){
			print("<h2>$_REQUEST[recipeName]</h2>");
			print("<ul data-role='listview' data-inset='true'>");
			$ingre=new ingre;
			$ingre->__set(recipeId,$_REQUEST[recipeId]);
			$all_reqs=$ingre->queryReq();
			foreach ($all_reqs as $item) {
				print("<li><a href='index.php?action=showReqDetail&id=".$_REQUEST[recipeId]."&reqSum=".$item->requireSum."'>$item->requireSum</a></li>");
			}
					
		
			print("</ul>");
		}
	}
?>