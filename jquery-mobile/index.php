<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>jQuery Mobile Web 应用程序</title>
<link href="jquery-mobile/jquery.mobile-1.0a3.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.5.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0a3.min.js" type="text/javascript"></script>
</head> 
<body> 

<div data-role="page" id="page">
	<div data-role="header">
		<h1>第 1 页</h1>
	</div>
	<div data-role="content">	
		<ul data-role="listview">
			<li><a href="#page2">第 2 页</a></li>
            <li><a href="#page3">第 3 页</a></li>
			<li><a href="#page4">第 4 页</a></li>
		</ul>		
	</div>
	<div data-role="footer">
		<h4>页面脚注</h4>
	</div>
</div>

<div data-role="page" id="page2">
	<div data-role="header">
		<h1>第 2 页</h1>
	</div>
	<div data-role="content">	
		内容		
	</div>
	<div data-role="footer">
		<h4>页面脚注</h4>
	</div>
</div>

<div data-role="page" id="page3">
	<div data-role="header">
		<h1>第 3 页</h1>
	</div>
	<div data-role="content">	
		内容		
	</div>
	<div data-role="footer">
		<h4>页面脚注</h4>
	</div>
</div>

<div data-role="page" id="page4">
	<div data-role="header">
		<h1>第 4 页</h1>
	</div>
	<div data-role="content">	
		内容		
	</div>
	<div data-role="footer">
		<h4>页面脚注</h4>
	</div>
</div>

</body>
</html>
