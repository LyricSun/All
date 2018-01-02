/**
 * Created by information on 2017/12/15.
 */
$.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.post-audit').click(function () {
    var post_id = $(this).attr('post-id');
    var status = $(this).attr('post-action-status');
    var url = '/admin/posts/' + post_id + '/status';
    var target = $(event.target);
    $.post(url,{'status' : status},function (result) {
        if (result.code == 1)
        {
            target.parent().parent().remove();
        }
    },'JSON');
});

$('.resource-delete').click(function (event) {
    if (confirm('确定删除吗?') === false)
    {
        return;
    }
    var url = $(this).attr('delete-url');
    $.post(url,{'_method' : 'DELETE'},function (result) {
        if (result.code == 1)
        {
            window.location.reload();
        }
    },'JSON');
});