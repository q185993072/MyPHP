<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/1
 * Time: 13:09
 */
namespace Home\Model;

use Think\Model;

class UserModel extends Model
{
    const MY_MODEL_TIME = 4;
    protected $_validate = [
        ['name','require','请输入用户名',Model::EXISTS_VALIDATE ,'',UserModel::MY_MODEL_TIME],
        ['name','','用户名已被注册',Model::EXISTS_VALIDATE ,'unique',UserModel::MY_MODEL_TIME],
        ['name','getLength','请输入3至8位的用户名',Model::EXISTS_VALIDATE ,'callback',UserModel::MY_MODEL_TIME],
        ['password','require','请输入密码',Model::EXISTS_VALIDATE,'',UserModel::MY_MODEL_TIME],
        ["password","6,12","密码须6到12位",0,'length',UserModel::MY_MODEL_TIME],
        ['repassword','require','请确认密码',Model::EXISTS_VALIDATE,'',UserModel::MY_MODEL_TIME],
        ['email','email','请输入正确邮箱',Model::VALUE_VALIDATE ,'',UserModel::MY_MODEL_TIME],
        ['yzm','require','请输入验证码',Model::EXISTS_VALIDATE,'',UserModel::MY_MODEL_TIME],
        ['yzm','checkYzm','验证码输入错误',Model::EXISTS_VALIDATE,'callback',UserModel::MY_MODEL_TIME],
    ]; // 自动验证定义
    protected $_auto     = [
        ['password','MD5',Model::MODEL_INSERT,'function'],
        //['repassword','MD5',Model::MODEL_INSERT,'function'],
        ['created_at','getCrDate',Model::MODEL_INSERT,'callback'],
        ['ip','getIp',Model::MODEL_INSERT,'callback']
    ]; // 自动完成定义

    public function getLength($username)
    {
        $foo = $username;
        $number = mb_strlen($foo,'UTF-8');
        if ($number > 3 && $number <8) {
            return true;
        } else {
            return false;
        }
    }

    public function checkYzm($code)
    {
        $verify = new \Think\Verify();
        return $verify->check($code);
    }

    public function getCrDate()
    {
        return date('Y-m-d H:i:s');
    }

    public function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}