/**
 * Created by rain on 2017/7/31.
 */

$(document).ready(function () {

  // /* 搜索框 */
  // // $('#serach .sou .sousuo input.kuang').focus(function () {
  // //   $(this).val('');
  // // }); // 最后要写分号
  // //
  // // $('#serach .sou .sousuo input.kuang').blur(function () {
  // //   $(this).val('跨界');
  // // });


  /* 京东小金库和七日年化图片定时切换*/
  var dhtuIndex = 1;
  setInterval(function () {

    /**
     * 链式语法
     * $('#daohang .dhright .dhtu ul li') 获取到li元素的集合对象, 利用此对象调用.eq()方法
     *
     *
     * $('#daohang .dhright .dhtu ul li').eq(dhtuIndex)
     *      .eq()方法会返回根据下标找到的元素对象, 利用此对象继续调用.addClass()方法.
     *
     *
     * $('#daohang .dhright .dhtu ul li').eq(dhtuIndex).addClass('on')
     *      .addClass()方法会返回添加了类名的元素对象, 利用此对象继续调用.siblings()方法
     *
     * $('#daohang .dhright .dhtu ul li').eq(dhtuIndex).addClass('on').siblings()
     *      .siblings()方法会返回寻找到的兄弟元素对象集合, 利用此兄弟对象集合继续调用.removeClass('on'), 最终移除掉兄弟对象的on类.
     *
     *
     **/
    $('#daohang .dhright .dhtu ul li').eq(dhtuIndex).addClass('on').siblings().removeClass('on');

    dhtuIndex = dhtuIndex ? 0 : 1;

  }, 2000);



  /* 大轮播图 */
  var lbIndex = 0;

  var lbTimerId = setInterval(lunbo, 2000);

  function lunbo() {

    // 判断下标
    lbIndex = (lbIndex >= $('#main .mainleft .lunbo .pic li').length - 1) ? 0 : ++lbIndex;

    currentImg(lbIndex);
  }


  // 给大图片添加鼠标移入事件
  $('#main .mainleft .lunbo .pic li').mouseover(function () {
    clearInterval(lbTimerId);

  });


  // 给大图片添加鼠标移出事件
  $('#main .mainleft .lunbo .pic li').mouseout(function () {

    lbTimerId = setInterval(lunbo, 2000);

  });


  // 给轮播图标号添加鼠标移入事件
  $('#main .mainleft .lunbo .nav li').mouseover(function () {

    clearInterval(lbTimerId);

    // 当鼠标移出时, 可以从当前图片的下一张图片开始轮播.
    lbIndex = $(this).index();

    currentImg($(this).index());

  });


  $('#main .mainleft .lunbo .nav li').mouseout(function () {
    lbTimerId = setInterval(lunbo, 2000);
  });


  // 根据下标, 显示图片和轮播图对应的标号
  function currentImg(index) {

    $('#main .mainleft .lunbo .pic li').eq(index).fadeIn().siblings().hide();

    $('#main .mainleft .lunbo .nav li').eq(index).addClass('on').siblings().removeClass('on');

  }


  /* 浏览商品 */
  $('#main .mainleft .liulan .liuright').hover(
    // 鼠标移入时执行的函数, 不冒泡
    function () {

      // 改变按钮背景图片的位置
      $('#main .mainleft .liulan .liuright .righttu').css({
        'background-position': '5px -42px',
        'background-image': 'url(images/15.png)'
      });

      // 改变按钮的背景色
      $(this).css('background-color', '#f3f3f3');
    },

    // 鼠标移出时执行的参数, 不冒泡
    function () {
      $('#main .mainleft .liulan .liuright .righttu').css({
        'background-position': '-50px -51px',
        'background-image': 'url(images/16.png)'
      });

      $(this).css('background-color', '#fff');
    }
  );


  $('#main .mainleft .liulan .liuleft').hover(
    function () {
      $('#main .mainleft .liulan .liuleft .lefttu').css({
        'background-position': '1px -6px',
        'background-image': 'url(images/15.png)'
      });
      $(this).css('background-color', '#f3f3f3');
    },

    function () {
      $('#main .mainleft .liulan .liuleft .lefttu').css({
        'background-position': '-83px -51px',
        'background-image': 'url(images/16.png)'
      });

      $(this).css('background-color', '#fff');
    }
  );

  // 设置当前页数
  var pageIndex = 0;

  // 设置变量存储每次移动的距离.
  var width = 606;

  // 给右按钮添加点击事件
  $('#main .mainleft .liulan .liuright').click(function () {
    pageIndex = (pageIndex >= 3) ? 0 : ++pageIndex;

    $('#main .mainleft .liulan .liucenter ul').stop(0, 1).animate({left: -pageIndex * width});


  });

  $('#main .mainleft .liulan .liuleft').click(function () {

    pageIndex = pageIndex <= 0 ? 3 : --pageIndex;

    $('#main .mainleft .liulan .liucenter ul').stop(0, 1).animate({left: -pageIndex * width});

  });


  /* 图标区域 话费, 机票, 游戏... */
  var closed = 0;

  $('#main .mainright .tubiao ul li.xiala').mouseenter(function () {

    if (!closed) {
      $(this).parent().animate({top: -168});

      toggleTubiao($(this).index());

    } else {
      closed = 0;
    }
  });


  // 点击关闭
  $('#main .mainright .tubiao .tubiaola .close').click(function () {

    $('#main .mainright .tubiao ul').animate({top: 0});
    closed = 1;

  });


  $('#main .mainright .tubiao .tubiaola .close_menu ul li').mouseover(function () {

    toggleTubiao($(this).index());

  });

  /**
   * 根据下标显示当前页面
   * @param index 下标
   */
  function toggleTubiao(index) {

    $('#main .mainright .tubiao .tubiaola .c_main .box').eq(index).show().siblings().hide();

    $('#main .mainright .tubiao .tubiaola .close_menu li').eq(index).css('border-bottom', 'none').siblings().css('border-bottom', '1px solid #ccc');

  }


  /* 生活的橱窗 */
  $('#lifewindow .lifemain > div').each(function (index) {

    if (index < 8) {
      $(this).hover(
        function () {
          $(this).children('img').animate({left: -10});
        },

        function () {
          $(this).children('img').animate({left: 0});
        }
      );
    }
  });


  /* 1F 滑块效果 */
  var huakuaiWidth = $('#onefloor .one_top ul .huakuai').width();

  $('#onefloor .one_top ul li').mouseover(function () {

    var currentIndex = $(this).index();

    var f1_left = currentIndex * huakuaiWidth;

    $('#onefloor .one_top ul .huakuai').stop().animate({left: f1_left});

    $(this).children('h3').css('color', '#E4393C');

    $(this).siblings('li').children('h3').css('color', '#000');

    $('#onefloor .onemain .cent1').eq(currentIndex).show().siblings('.cent1').hide();

  });


  /* 1F 轮播图 */
  $('#onefloor .onemain .maincenter .cent1 .cenlunbo ul li').mouseover(function () {

    var index = $(this).index();
    var img_left = index * 473;
    $(this).css('background-color', '#7ABD54').siblings('li').css('background-color', '#ccc');

    $('#onefloor .onemain .maincenter .cent1 .cenlunbo .luntu').stop().animate({left: -img_left});

  });


  /* 热门晒单 */
  setInterval(function () {

    // 获取列表容器
    var $ul = $('#hot .hotleft .shaidan .shaimain ul');

    //将列表容器中最后一个列表项的高度变为0
    $ul.children().last().css('height', '0px');

    // 将最后一个列表项添加到列表容器的第一个位置
    $ul.prepend($ul.children().last());

    // 将此时列表容器中的第一个列表项的高度变为80px
    $ul.children().first().animate({height: 80}, 500);

  }, 2000);
});


