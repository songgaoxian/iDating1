<?php
require("session.php");
session_start();
$session=new Session();
$uid=$session->get_uid();
$dbc=connect();
if(isset($_POST['dateid1'])){
	$id=(int)$_POST['dateid1'];
	$q="delete from calendar where dating_id=$id";
	$result=mysqli_query($dbc, $q);
	$mateid=$_POST['mateid1'];
	$dtime=$_POST['dat1'];
	$q1="delete from calendar where user_id='$mateid' and mate_id='$uid' and dat='$dtime'";
	$result1=mysqli_query($dbc,$q1);
	if($result and $result1)
		echo "successful delete";
	else
		echo "error";
	
}
else
echo "error";
header("refresh:1;url=calendar.php");

?>