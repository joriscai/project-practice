<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
	public function regedit(){
		//查询数据库，获取国家名
		$pro=M('promary');
		$this->assign('prodata',$pro->select());
		$this->display('User/regedit');
	}

	public function ajax_getcity(){
		$pro=I('proid');
		$con=M('city');
		
		//获取城市
		$city=$con->where("proID=$pro")->select();
		$this->ajaxReturn($city);
	}
	
	public function login(){
		$this->display('User/Login');
	}

	public function loginout(){
		session('[destroy]');
		$this->display('Index/index');

	}
	
	//生成验证码
	public function verify() {
		$conf = array('seKey' => 'cy', 
					'imageH' => 30, 
					'imageW' => 80, 
					'length' => 3, 
					'useCurve' => FALSE, 
					'codeSet' => '123456789', 
					'fontSize' => 15);
		$show = new \Think\Verify($conf);
		$show -> entry();
	}
	
	//验证码检测
	public function ajax_verify(){
		$code=I('code');
		$conf = array('seKey' => 'cy');
		$verify = new \Think\Verify($conf);
		if($verify -> check($code)){
			$this->ajaxReturn('1','EVAL'); 
		}
		$this->ajaxReturn('0','EVAL'); 

	}
	
	public function regedit_handle(){
		//var_dump($_POST);
		//		  'name' => string '123456' (length=6)
		//'pwd' => string '1234561' (length=7)
		//'check_pwd' => string '1234561' (length=7)
		//'email' => string '707039333@qq.com' (length=16)
		//'token' => string '' (length=0)
		//
		
		$name=I('name');//用户名
		$pwd=I('pwd');//密码
		//check_pwd取代name
		$email=I('email');//邮箱
		$token=I('code');//验证码
		$city=I('city');//城市
		$pro=I('pro');//省份
		$birth=I('birth');//省份
		
		
		
		
		//测试的数据

		//不为空检查
		if(!($name && $pwd && $email  && $token && $city && $pro && $birth) ){
			
			$this->ajaxReturn("必填字段不能留空!",'EVAL');
		}
		//连接数据库
		$user=M('user');
		
		//验证码是否正确验证
		$code=I('code');
		$conf = array('seKey' => 'cy');
		$verify = new \Think\Verify($conf);
		
		if(!$verify -> check($code)){
			$this->ajaxReturn('验证码错误，请重新注册!','EVAL');
		}
		
		//邮箱是否唯一检查
		$data=$user->limit(1)->where("email='$email'")->select();
		if($data){
			$this->ajaxReturn("邮箱已经存在，不能重复注册!",'EVAL');
		}
		
		
		//用户是否存在检查
		$data=$user->limit(1)->where("name='$name'")->select();
		if($data){
			$this->ajaxReturn("用户名已经存在，不能重复注册!",'EVAL');
		}

		$info=array(
		'name'=>$name,
		'sex'=>1,//为完成字段，0为男，1为女
		'pwd'=>md5($pwd),
		'email'=>$email,
		'birth'=>strtotime($birth),
		'city'=>$city,
		'province'=>$pro,
		);
		
		if(!$user->add($info)){
			$this->ajaxReturn('注册失败，请联系管理员！','EVAL');
		}
		$this->ajaxReturn('注册成功！！','EVAL');
		
		
		
		die;
	}
	
	//ajax检测用户名是否存在
	public function ajax_user(){
		$user=M('user');
		
	}
	
	//ajax检查邮箱是否存在
	public function ajax_mail(){
		
	}
	
	public function login_handle(){
		//获取登录的信息
		$name=I('name');
		$pwd=I('pwd');

		
		if(!($name && $pwd)){
			$this->ajaxReturn('用户名或者密码不能为空','eval');
		}
		
		
		//连接到数据库
		$user=M('user');
		
		//获取用户信息
		$data=$user->where("name='$name'")->limit(1)->select();
		if(!$data){
			$this->ajaxReturn('没有该用户名，请确认该用户名是否存在','eval');
		}
		
		//判断用户和密码是否正确
		if($data[0]['pwd']!=md5($pwd)){
			$this->ajaxReturn('密码错误！','eval');
		}
		
		//登陆成功，记录信息，并且跳转到主页
		session('user_name',$name);
		session('user_id',$data[0]['id']);
		$this->ajaxReturn('登陆成功','eval');
		
		
		
	}
}













