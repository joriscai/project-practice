
$(function(){
	function num_op(op,n,id){
			var p=$('#price_'+id).val();

			
			//小计和总计需要变化
			$.ajax({
				type:"post",
				url:op_num_path,
				async:true,
				data:{
					op:op,
					id:id,
					num:n
				},
				success:function(msg){
					if(parseInt(msg)>=0){
						//g_sum
						var g='.g_sum_'+id;
						$(g).html(n*p);//设置小计
						$('.a_price').html('¥'+msg);
					}else{
						alert(msg);
					}
				}
			});
	}
	$(".num_ad").click(//商品数量增加
		function()
		{
			var id=$(this).attr('value');
			var v=$(this).prev().val(),//获取数量
			n=parseInt(v)+1;//数量加1
			$(this).prev().val(n);
			num_op('a',n,id);
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
			var id=$(this).attr('value');
			num_op('r',$(this).next().val(),id);
		}
	)
	$(".shopid").keyup(
		function()
		{
			var num=$(this).val(),
			id=$(this).attr('shopid');
			if(num==''){
				return;
			}
			
			
			var regx=/^[0-9]{1,20}$/;
			if(!regx.exec(num))
			{
				$(this).val(1);
			}
			num_op('a',num,id);
			
			
			
		}
	)
	
	$(".check_all").click(function()
	{
		m = 1;
		var ids = document.getElementsByName("chgoods");
		var all = document.getElementById("check_all");
		var al = document.getElementById("check_al");
		m == 1 ? al.checked = all.checked : all.checked = al.checked;
		for(var j = 0;j < ids.length;++j)
		{
			ids[j].checked = all.checked;
		}
	})
	
	$(".check_al").click(function()
	{
		m = 0;
		var ids = document.getElementsByName("chgoods");
		var all = document.getElementById("check_all");
		var al = document.getElementById("check_al");
		m == 1 ? al.checked = all.checked : all.checked = al.checked;
		for(var j = 0;j < ids.length;++j)
		{
			ids[j].checked = al.checked;
		}
	})

	window.onload = function()
	{
		sele();
	}
	var sele = function() {
		var ids = document.getElementsByName("chgoods");
		var all = document.getElementById("check_all");
		var al = document.getElementById("check_al");
		var f = 1;
		for(var j = 0;j < ids.length;++j)
		{
			if(ids[j].checked)
			{
//				ids[j].checked = ture;
			}
			else
			{
//				color($(this).parent().parent(),0);
				f = 0;
			}
		}
		if(f)
		{
			al.checked = all.checked = true;
		}
		else
		{
			al.checked = all.checked = false;
		}
	}
	
	var color = function(cla,m)
	{
		if(m)
		{
			cla.removeClass("mid_main2");
			cla.addClass("mid_main1");
		}
		else
		{
			cla.removeClass("mid_main1");
			cla.addClass("mid_main2");
		}
	}
	
	$(".chec").click(
		function()
		{
			//是否选中
			var c=$(this).get(0).checked==false?0:1,
			id=$(this).attr('shopid');
			
			color($(this).parent().parent(),c);
			sele();
			
			//后台操作
			$.ajax({
				type:"post",
				url:op_s_path,
				async:true,
				data:{
					c:c,
					id:id
				},
				success:function(msg){
					
					if(typeof(msg)=='object'){
						$('.a_price').html('¥'+msg.ap);
						$('.a_count').html(msg.acount);
					}else{
						alert(msg)
					}
					
				}
			});
			
			
		}
	)
	
	$('.good_d').click(function(){
		id=$(this).attr('value');
		$.ajax({
			type:"post",
			url:op_del_path,
			async:true,
			data:{
				id:id
			},
			success:function(msg){
				if(msg==2){
					window.location=home_path;
				}else if(msg==0){
					alert('操作失败');
				}else if(typeof(msg)=='object'){
					$('.a_price').html('¥'+msg.ap);
					$('.a_count').html(msg.acount);
					$('#all_'+id).remove();
				}else{
					alert(msg);
				}
			}
		});
		
	})
})

