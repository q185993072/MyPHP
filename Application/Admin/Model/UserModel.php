<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
    protected $_validate=[

    ];

    protected $_auto=[
        ['password','sha1',3,'function'],
    ];
}