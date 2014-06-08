<?
$mysql_db = "databasename";
$mysql_user = "username";
$mysql_pass = "password";
$mysql_link = mysql_connect("localhost", $mysql_user, $mysql_pass);
mysql_select_db($mysql_db, $mysql_link);
?>
