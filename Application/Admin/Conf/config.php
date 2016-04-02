<?php
return array(
	//'配置项'=>'配置值'
    'URL_ROUTER_ON'           => true,
    'URL_ROUTE_RULES'        => [  //动态路由
        // 'get/:id'     =>    'home/test/login',
        'luntan'        =>  'Admin/index/luntan',
        'insert'       =>  ['home/index/insert','form=insert'],//带参数
        'update'       =>  ['home/index/insert','form=update'],


    ],
    'LAYOUT_ON'              =>true,

);
