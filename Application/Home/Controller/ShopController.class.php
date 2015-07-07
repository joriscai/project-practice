<?php
namespace Home\Controller;
use Think\Controller;

class ShopController extends Controller{
	public function show(){
		$this->display('ShoppingCart/good');
	}

	public function index(){

		//取出用户ID
		$user_id=session('user_id');
		if($user_id){//用户已经登陆
			//连接数据库
			$con=M('shopcat');
			//判断购物车里面是否有内容
			//查询所有内容
			$data=$con->where("user_id='$user_id'")->select();
			//select sum(price) as aprice,count(price) as aselect from shopcat where isselect=1; 
			//统计价格
			$s_data=$con->where('isselect=1')->select();
			$s_price=0;
			for($i=0;$i<count($s_data);$i++){
				$s_price+=($s_data[$i]['price']*$s_data[$i]['number']);
			}
			$gdcount=array(
				's_count'=>count($s_data),
				'p_count'=>$s_price
				);
			if($data){
				$this->assign('goods',$data);
				$this->assign('gdcount',$gdcount);
				$this->display('ShoppingCart/showGoods');
				return;
			}
		}
		
		$this->display('ShoppingCart/index');
	}
}
