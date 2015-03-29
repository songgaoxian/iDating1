<?php
	require("userview.php");
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($_SERVER["REQUEST_METHOD"]=="POST" && $uid!=NULL){
		$temp1=file_get_contents('php://input');
		$temp=json_decode($temp1, true);
		$user=new User();
		$user->set_user($uid);
		$result=$user->set_tag($temp);
		if($result){
			echo '{"check":"true"}';
			return;
		}
		else{
			echo '{"check":"false"}';
			return;
		}
	}
	echo 'Unexpected!';
?>