<?php
	require("userview.php");
	$view=new UserViewController();
	$view->show();
?>

<h2 class="subheading colored-txt">I'M LOOKING FOR</h2>
<div class="section-box">
<div class="section-box-content">
<table>
<tr>
  <td class="item-name colored-txt">Age: </td>
  <td class="item-content edit-hide">22~35</td>
  <td class="item-content edit-show"><input id="age-from" class="txtbox" type="number" min="18" max="99" name="age-from"> ~ <input id="age-to" class="txtbox" type="number"  min="18" max="99"  name="age-to"></td>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide">170~180</td>
  <td class="item-content edit-show"><input id="height-from" class="txtbox" type="number" min="140" max="220" name="height-from"> ~ <input id="height-to" class="txtbox" type="number" min="140" max="220" name="height-to"></td>
</tr>
<tr>
  <td class="item-name colored-txt">City: </td>
  <td class="item-content edit-hide">Unlimited</td>
  <td class="item-content edit-show"><input class="txtbox" type="text" name="city-pref"></td>
  <td class="item-name colored-txt">Hometown: </td>
  <td class="item-content edit-hide">Unlimited</td>
  <td class="item-content edit-show"><input class="txtbox" type="text" name="hometown-pref"></td>
</tr>
<tr>
  <td class="item-name colored-txt">Education: </td>
  <td class="item-content edit-hide">Bachelor</td>
  <td class="item-content edit-show">
  <select name="education-pref" class="txtbox">
    <option value="unlimited" selected>Unlimited</option>
    <option value="bachelor">Bachelor</option>
    <option value="master">Master</option>
    <option value="phd">PhD</option>
  </select></td>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide">Unlimited</td>
  <td class="item-content edit-show">
  <select name="job-pref" class="txtbox">
  	<option value="unlimited" selected>Unlimited</option>
  </select></td>
</tr>
<tr>
  <td class="item-name colored-txt">Monthly Income: </td>
  <td class="item-content edit-hide">&gt;= 20000 HKD</td>
  <td class="item-content edit-show">&gt;= <input id="income-pref" class="txtbox" type="number" value="" name="income-pref"> HKD</td>
  <td class="item-name colored-txt">Tags:</td>
  <td><div class="tag-item">Romantic</div><div class="tag-item">Reliable</div></td>    
</tr>
</table>
</div>
</div>

<h2 class="subheading colored-txt">MY FRIENDS</h2>
<div class="section-box">
<div class="section-box-content">

</div>
</div>

</div>
<!--content-end-->

<!--footer-start-->
<div class="footer">
<a href="index.html#about-us">About Us</a>
&nbsp;|&nbsp;
<a href="index.html#contact-us">Contact Us</a>
<br><br>
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->

<div id="change-pwd-box" class="overlay" >
<button class="close-overlay btn" type="button" id="close">X</button>
<h2 class="colored-txt">Change Password</h2>
<form>
<input class="txtbox txtbox-fill" type="password" placeholder="Old Password" required id="old_pwd"></input><br>
<input class="txtbox txtbox-fill" type="password" placeholder="New Password" required id="new_pwd1"></input><br>
<input class="txtbox txtbox-fill" type="password" placeholder="Enter New Password Again" required id="new_pwd2"></input><br>
<input id="save-pwd" class="btn btn-fill" type="button" value="Save" onClick="change_pwd()">
</form>
<script type="application/x-javascript">
	var info=['self_intro','username','height','city','hometown','education','job','income'];
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
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			alert("change info success!");
			for(i=0;i<info.length;i++){
				document.getElementById(info[i]+'1').textContent=document.getElementById(info[i]).value;
			}
		}
		else{
			alert("error...");
		}
	}
</script>
<script type="application/x-javascript">
	function change_pwd(){
		var email=document.getElementById("email").textContent;
		var old_pwd=document.getElementById("old_pwd").value;
		var new_pwd=document.getElementById("new_pwd1").value;
		var new_pwd1=document.getElementById("new_pwd2").value;
		var close1=document.getElementById("close");
		if(new_pwd!=new_pwd1){alert("new passwords should match!");return;}
		else if(new_pwd.length==0 || old_pwd.length==0){alert("please enter password!")}
		else{
			xmlhttp=new XMLHttpRequest(); 
			content='{"email":"'+email+'","old":"'+old_pwd+'","new":"'+new_pwd+'"}';
			xmlhttp.open("POST","change_pwd.php",false);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(content);console.log(xmlhttp);
			record=xmlhttp;
			response=JSON.parse(xmlhttp.response);
			if(response['check']=='true'){
				alert("change password success!");
			}
			else{
				alert("old password wrong!");
			}
		}
		close1.click();
	}
</script>
</div>
</body>
</html>
<?php
$dbc=connect();
session_start();
$session=new Session();
$currentid=$session->get_uid;
$q="select * from calendar where user_id='$currentid'";
$currenttime=date('Y-m-d H:i:s');
$q1="delete from calendar where dat<'$currenttime'";
mysqli_query($dbc, $q1);
$i=0;
$result=mysqli_query($dbc, $q);
$dmateid=array();
$dtime=array();
$dlocation=array();
$dmatename=array();
if(!empty($result)){
	$i=0;
	while($row=mysqli_fetch_array($result)){
    $dat=$row['dat'];
    $diff=round(abs($currenttime-$dat)/3600);
    if($diff<=1){
     $dmateid[$i]=$row['mate_id'];
     $temp=$dmateid[$i];
     $dtime[$i]=$row['dat'];
     $dlocation[$i]=$row['location'];
     $q2="select username from user_info where user_id='$temp'";
     $result1=mysqli_query($dbc, $q2);
     $row=mysqli_fetch_array($result1);
     $dmatename[$i]=$row['username'];
     $i++;
    }
  }
  if($i!==0){
  	echo "<script>alert('";
  	for($j=0; $j<$i; $j++){
  		$tempname=$dmatename[$j];
  		$templo=$dlocation[$j];
  		$tempti=$dtime[$j];
  		echo "You have a date with $tempname at $tempti in $templo ! \n";
  	}
  	echo "')";
  }
}
?>
