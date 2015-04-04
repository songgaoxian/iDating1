<?php
	require("inbox.php");
	$view=new InboxViewController();
	$view->show_m();
?>
<!--footer-start-->
<script>
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
<div class="footer" style="background:white">
<a href="index.html#about-us">About Us</a>
&nbsp;|&nbsp;
<a href="index.html#contact-us">Contact Us</a>
<br><br>
Copyright &copy; 2015 All Rights Reserved.
</div>
</div>
</div>
<!--footer-end-->
<!--messages-end-->
</body>
</html>
