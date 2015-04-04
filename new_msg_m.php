<?php
	require("message.php");
	$view=new MessageViewController();
	$view->show_new1();
?>
<script type="application/javascript">
	var url=document.URL;
	email=url.split('&email=');
	if(email.length>1){
		email=email[1];
		document.getElementById("email").value=email;
	}
	function send(){
		content={
			"content":document.getElementById("text").value,
			"email":document.getElementById("email").value
		};
		content=JSON.stringify(content);
		xmlhttp=new XMLHttpRequest(); 
		xmlhttp.open("POST","send.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		console.log(record);
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			window.location="messages-m.php";
		}
		else{
			alert("error...");
		}
	}
	 var left=1;
	$('#nav').click(
	function() {
		if(left==1){
			$('#B').animate({left: 200});left=0;
			$('#C').css('overflow','hidden');
		}
	    else{
			$('#B').animate({left: 0});left=1;
			$('#C').css('overflow','scroll');
		}
	});
</script>
<!--content-end-->

