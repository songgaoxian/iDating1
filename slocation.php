<?php
require("session.php");
session_start();
			$dbc=connect();
			$session=new Session();
			$userid=$session->get_uid();
if(isset($_POST['latitude']) and isset($_POST['longitude'])){
	$back=array();
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	$q="select * from user_location where user_id='$userid'";
	$result=mysqli_query($dbc, $q);
	if(!$row=mysqli_fetch_array($result)){
		$q1="insert into user_location
		     values('$userid','$latitude','$longitude')";
		 $result1=mysqli_query($dbc,$q1);
	}
	else{
		$q1="update user_location set latitude='$latitude', longitude='$longitude' where user_id='$userid'";
		$result1=mysqli_query($dbc,$q1);
	}
	if($result1){
		$back[0]="success1";
		header('Content-Type: application/json');
		echo json_encode($q1);
	}
	else {
		$back[0]="error";
		header('Content-Type: application/json');
		echo json_encode($q1);
	}
}

?>