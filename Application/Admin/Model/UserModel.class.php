<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
    protected $_validate=[

    ];

    protected $_auto=[
        ['name','require','����д�û���'],
        ['password','md5',3,'function'],
        ['age','showage',3,'callback']
    ];

    protected function showage($str){

    }
}