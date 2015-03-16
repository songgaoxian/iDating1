<?php
	require("message.php");
	session_start();
	$session=new Session();
	$uid=$session->get_uid();
	if($_SERVER["REQUEST_METHOD"]=="POST" && $uid!=NULL){
		$temp1=file_get_contents('php://input');
		$temp=json_decode($temp1, true);
		$conn=connect();
		if(!$conn){echo '{"check":"false"}';return;}
		if(isset($temp['with_id']) && $temp['with_id']!=''){
			$msg=new Message($uid,$temp['with_id']);
			$result=$msg->send($temp['content']);
			if($result){
				$inbox=new Inbox($uid);
				$info=array();
				$info['preview']=$temp['content'].substr(0,100);
				$info['with_id']=$temp['with_id'];
				$result=$inbox->new_inbox($info);
				if($result){echo '{"check":"true"}';return;}
				echo '{"check":"false"}';return;
			}
			else{echo '{"check":"false"}';}
			return;
		}
		else if(isset($temp['email']) && $temp['email']!=''){
			$user=new User();
			if($user->has_user($temp['email'])){
				$msg=new Message($uid,$user->get_uid());
				$content=array();
				$result=$msg->send($temp['content']);
				if($result){
					$inbox=new Inbox($uid);
					$info=array();
					$info['preview']=$temp['content'].substr(0,100);
					$info['with_id']=$user->get_uid();
					$result=$inbox->new_inbox($info);
					if($result){echo '{"check":"true"}';return;}
					echo '{"check":"false"}';return;
			}
				else{echo '{"check":"false"}';}
				return;
			}
			else{echo '{"check":"false"}';}
			return;
		}
		else{echo '{"check":"false"}';}
	}
?>