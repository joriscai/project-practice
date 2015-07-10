<?php
namespace Install\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
	
	public function first_show(){
		$this->assign('os',PHP_OS);
		$this->assign('php',phpversion());
		$this->display('Index/first');
	}
	
	public function second_show(){
		$this->display('Index/second');
	}
	
	public function thirst_show(){
		$msg='安装成功';
		//host_db name_db pwd_db
		$host=I('host_db');
		$name=I('name_db');
		$pwd=I('pwd_db');
		
		//配置文件的路劲
		$file_conf='./Application/Common/Conf/config.php';
		
		if(!($host && $name)){
			//失败，没有填写好
			$msg='数据库配置错误!';
			echo $msg;
			return;
			//$this->display('Index/thirst');
			
		}
		
		//配置文件检查
		if(file_exists($file_conf)){
			unlink($file_conf);
		}
		
		//数据库连接测试
		$con = @mysql_connect($host, $name, $pwd);
		if(!$con){
			$msg="数据库连接失败！请检查配置是否正确！";
			echo $msg;
			//$this->display('Index/thirst');
			return;
			
		}
		
		$conf = "<?php
		return array(
    			'DB_TYPE'               =>  'mysql',
    			'DB_HOST'               =>  '$host',
    			'DB_NAME'               =>  'drdb', 
    			'DB_USER'               =>  '$name',  
    			'DB_PWD'				=>	'$pwd'
);";

		//创建数据库
		$db_name = 'drdb';
		if(!$this->deal_pre_sql('create_db', array(
	 			'db_name'=>$db_name,
 				'con'=>$con
		))){
			$msg="数据库创建失败";
			echo $msg;
			//$this->display('Index/thirst');
			return;
			
		}
		

		//创建数据表
		if(!$this->deal_pre_sql('create_table', array(
				'db_name'=>$db_name,
				'con'=>$con
		))){
			$msg='';
		}
		
		//插入数据
		if(!$this->deal_pre_sql('insert_data', array(
		'db_name'=>$db_name,
		'con'=>$con
		))){
			$msg='插入数据失败。';
		}

		

		file_put_contents($file_conf, $conf);
		$this->display('Index/thirst');
	}
	
	//创建数据库和插入表和数据
	private function deal_pre_sql($db_act,$conf){
		@extract($conf, EXTR_SKIP);
		$presql =require ('./Public/Install/data_sql.php');
		$detail = explode(';', $presql);
		
		$count = count($detail);
		mysql_query('COMMIT');//事务提交，增加插入速度
		mysql_query('BEGIN');
		for ($i = 0; $i < $count-1; $i++) {
			$sql = $detail[$i];
			$sql = str_replace("\n", '', $sql);
			$sql = str_replace("\r", '', $sql);
			if(!mysql_query($sql, $con)){
				var_dump($sql);
				mysql_close($con);
				return 0;
			}
		
		}
		mysql_query('COMMIT');
	return  1;
}
}