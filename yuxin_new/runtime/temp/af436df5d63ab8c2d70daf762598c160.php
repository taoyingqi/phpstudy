<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"E:\phpstudy\WWW\yuxin_new\theme/mobile_view/template/index\reg.html";i:1525767473;s:45:"theme/mobile_view/template/public/header.html";i:1524646484;s:45:"theme/mobile_view/template/public/footer.html";i:1525415738;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>逸信国际-开户交易</title>
  <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
  <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
  <link rel="stylesheet" href="__static__/css/style.css">
  <link rel="stylesheet" href="__static__/css/animation.css">
  <script src="https://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
  <script src="__pcstatic__/js/jquery.cookie.js"></script>
</head>
<body>
  <!-- 头部 -->
  <header>
    <div class="logo">
        <a href="/mobile" style="display:block">
        <img src="__static__/img/logo.gif" alt="">
        </a>
    </div>
    <div class="menu">
        <a>
            <i class="iconfont">&#xe790;</i>
            <span>MENU</span>
        </a>
        <div class="menu-pop">
            <a href="/mobile">首頁</a>
            <a href="<?php echo url('mobile/index/company_info'); ?>">公司介紹</a>
            <a href="<?php echo url('mobile/index/product'); ?>">產品服務</a>
            <a href="<?php echo url('mobile/index/download'); ?>">軟件下載</a>
            <a href="<?php echo url('mobile/index/reg'); ?>">開戶交易</a>
            <a href="<?php echo url('mobile/index/about'); ?>">聯系我們</a>
        </div>
    </div>
</header>
  <!-- banner -->
  <div class="seat">
    <div class="text">开户交易</div>
    <img src="__static__/img/seat.jpg" alt="">
  </div>
  <div class="khjy">
    <form action="<?php echo url('mobile/index/do_reg'); ?>" method="post" enctype="multipart/form-data">
      <div class="input"><input type='text' name="truename" required placeholder="姓名" /><span>必填</span></div>
      <div class="input">
        <select name="sex" required>
          <option>性别</option>
          <option value="1">男</option>
          <option value="0">女</option>
        </select>
        <span>必填</span>
      </div>
      <div class="input"><input type='password' required name="cardcode" placeholder="身份证号" /><span>必填</span></div>
      <div class="input">
        <input  type='text' name="bankname" required placeholder="开户行名称"/>
        <span>必填</span>
      </div>
      <div class="input"><input id='city-picker' required type='text' name="bankaddr" placeholder="开户行所在地"/><span>必填</span></div>
	  
      <div class="input"><input type='text' name="bankcode" placeholder="银行卡号" /><span>必填</span></div>
     <!--  <div class="input"><input type='email' name="email" placeholder="邮箱" /><span>必填</span></div> -->
     <!--  <div class="input">
        <input type='number' id="mobile" name="mobile" required placeholder="手机号" pattern="[0-9]*"/><span>必填</span>
        <a id="yzm_obj" onclick="get_mobile_yzm()">获取验证码</a>
      </div> -->
     <!--  <div class="input"><input name="yzm" required type='text' placeholder="请输入验证码" /></div> -->
      <div class="input"><input name="refcode" required type='text' placeholder="推荐码" /><span>必填</span></div>

    <!--   <div class="upload">
        <input class="upload-input1" name="cardtop" required type="file">
        <img class="upload-img1"  src="__static__/img/null.png"/>
        <div class="text">上传身份证正面</div>
      </div>
      <div class="upload">
        <input class="upload-input2" required name="cardback" type="file">
        <img class="upload-img2"  src="__static__/img/null.png"/>
        <div class="text">上传身份证反面</div>
      </div>
      <div class="upload">
        <input class="upload-input3" required name="bankimg" type="file">
        <img class="upload-img3" src="__static__/img/null.png"/>
        <div class="text">上传银行卡正面</div>
      </div> -->
	  
      <input class="btn" type="submit" value="立即注册">

    </form>

    <script>
      var total = $.cookie('total');
      //alert(total);

      if(total != 60 && typeof(total)!='undefined')
      {
        time($('#yzm_obj'));
      }

      function get_mobile_yzm()
      {
        var mobile = document.getElementById('mobile').value;
        //   alert(mobile);return;
        if(!mobile)
        {
          alert('手机号不能为空');
          return;
        }

        if(!(/^1\d{10}$/.test(mobile)))
        {
          alert('手机号错误');
          return;
        }
        var url = "<?php echo url('home/sms/sendsms'); ?>";

        $.post(url,{'tel':mobile},function(data){
          if(data.code == 1)
          {
            alert(data.msg);
            var yzm = $('#yzm_obj');
            var date = new Date();
            date.setTime(date.getTime()+60*1000);//只能这么写，10表示10秒钟
            $.cookie("total",60, {expires: date});
            time(yzm);
          }else{
            alert(data.msg);
          }

        },"json");

      }

      //设置倒计时
      function time(o) {
        // alert(typeof($.cookie));
        var wait = $.cookie("total");
        // alert(wait);
        if (wait == 0) {
          o.attr('onclick','get_mobile_yzm()');
          o.text("获取验证码");
          $.cookie("total",60);
        } else {
          o.attr("onclick", "");
          o.text("重新发送( " + wait + " )");
          wait--;
          $.cookie("total",wait);
          setTimeout(function() {

                    time(o);
                  },
                  1000)
        }
      }

    </script>
  </div>

  <footer>
    <a class="text"><i class="iconfont">&#xe791;</i>免責聲明</a>
    <!-- <a class="tel"><i class="iconfont">&#xe605;</i>客服熱線：400-8898-021</a> -->
</footer>
  <div class="pop-bj"></div>
  <div class="form-key"></div>
  <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
  <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
  <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
  <script type="text/javascript">
    $("#city-picker").cityPicker({
        title: "地址"
    });
  </script>
  <script src="__static__/js/lp.js"></script>
</body>
</html>
