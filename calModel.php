<?php
class CalView{
	public function showCal($dmonth, $ddmonth, $wkd, $dbc, $currentid){
		echo "<div class='header'>
  <ul id='topnav'>
  <li><a href='messages.php'>Messages</a>
  <li><a href='moments.php'>Moments</a>
  <li><a href='calendar.php'>Calendar</a>
  <li><a href='search.php'>Search</a>
  <li><a href='accountmgt.php'>My Page</a>
</ul>
<img src='img/logo_small.png' alt='iDating logo'>
</div>
<!--header-end-->
<!--container-start-->
<div class='container'>
<!--calendar-start-->
<div id='calendar'>
<div id='calendar-head'>"; 
if($dmonth>1){
  $prevm=$dmonth-1;
  echo "<a id='previous' href='calendar.php?month=$prevm'>&lt;</a>";
}
echo "<h2>";
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
 echo "</h2>";
if($dmonth<12){
  $nextm=$dmonth+1;
  echo "<a href='calendar.php?month=$nextm' id='next'>&gt</a>";
}
echo "</div>";
echo "<table class='$dmonth'>
  <tr>
    <th>SUN</th>
    <th>MON</th>
    <th>TUE</th>
    <th>WED</th>
    <th>THU</th>
    <th>FRI</th>
    <th>SAT</th>
  </tr>";
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
echo "</table>
</div>
<!--calendar-end-->
<div align='center'>
<button id='signinButton'>Synchronize date addition and deletion with Google Calendar</button>
</div>
</div>
<!--container-end-->

<!--footer-start-->
<div class='footer'>
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->

<!--overlay-start-->
<div class='overlay-container'>
<!--add-event-box-start-->
<div id='add-event-box' class='overlay'>
<button class='close-overlay btn' type='button'>X</button>
<h2 class='colored-txt'>Add a Dating</h2>
<form method='post' id='composer' action='composer.php'>
<input class='txtbox txtbox-fill' type='text' name='mate' placeholder='Your Partner' required><br>
<input class='txtbox txtbox-fill' type='time' name='times' placeholder='Starting Time' value='00:00' required><br>
<input class='txtbox txtbox-fill' type='text' name='location' placeholder='Location' required><br>
<textarea class='txtbox txtbox-fill' name='content' placeholder='Comments'></textarea>
<input id='add-event' class='btn btn-fill' type='submit' value='Add'>
</form>
</div>
<!--add-event-box-end-->
<!--event-detail-start-->
<div id='event-detail-box' class='overlay' >
<button class='close-overlay btn' type='button'>X</button>
<h2 class='colored-txt'>Dating Details</h2>
<form method='post' action='deletec.php' id='detailc'>
  <input type='submit' value='Delete'><br>
  </form>
</div>
<!--event-detail-end-->
</div>
<!--overlay-end-->";
	}
}
?>