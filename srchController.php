<?php
function distanceGeoPoints ($lat1, $lng1, $lat2, $lng2) {

    $earthRadius = 3958.75;

    $dLat = deg2rad($lat2-$lat1);
    $dLng = deg2rad($lng2-$lng1);


    $a = sin($dLat/2) * sin($dLat/2) +
       cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
       sin($dLng/2) * sin($dLng/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $dist = $earthRadius * $c;

    // from miles
    $meterConversion = 1609;
    $geopointDistance = $dist * $meterConversion;

    return $geopointDistance;
}
class Result{
public function render($dbc, $currentid){
$sname=array();
$suid=array();
$sphoto=array();
if(isset($_GET['nickname'])){
       $_SESSION['rank']=0;
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
    $_SESSION['distance']=array();    
        if(mysqli_num_rows($result)>0) {
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
    $_SESSION['distance']=array(); 
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
        if(!empty($_POST['Music']))
          $music=$_POST['Music'];
        else
          $music=0;
        if(!empty($_POST['Movie']))
          $movie=$_POST['Movie'];
        else
          $movie=0;
        if(!empty($_POST['Book']))
          $book=$_POST['Book'];
        else
          $book=0;
        if(!empty($_POST['Jogging']))
          $jogging=$_POST['Jogging'];
        else
          $jogging=0;
        if(!empty($_POST['Cooking']))
          $cooking=$_POST['Cooking'];
        else
          $cooking=0;
        if(!empty($_POST['By-Distance']))
          $rank=1;
        else
          $rank=0;

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
        $_SESSION['cmusic']=$music;
        $_SESSION['cmovie']=$movie;
        $_SESSION['cbook']=$book;
        $_SESSION['cjogging']=$jogging;
        $_SESSION['ccooking']=$cooking;
        $_SESSION['rank']=$rank;
        $q="select * from user_info where user_id <> '$currentid' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
        $result=mysqli_query($dbc, $q);
        if(mysqli_num_rows($result)>0){
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
                  $temp=$row['user_id'];
                  $qq="select * from tag where user_id='$temp'";
                  $resultq=mysqli_query($dbc,$qq);
                  if($music!==0 or $book!==0 or $movie!==0 or $jogging!==0 or $cooking!==0)
                    if(!$resultq)
                      $pass=0;
                    else{
                      $rowq=mysqli_fetch_array($resultq);
                      if($music!==0 and !$rowq['music'])
                        $pass=0;
                      if($movie!==0 and !$rowq['movie'])
                        $pass=0;
                      if($jogging!==0 and !$rowq['jogging'])
                        $pass=0;
                      if($book!==0 and !$rowq['book'])
                        $pass=0;
                      if($cooking!==0 and !$rowq['cooking'])
                        $pass=0;
                    }

                  if($pass==1){
                        $sname[$i]=$row['username'];
                        $_SESSION['sname'][$i]=$sname[$i];
                        $suid[$i]=$row['user_id'];
                        $_SESSION['suid'][$i]=$suid[$i];
                        $sphoto[$i]=$row['photo'];
                        $_SESSION['sphoto'][$i]=$sphoto[$i];
                        $i++;
                      }
                    $pass=1;
                }
      $length=$i;
          $_SESSION['length']=$length;
          if($rank==1 and $length>0){
            $tempdist=array();
            $q3="select * from user_location where user_id='$currentid'";
            $result3=mysqli_query($dbc,$q3);
            for($j=0;$j<$length;$j++)
              $_SESSION['distance'][$j]='unknown';
            if($row3=mysqli_fetch_array($result3)){
              $lati=(float)$row3['latitude'];
              $longi=(float)$row3['longitude'];
              for($j=0;$j<$length;$j++){
                $tpuid=$_SESSION['suid'][$j];
                $q4="select * from user_location where user_id='$tpuid'";
                $result4=mysqli_query($dbc,$q4);
                if($row4=mysqli_fetch_array($result4)){
                  $tplati=(float)$row4['latitude'];
                  $tplongi=(float)$row4['longitude'];
                  $tempdist[$j]=distanceGeoPoints($lati,$longi,$tplati,$tplongi);
                }
                else
                  $tempdist[$j]='unknown';
                $_SESSION['distance'][$j]=$tempdist[$j];
              }
             for($j=0;$j<$length-1;$j++){
                for($k=$j+1;$k<$length;$k++){
                    if($tempdist[$k]!=='unknown' and $tempdist[$j]!=='unknown' and $tempdist[$k]<$tempdist[$j]){
                        $temp=$_SESSION['sname'][$j];
                        $_SESSION['sname'][$j]=$_SESSION['sname'][$k];
                        $_SESSION['sname'][$k]=$temp;
                        $temp=$_SESSION['suid'][$j];
                        $_SESSION['suid'][$j]=$_SESSION['suid'][$k];
                        $_SESSION['suid'][$k]=$temp;
                        $temp=$_SESSION['sphoto'][$j];
                        $_SESSION['sphoto'][$j]=$_SESSION['sphoto'][$k];
                        $_SESSION['sphoto'][$k]=$temp;
                        $temp=$_SESSION['distance'][$j];
                        $_SESSION['distance'][$j]=$_SESSION['distance'][$k];
                        $_SESSION['distance'][$k]=$temp;
                    }
                    else
                      if($tempdist[$j]=='unknown' and $tempdist[$k]!=='unknown'){
                        $temp=$_SESSION['sname'][$j];
                        $_SESSION['sname'][$j]=$_SESSION['sname'][$k];
                        $_SESSION['sname'][$k]=$temp;
                        $temp=$_SESSION['suid'][$j];
                        $_SESSION['suid'][$j]=$_SESSION['suid'][$k];
                        $_SESSION['suid'][$k]=$temp;
                        $temp=$_SESSION['sphoto'][$j];
                        $_SESSION['sphoto'][$j]=$_SESSION['sphoto'][$k];
                        $_SESSION['sphoto'][$k]=$temp;
                        $temp=$_SESSION['distance'][$j];
                        $_SESSION['distance'][$j]=$_SESSION['distance'][$k];
                        $_SESSION['distance'][$k]=$temp;
                        
                      }
                }
              }
            }
            
          }
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
                 if($_SESSION['rank']==0)
                 echo "<div class='search-portrait'><a class='background-cover-center portrait-pic' href='accountmgt.php?uid=$suid[$m]' style='background-image:url(portrait/$sphoto[$m]);'></a><a class='portrait-name' href='accountmgt.php?uid=$suid[$m]'>$sname[$m]</a></div>";
                 else{
                  if($_SESSION['distance'][$m]!=='unknown')
                  $temp=round($_SESSION['distance'][$m]);
                  else
                    $temp=$_SESSION['distance'][$m];
                    $tphoto=$_SESSION['sphoto'][$m];
                    $tuid=$_SESSION['suid'][$m];
                    $tname=$_SESSION['sname'][$m];
                  echo "<div class='search-portrait'><a class='background-cover-center portrait-pic' href='accountmgt.php?uid=$tuid' style='background-image:url(portrait/$tphoto);'></a><a class='portrait-name' href='accountmgt.php?uid=$tuid'>$tname: $temp meter</a></div>";
                 }
                 }
                 echo "</div>";
         }
         else{
                 $page=intval($length/10)+1;
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
                 if($_SESSION['rank']==0)
                 echo "<div class='search-portrait'><a class='background-cover-center portrait-pic' href='accountmgt.php?uid=$suid[$m]' style='background-image:url(portrait/$sphoto[$m]);'></a><a class='portrait-name' href='accountmgt.php?uid=$suid[$m]'>$sname[$m]</a></div>";
                 else{
                  if($_SESSION['distance'][$m]!=='unknown')
                  $temp=round($_SESSION['distance'][$m]);
                  else
                    $temp=$_SESSION['distance'][$m];
                    $tphoto=$_SESSION['sphoto'][$m];
                    $tuid=$_SESSION['suid'][$m];
                    $tname=$_SESSION['sname'][$m];
                  echo "<div class='search-portrait'><a class='background-cover-center portrait-pic' href='accountmgt.php?uid=$tuid' style='background-image:url(portrait/$tphoto);'></a><a class='portrait-name' href='accountmgt.php?uid=$tuid'>$tname: $temp meter</a></div>";
                }
                }
                 echo "<br>";
                 echo "<div style='text-align:center'>Page:&nbsp";
                 for($k=1; $k<=$page;$k++)
                         echo "<a href='sresult.php?pageno=$k'>$k</a>&nbsp";
                  echo "</div>";
                 echo "</div>";  
                 
         }
         
 }
   } 



