<?php
	require("user.php");
	$user=new User;
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$email=$_POST['email'];
		$user->find_pass($email);
	}
	header("Location: index.html");
?>