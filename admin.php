<?php
	require("session.php");
	class admin{
		public function write($name,$email,$content){
			$conn=connect();
			if($conn){
				$sql='INSERT INTO admin(name,email,content) VALUES("'.$name.'","'.$email.'","'.$content.'");';
				mysqli_query($conn,$sql);
			}
		}
	}
?>