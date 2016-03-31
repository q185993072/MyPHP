/**
 * Created by Administrator on 2016/3/31.
 */
$(function(){
    var oli=$('#nav li');
    oli.mouseover(function(){
        $(this).addClass('yellow').siblings().removeClass();
    });

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
});