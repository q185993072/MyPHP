<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
    protected $_validate=[
        ['name','require','����д�û���'],
    ];

    protected $_auto=[
        ['password','md5',3,'function'],
    ];


}