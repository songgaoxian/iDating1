<?php
if(isset($_GET['email'])){
	$email=$_GET['email'];
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'idating');
$dbc=@mysqli_connect(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME) OR exit('error'); #establish database connection
$q="select * from user_info, personality where email=user_email and email='$email'";
$result=@mysqli_query($dbc,$q);
$row=@mysqli_fetch_array($result);
$responsible=$row['responsibility'];
$loyal=$row['loyal'];
$gentle=$row['gentle'];
$username=$row['username'];
$hometown=$row['hometown'];
$sex=$row['sex'];
$status=$row['status'];
$age=$row['age'];  
}
?>
<!DOCTYPE html>
<html>
<body>
<div>
<h1><?php echo $username; ?></h1>
<br>
<span><?php echo $hometown," ",$sex," ",$status," ",$age; ?></span>
<br>
<h3>Personality</h3>
<span>
<?php
if ($responsible==1)
	echo "Responsible";
if($loyal==1)
	echo ", Loyal";
if($gentle==1)
	echo ", Gentle";
?>
</span>
</div>
</body>
</html>
