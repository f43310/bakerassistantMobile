<?php
session_start();
require("header.php");
require_once("environmentVar.php");
?>
<div data-role="page" id="page1">
	<div data-role="header"><a href='#' data-role='button' data-rel='back'>返回</a><h1>面包师助手</h1><a href='index.php' data-role='button'>首页</a></div>
	<div data-role="content">


		<?php
				// echo "loginSuccess: ".$_SESSION["loginSuccess"];				// 测试
			if(!isset($_SESSION["loginSuccess"])){
				// echo "loginSuccess: ".$_SESSION["loginSuccess"];				// 测试
				echo "<script>location='login.php';</script>";
			}
			$action=$_REQUEST['action'];
			if ($action=="addNew") {
				require_once("addRecipes.php");
				showAddForm();
				
			} else if ($action=="upsert") {
				require_once("addRecipes.php");
				addRecipes();
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

			} else if($action=="delR"){
				require_once("deleteRecipe.php");
				dummyDelR($_REQUEST[id]);
			} else if($action=="deleteR") {
				require_once("deleteRecipe.php");
				deleteR($_REQUEST[id]);
			} else if($action=="showRecycleBin"){
				require_once("showRecycleBin.php");
				showRecycleBin();
			} else if ($action=="deleteRR") {
				require_once("delReqRecipe.php");
				deleteRR($_REQUEST[id],$_REQUEST[reqsum]);
			} else if($action=="help"){
				require_once("help.php");
				showHelp();

			} else if($action=="revert"){
				require_once("revert.php");
				revert($_REQUEST["id"]);
			} else{
				require_once("showRecipes.php");
				showRecipes();
				print("<li>
						<a href='index.php?action=showRecycleBin' data-role='button' data-ajax='false' class='prompt'>查看垃圾筒</a>
					</li></ul>");
			}
		?>
		
	</div>
	<div data-role="footer">
		<div data-role='controlgroup' data-type='horizontal'>
			<a href='exit.php' data-role='button' data-ajax='false'>退出</a>
			<a href='index.php?action=help' data-role='button' data-ajax='false'>帮助</a>
		</div>
	</div>
</div>

<?php require("footer.php"); ?>
</body>
</html>