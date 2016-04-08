
$(function(){
    var abtn1=$('.right_list table a[name="delete"]');
    abtn1.click(function(){
        var id=$(this).attr('id');
        $.get('/admin/user/user_delete',{id:id},function(e){
            if(e){
                alert('删除成功');
                window.location.reload();
            }else{
                alert('删除失败');
            }
        });
    });
});