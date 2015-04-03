<?php
	require("message.php");
	$view=new MessageViewController();
	$view->show_m();
?>
<script type="application/javascript">
	function send(){
		var temp=document.getElementById("text").value;
		if(temp.length==0){return;}
		content={
			"content":document.getElementById("text").value,
			"with_id":document.URL.split('=')[1]
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
			location.reload();
		}
		else{
			alert("error...");
		}
	}
	
</script>
<!--content-end-->

<!--footer-start-->
<div class="footer">
<a href="index.html#about-us">About Us</a>
&nbsp;|&nbsp;
<a href="index.html#contact-us">Contact Us</a>
<br><br>
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->
</body>
</html>
