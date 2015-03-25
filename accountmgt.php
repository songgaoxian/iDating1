<?php
	require("userview.php");
	$user=new UserViewController();
	$user->upload_picture();
	$user->show();
?>
<!--looking-for-start-->

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
	var info=['username','height','city','hometown','education','job','income','self_intro','height_f','height_t','age_f','age_t','city_pref','hometown_pref','job_pref','education_pref','income_pref'];
	function edit(){	
		i=0;
		content='{"';
		content+=info[0]+'":"'+document.getElementById(info[0]).value+'"';
		for(i=1;i<info.length;i++){
			console.log(info[i]);
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
				console.log(info[i]+'1');
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
<form action="accountmgt.php" enctype="multipart/form-data" method="post">
<input class="txtbox txtbox-fill" type="file" required name="user-photo"></input><br>
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
$currentid=$session->get_uid();
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
