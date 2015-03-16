<?php
	require("inbox.php");
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($_SERVER["REQUEST_METHOD"]=="POST" && $uid!=NULL){
		$temp1=file_get_contents('php://input');
		$temp=json_decode($temp1, true);
		$conn=connect();
		$inbox=new Inbox($uid);
		if(!$conn){echo '{"check":"false"}';return;}
		foreach($temp as $key=>$value){
			$result=$inbox->read_chat($value);
			if(!$result){echo '{"check":"false"}';return;}
		}
		echo '{"check":"true"}';
	}
?>