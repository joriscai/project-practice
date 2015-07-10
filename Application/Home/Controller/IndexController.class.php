<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
		
	//首页
    public function index(){
    	//猜你喜欢数据
    	$con=M('goods');
		$max=$con->query('select count(*) as c from goods');
		settype($max[0][c], "integer"); 
    	$lk=array(
    	rand(1, $max[0][c]),
    	rand(1, $max[0][c]),
    	rand(1, $max[0][c]),
    	rand(1, $max[0][c]),
    	rand(1, $max[0][c])
		);
		
		//猜你喜欢
		$data=$con->query("select *from goods where good_id=$lk[0] or 
		good_id=$lk[1] or good_id=$lk[2] or good_id=$lk[3] or good_id=$lk[4]");
		
		for($i=0;$i<count($data);$i++){
			$data[$i][good_bimg]=json_decode($data[$i][good_bimg],true);
		}
		$this->assign('youl',$data);
        $this->display('Index/index');
    }
	
	//横排导航页面
	public function market(){
		
		$id=I('id');//分类ID
		
		if(!$id){
			$this->error('没有该页面');die;
		}
		//标题
		if($id==1){
			$t='智能产品';
		}else if($id==2){
			$t='服装城';
		}else{
			$t='美容产品';
		}
		$this->assign('t',$t);
		$this->assign('id',$id);
		
		//链接数据库
		$con=M('goods');
		//查询手机数据
		$data=$con->where("cate=$id")->limit(10)->select();
		for($i=0;$i<count($data);$i++){
			$data[$i][good_bimg]=json_decode($data[$i][good_bimg],true);
		}
		$this->assign('data',$data);
		
		//查询相机数据
		$data2=$con->query("select *from goods where cate=$id and good_id between 1 and 20 limit 10;");
		for($i=0;$i<count($data2);$i++){
			$data2[$i][good_bimg]=json_decode($data2[$i][good_bimg],true);
		}
		$this->assign('data2',$data2);
		
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
	
	public function seller(){
		$this->display('seller/SellerShop');
	}
	
	public function game(){
		$this->display('Game/index');
	}
}