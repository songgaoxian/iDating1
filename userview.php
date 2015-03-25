<?php
	require("session.php");
	class UserView{
		private $user_info;
		public function __construct($info){
			$this->user_info=array();
			foreach($info as $key=>$value){
				$this->user_info[$key]=$value;
			}
		}
		public function show_info($mode){
			echo
			'
			<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="accountmgt.css">
<title>iDating - My Account</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$("#portrait").height($("#portrait").width());
	
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
  </tr>
  <tr>
    <td class="item-name colored-txt">Theme: </td>
    <td class="item-content">
	  <select name="theme" class="txtbox" id="theme">
        <option value="Pink" selected>Pink</option>
        <option value="Blue">Blue</option>
      </select>
    </td>
  </tr>
</table>
</div>
</div>
<!--my-account-end-->
<!--about-me-start-->
<h2 class="subheading colored-txt">ABOUT ME</h2>';
if($mode==0){echo '
<button id="edit-pref" type="button" class="btn btn-sml edit-hide">Edit</button>
<button id="save-pref" type="button" class="btn btn-sml edit-show" onClick="edit()">Save</button>
<button id="cancel-pref" type="button" class="btn btn-sml edit-show">Cancel</button>
';}
echo'
<div class="section-box">
<div class="section-box-content">
<div id="portrait-box">
<div id="portrait" style="background:url(portrait/'.$this->user_info['photo'].');background-size:cover;border-radius:5px;width:100%;"></div>
<button id="change-portrait" type="button" class="btn btn-sml edit-show">Change</button>
</div>

<div id="self-intro-box">
<p class="edit-hide" id="self_intro1">'.$this->user_info['self_intro'].'</p>
<textarea class="txtbox edit-show" id="self_intro">'.$this->user_info['self_intro'].'</textarea>
</div>

<table>
<tr>
  <td class="item-name colored-txt">username: </td>
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
  <td class="item-content edit-show"><input id="height" class="txtbox" type="number" min="140" max="220"  name="height"value="'.$this->user_info['height'].'"></td>
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
  <select name="education-me" class="txtbox" id="education">
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
  <select name="job-me" class="txtbox" id="job">
    <option value="Unspecified" selected>Please Select</option>
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
  </td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide" id="income1">'.$this->user_info['income'].'HKD</td>
  <td class="item-content edit-show"><input id="income" class="txtbox" type="number" min="0" name="income-me" required value="'.$this->user_info['income'].'"> HKD</td>
  <td class="item-name colored-txt">Tags:</td>
  <td><div class="tag-item">';
  $tag=$this->user_info['tags'];
	foreach($tag as $key=>$value){
	  echo('<div>'.$value.'</div>');
	}
   echo '</div></td>  
</tr>
</table>
<p class="edit-show">* For security reason, gender and birthday cannot be modified after registration.</p>
</div>
</div><!--about-me-end-->';}}
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
			$conn=connect();
			$session=new Session();
			$user_id=$session->get_uid();
			//if($user_id==''){header('Location: index.html');}
			if(!$conn){return;}
			if(isset($_FILES['user-photo'])){
				$target_file = $target_dir.basename($_FILES["user-photo"]["name"]);
				$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
				if($_SERVER["REQUEST_METHOD"]=="POST"){
					$check = getimagesize($_FILES["user-photo"]["tmp_name"]);
					$filename=uuid().'.'.$imageFileType;
					$target_file=$target_dir.$filename;
					$a=move_uploaded_file($_FILES["user-photo"]["tmp_name"],"portrait/".$target_file);
					$sql='UPDATE user_info SET photo="'.$target_file.'" WHERE user_id="'.$user_id.'"';
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
			if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['sid'])){
				session_id($_GET['sid']);
			}
			session_start();
			$session=new Session();
			$uid=$session->get_uid();
			if($uid==NULL){
				header('Location: index.html',true,302);
				return;
			}
			else{
				$user=new User();
				if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['uid'])){
					$user->set_user($_GET['uid']);
					$userview=new UserView($user->show_info());
					if($_GET['uid']==$uid){$userview->show_info(0);}
					else{$userview->show_info(1);}
				}
				else{
					$user->set_user($uid);
					$userview=new UserView($user->show_info());
					$userview->show_info(0);
				}
			}
		}
	}
?>