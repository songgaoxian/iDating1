<?php
	require("userview.php");
	$user=new UserViewController();
	$user->upload_picture();
	$user->show1();
?>

<!--overlay-start-->
<!--change-pwd-box-start-->
<div id="change-pwd-box" class="overlay" >
<div class="header">
<img class="close-overlay" src="img/close_overlay.png" alt="back">
<h1>Change Password</h1>
</div>
<div class="overlay-content">
<form>
<input class="txtbox txtbox-fill" type="password" placeholder="Old Password" required id="old_pwd"></input><br>
<input class="txtbox txtbox-fill" type="password" placeholder="New Password" required id="new_pwd1"></input><br>
<input class="txtbox txtbox-fill" type="password" placeholder="Enter New Password Again" required id="new_pwd2"></input><br>
<input id="save-pwd" class="btn btn-fill" type="button" value="Save" onclick="change_pwd()">
</form>
<script>
	function select_(value,children){
		var i=0;
		while(i<children.length){
			if(children[i].value==value){children[i].selected=true;}
			i=i+1;
		}
	}
	var list=['education','job','education_pref','job_pref','theme'];
	function selection(){
		var j=0;
		while(j<list.length){
			var temp1=document.getElementById(list[j]+'1');
			var temp2=document.getElementById(list[j]);
			temp1=temp1.textContent;
			console.log(temp1);
			temp2=temp2.children;
			select_(temp1,temp2);
			j+=1;
		}
	}
	selection();
</script>
<script type="application/x-javascript">
	var info=['username','height','city','hometown','education','job','income','self_intro','height_f','height_t','age_f','age_t','city_pref','hometown_pref','job_pref','education_pref','income_pref','theme'];
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
		if(true){
			for(i=0;i<info.length;i++){
				console.log(info[i]+'1');
				document.getElementById(info[i]+'1').textContent=document.getElementById(info[i]).value;
			}
		}
		else{
			alert("error..."); return;
		}
		
		content='{"';
		var temp=document.getElementsByClassName('chzn-choices')[0].children;
		var record1=[];
		if(temp.length>0){
			content+=temp[0].textContent+'":"'+temp[0].textContent+'"';
			record1[0]=temp[0].textContent;
		}
		for(i=1;i<temp.length;i++){
			content+=',"'+temp[i].textContent+'":"'+temp[i].textContent+'"';
			record1[i]=temp[i].textContent;
		}
		console.log(record);
		content+='}';
		xmlhttp=new XMLHttpRequest(); 
		xmlhttp.open("POST","change_tag.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		response=JSON.parse(xmlhttp.response);
		content='{"';
		var temp=document.getElementsByClassName('chzn-choices')[1].children;
		var record2=[];
		if(temp.length>0){
			content+=temp[0].textContent+'":"'+temp[0].textContent+'"';
			record2[0]=temp[0].textContent;
		}
		for(i=1;i<temp.length;i++){
			content+=',"'+temp[i].textContent+'":"'+temp[i].textContent+'"';
			record2[i]=temp[i].textContent;
		}
		content+='}';
		xmlhttp=new XMLHttpRequest(); 
		xmlhttp.open("POST","change_tag1.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);
		record=xmlhttp;
		if(true){
			alert("change info success!");
			var tags=document.getElementById('tags');
			var temp1=tags.children;
			while(temp1.length>0){
				tags.removeChild(temp1[0]);
				tags=document.getElementById('tags');
				console.log(tags);
				temp1=tags.children;
			}
			var i=0;
			var temp2=document.getElementsByClassName('chzn-choices')[0];
			console.log(record1);
			tags=document.getElementById('tags');
			while(i<record1.length){
				if(record1[i]!=''){
				var temp1=document.createElement('div');
				temp1.setAttribute('class',"tag-item");
				temp1.textContent=record1[i];
				console.log(record1[i]);
				tags.appendChild(temp1);
				}i++;
			}
			
			
			var tags=document.getElementById('tags1');
			var temp1=tags.children;
			while(temp1.length>0){
				tags.removeChild(temp1[0]);
				tags=document.getElementById('tags1');
				console.log(tags);
				temp1=tags.children;
			}
			var i=0;
			var temp2=document.getElementsByClassName('chzn-choices')[1];
			console.log(record1);
			tags=document.getElementById('tags1');
			while(i<record2.length){
				if(record2[i]!=''){
				var temp1=document.createElement('div');
				temp1.setAttribute('class',"tag-item");
				temp1.textContent=record2[i];
				console.log(record2[i]);
				tags.appendChild(temp1);
				}i++;
			}
			console.log(tags);
			window.location.replace('accountmgt.php');
		}
		else{
			alert("error...");
		}
	}
</script>
<script type="application/x-javascript">
	var url=document.URL;
	var uid=url.split('?uid=');
	if(uid.length>1){uid=uid[1];}
	function del_friend(){
		xmlhttp=new XMLHttpRequest(); 
		content='{"user_id2":"'+uid+'"}';
		xmlhttp.open("POST","del_friend.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		response=JSON.parse(xmlhttp.response);
		temp=confirm("Are you sure to delete this friend?");
		if(temp==false){return;}
		if(response['check']=='true'){
			alert("Delete!");
		}
		else{
			alert("...?");
		}
		window.location.replace(url);
	}
	function add_friend(){
		xmlhttp=new XMLHttpRequest(); 
		content='{"user_id2":"'+uid+'"}';
		xmlhttp.open("POST","add_friend.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			alert("Request has been sent!");
		}
		else{
			alert("...?");
		}
		//window.location.replace(url);
	}
	function send_email(uid){
		xmlhttp=new XMLHttpRequest(); 
		content='{"user_id2":"'+uid+'"}';
		xmlhttp.open("POST","send_email.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='false'){
			window.location.replace('new_msg?email='+response['email']);
		}
		else{
			window.location.replace('read_msg.php?with='+uid);
		}
	}
	function delete_friend(uid1){
		xmlhttp=new XMLHttpRequest(); 
		content='{"user_id2":"'+uid1+'"}';
		xmlhttp.open("POST","del_friend.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			alert("Delete!");
		}
		else{
			alert("...?");
		}
		window.location.replace(url);
	}
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
</div>
<!--change-pwd-box-end-->
<!--change-portrait-box-start-->
<div id="change-portrait-box" class="overlay" >
<div class="header">
<img class="close-overlay" src="img/close_overlay.png" alt="back">
<h1>Change Portrait</h1>
</div>
<div class="overlay-content">
<form>
<input class="txtbox txtbox-fill" type="file" required></input><br>
<br>
<input id="save-portrait" class="btn btn-fill" type="submit" value="Save">
</form>
</div>
</div>
<!--change-portrait-box-end-->
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
