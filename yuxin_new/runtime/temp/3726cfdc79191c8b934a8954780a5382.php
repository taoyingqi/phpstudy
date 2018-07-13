<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/link\edit_news_cate.html";i:1488938316;s:62:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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
  <div class="body-content">
    <form method="post" class="form-x" action="">

      <div class="form-group">
        <div class="label">
          <label>分类名称：</label>
        </div>
        <div class="field">
            <input type="hidden" name="id" value="<?php echo $list['id']; ?>" >
          <input type="text" class="input w50" name="cate_name" value="<?php echo $list['cate_name']; ?>" />
          <div class="tips"></div>
        </div>
      </div>


        <div class="form-group">
            <div class="label">
                <label>分类类型：</label>
            </div>
            <div class="field">
                <p style="padding-top:5px"><?php echo $list['display_mode']; ?></p>
                <div class="tips" title=""></div>
            </div>
        </div>

      <div class="form-group">
        <div class="label">
          <label>显示位置说明：</label>
        </div>
        <div class="field">
          <textarea name="display_position" class="input w50"><?php echo $list['display_position']; ?></textarea>
          <div class="tips"></div>
        </div>
      </div>

        <div class="form-group">
            <div class="label">
                <label>排序：</label>
            </div>
            <div class="field">
                <input type="text" class="input w50" name="sort" value="<?php echo $list['sort']; ?>"  data-validate="required:,number:排序必须为数字" />
                <div class="tips"></div>
            </div>
        </div>

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
            <input type="hidden" id="submit_url" value="/admin/link/do_edit_news_cate.html">
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>