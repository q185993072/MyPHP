/**
 * Created by Administrator on 2016/3/31.
 */
$(function(){

    var oBtn = $('.right_login .login');
    var popWindow = $('.login_list');
    var oClose = $('.login_list p span');

    //浏览器可视区域的宽度
    var browserWidth = $(window).width();

    //浏览器可视区域的高度
    var browserHeight = $(window).height();

    //浏览器纵向滚动条距离上边界的值
    var browserScrollTop = $(window).scrollTop();

    //浏览器横向滚动条距离左边界的值
    var browserScrollLeft = $(window).scrollLeft();



    //弹出窗口的宽度
    var popWindowWidth = popWindow.outerWidth(true);
    //弹出窗口的高度
    var popWindowHeight = popWindow.outerHeight(true);

    //left的值＝浏览器可视区域的宽度／2－弹出窗口的宽度／2+浏览器横向滚动条距离左边界的值
    var positionLeft = browserWidth/2 - popWindowWidth/2+browserScrollLeft;

    //top的值＝浏览器可视区域的高度／2－弹出窗口的高度／2+浏览器纵向滚动条距离上边界的值
    var positionTop = browserHeight/2 - popWindowHeight/2+browserScrollTop;


    var oMask = '<div class="mask"></div>'
    //遮照层的宽度
    var maskWidth = $(document).width();

    //遮照层的高度
    var maskHeight = $(document).height();



    oBtn.click(function(){
        popWindow.show().animate({
            'left':positionLeft+'px',
            'top':positionTop+'px'
        },500);

        $('body').append(oMask);
        $('.mask').width(maskWidth).height(maskHeight);

    });


    $(window).resize(function(){
        if(popWindow.is(':visible')){
            browserWidth = $(window).width();
            browserHeight = $(window).height();
            positionLeft = browserWidth/2 - popWindowWidth/2+browserScrollLeft;
            positionTop = browserHeight/2 - popWindowHeight/2+browserScrollTop;

            popWindow.animate({
                'left':positionLeft+'px',
                'top':positionTop+'px'
            },500);
        }
    });

    $(window).scroll(function(){
        if(popWindow.is(':visible')){
            browserScrollTop = $(window).scrollTop();
            browserScrollLeft = $(window).scrollLeft();
            positionLeft = browserWidth/2 - popWindowWidth/2+browserScrollLeft;
            positionTop = browserHeight/2 - popWindowHeight/2+browserScrollTop;
            popWindow.animate({
                'left':positionLeft+'px',
                'top':positionTop+'px'
            },500).dequeue();
        }

    });



    oClose.click(function(){
        popWindow.hide();
        $('.mask').remove();
    });

    //地图开始

    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }

    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(117.277168,31.884978);//定义一个中心点坐标
        map.centerAndZoom(point,16);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }

    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }

    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
        var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
        map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
        var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
        map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
        var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
        map.addControl(ctrl_sca);
    }

    //标注点数组
    var markerArr = [{title:"公司",content:"我的备注",point:"117.277195|31.88507",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
    ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                borderColor:"#808080",
                color:"#333",
                cursor:"pointer"
            });

            (function(){
                var index = i;
                var _iw = createInfoWindow(i);
                var _marker = marker;
                _marker.addEventListener("click",function(){
                    this.openInfoWindow(_iw);
                });
                _iw.addEventListener("open",function(){
                    _marker.getLabel().hide();
                })
                _iw.addEventListener("close",function(){
                    _marker.getLabel().show();
                })
                label.addEventListener("click",function(){
                    _marker.openInfoWindow(_iw);
                })
                if(!!json.isOpen){
                    label.hide();
                    _marker.openInfoWindow(_iw);
                }
            })()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }

    initMap();//创建和初始化地图

    //register验证
    $('.right_login .register').click(function(){
       var avalue=$('.right_login input').val();
        if(avalue==0){
            return true;
        }else{
            alert('请勿重复注册');
            return false;
        }
    })

    //$('#denlu').click(function(){
    //    var avalue=$('.right_login input').val();
    //    if(avalue==0){
    //        return true;
    //    }else{
    //        alert('请勿重复登陆');
    //        $(this).unbind();
    //        return false;
    //    }
    //})
});