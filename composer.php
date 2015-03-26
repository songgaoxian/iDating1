<?php
require("session.php");
session_start();
$dbc=connect();
require("calcontroller.php");
$add=new DateOps();
$add->add($dbc);
?>