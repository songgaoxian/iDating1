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
	 var left=1;
	$('#nav').click(
	function() {
		if(left==1){
			$('#B').animate({left: 150});left=0;
			$('#C').css('overflow','hidden');
		}
	    else{
			$('#B').animate({left: 0});left=1;
			$('#C').css('overflow','scroll');
		}
	});
</script>
<!--content-end-->
</body>
</html>
