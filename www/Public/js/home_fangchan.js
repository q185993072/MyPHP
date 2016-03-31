/**
 * Created by Administrator on 2016/3/31.
 */
$(function(){
    var oul = $('#major .major_mid_1 ul');
    var ali = $('#major .major_mid_1 ul li');
    var numLi = $('#major .major_mid_1 ol li');
    var aliWidth = $('#major .major_mid_1 ul li').eq(0).width();
    var _now = 0;	//这个是控制数字样式的计数器
    var _now2 = 0;	//这个是控制图片运动距离的计数器
    var timeId;
    var aimg = $('#major .major_mid_1 ul img');
    var op = $('#major .major_mid_1 p');

    numLi.mouseover(function(){
        var index = $(this).index();
        _now = index;
        _now2=index;
        var imgAlt = aimg.eq(_now).attr('alt');
        op.html(imgAlt);
        $(this).addClass('current').siblings().removeClass();
        oul.animate({'left':-aliWidth*index},500);
    });

    /**
     * [slider description] 图片运动的函数
     * @return {[type]} [description] 无返回值
     */
    function slider(){
        if(_now==numLi.size()-1){
            ali.eq(0).css({
                'position':'relative',
                'left': oul.width()
            });
            _now=0;
        }else{
            _now++;
        }

        _now2++;

        numLi.eq(_now).addClass('current').siblings().removeClass();

        var imgAlt = aimg.eq(_now).attr('alt');
        op.html(imgAlt);

        oul.animate({'left':-aliWidth*_now2},580,function(){
            if(_now==0){
                ali.eq(0).css('position','static');
                oul.css('left',0);
                _now2=0;
            }
        });


    }

    timeId = setInterval(slider,2500);

    /*$('.wrap').mouseover(function(){
     clearInterval(timeId);
     });

     $('.wrap').mouseout(function(){
     timeId = setInterval(slider,1500);
     });*/

    $('.wrap').hover(function(){
        clearInterval(timeId);
    },function(){
        timeId = setInterval(slider,2500);
    });
});