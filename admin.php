<?php
	require("session.php");
	class admin{
		public function write($name,$email,$content){
			$conn=connect();
			if($conn){
				$sql='INSERT INTO admin(name,email,content) VALUES("'.$name.'","'.$email.'","'.$content.'");';
				mysqli_query($conn,$sql);
				mysqli_close($conn);
			}
		}
	}
	$temp=new admin();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if($_POST['name']!='' && $_POST['email']!='' && $_POST['msg']!=''){
		$temp->write($_POST['name'],$_POST['email'],$_POST['msg']);}
		header('Location: index.php?suc=1');
	}
?>