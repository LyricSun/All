/**
 * Created by inner on 2017/10/30.
 */

$(function () {
    $('#file_upload').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_image_url,//这个就是处理上传文件的地址
        'buttonText' : '上传照片',
        'fileTypeDesc': 'Image Files',
        'fileObjName' : 'file',
        'fileTypeExs' : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
            if (response) {
                var obj = JSON.parse(data);
                $('#' + file.id).find('.data').html('上传完毕');
                $("#upload_org_code_img").attr("src",obj.data);
                $("#file_upload_image").attr("value",obj.data);
                $("#upload_org_code_img").show();
            }else {
                alert('上传失败');
            }


        }
    });

});

