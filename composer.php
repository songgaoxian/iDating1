<?php
require("session.php");
session_start();
$dbc=connect();
if(!empty($_POST['mate']) and !empty($_POST['times']) and !empty($_POST['location'])){
	$session=new Session();
	$uid=$session->get_uid();
	$day=(int)$_POST['day'];
    if($day==0){
    	echo "<script>alert('invalid date')</script>";
    	heaer("refresh:0; url=calendar.php");
    }
    $month=(int)$_POST['month'];
    if($month<10)
    	$month="0$month";
    if($day<10)
    	$day="0$day";
	$mateemail=$_POST['mate'];
	$time=$_POST['times'];
    $dat="2015-$month-$day $time";
	$location=$_POST['location'];
	$content=$_POST['content'];
	$q="select user_id from user_info where email='$mateemail'";
	$result=mysqli_query($dbc, $q);
	if($result){
		$row=mysqli_fetch_array($result);
		$mateid=$row['user_id'];
	$q1="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$uid', '$mateid', '$dat', '$content','$location')";
	$q2="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$mateid', '$uid', '$dat', '$content', '$location')";
	if(mysqli_query($dbc, $q1) and mysqli_query($dbc, $q2))
		echo "<script>alert('Date event is successfully created');</script>";
	else
		echo "<script>alert('error')</script>";}
	else
	{
		echo "error";
	}
}
if(isset($month))
header("refresh:1; url=calendar.php?month=$month");
else
header("refresh:1; url=calendar.php");
?>