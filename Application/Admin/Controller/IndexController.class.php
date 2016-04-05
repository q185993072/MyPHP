<?php
namespace Admin\Controller;

use Think\Controller;


class IndexController extends Controller
{
    public function index()
    {
        $this->redirect('/Admin/admin/login');
    }

    public function luntan()
    {
        $tables = M('model');
        $result = $tables->select();
        $this->zhus = $result;

        $table = M('subsection');
        $results = $table->query("select * from dz_subsection ");
        $this->results = $results;
        $this->display();
    }
    public function ziluntan()
    {
        $this->display();
    }
    public function loginCheck()
    {
        $table = M('user');
        $username =trim(I('username'));
        $password = trim(I('password'));
        $conditions = [
            'username' => $username,
        ];
        $result = $table->where($conditions)->find();
        if ($username && $password) {
           if ($result) {
               if (MD5($password) == $result['password']) {
                   $_SESSION['auth'] = true;
                   $_SESSION['username'] = $username;
                   $this->success('登陆成功');
               } else {
                   $this->error('用户名或密码错误');
               }
           } else {
               $this->error('用户名不存在');
           }
        } else {
            $this->error('请填写用户名或密码');
        }
    }

    public function gerenzhuye()
    {
        $name = I('username');
        $table = M('user');
        $conditions  = [
            'name' => $name,
        ];
        $user = $table->where($conditions)->find();

        //print_r($user);
        $this->user = $user;
        $this->display();
    }
    public function tiezi()
    {
        $this->display();
    }

    public function logout()
    {
        $_SESSION['auth'] = false;
        $_SESSION['username'] = null;
        redirect("/admin/index/luntan");
    }


    public  function yasuoimg()
    {
        $obj = new \Think\Image();
        $img = $obj->open('"/Public/img/lufei.png"');
        echo "宽".$img->width()."</br>";
        echo "MIME".$img->mime()."</br>";
        echo "高".$img->height()."</br>";
        echo "类型".$img->type()."</br>";
       // $img->crop(400,175,50,50)->save('upload_2.png');//裁剪
      //  $img->thumb(500,500,Image::IMAGE_THUMB_FILLED)->save("/Public/img/lufei2.png");//缩放并填充白边
      //  $img->thumb(400,400,Image::IMAGE_THUMB_FIXED)->save("/Public/img/lufei3.png");//缩放并拉伸
       // $img->water('shuiying.png')->save("/Public/img/lufei4.png");//加水印
        $img->text('asdf','./ThinkPHP/Library/Think/Verify/ttfs/5.ttf','30','#999999',Image::IMAGE_THUMB_SOUTHEAST)->save("/Public/img/lufei4.png");
    }
}


