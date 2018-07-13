<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"E:\phpstudy\WWW\yuxin_new\theme/home_view/template/public/tip.html";i:1525658945;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title></title>
    <style>
        .tips{
            overflow: hidden;
            line-height: 140%;
            margin-top: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }
        .tips .tishi {
            border: 1px solid #f23;
            padding: 5px;
            color: #fff;
            background: #F34;
            border-radius: 5px;
            width: 40%;
            display: inline-block;
            margin: auto;
            font-size: 14px;
            margin: 0px 3px;
        }
        .tips p{
            color:rgb(153, 153, 153);
        }

        a {
            text-decoration: none;
            color: #333;
            outline: none;
            cursor: pointer;
            bblr: expression(this.onFocus=this.blur());
        }
        header {
            position: relative;
            width: 100%;
            height: 12vw;
            line-height: 12vw;
            text-align: center;
            background: #fff;
            border-bottom: 1px solid #ccc;
        }
        header a {
            position: absolute;
            left: 0;
            top: 0;
            width: 9vw;
            height: 12vw;
            line-height: 12vw;
            text-align: center;
            font-size: 3vw;
        }

        /* 阿里巴巴矢量图库 */
        @font-face {
            font-family: 'iconfont';  /* project id 620876 */
            src: url('//at.alicdn.com/t/font_620876_byvu8t1af4njc3di.eot');
            src: url('//at.alicdn.com/t/font_620876_byvu8t1af4njc3di.eot?#iefix') format('embedded-opentype'),
            url('//at.alicdn.com/t/font_620876_byvu8t1af4njc3di.woff') format('woff'),
            url('//at.alicdn.com/t/font_620876_byvu8t1af4njc3di.ttf') format('truetype'),
            url('//at.alicdn.com/t/font_620876_byvu8t1af4njc3di.svg#iconfont') format('svg');
        }
        .iconfont{
            font-family:"iconfont" !important;
            font-style:normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }

    </style>
</head>

<body>
<div class="weui-tab ">
    <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
            <header>
                <a href="javascript:history.go(-1)">
                    <i class="iconfont"></i>
                </a>
                跳转提示
            </header>

            <div class="content_top">

           
            </div>
            <div class="content_bottom">
                <div style="text-align: center">
                    <!--<img src="__static__/img/icon_tip.png" style="width:70%" alt="">-->
                </div>

                <div class="tips">
                    <?php switch ($code) {case 1:?>
                    <p class="success"><?php echo(strip_tags($msg));?></p>
                    <?php break;case 0:?>
                    <p class="error"><?php echo(strip_tags($msg));?></p>
                    <?php break;} ?>
                </div>

                <div class="tips">
                    <p ><span id="wait"><?php echo($wait);?></span>秒后自动返回</p><br>
                    <a id="href" href="<?php echo($url);?>" style="color: #666;">
                        <span class="tishi">返回</span>
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>


<script src="__static__/js/jquery-2.1.4.js"></script>
<script>
    (function(){
        var wait = document.getElementById('wait'),
               href = document.getElementById('href').href;
        var interval = setInterval(function(){
           var time = --wait.innerHTML;
           if(time <= 0) {
               location.href = href;
               clearInterval(interval);
           };
        }, 1000);
    })();
</script>
</body>

</html>