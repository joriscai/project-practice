//怪物的圆心坐标
var monster_x = [];
var monster_y = [];
//怪物颜色
var monster_color = [];
//15个特殊怪物
var special_x = [];
var special_y = [];
//玩家圆心坐标
var player_x;
var player_y;
//玩家颜色
var player_color = "#00f";
//玩家位移量
var p_move_x;
var p_move_y;
//怪物位移量
var m_move_x;
var m_move_y;
//怪物移动监听器id
var timer;
//计时监听器id
var times;
//创建画布
var can;
var ctx;
//随机颜色、随机坐标
var number;
//怪物颜色
colors = ["#fff", "#f00", "#0f0", "#00f", "#c60", "#f0f", "#0ff", "#609"];
//记录时间
var time;
//怪物移动速度
var speed;
//判断是否撞到
var isplay;
//能量条
var energy;
//游戏时间
var t;
//锁
var suo;
var time1;



window.onload = function()
{
	can = document.getElementById("can");
	ctx = can.getContext("2d");				//创建画布
	
//	ctx.fillStyle = "#ffffff";
//	ctx.fillRect(0,0,720,9);				//绘制能量条
//	ctx.fillStyle = "#9cfcfb";				//信息显示区颜色
//	ctx.fillRect(601,9,720,420);			//绘制信息显示区
	
}
//渐变色
function change_color(a,b,c)
{
	//创建渐变色
	var gradient = ctx.createLinearGradient(0,0,600,0);
	gradient.addColorStop("0",a);
	gradient.addColorStop("0.5",b);
	gradient.addColorStop("1.0",c);
	
	return gradient;
}
//画圆(圆心横坐标，圆心纵坐标，半径，颜色)
function drawarc(x,y,r,c)
{
	ctx.beginPath();
	ctx.fillStyle = c;
	ctx.arc(x,y,r,0,Math.PI*2);
	ctx.fill();
	ctx.stroke();
	ctx.closePath();
}
//初始化
function init()
{
	player_x = 10;
	player_y = 20;
	p_move_x = 0;
	p_move_y = 0;
	m_move_x = 0;
	m_move_y = 0;
	time = 0;
	speed = 1;
	isplay = 0;
	t = 0;
	suo = 1;
	sk = 10;
	ks = 0;
	
	ctx.fillStyle = "#000000";
	ctx.fillRect(0,0,720,420);
	drawarc(player_x,player_y,10,player_color);
	rand_monster();
	for(var i = 0;i < 50; ++i)
	{
		drawarc(monster_x[i],monster_y[i],3,colors[monster_color[i]]);
	}
	if(timer)
	{
		window.clearInterval(timer);
	}
	if(times)
	{
		window.clearInterval(times);
	}
	if(time1)
	{
		window.clearInterval(time1);
	}
	timer = window.setInterval("monster_move();",  100);
	times = window.setInterval("ac_time();", 1000);
}

