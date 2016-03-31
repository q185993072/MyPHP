<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->js='home_base';
        $this->cs='home_index';
        $this->display();
    }

    public function fangchan()
    {
        $this->js='home_fangchan';
        $this->cs='home_fangchan';
        $this->display();
    }
}