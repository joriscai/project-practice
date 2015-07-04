<?php
if($db_act=='create_db'){
	return 
	"DROP DATABASE IF EXISTS $db_name;
	CREATE DATABASE $db_name CHARACTER SET utf8;";
	
}elseif($db_act=='create_table'){
	return 
	"use $db_name;"
	;
}elseif($db_act="insert_data"){
	return "";
}