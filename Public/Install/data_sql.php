<?php
if($db_act=='create_db'){
	return 
	"DROP DATABASE IF EXISTS $db_name;
	CREATE DATABASE $db_name CHARACTER SET utf8;";
	
}elseif($db_act=='create_table'){
	return 
	"use $db_name;
	create table user(
	id int(10) not null primary key auto_increment,
	name varchar(32) not null unique,
	sex tinyint(2) not null,
	pwd char(32) not null,
	email varchar(20) not null unique,
	birth int(10) not null,
	city varchar(12) not null,
	province varchar(12) not null
	);"
	;
}elseif($db_act="insert_data"){
	return "";
}