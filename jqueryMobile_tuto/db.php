<?
$mysql_db = "jqueryMobileTuto";
$mysql_user = "root";
$mysql_pass = "";
$mysql_link = mysql_connect("localhost", $mysql_user, $mysql_pass);
// echo $mysql_link;
// echo "1111111";
mysql_select_db($mysql_db, $mysql_link);
mysql_query("set names utf8");	
?>
