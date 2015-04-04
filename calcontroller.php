<?php
class DateOps{
public function add($dbc){
		if(!empty($_POST['mate']) and !empty($_POST['times']) and !empty($_POST['location'])){
	$session=new Session();
	$uid=$session->get_uid();
	$day=(int)$_POST['day'];
    if($day==0){
    	echo "<script>alert('invalid date')</script>";
    	heaer("refresh:0; url=calendar.php");
    }
    $month=(int)$_POST['month'];
    if($month<10)
    	$month="0$month";
    if($day<10)
    	$day="0$day";
	$mateemail=$_POST['mate'];
	$time=$_POST['times'];
    $dat="2015-$month-$day $time";
	$location=$_POST['location'];
	$content=$_POST['content'];
	$start="2015-$month-$day"."T$time".":00.000+08:00";
	$end="2015-$month-$day"."T$time".":00.000+07:00";
	$summary="You have a date with: $mateemail";
	$resource = "{
				'summary': '$summary',
				'start': {
					'dateTime': '$start',
				},
				'end': {
					'dateTime': '$end',
				},
				'location': '$location'
			}";
	$q="select user_id from user_info where email='$mateemail'";
	$result=mysqli_query($dbc, $q);
	if($row=mysqli_fetch_array($result)) {
		$mateid=$row['user_id'];
	$q1="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$uid', '$mateid', '$dat', '$content','$location')";
	$q2="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$mateid', '$uid', '$dat', '$content', '$location')";
	if(mysqli_query($dbc, $q1) and mysqli_query($dbc, $q2)){
		echo "<script>alert('Date event is successfully created');</script>";
        echo "
<script type='text/javascript'>
			var clientId = '480928246860-md5e151tk2n8fgjpctphhk9rl7hj6ler.apps.googleusercontent.com';
			var apiKey = 'AIzaSyCcmCqx5nEX1tfeNrsiDN5OkTsHlnfk4Q0';
			var scopes = 'https://www.googleapis.com/auth/calendar';
            var resource=$resource;
 function handleClientLoad() {
        gapi.client.setApiKey(apiKey);
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        window.setTimeout(checkAuth,1);
    }

    function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);

    }
			
			// show/hide the 'authorize' button, depending on application state
			function handleAuthResult(authResult) {
				accessToken=authResult.access_token;
				console.log(accessToken);
				if (authResult && !authResult.error) 					
				  makeApiCall();											// call the api if authorization passed
				else {													// otherwise, show button
					handleAuthClick;				// setup function to handle button click
				}
				
			}
			
			// function triggered when user authorizes app
			function handleAuthClick() {

				gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
				return false;
			}
			// setup event details
			
  
			// function load the calendar api and make the api call
			function makeApiCall() {
				gapi.client.load('calendar', 'v3', function() {					// load the calendar api (version 3)
					var request = gapi.client.calendar.events.insert({
						'calendarId':		'primary',	// calendar ID',	// calendar ID
						'resource':			resource							// pass event details with api call
					});
					
					// handle the response from our api call
					request.execute(function(resp) {
						if(resp.status=='confirmed') 
							alert('successfully synchronized addition with google calendar'); 
						else 
						alert('The Date creation cannot be synchronized with google calendar');
						console.log(resp);
					});
				});
			}
		</script>
		<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>";
	}
	else
		echo "<script>alert('error')</script>";}
	else
	{
		echo "error";
	}
}
else{
	echo "<script>alert('Please give all valid inputs')</script>";
}

if(isset($month))
header("refresh:5; url=calendar.php?month=$month");
else
header("refresh:5; url=calendar.php");
	}
 




