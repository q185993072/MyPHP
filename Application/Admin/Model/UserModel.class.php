<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
    const MY_MODEL_TIMES = 4;
    protected $_validate=[
        ['name','','用户名已被注册',Model::EXISTS_VALIDATE ,'unique',UserModel::MY_MODEL_TIMES],
        ['email','email','请填写正确邮箱',Model::EXISTS_VALIDATE],
        ["mobile","11","手机号必须是11位",Model::EXISTS_VALIDATE,'length'],
        ['mobile','number','请填写数字',Model::EXISTS_VALIDATE],
        ['password','require','请输入密码',Model::EXISTS_VALIDATE,],
        ["password","6,12","密码须6到12位",Model::EXISTS_VALIDATE,'length'],
        ['repassword','require','请确认密码',Model::EXISTS_VALIDATE,],
        ['repassword','password','确认密码不正确',Model::EXISTS_VALIDATE,'confirm']
    ];

}