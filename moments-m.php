<?php
	require("moment.php");
	$view=new PictureViewController();
	$view->upload_picture();
	$view->show_pictures_m();
?>
<!--overlay-start-->
<!--upload-pic-box-start-->
<div id="upload-pic-box" class="overlay">
<div class="header">
<img class="close-overlay" src="img/close_overlay.png" alt="back">
<h1>Upload My Moment</h1>
</div>
<div class="overlay-content">
<form action="moments.php" enctype="multipart/form-data" method="post">
<input class="txtbox txtbox-fill" type="file" name="filename" required><br>
<input class="txtbox txtbox-fill" type="date" name="take_date" required><br>
<input class="txtbox txtbox-fill" type="text" placeholder="Title" name="title" required><br>
<textarea class="txtbox txtbox-fill" placeholder="Comments" name="descrp"></textarea>
<input id="upload-now" class="btn btn-fill" type="submit" value="Upload">
</form>
</div>
</div>
<!--upload-pic-box-end-->
<!--pic-detail-box-start-->
<div id="pic-detail-box" class="overlay" >
<div class="header">
<img class="close-overlay" src="img/close_overlay.png" alt="back">
<h1>My Moment</h1>
</div>
<div class="overlay-content">
<a href="#"><img id="detail-pic" src="" alt="moment"></a>
<div id="pic-details-text">
<table>
  <tr>
    <td class="item-name colored-txt">Taken Date: </td>
    <td class="item-content"id="takendate"></td>
    <td class="item-name colored-txt">Upload Date: </td>
    <td class="item-content" id="update"></td>
  </tr>
</table>
<p id="p_content"></p>
</div>
<script type="application/javascript">
function get_info(id){
	var p=document.getElementById("p_content");
	var update=document.getElementById("update");
	var tokendate=document.getElementById("takendate");
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
} var left=1;
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
</div>
</div>
<!--pic-detail-box-end-->
<!--overlay-end-->
</div>
</div>
</body>
</html>
