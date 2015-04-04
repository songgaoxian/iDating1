$(document).ready(function() {
	//show add dating dialog
     $("td").click(function(event) {
      date11=$(this).attr('class');
      if(date11=='0'){
        alert("Please choose a valid day.");
        event.preventDefault();
      }
    else{
		if ($("#event-detail-box").css("display")!="block") {
		  $("body").append("<div class='mask'></div>");
		  month=$("table").attr('class');
		  
      if($("[name=month]").length>0)
        $("[name=month]").remove();
      if($("[name=day]").length>0)
        $("[name=day]").remove();
		  $("#composer").append("<input type='hidden' name='month' value='"+month+"'>");
		  $("#composer").append("<input type='hidden' name='day' value='"+date11+"'>");
	      $(".overlay-container").show();
		  $("#add-event-box").css("margin-top",($(".overlay-container").height()*0.95-$("#add-event-box").height())/2);
		  $("#add-event-box").slideDown();
		}
  }
	});
	
	//close overlay
	$(".close-overlay").click(function() {
		$(this).parent().slideUp("slow", function(){$(".overlay-container").hide();$(".mask").remove();});
	});
	
	//show event details dialog
	$(".event-box").click(function() {
		$("body").append("<div class='mask'></div>");
		$(".overlay-container").show();
		$("#event-detail-box").css("margin-top",($(".overlay-container").height()*0.95-$("#event-detail-box").height())/2);
    $("#event-detail-box").slideDown();

    dateid=$(this).attr('id');
   send(dateid);
	    
	});
	
	//resize window
	$(window).resize(function() {
        $(".overlay").css("margin-top",($(".overlay-container").height()*0.95-$(".overlay").height())/2);
    });
});
function send(dateid){
        $.ajax({
      dataType: 'json',
      data: {D: dateid},
      url: 'cdetail.php',
      type: 'POST',
      success: function(result){
        console.log(result);
        matename1=result[0];
        dat1=result[1];
        content1=result[2];
        location1=result[3];
        dtid1=result[4];
        mateid1=result[5];
        if($("#detail-table").length>0)
          $("#detail-table").remove();
		  if($("#detail-p").length>0)
          $("#detail-p").remove();
        	  
		  $("#detailc").before("<table id='detail-table'><tr><td class='item-name colored-txt'>Date Partner:</td><td class='item-content'>"+matename1+"</td></tr><tr><td class='item-name colored-txt'>Time:</td><td class='item-content'>"+dat1+"</td></tr><tr><td class='item-name colored-txt'>Location:</td><td class='item-content'>"+location1+"</td></tr></table>");
		  $("#detailc").before("<p id='detail-p'>"+content1+"</p>");
         }
    });
}

$(window).load(function(){  var additionalParams = {
     'clientid': '480928246860-md5e151tk2n8fgjpctphhk9rl7hj6ler.apps.googleusercontent.com',
     'cookiepolicy': 'single_host_origin',
     'callback': 'signinCallback'
   };
  var signinButton = document.getElementById('signinButton');
   signinButton.addEventListener('click', function() {
     gapi.auth.signIn(additionalParams);
      })
}
)
 function signinCallback(authResult) {
  accessToken=authResult.access_token;
  if (authResult['status']['signed_in']) {
    document.getElementById('signinButton').setAttribute('style', 'display: none');
  } else {
   console.log('Sign-in state: ' + authResult['error']);
  }

}