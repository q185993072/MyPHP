/**
 * Created by Administrator on 2016/4/2.
 */
$(function(){
   var abtn=$("#right .right_fu button");
   var aint=$('#right .right_fu input');
   abtn.click(function(){
      $.post('/admin/admin/father_save',{title:aint.val()},function(e){
         if(e==1){
            alert('父版块名重复');
         }else if(e==2){
            alert('添加父版块成功');
         }else{
            alert('添加父版块失败');
         }
      })
   });
});