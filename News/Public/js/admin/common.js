/**
 * Created by inner on 2017/10/23.
 */
//跳转添加界面
$('#button-add').click(function () {
    var url = SCOPE.add_url;
    location.href = url;
});
//添加提交按钮
$('#cms-button-submit').click(function () {
    var data = $('#cms-form').serializeArray();
    var postData = {};
    $(data).each(function () {
        postData[this.name] = this.value;
    });

    var url = SCOPE.save_url;
    var jump_url = SCOPE.jump_url;
    console.log(postData);

    $.post(url, postData, function (result) {
        if (result.status == 0) {
            dialog.error(result.message);
        }
        if (result.status == 1) {
            dialog.success(result.message, jump_url);
        }
    }, 'JSON');

});
//删除下午


$('.cms-table #cms-delete').click(function () {
    var id = $(this).attr('attr-id');
    var message = $(this).attr('attr-message');
    var data = {};
    data['id'] = id;
    data['status'] = -1;
    dialog.warning(message, SCOPE.set_status_url, data);

});
function todelete(url, data) {
    $.post(url, data, function (result) {
        if (result.status == 0) {
            dialog.error(result.message);
        }
        if (result.status == 1) {
            dialog.success(result.message, '');
        }

    }, 'JSON');
}
//作业自己写的有错误更新
$('.cms-table #cms-edit').click(function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '&id=' + id;

    location.href = url;
});

//作业结束排序
$('#button-listorder').click(function () {
    var data = $('#cms-listorder').serializeArray();
    var postData = {};
    $(data).each(function () {
        postData[this.name] = this.value;
    });
    var url = SCOPE.listorder_url;
    $.post(url, postData, function (result) {
        if (result.status == 0) {
            dialog.error(result.message);
        }
        if (result.status == 1) {
            dialog.success(result.message, '/admin.php?c=menu');
        }
    }, 'JSON');

});

//推送
$('#cms-push').click(function () {
    var content_id = $('input[name="pushcheck"]:checked').attr('value');
    var position_id = $('option[name="positionfl"]:selected').val();

    var url = SCOPE.push_url;
    var data = {
        'content_id' : content_id,
        'position_id' : position_id
    };
    $.post(url,data,function (res) {

        if (res.status == 0) {
            dialog.error(res.message);
        }
        if (res.status == 1) {
            dialog.success(res.message);
        }

    },'JSON');
});







