<?php
namespace Admin\Controller;


use Think\Controller;

class UserController extends Controller
{
    public function user()
    {
        $this->js='admin_user';
        $table=M('user');
        $data=$table->select();
        $dt=new \DateTime();
        foreach($data as &$value){
           $age1=$value['age'];
           $age2=$dt->diff(new \DateTime($age1));
           $value['age']=$age2->y;
           $value['gender']=$value['gender']=='M'?'男':'女';
        }
        $this->user=$data;
        layout(false);
        $this->display();
    }

    public function user_delete()
    {
        $table=M('user');
        $id=$_GET['id'];
        if($table->delete($id)){
            echo true;
        }else{
            echo false;
        }
    }
}