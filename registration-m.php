<?php
	if($_SERVER["REQUEST_METHOD"]=="GET");
	session_id($_GET['sid']);
	session_start();
	require("userview.php");
	$user=new UserViewController();
	$result=$user->upload_picture();
	if($result){header("Location: accountmgt.php");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="registration-m.css">
<title>iDating - Sign Up</title>
</head>

<body>
<!--header-start-->
<div class="header">
<img src="img/logo_small.png" alt="iDating logo">
<h1>Sign Up</h1>
</div>
<!--header-end-->

<!--container-start-->
<div class="container">
<form method="post" enctype="multipart/form-data">
<!--about-me-start-->
<h2 class="subheading colored-txt">ABOUT ME</h2>
<div class="section-box">
<div class="section-box-content">
<label class="colored-txt">Portrait:</label><br>
<input class="txtbox txtbox-fill" type="file" name="user-photo">
<br><br>
<label class="colored-txt">Self Description:</label><br>
<textarea  class="txtbox txtbox-fill" placeholder="What I what others to know..." id="self_intro"></textarea>

<table>
<tr>
  <td class="item-name colored-txt">Nickname: </td>
  <td class="item-content"><input class="txtbox" type="text" name="nickname" required id="username"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Gender: </td>
  <td class="item-content"><input type="radio" name="sex">Male&nbsp;<input type="radio" id="sex" name="sex">Female</td>
</tr>
<tr>
  <td class="item-name colored-txt">Birthday: </td>
  <td class="item-content"><input class="txtbox" type="date" name="bday"  id="birthday"></td>
</tr>
<tr>
<td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content"><input class="txtbox" type="number" min="140" max="220" id="height" name="height"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content"><input class="txtbox" type="text" name="city-me" required id="city"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content"><input class="txtbox" type="text" name="hometown-me" required id="hometown"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content">
  <select name="education-me" class="txtbox" id="education">
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
  <td class="item-content">
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
  <td class="item-content"><input class="txtbox" id="income-me" type="number" min="0" name="income-me" required> HKD</td>
</tr>
<tr>
  <td class="item-name colored-txt">Tags:</td>
  <td><div class="tag-item">Humorous</div></td>  
</tr>
</table>
</div>
</div>
<!--about-me-end-->
<!--looking-for-start-->
<h2 class="subheading colored-txt">I'M LOOKING FOR</h2>
<div class="section-box">
<div class="section-box-content">
<table>
<tr>
  <td class="item-name colored-txt">Age: </td>
  <td class="item-content"><input id="age-from" class="txtbox" type="number" min="18" max="99" name="age-from"> ~ <input id="age-to" class="txtbox" type="number"  min="18" max="99" name="age-to"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Height: </td>
  <td class="item-content"><input id="height-from" class="txtbox" type="number" min="140" max="220" name="height-from"> ~ <input id="height-to" class="txtbox" type="number" min="140" max="220" name="height-to"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content"><input class="txtbox" type="text" name="city-pref"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content"><input class="txtbox" type="text" name="hometown-pref"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content">
  <select name="education-pref" class="txtbox">
    <option value="Unlimited" selected>Unlimited</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select></td>
</tr>
<tr>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content">
  <select name="job-pref" class="txtbox">
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
  </select></td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content">&gt;= <input id="income-pref" class="txtbox" type="number" value="" name="income-pref"> HKD</td>
</tr>
<tr>
  <td class="item-name colored-txt">Tags:</td>
  <td><div class="tag-item">Romantic</div><div class="tag-item">Reliable</div></td>    
</tr>
</table>
</div>

<input id="submit-now" class="btn" type="button" value="Submit" onClick="edit()">
</div>
<!--looking-for-end-->
</form>
</div>
<script type="application/x-javascript">
	var info=['username','height','city','hometown','education','job','income','sex','birthday','self_intro'];
	function edit(){	
		i=0;
		content='{"';
		content+=info[0]+'":"'+document.getElementById(info[0]).value+'"';
		for(i=1;i<info.length;i++){
			content+=',"'+info[i]+'":"'+document.getElementById(info[i]).value+'"';
		}
		content+='}';
		xmlhttp=new XMLHttpRequest(); 
		xmlhttp.open("POST","change_info.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		console.log(record);
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			a=document.getElementsByTagName("form")[0];
			a.submit();
		}
		else{
			alert("error...");
		}
	}
</script>
<!--container-end-->
<!--footer-start-->
<div>
<p id="footer">&copy; 2015 All Rights Reserved.</p>
</div>
<!--footer-end-->
</body>
</html>