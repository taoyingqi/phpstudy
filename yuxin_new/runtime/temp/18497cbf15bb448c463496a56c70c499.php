<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/index\config.html";i:1488522161;s:66:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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
    #panel-head>strong{
      margin:0 5px;
      cursor: pointer;
    }

    .jun {
        display: inline-block;
        margin-top: 7px;
    }

    .junjun{
        display: inline-block;
        margin-top: 10px;
    }

    #panel-head{ border-bottom:1px solid #0ae }

    #panelM>div{display: none;}
      strong { border:solid 1px #0ae;background-color: #0ae;
                font-size: 12px;
                 color:#fff;
               padding: 9px;
             }

       .cur { background-color: #FFF; color:#0ae;border-bottom:2px solid #fff; }

  </style>

    <script type="text/javascript" src="__static__/js/jquery.js"></script>
    <script type="text/javascript" src="__plugin__/layer/layer.js"></script>
    <script type="text/javascript" src="__static__/js/pintuer.js"></script>

    
    <script>
      $(
        function () {
        $('#panelM>div:first-child').css('display','block');
        $('#panel-head>strong').each(function () {

          $(this).click(function () {
              $(this).addClass('cur').siblings().removeClass('cur');
            var i = $(this).index();
            $('#panelM>div').eq(i).show().siblings().hide();
          });

        });
      });

      function set_config(v,id)
      {

          layer.confirm('您确定要配置吗？', {
              btn: ['确定','取消'] //按钮
          }, function(){
              var url = "/admin/index/ajax_set_val.html";
              var param = {'val' : v,'id' : id};
              $.post(url,param,function(data){
                  layer.msg(data.msg,{icon:1});
              },"json");

          }, function(){
              layer.msg('已取消',{time : 1000,});
          });
      }

        $(document).ready(function(){

            $(':text,textarea').change(function(){
                var v = $(this).val();
                var id = $(this).data('id');
               set_config(v,id);
            });

            $(':radio').click(function(){
                var v = $(this).val();
                var id = $(this).data('id');

                set_config(v,id);
            });


        });
    </script>

</head>
<body>

<div class="panel admin-panel">
  <div class="panel-head" id="panel-head">
      <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
    <strong <?php if($i == '1'): ?>class="cur"<?php endif; ?>><?php echo $jun; ?></strong>
      <?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <div id="panelM">
      <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
    <div class="body-content">
      <form method="post" class="form-x" action="">

      <?php if(is_array($jun) || $jun instanceof \think\Collection || $jun instanceof \think\Paginator): $i = 0; $__LIST__ = $jun;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$junjun): $mod = ($i % 2 );++$i;?>
        <div class="form-group">
          <div class="label">
            <label><?php echo $junjun['name']; ?>：</label>
          </div>
          <div class="field">
              <?php switch($junjun['type']): case "text": ?>
              <input type="text" class="input" data-id="<?php echo $junjun['id']; ?>" value="<?php echo $junjun['value']; ?>" />
              <?php break; case "area": ?>
              <textarea class="input" data-id="<?php echo $junjun['id']; ?>"><?php echo $junjun['value']; ?></textarea>
              <?php break; case "image": ?>
              <input type="text"  id="url1" class="input tips" style="width:25%; float:left;" value="<?php echo $junjun['value']; ?>" data-id="<?php echo $junjun['id']; ?>" data-toggle="hover" data-place="right" data-image="<?php echo $junjun['value']; ?>"  />
              <input type="button" class="button bg-blue margin-left" onclick="$('#input_img').click()"  value="+ 浏览上传" >
              <input type="file" style="display:none" id="input_img" name="img" >
                 <script>

                  $("#input_img").change(function(){

                      var id = $('#url1').data('id');
                      var url = "/admin/platform/get_img.html";
                      var dataobj = $(this)[0].files;
                      var formdata =new FormData();
                      formdata.append("imgfile",dataobj[0]);
                      $.ajax({
                          url : url,
                          type : 'post',
                          data : formdata,
                          cache : false,
                          contentType : false,
                          processData : false,
                          dataType : "html",
                          success : function(res){
                              $("#url1").val(res);
                              $('.tips').attr('data-image',res);
                              set_config(res,id);

                          }

                      });

                  });

                </script>
              <?php break; case "radio": ?>
             <label class="jun"> <input type="radio"  name="<?php echo $junjun['id']; ?>" data-id="<?php echo $junjun['id']; ?>"  <?php if($junjun['value'] == '1'): ?>checked="checked"<?php endif; ?> value="1" />开启</label>
             <label class="jun"> <input type="radio" name="<?php echo $junjun['id']; ?>"  data-id="<?php echo $junjun['id']; ?>"  <?php if($junjun['value'] == '-1'): ?>checked="checked"<?php endif; ?> value="-1" />关闭</label>
              <?php break; default: ?>default

              <?php endswitch; ?>
            <div class="tips"></div>
          </div>
        </div>
       <?php endforeach; endif; else: echo "" ;endif; ?>

      </form>
    </div>
      <?php endforeach; endif; else: echo "" ;endif; ?>

  </div>
</div>

</body>
</html>