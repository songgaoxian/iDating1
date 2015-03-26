<?php
	require('userview.php');
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($uid!=''){
		$user=new User();
		$user->set_user($uid);
		if($_SERVER["REQUEST_METHOD"]=="GET" && $uid!=NULL){
			$conn=connect();
			$uid1=$_GET['uid'];
			$result=$user->commit_friend($uid1);
			header('Location: accountmgt.php');
		}
	}
?>