<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/user\see_user.html";i:1524576035;s:62:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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

<div class="panel admin-panel">
<div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 查看用户 </strong></div>
                                                                                          <div class="body-content">
<form method="post" class="form-x" action="#">



 <div class="form-group">
        <div class="label">
        <label>用户姓名 ：</label>
           </div>
               <div class="field">
                <input type="text" class="input w50" style="width:50%"  disabled value="<?php echo $user['truename']; ?>" />
                <div class="tips"></div>
            </div>
 </div>

    <div class="form-group">
        <div class="label">
            <label>性别 ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%" disabled value="<?php echo $user['sex']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>身份证号 ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%" disabled value="<?php echo $user['cardcode']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>开户银行 ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%" disabled value="<?php echo $user['bankname']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>开户行所在地 ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%" disabled value="<?php echo $user['bankaddr']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>银行卡号 ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%"  disabled value="<?php echo $user['bankcode']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>邮箱 ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%" disabled value="<?php echo $user['email']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
    <div class="label">
        <label>手机号 ：</label>
    </div>
    <div class="field">
        <input type="text" class="input w50" style="width:50%" disabled name="mobile" value="<?php echo $user['mobile']; ?>" />
        <div class="tips"></div>
    </div>
       </div>

    <div class="form-group">
        <div class="label">
            <label>推荐码(邀请人) ：</label>
        </div>
        <div class="field">
            <input type="text" class="input w50" style="width:50%" disabled name="pass" value="<?php echo $user['refcode']; ?>" />
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>身份证正面 ：</label>
        </div>
        <div class="field">
             <div>
                 <img src="<?php echo $user['cardtop']; ?>" style="width: 350px;height: 200px" alt="">
             </div>
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>身份证反面 ：</label>
        </div>
        <div class="field">
            <div>
                <img src="<?php echo $user['cardback']; ?>" style="width: 350px;height: 200px" alt="">
            </div>
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">
            <label>银行卡照片 ：</label>
        </div>
        <div class="field">
            <div>
                <img src="<?php echo $user['bankimg']; ?>" style="width: 350px;height: 200px" alt="">
            </div>
            <div class="tips"></div>
        </div>
    </div>

    <div class="form-group">
<div class="label">
<label></label>
         </div>
           <div class="field">
               <input type="hidden" id="submit_url" value="/admin/user/do_add_user.html">
<!--<button class="button bg-main icon-check-square-o" type="submit"> 提交 </button>-->
           </div>
       </div>
    </form>
      </div>
        </div>
          
</body>
</html>