<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/1
 * Time: 9:01
 */
namespace Home\Controller;

use Home\Model\UserModel;
use Think\Controller;
use Think\Verify;

class RegisterController extends Controller
{
    public function register()
    {
        $this->su= I('su', 0);
        $this->display();
        $this->arr= '2016-12-12 12:12:12';
    }

    public function yanZhenMa()
    {
        $Verify = new Verify();
        $Verify->entry();
    }

    public function insert()
    {
        $table = D('User');
        $name = I('username');
        if ($table->create()) {
            if ($table->add()) {
                $pass = I('password');
                $repass = I('repassword');
                $name = I('name');
                if ($pass == $repass) {
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = $table->getFieldByName($name,'id');
                    $_SESSION['auth'] = true;
                    $_SESSION['image'] = $table->getFieldByName($name,'image');
                    $this->redirect('/home/register/register?su=1');
                } else {
                    $this->error("确认密码不正确",'/home/register/register?su=0');
                }
            } else {
                $this->error($table->getError(),'/home/register/register?su=0');
            }
        } else {
            $this->error($table->getError(),'/home/register/register?su=0');
        }

    }

    public function registerCheck()
    {
        //echo "s";
        $table = D('User');
        if ($table->create("", UserModel::MY_MODEL_TIME)) {
            echo 'success';
        } else {
            $b = $table->getError();
            echo $b;
        }

    }

}