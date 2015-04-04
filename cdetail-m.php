<?php
require("session.php");
session_start();
$session=new Session();
$uid=$session->get_uid();
$dbc=connect();
if(isset($_POST['day']) and isset($_POST['month'])){
	$day=(int)$_POST['day'];
	$month=(int)$_POST['month'];
	if($day<10)
		$sday="0$day";
	else
		$sday=(string)$day;
	if($month<10)
		$smonth="0$month";
	else
		$smonth=(string)$month;
	$start="2015-$smonth-$sday";
	$end="2015-$smonth-$sday 24:00:00";
	$q="select * from calendar where user_id='$uid' and dat>='$start' and dat<='$end'";
	$result=mysqli_query($dbc, $q);
	$i=0;
	$back=array();
	if($result)
		while($row=mysqli_fetch_array($result)){
			$back[$i]=array();
			$back[$i]['dateid']=$row['dating_id'];
			$back[$i]['mateid']=$row['mate_id'];
			$back[$i]['time']=$row['dat'];
			$back[$i]['location']=$row['location'];
			$temp=$row['mate_id'];
			$q1="select username from user_info where user_id='$temp'";
			$result1=mysqli_query($dbc,$q1);
			$row1=mysqli_fetch_array($result1);
            $back[$i]['matename']=$row1['username'];
            $i++;
		}
    header('Content-Type: application/json');
    echo json_encode($back);
}
?>