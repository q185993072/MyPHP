<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model
{
    const MY_MODEL_TIMES = 4;
    protected $_validate=[
        ['name','','�û����ѱ�ע��',Model::EXISTS_VALIDATE ,'unique',UserModel::MY_MODEL_TIMES],
        ['email','email','��������ȷ����',Model::VALUE_VALIDATE ],
        ["mobile","11","�ֻ��ű�����11λ",0,'length'],
        ['mobile','number','����д����',Model::EXISTS_VALIDATE]
    ];

}