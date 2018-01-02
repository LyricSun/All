/**
 * Created by information on 2017/10/30.
 */

$(function() {
    $('#file_upload').uploadify({
        'swf'      : SCOPE.ajax_upload_swf,
        'uploader' : SCOPE.ajax_upload_image_url,
        'buttonText' : '选择图片',
        'onUploadSuccess' : function () {
            
        }

        // Put your options here
    });
});
