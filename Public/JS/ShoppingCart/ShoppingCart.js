var i=0;
$(function(){
	$("#a").click(
		function(){
			var text =$("<div class='mid_main' id='"+i+"'></div>");
			i=i+1;
			$("#c").append(text);
		});
		
	$("#b").click(function(){
		$("#"+(i-1)+"").remove();
		i=i-1;
	});
});