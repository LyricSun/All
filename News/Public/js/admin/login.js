/**
 * Created by inner on 2017/10/20.
 */
//,点击button时触发
var login = {
    check : function () {
        //声明变量,把填写的用户名框内容赋给username,密码框内容赋给password
        var username = $('input[name = "username"]').val();
        var password = $('input[name = "password"]').val();
        //判断是否有空的情况
        if (!username) {
            //如果用户名空,跳出此点击事件,触发dialog下的error方法,弹出提示框
          return dialog.error('用户名为空');
        }
        // 同上
        if (!password) {
            return dialog.error('密码为空');
        }
//执行到此证明用户名和密码初步判断都不是空,此时进行下一步,用ajax将数据传输给后台
        //因为$.post方法传输时需要带4个参数,所在在使用之前先声明一下,将数据传给此url
        var url = '/admin.php?c=login&a=check';
        //声明要传输到后台的数据是什么,即用户名和密码
        var data = {
            'username' : username,
            'password' : password
        };
        //将数据传输到后台,回调函数内接受后台返回的结果,json格式
        $.post(url,data,function(result) {
//判断,如果返回的status是0 ,证明用户名或者密码有问题,弹出提示
if (result.status == 0) {
    return dialog.error(result.message);
}
//如果status是1,证明登陆成功,给出跳转页面的url
if(result.status == 1) {
    return dialog.success(result.message,'/admin.php');
}
        },'JSON');
    }
};
