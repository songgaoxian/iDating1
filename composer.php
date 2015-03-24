<?php
require("session.php");
session_start();
$dbc=connect();
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
	if($result){
		$row=mysqli_fetch_array($result);
		$mateid=$row['user_id'];
	$q1="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$uid', '$mateid', '$dat', '$content','$location')";
	$q2="insert into calendar (user_id, mate_id, dat, content, location)
	                  values('$mateid', '$uid', '$dat', '$content', '$location')";
	if(mysqli_query($dbc, $q1) and mysqli_query($dbc, $q2))
		echo "<script>alert('Date event is successfully created');</script>";
	else
		echo "<script>alert('error')</script>";}
	else
	{
		echo "error";
	}
}
else{
	echo "<script>alert('Please give all valid inputs')</script>";
	if(isset($month))
    header("refresh:1; url=calendar.php?month=$month");
    else
    header("refresh:1; url=calendar.php");
}
echo "
<script type='text/javascript'>
			var clientId = '480928246860-md5e151tk2n8fgjpctphhk9rl7hj6ler.apps.googleusercontent.com';
			var apiKey = 'AIzaSyCcmCqx5nEX1tfeNrsiDN5OkTsHlnfk4Q0';
			var scopes = 'https://www.googleapis.com/auth/calendar';
            var resource=$resource;
 
			// Oauth2 functions
			function handleClientLoad() {
				
				gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
			}
 
			// show/hide the 'authorize' button, depending on application state
			function handleAuthResult(authResult) {
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
							alert('success'); 
						else 
						alert('fail');
						console.log(resp);
					});
				});
			}
		</script>
		<script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>";
/*if(isset($month))
header("refresh:1; url=calendar.php?month=$month");
else
header("refresh:1; url=calendar.php");*/
?>