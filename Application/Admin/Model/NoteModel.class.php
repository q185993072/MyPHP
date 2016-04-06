<?php
namespace Admin\Model;

use Think\Model;

class NoteModel extends Model
{
    protected $_auto=[
        ['created_at','created',Model::MODEL_INSERT,'callback'],
        ['user_id','user_id',Model::MODEL_INSERT,'callback']
    ];

    protected function created()
    {
        return date('Y-m-d H:i:s');
    }

    protected function user_id()
    {
        return session('id');
    }
}