<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/1
 * Time: 9:01
 */
namespace Home\Controller;

use Think\Controller;
use Think\Verify;

class RegisterController extends Controller
{
    public function register()
    {
        $this->display();
    }

    public function yanZhenMa()
    {
        $Verify = new Verify();
        $Verify->entry();
    }

}