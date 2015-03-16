<?php
	require("session.php");
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$temp1=file_get_contents('php://input');
		$temp=json_decode($temp1, true);
		$email=$temp['email'];
		$old_pwd=$temp['old'];
		$new_pwd=$temp['new'];
		$user=new User();
		$result=$user->sign_in($email,$old_pwd);
		if($result){
			$temp=array();
			$temp['password']=$new_pwd;
			$user->set_user_info($temp);
			echo '{"check":"true"}';
			return;
		}
		else{
			echo '{"check":"false"}';
		}
	}
?>