<?php
	require("session.php");
	class UserView{
		private $user_info;
		private $friend_info;
		public function __construct($info){
			$this->user_info=array();
			foreach($info as $key=>$value){
				$this->user_info[$key]=$value;
			}
		}
		public function show_one($info){
			/*$result='';
			foreach($info as $key=>$value){
				$result.=$key.': '.$value.'\n';
			}
			return($result);*/
			if($info[24]=='1'){
			return('<div class="friend-box"><table><tr>
    <td><div class="friend-portrait background-cover-center" style="background-image:url(portrait/'.$info['photo'].')" onClick="window.location.replace(\'accountmgt.php?uid='.$info['user_id'].'\')"></div></td>
    <td><h3>'.$info['username'].'</h3>
<p>'.$info['email'].'</p><br><br>
<div class="friend-btns">
<button class="btn btn-sml" type="button" onClick=\'send_email("'.$info['user_id'].'")\'>Send Message</button>
<button class="btn btn-sml" type="button" onClick=\'delete_friend("'.$info['user_id'].'")\'>Delete</button>
</div></tr></table></div>');
			}
			else if($info[24]=='0'){
				return('<div class="friend-box"><table><tr>
    <td><div class="friend-portrait background-cover-center" style="background-image:url(portrait/'.$info['photo'].')" onClick="window.location.replace(\'accountmgt.php?uid='.$info['user_id'].'\')"></div></td>
    <td><h3>'.$info['username'].'</h3>
<p>'.$info['email'].'</p><br><br>
<div class="friend-btns">
<button class="btn btn-sml" type="button" onClick="window.location.replace(\'commit_friend.php?uid='.$info['user_id'].'\')">Commit Friend</button>
<button class="btn btn-sml" type="button" onClick=\'delete_friend("'.$info['user_id'].'")\'>Reject</button>
</div></tr></table></div>');
			}
			else{
				return('<div class="friend-box"><table><tr>
    <td><div class="friend-portrait background-cover-center" style="background-image:url(portrait/'.$info['photo'].')" onClick="window.location.replace(\'accountmgt.php?uid='.$info['user_id'].'\')"></div></td>
    <td><h3>'.$info['username'].'</h3>
<p>'.$info['email'].'</p><br><br>
<div class="friend-btns">
<button class="btn btn-sml" type="button" onClick=\'send_email("'.$info['user_id'].'")\'>Send Message</button>
<button class="btn btn-sml" type="button">Waiting Reply</button>
</div></tr></table></div>');
			}
		}
		public function show_all($info){
			$i=0;
			$num=0;
			$result='';
			while($num<count($info)){
				if($i==0){
					$result.='<tr><td>'.$this->show_one($info[$num]).'</td>';
					$i=1;
				}
				else{
					$result.='<td>'.$this->show_one($info[$num]).'</td></tr>';
					$i=0;
				}
				$num+=1;
			}
			if($i==0){$result.='</tr>';}
			if(count($info)==0){$result='Find a friend la~';}
			$this->friend_info=$result;
		}
		public function show_all1($info){
			$num=0;
			$result='';
			while($num<count($info)){
				$result.='<tr><td>'.$this->show_one($info[$num]).'</td></tr>';
				$num+=1;
			}
			if($i==0){$result.='</tr>';}
			if(count($info)==0){$result='Find a friend la~';}
			$this->friend_info=$result;
		}
		public function show_info_m($mode){
			echo'
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="'.$this->user_info['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="accountmgt-m.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link href="js/jqueryUI/chosen/chosen.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/jqueryUI/chosen/chosen.jquery.js"></script>
<link rel="stylesheet" type="text/CSS" href="sidebar.css">

<script>
$(document).ready(function() {

	$("#portrait").height($("#portrait").width());
	$(".friend-portrait").height($(".friend-portrait").width());
	
	//show change password dialog
    $("#change-pwd").click(function() {
		$("#change-pwd-box").fadeIn();
	});
	
	//show change portrait dialog
    $("#change-portrait").click(function() {
		$("#change-portrait-box").fadeIn();
	});
	
	//close a overlay
	$(".close-overlay").click(function() {
		$(this).parent().parent().fadeOut();
	});
	
	$("#edit-pref").click(function(){
		$(".edit-show").show();
		$(".edit-hide").hide();
	});
	
	$("#cancel-pref").click(function(){
		$(".edit-show").hide();
		$(".edit-hide").show();
	});
	
	$("#save-pref").click(function(){
		$(".edit-show").hide();
		$(".edit-hide").show();
	});
});

$(function(){
    $(".selecttags").chosen();
});

</script>
<title>iDating - My Account</title>
</head>

<body><div id="C">
<div id="A">
<ul>
<li><a href="accountmgt-m.php">My Page</a></li>
<li><a href="search-m.php">Search</a></li>
<li><a href="shake.php">Shake</a></li>
<li><a href="calendar-m.php">Calendar</a></li>
<li><a href="moments-m.php">Moments</a></li>
<li><a href="messages-m.php">Messages</a></li>
<li><a href="logout1.php">Log Out</a></li>
</ul>
</div>
<!--header-start--><div id="B">
<div class="header">
<nav><img id="nav" src="img/nav.png" alt="navigate"/></nav>
<h1>My Page</h1>
</div>
<!--header-end-->
<!--container-start-->
<div class="container">
<!--my-account-start-->
<h2 class="subheading colored-txt">MY ACCOUNT</h2>
<div class="section-box">
<div class="section-box-content">
<table>
  <tr>
    <td class="item-name colored-txt">Email: </td>
    <td class="item-content" id="email">'.$this->user_info['email'].'</td></tr><tr>';
  if($mode==0)
  {echo '
    <td class="item-name colored-txt">Password: </td>
    <td class="item-content"><button id="change-pwd" type="button" class="btn btn-sml">Change Password</button></td>';}echo '
  </tr>';if($mode==0){echo'
  <tr>
    <td class="item-name colored-txt">Theme: </td>
	<td class="item-content edit-hide" id="theme1">'.$this->user_info['theme'].'</td>
    <td class="item-content edit-show">
	  <select name="theme" class="txtbox" id="theme">
        <option value="pink" selected>pink</option>
        <option value="blue">blue</option>
      </select>
    </td>
  </tr>';}echo'
</table>
</div>
</div>
<!--my-account-end-->
<!--about-me-start-->
<h2 class="subheading colored-txt">ABOUT ME</h2>';
if($mode==0){echo '
<button id="edit-pref" type="button" class="btn btn-sml edit-hide" onClick="click_()">Edit</button>
<button id="save-pref" type="button" class="btn btn-sml edit-show" onClick="edit()">Save</button>
<button id="cancel-pref" type="button" class="btn btn-sml edit-show">Cancel</button>
';}
echo'
<div class="section-box">
<div class="section-box-content">
<table id="portrait-intro-table">
  <tr>
    <td>
	<div id="portrait" class="background-cover-center" style="background-image:url(\'portrait/'.$this->user_info['photo'].'\')"></div>
    <button id="change-portrait" type="button" class="btn btn-sml edit-show">Change</button>
    </td>
  </tr>
  <tr>
	<td>
	<p class="edit-hide" id="self_intro1">'.$this->user_info['self_intro'].'</p>
    <textarea class="edit-show txtbox txtbox-fill" id="self_intro">'.$this->user_info['self_intro'].'</textarea>
	</td>
  </tr>
</table>

<table>
<tr>
  <td class="item-name colored-txt">Nickname: </td>
  <td class="item-content edit-hide" id="username1">'.$this->user_info['username'].'</td>
  <td class="item-content edit-show"><input class="txtbox" id="username" type="text" name="username" required value="'.$this->user_info['username'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Gender:</td>
  <td class="item-content">'.$this->user_info['sex'].' </td>
</tr>
<tr>
  <td class="item-name colored-txt">Birthday: </td>
  <td class="item-content">'.$this->user_info['birthday'].'</td>
</tr>
<tr>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide" id="height1">'.$this->user_info['height'].'</td>
  <td class="item-content edit-show"><input id="height" class="txtbox" type="number" min="140" max="220"  name="height" value="'.$this->user_info['height'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content edit-hide" id="city1">'.$this->user_info['city'].'</td>
  <td class="item-content edit-show"><input id="city" class="txtbox" type="text" name="city-me" required value="'.$this->user_info['city'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content edit-hide" id="hometown1">'.$this->user_info['hometown'].'</td>
  <td class="item-content edit-show"><input id="hometown" class="txtbox" type="text" name="hometown-me" required value="'.$this->user_info['hometown'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content edit-hide" id="education1">'.$this->user_info['education'].'</td>
  <td class="item-content edit-show">
  <select name="education-me" class="txtbox" id="education" value="'.$this->user_info['education'].'">
    <option value="Unspecified" selected>Please Select</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select>
  </td>
</tr>
<tr>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide" id="job1">'.$this->user_info['job'].'</td>
  <td class="item-content edit-show">
  <select name="job-me" class="txtbox" id="job" value="'.$this->user_info['job'].'">
    <option value="Unspecified">Please Select</option>
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
	<option value="Law">Law</option>
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
  </td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide" id="income1">'.$this->user_info['income'].'HKD</td>
  <td class="item-content edit-show"><input id="income" class="txtbox" type="number" min="0" name="income-me" required value="'.$this->user_info['income'].'"> HKD</td>
</tr>
<tr>
  <td class="item-name colored-txt">Tags:</td>
  <td class="item-content edit-hide" id="tags">';
  
  $tag=$this->user_info['tags'];
  if(count($tag)>0){
	foreach($tag as $key=>$value){
		if($value!=''){
	  echo('<div class="tag-item">'.$value.'</div>');}
	}}
   echo '</td>  
   <td class="item-content edit-show">
   		<select name="tags" id="selecttags" class="selecttags" multiple="multiple" size="5"> 
    		<option value="Music">Music</option>
    		<option value="Movies">Movie</option>
    		<option value="Book">Book</option>
    		<option value="Jogging">Jogging</option>
    		<option value="Cooking">Cooking</option>
		</select> 
   </td>
</tr>
</table>
<p class="edit-show">* For security reason, gender and birthday cannot be modified after registration.</p>
</div>
</div>
<!--about-me-end-->
<!--looking-for-start-->';
echo '<h2 class="subheading colored-txt">I\'M LOOKING FOR</h2>
<div class="section-box">
<div class="section-box-content">
<table>
<tr>
  <td class="item-name colored-txt">Age: </td>
  <td class="item-content edit-hide"><span id="age_f1">'.$this->user_info['age_f'].'</span>~<span id="age_t1">'.$this->user_info['age_t'].'</span></td>
  <td class="item-content edit-show"><input id="age_f" class="txtbox" type="number" min="18" max="99" name="age-from" value="'.$this->user_info['age_f'].'"> ~ <input id="age_t" class="txtbox" type="number"  min="18" max="99"  name="age-to" value="'.$this->user_info['age_t'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide"><span id="height_f1">'.$this->user_info['height_f'].'</span>~<span id="height_t1">'.$this->user_info['height_t'].'</span></td>
  <td class="item-content edit-show"><input id="height_f" class="txtbox" type="number" min="140" max="220" name="height-from" value="'.$this->user_info['height_f'].'"> ~ <input id="height_t" class="txtbox" type="number" min="140" max="220" name="height-to" value="'.$this->user_info['height_t'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content edit-hide" id="city_pref1">'.$this->user_info['city_pref'].'</td>
  <td class="item-content edit-show"><input class="txtbox" type="text" id="city_pref" value="'.$this->user_info['city_pref'].'" name="city-pref"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content edit-hide" id="hometown_pref1">'.$this->user_info['hometown_pref'].'</td>
  <td class="item-content edit-show"><input class="txtbox" type="text" id="hometown_pref"  value="'.$this->user_info['hometown_pref'].'" name="hometown-pref"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content edit-hide" id="education_pref1">'.$this->user_info['education_pref'].'</td>
  <td class="item-content edit-show">
  <select name="education-pref" class="txtbox" id="education_pref" value="'.$this->user_info['education_pref'].'">
    <option value="Unlimited" selected>Unlimited</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select>
  </td>
</tr>
<tr>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide" id="job_pref1">'.$this->user_info['job_pref'].'</td>
  <td class="item-content edit-show">
  <select name="job-pref" class="txtbox" id="job_pref" value="'.$this->user_info['job_pref'].'">
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
	<option value="Law">Law</option>
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
  </select></td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide" id="income_pref1">&gt;='.$this->user_info['income_pref'].' HKD</td>
  <td class="item-content edit-show">&gt;= <input id="income_pref" class="txtbox" type="number" name="income-pref" value="'.$this->user_info['income_pref'].'"> HKD</td>
</tr>
<tr>
  <td class="item-name colored-txt">Tags:</td>
  <td class="item-content edit-hide" id="tags1">';
  $tag=$this->user_info['tags1'];
  if(count($tag)>0){
foreach($tag as $key=>$value){
		if($value!=''){
	  echo('<div class="tag-item">'.$value.'</div>');}
	}}
   echo '</td>  
   <td class="item-content edit-show">
   		<select name="tags_pref" id="selecttags1" class="selecttags" multiple="multiple" size="5"> 
    		<option value="Music">Music</option>
    		<option value="Movies">Movie</option>
    		<option value="Book">Book</option>
    		<option value="Jogging">Jogging</option>
    		<option value="Cooking">Cooking</option>
		</select> 
   </td>
</tr>
</table>
</div>
</div>
<!--looking-for-end-->

<!--my-friends-start-->
<h2 class="subheading colored-txt">FRIENDS</h2>
<div class="section-box">
<div class="section-box-content">
<!--visit-user-page-->
';if($mode==2)echo'
<button class="btn btn-mdm" type="button" onClick="add_friend()">Add as Friend</button>';
if($mode==1)echo'
<button class="btn btn-mdm" type="button" onClick="del_friend()">Delete This Friend</button>
<br>';
if($mode==4)echo'
<button class="btn btn-mdm" type="button" onClick="">Waiting for Response</button>
<br>';
if($mode==3)echo'
<button class="btn btn-mdm" type="button" onClick="window.location.replace(\'commit_friend.php?uid='.$this->user_info['user_id'].'\')">Commit This Friend</button>
<br>';
if($mode==0)echo'
<!--visit-my-page-->

'.$this->friend_info.'
';echo'
</div>
</div>
</div>
<!--my-friends-end-->
</div>
<!--container-end-->

<!--footer-start-->
<div class="footer">
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->
';}
		public function show_info($mode){
			echo
			'
			<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="'.$this->user_info['theme'].'-theme.css">
<link rel="stylesheet" type="text/CSS" href="accountmgt.css">
<title>iDating - My Page</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link href="js/jqueryUI/chosen/chosen.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/jqueryUI/chosen/chosen.jquery.js"></script>
<script>
$(document).ready(function() {
	$("#portrait").height($("#portrait").width());
	$(".friend-portrait").height($(".friend-portrait").width());
	
	//show change password dialog
    $("#change-pwd").click(function() {
		$("body").append("<div class=\'mask\'></div>");
		$(".overlay-container").show();
		$("#change-pwd-box").css("margin-top",($(".overlay-container").height()*0.95-$("#change-pwd-box").height())/2);
	    $("#change-pwd-box").slideDown();
	});
	
	//show change portrait dialog
    $("#change-portrait").click(function() {
		$("body").append("<div class=\'mask\'></div>");
		$(".overlay-container").show();
		$("#change-portrait-box").css("margin-top",($(".overlay-container").height()*0.95-$("#change-portrait-box").height())/2);
	    $("#change-portrait-box").slideDown();
	});
	
	//close a overlay
	$(".close-overlay").click(function() {
		$(this).parent().slideUp("slow", function(){$(".overlay-container").hide();$(".mask").remove();});
	});
	
	//resize
	$(window).resize(function() {
		$("#change-pwd-box").css("margin-top",($(".overlay-container").height()*0.95-$("#change-pwd-box").height())/2);
		$("#change-portrait-box").css("margin-top",($(".overlay-container").height()*0.95-$("#change-portrait-box").height())/2);
		$("#portrait").height($("#portrait").width());
		$(".friend-portrait").height($(".friend-portrait").width());
    });
	
	$("#edit-pref").click(function(){
		$(".edit-show").show();
		$(".edit-hide").hide();
	});
	
	$("#cancel-pref").click(function(){
		$(".edit-show").hide();
		$(".edit-hide").show();
	});
	
	$("#save-pref").click(function(){
		$(".edit-show").hide();
		$(".edit-hide").show();
	});
});

$(function(){
    $(".selecttags").chosen();
});

</script>
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
  <li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.php">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>  
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--container-start-->
<div class="container">
<!--my-account-start-->
<h2 class="subheading colored-txt">MY ACCOUNT</h2>
<div class="section-box">
<div class="section-box-content">
<table>
  <tr>
    <td class="item-name colored-txt">Email: </td>
    <td class="item-content" id="email">'.$this->user_info['email'].'</td>';
  if($mode==0)
  {echo '
    <td class="item-name colored-txt">Password: </td>
    <td class="item-content"><button id="change-pwd" type="button" class="btn btn-sml">Change Password</button></td>';}echo '
  </tr>';if($mode==0){echo'
  <tr>
    <td class="item-name colored-txt">Theme: </td>
	<td class="item-content edit-hide" id="theme1">'.$this->user_info['theme'].'</td>
    <td class="item-content edit-show">
	  <select name="theme" class="txtbox" id="theme">
        <option value="pink" selected>pink</option>
        <option value="blue">blue</option>
      </select>
    </td>
  </tr>';}echo'
</table>
</div>
</div>
<!--my-account-end-->
<!--about-me-start-->
<h2 class="subheading colored-txt">ABOUT ME</h2>';
if($mode==0){echo '
<button id="edit-pref" type="button" class="btn btn-sml edit-hide" onClick="click_()">Edit</button>
<button id="save-pref" type="button" class="btn btn-sml edit-show" onClick="edit()">Save</button>
<button id="cancel-pref" type="button" class="btn btn-sml edit-show">Cancel</button>
';}
echo'
<div class="section-box">
<div class="section-box-content">
<table id="portrait-intro-table">
  <tr>
    <td>
	<div id="portrait" class="background-cover-center" style="background-image:url(\'portrait/'.$this->user_info['photo'].'\')"></div>
    <button id="change-portrait" type="button" class="btn btn-sml edit-show">Change</button>
    </td>
	<td>
	<p class="edit-hide" id="self_intro1">'.$this->user_info['self_intro'].'</p>
    <textarea class="edit-show txtbox" id="self_intro">'.$this->user_info['self_intro'].'</textarea>
	</td>
  </tr>
</table>

<table>
<tr>
  <td class="item-name colored-txt">Nickname: </td>
  <td class="item-content edit-hide" id="username1">'.$this->user_info['username'].'</td>
  <td class="item-content edit-show"><input class="txtbox" id="username" type="text" name="username" required value="'.$this->user_info['username'].'"></td>
  <td class="item-name colored-txt">Gender:</td>
  <td class="item-content">'.$this->user_info['sex'].' </td>
</tr>
<tr>
  <td class="item-name colored-txt">Birthday: </td>
  <td class="item-content">'.$this->user_info['birthday'].'</td>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide" id="height1">'.$this->user_info['height'].'</td>
  <td class="item-content edit-show"><input id="height" class="txtbox" type="number" min="140" max="220"  name="height" value="'.$this->user_info['height'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content edit-hide" id="city1">'.$this->user_info['city'].'</td>
  <td class="item-content edit-show"><input id="city" class="txtbox" type="text" name="city-me" required value="'.$this->user_info['city'].'"></td>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content edit-hide" id="hometown1">'.$this->user_info['hometown'].'</td>
  <td class="item-content edit-show"><input id="hometown" class="txtbox" type="text" name="hometown-me" required value="'.$this->user_info['hometown'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content edit-hide" id="education1">'.$this->user_info['education'].'</td>
  <td class="item-content edit-show">
  <select name="education-me" class="txtbox" id="education" value="'.$this->user_info['education'].'">
    <option value="Unspecified" selected>Please Select</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select>
  </td>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide" id="job1">'.$this->user_info['job'].'</td>
  <td class="item-content edit-show">
  <select name="job-me" class="txtbox" id="job" value="'.$this->user_info['job'].'">
    <option value="Unspecified">Please Select</option>
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
	<option value="Law">Law</option>
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
  </td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide" id="income1">'.$this->user_info['income'].'HKD</td>
  <td class="item-content edit-show"><input id="income" class="txtbox" type="number" min="0" name="income-me" required value="'.$this->user_info['income'].'"> HKD</td>
  <td class="item-name colored-txt">Tags:</td>
  <td class="item-content edit-hide" id="tags">';
  $tag=$this->user_info['tags'];
  if(count($tag)>0){
	foreach($tag as $key=>$value){
		if($value!=''){
	  echo('<div class="tag-item">'.$value.'</div>');}
	}}
   echo '</td>  
   <td class="item-content edit-show">
   		<select name="tags" id="selecttags" class="selecttags" multiple="multiple" size="5"> 
    		<option value="Music">Music</option>
    		<option value="Movies">Movie</option>
    		<option value="Book">Book</option>
    		<option value="Jogging">Jogging</option>
    		<option value="Cooking">Cooking</option>
		</select> 
   </td>
</tr>
</table>
<p class="edit-show">* For security reason, gender and birthday cannot be modified after registration.</p>
</div>
</div>
<!--about-me-end-->
<!--looking-for-start-->';
echo '<h2 class="subheading colored-txt">I\'M LOOKING FOR</h2>
<div class="section-box">
<div class="section-box-content">
<table>
<tr>
  <td class="item-name colored-txt">Age: </td>
  <td class="item-content edit-hide"><span id="age_f1">'.$this->user_info['age_f'].'</span>~<span id="age_t1">'.$this->user_info['age_t'].'</span></td>
  <td class="item-content edit-show"><input id="age_f" class="txtbox" type="number" min="18" max="99" name="age-from" value="'.$this->user_info['age_f'].'"> ~ <input id="age_t" class="txtbox" type="number"  min="18" max="99"  name="age-to" value="'.$this->user_info['age_t'].'"></td>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide"><span id="height_f1">'.$this->user_info['height_f'].'</span>~<span id="height_t1">'.$this->user_info['height_t'].'</span></td>
  <td class="item-content edit-show"><input id="height_f" class="txtbox" type="number" min="140" max="220" name="height-from" value="'.$this->user_info['height_f'].'"> ~ <input id="height_t" class="txtbox" type="number" min="140" max="220" name="height-to" value="'.$this->user_info['height_t'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content edit-hide" id="city_pref1">'.$this->user_info['city_pref'].'</td>
  <td class="item-content edit-show"><input class="txtbox" type="text" id="city_pref" name="city-pref" value="'.$this->user_info['city_pref'].'"></td>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content edit-hide" id="hometown_pref1">'.$this->user_info['hometown_pref'].'</td>
  <td class="item-content edit-show"><input class="txtbox" type="text" id="hometown_pref" name="hometown-pref" value="'.$this->user_info['hometown_pref'].'"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content edit-hide" id="education_pref1">'.$this->user_info['education_pref'].'</td>
  <td class="item-content edit-show">
  <select name="education-pref" class="txtbox" id="education_pref" value="'.$this->user_info['education_pref'].'">
    <option value="Unlimited" selected>Unlimited</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select></td>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide" id="job_pref1">'.$this->user_info['job_pref'].'</td>
  <td class="item-content edit-show">
  <select name="job-pref" class="txtbox" id="job_pref" value="'.$this->user_info['job_pref'].'">
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
	<option value="Law">Law</option>
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
  </select></td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide" id="income_pref1">&gt;='.$this->user_info['income_pref'].' HKD</td>
  <td class="item-content edit-show">&gt;= <input id="income_pref" class="txtbox" type="number" name="income-pref" value="'.$this->user_info['income_pref'].'"> HKD</td>
  <td class="item-name colored-txt">Tags:</td>
  <td class="item-content edit-hide" id="tags1">';
  if(count($tag)>0){
  $tag=$this->user_info['tags1'];
foreach($tag as $key=>$value){
		if($value!=''){
	  echo('<div class="tag-item">'.$value.'</div>');}
	}}
   echo '</td>  
   <td class="item-content edit-show">
   		<select name="tags_pref" id="selecttags1" class="selecttags" multiple="multiple" size="5"> 
    		<option value="Music">Music</option>
    		<option value="Movies">Movie</option>
    		<option value="Book">Book</option>
    		<option value="Jogging">Jogging</option>
    		<option value="Cooking">Cooking</option>
		</select> 
   </td>
</tr>
</table>
</div>
</div>
<!--looking-for-end-->

<!--my-friends-start-->
<h2 class="subheading colored-txt">FRIENDS</h2>
<div class="section-box">
<div class="section-box-content">
<!--visit-user-page-->
';if($mode==2)echo'
<button class="btn btn-mdm" type="button" onClick="add_friend()">Add as Friend</button>';
if($mode==1)echo'
<button class="btn btn-mdm" type="button" onClick="del_friend()">Delete This Friend</button>
<br>';
if($mode==4)echo'
<button class="btn btn-mdm" type="button" onClick="">Waiting for Response</button>
<br>';
if($mode==3)echo'
<button class="btn btn-mdm" type="button" onClick="window.location.replace(\'commit_friend.php?uid='.$this->user_info['user_id'].'\')">Commit This Friend</button>
<br>';
if($mode==0)echo'
<!--visit-my-page-->

'.$this->friend_info.'
';echo'
</div>
</div>
</div>
<!--my-friends-end-->
</div>
<!--container-end-->

<!--footer-start-->
<div class="footer">
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->
';}}
	class UserViewController{
		public function log_up_home(){
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$temp1=file_get_contents('php://input');
				$temp=json_decode($temp1, true);
				$email=$temp['email'];
				$password=$temp['password'];
				$user=new User();
				$result=$user->has_user($email);
				if(!$result){
					$session=new Session();
					$session->set_sid(uuid());
					$user->new_user($password,$email);
					$session->set_user($user->get_uid());
					echo '{"check":"true","sid":"'.$session->get_sid().'"}';
					return;
				}
				else{
					echo '{"check":"false"}';
				}
			}
		}
		public function upload_picture(){
			if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['sid'])){
				session_id($_GET['sid']);
			}
			session_start();
			$conn=connect();
			$session=new Session();
			$user_id=$session->get_uid();
			//if($user_id==''){header('Location: index.php');}
			if(!$conn){return;}
			if(isset($_FILES['user-photo'])){ 
				$target_dir = "";
				$target_file = $target_dir.basename($_FILES['user-photo']["name"]);
				$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$check = getimagesize($_FILES["user-photo"]["tmp_name"]);
					$filename=uuid().'.'.$imageFileType;
					$target_file=$target_dir.$filename;
					$a=move_uploaded_file($_FILES["user-photo"]["tmp_name"],"portrait/".$target_file);
					$sql='UPDATE user_info SET photo="'.$filename.'" WHERE user_id="'.$user_id.'"';
					$result=mysqli_query($conn,$sql);
					return(true);
				}
			}
			return(false);
		}
		public function log_up_page(){
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$session=new Session();
				$uid=$session->get_uid();
				if($uid!=NULL){
					$user=new User();
					$user->set_user($uid);
					return($user->set_user_info($_POST));
				}
			}
			return(false);
		}
		public function show(){
			$conn=connect();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){
				header('Location: index.php',true,302);
				return;
			}
			else{
				$user=new User();
				if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['uid'])){
					$user->set_user($_GET['uid']);
					$result=$user->show_info();
					$result['tags']=$user->show_tag();
					$result['tags1']=$user->show_tag1();
					$userview=new UserView($result);
					if($_GET['uid']==$uid){
						$friend=$user->show_friends();
						$userview->show_all($friend);
						$userview->show_info(0);
					}
					else{
						$user1=new User();
						$user1->set_user($uid);
						$result=$user1->friend_sta($_GET['uid']);
						if($result==false){$userview->show_info(2);}
						else if($result['state']=='0'){$userview->show_info(3);}
						else if($result['state']=='2'){$userview->show_info(4);}
						else{$userview->show_info(1);}
					}
				}
				else{
					$user->set_user($uid);
					$result=$user->show_info();
					$result['tags']=$user->show_tag();
					$result['tags1']=$user->show_tag1();
					$userview=new UserView($result);
					$friend=$user->show_friends();
					$userview->show_all($friend);
					$userview->show_info(0);
				}
			}
		}
		public function show1(){
			$conn=connect();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){
				header('Location: index.php',true,302);
				return;
			}
			else{
				$user=new User();
				if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['uid'])){
					$user->set_user($_GET['uid']);
					$result=$user->show_info();
					$result['tags']=$user->show_tag();
					$result['tags1']=$user->show_tag1();
					$userview=new UserView($result);
					if($_GET['uid']==$uid){
						$friend=$user->show_friends();
						$userview->show_all1($friend);
						$userview->show_info_m(0);
					}
					else{
						$user1=new User();
						$user1->set_user($uid);
						$result=$user1->friend_sta($_GET['uid']);
						if($result==false){$userview->show_info_m(2);}
						else if($result['state']=='0'){$userview->show_info_m(3);}
						else if($result['state']=='2'){$userview->show_info_m(4);}
						else{$userview->show_info_m(1);}
					}
				}
				else{
					$user->set_user($uid);
					$result=$user->show_info();
					$result['tags']=$user->show_tag();
					$result['tags1']=$user->show_tag1();
					$userview=new UserView($result);
					$friend=$user->show_friends();
					$userview->show_all1($friend);
					$userview->show_info_m(0);
				}
			}
		}
	}
?>