<?php
	session_unset();
	session_id('');
	header("Location: index.php");
?>