<?php
	require('userview.php');
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($uid!=''){
		$user=new User();
		$user->set_user($uid);
		if($_SERVER["REQUEST_METHOD"]=="POST" && $uid!=NULL){
			$temp1=file_get_contents('php://input');
			$temp=json_decode($temp1, true);
			$conn=connect();
			$uid1=$temp['user_id2'];
			$result=$user->is_friend1($uid1);
			if($result==true){echo '{"check":"true"}';return;}
			else{
				$result=$user->add_friend($uid1);
				if($result){echo '{"check":"true","uid":"'.$uid.'"}';return;}
				else{echo '{"check":"false"}';return;}
			}
		}
	}
?>