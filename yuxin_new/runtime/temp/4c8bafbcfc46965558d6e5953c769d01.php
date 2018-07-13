<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\phpstudy\WWW\yuxin_new\theme/home_view/template/index\reg.html";i:1526540620;}*/ ?>
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
  <link rel="stylesheet" href="__static__/css/pc.css">

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
      <a href="/yxgj-pc1.0.0.1.exe" id="link_windows">
        <img src="__static__/img/icon_pc_download.png" class="ico_img" title="PC下载" alt="PC端下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="PC下载" alt="PC端下载" ></span>
      </a>
      <div class="down_title">PC下载</div>
    </li>
    <li>
      <a href="/yxgj0.6.13.apk" id="link_android">
        <img src="__static__/img/icon_andriod_download.png" class="ico_img" title="安卓下载" alt="安卓下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="安卓下载" alt="安卓下载" >
      </span>
     <!--  <span id="qrcode_andriod" class="wei_img" title="">
      <canvas width="145" height="145" style="display: none;"></canvas><img src="__static__/img/az.png" width="150" height="150" style="display: block;"></span> -->
      </a>
      <div class="down_title">Android下载</div>
    </li>
    <li>
      <a href="/yxgj0.6.13_signed.ipa" id="link_ios">
        <img src="__static__/img/icon_ios_download.png" class="ico_img" title="iOS下载" alt="iOS下载">
          <span class="an_img">
        <img src="__static__/img/icon_download.png" class="ico_img2" title="iOS下载" alt="iOS下载" >
      </span>
      <!-- <span id="qrcode_ios" class="wei_img" title="">
      <canvas width="145" height="145" style="display: none;"></canvas><img src="__static__/img/pg.png" width="150" height="150" style="display: block;"></span> -->
      </a>
      <div class="down_title">IOS下载</div>
    </li>
  </ul>
</div>
<div class="main">

  <header>
    账户注册
  </header>
  <form action="<?php echo url('home/index/do_reg'); ?>" method="post" enctype="multipart/form-data" >
    <div class="one" style="width:100%">
      <p><span class="ps">*</span><span>姓名</span></p>
      <div class="input"><input name="truename" required type='text'/></div>
      <p><span class="ps">*</span><span>性别</span></p>
      <div class="sex">
        <div class="man">
          <img src="__static__/img/look-null.png" alt="">
          <input type="radio" name="sex" value="1" id="man"/>
          <label for="man">男</label>
        </div>
        <div class="woman">
          <img src="__static__/img/look-null.png" alt="">
          <input type="radio" name="sex" value="0" id="woman"/>
          <label for="woman">女</label>
        </div>
      </div>
      <div class="clear"></div>
      <p><span class="ps">*</span><span>身份证号</span></p>
      <div class="input"><input name="cardcode" required type='text'/></div>
	  
	  
      <p><span class="ps">*</span><span>开户银行</span></p>
      <div class="input">
        <input required name="bankname" type='text'/>
      </div>

      <p><span class="ps">*</span><span>开户行所在地</span></p>
      <div class="input add">
        <select name="province3"></select>
        <select name="city3"></select>
        <select name="area3"></select>
      </div>

      <p><span class="ps">*</span><span>银行卡号</span></p>
      <div class="input"><input required name="bankcode" type='text'/></div>
	 

     <!--  <p><span class="ps">*</span><span>邮箱</span></p>
      <div class="input"><input required name="email" type='email'/></div> -->


      <!-- <p><span class="ps">*</span><span>手机号</span></p>
      <div class="input">
      <!-- <a class="style1" onclick="get_mobile_yzm()" id="yzm_obj">获取验证码</a> -->
         <!-- <input type='text' required name="mobile" id="mobile" pattern="[0-9]*"/>
      </div> -->
	  
	   <!-- 
      <p><span class="ps">*</span><span>手机验证码</span></p>
      <div  class="input"><input required name="yzm" type='text'/></div>-->

      <p><span class="ps">*</span><span>推荐码</span></p>
      <div class="input">
        <input  name="refcode" required type='text'/>
      </div>

    </div>

	<!--
    <div class="two">
      <p><span class="ps">*</span><span>身份证正面</span></p>
      <div class="upload">
        <input class="upload-input1" required name="cardtop" type="file">
        <img class="upload-img1" src="__static__/img/upload.jpg" height="200" width="300"/>
      </div>
      <p><span class="ps">*</span><span>身份证反面</span></p>
      <div class="upload">
        <input class="upload-input2" required name="cardback" type="file">
        <img class="upload-img2" src="__static__/img/upload.jpg" height="200" width="300"/>
      </div>
      <p><span class="ps">*</span><span>银行卡照片</span></p>
      <div class="upload">
        <input class="upload-input3" required name="bankimg" type="file">
        <img class="upload-img3" src="__static__/img/upload.jpg" height="200" width="300"/>
      </div>
    </div> -->

    <input class="btn" type="submit" value="立即提交">
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



  <!-- 地区选择引入外部 -->
  <script src="__static__/js/PCASClass.js"></script>
  <script>
    //- 地区选择
   new PCAS("province3","city3","area3");
    //- 照片上传 -

    // - 单选框 - //
    var man = document.querySelector('.man')
    var woman = document.querySelector('.woman');
    var btn  = man.getElementsByTagName('input')[0]
    var img  = man.getElementsByTagName('img')[0]
    var btn2  = woman.getElementsByTagName('input')[0]
    var img2  = woman.getElementsByTagName('img')[0]
    btn.onclick=function(){
      if(btn.checked==true){
        img.src = "__static__/img/look.png";
        img2.src = "__static__/img/look-null.png";
      }else{
        console.log(2);
      }
    }
    btn2.onclick=function(){
      if(btn2.checked==true){
        img2.src = "__static__/img/look.png";
        img.src = "__static__/img/look-null.png";
      }else{
        console.log(2);
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
