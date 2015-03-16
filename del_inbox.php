<?php
	require("inbox.php");
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($_SERVER["REQUEST_METHOD"]=="POST" && $uid!=NULL){
		$temp1=file_get_contents('php://input');
		$temp=json_decode($temp1, true);
		$conn=connect();
		if(!$conn){echo '{"check":"false"}';return;}
		foreach($temp as $key=>$value){
			$sql='DELETE FROM inbox WHERE user_id="'.$uid.'" AND with_id="'.$value.'";';
			$result=mysqli_query($conn,$sql);
			if(!$result){echo '{"check":"false"}';return;}
		}
		echo '{"check":"true"}';
	}
?>