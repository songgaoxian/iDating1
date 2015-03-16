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
<td>1990-01-01</td>
</tr>
<tr>
<td class="colored-txt">Upload Date: </td>
<td>2015-03-15</td>
</tr>
</table>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
</div>

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
