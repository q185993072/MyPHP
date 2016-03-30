<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>论坛</title>
    <link href="/Public/luntan.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color: #ececec">
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

    <div  class="border nav" style="height: 40px;width: 1000px;float:left;">
        <div style="">

            <ul >
                <li class="li"><a href="#" class="li_a">首页</a></li>
                <li class="li"><a href="#" class="li_a">HTML教程</a></li>
                <li class="li"><a href="#" class="li_a">CSS基础</a></li> &nbsp;&nbsp;&nbsp;
                <li class="li"><a href="#" class="li_a">CSS开发工具</a></li> &nbsp;&nbsp;&nbsp;
                <li class="li"><a href="#" class="li_a">CSS特效</a></li> &nbsp;&nbsp;&nbsp;
                <li class="li"><a href="#" class="li_a">CSS问题</a></li> &nbsp;&nbsp;&nbsp;
            </ul>

        </div>
    </div>




</div>
</body>
</html>