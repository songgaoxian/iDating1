<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<link rel="stylesheet" type="text/CSS" href="pink-theme.css">
<link rel="stylesheet" type="text/CSS" href="search.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
        var conditionCount=2;
    $(".item-delete").click(function() {
                $("#more-condition-box").append($(this).parent());
                conditionCount+=1;
                if (conditionCount>0) $("#more-condition").show();
                event.preventDefault();
                //$(this).parent().remove();
        });
        
         $(".item-add").click(function() {
                $("#more-condition").before($(this).parent());
                conditionCount-=1;
                if (conditionCount==0) {
                        $("#more-condition").hide();
                        $("#more-condition-box").slideToggle();
                }
                event.preventDefault();
                //$(this).parent().remove();
        });
        
        $("#more-condition").click(function() {
                $("#more-condition-box").slideToggle();
        });
        
        $("#tab-by-name").click(function() {
                $("#tab-by-condition").css("color","black");
                $(this).css("color","#e5004f");
                $("#by-condition-form").hide();
            $("#by-name-form").fadeIn();
        });
        
        $("#tab-by-condition").click(function() {
                $("#tab-by-name").css("color","black");
                $(this).css("color","#e5004f");
                $("#by-condition-form").fadeIn();
            $("#by-name-form").hide();
        });
});
</script>
<title>iDating - Search</title>
</head>
<?php
require("session.php");
session_start();
$session=new Session();
$currentid=$session->get_uid();
?>

<body>
<!--header-start-->
<div class="header">
<ul id="topnav">
<li><a href="logout.php">Log Out</a>
  <li><a href="messages.php">Messages</a>
  <li><a href="moments.php">Moments</a>
  <li><a href="calendar.html">Calendar</a>
  <li><a href="search.php">Search</a>
  <li><a href="accountmgt.php">My Page</a>
  
</ul>
<img src="img/logo_small.png" alt="iDating logo">
</div>
<!--header-end-->

<!--content-start-->
<div class="container">
<!--search-condition-start-->

<div id="search-condition">
<div id="tabs">
<button id="tab-by-condition" class="link-btn no-line" type="button">Search by Conditions</button>|
<button id="tab-by-name" class="link-btn no-line" type="button">Search by Nickname</button>
</div>

<form id="by-name-form" method="get" action="sresult.php">
<input id="nickname-input" class="txtbox" type="text" placeholder="Nickname" name="nickname" required>
<input id="search-1" class="btn" type="submit" value="">
</form>

<form id="by-condition-form" method="post" action="sresult.php">
<input id="search-2" class="btn" type="submit" value="">
<div class="search-item">
Gender: 
<select id="gender1" name="gender">
  <option value="male">Male</option>
  <option value="female">Female</option>
  <option value="unlimited" selected>Unlimited</option>
</select>
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Age:
<input id="age-from" class="txtbox-embed" type="number" min="18" max="99" value="22" name="age-from"> ~ <input id="age-to" class="txtbox-embed" type="number"  min="18" max="99"  value="28" name="age-to">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Height (cm):
<input id="height-from" class="txtbox-embed" type="number" min="140" max="220" value="150" name="height-from"> ~ <input id="height-to" class="txtbox-embed" type="number" min="140" max="220" value="170" name="height-to">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
City:
<input class="txtbox-embed" id="city1" type="text" value="Hong Kong" name="city">
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>

<div class="search-item">
Occupation:
  <select name="job" class="txtbox-embed">
        <option value="unlimited" selected>Unlimited</option>
  </select>
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>
<button id="more-condition" type="button" class="link-btn">More conditions?</button>
</form>
</div>
<div id="more-condition-box">
<div class="search-item" id="mcb1">
Hometown:
<input class="txtbox-embed" id="hometown1" type="text" value="Peking" name="hometown">
<button class="btn item-delete">X</button>
<button class="btn item-add" >Add</button>
</div>

<div class="search-item" id="mcb2">
Monthly Income (HKD): &gt;=
<input id="income" class="txtbox-embed" type="number" value="10000" name="income">
<button class="btn item-delete">X</button>
<button class="btn item-add" >Add</button>
</div>

