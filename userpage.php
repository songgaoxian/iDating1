<?php
session_start();
require("session.php");

$session=new Session();
$myuid=$session->get_uid();
$dbc=connect();
$q="select username, email from user_info where user_id='$myuid'";
$result=mysqli_query($dbc,$q);
$row=mysqli_fetch_array($result);
$myname=$row['username'];
$myemail=$row['email'];
if(isset($_GET['userid']) and isset($_GET['order'])){
	$order=$_GET['order'];
	$_SESSION['order']=$order;
}
else{
	$order=$_SESSION['order'];	
}
$userid=$_SESSION['userid'][$order];
$username=$_SESSION['sname'][$order];
	$photo=$_SESSION['sphoto'][$order];
	$birthday=$_SESSION['birthday'][$order];
	$sex=$_SESSION['sex'][$order];
	$selfintro=$_SESSION['selfintro'][$order];
	$hometown=$_SESSION['hometown'][$order];
	$height=$_SESSION['height'][$order];
	$city=$_SESSION['city'][$order];
	$job=$_SESSION['job'][$order];
	$income=$_SESSION['income'][$order];
	$education=$_SESSION['education'][$order];
if(isset($_POST['msg'])){
	$to=$_SESSION['email'][$order];
	$msg=$_POST['msg'];
	$subject="message from $myname";
	$header="From: $myemail";
	mail($to,$subject,$msg,$header);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="accountmgt.css">
<link rel="stylesheet" type="text/CSS" href="registration.css">
<title>iDating - User Page</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<!--header-start-->
<div class="header">
<ul id="topnav"><li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.php">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>
  
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<h2 class="subheading colored-txt"><?php echo "$username &nbsp homepage";?> </h2>
<div class="section-box">
<div class="section-box-content">
<div id="portrait">
<?php
echo "<img src='portrait/$photo' alt='$username &nbsp Portrait'>";
?>
</div>
<?php
echo "<p>$selfintro</p>";
?>
<table>
<tr>
  <td class="item-name colored-txt">username: </td>
  <td class="item-content edit-hide" id="username1"><?php echo "$username";?></td>
  <td class="item-name colored-txt">Gender:</td>
  <td class="item-content"><?php echo "$sex"; ?></td>
</tr>
<tr>
  <td class="item-name colored-txt">Birthday: </td>
  <td class="item-content"><?php echo "$birthday"; ?></td>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide" id="height1"><?php echo $height; ?></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content edit-hide" id="city1"><?php echo $city;?></td>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content edit-hide" id="hometown1"><?php echo $hometown; ?></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content edit-hide" id="education1"><?php echo $education;?></td>
  <td class="item-content edit-show">
  <?php echo $education;?>
  </td>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide" id="job1"><?php echo $job;?></td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide" id="income1"><?php echo $income;?></td>
  <td class="item-name colored-txt">Tags:</td></tr>
  <tr>
  <td class="item-name colored-txt">Message
  <form method="post" action="userpage.php">
  <input type="text" name="msg" placeholder="You can send a message"><br>
  <input type="submit" value="Submit"> 
  </form>
  </td>
</tr>
</table>

</div>
</div>';
</div>