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

        $table=D('model');
        $data=$table->select();
        $this->assign('title',$data);
        layout(false);
        $this->display();
    }

    public function add_fu()
    {
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

    public function father_save()
    {
        $table=D('model');
        $this->js='admin_index';
        $data=$table->create();
        $title['title']=$data['title'];

        $id['id']=$data['id'];
        if($table->where($title)->count()){
                echo 1;
            }elseif($id['id']){
                if($table->where($id)->save()){
                    echo 4;
                }else{
                    echo 5;
                }
            }elseif($id['id']==null){
                if($table->add()){
                    echo 2;
                }else{
                    echo 3;
                }
            }
        }

    public function change_fu()
    {
        $table=M('model');
        $id=$_GET['id'];
        $fid['id']=$id;
        $data=$table->where($fid)->find();
        $this->user=$data;
        $this->display();
    }

    public function  father_delete()
    {
        $table=M('model');
        $id=$_GET['id'];
        if($table->delete($id)){
            echo true;
        }else{
            echo false;
        }
    }
    public function change_role()
    {
        layout(false);
        $table = D('User');
        $this->username = $table->select();



        $this->display();
    }
}
