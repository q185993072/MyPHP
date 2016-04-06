<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
    const MY_MODEL_TIMES = 4;
    protected $_validate=[
        ['name','','用户名已被注册',Model::EXISTS_VALIDATE ,'unique',UserModel::MY_MODEL_TIMES],
        ['email','email','请填写正确邮箱'],
        ["mobile","11","手机号必须是11位",0,'length'],
        ['mobile','number','请填写数字',Model::EXISTS_VALIDATE]
    ];

}