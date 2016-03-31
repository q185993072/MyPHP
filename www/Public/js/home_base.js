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

    //�������������Ŀ��
    var browserWidth = $(window).width();

    //�������������ĸ߶�
    var browserHeight = $(window).height();

    //�������������������ϱ߽��ֵ
    var browserScrollTop = $(window).scrollTop();

    //��������������������߽��ֵ
    var browserScrollLeft = $(window).scrollLeft();



    //�������ڵĿ��
    var popWindowWidth = popWindow.outerWidth(true);
    //�������ڵĸ߶�
    var popWindowHeight = popWindow.outerHeight(true);

    //left��ֵ���������������Ŀ�ȣ�2���������ڵĿ�ȣ�2+��������������������߽��ֵ
    var positionLeft = browserWidth/2 - popWindowWidth/2+browserScrollLeft;

    //top��ֵ���������������ĸ߶ȣ�2���������ڵĸ߶ȣ�2+�������������������ϱ߽��ֵ
    var positionTop = browserHeight/2 - popWindowHeight/2+browserScrollTop;


    var oMask = '<div class="mask"></div>'
    //���ղ�Ŀ��
    var maskWidth = $(document).width();

    //���ղ�ĸ߶�
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