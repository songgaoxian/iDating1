<?php
	require("moment.php");
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($_SERVER["REQUEST_METHOD"]=="POST" && $uid!=NULL){
		$temp1=file_get_contents('php://input');
		$temp=json_decode($temp1, true);
		$conn=connect();
		$pic=new Picture();
		$pic->set_id($temp['pic_id']);
		$temp=$pic->show_info();
		$send='{"check":"true"';
		if(!$conn){echo '{"check":"false"}';return;}
		foreach($temp as $key=>$value){
			$send.=',"'.$key.'":"'.$value.'"';
		}
		$send.='}';
		echo $send;
	}
?>