function judge(n,m)
{
	var max = (n >= m ? n : m);
	var min = (n <= m ? n : m);
	return max - min;
}
//怪物随机分布、随机颜色
function rand_monster()
{
	for(var i = 0;i < 50;++i)
	{
		number = parseInt(8*Math.random());
		monster_color[i] = number;
		number = parseInt(700*Math.random());
		while(judge(number,player_x) <= 100)
		{
			number = parseInt(700*Math.random());
		}
		monster_x[i] = number;
		number = parseInt(400*Math.random());
		while(judge(number,player_y) <= 100)
		{
			number = parseInt(400*Math.random());
		}
		monster_y[i] = number;
	}
	for(var i = 30;i < 50;++i)
	{
		number = (parseInt(2*Math.random()) == 1 ? parseInt(4*Math.random()) : -parseInt(4*Math.random()));
		special_x[i] = number;
		number = (parseInt(2*Math.random()) == 1 ? parseInt(4*Math.random()) : -parseInt(4*Math.random()));
		special_y[i] = number;
	}
}
//计算圆心距离
function dis(x1,y1,x2,y2)
{
	var d2 = (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2);
	if(d2 <= 13*13)
	{
		isplay = 1;
	}
	else
	{
		isplay = 0;
	}
}
//计时
function ac_time()
{
	time++;
	t++;
}
//怪物移动偏移量
function m_move(mon_x,mon_y)
{
	m_move_x = (mon_x == player_x ? 0 : (mon_x < player_x ? parseInt(5*Math.random()) : -parseInt(5*Math.random())));
	m_move_y = (mon_y == player_y ? 0 : (mon_y < player_y ? parseInt(5*Math.random()) : -parseInt(5*Math.random())));
}
//怪物移动反弹偏移量
function m_move1(ax,ay,i)
{
	if(ax <= 0 || ax >= 715)
	{
		special_x[i] *= -1;
	}
	if(ay <= 0 || ay >= 415)
	{
		special_y[i] *= -1;
	}
	m_move_x = special_x[i];
	m_move_y = special_y[i];
}
//怪物移动
function monster_move()
{
	for(var j = 0;j < speed;++j)
	{
		if(time == 10)
		{
			time = 0;
			window.clearInterval(timer);
			timer = window.setInterval("monster_move();" , 100);
			speed *= 2;
		}
		for(var i = 0;i < 50; ++i)
		{
			i < 30 ? m_move(monster_x[i],monster_y[i]) : m_move1(monster_x[i],monster_y[i],i);
			drawarc(monster_x[i],monster_y[i],3,"#000000");
			monster_x[i] += m_move_x;
			monster_y[i] += m_move_y;
			drawarc(monster_x[i],monster_y[i],3,colors[monster_color[i]]);
			dis(monster_x[i],monster_y[i],player_x,player_y);
			if(isplay)
			{
				window.clearInterval(timer);
				window.clearInterval(times);
				alert("游戏结束！\n当前速度为:"+speed+"\n坚持的时间为："+(t-1)+"秒\n继续加油！！！");
				ctx.fillStyle = "#000000";
				ctx.fillRect(0,0,720,420);
				i = 51;
				j = speed + 1;
				suo = 0;
			}
		}
	}
}
//玩家移动
function player_move(p_move_x,p_move_y)
{
	var p_x = player_x - 10;
	var p_y = player_y - 10;
	if(p_x + p_move_x < 0 || p_x + p_move_x >  700 || 
	   p_y + p_move_y < 0 || p_y + p_move_y > 400){}
	else
	{
		drawarc(player_x,player_y,10,"#000000");
		player_x += p_move_x;
		player_y += p_move_y;
		drawarc(player_x,player_y,10,player_color);
	}
}
document.onkeydown = function(event)
{
	if(suo)
	{
		switch(event.keyCode)
		{
			// 按下了“向下”箭头
			case 40:
			case 83:
			case 115:
				player_move(0,10);
				break;
			// 按下了“向左”箭头
			case 37:
			case 65:
			case 97:
				player_move(-10,0);
				break;
			// 按下了“向右”箭头
			case 39:
			case 68:
			case 100:
				player_move(10,0);
				break;
			// 按下了“向上”箭头
			case 38:
			case 87:
			case 119:
				player_move(0,-10);
				break;
			case 66:
			case 98:
				clea();
				break;
			
		}
	}
}

var sk;
var ks;
function player_skill()
{
	if(ks < 80)
	{
		sk += 10;
	}
	else
	{
		drawarc(player_x,player_y,sk,"#000000");
		sk -= 10;
		if(sk == 10)
		{
			sk = 10;
			ks = 0;
			suo = 1;
			ctx.fillStyle = "#000000";
			ctx.fillRect(0,0,720,420);
			drawarc(player_x,player_y,10,player_color);
			window.clearInterval(time1);
			timer = window.setInterval("monster_move();",  100);
			times = window.setInterval("ac_time();", 1000);
			return ;
		}
	}
	ks++;
	drawarc(player_x,player_y,sk,player_color);	
}

function clea()
{
	suo = 0;
	time1 = window.setInterval("player_skill();",  10);
	window.clearInterval(times);
	window.clearInterval(timer);
	rand_monster();
}