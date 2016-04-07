<?php
namespace Admin\Model;
use Think\Model;

class ModelModel extends Model
{
        protected $_auto=[
            ['created_at','date',Model::MODEL_INSERT,'callback'],
            ['updated_at','date',Model::MODEL_BOTH,'callback'],
            ['u_name','user_id',Model::MODEL_BOTH,'callback']
        ];

    protected function date()
    {
        return date('Y-m-d H:i:s');
    }

    protected function user_id()
    {
        return session('name');

    }
}