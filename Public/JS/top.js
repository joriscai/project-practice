$(function() {
	//控制出现列菜单栏
	$(".dt ").hover(function() {
		$(".dd").fadeIn();
		$("#nav-flag").removeClass("nav-bn1").addClass("nav-bn2");
	}, function() {
		//$(".dorpdown").find(".dd").fadeOut();	
	});
	$("#categorys").mouseleave(function() {
		$(".dorpdown").find(".dd").fadeOut();
		$("#nav-flag").removeClass("nav-bn2").addClass("nav-bn1");
	});

	//控制出现子菜单栏
	$(".dd .item").hover(function() {

		$(".dorpdown-layer").fadeIn().css("z-index", "50");
		var index = $(this).index(".dd-inner .item");
		$(this).addClass("hover").siblings().removeClass("hover");

		$($(".dorpdown-layerin")[index]).fadeIn().siblings().css("display", "none");

	}, function() {});
	$(".dd").mouseleave(function() {
		$(".dorpdown-layer").fadeOut();
		$(".dorpdown-layerin").fadeOut();
		$(".dd-inner .item").removeClass("hover");
	});
})