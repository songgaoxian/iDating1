<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="shake.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$("#shake").click(function() {
		$("body").append("<div class='mask'></div>");
		$(".overlay-container").show();
		$("#waiting-box").css("margin-top",($(".overlay-container").height()-$("#waiting-box").height())/2);
    	$("#waiting-box").fadeIn();
		setTimeout(window.location.replace('shake_lot.php'),5000);
	});
	
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
<div id='topnav'>
<img id='shake' src='img/add.png' alt='shake'>
</div>
<img id="nav" src="img/nav.png" alt="navigate">
<h1>Shake</h1>
</div>
<!--header-end-->
<!--container-start-->
<div class="container">
<p>Please Shake Your Cellphone</p>
<p id="123"></p>
<div id="shake-bg"></div>

<div id="doEvent">
      <table>
        <tr>
          <td>Event Supported</td>
          <td id="doEvent"></td>
        </tr>
        <tr>
          <td>Tilt Left/Right [gamma]</td>
          <td id="doTiltLR"></td>
        </tr>
        <tr>
          <td>Tilt Front/Back [beta]</td>
          <td id="doTiltFB"></td>
        </tr>
        <tr>
          <td>Direction [alpha]</td>
          <td id="doDirection"></td>
        </tr>
      </table>
</div>
<script>
	init();
	var count = 0;
	var count1=0;
	var init_=[0,0,0];
    function init() {
      if (window.DeviceOrientationEvent) {
        document.getElementById("doEvent").innerHTML = "DeviceOrientation";
        // Listen for the deviceorientation event and handle the raw data
        window.addEventListener('deviceorientation', function(eventData) {
          // gamma is the left-to-right tilt in degrees, where right is positive
          var tiltLR = eventData.gamma;
          
          // beta is the front-to-back tilt in degrees, where front is positive
          var tiltFB = eventData.beta;
          
          // alpha is the compass direction the device is facing in degrees
          var dir = eventData.alpha
          
          // call our orientation event handler
          deviceOrientationHandler(tiltLR, tiltFB, dir);
          }, false);
      } else {
        document.getElementById("doEvent").innerHTML = "Not supported on your device or browser. Sorry."
      }
    }
    function deviceOrientationHandler(tiltLR, tiltFB, dir) {
		count+=Math.sqrt(Math.pow(tiltLR-init_[0],2)+Math.pow(tiltFB-init_[1],2)+Math.pow(dir-init_[2],2));
		init_[0]=tiltLR;
		init_[1]=tiltFB;
		init_[2]=dir;
		document.getElementById("doDirection").innerHTML = Math.round(count);
		var temp=document.getElementById('123');
		temp.text=count;
		if(count>3000 && count1==0){
			count1=1;
			alert("123");
			$('#shake').click();
		}
    }
</script>
</div>
<!--container-end-->
</div>
</div>

<!--overlay-start-->
<div class="overlay-container">
<!--waiting-box-start-->
<div id="waiting-box" class="overlay-sml">
<img src="img/waiting.gif" alt="waiting">
<h2>Interpreting...</h2>
</div>
<!--waiting-box-end-->
</div>
<!--overlay-end-->
</body>
</html>
