<?php
require("session.php");
session_start();
if(isset($_SESSION['month']))
$month=$_SESSION['month'];
$dbc=connect();
require("calcontroller.php");
$add=new DateOps();
$add->add($dbc);
?>