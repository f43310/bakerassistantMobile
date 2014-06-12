<?php
require("header.php");
?>
<div data-role="page" id="page1">
	<div data-role="header"><a href='#' data-role='button' data-rel='back'>返回</a><h1>面包师助手</h1><a href='index.php' data-role='button'>首页</a></div>
	<div data-role="content">
		<?php
			require_once("showRecipes.php");
			$action=$_REQUEST['action'];
			if ($action=="addNew") {
				require_once("addRecipes.php");
				showAddForm();
				
			} else if ($action=="upsert") {
				require_once("addRecipes.php");
				addRecipes();
				showRecipes();


			} else if ($action=="showDetail"){
				require_once("showDetail.php");
				showDetail();

			} else if($action=="showSonRecipes"){
				require_once("showSonRecipes.php");
				showSonRecipes();

			}else if($action=="saveSonR"){
				require_once("showDetail.php");
				saveSonR();

			} else if ($action=="showReqDetail"){
				require_once("showReqDetail.php");
				showReqDetail();

			}else if ($action=="deleteR") {
				# code...
			} else if ($action=="deleteT") {
				# code...
			} else{
				showRecipes();
			}
		?>
	</div>
	<div data-role="footer">我的烘焙应用</div>
</div>

<?php require("footer.php"); ?>
</body>
</html>