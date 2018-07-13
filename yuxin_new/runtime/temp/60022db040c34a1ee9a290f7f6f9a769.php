<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\test_www\yuxin\theme/admin_view/template/link\show_news_cate.html";i:1488939393;s:58:"D:\test_www\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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
  <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
  <div class="padding border-bottom">  
  <a class="button border-yellow" href="#form"><span class="icon-plus-square-o"></span> 添加内容</a>
  </div> 
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>     
      <th>分类名称</th>
      <th>分类位置</th>
      <th>排序</th>     
      <th width="250">操作</th>
    </tr>

   <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
    <tr>
      <td><?php echo $jun['id']; ?></td>
      <td><?php echo $jun['cate_name']; ?></td>
      <td><?php echo $jun['display_position']; ?></td>
        <td><?php echo $jun['sort']; ?></td>
      <td>
      <div class="button-group">
      <a type="button" class="button border-main" href="javascript:" onclick="edit_cate(<?php echo $jun['id']; ?>)"><span class="icon-edit"></span>修改</a>
       <a class="button border-red" href="javascript:void(0)" onclick="return del(this,<?php echo $jun['id']; ?>)"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>

  </table>
</div>
<script>

    function edit_cate(id)
    {
        layer.open({
            type: 2,
            title: '编辑链接分类',
            shadeClose: true,
            shade: 0.8,
            area: ['70%','70%'],
            content: '/admin/link/edit_news_cate.html?id='+id //iframe的url
        });
    }


function del(obj,id){

      var o = $(obj);
    layer.confirm('您确定要删除吗？', {
        btn: ['确定','取消'] //按钮
    }, function(){
          var url = "/admin/link/del_news_cate?id="+id;
        $.getJSON(url,function(data){
            if(data.status == 1)
            {
            layer.msg(data.msg, {icon: 1});
            o.closest('tr').hide();
            }
            else
            {
              layer.msg(data.msg, {icon: 5});
            }
        });

    }, function(){

    });

}
</script>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span><?php if(empty($link) || (($link instanceof \think\Collection || $link instanceof \think\Paginator ) && $link->isEmpty())): ?>增加文章分类<?php else: ?>增加链接分类<?php endif; ?></strong></div>
  <div class="body-content">
    <form method="post" class="form-x" id="form" action="">
      <input type="hidden" name="id"  value="" />  
      <div class="form-group">
        <div class="label">
          <label>分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="cate_name" value="" data-validate="required:请输入分类名称" />
          <div class="tips"></div>
        </div>
      </div>

        <!--<div class="form-group">-->
            <!--<div class="label">-->
                <!--<label>分类类型：</label>-->
            <!--</div>-->
            <!--<div class="field">-->
                <!--<select name="display_mode" class="input w50">-->
                    <!--<option value="link">新闻链接</option>-->
                    <!--<option value="article">新闻文章</option>-->
                <!--</select>-->
                <!--<div class="tips" title=""></div>-->
            <!--</div>-->
        <!--</div>-->

      <div class="form-group">
        <div class="label">
          <label>显示位置说明 ：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input w50" name="display_position" style="height:100px;" ></textarea>
        </div>
     </div>

      <div class="form-group">
        <div class="label">
          <label>手动排序：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value=""  data-validate="required:,number:排序必须为数字" />
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
            <?php if(!(empty($link) || (($link instanceof \think\Collection || $link instanceof \think\Paginator ) && $link->isEmpty()))): ?>
              <input type="hidden" name="type" value="link">
            <?php endif; ?>
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
            <input type="hidden" id="submit_url" value="/admin/link/add_news_cate.html">
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>