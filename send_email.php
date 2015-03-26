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
			$result=$user->is_friend($uid1);
			if($result){echo '{"check":"true"}';return;}
			else{
				echo '{"check":"true","email":"';
				$user1=new User();
				$user1->set_user($uid1);
				$a=$user1->show_info();
				echo $a['email'];
				echo '"}';
				return;
			}
		}
	}
?>