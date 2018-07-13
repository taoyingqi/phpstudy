<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/index\index.html";i:1524487155;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>逸信后台管理</title>
    <link rel="stylesheet" href="__static__/css/pintuer.css">
    <link rel="stylesheet" href="__static__/css/admin.css">
    <script src="__static__/js/jquery.js"></script>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1><img src="<?php echo (isset($admin['img']) && ($admin['img'] !== '')?$admin['img']:'__static__/images/y.jpg'); ?>" class="radius-circle rotate-hover" height="50" alt="" />逸信后台管理</h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="/" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;<a href="##" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;<a class="button button-little bg-red" href="/admin/login/login.html"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>

    <h2><span class="icon-music"></span>网站信息</h2>
    <ul style="display:none">
        <li><a href="/admin/index/show.html" target="right"><span class="icon-caret-right"></span>后台首页</a></li>
        <!--<li><a href="/admin/index/show_phpinfo.html" target="right"><span class="icon-caret-right"></span>后台信息</a></li>-->
        <li><a href="/admin/index/config.html" target="right"><span class="icon-caret-right"></span>网站设置</a></li>
        <!--<li><a href="/admin/index/info.html" target="right"><span class="icon-caret-right"></span>网站统计</a></li>-->
    </ul>
    <h2><span class="icon-user"></span>管理员</h2>
    <ul style="display:none">
        <li><a href="/admin/admin/show_admin.html" target="right"><span class="icon-caret-right"></span>管理员列表</a></li>
        <li><a href="/admin/admin/edit_password.html" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
        <!--<li><a href="/admin/admin/group_list.html" target="right"><span class="icon-caret-right"></span>角色管理</a></li>-->
    </ul>

    <!--<h2><span class="icon-th"></span>提车管理</h2>-->
    <!--<ul style="display:none">-->
        <!--<li><a href="/admin/queue/show_queue.html" target="right"><span class="icon-caret-right"></span>查看提车队列</a></li>-->
        <!--<li><a href="/admin/queue/add_queue.html" target="right"><span class="icon-caret-right"></span>加入提车队列</a></li>-->
        <!--<li><a href="/admin/queue/show_has_tc.html" target="right"><span class="icon-caret-right"></span>已提车队列</a></li>-->
        <!--<li><a href="/admin/queue/show_no_tc.html" target="right"><span class="icon-caret-right"></span>未提车队列</a></li>-->
        <!--<li><a href="/admin/queue/queue_cate.html" target="right"><span class="icon-caret-right"></span>档位分类管理</a></li>-->
    <!--</ul>-->


    <h2><span class="icon-user-md"></span>用户管理</h2>
    <ul style="display:none">
        <li><a href="/admin/user/show_user_list.html" target="right"><span class="icon-caret-right"></span>用户列表</a></li>
        <!--<li><a href="/admin/user/add_user.html" target="right"><span class="icon-caret-right"></span>添加用户</a></li>-->
    </ul>
    <h2><span class="icon-link"></span>新闻管理</h2>
    <ul style="display:none">
        <li><a href="/admin/link/show_news_cate.html" target="right"><span class="icon-caret-right"></span>文章分类</a></li>
        <!--<li><a href="/admin/link/show_link_cate.html" target="right"><span class="icon-caret-right"></span>链接分类</a></li>-->
        <li><a href="/admin/link/show_article_list.html" target="right"><span class="icon-caret-right"></span>文章列表</a></li>
        <li><a href="/admin/link/add_article.html" target="right"><span class="icon-caret-right"></span>添加文章</a></li>
        <!--<li><a href="/admin/link/show_news_link.html" target="right"><span class="icon-caret-right"></span>链接列表</a></li>-->
        <!--<li><a href="/admin/link/add_link.html" target="right"><span class="icon-caret-right"></span>添加链接</a></li>-->
    </ul>

</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  })
});
</script>
<ul class="bread">
  <li><a href="/admin/index/index.html" target="_self" class="icon-home"> 首页</a></li>
  <li><a href="##" id="a_leader_txt">网站信息</a></li>
  <li><b>欢迎你：</b><span style="color:#0ae;"><?php echo $admin['name']; ?></php></span>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;切换语言：<a href="##">中文</a> &nbsp;&nbsp;<a href="##">英文</a> </li>
</ul>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="" name="right" width="100%" height="100%"></iframe>
</div>
</body>
</html>