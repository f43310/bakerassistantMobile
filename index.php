<?php
require("header.php");
?>
<div data-role="page" id="page1">
	<div data-role="header"><h1>面包师助手</h1></div>
	<div data-role="content">
		<?php
			$action=$_REQUEST['action'];
			if ($action=="addNew") {
				require_once("addRecipes.php");
				showAddForm();
				
			} else if ($action=="upsert") {
				require_once("addRecipes.php");
				addRecipes();


			} else if ($action=="deleteR") {
				# code...
			} else if ($action=="deleteT") {
				# code...
			} else{
				require_once("showRecipes.php");
				showRecipes();
			}
		?>
	</div>
	<div data-role="footer">我的烘焙应用</div>
</div>

<?php require("footer.php"); ?>
</body>
</html>