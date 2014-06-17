<?php
	session_start();
	unset($_SESSION["loginSuccess"]);
	echo "<script>location='login.php';</script>";
?>