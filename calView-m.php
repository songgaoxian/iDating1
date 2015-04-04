<?php
class CalView{
	public function showCal($dmonth, $ddmonth, $wkd, $dbc, $currentid){
    $q3="select user_id2 from friend where user_id1='$currentid' and state='1'";
    $result3=mysqli_query($dbc,$q3);
    $flength=0;
    $femail=array();
    if($result3)
    while($row3=mysqli_fetch_array($result3)){
    $temp=$row3['user_id2'];
    $q4="select email from user_info where user_id='$temp'";
    $result4=mysqli_query($dbc,$q4);
    $row4=mysqli_fetch_array($result4);
    $femail[$flength]=$row4['email'];
    $flength++;
    }
echo "
<div id='C'>
<div id='A'>
<!--sidebar-start-->
<ul>
<li><a href='accountmgt-m.php'>My Page</a></li>
<li><a href='search-m.php'>Search</a></li>
<li><a href='shake.php'>Shake</a></li>
<li><a href='calendar-m.php'>Calendar</a></li>
<li><a href='moments-m.php'>Moments</a></li>
<li><a href='messages-m.php'>Messages</a></li>
<li><a href='logout1.php'>Log Out</a></li>
</ul>
<!--sidebar-end-->
</div>

<div id='B'>
<div class='header'>
<!--header-start-->
<div id='topnav'>
<img id='add' src='img/add.png' alt='add dating'>
</div>
<img id='nav' src='img/nav.png' alt='navigate'>
<h1>Calendar</h1>
</div>
<!--header-end-->
<!--container-start-->
<div class='container'>
<!--calendar-start-->
<div id='calendar'>
<div id='calendar-head'>";
if($dmonth>1){
  $prevm=$dmonth-1;
  echo "<a id='previous' href='calendar-m.php?month=$prevm'>&lt;</a>";}
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
  echo "<a href='calendar-m.php?month=$nextm' id='next'>&gt</a>";
}
echo "</div>";
echo "<table id='current' class='$dmonth'>
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
 while($j<=35){
 	if($j%7==1)
 		echo "<tr>";
 	if($k==1){
 		if($wkd==0){
 			echo "<td class='$k'>$k</td>";
 		$k++;
 		$j++;}
 	if($wkd==1){
 		echo "<td class='0'><td>";
 		$j++;
 		echo "<td class='$k'>$k</td>";
 		$k++;
 		$j++;}
 	if($wkd==2){
 		echo "<td class='0'></td>";
 		$j++;
 		echo "<td class='0'></td>";
 		$j++;
 		echo "<td class='$k'>$k</td>";
 		$k++;
 		$j++;}
 	if($wkd==3){
 		echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='0'></td>";
        $j++;
        echo "<td class='$k'>$k</td>";
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
        echo "<td class='$k'>$k</td>";
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
        echo "<td class='$k'>$k</td>";
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
        echo "<td class='$k'>$k</td>";
        $k++;
        $j++;}
 }
 else
 	if($k<=$totald){
 		echo "<td class='$k'>$k</td>";
 		$k++;
 		$j++;}
 	else{
 		echo "<td class='0'></td>";
 		$j++;
 	}
 	if($j%7==1)
 		echo "</tr>";}
echo "</table>
</div>
<!--calendar-end-->";

echo "<!--events-start-->
<div id='all-event'>
</div>
<!--events-end-->";

echo "</div>
<!--container-end-->
</div>
<!--overlay-start-->
<!--add-event-box-start-->
<div id='add-event-box' class='overlay'>
<div class='header'>
<img class='close-overlay' src='img/close_overlay.png' alt='back'>
<h1>Add a Dating</h1>
</div>
<div class='overlay-content'>
<form method='post' id='composer' action='composer-m.php'>
Your Partner:<br>
<select class='txtbox txtbox-fill' name='mate'>";
if($flength>0)
for($i=0;$i<$flength;$i++){
  $temp=$femail[$i];
  if($i==0)
  echo "<option value='$temp' selected>$temp</option>";
  else
    echo "<option value='$temp'>$temp</option>";
}
echo "</select><br>
<input class='txtbox txtbox-fill' type='date' name='day' required>
<input class='txtbox txtbox-fill' type='time' name='times' value='00:00' required><br>
<input class='txtbox txtbox-fill' type='text' name='location' placeholder='Location' required><br>
<textarea class='txtbox txtbox-fill' name='content' placeholder='Comments'></textarea>
<input id='add-event' class='btn btn-fill' type='submit' value='Add'>
</form>
</div>
</div>
<!--add-event-box-end-->
<!--overlay-end-->";
	}
}
//<td id="selected-date">10</td>


?>