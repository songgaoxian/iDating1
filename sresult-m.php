<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="shared-theme-m.css">
<?php
require("themeControl.php");
$theme=new theme();
echo "<link rel='stylesheet' type='text/css' href='".$theme->getTheme()."-theme.css'>";
?>
<link rel="stylesheet" type="text/CSS" href="search-m.css">
<script src="js/select-or-die/jquery-1.8.0.min.js"></script>

<script>
$(document).ready(function() {
	$(".sidebar").hide();
		
	$("#nav").click(function() {
		$(".sidebar").fadeToggle();
	});
});

</script>

<title>iDating - Search</title>
</head>

<body>
<!--header-start-->
<div class="header">
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Search</h1>
</div>
<!--header-end-->

<div class="sidebar">
<a href="accountmgt-m.php">My Page</a>
<a href="search-m.php">Search</a>
<a href="shake.php">Shake</a>
<a href="calendar-m.php">Calendar</a>
<a href="moments-m.php">Moments</a>
<a href="messages-m.php">Messages</a>
</div>

<!--search-start-->

<div class='container'>
<?php
$session=new Session();
$currentid=$session->get_uid();
$dbc=connect();
require("srchController-m.php");
$result=new Result();
$result->render($dbc,$currentid);
?>
<!--search-end-->
</div>
<!--container-end-->
</body>
</html>

