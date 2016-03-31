/**
 * Created by Administrator on 2016/3/31.
 */
$(function(){
    var oli=$('#nav li');
    oli.mouseover(function(){
        $(this).addClass('yellow').siblings().removeClass();
    })
});