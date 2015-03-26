<?php
class Result{
public function render($dbc, $currentid){
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
        
        if(!empty($result)){
                $i=0;
                while($row=mysqli_fetch_array($result)){
                        $sname[$i]=$row['username'];
                        $_SESSION['sname'][$i]=$sname[$i];
                        $suid[$i]=$row['user_id'];;
                        $_SESSION['suid'][$i]=$suid[$i];
                        $sphoto[$i]=$row['photo'];
                        $_SESSION['sphoto'][$i]=$sphoto[$i];
                        $i++;
                }
                $length=$i;
            $_SESSION['length']=$length;
        }
}
else
    if(!isset($_GET['pageno'])){  
    $_SESSION['condition']=1;
    $_SESSION['length']=0;
        $_SESSION['sname']=array();
    $_SESSION['suid']=array();
    $_SESSION['sphoto']=array();
                $length=0;
         if(!empty($_POST['age-from']) and !is_numeric($_POST['age-from'])){
          echo "<script>alert('Age info is invalid')</script>";
          header("refresh:1;url=search.php");
         }        
        if(!empty($_POST['age-to']) and !is_numeric($_POST['age-to'])){
          echo "<script>alert('Age info is invalid')</script>";
          header("refresh:1;url=search.php");
        }
        if(!empty($_POST['height-from']) and !is_numeric($_POST['height-from'])){
          echo "<script>alert('Height info is invalid')</script>";
          header("refresh:1;url=search.php");
        }
        if(!empty($_POST['height-to']) and !is_numeric($_POST['height-to'])){
          echo "<script>alert('Height info is invalid')</script>";
          header("refresh:1;url=search.php");
        }
        if(!empty($_POST['income']) and !is_numeric($_POST['income'])){
          echo "<script>alert('Income info is invalid')</script>";
          header("refresh:1;url=search.php");
        }

        if(!empty($_POST['job']) and $_POST['job']!=="unlimited")
          $job=$_POST['job'];
        else
          $job=0;
        if(!empty($_POST['education']) and $_POST['education']!=="unlimited")
          $education=$_POST['education'];
        else
          $education=0;
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
        $_SESSION['cjob']=$job;
        $_SESSION['ceducation']=$education;
        $q="select * from user_info where user_id <> '$currentid' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
        $result=mysqli_query($dbc, $q);
        if(!empty($result)){
                $i=0;
                $pass=1;
                while($row=mysqli_fetch_array($result)) {
                  if($gender!==0 and $gender!==$row['sex'])
                    $pass=0;
                  if($city!==0 and $city!==$row['city'])
                    $pass=0;
                  if($hometown!==0 and $hometown!==$row['hometown'])
                    $pass=0;
                  if($job!==0 and $job!==$row['job'])
                    $pass=0;
                  if($education!==0 and $education!==$row['education'])
                    $pass=0;
                  if($pass==1){
                        $sname[$i]=$row['username'];
                        $_SESSION['sname'][$i]=$sname[$i];
                        $suid[$i]=$row['user_id'];
                        $_SESSION['suid'][$i]=$suid[$i];
                        $sphoto[$i]=$row['photo'];
                        $i++;
                      }
                    $pass=1;
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
                 echo "<div class='portrait'><img src='portrait/$sphoto[$m]'><a href='accountmgt.php?uid=$suid[$m]'>$sname[$m]</a></div>";}
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
                 echo "<div class='portrait'><img src='portrait/$sphoto[$m]'><a href='accountmgt.php?uid=$suid[$m]'>$sname[$m]</a></div>";}
                 echo "<br>";
                 echo "<span>Page:&nbsp";
                 for($k=1; $k<=$page;$k++)
                         echo "<a href='sresult.php?pageno=$k'>$k</a>&nbsp";
                 echo "</div>";  
                 
         }
         
 }
   } 



public function renderCondition(){
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
            $job=$_SESSION['cjob'];
            $education=$_SESSION['ceducation'];
                echo "<script>$(document).ready(function(){
                var conditionCount=3;
                $('#tab-by-name').css('color','black');
                $('#tab-by-condition').css('color','#e5004f');
                $('#by-condition-form').fadeIn();
            $('#by-name-form').hide();
                 $('#age-from').val($agemin);
                           $('#age-to').val($agemax);
                           $('#height-from').val($heightmin);
                           $('#height-to').val($heightmax);
                           $('#income').val($income);
                           $('#more-condition').before($('#addIncome').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           }";
                if($gender!==0)
                 echo "$('#gender1').val('$gender');";
        if($city!==0){
          echo "$('#city1').val('$city');";
          echo "$('#more-condition').before($('#addCity').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        }
        else
          echo "$('#city1').val('');";
        if($hometown!==0){
           echo "$('#hometown1').val('$hometown');";
           echo "$('#more-condition').before($('#addHometown').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           }";
        }
        else
           echo "$('#hometown1').val('');"; 
        if($education!==0)
          echo "$('#education1').val('$education');";
        if($job!==0)
          echo "$('#job1').val('$job');";                   
                echo "})</script>";     
        }
}
  }
}
?>