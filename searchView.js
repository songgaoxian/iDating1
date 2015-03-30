$(document).ready(function() {
	var conditionCount=9;  //no of conditions in "more conditions"
	$(".portrait > div").height($(".portrait > div").width());
	
	//delete a condition
    $(".item-delete").click(function() {
		$("#more-condition-box").append($(this).parent());
		conditionCount+=1;
		if (conditionCount>0) $("#more-condition").show();
		event.preventDefault();
	});
	
	// add a condition
	 $(".item-add").click(function() {
		$("#more-condition").before($(this).parent());
		conditionCount-=1;
		if (conditionCount==0) {
			$("#more-condition").hide();
			$("#more-condition-box").slideToggle();
		}
		event.preventDefault();
	});
	
	//show more conditions
	$("#more-condition").click(function() {
		$("#more-condition-box").slideToggle();
	});
	
	//search by nickname
	$("#tab-by-name").click(function() {
		$("#tab-by-condition").removeClass("colored-txt-dark");
		$(this).addClass("colored-txt-dark");
		$("#by-condition-form").hide();
		$("#more-condition-box").hide();
	    $("#by-name-form").fadeIn();
	});
	
	//search by conditions
	$("#tab-by-condition").click(function() {
		$("#tab-by-name").removeClass("colored-txt-dark");
		$(this).addClass("colored-txt-dark");
		$("#by-condition-form").fadeIn();
	    $("#by-name-form").hide();
	});
	
	//resize window
	$(window).resize(function() {
		$(".portrait > div").height($(".portrait > div").width());
	});
});