<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{
    public function index()
    {
        if(!session('name')){
            $this->error('你已偏离正常轨道','/Admin/admin/login');
        }
        $table=D('user');
        $data=$table->select();
        $this->assign('user',$data);
        layout(false);
        $this->display();
    }

    public function login()
    {
        layout(false);
        $this->display();
    }

    public function yanzhengma()
    {
        layout(false);
        $config=[
            'length'=>4,
            'fontSize'=>30
        ];
        $verfiy=new Verify($config);
        $verfiy->entry();
    }

    public function login_save()
    {
        $table = D('user');
        $data = $table->create();
        $name['name']=$data['name'];
        $password['password']=$data['password'];
        session('name',$data['name']);
        if($table->where($name)->count()){
            if($table->where($password)->count()){
                $this->success('登录成功','/admin/admin/index');
            }else{
                $this->error('密码错误');
            }
        }else{
            $this->error('用户名不正确');
        }
    }

    public function login_out()
    {
        session('name',null);
        $this->redirect('/Admin/admin/login');
    }
}