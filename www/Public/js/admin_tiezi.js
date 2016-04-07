/**
 * Created by Administrator on 2016/4/7.
 */
$(function(){
    var abtn=$('.zlt_border .btn button');
    abtn.click(function(){
        $.post('/Admin/index/pinlun',{},function(e){
            alert(e);
        })
    })
});