<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<?php
require("themeControl.php");
$theme=new theme();
echo "<link rel='stylesheet' type='text/css' href='".$theme->getTheme()."-theme.css'>";
?>
<link rel="stylesheet" type="text/CSS" href="search-m.css">
<link rel="stylesheet" type="text/css" href="js/select-or-die/selectordie.css" />
<link rel="stylesheet" href="js/switchery/switchery.css" />
<link rel="stylesheet" href="js/label/selectify.css" />
<script src="js/select-or-die/jquery-1.8.0.min.js"></script>
<script src="js/select-or-die/selectordie.min.js"></script>
<script src="js/label/jquery.selectify.js"></script>
<script src="js/switchery/switchery.js"></script>

<script>
$(document).ready(function() {
	$(".basic").selectOrDie();
	$(".selectify").selectify();
			
	var left=1;
	$('#nav').click(function() {
		if(left==1){
			$('#B').animate({left: 150});left=0;
			$('#C').css('overflow','hidden');
		}
	    else{
			$('#B').animate({left: 0});left=1;
			$('#C').css('overflow','scroll');
		}
	});
	
	$("#by-name-form").hide();
	
	$("#tab-by-name").click(function() {
		$("#tab-by-condition").removeClass("colored-txt-dark");
		$(this).addClass("colored-txt-dark");
		$("#by-condition-form").hide();
	    $("#by-name-form").fadeIn();
	});
	
	//search by conditions
	$("#tab-by-condition").click(function() {
		$("#tab-by-name").removeClass("colored-txt-dark");
		$(this).addClass("colored-txt-dark");
		$("#by-condition-form").fadeIn();
	    $("#by-name-form").hide();
	});
});

</script>


<title>iDating - Search</title>
</head>

<body>
<?php
require("searchView-m.php");
$view=new searchView();
$view->showCriteria();
?>
</body>
</html>