<!--
<div class="search-item">
Tags: Workaholic + Reliable
<button class="btn item-delete">X</button>
<button class="btn item-add">Add</button>
</div>-->
</div>
<!--search-condition-end-->
<!--search-result-->
<?php
$dbc=connect();
$sname=array();
$suid=array();
$sphoto=array();
if(isset($_GET['nickname'])){
        $_SESSION['condition']=0;
        $_SESSION['length']=0;
        $length=0;
        $username=$_GET['nickname'];
        $q="select * from user_info where username='$username' and user_id <> '$currentid'";
        $_SESSION['cname']=$username;
        $result=mysqli_query($dbc,$q);
        $_SESSION['sname']=array();
    $_SESSION['suid']=array();
    $_SESSION['sphoto']=array();
        $_SESSION['birthday']=array();
        $_SESSION['sex']=array();
        $_SESSION['selfintro']=array();
        $_SESSION['city']=array();
        $_SESSION['hometown']=array();
        $_SESSION['height']=array();
        $_SESSION['job']=array();
        $_SESSION['income']=array();
        $_SESSION['education']=array();
        $_SESSION['email']=array();
        
        if(!empty($result)){
                $i=0;
                while($row=mysqli_fetch_array($result)){
                        $sname[$i]=$row['username'];
                        $_SESSION['sname'][$i]=$sname[$i];
                        $temp=$row['user_id'];
                        $q2="select sid from session where user_id='$temp'";
                        $result2=mysqli_query($dbc, $q2);
                        $row2=mysqli_fetch_array($result2);
                        $suid[$i]=$row2['sid'];
                        $_SESSION['suid'][$i]=$suid[$i];
                        $sphoto[$i]=$row['photo'];
                        $_SESSION['sphoto'][$i]=$sphoto[$i];
                        $_SESSION['birthday'][$i]=$row['birthday'];
                        $_SESSION['sex'][$i]=$row['sex'];
                        $_SESSION['selfintro'][$i]=$row['self_intro'];
                        $_SESSION['city'][$i]=$row['city'];
        $_SESSION['hometown'][$i]=$row['hometown'];
        $_SESSION['height'][$i]=$row['height'];
        $_SESSION['job'][$i]=$row['job'];
        $_SESSION['income'][$i]=$row['income'];
        $_SESSION['education'][$i]=$row['education'];
        $_SESSION['email'][$i]=$row['email'];
                        $i++;
                }
                $length=$i;
            $_SESSION['length']=$length;
        }
}
else
    if(!isset($_GET['pageno'])){  
    $_SESSION['condition']=1;
        $_SESSION['sname']=array();
    $_SESSION['suid']=array();
    $_SESSION['sphoto']=array();
        $_SESSION['birthday']=array();
        $_SESSION['sex']=array();
        $_SESSION['selfintro']=array();
        $_SESSION['city']=array();
        $_SESSION['hometown']=array();
        $_SESSION['height']=array();
        $_SESSION['job']=array();
        $_SESSION['income']=array();
        $_SESSION['education']=array();
        $_SESSION['email']=array();
                $length=0;
        if(!empty($_POST['gender']) and $_POST['gender']!=="unlimited")
                $gender=$_POST['gender'];
        else
                $gender=0;
        if(!empty($_POST['age-from']))
                $agemin=intval($_POST['age-from']);
        else
                $agemin=18;
        if(!empty($_POST['age-to']))
                $agemax=intval($_POST['age-to']);
        else
                $agemax=99;
        if(!empty($_POST['height-from']))
                $heightmin=intval($_POST['height-from']);
        else
                $heightmin=140;
        if(!empty($_POST['height-to']))
                $heightmax=intval($_POST['height-to']);
        else
                $heightmax=220;
        if(!empty($_POST['city']))
                $city=$_POST['city'];
        else
                $city=0;
        if(!empty($_POST['hometown']))
                $hometown=$_POST['hometown'];
        else
                $hometown=0;
        if(!empty($_POST['income']))
                $income=intval($_POST['income']);
        else
                $income=0;
        $year=intval(date("Y"));
        $yyear=$year-$agemin;
        $oyear=$year-$agemax;
        $_SESSION['cgender']=$gender;
        $_SESSION['cagemin']=$agemin;
        $_SESSION['cagemax']=$agemax;
        $_SESSION['cheightmin']=$heightmin;
        $_SESSION['cheightmax']=$heightmax;
        $_SESSION['ccity']=$city;
        $_SESSION['chometown']=$hometown;
        $_SESSION['cincome']=$income;
        if($gender!==0 and $city!==0 and $hometown!==0)
                $q="select * from user_info where user_id <> '$currentid' and sex='$gender' and city='$city' and hometown='$hometown' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
        else
                if($gender==0 and $city!==0 and $hometown!==0)
                        $q="select * from user_info where user_id <> '$currentid' and city='$city' and hometown='$hometown'
                and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
                        else
                                if($gender!==0 and $city==0 and $hometown!==0)
                                        $q="select * from user_info where user_id <> '$currentid' and sex='$gender' and hometown='$hometown' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
                                else
                                        if($gender!==0 and $city!==0 and $hometown==0)
                                                $q="select * from user_info where user_id <> '$currentid' and sex='$gender' and city='$city' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
                                        else
                                                if($gender==0 and $city==0 and $hometown!==0)
                                                        $q="select * from user_info where user_id <> '$currentid' and hometown='$hometown' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
                                                else
                                                        if($gender==0 and $city!==0 and $hometown==0)
                                                                $q="select * from user_info where user_id <> '$currentid' and city='$city' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
                                                        else
                                                                if($gender!==0 and $city==0 and $hometown==0)
                                                                        $q="select * from user_info where user_id <> '$currentid' and sex='$gender' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
                                                                else
                                                                        $q="select * from user_info where user_id <> '$currentid' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
        
        $result=mysqli_query($dbc, $q);
        if(!empty($result)){
                $i=0;
                while($row=mysqli_fetch_array($result)) {
                        $sname[$i]=$row['username'];
                        $_SESSION['sname'][$i]=$sname[$i];
                        $temp=$row['user_id'];
                        $q2="select sid from session where user_id='$temp'";
                        $result2=mysqli_query($dbc,$q2);
                        $row2=mysqli_fetch_array($result2);
                        $suid[$i]=$row2['sid'];
                        $_SESSION['suid'][$i]=$suid[$i];
                        $sphoto[$i]=$row['photo'];
                        $_SESSION['sphoto'][$i]=$sphoto[$i];
                        $_SESSION['birthday'][$i]=$row['birthday'];
                        $_SESSION['sex'][$i]=$row['sex'];
                        $_SESSION['selfintro'][$i]=$row['self_intro'];
                        $_SESSION['city'][$i]=$row['city'];
        $_SESSION['hometown'][$i]=$row['hometown'];
        $_SESSION['height'][$i]=$row['height'];
        $_SESSION['job'][$i]=$row['job'];
        $_SESSION['income'][$i]=$row['income'];
        $_SESSION['education'][$i]=$row['education'];
        $_SESSION['email'][$i]=$row['email'];
                        $i++;
                }
      $length=$i;
          $_SESSION['length']=$length;
          
        }                       
}
$length=$_SESSION['length'];
 if($length==0)
         echo "<div id='search-result'><h2>No match is found.</h2></div>";
 else{
         echo "<div id='search-result'><h2>Here're what we have found.</h2>";
         if($length<=10){
                 for($j=1; $j<=$length;$j++){
                         $m=$j-1;
                 echo "<div class='portrait'><img src='portrait/$sphoto[$m]'><a href='accountmgt.php?sid=$suid[$m]'>$sname[$m]</a></div>";}
                 echo "</div>";
         }
         else{
                 $page=$length/10;
                 $page=(int)$page+1;
                 if(!isset($_GET['pageno'])){
                         $start=1;
                         $end=10;
                 }
                 else{
                         $pageno=(int)$_GET['pageno'];
                          $start=($pageno-1)*10+1;
                          if($pageno<$page)
                      $end=$pageno*10;
                      else
                                  $end=$length;  
                 }
                 for($j=$start; $j<=$end; $j++){
                         $m=$j-1;
                         $sphoto[$m]=$_SESSION['sphoto'][$m];
                         $sname[$m]=$_SESSION['sname'][$m];
                         $suid[$m]=$_SESSION['suid'][$m];
                 echo "<div class='portrait'><img src='portrait/$sphoto[$m]'><a href='accountmgt.php?sid=$suid[$m]'>$sname[$m]</a></div>";}
                 echo "<br>";
                 echo "<span>Page:&nbsp";
                 for($k=1; $k<=$page;$k++)
                         echo "<a href='sresult.php?pageno=$k'>$k</a>&nbsp";
                 echo "</div>";  
                 
         }
         
 }
