<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>论坛</title>
    <link href="/Public/luntan.css" rel="stylesheet" type="text/css">
    <script src="/Public/jQuery/jquery.min.js" type="text/javascript"></script>
    <script src="/Public/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/Public/jquery-validation/dist/localization/messages_zh.min.js" type="text/javascript"></script>
    <script src="/Public/myfocus/myfocus-2.0.4.min.js" type="text/javascript"></script>
</head>
<body style="background-color: #EFEFEF">
<div id="hd">
    <div class="hd_dl " style="float: left;width: 300px">
        <h2>
            <a title="某某论坛" href="#">
                <img src="/Public/img/lufei.png"
                     style="height: 120px;margin-top: -20px;margin-right:30px  ">
            </a>
        </h2>
    </div>


    <div class="hd_dl " style="float: right;width: 350px">
        <form method="post" action="#">
            <div style="margin-top: 20px;">
                <div style="width:350px;height: 30px;">
                    <label style="font-size: small">账号：</label>
                    <input type="text" name="username"/>
                    <input type="checkbox" name="remember_login">
                    <label style="color: #333333;font-size: small">自动登录</label>
                    &nbsp;
                    <a href="#" style="color: #232323;text-decoration:none;font-size: small;">找回密码</a>
                </div>

                <div style="width: 350px;height: 30px;">
                    <label style="font-size: small">密码：</label>
                    <input type="text" name="username"/>
                    &nbsp;&nbsp;&nbsp;
                    <input type="submit" name="login" value="登录">
                    &nbsp;&nbsp;&nbsp;
                    <a href="#" style="color: red;text-decoration:none;font-size: small;font-weight: 200">注册</a>
                </div>
            </div>
        </form>
    </div>


    <div class="hd_dl" style="float: right;width: 150px">
        <div style="margin-top: 23px;">
            <div style="width:150px;height: 30px">
                <a href="#"><img src="/Public/img/QQ.png"></a>
            </div>
            <div style="width:150px;height: 30px;">
                <label style="font-size: small;color: #999999"> &nbsp; 只需一步，快速开始</label>

            </div>
        </div>

    </div>

    <div class=" nav" style="height: 40px;width: 1000px;float:left;">
        <div style="float: right ;width: 100px;height: 30px;margin-top: 5px;margin-right:7px;cursor: pointer  ">
            <img src="/Public/img/kjdhup.png">
        </div>
        <div style="">

            <ul>
                <li class="li"><a href="#" class="li_a">首页</a></li>
                <li class="li"><a href="#" class="li_a">HTML教程</a></li>
                <li class="li"><a href="#" class="li_a">CSS基础</a></li>
                <li class="li"><a href="#" class="li_a">CSS开发工具</a></li>
                <li class="li"><a href="#" class="li_a">CSS特效</a></li>
                <li class="li"><a href="#" class="li_a">CSS问题</a></li>
            </ul>

        </div>
    </div>

    <div style="float: left;width: 1000px;height: 90px;">
        <a href="#"><img src="/Public/img/hengfu1.jpg" style="width: 1000px;height: 90px"></a>
    </div>

    <div class=" nav" style="height: 55px;width: 1000px;float:left;">
        <div class="input" id="box-shadow4" style="float: left">
            <div style="width: 28px;height: 26px;margin-top: 4px;margin-left: 2px;float: left">
                <img src="/Public/img/fangdajing.png">
            </div>
            <div style="float: left;margin-top: 2px">
                <input type="text" class="search">
            </div>
        </div>
        <div style="float: left;margin-top: 12px;margin-left: 1px">
            <a href="#"><img src="/Public/img/tiezi.png"></a>
        </div>
        <div style="float: left;">
            <input type="submit" class="sousuo" value="搜索">
        </div>
        <div style="float: left;margin-top: 17px;margin-left: 7px">
            <label style="color: #666666;font-size: small;font-weight: bolder;">热搜：</label>
            <a href="#" style="color: #666666;font-size: small;text-decoration:none;">月薪多少能撑一个家</a>&nbsp;&nbsp;&nbsp;
            <a href="#" style="color: #666666;font-size: small;text-decoration:none;">刘德华二度当爸</a>&nbsp;&nbsp;&nbsp;
            <a href="#" style="color: #666666;font-size: small;text-decoration:none;">黄子韬</a>

        </div>
    </div>


    <div style="float: left">
        <div id="mianbaoxie" style="float: left;margin-top: 10px ">
            <img src="/Public/img/home.png"><label style="color:#666666 ">&#92;</label>
        </div>
    </div>

