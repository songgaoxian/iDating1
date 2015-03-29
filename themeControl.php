<?php
session_start();
require("session.php");
class theme{
public function getTheme(){
$dbc=connect();
$session=new Session();
$uid=$session->get_uid();
$q="select theme from user_info where user_id='$uid'";
$result=mysqli_query($dbc,$q);
if($result){
$result=mysqli_query($dbc,$q);
$row=mysqli_fetch_array($result);
$theme=$row['theme'];
return $theme;
}
else
	return "pink";
}
}
?>