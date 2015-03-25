<?php
	function uuid(){
	    $str=md5(uniqid(mt_rand(), true));   
	    $uuid=substr($str,0,8).'-';   
	    $uuid.=substr($str,8,4).'-';   
	    $uuid.=substr($str,12,4).'-';   
	    $uuid.=substr($str,16,4).'-';   
	    $uuid.=substr($str,20,12);   
	    return $uuid;
	}
	function connect(){
		$host="localhost";
		$user="root";
		$pwd="";
	
		$conn=mysqli_connect($host,$user,$pwd,"project");
		if(!$conn){die("Connection failed!");}
		else{return($conn);}
	}
	class User{
		private $user_id;
		public function find_pass($email){
			if($this->has_user($email)==true){
				$conn=connect();
				$sql='SELECT username FROM user_info WHERE email="'.$email.'";';
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_array($result);
				$user=$row[0];
				$a=substr(uuid(),0,10);
				$sql='UPDATE user_info SET password="'.$a.'" WHERE email="'.$email.'";';
				$result=mysqli_query($conn,$sql);
				$to=$email;
				$headers="From :admin@idating.com";
				$subject="Reset your password";
				$message=
'Dear '.$user.'

Your password has been reset to '.$a.' .
';
				mail($to,$subject,$message,$headers);
			}
		}
		public function has_user($email){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM user_info WHERE email="'.$email.'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$row=mysqli_fetch_row($result);
					$this->user_id=$row[0];
					mysqli_close($conn);return(true);
				}
			}
			return(false);
		}
		public function set_user($uid){$this->user_id=$uid;}
		public function new_user($pass,$email){
			$this->user_id=uuid();
			$conn=connect();
			if($conn){
				$sql='INSERT INTO user_info(user_id,password,email) VALUES ("'.$this->user_id.'","'.$pass.'","'.$email.'");';
				$result=mysqli_query($conn,$sql);
				if($result){return(true);}
			}
			return(false);
		}
		public function get_uid(){return($this->user_id);}
		public function sign_in($email,$password){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM user_info WHERE email="'.$email.'" AND password="'.$password.'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$row = mysqli_fetch_assoc($result);
					$this->user_id=$row['user_id'];
					return(true);
				}
			}
			return(false);
		}
		public function set_user_info($info){
			$conn=connect();
			if($conn){
				$sql="UPDATE user_info SET ";
				$count=1;
				foreach($info as $key=>$value){
					if($count==1){$sql.=$key.'="'.$value.'" ';$count+=1;}
					else{$sql.=', '.$key.'="'.$value.'" ';}
				}
				$sql.='WHERE user_id="'.$this->user_id.'";';
				$result=mysqli_query($conn,$sql);
				mysqli_close($conn);
				return($result);
			}
			return(false);
		}
		
		public function show_info(){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM user_info WHERE user_id="'.$this->user_id.'";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					//login success
					$row = mysqli_fetch_array($result);
					$result=array();
					foreach($row as $key=>$value){
						$result[$key]=$value;
					};
					mysqli_close($conn);
					return($result);
				}
				else{
					mysqli_close($conn);
					return(NULL);
				}
			}
			else{return(NULL);}
		}
	}
?>