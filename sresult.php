<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="search.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="searchView.js"></script>
<title>iDating - Search</title>
</head>
<body>
<?php
require("session.php");
session_start();
$session=new Session();
$currentid=$session->get_uid();
require("searchView.php");
$view=new searchView();
$view->showCriteria();
$dbc=connect();
require("srchController.php");
$result=new Result();
$result->render($dbc, $currentid);
?>
</div>
<!-- container end-->
<!--footer-start-->
<div class="footer">
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->
</body>
<?php
$result->renderCondition();
?>
</html>


