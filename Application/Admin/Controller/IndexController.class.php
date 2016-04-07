<?php
namespace Admin\Controller;

use Admin\Model\UserModel;
use Think\Controller;
use Think\Upload;
use Think\Page;


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

        $table = M('note');
        $result = $table->order(['created_at' => 'DESC'])->limit(5)->select();
        $this->title = $result;
        $this->display();
    }

    public function ziluntan()
    {
        $table = M('note');
        $data = $table->join('dz_user on dz_user.id=dz_note.user_id', 'left')->field('dz_user.name,dz_note.*')->select();
        $total = count($data);
        $pager = new Page("$total", 10);
        $list = $table->join('LEFT JOIN dz_user ON dz_note.user_id = dz_user.id')->order(['dz_note.created_at' => 'DESC'])->limit($pager->firstRow, $pager->listRows)->field('dz_user.name,dz_note.*')->select();
        $pager->setConfig('prev', '上一页');
        $pager->setConfig('next', '下一页');

        $this->pager = $pager;
        $this->list = $list;
        $this->user = $data;
        $this->display();
    }

    public function loginCheck()
    {
        $table = M('user');
        $username = trim(I('username'));
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
                    $_SESSION['id'] = $table->getFieldByName($username, 'id');
                    $_SESSION['image'] = $table->getFieldByName($username, 'image');
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
        $conditions = [
            'name' => $name,
        ];
        $user = $table->where($conditions)->find();

        //print_r($user);
        $this->user = $user;
        $this->display();
    }

    public function tiezi()
    {
<<<<<<< Updated upstream
            $this->js='admin_tiezi';
            $table=M('user');
            $id=I('id');
            $data=$table->join("LEFT JOIN dz_note ON $id=dz_note.id")->where('dz_note.user_id=dz_user.id')->select();
            foreach($data as &$value){
                $value['content']=html_entity_decode($value['content']);
            }
            $this->user=$data;

            $table=M('comment');
            $data=$table->join("LEFT JOIN dz_user ON dz_user.id=dz_comment.user_id")->where("$id=dz_comment.note_id")->select();
            //分页开始
            $cont=count($data);
            $page=new Page("$cont",3);
            $list=$table->join("LEFT JOIN dz_user ON dz_user.id=dz_comment.user_id")->where("$id=dz_comment.note_id")->limit($page->firstRow,$page->listRows)->select();

            foreach($list as &$value){
                $value['content']=html_entity_decode($value['content']);
            }
            $this->pinlun=$list;
            $this->page=$page;
            $this->display();
=======
        $this->js = 'admin_tiezi';
        $table = M('user');
        $id = I('id');
        $data = $table->join("LEFT JOIN dz_note ON $id=dz_note.id")->where('dz_note.user_id=dz_user.id')->select();
        foreach ($data as &$value) {
            $value['content'] = html_entity_decode($value['content']);
        }
        $this->user = $data;
        $this->display();
>>>>>>> Stashed changes

    }

    public function logout()
    {
        $_SESSION['auth'] = false;
        $_SESSION['username'] = null;
        $_SESSION['id'] = null;
        $_SESSION['image'] = null;
        redirect("/admin/index/luntan");
    }

    /**
     * 用户修改完善资料
     */
    public function personMsg()
    {

        $nian = range(2012, 1960);
        $this->nians = $nian;

        $yue = range(1, 12);
        $this->yues = $yue;

        $ri = range(1, 31);
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
        $age = $year . "-" . $month . "-" . $day;
        //print_r($_FILES);exit;
        if ($_FILES['image']['error'] == 0) {
            $upload = new Upload();
            $upload->mimes = [
                'image/png',
                'image/jpeg',
            ];
            $upload->maxSize = 2 * 1024 * 1024;
            $upload->autoSub = true;
            if ($info = $upload->upload($_FILES)) {
                $path = "/Uploads/" . $info['image']['savepath'] . $info['image']['savename'];
                if ($table->create()) {
                    $table->age = $age;
                    $table->image = $path;
                    if ($table->save()) {
                        $_SESSION['image'] = $table->getFieldById($id, 'image');
                        $this->success('成功', '/admin/index/gerenzhuye?username=' . $_SESSION['username']);
                    } else {
                        $this->error($table->getError(), "/admin/index/personMsg?id=" . $id);
                    }
                } else {
                    $this->error($table->getError(), "/admin/index/personMsg?id=" . $id);
                }
            } else {
                $this->error($upload->getError(), "/admin/index/personMsg?id=" . $id);
            }
        } else {
            if ($table->create()) {
                $table->age = $age;
                if ($table->save()) {
                    $_SESSION['image'] = $table->getFieldById($id, 'image');
                    $this->success('成功', '/admin/index/gerenzhuye?username=' . $_SESSION['username']);
                } else {
                    $this->error($table->getError(), "/admin/index/personMsg?id=" . $id);
                }
            } else {
                $this->error($table->getError(), "/admin/index/personMsg?id=" . $id);
            }
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

    public function yasuoimg()
    {
        $obj = new \Think\Image();
        $img = $obj->open('"/Public/img/lufei.png"');
        echo "宽" . $img->width() . "</br>";
        echo "MIME" . $img->mime() . "</br>";
        echo "高" . $img->height() . "</br>";
        echo "类型" . $img->type() . "</br>";
        // $img->crop(400,175,50,50)->save('upload_2.png');//裁剪
        //  $img->thumb(500,500,Image::IMAGE_THUMB_FILLED)->save("/Public/img/lufei2.png");//缩放并填充白边
        //  $img->thumb(400,400,Image::IMAGE_THUMB_FIXED)->save("/Public/img/lufei3.png");//缩放并拉伸
        // $img->water('shuiying.png')->save("/Public/img/lufei4.png");//加水印
        $img->text('asdf', './ThinkPHP/Library/Think/Verify/ttfs/5.ttf', '30', '#999999', Image::IMAGE_THUMB_SOUTHEAST)->save("/Public/img/lufei4.png");
    }

    public function fatie()
    {
        $this->display();
    }

    public function tie_save()
    {
        $table = D('note');
        if ($table->create()) {
            if ($ad = $table->add()) {
                $this->success('发布成功', "/Admin/index/tiezi/id/$ad");
            }
        }
    }

    public function myNote()
    {
        $name = I('name');
        $table = M('User');
        $id = $table->getFieldByName($name, 'id');
        $result = $table->query("select *,dz_note.title from dz_user left join dz_note on dz_note.user_id = dz_user.id where dz_user.id = $id GROUP by dz_note.created_at DESC ");
        $total = count($result);
        $pager = new Page("$total", 10);
        $list = $table->join('LEFT JOIN dz_note ON dz_note.user_id = dz_user.id')->where("dz_user.id = $id")->order(['dz_note.created_at' => 'DESC'])->limit($pager->firstRow, $pager->listRows)->select();
        $this->pager = $pager;
        $this->list = $list;
        $this->user = $result;


        $this->display();
    }


    public function forObey()
    {
        $id = I('id');
        $action = I('ac');
        $table = M('Note');
        if ($action == 'jia') {
            $table->where("id = $id")->setInc("jianum");
            $zhichi = $table->where("id = $id")->field("jianum")->find();
            echo true;
        } else {
            $table->where("id = $id")->setInc("jiannum");
            $obey = $table->where("id = $id")->field("jiannum")->find();
            echo true;
        }

    }
<<<<<<< Updated upstream
        public function pinlun_save()
        {
            $table = M('comment');
            $note_id=I('get.note_id');
            if($table->create()){
                $table->note_id=$note_id;
                $table->comment_time=date('Y-m-d H:i:s');
                if($table->add()){
                    $this->redirect("/Admin/index/tiezi/id/$note_id");
                }
            }
=======

    public function pinlun()
    {
        $table = M('comment');
        print_r($table->create());

    }

    public function resetPw()
    {
        $this->display();
    }

    public function resetPwSave()
    {

        $id = $_SESSION['id'];
        $oldpw = trim(I('oldpassword'));
        $newpw = trim(I('password'));
        //echo $oldpw . $newpw;exit;
        $table = M("User");
        $result = $table->where("id = $id")->field('password')->find();
        if ($oldpw && $newpw) {
            if (MD5($oldpw) == $result['password']) {
                if (mb_strlen($newpw, 'UTF-8') >= 6 && mb_strlen($newpw, 'UTF-8') <= 12) {
                    $table->execute("update dz_user set password=" . "MD5('$newpw')" . " where id =$id");
                    $this->success('成功', "/admin/index/gerenzhuye");

                }
            } else {
                $this->error("旧密码错误", "/admin/index/resetPw");
            }
        } else {
            $this->error("请全部填写", "/admin/index/resetPw");
>>>>>>> Stashed changes
        }
    }
}


