<?php
if($db_act=='create_db'){
	return 
	"DROP DATABASE IF EXISTS $db_name;
	CREATE DATABASE $db_name CHARACTER SET utf8;";
	
}elseif($db_act=='create_table'){
	return 
	"use $db_name;
	set names 'utf8';
	create table user(
	id int(10) not null primary key auto_increment,
	name varchar(32) not null unique,
	sex tinyint(2) not null,
	pwd char(32) not null,
	email varchar(20) not null unique,
	birth int(10) not null,
	city int(10) not null,
	province int(10) not null
	);
	create table promary(
	proID int primary key,
	proName varchar(50) not null
	);
	create table city(
	cityID int not null,
	cityName varchar(50) primary key,
	proID int
	);
	create table shopcat(
	shopid int not null,
	user_id int not null,
	isselect tinyint(2) not null,
	number int not null,
	primary key(user_id,shopid)
	);
	create table menu(
	menuid int(10) not null primary key  auto_increment,
	sellerid int(10) not null,
	buyerid int(10) not null,
	msg text not null,
	address varchar(50) not null,
	name varchar(32) not null,
	pnumber varchar(12) not null,
	price int not null
	);
	create table goods(
	good_id int(10) not null primary key auto_increment,
	good_name varchar(50) not null,
	seller_id int(10) not null,
	good_limg text not null,
	good_bimg text not null,
	price float not null,
	oprice float not null,
	msg varchar(30) not null,
	info text not null,
	info_img text not null,
	cate int not null
	);"
	;
}elseif($db_act="insert_data"){
	return "insert into promary values(1,'北京');
	insert into promary values(2,'天津');
insert into promary values(3,'上海');
insert into promary values(4,'重庆');
insert into promary values(5,'河北');
insert into promary values(6,'山西');
insert into promary values(7,'台湾');
insert into promary values(8,'辽宁');
insert into promary values(9,'吉林');
insert into promary values(10,'黑龙江');
insert into promary values(11,'江苏');
insert into promary values(12,'浙江');
insert into promary values(13,'安徽');
insert into promary values(14,'福建');
insert into promary values(15,'江西');
insert into promary values(16,'山东');
insert into promary values(17,'河南');
insert into promary values(18,'湖北');
insert into promary values(19,'湖南');
insert into promary values(20,'广东');
insert into promary values(21,'甘肃');
insert into promary values(22,'四川');
insert into promary values(24,'贵州');
insert into promary values(25,'海南');
insert into promary values(26,'云南');
insert into promary values(27,'青海');
insert into promary values(28,'陕西');
insert into promary values(29,'广西');
insert into promary values(30,'西藏');
insert into promary values(31,'宁夏');
insert into promary values(32,'新疆');
insert into promary values(33,'内蒙古');
insert into promary values(34,'澳门');
insert into promary values(35,'香港');
insert into city values(1,'北京',1);
insert into city values(1,'天津',2);
insert into city values(1,'上海',3);
insert into city values(1,'重庆',4);
insert into city values(1,'石家庄',5);
insert into city values(2,'唐山',5);
insert into city values(3,'秦皇岛',5);
insert into city values(4,'邯郸',5);
insert into city values(5,'邢台',5);
insert into city values(6,'保定',5);
insert into city values(7,'张家口',5);
insert into city values(8,'承德',5);
insert into city values(9,'沧州',5);
insert into city values(10,'廊坊',5);
insert into city values(11,'衡水',5);
insert into city values(1,'太原',6);
insert into city values(2,'大同',6);
insert into city values(3,'阳泉',6);
insert into city values(4,'长治',6);
insert into city values(5,'晋城',6);
insert into city values(6,'朔州',6);
insert into city values(7,'晋中',6);
insert into city values(8,'运城',6);
insert into city values(9,'忻州',6);
insert into city values(10,'临汾',6);
insert into city values(11,'吕梁',6);
insert into city values(1,'台北',7);
insert into city values(2,'高雄',7);
insert into city values(3,'基隆',7);
insert into city values(4,'台中',7);
insert into city values(5,'台南',7);
insert into city values(6,'新竹',7);
insert into city values(7,'嘉义',7);
insert into city values(9,'宜兰',7);
insert into city values(10,'桃园',7);
insert into city values(12,'苗栗',7);
insert into city values(14,'彰化',7);
insert into city values(15,'南投',7);
insert into city values(16,'云林',7);
insert into city values(20,'屏东',7);
insert into city values(21,'澎湖',7);
insert into city values(22,'台东',7);
insert into city values(23,'花莲',7);
insert into city values(1,'沈阳',8);
insert into city values(2,'大连',8);
insert into city values(3,'鞍山',8);
insert into city values(4,'抚顺',8);
insert into city values(5,'本溪',8);
insert into city values(6,'丹东',8);
insert into city values(7,'锦州',8);
insert into city values(8,'营口',8);
insert into city values(9,'阜新',8);
insert into city values(10,'辽阳',8);
insert into city values(11,'盘锦',8);
insert into city values(12,'铁岭',8);
insert into city values(13,'朝阳',8);
insert into city values(14,'葫芦岛',8);
insert into city values(1,'长春',9);
insert into city values(2,'吉林',9);
insert into city values(3,'四平',9);
insert into city values(4,'辽源',9);
insert into city values(5,'通化',9);
insert into city values(6,'白山',9);
insert into city values(7,'松原',9);
insert into city values(8,'白城',9);
insert into city values(9,'延边',9);
insert into city values(1,'哈尔滨',10);
insert into city values(2,'齐齐哈尔',10);
insert into city values(3,'鹤岗',10);
insert into city values(4,'双鸭山',10);
insert into city values(5,'鸡西',10);
insert into city values(6,'大庆',10);
insert into city values(7,'伊春',10);
insert into city values(8,'牡丹江',10);
insert into city values(9,'佳木斯',10);
insert into city values(10,'七台河',10);
insert into city values(11,'黑河',10);
insert into city values(12,'绥化',10);
insert into city values(13,'大兴安岭',10);
insert into city values(1,'南京',11);
insert into city values(2,'无锡',11);
insert into city values(3,'徐州',11);
insert into city values(4,'常州',11);
insert into city values(5,'苏州',11);
insert into city values(6,'南通',11);
insert into city values(7,'连云港',11);
insert into city values(8,'淮安',11);
insert into city values(9,'盐城',11);
insert into city values(10,'扬州',11);
insert into city values(11,'镇江',11);
insert into city values(12,'泰州',11);
insert into city values(13,'宿迁',11);
insert into city values(1,'杭州',12);
insert into city values(2,'宁波',12);
insert into city values(3,'温州',12);
insert into city values(4,'嘉兴',12);
insert into city values(5,'湖州',12);
insert into city values(6,'绍兴',12);
insert into city values(7,'金华',12);
insert into city values(8,'衢州',12);
insert into city values(9,'舟山',12);
insert into city values(10,'台州',12);
insert into city values(11,'丽水',12);
insert into city values(1,'合肥',13);
insert into city values(2,'芜湖',13);
insert into city values(3,'蚌埠',13);
insert into city values(4,'淮南',13);
insert into city values(5,'马鞍山',13);
insert into city values(6,'淮北',13);
insert into city values(7,'铜陵',13);
insert into city values(8,'安庆',13);
insert into city values(9,'黄山',13);
insert into city values(10,'滁州',13);
insert into city values(11,'阜阳',13);
insert into city values(12,'宿州',13);
insert into city values(13,'巢湖',13);
insert into city values(14,'六安',13);
insert into city values(15,'亳州',13);
insert into city values(16,'池州',13);
insert into city values(17,'宣城',13);
insert into city values(1,'福州',14);
insert into city values(2,'厦门',14);
insert into city values(3,'莆田',14);
insert into city values(4,'三明',14);
insert into city values(5,'泉州',14);
insert into city values(6,'漳州',14);
insert into city values(7,'南平',14);
insert into city values(8,'龙岩',14);
insert into city values(9,'宁德',14);
insert into city values(1,'南昌',15);
insert into city values(2,'景德镇',15);
insert into city values(3,'萍乡',15);
insert into city values(4,'九江',15);
insert into city values(5,'新余',15);
insert into city values(6,'鹰潭',15);
insert into city values(7,'赣州',15);
insert into city values(8,'吉安',15);
insert into city values(9,'宜春',15);
insert into city values(10,'抚州',15);
insert into city values(11,'上饶',15);
insert into city values(1,'济南',16);
insert into city values(2,'青岛',16);
insert into city values(3,'淄博',16);
insert into city values(4,'枣庄',16);
insert into city values(5,'东营',16);
insert into city values(6,'烟台',16);
insert into city values(7,'潍坊',16);
insert into city values(8,'济宁',16);
insert into city values(9,'泰安',16);
insert into city values(10,'威海',16);
insert into city values(11,'日照',16);
insert into city values(12,'莱芜',16);
insert into city values(13,'临沂',16);
insert into city values(14,'德州',16);
insert into city values(15,'聊城',16);
insert into city values(16,'滨州',16);
insert into city values(17,'菏泽',16);
insert into city values(1,'郑州',17);
insert into city values(2,'开封',17);
insert into city values(3,'洛阳',17);
insert into city values(4,'平顶山',17);
insert into city values(5,'安阳',17);
insert into city values(6,'鹤壁',17);
insert into city values(7,'新乡',17);
insert into city values(8,'焦作',17);
insert into city values(9,'濮阳',17);
insert into city values(10,'许昌',17);
insert into city values(11,'漯河',17);
insert into city values(12,'三门峡',17);
insert into city values(13,'南阳',17);
insert into city values(14,'商丘',17);
insert into city values(15,'信阳',17);
insert into city values(16,'周口',17);
insert into city values(17,'驻马店',17);
insert into city values(18,'济源',17);
insert into city values(1,'武汉',18);
insert into city values(2,'黄石',18);
insert into city values(3,'十堰',18);
insert into city values(4,'荆州',18);
insert into city values(5,'宜昌',18);
insert into city values(6,'襄樊',18);
insert into city values(7,'鄂州',18);
insert into city values(8,'荆门',18);
insert into city values(9,'孝感',18);
insert into city values(10,'黄冈',18);
insert into city values(11,'咸宁',18);
insert into city values(12,'随州',18);
insert into city values(13,'仙桃',18);
insert into city values(14,'天门',18);
insert into city values(15,'潜江',18);
insert into city values(16,'神农架',18);
insert into city values(17,'恩施',18);
insert into city values(1,'长沙',19);
insert into city values(2,'株洲',19);
insert into city values(3,'湘潭',19);
insert into city values(4,'衡阳',19);
insert into city values(5,'邵阳',19);
insert into city values(6,'岳阳',19);
insert into city values(7,'常德',19);
insert into city values(8,'张家界',19);
insert into city values(9,'益阳',19);
insert into city values(10,'郴州',19);
insert into city values(11,'永州',19);
insert into city values(12,'怀化',19);
insert into city values(13,'娄底',19);
insert into city values(14,'湘西',19);
insert into city values(1,'广州',20);
insert into city values(2,'深圳',20);
insert into city values(3,'珠海',20);
insert into city values(4,'汕头',20);
insert into city values(5,'韶关',20);
insert into city values(6,'佛山',20);
insert into city values(7,'江门',20);
insert into city values(8,'湛江',20);
insert into city values(9,'茂名',20);
insert into city values(10,'肇庆',20);
insert into city values(11,'惠州',20);
insert into city values(12,'梅州',20);
insert into city values(13,'汕尾',20);
insert into city values(14,'河源',20);
insert into city values(15,'阳江',20);
insert into city values(16,'清远',20);
insert into city values(17,'东莞',20);
insert into city values(18,'中山',20);
insert into city values(19,'潮州',20);
insert into city values(20,'揭阳',20);
insert into city values(21,'云浮',20);
insert into city values(1,'兰州',21);
insert into city values(2,'金昌',21);
insert into city values(3,'白银',21);
insert into city values(4,'天水',21);
insert into city values(5,'嘉峪关',21);
insert into city values(6,'武威',21);
insert into city values(7,'张掖',21);
insert into city values(8,'平凉',21);
insert into city values(9,'酒泉',21);
insert into city values(10,'庆阳',21);
insert into city values(11,'定西',21);
insert into city values(12,'陇南',21);
insert into city values(13,'临夏',21);
insert into city values(14,'甘南',21);
insert into city values(1,'成都',22);
insert into city values(2,'自贡',22);
insert into city values(3,'攀枝花',22);
insert into city values(4,'泸州',22);
insert into city values(5,'德阳',22);
insert into city values(6,'绵阳',22);
insert into city values(7,'广元',22);
insert into city values(8,'遂宁',22);
insert into city values(9,'内江',22);
insert into city values(10,'乐山',22);
insert into city values(11,'南充',22);
insert into city values(12,'眉山',22);
insert into city values(13,'宜宾',22);
insert into city values(14,'广安',22);
insert into city values(15,'达州',22);
insert into city values(16,'雅安',22);
insert into city values(17,'巴中',22);
insert into city values(18,'资阳',22);
insert into city values(19,'阿坝',22);
insert into city values(20,'甘孜',22);
insert into city values(21,'凉山',22);
insert into city values(1,'贵阳',24);
insert into city values(2,'六盘水',24);
insert into city values(3,'遵义',24);
insert into city values(4,'安顺',24);
insert into city values(5,'铜仁',24);
insert into city values(6,'毕节',24);
insert into city values(7,'黔西南',24);
insert into city values(8,'黔东南',24);
insert into city values(9,'黔南',24);
insert into city values(1,'海口',25);
insert into city values(2,'三亚',25);
insert into city values(3,'五指山',25);
insert into city values(4,'琼海',25);
insert into city values(5,'儋州',25);
insert into city values(6,'文昌',25);
insert into city values(7,'万宁',25);
insert into city values(8,'东方',25);
insert into city values(9,'澄迈',25);
insert into city values(10,'定安',25);
insert into city values(11,'屯昌',25);
insert into city values(12,'临高',25);
insert into city values(13,'白沙',25);
insert into city values(14,'昌江',25);
insert into city values(15,'乐东',25);
insert into city values(16,'陵水',25);
insert into city values(17,'保亭',25);
insert into city values(18,'琼中',25);
insert into city values(1,'昆明',26);
insert into city values(2,'曲靖',26);
insert into city values(3,'玉溪',26);
insert into city values(4,'保山',26);
insert into city values(5,'昭通',26);
insert into city values(6,'丽江',26);
insert into city values(7,'思茅',26);
insert into city values(8,'临沧',26);
insert into city values(9,'文山',26);
insert into city values(10,'红河',26);
insert into city values(11,'西双版纳',26);
insert into city values(12,'楚雄',26);
insert into city values(13,'大理',26);
insert into city values(14,'德宏',26);
insert into city values(15,'怒江',26);
insert into city values(16,'迪庆',26);
insert into city values(1,'西宁',27);
insert into city values(2,'海东',27);
insert into city values(3,'海北',27);
insert into city values(4,'黄南',27);
insert into city values(5,'海南',27);
insert into city values(6,'果洛',27);
insert into city values(7,'玉树',27);
insert into city values(8,'海西',27);
insert into city values(1,'西安',28);
insert into city values(2,'铜川',28);
insert into city values(3,'宝鸡',28);
insert into city values(4,'咸阳',28);
insert into city values(5,'渭南',28);
insert into city values(6,'延安',28);
insert into city values(7,'汉中',28);
insert into city values(8,'榆林',28);
insert into city values(9,'安康',28);
insert into city values(10,'商洛',28);
insert into city values(1,'南宁',29);
insert into city values(2,'柳州',29);
insert into city values(3,'桂林',29);
insert into city values(5,'北海',29);
insert into city values(6,'防城港',29);
insert into city values(7,'钦州',29);
insert into city values(8,'贵港',29);
insert into city values(9,'玉林',29);
insert into city values(10,'百色',29);
insert into city values(11,'贺州',29);
insert into city values(12,'河池',29);
insert into city values(13,'来宾',29);
insert into city values(14,'崇左',29);
insert into city values(1,'拉萨',30);
insert into city values(2,'那曲',30);
insert into city values(3,'昌都',30);
insert into city values(4,'山南',30);
insert into city values(5,'日喀则',30);
insert into city values(6,'阿里',30);
insert into city values(7,'林芝',30);
insert into city values(1,'银川',31);
insert into city values(2,'石嘴山',31);
insert into city values(3,'吴忠',31);
insert into city values(4,'固原',31);
insert into city values(5,'中卫',31);
insert into city values(1,'乌鲁木齐',32);
insert into city values(2,'克拉玛依',32);
insert into city values(3,'石河子　',32);
insert into city values(4,'阿拉尔',32);
insert into city values(5,'图木舒克',32);
insert into city values(6,'五家渠',32);
insert into city values(7,'吐鲁番',32);
insert into city values(8,'阿克苏',32);
insert into city values(9,'喀什',32);
insert into city values(10,'哈密',32);
insert into city values(11,'和田',32);
insert into city values(12,'阿图什',32);
insert into city values(13,'库尔勒',32);
insert into city values(14,'昌吉　',32);
insert into city values(15,'阜康',32);
insert into city values(16,'米泉',32);
insert into city values(17,'博乐',32);
insert into city values(18,'伊宁',32);
insert into city values(19,'奎屯',32);
insert into city values(20,'塔城',32);
insert into city values(21,'乌苏',32);
insert into city values(22,'阿勒泰',32);
insert into city values(1,'呼和浩特',33);
insert into city values(2,'包头',33);
insert into city values(3,'乌海',33);
insert into city values(4,'赤峰',33);
insert into city values(5,'通辽',33);
insert into city values(6,'鄂尔多斯',33);
insert into city values(7,'呼伦贝尔',33);
insert into city values(8,'巴彦淖尔',33);
insert into city values(9,'乌兰察布',33);
insert into city values(10,'锡林郭勒盟',33);
insert into city values(11,'兴安盟',33);
insert into city values(12,'阿拉善盟',33);
insert into city values(1,'澳门',34);
insert into city values(1,'香港',35);
insert shopcat values(1,1,1,20);
insert shopcat values(2,1,1,2);
insert goods values(1,\"iphone\",2,
'{\"1\":\"2-S1.jpg\",\"2\":\"2-S2.jpg\",\"3\":\"2-S3.jpg\",\"4\":\"2-S4.jpg\",\"5\":\"2-S5.jpg\"}',
'{\"1\":\"2-L1.jpg\",\"2\":\"2-L2.jpg\",\"3\":\"2-L3.jpg\",\"4\":\"2-L4.jpg\",\"5\":\"2-L5.jpg\"}',
5000,650,'iphone好','',
'{\"1\":\"2-1.jpg\",\"2\":\"2-2.jpg\",\"3\":\"2-3.jpg\"}',1);
insert goods values(2,\"美容产品\",2,
'{\"1\":\"3-S1.jpg\",\"2\":\"3-S2.jpg\",\"3\":\"3-S3.jpg\",\"4\":\"3-S4.jpg\",\"5\":\"3-S5.jpg\"}',
'{\"1\":\"3-L1.jpg\",\"2\":\"3-L2.jpg\",\"3\":\"3-L3.jpg\",\"4\":\"3-L4.jpg\",\"5\":\"3-L5.jpg\"}',
20,650,'这个也好','',
'{\"1\":\"3-1.gif\",\"2\":\"3-2.gif\",\"3\":\"3-3.gif\"}',3);
insert goods values(3,\"高端相机\",2,
'{\"1\":\"4-S1.jpg\",\"2\":\"4-S2.jpg\",\"3\":\"4-S3.jpg\",\"4\":\"4-S4.jpg\",\"5\":\"4-S5.jpg\"}',
'{\"1\":\"4-L1.jpg\",\"2\":\"4-L2.jpg\",\"3\":\"4-L3.jpg\",\"4\":\"4-L4.jpg\",\"5\":\"4-L5.jpg\"}',
17900,650,'这个更好','',
'{\"1\":\"4-1.jpg\",\"2\":\"4-2.jpg\",\"3\":\"4-3.jpg\"}',1);
insert goods values(4,\"小端相机\",2,
'{\"1\":\"5-S1.jpg\",\"2\":\"5-S2.jpg\",\"3\":\"5-S3.jpg\",\"4\":\"5-S4.jpg\",\"5\":\"5-S5.jpg\"}',
'{\"1\":\"5-L1.jpg\",\"2\":\"5-L2.jpg\",\"3\":\"5-L3.jpg\",\"4\":\"5-L4.jpg\",\"5\":\"5-L5.jpg\"}',
1910,650,'什么都好','',
'{\"1\":\"5-1.jpg\",\"2\":\"5-2.jpg\",\"3\":\"5-3.jpg\"}',1);
insert goods values(5,\"什么手表\",2,
'{\"1\":\"1-S1.jpg\",\"2\":\"1-S2.jpg\",\"3\":\"1-S3.jpg\",\"4\":\"1-S4.jpg\",\"5\":\"1-S5.jpg\"}',
'{\"1\":\"1-L1.jpg\",\"2\":\"1-L2.jpg\",\"3\":\"1-L3.jpg\",\"4\":\"1-L4.jpg\",\"5\":\"1-L5.jpg\"}',
1910,650,'什么都好','',
'{\"1\":\"1-1.jpg\",\"2\":\"1-2.jpg\",\"3\":\"1-3.jpg\"}',1);
insert goods values(6,\"原汁机\",2,
'{\"1\":\"6-S1.jpg\",\"2\":\"6-S2.jpg\",\"3\":\"6-S3.jpg\",\"4\":\"6-S4.jpg\",\"5\":\"6-S5.jpg\"}',
'{\"1\":\"6-L1.jpg\",\"2\":\"6-L2.jpg\",\"3\":\"6-L3.jpg\",\"4\":\"6-L4.jpg\",\"5\":\"6-L5.jpg\"}',
1910,650,'好','',
'{\"1\":\"6-1.jpg\",\"2\":\"6-2.jpg\",\"3\":\"6-3.jpg\"}',3);";
}