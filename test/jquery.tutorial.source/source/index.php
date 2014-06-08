<?
require('db.php');
require('utils.php');
require('header.php');
?>
    <div  data-role="page">
	<div data-role="header">
	<h1>JQuery Tutorial</h1>
	</div>
	<div data-role="content">

<? 
$action = $_REQUEST['action'];
if ($action == 'addnew') {
   showOneOpp(-1);
} else if ($action == 'upsert') {
	if ($_REQUEST['id'] == '-1') {
		addOpp($_REQUEST['person'],$_REQUEST['contact'],$_REQUEST['description']); 
	} else {
		updateOpp($_REQUEST['id'],$_REQUEST['person'],$_REQUEST['contact'],$_REQUEST['description']);
	}
   showOpps();
} else if ($action == 'delete') {
	killOpp($_REQUEST['id']);
	showOpps();
} else if ($action == 'details') {
	showOneOpp($_REQUEST['id']);
} else {
	showOpps();
}
?>
	</div>
	<div data-role="footer">
	Sample code for IBM Developerworks
	</div>
	</div>
<? require('footer.php'); ?>
</body>
</html>


