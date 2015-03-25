<?php
	require("userview.php");
	$view=new UserViewController();
	$view->show();
?>
<!--looking-for-start-->
<h2 class="subheading colored-txt">I'M LOOKING FOR</h2>
<div class="section-box">
<div class="section-box-content">
<table>
<tr>
  <td class="item-name colored-txt">Age: </td>
  <td class="item-content edit-hide"><span id="age-from1">22</span> ~ <span id="age-to1">35</span></td>
  <td class="item-content edit-show"><input id="age-from" class="txtbox" type="number" min="18" max="99" name="age-from"> ~ <input id="age-to" class="txtbox" type="number"  min="18" max="99"  name="age-to"></td>
  <td class="item-name colored-txt">Height (cm): </td>
  <td class="item-content edit-hide"><span id="height-from1">170</span> ~ <span id="height-to1">180</span></td>
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
    <option value="Unlimited" selected>Unlimited</option>
    <option value="High School">High School</option>
    <option value="Bachelor">Bachelor</option>
    <option value="Master">Master</option>
    <option value="PhD">PhD</option>
  </select></td>
  <td class="item-name colored-txt">Occupation: </td>
  <td class="item-content edit-hide">Unlimited</td>
  <td class="item-content edit-show">
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
  <td class="item-content edit-hide">&gt;= 20000 HKD</td>
  <td class="item-content edit-show">&gt;= <input id="income-pref" class="txtbox" type="number" value="" name="income-pref"> HKD</td>
  <td class="item-name colored-txt">Tags:</td>
  <td><div class="tag-item">Romantic</div><div class="tag-item">Reliable</div></td>    
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
<button class="btn btn-mdm" type="button">Add as Friend</button>
<button class="btn btn-mdm" type="button">Delete This Friend</button>
<br>
<!--visit-my-page-->
<div class="friend-box">
<table>
  <tr>
    <td><div class="friend-portrait background-cover-center"></div></td>
    <td><h3>Frank</h3>
<p>abc@def.com</p><br><br>
<div class="friend-btns">
<button class="btn btn-sml" type="button">Send Message</button>
<button class="btn btn-sml" type="button">Delete</button>
</div>
</td>
  </tr>
</table>
</div>

<div class="friend-box">
<table>
  <tr>
    <td><div class="friend-portrait background-cover-center"></div></td>
    <td><h3>Frank</h3>
<p>abc@def.com</p><br><br>
<div class="friend-btns">
<button class="btn btn-sml" type="button">Send Message</button>
<button class="btn btn-sml" type="button">Delete</button>
</div>
</td>
  </tr>
</table>
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

<!--overlay-start-->
<div class="overlay-container">
<!--change-pwd-box-start-->
<div id="change-pwd-box" class="overlay" >
<button class="close-overlay btn" type="button" id="close">X</button>
<h2 class="colored-txt">Change Password</h2>
<form>
<input class="txtbox txtbox-fill" type="password" placeholder="Old Password" required id="old_pwd"></input><br>
<input class="txtbox txtbox-fill" type="password" placeholder="New Password" required id="new_pwd1"></input><br>
<input class="txtbox txtbox-fill" type="password" placeholder="Enter New Password Again" required id="new_pwd2"></input><br>
<input id="save-pwd" class="btn btn-fill" type="button" value="Save" onclick="change_pwd()">
</form>
<script type="application/x-javascript">
	var info=['username','height','city','hometown','education','job','income'];
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
<!--change-pwd-box-end-->
<!--change-portrait-box-start-->
<div id="change-portrait-box" class="overlay" >
<button class="close-overlay btn" type="button" id="close">X</button>
<h2 class="colored-txt">Change Portrait</h2>
<form>
<input class="txtbox txtbox-fill" type="file" required></input><br>
<br>
<input id="save-portrait" class="btn btn-fill" type="submit" value="Save">
</form>
</div>
<!--change-portrait-box-end-->
</div>
<!--overlay-end-->
</body>
</html>
<?php
$dbc=connect();
$session=new Session();
$currentid=$session->get_uid;
$q="select * from calendar where user_id='$currentid'";
$currenttime=date('Y-m-d H:i:s');
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
    $diff=round(($dat-$currenttime)/3600);
    if($diff<=1 and $diff>=0){
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
