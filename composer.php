<?php
require("session.php");
$dbc=connect();
if(!empty($_POST['mate']) and !empty($_POST['times']) and !empty($_POST['location'])){
	$session=new Session();
	$uid=$session->get_uid;
	$mateemail=$_POST['mate'];
	$dat=$_POST['times'];
	$location=$_POST['location'];
	$content=$_POST['content'];
	$q="select user_id from user_info where email='$mateemail'";
	$result=mysqli_query($dbc, $q);
	if(!$result){
		$row=mysqli_fetch_array($result);
		$mateid=$row['user_id'];
	
	$q1="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$uid', '$mate', '$dat', '$content','$location')";
	$q2="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$mate', '$uid', '$dat', '$content', '$location')";
	if(mysqli_query($dbc, $q1) and mysqli_query($dbc, $q2))
		echo "<script>alert('Date event is successfully created');</script>";
	else
		echo "<script>alert('error')</script>";}
	else
		echo "error";
}
header("refresh:1; url=calendar.php");
?>