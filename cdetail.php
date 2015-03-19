<?php
  require("user.php");
$dbc=connect();
if(isset($_POST['D'])){
	$datid=$_POST['D'];
    $q="select * from calendar where dating_id=$datid";
  
   $result=mysqli_query($dbc, $q);
    $row=mysqli_fetch_array($result);
    $back=array();
    $mateid=$row['mate_id'];
    $q1="select username from user_info where user_id='$mateid'";
    $result1=mysqli_query($dbc, $q1);
    $row1=mysqli_fetch_array($result1);
    $back[0]=$row1['username'];
    $back[1]=$row['dat'];
    $back[2]=$row['content'];
    $back[3]=$row['location'];
    $back[4]=$datid;
    $back[5]=$mateid;
    header('Content-Type: application/json');
    echo json_encode($back);
}
?>