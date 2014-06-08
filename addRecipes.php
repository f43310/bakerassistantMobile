<?
	function showAddForm()
	{
		print("<form method=\"post\" action=\"index.php?action=upsert\">");
		print("<div data-role=\"fieldcontain\">");
		print("<label for=\"rName\" class=\"ui-hidden-accessible\">配方名称</label>");
		print("<input type=\"text\" name=\"rName\" id=\"rName\" placeholder=\"配方名称\" data-clear-btn=\"true\">");
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
		print("<div data-role=\"fieldcontain\">
					<input type=\"button\" name=\"add\" id=\"add\" value=\"增加一行\" data-inline=\"true\" data-mini=\"true\">
					<input type=\"button\" name=\"calculate\" id=\"calculate\" value=\"计算百分比\" data-mini=\"true\" data-inline=\"true\">
					<ol id=\"instructions\" data-role=\"listview\" data-inset=\"true\">
						<label for=\"instruc1\">制作步骤:</label>
						<li><input type=\"text\" name=\"instruc1\" id=\"instruc1\" data-mini=\"true\" data-inline=\"true\"></li>
						<input type=\"button\" name=\"addNewStep\" id=\"addNewStep\" value=\"add a step\" data-inline=\"true\" data-mini=\"true\">
					</ol>
					<ui data-role=\"listview\"  data-inset=\"true\">
						<li class=\"ui-field-contain\">
							<label for=\"temperatureU\">烘烤温度(上火):</label>
							<input type=\"range\" name=\"temperatureU\" id=\"temperatureU\" value=\"190\" min=\"150\" max=\"300\">
						</li>
						<li class=\"ui-field-contain\">
							<label for=\"temperatureD\">烘烤温度(下火):</label>
							<input type=\"range\" name=\"temperatureD\" id=\"temperatureD\" value=\"190\" min=\"150\" max=\"300\">
						</li>
						<li class=\"ui-field-contain\">
							<label for=\"cooktime\">烤制时间:</label>
							<input type=\"range\" name=\"cooktime\" id=\"cooktime\" value=\"15\" min=\"0\" max=\"60\">
						</li>
					</ui>

					<input type=\"submit\" name=\"save\" id=\"save\" value=\"保  存\" data-mini=\"true\">
			   </div>");

		print("</form>");

	}

	function addRecipes()
	{

	}
?>