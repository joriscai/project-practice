<?php
namespace Home\Controller;
use Think\Controller;

class ShopController extends Controller{
	//商品详情页
	public function show(){
		$this->display('ShoppingCart/good');
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
		$data=$con->query("select sum(price*number) as ap,count(*) as acount from shopcat where isselect=1 and user_id='$user_id'");
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
			$data=$con->query("select sum(price*number) as ap,count(*) as acount from shopcat where isselect=1 and user_id='$user_id'");
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
		$data=$con->query("select sum(price*number) as ap from shopcat where isselect=1 and user_id='$user_id'");
		$this->ajaxReturn($data[0][ap],'EVAL');
		
		
	}
	public function good_acount(){
		$this->display('ShoppingCart/acounts');
	}

	//购物车首页
	public function index(){

		//ȡ���û�ID
		$user_id=session('user_id');
		if($user_id){//�û��Ѿ���½
			//������ݿ�
			$con=M('shopcat');
			//�жϹ��ﳵ�����Ƿ�������
			//��ѯ��������
			$data=$con->where("user_id='$user_id'")->select();
			//select sum(price) as aprice,count(price) as aselect from shopcat where isselect=1; 
			//ͳ�Ƽ۸�
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
