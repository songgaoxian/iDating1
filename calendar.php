<?php
require("session.php");
session_start();
$session=new Session();
$dbc=connect();
$currentid=$session->get_uid();
 if(empty($_GET['month']))
  $dmonth=date('n');
  else
    $dmonth=(int)$_GET['month'];
  if($dmonth<10)
    $dates="2015-0$dmonth-01";
  else
    $dates="2015-$month-01";
  $wkd=date('w',strtotime($dates));
  if($dmonth<10)
    $ddmonth="0$dmonth";
  else
    $ddmonth=$dmonth;
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="calendar.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("td").click(function() {
		if ($("#event-detail-box").css("display")!="block") {
		  $("body").append("<div class='mask'></div>");
	      $("#add-event-box").slideDown();
		  $("#add-event-box").css("left",($(window).innerWidth()*0.94-$("#add-event-box").width())/2);
		}
	});
	
	$(".close-overlay").click(function() {
		$(".mask").remove();
	    $(this).parent().slideUp();
	});
	
	$(".event-box").click(function() {
		$("body").append("<div class='mask'></div>");
	    $("#event-detail-box").slideDown();
		$("#event-detail-box").css("left",($(window).innerWidth()*0.94-$("#event-detail-box").width())/2);
	});
	
	$(window).resize(function() {
        $(".overlay").css("left",($(window).innerWidth()*0.94-$(".overlay").width())/2);
    });
});
</script>

<title>iDating - Calendar</title>
</head>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.php">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--calendar-start-->
<div id="calendar">
<div id="calendar-head">
<?php 
if($dmonth>1){
  $prevm=$dmonth-1;
  echo "<a id='previous' href='calendar.php?month=$prevm'>&lt;</a>";
}
else
echo "";
?>
<h2><?php
if($dmonth==1){
  echo "Jan 2015";
  $totald=31;
}
if($dmonth==2){
  echo "Feb 2015";
  $totald=28;
}
if($dmonth==3){
  echo "Mar 2015";
  $totald=31;
}
if($dmonth==4){
  echo "Apr 2015";
  $totald=30;
}
if($dmonth==5){
  echo "May 2015";
  $totald=31;
}
if($dmonth==6){
  echo "Jun 2015";
  $totald=30;
}
if($dmonth==7){
  echo "Jul 2015";
  $totald=31;
}
if($dmonth==8){
  echo "Aug 2015";
  $totald=31;
}
if($dmonth==9){
  echo "Sep 2015";
  $totald=30;
}
if($dmonth==10){
  echo "Oct 2015";
  $totald=31;
}
if($dmonth==11){
  echo "Nov 2015";
  $totald=30;
}
if($dmonth==12){
  echo "Dec 2015";
  $totald=31;
}
 ?></h2>
 <?php
if($dmonth<12){
  $nextm=$dmonth+1;
  echo "<a href='calendar.php?month=$nextm' id='next'>&gt</a>";
}
else
  echo "";
?>
</div>
<table>
  <tr>
    <th>SUN</th>
    <th>MON</th>
    <th>TUE</th>
    <th>WED</th>
    <th>THU</th>
    <th>FRI</th>
    <th>SAT</th>
  </tr>
  <?php
  $mateid=array();
  $dat=array();
  $content=array();
  $location=array();
  $k=1;
  $j=1;
  $mm=0;
  while($j<=35){
    $temp1=intval($j/7);
    if($j%7==1){
      if($temp1%2==0)
        echo "<tr class='odd-row'>";
      else
        echo "<tr class='even-row'>";}
    $temp=$k+1;
        if($k<10)
          $temp1="0$k";
        else
          $temp1=$k;
        if($temp<10)
          $temp2="0$temp";
        else
          $temp2=$temp;
    if($k==1){
      if($wkd==0){
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $resultt=mysqli_query($dbc, $q1);
           $roww=mysqli_fetch_array($resultt);
           $tempname=$roww['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
        echo "</td>";
        $k++;
        $j++;}

      if($wkd==1){
        echo "<td></td>";
        $j++;
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==2){
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==3){
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==4){
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==5){
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==6){
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td></td>";
        $j++;
        echo "<td>$k";
        $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}
     }
     else
      if($k<=$totald)
     {echo "<td>$k";
      $q="select * from calendar where user_id='$currentid' and dat>'2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if(!$result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", $tempd);
           $content[$mm]=$row['content'];
           $location[$mm]=$row['location'];
           echo "<div class='event-box'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;
     }
     else{
      echo "<td></td>";
      $j++;
     }
     if($j%7==1)
      echo "</tr>";
  }
   
  ?>
</table>
</div>
<!--calendar-end-->


</div>
<!--content-end-->

<!--footer-start-->
<div class="footer">
<a href="index.html#about-us">About Us</a>
&nbsp;|&nbsp;

<a href="index.html#contact-us">Contact Us</a>
<br><br>
Copyright &copy; 2015 All Rights Reserved.

</div>
<!--footer-end-->

<div id="add-event-box" class="overlay" >
<button class="close-overlay btn" type="button">X</button>
<h2 class="colored-txt">Add a Dating</h2>
<form method="post" action="composer.php">
<input class="txtbox txtbox-fill" type="text" name="mate" placeholder="Your Partner" required></input><br>
<input class="txtbox txtbox-fill" type="time" name="times" placeholder="Starting Time" value="00:00" required></input><br>
<input class="txtbox txtbox-fill" type="text" name="location" placeholder="Location" required></input><br>
<textarea class="txtbox txtbox-fill" name="content" placeholder="Comments"></textarea>
<input id="add-event" class="btn btn-fill" type="submit" value="Add">
</form>
</div>

<div id="event-detail-box" class="overlay" >
<button class="close-overlay btn" type="button">X</button>
<h2 class="colored-txt">Dating Details</h2>
</div>

</body>
</html>

