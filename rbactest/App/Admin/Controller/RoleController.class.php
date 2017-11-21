<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends PublicController {
    //角色添加
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
    //角色列表页面
    public function roleList(){
        //获取角色内容
        $arr = M('Role')->order('role_id desc')->select();
        $this->assign('rows',$arr);
        $this->display();
    }
    //为角色分配权限  编辑
    public function roleAuth(){
        $role_id =I('get.role_id');
        $role_name = M('Role')->where(['role_id'=>$role_id])->getField('role_name');
        $this->assign('role_name',$role_name);
        //读取所有权限
        $arr = M('Auth')->order("auth_path")->select();
        foreach ($arr as $k=>$v){
            $rows[$k] = $v;
            $rows[$k]['p'] = str_repeat('----',$v['auth_level']);
        }

        $this->assign('rows',$rows);
        $role_auth_ids = M('Role')->where(['role_id'=>$role_id])->getField('role_auth_ids');
        $role_auth_ids_arr = explode(',',$role_auth_ids);
        $this->assign('role_auth_ids_arr',$role_auth_ids_arr);

        $this->display();
    }
    //分撇权限处理
    public function editAuth(){
        //权限的id
        $ch = I('post.ch');
        $role_id = I('post.role_id');
        $str = '';
        foreach ($ch as $v){
            //根据权限id查询 权限里面的记录 取出auth_c 和auth_a
            $arr = M('Auth')->find($v);
           //过滤掉没有auth_c和auth_a的数据
            if(!empty($arr['auth_c']) && !empty($arr['auth_a'])){
                $str .= $arr['auth_c'].'-'.$arr['auth_a'].',';
            }
        }
        $role_auth_ids = implode(',',$ch);
        $data['role_auth_ids'] = $role_auth_ids;
        $data['role_auth_ac'] = $str;
        $affect = M('Role')->where(['role_id'=>$role_id])->save($data);
        if($affect){
            //成功
            $this->success('成功','roleList');
        }else{
            //失败
            $this->error('编辑失败');
        }
    }
}