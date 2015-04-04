<?php
require("session.php");
session_start();
$dbc=connect();
require("calcontroller-m.php");
$add=new DateOps();
$add->add($dbc);
?>