<?php
require("themeControl.php");
$session=new Session();
$dbc=connect();
$currentid=$session->get_uid();
 if(empty($_GET['month']))
  $dmonth=date('n');
  else
    $dmonth=(int)$_GET['month'];
  $_SESSION['month']=$dmonth;
  if($dmonth<10)
    $dates="2015-0$dmonth-01";
  else
    $dates="2015-$dmonth-01";
  $wkd=date('w',strtotime($dates));
  if($dmonth<10)
    $ddmonth="0$dmonth";
  else
    $ddmonth=$dmonth;
?>
<!DOCTYPE html>
<!-- the calendar view part -->
<html lang="en">
<head>
<script src="https://apis.google.com/js/client:platform.js" async defer></script>
<meta charset="utf-8">
<link rel="shortcut icon" href="img/icon.png">
<link rel="stylesheet" type="text/CSS" href="shared-frame.css">
<?php
$theme=new theme();
echo "<link rel='stylesheet' type='text/css' href='".$theme->getTheme()."-theme.css'>";
?>
<link rel="stylesheet" type="text/CSS" href="calendar.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<meta name="google-signin-clientid" content="480928246860-md5e151tk2n8fgjpctphhk9rl7hj6ler@developer.gserviceaccount.com">
<meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.login" />
<meta name="google-signin-requestvisibleactions" content="http://schema.org/AddAction" />
<meta name="google-signin-cookiepolicy" content="single_host_origin" />
<script src="calModel.js"></script>
<title>iDating - Calendar</title>
</head>
<body>
<?php
require("calView.php");
$calview=new CalView();
$calview->showCal($dmonth, $ddmonth, $wkd, $dbc, $currentid);
?>
</body>
</html>

