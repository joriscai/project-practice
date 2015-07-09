<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//首页
    public function index(){
        $this->display('Index/index');
    }
	
	//横排导航页面
	public function market(){
		$this->display('Index/market');
	}
	
	//竖排导航页面
	public function cate(){
		$this->display('Index/cate');
	}
	
	//关于我们页面
	public function aboutus(){
		$this->display('About/index');
	}
	
	public function cul(){
		$this->display('About/cul');
	}
	public function mod(){
		$this->display('About/mod');
	}
	public function comn(){
		$this->display('About/comn');
	}
	public function soc(){
		$this->display('About/soc');
	}
}