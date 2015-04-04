<?php
	require("admin.php");
	$session=new Session();
	$uid=$session->get_uid();
	echo $uid;
	if($uid!=NULL){header('Location: accountmgt.php');}
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$ad=new admin();
		$ad->write($_POST['name'],$_POST['email'],$_POST['msg']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" href="shared-frame.css">
<link rel="stylesheet" href="pink-theme.css">
<link rel="stylesheet" href="index.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".author-box > div").height($(".author-box > div").width());
		
	//show sign in box, hide sign up box
    $("#tab-signin").click(function() {
		$("#tab-signup").removeClass("colored-txt-dark")
		$(this).addClass("colored-txt-dark");
		$("#signup-form").hide();
	    $("#signin-form").fadeIn();
	});
	
	//show sign up box, hide sign in box
	$("#tab-signup").click(function() {
		$("#tab-signin").removeClass("colored-txt-dark")
		$(this).addClass("colored-txt-dark");
		$("#signin-form").hide();
	    $("#signup-form").fadeIn();
	});
	
	//show forget password box
	$("#forget-link").click(function() {
		$("#tabs").hide();
		$("#signin-form").hide();
	    $("#forget-form").fadeIn();
	});
	
	//hide forget password box
	$("#forget-back").click(function() {
		$("#tabs").show();
		 $("#signin-form").fadeIn();
	    $("#forget-form").hide();
	});
	
	//back to top
	$("#back2top").click(function() {
		$("body").animate({scrollTop:0}, "slow");
		event.preventDefault();
	});
	
	//scroll to about section
	$("#about").click(function() {
		$("body").animate({scrollTop:660}, "slow");
		event.preventDefault();
	});
	
	//scroll to contact section
	$("#contact").click(function() {
		$("body").animate({scrollTop:1300}, "slow");
		event.preventDefault();
	});
	
	//resize, keep author box a circle
	$(window).resize(function() {
		$(".author-box > div").height($(".author-box > div").width());
	});
});
</script>
<title>Welcome to iDating</title>
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
  <li><a id="contact" href="#contact-us">CONTACT</a></li>
  <li><a id="about" href="#about-us">ABOUT</a></li>
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--main-banner-start-->
<div class="banner background-cover-center">
<!--banner-content-start-->
<div id="banner-content">
<p>You're Not Alone.<br>From Today.</p>
<!--sign-box-start-->
<div id="sign-box">
<div id="tabs">
<button id="tab-signup" class="link-btn no-line colored-txt-dark" type="button">Sign Up</button>|
<button id="tab-signin" class="link-btn no-line" type="button">Sign In</button>
</div>

<form id="signup-form">
<input id="email-adr" class="txtbox txtbox-fill"  type="email" placeholder="Your Email" name="email" required><br>
<input id="pwd" class="txtbox txtbox-fill" type="password" placeholder="Your Password" name="password" required><br>
<input id="pwd-confirm" class="txtbox txtbox-fill" type="password" placeholder="Enter Password Again" name="password-confirm" required><br>
<button id="signup" class="btn btn-fill" onclick="logup()" type="button">SIGN UP NOW</button>
</form>

<form id="signin-form">
<input id="email-adr-2" class="txtbox txtbox-fill"  type="email" placeholder="Your Email" name="email" required><br>
<input id="pwd-2" class="txtbox txtbox-fill" type="password" placeholder="Your Password" name="password" required><br>
<button id="forget-link"  class="link-btn"  type="button">Forget your password?</button>
<button id="signin" class="btn btn-fill" onclick="login()" type="button">SIGN IN</button>
</form>

<form id="forget-form" action="forget.php" method="post">
Please enter your email address:
<input id="email-adr-3" class="txtbox txtbox-fill"  type="email" placeholder="Your Email" name="email" required><br><br>
A randomly generated password will be sent to you after verification. You can modify it later on.<br>
<button id="forget-back" class="btn btn-fill" type="button" >Back</button>
<input id="forget-send" class="btn btn-fill"  type="submit" value="Send Email">
</form>
</div>
<!--sign-box-end-->
</div>
<!--banner-content-end-->
</div>
<!--main-banner-end-->

