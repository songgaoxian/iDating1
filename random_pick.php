<?php
	require("session.php");
	class LotView{
		public function show_info($info,$user){}
	}
	class LotViewController{
		public function generate_info(){
			$session=new Session();
			$user_id=$session->get_uid();
			if($user_id==NULL){header('Location:'.'index.html');return;}
			else{
				$conn=connect();
				if(!$conn){header('Location:'.'index.html');return;}
				$sql='SELECT * FROM user_id WHERE user_id<>"'.$user_id.'" ORDER BY RAND() LIMIT 1;';
				$result=mysqli_query($conn,$sql);
				$row = mysqli_fetch_assoc($result);
				$rand_user=$row['user_id'];
				$sql='SELECT * FROM draw ORDER BY RAND() LIMIT 1;';
				$result=mysqli_query($conn,$sql);
				$row = mysqli_fetch_assoc($result);
				$rand_draw=$row;
				mysqli_close($conn);
				$lotview=new LotView();
				$lotview->show_info($rand_draw,$rand_user);
			}
		}
	}
?>