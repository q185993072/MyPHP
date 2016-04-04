/**
 * Created by Administrator on 2016/4/2.
 */
$(function(){
   var aleft=$('.left_fu .left_fu_list span');
   var aleft1=$('.left_fu .left_zi_list span');
   var aleft2=$('.left_fu .left_person_list span');
   var aright=$('#right .right_list');
   aleft.click(function(){
      var index=$(this).index();
      aright.eq(index).removeClass('right_list').siblings().addClass('right_list');
   });
   aleft1.click(function(){
      var index=$(this).index()+aleft.size();
      aright.eq(index).removeClass('right_list').siblings().addClass('right_list');
   });
   aleft2.click(function(){
      var index=$(this).index()+aleft.size()+aleft1.size();
      aright.eq(index).removeClass('right_list').siblings().addClass('right_list');
   });

   $("#right .right_list1 input[name='submit']").click(function(){
      $.ajax({
         type:'post',
         url:'/Admin/admin/father_save',
         success:function(e){
            var index=$(this).index();
            if(e==true){
               aright.eq(index).removeClass('right_list');
            }
         }
      })
   })

});