public function renderCondition(){
   if(isset($_SESSION['condition'])){
        if($_SESSION['condition']==0){
                $cname=$_SESSION['cname'];
                echo "<script>$(document).ready(function(){
                $('#tab-by-condition').removeClass('colored-txt-dark');
                $('#tab-by-name').addClass('colored-txt-dark');
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
            $music=$_SESSION['cmusic'];
        $movie=$_SESSION['cmovie'];
        $book=$_SESSION['cbook'];
        $jogging=$_SESSION['cjogging'];
        $cooking=$_SESSION['ccooking'];
        $rank=$_SESSION['rank'];
                echo "<script>$(document).ready(function(){
                var conditionCount=9;
                $('#tab-by-name').removeClass('colored-txt-dark');
                $('#tab-by-condition').addClass('colored-txt-dark');
                $('#by-condition-form').fadeIn();
            $('#by-name-form').hide();
                 $('#age-from').val($agemin);
                           $('#age-to').val($agemax);
                           $('#height-from').val($heightmin);
                           $('#height-to').val($heightmax);
                           $('#income').val($income);";
                  if($income>0)
                     echo "$('#more-condition').before($('#addIncome').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           }";
                if($gender!==0)
                 echo "$('#gender1').val('$gender');";
               else
                echo "$('#more-condition-box').append($('#delGender').parent());
                      conditionCount+=1;
                      if(conditionCount>0) $('#more-condition').show();";


        if($city!==0){
          echo "$('#city1').val('$city');";
          echo "$('#more-condition').before($('#addCity').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        }
        if($music!==0)
          echo "$('#more-condition').before($('#addMusic').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        if($movie!==0)
          echo "$('#more-condition').before($('#addMovie').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        if($book!==0)
          echo "$('#more-condition').before($('#addBook').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        if($jogging!==0)
          echo "$('#more-condition').before($('#addJogging').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        if($cooking!==0)
          echo "$('#more-condition').before($('#addCooking').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        if($rank!==0)
          echo "$('#more-condition').before($('#addRank').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           };";
        if($hometown!==0){
           echo "$('#hometown1').val('$hometown');";
           echo "$('#more-condition').before($('#addHometown').parent());
                           conditionCount-=1;
                           if (conditionCount==0) {
                          $('#more-condition').hide();
                          $('#more-condition-box').slideToggle();
                           }";
        }
        
        if($education!==0)
          echo "$('#education1').val('$education');";
        else
          echo "$('#more-condition-box').append($('#delEducation').parent());
                      conditionCount+=1;
                      if(conditionCount>0) $('#more-condition').show();";

        if($job!==0)
          echo "$('#job1').val('$job');"; 
        else
          echo "$('#more-condition-box').append($('#delJob').parent());
                      conditionCount+=1;
                      if(conditionCount>0) $('#more-condition').show();";

                echo "})</script>";     
        }
}
  }
}
?>