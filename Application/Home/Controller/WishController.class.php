<?php
namespace Home\Controller;

use Think\Controller;

class WishController extends Controller
{
    public function index()
    {
        $table=M('wish');
        $data=$table->select();
        $this->user=$data;
        $this->display();
    }

    public function save()
    {
        $table=M('wish');
        $data['username']=$_POST['username'];
        $data['content']=$_POST['content'];
        $data['created_at']=date('Y-m-d H:i:s');
       if($table->create($data)){
           if($table->add()){
               echo true;
           }else{
               echo false;
           }
       }
    }
}