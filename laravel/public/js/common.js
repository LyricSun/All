/**
 * Created by information on 2017/12/8.
 */

$.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#zanImg').click(function () {
    var status = $(this).attr('name');
    var post_id = $(this).attr('alt');
    var url = '';
    if (status === 'unzan')
    {
        url = '/posts/' + post_id + '/zan';
    }
    if (status === 'zan')
    {
        url = '/posts/' + post_id + '/unzan';
    }

    $.get(url,null,function (result) {
        console.log(result);
        if (result.code == 1)
        {
            $('#zanImg').attr('src','/images/zan.png');
            $('#zanImg').attr('name','zan');

        }
        if (result.code == -1)
        {
            $('#zanImg').attr('src','/images/unzan.png');
            $('#zanImg').attr('name','unzan');
        }
    },'JSON');
});

$('.like-button').click(function (event) {
    var status = $(this).attr('like-value');
    var des_user_id = $(this).attr('like-user');
    var url = '/user/' + des_user_id + '/';
    var target = $(event.target);
    if(status == 1)
    {
        url += 'unfan';
        $.post(url,null,function (result) {
            if (result.code == -1)
            {
                target.attr('like-value',0);
                target.text('关注');
                // window.location.reload();
            }
        },'JSON');
    }
    else
    {
        url += 'fan';
        $.post(url,null,function (result) {
            if (result.code == 1)
            {
                target.attr('like-value',1);
                target.text('取消关注');
                // window.location.reload();
            }
        },'JSON');
    }
});