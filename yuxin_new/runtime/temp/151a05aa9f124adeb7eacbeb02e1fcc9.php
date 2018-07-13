<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\test_www\yuxin\theme/home_view/template/index\reg.html";i:1524488030;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
  <meta name="description" content="<?php echo $seo['description']; ?>" />
  <meta name="keywords" content="<?php echo $seo['keyword']; ?>" />
  <meta name="renderer" content="webkit" />
  <title>账户注册</title>
  <link rel="shortcut icon" href="__static__/img/logn.ico" type="image/x-icon">
  <link href="__static__/css/reste.css" rel="stylesheet" type="text/css">
  <link href="__static__/css/index.css" rel="stylesheet" type="text/css">

  <script src="https://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
  <script src="__static__/js/qrcode.min.js"></script>
  <script src="__static__/js/md5.js"></script>
  <script src="__static__/js/config.js"></script>
  <script src="__static__/js/jsencrypt.min.js"></script>
  <script src="__static__/js/encrypt.js"></script>
  <script src="__static__/js/config.js"></script>
  <script src="__static__/js/oem.component.js"></script>
  <script src="__static__/js/jquery.cookie.js"></script>
</head>

<body>

<div id="page_disabled" style="display: none">
  <div class="conte_main">
    <p class="conte_word" id="systembug">系统维护，无法注册！</p>
    <!-- <p class="conte_word1">请致电客服电话</p>
    <p class="conte_word2">
      <a href="#" id="customer"> 150 0049 4606 </a>
    </p> -->
  </div>
</div>
<div class="head">
  <div class="top">
    <img src="__static__/img/login.png" class="logo_sign">
  </div>
  <!-- top -->
</div>

<!-- head -->
<div class="head_main">
  <ul>
    <li class="pc">
      <a href="#" id="link_windows">
        <img src="__static__/img/icon_pc_download.png" class="ico_img" title="PC下载" alt="PC端下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="PC下载" alt="PC端下载" ></span>
      </a>
      <div class="down_title">PC下载</div>
    </li>
    <li>
      <a href="#" id="link_android">
        <img src="__static__/img/icon_andriod_download.png" class="ico_img" title="安卓下载" alt="安卓下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="安卓下载" alt="安卓下载" >
      </span>
      <span id="qrcode_andriod" class="wei_img" title="http://106.15.74.254:8050/opening/download.html">
      <canvas width="145" height="145" style="display: none;"></canvas><img style="display: block;" src="data:image/png;base64,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"></span>
      </a>
      <div class="down_title">Android下载</div>
    </li>
    <li>
      <a href="#" id="link_ios">
        <img src="__static__/img/icon_ios_download.png" class="ico_img" title="iOS下载" alt="iOS下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="iOS下载" alt="iOS下载" >
      </span>
      <span id="qrcode_ios" class="wei_img" title="https://itunes.apple.com/cn/app/winoter/id1225511672?mt=8">
      <canvas width="145" height="145" style="display: none;"></canvas><img src="data:image/png;base64,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" style="display: block;"></span>
      </a>
      <div class="down_title">IOS下载</div>
    </li>
  </ul>
