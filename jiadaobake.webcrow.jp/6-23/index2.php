<?php
require("header.php");
?>
<div data-role="page" id="page1">
	<div data-role="header"><a href='#' data-role='button' data-rel='back'>返回</a><h1>面包师助手</h1><a href='index.php' data-role='button'>首页</a></div>
	<div data-role="content">


		<?php
			require_once("recipe.php");
			if ($_REQUEST['submit']=="提  交"){
				if($_REQUEST[username]=="" || $_REQUEST[password]==""){
					echo "你填写的信息不完整";
				}else{
					if ($_REQUEST[username]=="bakemaster" && $_REQUEST[password]=="H6bV^V4l"){
						require("index.php");
					}else{
						echo "用户名密码不正确";
					}
				}
			}
			
		?>
		<form method='post' action='<?php echo $PHP_SELF;?>'>
			<ul data-role='listview' data-inset='true'>
				<li class='ui-field-contain'>
					<label for='username'>用户名:</label>
					<input type='text' name='username' id='username'>
				</li>
				<li class='ui-field-contain'>
					<label for='password'>密  码:</label>
					<input type='text' name='password' id='password'>
				</li>
				<li class='ui-field-contain'>
					<input type='submit' name='submit' id='submit' value='提  交'>
				</li>
			</ul>

		</form>
	</div>
	<div data-role="footer">我的烘焙应用</div>
</div>

<?php require("footer.php"); ?>
</body>
</html>