</div>


<div id="bd" class="border">
    <div style="float: left;width: 705px;height: 230px; " class="bd_border">
        <div id="boxID" style="width: 300px;;height: 180px;margin-left: 22px;margin-top: 18px;float: left "
             class="bd_border">
            <div class="loading">
                <img src="/Public/myfocus/mf-pattern/img/loading.gif" alt="标题">
            </div>
            <div class="pic">
                <ul >
                    <li><a href="#"><img src="/Public/img/lufei.png" alt="标题1"/></a></li>
                    <li><a href="#"><img src="/Public/img/lufei.png" alt="标题"/></a></li>
                    <li><a href="#"><img src="/Public/img/lufei.png" alt="标题"/></a></li>
                    <li><a href="#"><img src="/Public/img/lufei.png" alt="标题"/></a></li>
                </ul>
            </div>
        </div>
        <div style="float: left;width: 370px;height: 190px;margin-top: 22px" >
            <div style="width: 368px;height: 30px">
             <ul class="tabs">
                 <li class="lid">最新帖子</li>
                 <li class="lid">最新回复</li>
                 <li class="lid">热门帖子</li>
                 <li class="lid">活跃会员</li>
             </ul>
            </div>
            <div class="bd_border"style="width: 350px;margin-top: -10px;margin-left: auto;margin-right: auto"></div>

        </div>
    </div>
    <div style="float: left;width: 276px;height: 230px; margin-left: 15px" class="bd_border">
        <div style="width: 276px;height: 49px">
            <img src="/Public/img/day.png"style="width: 276px;height: 49px">

        </div>

    </div>

    <div style="float: left;width: 1000px;height: 90px;margin-top: 20px"class="bd_border">
        <a href="#"><img src="/Public/img/hengfu2.jpg" style="width: 1000px;height: 90px"></a>
    </div>

</div>
<script type="text/javascript">
    myFocus.set({
        id: 'boxID',
        pattern: 'mF_fancy',
        time: 3,
        trigger: 'mouseover',
        delay: 200,
        txtHeight: 'default'
    })
</script>


<div id="wei">
    <div class="erweima" style="margin-top:26px; margin-left: 32px;">
        <img src="/Public/img/erweima.png" style="border: 1px #CCCCCC solid">
    </div>
    <div class="erweima " style="margin-top:40px; margin-left: 12px;">
        <label style="font-weight: bolder;font-size: small;color:#666666">鬼影人间官方论坛！</label><br/>
        <label style="font-size: small;color:#666666;">请使用微信或ＱＱ扫一扫，扫描此二码，下载鬼影人间官方论坛App，此App支持IOS设备与Android设备... </label>
    </div>
    <div class="jieshao" style="margin-left:60px">
        <ul>
            <div><label style="font-weight: bolder;font-size: small;margin-top: 30px;line-height: 30px">关于鬼影</label>
            </div>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影新浪微博</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影豆瓣小站</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影人人网站</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影百度贴吧</a></li>
        </ul>

    </div>
    <div class="jieshao">
        <ul>
            <div><label style="font-weight: bolder;font-size: small;margin-top: 30px;line-height: 30px">收听方式</label>
            </div>
            <li class="jieshao_li"><a href="#" class="jieshao_a">喜马拉雅</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">荔枝 FM</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">百度乐播</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">网易音乐</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">Podcast</a></li>
        </ul>
    </div>
    <div class="jieshao">
        <ul>
            <div><label style="font-weight: bolder;font-size: small;margin-top: 30px;line-height: 30px">鬼影分站</label>
            </div>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影文学站</a></li>

        </ul>
    </div>
    <div class="jieshao">
        <ul>
            <div><label style="font-weight: bolder;font-size: small;margin-top: 30px;line-height: 30px">关于鬼影</label>
            </div>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影主页</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影简介</a></li>
            <li class="jieshao_li"><a href="#" class="jieshao_a">鬼影团队</a></li>

        </ul>
    </div>

</div>
</body>
</html>
<script type="text/javascript">
    $('li').mouseover.function({})
</script>