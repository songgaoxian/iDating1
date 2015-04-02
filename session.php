<?php
	require("user.php");
	class Session{
		private $session_id;
		private $user_id;
		public function __construct(){
			$this->session_id=session_id();
			if($this->session_id==''){$this->session_id=uuid();}
		}
		public function get_sid(){return($this->session_id);}
		public function get_uid(){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM session WHERE sid="'.$this->session_id.'";';
				$result=mysqli_query($conn,$sql);
				//echo $sql;
				if(mysqli_num_rows($result)>0){
					$uid=mysqli_fetch_array($result);
					mysqli_close($conn);
					return($uid['user_id']);
				}
			}
			return(NULL);
		}
		public function set_sid($sid){$this->session_id=$sid;}
		public function expire(){
		   $conn=connect();
		   if($conn){
				$sql='DELETE FROM session WHERE user_id="'.$uid.'";';
				$result=mysqli_query($conn,$sql);
				if($result){session_destroy();}
				mysqli_close($conn);
			}
 		   header('Location: index.html');
		}
		public function set_user($uid){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM session WHERE user_id="'.$uid.'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$sql='DELETE FROM session WHERE user_id="'.$uid.'";';
					mysqli_query($conn,$sql);
				}
				$sql='INSERT INTO session(user_id,sid) VALUES ("'.$uid.'","'.$this->session_id.'");';
				$result=mysqli_query($conn,$sql);
				if($result==true){
					$this->user_id=$uid;
					mysqli_close($conn);
					return(true);
				}
				mysqli_close($conn);
				return(false);
			}
			else{return(false);}
		}
	}
	
	class SessionController{
		public function create_session($uid){
			$conn=connect();
			if($conn){
				if(isset($_SESSION['sid'])){
					$sql='DELECT FROM session WHERE sid="'.$_SESSION['sid'].'";';
					$mysqli_query($conn,$sql);
				}
				$session=new Session();
				$result=$session->set_user($uid);
			}
			else{
			}
		}
		public function get_user(){
			$conn=connect();
			if($conn){
				if(isset($_SESSION['sid'])){
					$sql='SELECT * FROM session WHERE sid="'.$_SESSION['sid'].'";';
					$result=mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)>0){
						$row=mysqli_fetch_array($result);
						return($row['user_id']);
					}
				}
			}
			return(NULL);
		}
		public function log_out(){
			if(isset($_SESSION['sid'])){
				$session=new Session();
				$session->expire();
			}
		}
		public function log_in(){
			$email="xingyue.kelly@gmail.com";
			$password="1155014329";
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$temp1=file_get_contents('php://input');
				$temp=json_decode($temp1, true);
				$email=$temp['email'];
				$password=$temp['password'];
			}
			$user=new User();
			$result=$user->sign_in($email,$password);
			if($result){
				$session=new Session();
				session_id($session->get_sid());
				session_start();
				$result=$session->set_user($user->get_uid());
				if($result){echo '{"check":"true","sid":"'.$session->get_sid().'"}';}
				else echo '{"check":"false"}';
			}
			else{
				echo '{"check":"false"}';
			}
		}
	}
?>