<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('看到此页面，说明程序运行成功','utf-8');
    }
}