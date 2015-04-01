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
		$pwd="root";
	
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
				$sql='INSERT INTO tag(user_id) VALUES ("'.$this->user_id.'");';
				$result=mysqli_query($conn,$sql);
				$sql='INSERT INTO tag1(user_id) VALUES ("'.$this->user_id.'");';
				$result=mysqli_query($conn,$sql);
				return($result);
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
				//echo $sql;
				$result=mysqli_query($conn,$sql);
				mysqli_close($conn);
				return($result);
			}
			return(false);
		}
		public function set_tag1($info){
			$conn=connect();
			if($conn){
				$sql='DELETE FROM tag1 WHERE user_id="'.$this->user_id.'";';
				//echo $sql;
				mysqli_query($conn,$sql);
				$sql='INSERT INTO tag1(user_id) VALUES ("'.$this->user_id.'");';
				//echo $sql; 
				mysqli_query($conn,$sql);
				if(count($info)==0){return(true);}
				$sql="UPDATE tag1 SET ";
				$count=1;
				foreach($info as $key=>$value){
					if($value!=''){
						if($count==1){$sql.=$value.'="'.$value.'" ';$count+=1;}
						else{$sql.=', '.$value.'="'.$value.'" ';}
					}
				}
				$sql.='WHERE user_id="'.$this->user_id.'";';
				//echo $sql;
				$result=mysqli_query($conn,$sql);
				mysqli_close($conn);
				return($result);
			}
			else{return(false);}
		}
		public function set_tag($info){
			$conn=connect();
			if($conn){
				$sql='DELETE FROM tag WHERE user_id="'.$this->user_id.'";';
				//echo $sql;
				mysqli_query($conn,$sql);
				$sql='INSERT INTO tag(user_id) VALUES ("'.$this->user_id.'");';
				//echo $sql; 
				mysqli_query($conn,$sql);
				if(count($info)==0){return(true);}
				$sql="UPDATE tag SET ";
				$count=1;
				foreach($info as $key=>$value){
					if($value!=''){
						if($count==1){$sql.=$value.'="'.$value.'" ';$count+=1;}
						else{$sql.=', '.$value.'="'.$value.'" ';}
					}
				}
				$sql.='WHERE user_id="'.$this->user_id.'";';
				//echo $sql;
				$result=mysqli_query($conn,$sql);
				mysqli_close($conn);
				return($result);
			}
			else{return(false);}
		}
		public function show_friends(){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM friend WHERE user_id1="'.$this->user_id.'" and state="1";';
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					$result1=array();
					while($row = mysqli_fetch_array($result)){
						array_push($result1,$row[1]);
					}
					$result2=array();
					$num=0;
					while($num<count($result1)){
						$sql='SELECT * FROM user_info WHERE user_id="'.$result1[$num].'";';
						$result=mysqli_query($conn,$sql);
						array_push($result2,mysqli_fetch_array($result));
						$num+=1;
					}
					return($result2);
				}
				else{
					mysqli_close($conn);
					return(NULL);
				}
			}
		}
		public function del_friend($uid){
			if($this->is_friend($uid)==true){
				$conn=connect();
				if($conn){
					$sql='DELETE FROM friend WHERE (user_id1="'.$this->user_id.'" AND user_id2="'.$uid.'") OR (user_id1="'.$uid.'" AND user_id2="'.$this->user_id.'");';
					$result=mysqli_query($conn,$sql);
					mysqli_close($conn);
					return($result);
				}
				return(false);
			}
			else{return(false);}
		}
		public function is_friend($uid){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM friend WHERE user_id1="'.$this->user_id.'" AND user_id2="'.$uid.'" AND state="1";';
				$result=mysqli_query($conn,$sql);
				$result=mysqli_num_rows($result);
				mysqli_close($conn);
				if($result>0){return(true);}
				return(false);
			}
			return(false);
		}
		public function is_friend2($uid){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM friend WHERE user_id1="'.$this->user_id.'" AND user_id2="'.$uid.'";';
				$result=mysqli_query($conn,$sql);
				$result=mysqli_num_rows($result);
				mysqli_close($conn);
				if($result==0){return(false);}
				return(true);
			}
			return(false);
		}
		public function commit_friend($uid){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM friend WHERE user_id1="'.$this->user_id.'" AND user_id2="'.$uid.'" AND state="0";';
				$result=mysqli_query($conn,$sql);
				if($result){
					$sql='UPDATE friend SET state="1" WHERE (user_id1="'.$this->user_id.'" AND user_id2="'.$uid.'") OR (user_id1="'.$uid.'" AND user_id2="'.$this->user_id.'");';
					$result=mysqli_query($conn,$sql);
					mysqli_close($conn);
					return($result);
				}
				else{mysqli_close($conn);return(false);}
			}
			return(false);
		}
		public function add_friend($uid){
			$conn=connect();
			if($conn){
				if($this->is_friend2($uid)){return(true);}
				else{
					$sql='INSERT INTO friend(user_id1,user_id2,state) VALUES ("'.$this->user_id.'","'.$uid.'","0"),("'.$uid.'","'.$this->user_id.'","0");';
					$result=mysqli_query($conn,$sql);
					mysqli_close($conn);
					return(true);
				}
			}
			return(false);
		} 
		public function show_tag(){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM tag WHERE user_id="'.$this->user_id.'";';
				//echo $sql;
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					//login success
					$row = mysqli_fetch_array($result);
					$result=array();
					$i=1;
					while($i<=5){
						array_push($result,$row[$i]);
						$i+=1;
					}
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
		public function show_tag1(){
			$conn=connect();
			if($conn){
				$sql='SELECT * FROM tag1 WHERE user_id="'.$this->user_id.'";';
				//echo $sql;
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					//login success
					$row = mysqli_fetch_array($result);
					$result=array();
					$i=1;
					while($i<=5){
						array_push($result,$row[$i]);
						$i+=1;
					}
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