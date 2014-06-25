<?
	function showAddForm()
	{
		print("<form method=\"post\" action=\"index.php?action=upsert\">");
		print("<div data-role=\"fieldcontain\">");
		print("<label for=\"rName\" class=\"ui-hidden-accessible\">配方名称</label>");
		print("<input type=\"text\" name=\"rName\" id=\"rName\" placeholder=\"配方名称\" data-clear-btn=\"true\" required=\"required\">");
		print("</div>");
		print("<table id=\"tab\" data-role=\"table\" data-mode=\"reflow\" class=\"ui-body-d table-stripe my-custom-breakpoint\">");
		print("<thead>
					<tr>
						<th>原料</th>
						<th>用量(g)</th>
						<th colspan=\"2\">百分比(%)</th>
					</tr>
			   </thead>");
		print("<tbody>");
		print("<tr id=\"1\">
			<td><div data-role=\"fieldcontain\"><input type=\"text\" name=\"ingre1\" id=\"ingre1\" data-mini=\"true\"></div></td>
			<td><div data-role=\"fieldcontain\"><input type=\"number\" name=\"metric1\" id=\"metric1\" data-mini=\"true\"></div></td>
			<td><div data-role=\"fieldcontain\"><input type=\"number\" name=\"percent1\" id=\"percent1\" data-mini=\"true\"></div></td>
			<td><a href=\"#\" data-role=\"button\" data-mini=\"true\" class=\"ui-btn ui-state-disabled ui-mini\">删</a></td></tr>");

		print("</tbody>");

		print("</table><br />");
		print("	<div data-role=\"controlgroup\" data-type=\"horizontal\">
				<input type=\"button\" name=\"add\" id=\"add\" value=\"增加一行\" data-inline=\"true\" data-mini=\"true\">
				<input type=\"button\" name=\"calculate\" id=\"calculate\" value=\"计算百分比\" data-mini=\"true\" data-inline=\"true\">
				<a href=\"#\" data-role=\"button\" onclick=\"clearPercentCol()\" data-mini=\"true\">clearP</a>
				</div>
					<ui data-role=\"listview\"  data-inset=\"true\">
						<li class=\"ui-field-contain\">
							<label for=\"instruc\">制作步骤:</label>
							<textarea name=\"instruc\" id=\"instruc\" cols=\"40\" rows=\"8\" data-mini=\"true\" data-inline=\"true\"></textarea>
						</li>
						<li class=\"ui-field-contain\">
							<label for=\"temperatureU\">烘烤温度(上火):</label>
							<input type=\"range\" name=\"temperatureU\" id=\"temperatureU\" value=\"100\" min=\"100\" max=\"300\">
						</li>
						<li class=\"ui-field-contain\">
							<label for=\"temperatureD\">烘烤温度(下火):</label>
							<input type=\"range\" name=\"temperatureD\" id=\"temperatureD\" value=\"100\" min=\"100\" max=\"300\">
						</li>
						<li class=\"ui-field-contain\">
							<label for=\"cooktime\">烤制时间:</label>
							<input type=\"range\" name=\"cooktime\" id=\"cooktime\" value=\"0\" min=\"0\" max=\"60\">
						</li>
					</ui>

				<input type=\"submit\" name=\"save\" id=\"save\" value=\"保  存\" data-mini=\"true\">
			   ");

		print("</form>");


	}

	function addRecipes()
	{
		// print("<pre>");
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

		// 下面一行中的9在服务器上是10因为服务器多传了一个数据
		$rowsNum = (count($_REQUEST)-10)/3;			// 通过公式计算要插入数据库原料表中的个数, "4"代表其它和原料无关的元素 "3"代表配方表的三个属性 

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
		echo "<script>alert('配方: ".$_REQUEST[rName]." 增加成功!');location.href='index.php';</script>";

	}
?>