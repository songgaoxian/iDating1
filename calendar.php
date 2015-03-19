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
		  month=$("table").attr('class');
		  date11=$(this).attr('class');
      if($("[name=month]").length>0)
        $("[name=month]").remove();
      if($("[name=day]").length>0)
        $("[name=day]").remove();
		  $("#composer").append("<input type='hidden' name='month' value='"+month+"'>");
		  $("#composer").append("<input type='hidden' name='day' value='"+date11+"'>");
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
    dateid=$(this).attr('id');
   send(dateid);
	    
	});
	
	$(window).resize(function() {
        $(".overlay").css("left",($(window).innerWidth()*0.94-$(".overlay").width())/2);
    });
});
function send(dateid){
        $.ajax({
      dataType: 'json',
      data: {D: dateid},
      url: 'cdetail.php',
      type: 'POST',
      success: function(result){
        console.log(result);
        matename1=result[0];
        dat1=result[1];
        content1=result[2];
        location1=result[3];
        dtid1=result[4];
        mateid1=result[5];
        if($("[name=dateid1]").length>0)
          $("[name=dateid1]").remove();
        if($("[name=mname1]").length>0)
          $("[name=mname1]").remove();
        if($("[name=dat1]").length>0)
          $("[name=dat1]").remove();
        if($("[name=content1]").length>0)
          $("[name=content1]").remove();
        if($("[name=location1]").length>0)
          $("[name=location1]").remove();
        if($("[name=mateid1]").length>0)
          $("[name=mateid1]").remove();
         $("#detailc").append("<input type='hidden' name='dateid1' value='"+dtid1+"'>");
         $("#detailc").append("<input type='hidden' name='mateid1' value='"+mateid1+"'>");
        $("#detailc").append("<input type='text' readonly=true name='mname1' size='30' value='Date mate: "+matename1+"'>");
        $("#detailc").append("<input type='text' readonly=true name='dat1' size='30' value='"+dat1+"'>");
        $("#detailc").append("<br name='dat1'>");
        $("#detailc").append("<input type='text' readonly=true name='content1' size='30' value='Content: "+content1+"'>");
    
        $("#detailc").append("<input type='text' readonly=true name='location1' size='30' value='Location: "+location1+"'>");
        $("#detailc").append("<br name='location1'>");
       }
    });
}
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
?>
</div>
<?php
echo "<table class='$dmonth'>";
?>
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
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
        echo "</td>";
        $k++;
        $j++;}

      if($wkd==1){
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==2){
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==3){
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==4){
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==5){
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}

        if($wkd==6){
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k";
        $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
           $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;}
     }
     else
      if($k<=$totald)
     {echo "<td class='$k'>$k";
      $q="select * from calendar where user_id='$currentid' and dat>='2015-$ddmonth-$temp1'
        and dat<'2015-$ddmonth-$temp2'";
        $result=mysqli_query($dbc, $q);
        if($result)
          while($row=mysqli_fetch_array($result)){
           $mateid[$mm]=$row['mate_id'];
           $temp=$mateid[$mm];
           $q1="select username from user_info where user_id='$temp'";
           $result1=mysqli_query($dbc, $q1);
           $row1=mysqli_fetch_array($result1);
           $tempname=$row1['username'];
           $dat[$mm]=$row['dat'];
           $tempd=$dat[$mm];
           $temp=date("H:i", strtotime($tempd));
          $did=$row['dating_id'];
           echo "<div class='event-box' id='$did'>$temp &nbsp $tempname </div>";
           $mm++;
          }
          echo "</td>";
          $k++;
          $j++;
     }
     else{
      echo "<td class='0'></td>";
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
<form method="post" id="composer" action="composer.php">
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
<form method="post" action="deletec.php" id="detailc">
  <input type='submit' value='Delete'><br>
  </form>
</div>

</body>
</html>

