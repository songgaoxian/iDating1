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
<html lang="en">
<head>
<meta charset="utf-8">
<?php
$theme=new theme();
echo "<link rel='stylesheet' type='text/css' href='".$theme->getTheme()."-theme.css'>";
?>
<link rel="stylesheet" type="text/CSS" href="shared-frame-m.css">
<link rel="stylesheet" type="text/CSS" href="calendar-m.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$(".date-portrait").height($(".date-portrait").width());
	
	$("#nav").click(function() {
		$(".sidebar").slideToggle();
	});
	
	$("#add").click(function() {
		$("#add-event-box").fadeIn();   
	});
	
	//close overlay
	$(".close-overlay").click(function() {
		$(this).parent().parent().fadeOut();
	});
	
	//resize window
	$(window).resize(function() {
		$(".date-portrait").height($(".date-portrait").width());
	});
   
   $("td").click(function(){
   	$(".detail-form").remove();
   	$("#selected-date").removeAttr("id");
   	$(this).attr('id','selected-date');
   	var day=$(this).attr('class');
   	var month=$('#current').attr('class');
   	if(day=='0'){
   		alert("chose a valid day");
   		event.preventDefault();
   	}
   	else
   		send(day, month);
   })
});
function send(day, month){
	$.ajax({
		dataType:'json',
		data: {day: day,
		       month: month},
		url: 'cdetail-m.php',
		type: 'POST',
		success: function(result){
			console.log(result);
			if(result.length>0){
              for(i=0;i<result.length;i++){
              	$("#all-event").append("<form action='deletec.php' class='detail-form' method='post' id='form-"+i+"'>");
              	$("#form-"+i).append("<div class='date-detail' id='date-"+i+"'>");
              	$("#date-"+i).append("<h3>"+result[i]['matename']+"</h3>");
              	$("#date-"+i).append("<p>"+result[i]['time']+" @ "+result[i]['location']+"</p>");
              	$("#form-"+i).append("<input type='hidden' name='dateid1' value='"+result[i]['dateid']+"'>");
                $("#form-"+i).append("<input type='hidden' name='dat1' value='"+result[i]['time']+"'>");
                $("#form-"+i).append("<input type='hidden' name='mateid1' value='"+result[i]['mateid']+"'>");
                $("#form-"+i).append("<input type='hidden' name='mobile' value='1'>");
                $("#form-"+i).append("<input type='submit' value='Delete' class='btn btn-sml'>");
              }
			}
		}
	});
}
</script>
<title>iDating - Calendar</title>
</head>

<body>
<?php
require("calView-m.php");
$cal=new CalView();
$cal->showCal($dmonth, $ddmonth, $wkd, $dbc, $currentid);
?>
</body>
</html>
