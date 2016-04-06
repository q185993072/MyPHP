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
        //$password['password']=$data['password'];
        $passwd = I('password');
        $pw = $table->getFieldByName($name['name'],'password');
        session('name',$data['name']);
        if($table->where($name)->count()){
            if(MD5($passwd) == $pw){
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
    public function change_role_prem()
    {
        layout(false);
        $user_id=$_GET['id'];
        $tableuser = D('user');
        $this->username = $tableuser->join('LEFT JOIN dz_user_role on dz_user_role.user_id=dz_user.id')
            ->join('LEFT JOIN dz_role on dz_user_role.role_id=dz_role.id')
            ->field('dz_user.name as username')
            ->where(['dz_user.id' => $user_id])
            ->select();

        $this->userrole = $tableuser->join('LEFT JOIN dz_user_role on dz_user_role.user_id=dz_user.id')
            ->join('LEFT JOIN dz_role on dz_user_role.role_id=dz_role.id ')
            ->field('dz_role.name as rolename')
            ->where(['dz_user.id' => $user_id])
            ->select();


        $apple=$this->newrole = $tableuser->join('LEFT JOIN dz_user_role on dz_user_role.user_id=dz_user.id')
            ->join('LEFT JOIN dz_role on dz_user_role.role_id=dz_role.id ')
            ->field('dz_role.name as rolename')
            ->select();
        print_r($apple);

        $this->display();
    }

}
