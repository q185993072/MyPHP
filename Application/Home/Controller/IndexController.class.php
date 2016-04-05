<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->js='home_base';
        $this->cs='home_index';
        $this->display();
    }

    public function fangchan()
    {
        $this->js='home_fangchan';
        $this->cs='home_fangchan';
        $this->display();
    }

    public function login_save()
    {
        $table=D('user');
        $data=$table->create();
        $name['name']=$data['name'];
        $password['password']=$data['password'];
        if($table->where($name)->count()){
            if($table->where($password)->count()){
                session('name',$data['name']);
                $this->success('登录成功','/home/index/index');
            }else{
                $this->error('密码错误','/home/index/index');
            }
        }else{
            $this->error('用户名不存在','/home/index/index');
        }
    }

    public function login_out()
    {
        session('name',null);
        $this->redirect('/Home/index/index');
    }
}