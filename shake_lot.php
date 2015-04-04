<?php 
	require('session.php');
		$session=new Session();
		$uid=$session->get_uid();
		if($uid==''){header('Location: index-m.html');}
		else{
			$user=new User();
			$user->set_user($uid);
			$uid=$user->rand_();
		}
?>
<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="shake.css">
<script src="js/select-or-die/jquery-1.8.0.min.js"></script>

<script>
$(document).ready(function() {
	$(".sidebar").hide();
		
	$("#nav").click(function() {
		$(".sidebar").fadeToggle();
	});
});

</script>

<title>iDating - Shake</title>
</head>

<body>
<!--header-start-->
<div class="header">
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Shake</h1>
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

<div class='container'>
	<img id="lot" src="lucky_draw/lot<?php echo round(1,6);?>.jpg">
    <div style="display:block; margin-top:10px">
    	<input name="recommend" type="button" class="btn btn-shake" value="Check our recommendations for you!" onclick='window.location.replace("accountmgt-m.php?uid="<?php echo $uid;?>)'>
    </div>
</div>


</body>
</html>
