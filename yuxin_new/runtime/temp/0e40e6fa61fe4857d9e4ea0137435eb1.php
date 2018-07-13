<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/login\login.html";i:1487904182;s:66:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>

    <link rel="stylesheet" type="text/css" href="__static__/css/pintuer.css" />
    <link rel="stylesheet" type="text/css" href="__static__/css/admin.css" />
    
    <style>
        .pagination li{border: none;}
    </style>
    
    <script type="text/javascript" src="__static__/js/jquery.js"></script>
    <script type="text/javascript" src="__plugin__/layer/layer.js"></script>
    <script type="text/javascript" src="__static__/js/pintuer.js"></script>

    
    <script src="__static__/js/laydate/laydate.js"></script>
    
</head>
<body>

<div class="bg"></div>
<div class="container">
    <div class="line bouncein">
        <div class="xs6 xm4 xs3-move xm4-move">
            <div style="height:150px;"></div>
            <div class="media media-y margin-big-bottom">           
            </div>         
            <form action="" id="login_form" method="post">
            <div class="panel loginbox">
                <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input input-big" name="name" placeholder="登录账号" data-validate="required:请填写账号" />
                            <span class="icon icon-user margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input input-big" name="password" placeholder="登录密码" data-validate="required:请填写密码" />
                            <span class="icon icon-key margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input input-big" name="code" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
                           <!--<img src="__static__/images/passcode.jpg" alt="" width="100" height="32" class="passcode" style="height:43px;cursor:pointer;" onclick="this.src=this.src+'?'">-->
                            <img src="/admin/login/get_verifi.html" alt="" width="100" height="32" class="passcode" style="height:43px;cursor:pointer;" onclick="this.src=this.src+'?'">

                        </div>
                    </div>
                </div>
                <div style="padding:30px;"><input type="submit" class="button button-block bg-main text-big input-big" value="登录"></div>
                    <input type="hidden" id="submit_url" value="/admin/login/do_login.html">
            </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>