/**
 * Created by Administrator on 2016/4/2.
 */
$(function(){
   var abtn=$("#right .right_fu button");
   var aint=$('#right .right_fu input[name=title]');
   var aid=$('#right .right_fu input[name=id]');
   abtn.click(function(){
      $.post('/admin/admin/father_save',{title:aint.val(),id:aid.val()},function(e){
         if(e==1){
            alert('父版块名重复');
         }else if(e==2){
            alert('添加父版块成功');
         }else if(e==3){
            alert('添加父版块失败');
         }else if(e==4){
            alert('修改父版块成功');
            location.href='/admin/admin/index';
         }else if(e==5){
            alert('修改父版块失败');
         }else{
            alert('非法操作');
         }
      })
   });
});