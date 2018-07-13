<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"E:\phpstudy\WWW\yuxin\theme/mobile_view/template/index\show_news.html";i:1524819042;s:45:"theme/mobile_view/template/public/header.html";i:1524646484;s:45:"theme/mobile_view/template/public/footer.html";i:1524646529;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>逸信国际-新闻详情</title>
    <link rel="stylesheet" href="__static__/css/style.css">
    <link rel="stylesheet" href="__static__/css/animation.css">
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
    <div class="text">新闻详情</div>
    <img src="__static__/img/seat.jpg" alt="">
</div>
<div class="show-text">
    <h3 style="text-align: center"><?php echo $news['title']; ?></h3>
    <?php echo $news['text']; ?>
    <p style="text-align:center;margin-top:3vw"><a href="/mobile" style="color:#d40100"> 返回首页 </a></p>
</div>
<footer>
    <a class="text"><i class="iconfont">&#xe791;</i>免責聲明</a>
    <a class="tel"><i class="iconfont">&#xe605;</i>客服熱線：400-8898-021</a>
</footer>
<div class="pop-bj"></div>
<script src="__static__/js/lp.js"></script>
</body>
</html>
