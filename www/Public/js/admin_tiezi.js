/**
 * Created by Administrator on 2016/4/7.
 */
$(function(){
    var abtn=$('.zlt_border .btn button');
    abtn.click(function(){
        var value=$('.li_shutiao #tiezi').text();
        $.post('/Admin/index/pinlun',{},function(e){
            alert(value);
        })
    })
});