</div>
<div class="main">
  <div class="sign_title">账户注册</div>
  <form id="jun_form">
    <div class="form-group" id="invite_cell" style="display: none">
        <span class="word">
      邀请码</span>
      <input type="text" class="text_input" id="invite_code" placeholder="请输入邀请码" onblur="onblurInvite()">

      <div class="must must3">
        <span class="star_m">* </span>
        <span class="must1">必填</span></div>
      <div class="error">
        <span id="error_invite"></span>
      </div>
    </div>

    <div class="form-group">
      <span class="word">真实姓名</span>
      <input type="text" class="text_input" name="username" id="input_name" placeholder="请输入姓名">
      <div class="must">
        <span class="star_m">* </span>
        <span class="must1">必填</span></div>
      <div class="error">
        <span id="error_name"></span>
      </div>
      <div class="bei">填写的用户名关联出金，需与真实姓名一致，否则无法出金</div>
    </div>
    <div class="form-group">
      <span class="word">手机号</span>
      <input type="text" class="text_input" name="mobile" id="mobile" placeholder="请输入手机号" >
      <!-- 错误信息提示 -->
      <div class="must must3">
        <span class="star_m">* </span>
        <span class="must1">必填</span></div>
      <div class="error">
        <span id="error_tel"></span>
      </div>
    </div>
    <div class="form-group">
      <span class="word">手机验证码</span>
      <div class="code">
        <input type="text" class="text_code" name="yzm"  placeholder="请输入手机收到的验证码" >
        <button type="button" class="btn_submit" id="yzm_obj" onclick="get_mobile_yzm()" id="btnvcode">获取验证码</button>
      </div>
      <div class="must must4">
        <span class="star_m">* </span>
        <span class="must1">必填</span></div>
      <div class="error">
        <span id="error_vcode"></span>
      </div>
    </div>
    <div class="form-group">
      <span class="word">交易密码</span>
      <input type="password" class="text_input" name="pass" id="input_password" placeholder="请输入交易密码" >
      <!-- 错误信息提示 -->
      <div class="must">
        <span class="star_m">* </span>
        <span class="must1">必填</span>
      </div>
      <div class="error">
        <span id="error_pwd"></span>
      </div>
    </div>
    <div class="form-group">
      <span class="word">确认密码</span>
      <input type="password" class="text_input" name="pass1" id="input_password_confirm" placeholder="请再次输入交易密码" >
      <!-- 错误信息提示 -->
      <div class="must">
        <span class="star_m">* </span>
        <span class="must1">必填</span></div>
      <div class="error">
        <span id="error_pwd_confirm"></span>
      </div>
    </div>

    <div class="form-group form-group1">
      <div class="deal">
        <input name="Fruit" type="checkbox" id="cbo_rule"  class="checkbox2" value="" />
      </div>
      <div class="deal2">我已阅读并同意</div>

      <div class="deal3"><a href="../oem/交易系统使用风险揭示书.pdf" target="_blank">《交易系统使用风险揭示书》</a></div>
    </div>
    <div class="group_bottom ">
      <div class="buttom4"></div>
      <div class="buttom">
        <div class="buttom2">
          <button type="button" class=" btn btn_present" id="btn_ok" onclick="do_reg()">注册</button>
          <button type="reset" class="btn btn_reset" >重置</button>
          <!-- <a href="#" onclick="onresetpassword()" class=" forget_password">忘记密码？</a> -->
        </div>
      </div>
    </div>
  </form>

  <script>
    function flush_yzm(o)
    {
      o.src = "<?php echo url('home/index/get_yzm'); ?>?rd"+ Math.random();
    }
    // $.alert("自定义的消息内容");
    function do_reg()
    {
      var mobile = $('input[name="mobile"]').val(),
              yzm = $('input[name="yzm"]').val(),
              pass = $('input[name="pass"]').val(),
              pass1 = $('input[name="pass1"]').val(),
       	username = $('input[name="username"]').val();
      if(!yzm || !pass || !pass1 || !username || !mobile)
      {
        alert("内容不能为空,请检查");
        return false;
      }

      var arr = $('#jun_form').serializeArray();
      $.ajax({
        url:"<?php echo url('home/index/do_reg'); ?>",
        data:arr,
        type:'post',
        dataType:'json',
        success:function(data){
          alert(data.msg);
          if(data.status == 0)
          {
            location.reload();
          }
        },
        error:function(err){
          console.log("失败");
        }
      })

    }
  </script>

  <script>
    var total = $.cookie('total');
    //	alert(total);

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

        var date = new Date();
        date.setTime(date.getTime()+60*1000);//只能这么写，10表示10秒钟
        $.cookie("total",60, {expires: date});

      } else {
        o.attr("onclick", "");
        o.val("重新发送( " + wait + " )");
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
<div class="foot">
  <div class="head_main_mob">
    <ul>
      <li>
        <a href="#" id="link_android_mob" onclick="as();">
          <img src="__static__/img/icon_andriod_download.png" class="ico_img" title="安卓下载" alt="安卓下载">
          <span class="an_img">
      <img src="__static__/img/icon_download.png" class="ico_img2" title="安卓下载" alt="安卓下载" >
      </span>
        </a>
        <div class="down_title">Android下载</div>
      </li>
      <li>
        <a href="#" id="link_ios_mob">
          <img src="__static__/img/icon_ios_download.png" class="ico_img" title="iOS下载" alt="iOS下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="iOS下载" alt="iOS下载" >
      </span>
        </a>
        <div class="down_title">IOS下载</div>
      </li>
    </ul>
  </div>

  <div class="foot1">


    <!--<span class="foot_word">Copyright<a id="oem_companylink" href="www.lanyee.hk" target="_blank" class="link">www.lanyee.hk</a></span>-->
    <span class="foot_word" id="oem_productflag">逸信国际</span>
  </div>
  <!--<div class="foot1">
  <span class="foot_word">
    <span class="tele"> 客服电话：<a id="oem_tel" href="tel:150 0049 4606"> 150 0049 4606 </a></span>
  </span>
  <span class="foot_word">
    <span class="tele1">QQ在线支持：<a id="oem_qq" href="tencent://message/?uin=415423510" class="land_title"> 415423510</a></span>
  </span>
</div>-->
</div>

</body>
<html>
