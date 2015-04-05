<?php
echo "<html><body><h3>Time left:<h3><div id='timer_div'></div></body><script>
      seconds_left=5;
      interval=setInterval(function(){
      	document.getElementById('timer_div').innerHTML=--seconds_left;
      },1000);</script></html>";
require("session.php");
session_start();
if(isset($_SESSION['month']))
$month=$_SESSION['month'];
$dbc=connect();
require("calcontroller.php");
$add=new DateOps();
$add->add($dbc);
?>