<!--about-us-start-->
<div id="about-us">
<h2>ABOUT THIS WEBSITE</h2>
<p>iDating is a one-stop platform providing a simple and convenient way to help young people find their soul mate. <br>
Major features include personal homepage, search, dating calendar, photo-sharing and message-leaving. <br>It is presented to you by:</p>
<!--author-holder-start-->
<div id="author-holder">
  <div class="author-box">
    <div id="author-pic-1" class="background-cover-center"></div>
    <p>Kelly Xing</p>
  </div>
  <div class="author-box">
    <div id="author-pic-2" class="background-cover-center"></div>
    <p>Roy Pan</p>
  </div>
  <div class="author-box">
    <div id="author-pic-3" class="background-cover-center"></div>
    <p>Gaoxian Song</p>
  </div>
  <div class="author-box">
    <div id="author-pic-4" class="background-cover-center"></div>
    <p>Frank Xu</p>
  </div>
</div>
<!--author-holder-end-->
</div>
<!--about-us-end-->

<!--contact-us-start-->
<div id="contact-us">
<h2>CONTACT US</h2>
<form id="feedback" action="accountmgt.php">
<textarea id="feedback-msg" class="txtbox" rows="5" cols="30" placeholder="Leave Your Message Here..." name="msg" required></textarea>
<input id="feedback-name" class="txtbox" type="text" placeholder="Your Name" name="name" required>
<input id="feedback-email" class="txtbox" type="text" placeholder="Your E-mail" name="email" required>
<input id="feedback-send" class="btn btn-fill" type="submit" value="Send">
</form>
</div>
<!--contact-us-end-->

<a href="#"><img id="back2top" src="img/back2top.png" alt="back to top"></a>

<!--footer-start-->
<div class="footer">
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->

<script type="application/javascript">
var record;
function logup(){
	var email=document.getElementById("email-adr").value.trim();
	var pwd=document.getElementById("pwd").value;
	var pwd1=document.getElementById("pwd-confirm").value;
	if(email.length==0 || pwd.length==0){return;}
	else if(!(pwd==pwd1)){alert("passwords should be the same!");}
	else{
		xmlhttp=new XMLHttpRequest(); 
			//may be not secure......
		content='{"email":"'+email+'","password":"'+pwd+'"}';
		xmlhttp.open("POST","logup.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);
	//get response from login.php
		console.log(xmlhttp);
		record=xmlhttp;
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			window.location='registration.php?sid='+response['sid'];
		}
		else if(response['check']=='false'){
			//error message needs modification
			alert("Email or password is wrong!");
		}
		else{
			//if !$conn in login.php
			alert("System is busy. Please try again!");
		}
	}
}
function login(){
//get login information from user input
	var email=document.getElementById("email-adr-2").value.trim();
		//can input password be contraint without ' '?
	var pwd=document.getElementById("pwd-2").value;
//check whether empty, error message needs modification
	if(email.length==0 || pwd.length==0){alert("Input should not be empty!");}
	else{
	//create xmlHttpRequest and send info to login.php
		xmlhttp=new XMLHttpRequest(); 
			//may be not secure......
		content='{"email":"'+email+'","password":"'+pwd+'"}';
		xmlhttp.open("POST","login.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);
	//get response from login.php
		console.log(xmlhttp);
		record=xmlhttp;
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			window.location='accountmgt.php?sid='+response['sid'];
		}
		else if(response['check']=='false'){
			//error message needs modification
			alert("Email or password is wrong!");
		}
		else{
			//if !$conn in login.php
			alert("System is busy. Please try again!");
		}
	}
}
var uagent = navigator.userAgent.toLowerCase();
if (uagent.search("iphone") > -1){window.location.replace('index-m.html');}
</script>
</body>
</html>
