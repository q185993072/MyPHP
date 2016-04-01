<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class AdminController extends Controller
{
    public function index()
    {
        layout(false);
        $this->display();
    }

    public function login()
    {
        layout(false);
        $this->display();
    }

    public function yanzhengma()
    {
        layout(false);
        $config=[
            'length'=>4,
            'fontSize'=>30
        ];
        $verfiy=new Verify($config);
        $verfiy->entry();
    }

    public function login_save()
    {
        $table=D('user');
        print_r($_POST);
    }
}