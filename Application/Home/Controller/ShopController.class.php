<?php
namespace Home\Controller;
use Think\Controller;

class ShopController extends Controller{
	
	//订单页面
	public function slist(){
		$this->display('List/index');
	}
	
	public function slist_1(){
		$this->display('List/list1');
	}
	public function slist_2(){
		$this->display('List/list2');
	}
	public function slist_3(){
		$this->display('List/list3');
	}
	public function slist_4(){
		$this->display('List/list4');
	}
	
	//商品详情页
	public function show(){
		
		//获取商品的ID
		$goodid=I('goodid');
		//链接数据库
		$con=M('goods');
		
		//安全监测
		if(!$goodid){
			$this->error('没有该页面');
			die;
		}
		//读取数据
		$data=$con->where("good_id=$goodid")->limit(1)->select();
		//如果没有该商品ID，说明是非法访问
		if(!$data){
			$this->error('没有该页面');
			die;
		}
		$data[0]['good_limg']=json_decode($data[0]['good_limg'],TRUE);
		$data[0]['good_bimg']=json_decode($data[0]['good_bimg'],TRUE);
		$data[0]['info_img']=json_decode($data[0]['info_img'],TRUE);
		
		$this->assign('goodinfo',$data[0]);
		$this->display('ShoppingCart/good');
	}
	
	//加入购物车
	public function ajax_add(){
		
		$id=I('id');//商品ID
		$user_id=session('user_id');
		$con=M('shopcat');
		
		if(!$id){
			$this->ajaxReturn("添加失败",'EVAL');
		}
		
		if(!$user_id){
			$this->ajaxReturn("添加失败，请先登录",'EVAL');
		}
		
		$data=array(
		'shopid'=>$id,
		'shopname'=>'1',
		'imgpath'=>'1',
		'isselect'=>1,
		'price'=>1,
		'number'=>1,
		'user_id'=>$user_id
		);
		
		if($con->add($data)){
			$this->ajaxReturn("添加成功",'EVAL');
		}
		$this->ajaxReturn("添加失败",'EVAL');
		
	}
	
	
	public function ajax_s(){
		$id=I('id');
		$isc=I('c');//是否选中
		$user_id=session('user_id');
		$con=M('shopcat');
		//安全性检查

		if(!(isset($id) && isset($isc))){
			$this->ajaxReturn('操作失败','EVAL');
		}
		
		$con->where("shopid='$id' and user_id='$user_id'")->setField('isselect',$isc);
		$data=$con->query("select sum(price*number) as ap,count(*) as acount from shopcat left join goods on good_id=shopid where user_id=$user_id and isselect=1");
		$r=array(
			'ap'=>$data[0][ap],
			'acount'=>$data[0][acount]
			);
		$this->ajaxReturn($r);
		
		
	}
	public function ajax_d(){
		$id=I('id');
		$user_id=session('user_id');
		$con=M('shopcat');
		//安全性操作
		if(!($id && $user_id)){
			$this->ajaxReturn('操作失败','EVAL');
		}
		//数据操作
		
		if($con->where("shopid='$id' and user_id='$user_id'")->delete()){
			if(!$con->where("user_id='$user_id'")->select()){
				$this->ajaxReturn('2','EVAL');//没有商品了
			}
			$data=$con->query("select sum(price*number) as ap,count(*) as acount from shopcat left join goods on good_id=shopid where user_id=$user_id and isselect=1");
			$r=array(
			'ap'=>$data[0][ap],
			'acount'=>$data[0][acount]
			);
			$this->ajaxReturn($r);//有商品，删除成功
		}else{
			$this->ajaxReturn('0','EVAL');//删除失败
		}
		
	}
	//购物车商品数量增加，减少操作
	public function ajax_num_op(){
		//获取操作类
		$op=I('op');
		$id=I('id');
		$num=I('num');
		settype($num,"integer");
		$con=M('shopcat');
		
		//安全性判断
		if(!($op && $id && $num)){
			$this->ajaxReturn('操作失败','EVAL');
		}
		
		if($op != 'r' && $op != 'a'){
			$this->ajaxReturn('操作失败','EVAL');
		}
		
		
		$user_id=session('user_id');
		//测试数据
		//$this->ajaxReturn($num,'EVAL');die;
		
		
		$con->where("shopid='$id' and user_id='$user_id'")->setField('number',$num);
		//sum(price*number)
		$data=$con->query("select sum(price*number) as ap 
			from shopcat left join goods on good_id=shopid where user_id=$user_id");
		$this->ajaxReturn($data[0][ap],'EVAL');
		
		
	}
	
	public function good_acount(){
		//链接数据库
		$con=M('shopcat');
		$user_id=session('user_id');
		
		$data=$con->query("select good_name as shopname,good_bimg as imgpath,goods.price as price,number,isselect 
			from shopcat left join goods on good_id=shopid where user_id=$user_id");
		
		if(!$data){//没有任何要购买的东西，直接返回
			$this->index();
		}
		$s_price=0;
		for($i=0;$i<count($data);$i++){
			
			$data[$i]['imgpath']=json_decode($data[$i]['imgpath'],TRUE);
			$s_price+=($data[$i]['price']*$data[$i]['number']);
				
		}
		
		$this->assign('goods',$data);
		$this->assign('a_acount',$s_price);
		$this->display('ShoppingCart/acounts');
	}
	//提交订单处理
	public function ajax_menu_handle(){
		$con=M('shopcat');
		$user_id=session('user_id');
		
		if($con->where("user_id='$user_id' and isselect=1")->delete()){
			$this->ajaxReturn('订单提交成功','EVAL');
		}else{
			$this->ajaxReturn('操作失败','EVAL');
		}
	}

	//购物车首页
	public function index(){

		$user_id=session('user_id');
		if($user_id){
			$con=M('shopcat');
			$data=$con->query("select shopid, good_name as shopname,good_bimg as imgpath,goods.price as price,number,isselect 
			from shopcat left join goods on good_id=shopid where user_id=$user_id");
			//$data=$con->where("user_id='$user_id'")->select();
			//select sum(price) as aprice,count(price) as aselect from shopcat where isselect=1; 

			//$s_data=$con->where('isselect=1')->select();
			$s_price=0;
			for($i=0;$i<count($data);$i++){
				$data[$i]['imgpath']=json_decode($data[$i]['imgpath'],TRUE);
				$s_price+=($data[$i]['price']*$data[$i]['number']);
				
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
