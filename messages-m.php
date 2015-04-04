<?php
	require("inbox.php");
	$view=new InboxViewController();
	$view->show_m();
?>
<script>
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
<!--container-end-->
</div>
</div>
</body>
</html>
