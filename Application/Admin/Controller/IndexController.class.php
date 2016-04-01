<?php
namespace Admin\Controller;

use Think\Controller;


class IndexController extends Controller
{
    public function index()
    {
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function luntan()
    {
        $this->display();
    }
    public function ziluntan()
    {
        $this->display();
    }
    public  function yasuoimg()
    {
        $obj = new \Think\Image();
        $img = $obj->open('"/Public/img/lufei.png"');
        echo "宽".$img->width()."</br>";
        echo "MIME".$img->mime()."</br>";
        echo "高".$img->height()."</br>";
        echo "类型".$img->type()."</br>";
       // $img->crop(400,175,50,50)->save('upload_2.png');//裁剪
      //  $img->thumb(500,500,Image::IMAGE_THUMB_FILLED)->save("/Public/img/lufei2.png");//缩放并填充白边
      //  $img->thumb(400,400,Image::IMAGE_THUMB_FIXED)->save("/Public/img/lufei3.png");//缩放并拉伸
       // $img->water('shuiying.png')->save("/Public/img/lufei4.png");//加水印
        $img->text('asdf','./ThinkPHP/Library/Think/Verify/ttfs/5.ttf','30','#999999',Image::IMAGE_THUMB_SOUTHEAST)->save("/Public/img/lufei4.png");


    }
}


