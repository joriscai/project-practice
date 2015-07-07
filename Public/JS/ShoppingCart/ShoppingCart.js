//
//var i = localStorage.length;
//var cou_goods = i;
//$(function(){
//	judge();
//	for(var j = i-1; j >= 0; j--)
//	{
//		var key = localStorage.key(j);
//		var value = localStorage.getItem(key);
//		$("#show").append(value);
//	}
//	$("#addGoods").click(
//		function(){
//			var goods_img = "goods"+(i+1);
//			var text ="<div class='mid_main' id="+i+">"+
//							"<div class='g_checkbox'>"+
//								"<input type='checkbox' checked='checked' name='chgoods' onclick='sel()'/></div>"+
//							"<div class='g_img'>"+
//								"<img src='"+path+"/img/"+goods_img+".png' /></div>"+
//							"<div class='g_name'>这是商品"+(i+1)+"<br />商品</div>"+
//							"<div class='g_price'>"+10+".00</div>"+
//							"<div class='g_quantity'>"+
//								"<div class='g_add'>"+
//									"<a href='javascript:void(0);'><div class='go_add_re'>-</div></a>"+
//									"<input type='text' class='go_text' value='1'></input>"+
//									"<a href='javascript:void(0);'><div class='go_add_re'>+</div></a>"+
//								"</div></div>"+
//							"<div class='g_sum'>"+10+".00</div>"+
//							"<div class='g_action'><a href='javascript:void(0);)'>删除</a>"+
//					  "</div></div>";
//			i=i+1;
//			cou_goods++;
//			localStorage.setItem(i ,text);			
//			judge();
//			$("#show").append(text);
//		});
//		
//	$("#deteleGoods").click(
//		function dele(){
//			if(cou_goods == 0)
//			{
//				alert("请选择至少一件商品！");
//			}
//			else
//			{
//				$("#"+(i-1)).empty();
//				$("#"+(i-1)).remove();
//				i = i - 1;
//				cou_goods--;
//				judge();
//				var key = localStorage.key(i);
//				localStorage.removeItem(key);
//			}
//	});
//	
//	$("#detelechogood").click(
//		function(){
//			if(cou_goods == 0)
//			{
//				alert("请选择至少一件商品！");
//			}
//		}
//	)
//	$("#account").click(
//		function(){
//			alert("...");
//		}
//	)
//	
//});
//
//function judge()
//{
//	if(i == 0)
//	{
//		var t = "<div class='min' id='none'>"+
//				"<div class='show_text'>"+
//				"<ul><li>购物车空空的哦~，去看看心仪的商品吧~</li>"+
//				"<li><a href='../'>去购物></li></ul>"+
//				"</div></div>";
//		$("#none").remove();
//		$("#show").append(t);
//	}
//	else
//	{
//		$("#none").remove();
//	}
//	var allgood = "<b>全部商品   "+i+"</b>";
//	var coun = "已选择  <span style='color: #ff0000;'>"+cou_goods+
//				"</span>  件商品  --- 总价  : <span style='color: #ff0000; font-size: 18px;'>¥ "+(cou_goods*10)+"</span>";
//	$("#ac").empty();
//	$("#all").empty();
//	$("#ac").append(coun);
//	$("#all").append(allgood);
//}
//function iselect(m)
//{
//	var ids = document.getElementsByName("chgoods");
//	var all = document.getElementById("check_all");
//	var al = document.getElementById("check_al");
//	m == 1 ? al.checked = all.checked : all.checked = al.checked;
//	cou_goods = all.checked ? ids.length : 0;
//	judge();
//	for(var j = 0;j < ids.length;++j)
//	{
//		ids[j].checked = all.checked;
//	}
//}
//
//function sel()
//{
//	var ids = document.getElementsByName("chgoods");
//	var all = document.getElementById("check_all");
//	var al = document.getElementById("check_al");
//	var f = 1;
//	cou_goods = 0;
//	for(var j = 0;j < ids.length;++j)
//	{
//		if(ids[j].checked)
//		{
//			cou_goods++;
//		}
//		else
//		{
//			f = 0;
//		}
//	}
//	if(f)
//	{
//		al.checked = all.checked = true;
//	}
//	else
//	{
//		al.checked = all.checked = false;
//	}
//	judge();
//}
//

$(function(){
	$(".num_ad").click(
		function()
		{
			$(this).prev().val(parseInt($(this).prev().val())+1);
		}
	)
	$(".num_re").click(
		function()
		{
			if(parseInt($(this).next().val())-1 <= 0)
			{
				$(this).next().val(1);
			}
			else
			{
				$(this).next().val(parseInt($(this).next().val())-1);
			}
		}
	)
	$(".shopid").keyup(
		function()
		{
			var regx=/^[0-9]{1,20}$/;
			if(!regx.exec($(this).val()))
			{
				$(this).val(1);
			}
		}
	)
	$(".chec").click(
		function()
		{
			if($(this).get(0).checked)
			{
				$(this).parent().parent().removeClass("mid_main2");
				$(this).parent().parent().addClass("mid_main1");
			}
			else
			{
				$(this).parent().parent().removeClass("mid_main1");
				$(this).parent().parent().addClass("mid_main2");
			}
			
		}
	)
})

