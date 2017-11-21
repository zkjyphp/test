<?php
namespace Admin\Controller;
use Think\Controller;
class UsersController extends PublicController {
    //商品添加
    public function add(){
        $this->display();
    }
    public function addAction(){

    }
    //商品列表页面
    public function usersList(){
        $this->display();
    }
}