<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="search.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	var conditionCount=2;  //no of conditions in "more conditions"
	//delete a condition
    $(".item-delete").click(function() {
		$("#more-condition-box").append($(this).parent());
		conditionCount+=1;
		if (conditionCount>0) $("#more-condition").show();
		event.preventDefault();
	});
	
	// add a condition
	 $(".item-add").click(function() {
		$("#more-condition").before($(this).parent());
		conditionCount-=1;
		if (conditionCount==0) {
			$("#more-condition").hide();
			$("#more-condition-box").slideToggle();
		}
		event.preventDefault();
	});
	
	//show more conditions
	$("#more-condition").click(function() {
		$("#more-condition-box").slideToggle();
	});
	
	//search by nickname
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
require("searchView.php");
$view=new searchView();
$view->showCriteria();
?>
</body>
</html>
