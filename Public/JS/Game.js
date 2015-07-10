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
var suoskill;

window.onload = function()
{
	width = document.body.clientWidth;
	height =  document.body.clientHeight - 100;
	can = document.getElementById("can");
	gam = document.getElementById("gam");
	can.height = height;
	can.width = width;
	ctx = can.getContext("2d");				//创建画布
	
	if(localStorage.length == 0)
	{
		value = 0;
		localStorage.setItem(1,value);
	}
	else
	{
		value = localStorage.getItem(localStorage.key(0));
	}
	
	var id = document.getElementById("history");
	id.value = value+"s";
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
	suoskill = 1;
	sk = 10;
	ks = 0;
	
	ctx.fillStyle = "#000000";
	ctx.fillRect(0,0,width,height);
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
		number = parseInt((width - 10)*Math.random());
		while(judge(number,player_x) <= 100)
		{
			number = parseInt((width - 10)*Math.random());
		}
		monster_x[i] = number;
		number = parseInt((height - 10)*Math.random());
		while(judge(number,player_y) <= 100)
		{
			number = parseInt((height - 10)*Math.random());
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
	if(ax <= 0 || ax >= width-5)
	{
		special_x[i] *= -1;
	}
	if(ay <= 0 || ay >= height-5)
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
				var te = (t-1);
				var key = localStorage.key(0);
				var value = localStorage.getItem(key);
				if(!value)
				{
					value = 0;
				}
				if(t > parseInt(value))
				{
					key = localStorage.key(0);
					localStorage.removeItem(key);
					localStorage.setItem(1 ,te);
					var id = document.getElementById("history");
					id.value = te+"s";
				}
				ctx.fillStyle = "#000000";
				ctx.fillRect(0,0,width,height);
				i = 51;
				j = speed + 1;
				suo = 0;
			}
		}
	}
}

function clear_his()
{
	var key = localStorage.key(0);
	var value = localStorage.getItem(key);
	if(value)
	{
		localStorage.removeItem(key);
	}
	var id = document.getElementById("history");
	id.value = 0+"s";
}

//玩家移动
function player_move(p_move_x,p_move_y)
{
	
	if(suo)
	{
		var p_x = player_x - 10;
		var p_y = player_y - 10;
		if(p_x + p_move_x < 0 || p_x + p_move_x >  width-20 || 
		   p_y + p_move_y < 0 || p_y + p_move_y > height-20){}
		else
		{
			drawarc(player_x,player_y,10,"#000000");
			player_x += p_move_x;
			player_y += p_move_y;
			drawarc(player_x,player_y,10,player_color);
		}
	}
}
document.onkeydown = function(event)
{
	switch(event.keyCode)
	{
		//按空格键开始
		case 32:
			init();
			break;
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
		//B、b放技能
		case 66:
		case 98:
			if(suoskill)
			{
				suoskill = 0;
				clea();
			}
			break;
	}
}

var sk;
var ks;
function player_skill()
{
	if(ks < 150)
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
			ctx.fillRect(0,0,height,height);
			drawarc(player_x,player_y,10,player_color);
			window.clearInterval(time1);
			timer = window.setInterval("monster_move();",  100);
			times = window.setInterval("ac_time();", 1000);
			suoskill = 1;
			return ;
		}
	}
	ks++;
	drawarc(player_x,player_y,sk,player_color);	
}

function clea()
{
	suo = 0;
	time1 = window.setInterval("player_skill();",  1);
	window.clearInterval(times);
	window.clearInterval(timer);
	rand_monster();
}
