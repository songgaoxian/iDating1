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
	var conditionCount=2;
    $(".item-delete").click(function() {
		$("#more-condition-box").append($(this).parent());
		conditionCount+=1;
		if (conditionCount>0) $("#more-condition").show();
		event.preventDefault();
		//$(this).parent().remove();
	});
	
	 $(".item-add").click(function() {
		$("#more-condition").before($(this).parent());
		conditionCount-=1;
		if (conditionCount==0) {
			$("#more-condition").hide();
			$("#more-condition-box").slideToggle();
		}
		event.preventDefault();
		//$(this).parent().remove();
	});
	
	$("#more-condition").click(function() {
		$("#more-condition-box").slideToggle();
	});
	
	$("#tab-by-name").click(function() {
		$("#tab-by-condition").css("color","black");
		$(this).css("color","#e5004f");
		$("#by-condition-form").hide();
	    $("#by-name-form").fadeIn();
	});
	
	$("#tab-by-condition").click(function() {
		$("#tab-by-name").css("color","black");
		$(this).css("color","#e5004f");
		$("#by-condition-form").fadeIn();
	    $("#by-name-form").hide();
	});
});
</script>
<title>iDating - Search</title>
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
<li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.html">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>
  
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--search-condition-start-->
<div id="search-condition">
<div id="tabs">
<button id="tab-by-condition" class="link-btn no-line" type="button">Search by Conditions</button>|
<button id="tab-by-name" class="link-btn no-line" type="button">Search by Nickname</button>
</div>

<form id="by-name-form" method="get" action="sresult.php">
<input class="txtbox" type="text" placeholder="Nickname" name="nickname" required>
<input id="search-1" class="btn" type="submit" value="">
</form>

<form id="by-condition-form" method="post" action="sresult.php">
<input id="search-2" class="btn" type="submit" value="">

<div class="search-item">
Gender: 
<select name="gender">
  <option value="male">Male</option>
  <option value="female">Female</option>
  <option value="unlimited" selected>Unlimited</option>
</select>
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Age:
<input id="age-from" class="txtbox-embed" type="number" min="18" max="99" value="22" name="age-from"> ~ <input id="age-to" class="txtbox-embed" type="number"  min="18" max="99"  value="28" name="age-to">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Height (cm):
<input id="height-from" class="txtbox-embed" type="number" min="140" max="220" value="150" name="height-from"> ~ <input id="height-to" class="txtbox-embed" type="number" min="140" max="220" value="170" name="height-to">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
City:
<input class="txtbox-embed" type="text" value="Hong Kong" name="city">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Occupation:
  <select name="job" class="txtbox-embed">
  	<option value="Unlimited" selected>Unlimited</option>
  	<option value="Student">Student</option>
    <option value="Computer Software">Computer Software</option>
	<option value="Computer Hardware">Computer Hardware</option>
    <option value="Telecommunications">Telecommunications</option>
	<option value="Internet/E-commerce">Internet/E-commerce</option>
	<option value="Accounting/Auditing">Accounting/Auditing</option>
	<option value="Banking">Banking</option>
	<option value="Real Estate">Real Estate</option>
	<option value="Insurance">Insurance</option>
	<option value="Consulting">Consulting</option>
	<option value="Legal">Legal</option>
	<option value="Trading/Import & Export">Trading/Import & Export</option>
	<option value="Wholesale/Retail">Wholesale/Retail</option>
	<option value="Apparel/Textiles">Apparel/Textiles</option>
	<option value="Furniture/Home Appliances">Furniture/Home Appliances</option>
	<option value="Healthcare/Medicine/Public Health">Healthcare/Medicine/Public Health</option>
	<option value="Public Relations/Marketing">Public Relations/Marketing</option>
	<option value="Films/Media/Arts">Films/Media/Arts</option>
	<option value="Education/Training">Education/Training</option>
	<option value="Science/Research">Science/Research</option>
	<option value="Transportation/Logistic">Transportation/Logistic</option>
	<option value="Utilities/Energy">Utilities/Energy</option>
	<option value="Agriculture/Fishing/Forestry">Agriculture/Fishing/Forestry</option>
	<option value="Others">Others</option>
  </select>
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Eduacation:
<select name="education" class="txtbox-embed">
    <option value="Unlimited" selected>Unlimited</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select></td>
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>
<button id="more-condition" type="button" class="link-btn">More conditions?</button>
</form>

<div id="more-condition-box">
<div class="search-item">
Hometown:
<input class="txtbox-embed" type="text" value="Peking" name="hometown">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Monthly Income (HKD): &gt;=
<input id="income" class="txtbox-embed" type="number" value="10000" name="income">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<!--
<div class="search-item">
Tags: Workaholic + Reliable
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>-->
</div>
</div>
<!--search-condition-end-->
</div>
<!--content-end-->

<!--footer-start-->
<div class="footer">
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->
</body>
</html>
