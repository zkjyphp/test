<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends PublicController {
    //商品添加
    public function add(){
        $this->display();
    }
    public function addAction(){
        $role_name = I('post.role_name');
        //插入数据
        $id = M('Role')->add(["role_name"=>$role_name]);
        if($id){
            //成功
            $this->success('角色添加成功','roleList');
        }else{
            //失败
            $this->error('角色添加失败');
        }
    }
    //商品列表页面
    public function goodsList(){
        //获取角色内容
        $arr = M('Role')->order('role_id desc')->select();
        $this->assign('rows',$arr);
        $this->display();
    }
}