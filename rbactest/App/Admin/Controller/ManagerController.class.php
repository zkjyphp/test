<?php

namespace Admin\Controller;

use Think\Controller;

class ManagerController extends PublicController
{
    //管理员添加页面
    public function add()
    {
        //获取角色列表
        $arr = M('Role')->field('role_id,role_name')->select();
        $this->assign('arr',$arr);
        $this->display();
    }
    //管理员处理页面
    public function addAction()
    {
        $mg_name = I('post.mg_name');
        $mg_pwd = I('post.mg_pwd');
        $mg_time = time();
        $mg_role_id = I('post.mg_role_id');
        //创建一个包含变量名和它们的值的数组：
        $result = compact('mg_name','mg_pwd','mg_time','mg_role_id');
        $id = M('Manager')->add($result);
        if($id){
            $this->success('添加管理员成功',"managerList");
        }else{
            $this->error("管理员添加失败");
        }
    }
    //管理员列表页面
    public function managerList()
    {
        //$rows = M('Manager')->order('mg_id desc')->select();
        //.*  表的所有字段
        $rows = M('Manager')->field('think_manager.*,think_role.role_name')->join("left join think_role on think_manager.mg_role_id = think_role.role_id")->order('think_manager.mg_id desc')->select();
        $this->assign('rows',$rows);
        $this->display();
    }
    //管理员编辑页面
    public function edit(){

        $this->display();
    }

}