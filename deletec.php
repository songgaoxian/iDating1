<?php
require("session.php");
session_start();
$session=new Session();
$uid=$session->get_uid();
$dbc=connect();
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
		header("refresh:1; url=calendar.php");
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
header("refresh:5;url=calendar.php");
?>
