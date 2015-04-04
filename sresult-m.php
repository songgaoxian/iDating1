<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="shared-theme-m.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
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
<a href="accountmgt-m.html">My Page</a>
<a href="search-m.html">Search</a>
<a href="shake.html">Shake</a>
<a href="calendar-m.html">Calendar</a>
<a href="moments-m.html">Moments</a>
<a href="messages-m.html">Messages</a>
</div>

<!--search-start-->

<div class='container'>

<div id='search-result' class="colored-txt"><h2>Here're whom we have found for you.</h2>
	
    <div class="search-portrait">
		<div class="background-cover-center" style="background-image:url('portrait/pic_2.jpg'); height: 145px"></div>
		<a href="">Sheepfriend</a>
	</div>
    
    <div class="search-portrait">
		<div class="background-cover-center" style="background-image:url('portrait/pic_1.jpg'); height: 145px"></div>
		<a href="">Sheepfriend</a>
	</div>
    
    <div class="search-portrait">
		<div class="background-cover-center" style="background-image:url('portrait/pic_4.jpg'); height: 145px"></div>
		<a href="">Sheepfriend</a>
	</div>
    
    <div class="search-portrait">
		<div class="background-cover-center" style="background-image:url('portrait/pic_5.jpg'); height: 145px"></div>
		<a href="">Sheepfriend</a>
	</div>
    
    <div class="btn-group">
    	<input id="return-btn" type="button" class="btn btn-mobile" value="Return to search page">
    </div>
    
</div>

<!--search-end-->

</body>
</html>
