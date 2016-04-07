<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{
    public function index()
    {
        $this->js='admin_index';
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
        $this->js='admin_index';
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
        $table=D('model');
        $id=$_GET['id'];
        $fid['id']=$id;
        $data=$table->where($fid)->find();
        $this->user=$data;


        $fid['id']=I('post.id');
        if($table->create()){
            if($table->where($fid)->save()){
                $this->success('修改成功','/Admin/admin/index');
            }else{
                $this->error('修改失败','/Admin/admin/index');
            }
        }
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
        $this->username = $tableuser
            ->field('dz_user.name as username,dz_user.id as user_id')
            ->where(['dz_user.id' => $user_id])
            ->select();

        $this->userrole = $tableuser->join('LEFT JOIN dz_user_role on dz_user_role.user_id=dz_user.id')
            ->join('LEFT JOIN dz_role on dz_user_role.role_id=dz_role.id ')
            ->field('dz_role.name as rolename,dz_role.id as role_id')
            ->where(['dz_user.id' => $user_id])
            ->select();

        $this->userperm = $tableuser->join('LEFT JOIN dz_user_perm on dz_user_perm.user_id=dz_user.id')
            ->join('LEFT JOIN dz_perm on dz_user_perm.perm_id=dz_perm.id')
            ->field('dz_perm.id ,dz_perm.name as perm_name')
            ->where(['dz_user.id' => $user_id])
            ->select();


        $tableperm = M('perm');
        $this->newperm = $tableperm->select();


        $tablerole = M('role');
        $this->newrole = $tablerole->select();


        $this->display();
    }
    public function change_role_save()
    {
        $role_ids=$_POST['role_id'];
        $user_id=$_POST['user_id'];
        $perm_ids=$_POST['perm_id'];

        $table_perm = M('user_perm');
        $table_perm->where(['user_id' => $user_id])->delete();

        foreach($perm_ids as $perm_id){
            $table_perm->add([
                'user_id' => $user_id,
                'perm_id' => $perm_id,
            ]);
        }

        $this->success('修改成功',"/admin/admin/change_role_prem/id/$user_id");



        $table=M('user_role');
        $table->where(['user_id' => $user_id])->delete();

        foreach($role_ids as $item){

            $table->add([
                'user_id' => $user_id,
                'role_id' => $item
            ]);

        }

        $this->success('修改成功',"/admin/admin/change_role_prem/id/$user_id");
    }

    public function view_role_perm()
    {
        $table = M('role_perm');
       $role_perms = $table->join('LEFT JOIN dz_perm on dz_role_perm.perm_id=dz_perm.id ')
           ->join('LEFT JOIN dz_role on dz_role_perm.role_id=dz_role.id ')
           ->field('dz_perm.name as perm_name, dz_role.name as role_name, dz_role.id as role_id')
           ->select();
        $rolename = [];
        foreach ($role_perms as $role_perm) {
            $rolename[$role_perm['role_id']]['role_id'] = $role_perm['role_id'];
            $rolename[$role_perm['role_id']]['role_name'] = $role_perm['role_name'];
            $rolename[$role_perm['role_id']]['perm_name'][] = $role_perm['perm_name'];
        }
        $this->rolename = $rolename;
        $this->display();
    }

    public function add_role_perm()
    {
        $role_id=$_GET['id'];


        $tablerole = M('role');

            $this->rolename = $tablerole
                ->field('dz_role.id as role_id,dz_role.name as role_name')
                ->where(['dz_role.id'=>$role_id])
                ->select();


        $tableperm = M('perm');
           $this->permname = $tableperm-> select();

            $this->display();
    }
    public function role_perm_save()
    {
        $role_id = $_POST['role_id'];
        $perm_ids = $_POST['perm_id'];
        $table_role_perm = M('role_perm');
        $table_role_perm->where(['role_id'=>$role_id])->delete();
        foreach($perm_ids as $perm_id){
            $table_role_perm->add([
                'role_id'=>$role_id,
                'perm_id'=>$perm_id,
            ]);
        }
        $this->success('修改成功','/admin/admin/view_role_perm');
    }

    public function sonList()
    {
        layout(false);

        if(!session('name')){
            $this->error('你已偏离正常轨道','/Admin/admin/login');
        }

        $table=D('subsection');
        $data=$table->join('LEFT JOIN dz_model ON dz_model.id=dz_subsection.model_id')->order(['created_at'=>'ASC'])->field('dz_subsection.title as subtitle,dz_subsection.id,dz_subsection.created_at,dz_subsection.updated_at,dz_model.title,dz_model.id as mid')->select();
        $this->assign('title',$data);
        layout(false);
        $this->display();
    }

    public function add_son()
    {
        $table=M('model');
        $this->fu=$table->select();

        $table=D('subsection');
        if($table->create()){
            if($table->add()){
                $this->success('增加成功','/Admin/admin/add_son');
            }else{
                $this->error('增加失败','/Admin/admin/add_son');
            }
        }
        layout(false);
        $this->display();
    }

    public function delete_son()
    {
        $table=M('subsection');
        $id=I('get.id');
        if($table->delete($id)){
           $this->redirect('/Admin/admin/sonList');
         }
    }

    public function change_son()
    {
        layout(false);
        $table=D('subsection');
        $id['id']=I('get.id');
        $this->son=$table->where($id)->find();

        $table=M('model');
        $this->fu=$table->select();
        $this->display();
    }
}
