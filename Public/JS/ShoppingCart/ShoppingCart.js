
var i = localStorage.length;
$(function(){
	judge();
	for(var j = 0; j < localStorage.length; j++)
	{
		var key = localStorage.key(j);
		var value = localStorage.getItem(key);
		$("#show").append(value);
	}
	$("#addGoods").click(
		function(){
			var text ="<div class='mid_main' id="+i+">"+
							
					  "</div>";
			i=i+1;
			var time = new Date().getTime();
			localStorage.setItem(time ,text);			
			judge();
			$("#show").append(text);
		});
		
	$("#deteleGoods").click(
		function(){
			if(i == 0)
			{
				alert("请选择至少一件商品！");
			}
			else
			{
				$("#"+(i-1)+"").remove();
				i=i-1;
				judge();
				var key = localStorage.key(i);
				localStorage.removeItem(key);
			}
	});
	
	$("#detelegood").click(
		function(){
			if(i == 0)
			{
				alert("请选择至少一件商品！");
			}
		}
	)
	$("#account").click(
		function(){
			alert("...");
		}
	)
	
});

function judge()
{
	if(i == 0)
	{
		var t = "<div class='min' id='none'>"+
				"<div class='show_text'>"+
				"<ul><li>购物车空空的哦~，去看看心仪的商品吧~</li>"+
				"<li><a href='../'>去购物></li></ul>"+
				"</div></div>";
		$("#show").append(t);
	}
	else
	{
		$("#none").remove();
	}
	var allgood = "<b>全部商品   "+i+"</b>";
	var coun = "已选择  <span style='color: #ff0000;'>"+i+
				"</span>  件商品  --- 总价  : <span style='color: #ff0000; font-size: 15px;'>¥ "+i*10+"</span>";
	$("#ac").empty();
	$("#all").empty();
	$("#ac").append(coun);
	$("#all").append(allgood);
}