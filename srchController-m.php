<?php
/**/
class Result{
	public function render($dbc,$currentid){

		$sname=array();
$suid=array();
$sphoto=array();
if(isset($_GET['nickname'])){
        $_SESSION['condition']=0;
        $_SESSION['length']=0;
        $length=0;
        $username=$_GET['nickname'];
        $q="select * from user_info where username='$username' and user_id <> '$currentid'";
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
          header("refresh:1;url=search-m.php");
         }        
        if(!empty($_POST['age-to']) and !is_numeric($_POST['age-to'])){
          echo "<script>alert('Age info is invalid')</script>";
          header("refresh:1;url=search-m.php");
        }
        if(!empty($_POST['height-from']) and !is_numeric($_POST['height-from'])){
          echo "<script>alert('Height info is invalid')</script>";
          header("refresh:1;url=search-m.php");
        }
        if(!empty($_POST['height-to']) and !is_numeric($_POST['height-to'])){
          echo "<script>alert('Height info is invalid')</script>";
          header("refresh:1;url=search-m.php");
        }
        if(!empty($_POST['income']) and !is_numeric($_POST['income'])){
          echo "<script>alert('Income info is invalid')</script>";
          header("refresh:1;url=search-m.php");
        }

        if(!empty($_POST['job']) and $_POST['job']!=="unlimited")
          $job=$_POST['job'];
        else
          $job=0;
        if(!empty($_POST['education']) and $_POST['education']!=="unlimited")
          $education=$_POST['education'];
        else
          $education=0;
        if(isset($_POST['gender']) and $_POST['gender']=='Female')
                $gender=$_POST['gender'];
        else
                $gender="Male";
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
            $music=0;
            $movie=0;
            $book=0;
            $jogging=0;
            $cooking=0;
        if(!empty($_POST['tags'])){
        	$tag=array();
        	$tag=$_POST['tags'];
        	foreach($tag as $value){
              if($value=='music')
              	$music='music';
              if($value=='movie')
              	$movie='movie';
              if($value=='book')
              	$book='book';
              if($value=='jogging')
              	$jogging='jogging';
              if($value=='cooking')
              	$cooking='cooking';
        	}
        }
        $year=intval(date("Y"));
        $yyear=$year-$agemin;
        $oyear=$year-$agemax+1;
        $q="select * from user_info where user_id <> '$currentid' and birthday>='$oyear' and birthday<='$yyear' and income>='$income' and height>='$heightmin' and height<='$heightmax'";
        $result=mysqli_query($dbc, $q);
        if(mysqli_num_rows($result)>0){
                $i=0;
                $pass=1;
                $k=0;
                while($row=mysqli_fetch_array($result)) {
                  $k++;
                  if($gender!==$row['sex'])
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
                    if(mysqli_num_rows($resultq)==0){
                      $pass=0;
                      echo "error";
                     }
                    else{
                      $rowq=mysqli_fetch_array($resultq);
                      if($music!==0 and $rowq['music']!=='music')
                        {$pass=0;
                          }
                      if($movie!==0 and $rowq['movie']!=='movie')
                        {$pass=0;
                          }
                      if($jogging!==0 and $rowq['jogging']!=='jogging')
                        {$pass=0;
                          }
                      if($book!==0 and $rowq['book']!=='book')
                        {$pass=0;
                          }
                      if($cooking!==0 and $rowq['cooking']!=='cooking')
                        {$pass=0;
                          }
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
	}
}
$length=$_SESSION['length'];
if($length==0)
	echo "<div id='search-result' class='colored-txt'><h2>No match.</h2></div>";
else{echo "
	<div id='search-result' class='colored-txt'><h2>Here're whom we have found for you.</h2>";
   if($length<=4){
   	for($j=0;$j<$length;$j++){
   		$rphoto=$_SESSION['sphoto'][$j];
   		$rname=$_SESSION['sname'][$j];
   		$ruid=$_SESSION['suid'][$j];
   		echo "<div class='search-portrait'>
		<div class='background-cover-center' style='background-image:url(portrait/$rphoto); height: 145px'></div>
		<a href='accountmgt-m.php?uid=$ruid'>$rname</a>
	</div>";
   	}
   	echo "<div class='btn-group'>
    	<button id='return-btn' class='btn btn-mobile'><a  href='search-m.php'>Return to Search</a></button>
    </div>";
   }
   else{
   	$page=intval($length/4)+1;
   	if(!isset($_GET['pageno'])){
   		$start=1;
   		$end=4;
   	}
   	else{
   		$pageno=(int)$_GET['pageno'];
   		$start=($pageno-1)*4+1;
   		if($pageno<$page)
   			$end=$pageno*4;
   		else
   			$end=$length;
   	}
   	for($j=$start;$j<=$end;$j++){
   		$m=$j-1;
   		$rphoto=$_SESSION['sphoto'][$m];
   		$rname=$_SESSION['sname'][$m];
   		$ruid=$_SESSION['suid'][$m];
        echo "<div class='search-portrait'>
		<div class='background-cover-center' style='background-image:url(portrait/$rphoto); height: 145px'></div>
		<a href='accountmgt-m.php?uid=$ruid'>$rname</a>
	</div>";
   	}
   	echo "<br>";
   	echo "<div style='text-align:center'>Page:&nbsp";
   	for($k=1;$k<=$page;$k++)
   		echo "<a href='sresult-m.php?pageno=$k'>$k</a>&nbsp";
   	echo "</div><div class='btn-group'>
    	<button id='return-btn' class='btn btn-mobile'><a  href='search-m.php'>Return to Search</a></button>
    </div>";
   }
 echo "</div>";
}



}
}
?>



