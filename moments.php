<?php
	require("moment.php");
	$view=new PictureViewController();
	$view->upload_picture();
	$view->show_pictures();
?>
<!--momentWall-end-->

<!--content-end-->

<div id="upload-pic-box" class="overlay" >
<button class="close-overlay btn" type="button">X</button>
<h2 class="colored-txt">Upload My Moment</h2>
<form action="moments.php" enctype="multipart/form-data" method="post">
<input class="txtbox txtbox-fill" type="file" name="filename" required></input><br>
<input class="txtbox txtbox-fill" type="date" name="taken-date" required></input><br>
<input class="txtbox txtbox-fill" type="text" placeholder="title" name="title" required></input><br>
<textarea class="txtbox txtbox-fill" placeholder="Comments" name="descrp"></textarea>
<input id="upload-now" class="btn btn-fill" type="submit" value="Upload">
</form>
</div>
<div id="pic-detail-box" class="overlay" >
<button class="close-overlay btn" type="button">X</button>
<h2 class="colored-txt">My Moment</h2>
<a href="#"><img id="detail-pic" src="" alt="moment"></a>
<table>
<tr>
<td class="colored-txt">Taken Date: </td>
<td id="tokendate"></td>
</tr>
<tr>
<td class="colored-txt">Upload Date: </td>
<td id="update"></td>
</tr>
</table>
<p id="p_content"></p>
</div>
<script type="application/javascript">
function get_info(id){
	var p=document.getElementById("p_content");
	var update=document.getElementById("update");
	var tokendate=document.getElementById("tokendate");
	//create xmlHttpRequest and send info to login.php
	xmlhttp=new XMLHttpRequest(); 
		//may be not secure......
	content='{"pic_id":"'+id+'"}';
	console.log(content);
	xmlhttp.open("POST","pic_info.php",false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(content);
//get response from login.php
	console.log(xmlhttp);
	record=xmlhttp;
	response=JSON.parse(xmlhttp.response);
	if(response['check']=='true'){
		p.textContent=response['summary'];
		update.textContent=response['upload_date'];
		tokendate.textContent=response['take_date'];
	}
	else if(response['check']=='false'){
		//error message needs modification
		alert("Email or password is wrong!");
	}
	else{//if !$conn in login.php
		alert("System is busy. Please try again!");
	}
}
</script>
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