?>
<!--footer-start-->
<div class="footer">
<a href="index.html#about-us">About Us</a>
&nbsp;|&nbsp;
<a href="index.html#contact-us">Contact Us</a>
<br><br>
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->
</body>
<?php
if(isset($_SESSION['condition'])){
        if($_SESSION['condition']==0){
                $cname=$_SESSION['cname'];
                echo "<script>$(document).ready(function(){
                $('#tab-by-condition').css('color','black');
                $('#tab-by-name').css('color','#e5004f');
                $('#by-condition-form').hide();
            $('#by-name-form').fadeIn();
                $('#nickname-input').val('$cname');
                })</script>";
        }
        else{$gender=$_SESSION['cgender'];
                $city=$_SESSION['ccity'];
                $hometown=$_SESSION['chometown'];
                $agemin=$_SESSION['cagemin'];
                $agemax=$_SESSION['cagemax'];
            $heightmin=$_SESSION['cheightmin'];
            $heightmax=$_SESSION['cheightmax'];
            $income=$_SESSION['cincome'];
                echo "<script>$(document).ready(function(){
                $('#tab-by-name').css('color','black');
                $('#tab-by-condition').css('color','#e5004f');
                $('#by-condition-form').fadeIn();
            $('#by-name-form').hide();
                $('#more-condition-box').slideToggle();
                $('#more-condition').before($('#mcb1').parent());
                 $('#age-from').val($agemin);
                           $('#age-to').val($agemax);
                           $('#height-from').val($heightmin);
                           $('#income').val($income);";
                if($gender!==0)
                 echo "$('#gender1').val('$gender');";
        if($city!==0)
          echo "$('#city1').val('$city');";
        else
          echo "$('#city1').val('');";
        if($hometown!==0)
           echo "$('#hometown1').val('$hometown');";
        else
           echo "$('#hometown1').val('');";                     
                echo "})</script>";     
        }
}
?>
</html>


