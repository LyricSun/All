/**
 * Created by Wudi on 2017/10/23.
 */

// 跳转添加界面
$('#button-add').click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

// 添加提交按钮
$('#cms-button-submit').click(function () {
    var data = $('#cms-form').serializeArray();
    console.log(data);
    var postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });


    var url = SCOPE.save_url;

    $.post(url, postData, function (result) {
        if (result.status == 0){
            dialog.error(result.message);
        }
        if (result.status == 1){
            dialog.success(result.message, SCOPE.jump_url);
        }
    }, 'JSON');
});

$('.cms-table #cms-delete').click(function () {
    var id = $(this).attr('attr-id');
    var message = $(this).attr('attr-message');

    var data = {};
    data['id'] = id;
    data['status'] = -1;
    dialog.warning(message, SCOPE.set_status_url, data);

});


function todelete(url,data) {
    $.post(url,data,function (res) {
        if (res.status == 0){
            dialog.error(res.message);
        }
        if(res.status == 1){
            dialog.success(res.message,'');
        }
    },'JSON');
}

$('.cms-table #cms-edit').click(function () {
    var edit_id = $(this).attr('attr-id');

    var url = SCOPE.edit_url + '&id='+edit_id;

    window.location.href = url;



});




