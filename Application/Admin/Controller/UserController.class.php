<?php
namespace Admin\Controller;


use Think\Controller;

class UserController extends Controller
{
    public function user()
    {
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
}