public function delete($dbc, $uid){
    if(isset($_POST['dateid1'])){
	$id=(int)$_POST['dateid1'];
	$q="delete from calendar where dating_id=$id";
	$result=mysqli_query($dbc, $q);
	$mateid=$_POST['mateid1'];
	$q2="select email from user_info where user_id='$mateid'";
	$result2=mysqli_query($dbc, $q2);
	if($result2){
		$row=mysqli_fetch_array($result2);
		$mateemail=$row['email'];
	}
	else{
		echo "error";
		if(!isset($_POST['mobile']))
		header("refresh:1; url=calendar.php");
	    else
	    	header("refresh:1; url=calendar-m.php");
	}
	$dtime=$_POST['dat1'];
	$tarray=array();
	$tarray=explode(" ",$dtime);
	$timeMax=$tarray[0]."T".$tarray[1].".000+06:59";
	$timeMin=$tarray[0]."T".$tarray[1].".000+08:01";
	echo "<script> var timeMax='$timeMax';
	      var timeMin='$timeMin'
	      </script>";
	$q1="delete from calendar where user_id='$mateid' and mate_id='$uid' and dat='$dtime'";
	$result1=mysqli_query($dbc,$q1);
	if($result and $result1){
		echo "successful delete";
		echo "
        <script type='text/javascript'>
			var clientId = '480928246860-md5e151tk2n8fgjpctphhk9rl7hj6ler.apps.googleusercontent.com';
			var apiKey = 'AIzaSyCcmCqx5nEX1tfeNrsiDN5OkTsHlnfk4Q0';
			var scopes = 'https://www.googleapis.com/auth/calendar';
 function handleClientLoad() {
        gapi.client.setApiKey(apiKey);
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        window.setTimeout(checkAuth,1);
    }

    function checkAuth() {
        gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);

    }
			
			// show/hide the 'authorize' button, depending on application state
			function handleAuthResult(authResult) {
				accessToken=authResult.access_token;
				console.log(accessToken);
				if (authResult && !authResult.error) 					
				  makeApiCall();											// call the api if authorization passed
				else {													// otherwise, show button
					handleAuthClick;				// setup function to handle button click
				}
				
			}
			
			// function triggered when user authorizes app
			function handleAuthClick() {

				gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
				return false;
			}
			// setup event details
			
  
			// function load the calendar api and make the api call
			function makeApiCall() {
				gapi.client.load('calendar', 'v3', function() {					// load the calendar api (version 3)
					var request = gapi.client.calendar.events.list({
						'calendarId':		'primary',	// calendar ID',	// calendar ID
						'timeMax':			timeMax,
						'timeMin':          timeMin							// pass event details with api call
					});
					
					// handle the response from our api call
					request.execute(function(resp) {
						console.log(resp);
						eventId=resp.items[0].id;
						var request1=gapi.client.calendar.events.delete({
							'calendarId': 'primary',
							'eventId': eventId
						});
						request1.execute(function(resp1){
							console.log(resp1);
							alert('successfully synchronized deletion in Google Calendar');
						})
					});
				});
			}
		</script>
		<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>";
	}
	else
		echo "error";
	
}
else
echo "error";
if(!isset($_POST['mobile']))
		header("refresh:1; url=calendar.php");
	    else
	    	header("refresh:1; url=calendar-m.php");

  }




public function notify($dbc, $currentid){
   $q="select * from calendar where user_id='$currentid'";
date_default_timezone_set("Asia/Hong_Kong");
$currenttime=date('Y-m-d H:i:s');
$i=0;
$result=mysqli_query($dbc, $q);
$dmateid=array();
$dtime=array();
$dlocation=array();
$dmatename=array();
if(!empty($result)){
	$i=0;
	while($row=mysqli_fetch_array($result)){
    $dat=$row['dat'];
    $currenttime=(string)$currenttime;
    $dat1=strtotime($dat);
    $currenttime1=strtotime($currenttime);
    $diff=round(($dat1-$currenttime1)/3600);
    if($diff<=2 and $diff>=0){
     $dmateid[$i]=$row['mate_id'];
     $temp=$dmateid[$i];
     $dtime[$i]=$row['dat'];
     $dlocation[$i]=$row['location'];
     $q2="select username from user_info where user_id='$temp'";
     $result1=mysqli_query($dbc, $q2);
     $row2=mysqli_fetch_array($result1);
     $dmatename[$i]=$row2['username'];
     $i++;
    }
  }
  if($i>0){
  	$j=0;
  	while($j<$i){
  		$tempname=$dmatename[$j];
  		$templo=$dlocation[$j];
  		$tempti=$dtime[$j];
  		echo "<script>alert('You have a date with $tempname at $tempti in $templo !')</script>";
  		$j++;
  	}
 }
}
  }
}
?>