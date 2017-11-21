<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
    public function __construct()
    {
        parent::__construct();
        //判断用户是否已经登录
        if(ACTION_NAME != 'login' && ACTION_NAME != 'loginAction'){
            if(!session('admin_id')){
                redirect(U("Index/login"));
            }
        }
        $ca = CONTROLLER_NAME."-".ACTION_NAME;
        //获取session
        $admin_id = session('admin_id');
        if($admin_id>1){
//获取当前管理员的权限 根节点 子节点
            $role_auth_ac = M('Manager')->join('think_role on think_manager.mg_role_id = think_role.role_id')->where(['mg_id'=>$admin_id])->getField('role_auth_ac');
            $temp_arr = explode(',',$role_auth_ac);
            $temp_arr[] = 'Index-fourZeroFour';
            $temp_arr[] = 'Index-index';
            $temp_arr[] = 'Index-left';
            $temp_arr[] = 'Index-swich';
            $temp_arr[] = 'Index-main';
            $temp_arr[] = 'Index-top';
            $temp_arr[] = 'Index-bottom';
            $temp_arr[] = 'Index-login';
            $temp_arr[] = 'Index-loginAction';
            $temp_arr[] = 'Index-loginOut';
            //如果没在这个数组说明没有这个权限
            if(!in_array($ca,$temp_arr)){
                redirect(U('Index/fourZeroFour'));
            }
        }

    }
}