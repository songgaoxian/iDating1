<?php 
	require('session.php');
		session_start();
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
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="shake.css">
<script src="js/select-or-die/jquery-1.8.0.min.js"></script>

<script>
$(document).ready(function() {
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
});
</script>
<title>iDating - Shake</title>
</head>

<body>
<div id="C">
<div id="A">
<!--sidebar-start-->
<ul>
<li><a href="accountmgt-m.php">My Page</a></li>
<li><a href="search-m.php">Search</a></li>
<li><a href="shake.php">Shake</a></li>
<li><a href="calendar-m.php">Calendar</a></li>
<li><a href="moments-m.php">Moments</a></li>
<li><a href="messages-m.php">Messages</a></li>
<li><a href="logout1.php">Log Out</a></li>
</ul>
<!--sidebar-end-->
</div>

<div id="B">
<!--header-start-->
<div class="header">
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Shake</h1>
</div>
<!--header-end-->
<!--container-start-->
<div class='container'>
	<img id="lot" src="lucky_draw/lot<?php echo rand(1,9);?>.jpg">
    <button id="recommend" name="recommend" type="button" class="btn" onclick='window.location.replace("accountmgt-m.php?uid=<?php echo $uid;?>")'>Check our recommendations for you!</button>
</div>
<!--container-end-->
</div>
</div>
</body>
</html>
