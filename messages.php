<?php
	require("inbox.php");
	$view=new InboxViewController();
	$view->show();
?>
<script type="application/javascript">
	function del(){
		checking=document.getElementsByClassName('checking');
		content={};
		dele=[];
		for(i in checking){
			if(checking[i].checked==true){
				content[i]=checking[i].value;
				dele[i]=checking[i];
			}
		}
		content=JSON.stringify(content);
		xmlhttp=new XMLHttpRequest(); 
		xmlhttp.open("POST","del_inbox.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		console.log(record);
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){
			for(i in dele){
				temp=dele[i].parentNode.parentNode.parentNode;
				ul=temp.parentNode;
				ul.removeChild(temp);
			}
		}
		else{
			alert("error...");
		}
	}
	function msg_read(){
		checking=document.getElementsByClassName('checking');
		content={};
		dele=[];
		for(i in checking){
			if(checking[i].checked==true){
				content[i]=checking[i].value;
				checking[i].checked=false;
			}
		}
		content=JSON.stringify(content);
		xmlhttp=new XMLHttpRequest(); 
		xmlhttp.open("POST","msg_read.php",false);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(content);console.log(xmlhttp);
		record=xmlhttp;
		console.log(record);
		response=JSON.parse(xmlhttp.response);
		if(response['check']=='true'){}
		else{
			alert("error...");
		}
	}	
	
</script>
<!--content-end-->

<!--footer-start-->
<div class="footer">
Copyright &copy; 2015 All Rights Reserved.
</div>
<!--footer-end-->



</body>
</html>
