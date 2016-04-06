<?php
namespace Admin\Controller;

use Admin\Model\UserModel;
use Think\Controller;
use Think\Upload;


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
        $table=M('note');
        $data=$table->join('dz_user on dz_user.id=dz_note.user_id','left')->field('dz_user.name,dz_note.*')->select();
        $this->user=$data;
        $this->display();
    }

    public function loginCheck()
    {
        $table = M('user');
        $username =trim(I('username'));
        $password = trim(I('password'));
        $conditions = [
            'name' => $username,
        ];
        $result = $table->where($conditions)->find();
        if ($username && $password) {
           if ($result) {
               if (MD5($password) == $result['password']) {
                   $_SESSION['auth'] = true;
                   $_SESSION['username'] = $username;
                   $_SESSION['id'] =$table->getFieldByName($username,'id');
                   $_SESSION['image'] = $table->getFieldByName($username,'image');
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
        $table=M('note');
        $data=$table->join('LEFT JOIN dz_user ON dz_user.id=dz_note.user_id')->select();
        foreach($data as &$value){
            $value['content']=html_entity_decode($value['content']);
        }
        $this->user=$data;
        $this->display();
    }

    public function logout()
    {
        $_SESSION['auth'] = false;
        $_SESSION['username'] = null;
        $_SESSION['id'] = null;
        redirect("/admin/index/luntan");
    }

    /**
     * 用户修改完善资料
     */
    public function personMsg()
    {

        $nian = range(2012,1960);
       $this->nians = $nian;

        $yue = range(1,12);
        $this->yues = $yue;

        $ri = range(1,31);
        $this->ris = $ri;

        $table = M('User');
        $id = I('id');
        $conditions = [
            'id' => $id,
        ];
       $this->result = $table->where($conditions)->find();
        $this->display();
    }

    public function personMsgInsert()
    {

        $id = I('id');
        $table = D('User');
        $year = I('year');
        $month = I('month');
        $day = I('day');
        $age = $year . "-" . $month . "-" . $day ;
        $upload = new Upload();
        $upload->mimes = [
            'image/png',
            'image/jpeg',
        ];
        $upload->maxSize = 2 * 1024 * 1024;
        $upload->autoSub = true;
        if ($info = $upload->upload($_FILES)) {
           echo  $path ="/Uploads/" . $info['image']['savepath'] . $info['image']['savename'];
            if ($table->create()) {
                $table->age = $age;
                $table->image = $path;
                if ($table->save()) {
                    $_SESSION['image'] = $table->getFieldById($id,'image');
                    $this->success('成功','/admin/index/gerenzhuye?username=' . $_SESSION['username']);
                } else {
                    $this->error($table->getError(),"/admin/index/personMsg?id=" . $id);
                }
            } else {
                $this->error($table->getError(),"/admin/index/personMsg?id=" . $id);
            }
        } else {
            $this->error($upload->getError(),"/admin/index/personMsg?id=" . $id);
        }
    }

    public function personMsgCheck()
    {
        //echo "s";
        $table = D('User');
        if ($table->create("", UserModel::MY_MODEL_TIMES)) {
            echo 'success';
        } else {
            $b = $table->getError();
            echo $b;
        }
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

    public function fatie()
    {
        $this->display();
    }

    public function tie_save()
    {
        $table=D('note');
        if($table->create()){
           if($table->add()){
               $this->success('发布成功','/Admin/index/tiezi');
           }
        }
    }

}


