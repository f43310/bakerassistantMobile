<?php
	session_start();
	// showDetail()
	function showDetail(){
			require_once("recipe.php");
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

		
		if($_SESSION["deleted"]==1){
			print("<div class='red'>这是垃圾筒内的配方，删除后将无法恢复！</div>");
			print("<a href='index.php?action=deleteR&id=".$_REQUEST[id]."'>删除此配方</a>");
		}else{
			print("<a href='index.php?action=delR&id=".$_REQUEST[id]."'>删除此配方</a>");
		}
		
		print("<table data-role='table' data-mode='reflow' class='ui-body-d table-stripe my-custom-breakpoint'>
			   <thead>
					<tr>
						<th colspan='3'>
						<div data-role='fieldcontain'>
							<label for='rName'>配方:</label>
							<input type='text' name='rName' id='rName' value='".$recipeName."'>
						</div>
						</th>
					</tr>
					<tr>
						<th>配料</th>
						<th>用量</th>
						<th>百分比</th>
					</tr>
			   </thead>
			   <tbody>");
		$i=1;
		$rowSum=0;
		foreach ($all_ingres as $item) {
				print("
				<tr id='".$i."'>
					<td class='ui-field-contain'><input type='text' name='ingre".$i."' id='ingre".$i."' value=\"$item->name\"></td>
					<td class='ui-field-contain'><input type='text' name='metric".$i."' id='metric".$i."'  value=\"$item->metric\"></td>
					<td class='ui-field-contain'><input type='text' name='percent".$i."' id='percent".$i."'  value=\"$item->percent\"></td>
					<td><a href=\"#\" data-role=\"button\" data-mini=\"true\" class=\"ui-btn ui-mini\" onclick=\"deltr($i)\">删</a></td>
				</tr>
				");
				$i++;
				$rowSum+=1;
				$sum=$item->sum;
				$percentSum=$item->perSum;
		}


		print("
			   </tbody>
			   </table>
			");

		print("<ul data-role='listview' data-inset='true'>
				<li class='ui-field-contain'>
					<label for='requireSum'>需求总量</label>
					<input type='number' name='requireSum' id='requireSum'>
				</li>
				<li class='ui-field-contain'>
					<input type='hidden' name='recipeName' id='recipeName' value=\"$recipeName\">
					<input type='hidden' name='recipeId' id='recipeId' value=\"$_REQUEST[id]\">

					<div data-role='controlgroup' data-type='horizontal'>
						<input type='button' name='generateRecipe' id='generateRecipe' value='计算' data-inline='true'>
						<input type='submit' name='submit' id='saveSonRecipe' value='保存' data-inline='true' disabled=\"disabled\">
						<a href='#' data-role='button'>".$rowSum." 行</a>			
					</div>

					
				</li>
				<li class='ui-field-contain'>
					<div data-role=\"controlgroup\" data-type=\"horizontal\">
					<input type=\"button\" name=\"add\" id=\"add\" value=\"增加一行\" data-inline=\"true\">
					<input type=\"button\" name=\"reCalculate\" id=\"reCalculate\" value=\"RECALPER\" data-inline=\"true\">
					<a href=\"#\" data-role=\"button\" onclick=\"clearPercentCol()\">clearP</a>
				</div>
				</li>
				<li class='ui-field-contain'>
					<a href='index.php?action=showSonRecipes&id=".$_REQUEST[id]."'>查看生成的子配方</a>
				</li>
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
					<input type='submit' name='submit' id='updateRecipe' value='更新配方' data-inline='true'>
					<input type='submit' name='submit' id='saveAsNewRecipe' value='保存为新配方' data-inline='true'>
				</li>

			  </ul>
			");
		print("</form>");
	}

	// saveSonR
	function saveSonR(){
	require_once("recipe.php");
		// print("<pre>");
		// var_dump($_REQUEST);
		// print("<pre>");
		// return;
		if ($_REQUEST[submit]=="更新配方"){
			$r=new recipe;
			$r->__set(id,$_REQUEST[recipeId]);
			$r->__set(name,$_REQUEST[rName]);
			$r->__set(instructions,$_REQUEST[instruc]);
			$r->__set(temperatureU,$_REQUEST[temperatureU]);
			$r->__set(temperatureD,$_REQUEST[temperatureD]);
			$r->__set(cooktime,$_REQUEST[cooktime]);
			$r->update();
			$r=null;
			print("修改成功！<br />");
			print("<a href='index.php?action=showDetail&id=".$_REQUEST[recipeId]."'>查看结果</a>");

		}else if($_REQUEST[submit]=="保存"){
			
			// 要插入ingres表的总行数等于($_REQUEST总数-多余的项)/3
			$rowsNum = (count($_REQUEST) - SAVESONEXTRANUM)/3;
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
				

			}
			print("保存子配方成功！<br />");
			print("<a href='index.php?action=showSonRecipes&id=".$_REQUEST[recipeId]."'>查看生成的子配方</a>");

		}else if($_REQUEST[submit]=="保存为新配方"){
			// 		print("<pre>");
			// var_dump($_REQUEST);
			// print("</pre>");
			// return;
			// 插入 recipes表
			require_once("recipe.php");
			if ($_REQUEST[rName]==""||
				$_REQUEST[sum]==""||
				$_REQUEST[percentSum]==""){
				print("<div class='prompt'>添加失败，请把信息填写完整</div>");
				print("<a href='javascript:history.go(-1)'>重试</a>");
			}
			else{
				$r=new recipe;
				$r->__set(name,$_REQUEST[rName]);
				$r->__set(user_id,$_SESSION["user_id"]);
				$r->__set(instructions,$_REQUEST[instruc]);
				$r->__set(temperatureU,$_REQUEST[temperatureU]);
				$r->__set(temperatureD,$_REQUEST[temperatureD]);
				$r->__set(cooktime,$_REQUEST[cooktime]);
				$r->add();
				$r=null;
				// print("<script>alert('配方: ".$_REQUEST[rName]." 增加成功!');</script>");
			}
			// 插入 ingres 表
			$r=new recipe;
			$r->__set(name,$_REQUEST[rName]);
			// echo $r->__get(name);
			$id=$r->queryId();
			$r=null;
			// echo $id;
			// return;

			// 下面一行中的9在服务器上是10因为服务器多传了一个数据，这里是11因为比addRecipes.php多了3项
			// echo SAVEASEXTRANUM;
			// return;
			$rowsNum = (count($_REQUEST)-SAVEASEXTRANUM)/3;			// 通过公式计算要插入数据库原料表中的个数, "4"代表其它和原料无关的元素 "3"代表配方表的三个属性 

			for ($i =0; $i < $rowsNum; $i++){
				// echo $_POST['ingre'.($i+1)];
				$ingre = new ingre;			// 建立一个配方对象
				$ingre->__set('name',$_REQUEST['ingre'.($i+1)]);
				$ingre->__set('metric',$_REQUEST['metric'.($i+1)]);
				$ingre->__set('percent',$_REQUEST['percent'.($i+1)]);
				$ingre->__set('recipeName',$_REQUEST['rName']);
				$ingre->__set('recipeId',$id);
				$ingre->__set('sum',$_REQUEST['sum']);
				$ingre->__set('perSum',$_REQUEST['percentSum']);
				$ingre->add();
				$ingre=NULL;
				// echo "原料: ".$_REQUEST['ingre'.($i+1)]."  用量: ".$_REQUEST['metric'.($i+1)]."  百分比: ".$_REQUEST['percent'.($i+1)]." 添加成功！<br />";
			}

			// echo "总量: ".$_REQUEST['sum']." 百分比: ".$_REQUEST['percentSum']." 添加成功！<br />";
			echo "<script>alert('配方: ".$_REQUEST[recipeName]." 另存为 ".$_REQUEST[rName]." 成功!');location.href='index.php';</script>";

		}
		else {
			print("请再返回一步，由于保存了子配方");
		}
	}


?>