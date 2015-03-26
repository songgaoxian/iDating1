<?php
require("session.php");
session_start();
$session=new Session();
$uid=$session->get_uid();
$dbc=connect();
require("calcontroller.php");
$del=new DateOps();
$del->delete($dbc, $uid);
?>
