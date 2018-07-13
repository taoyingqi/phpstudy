<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\test_www\yuxin\theme/admin_view/template/user\show_user_list.html";i:1524479850;s:58:"D:\test_www\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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

<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 用户管理</strong></div>
      <div class="padding border-bottom">
          <ul class="search" style="padding-left:10px;">
              <li> <a class="button border-main icon-plus-square-o" href="#"> 添加内容</a> </li>
              <!--<li>搜索：</li>-->

              <!--<li>首页-->
                  <!--<select name="s_ishome" class="input" onchange="changesearch()" style="width:60px; line-height:17px; display:inline-block">-->
                      <!--<option value="">选择</option>-->
                      <!--<option value="1">是</option>-->
                      <!--<option value="0">否</option>-->
                  <!--</select>-->
                  <!--&nbsp;&nbsp;-->
                  <!--推荐-->
                  <!--<select name="s_isvouch" class="input" onchange="changesearch()"  style="width:60px; line-height:17px;display:inline-block">-->
                      <!--<option value="">选择</option>-->
                      <!--<option value="1">是</option>-->
                      <!--<option value="0">否</option>-->
                  <!--</select>-->
                  <!--&nbsp;&nbsp;-->
                  <!--置顶-->
                  <!--<select name="s_istop" class="input" onchange="changesearch()"  style="width:60px; line-height:17px;display:inline-block">-->
                      <!--<option value="">选择</option>-->
                      <!--<option value="1">是</option>-->
                      <!--<option value="0">否</option>-->
                  <!--</select>-->
              <!--</li>-->

              <!--<if condition="$iscid eq 1">-->
                  <!--<li>-->
                      <!--<select name="cid" class="input" style="width:200px; line-height:17px;" onchange="changesearch(this)">-->
                          <!--<option value="">请选择分类</option>-->

                      <!--</select>-->
                  <!--</li>-->
              <!--</if>-->
              <li>
                  <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
                  <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch()" > 搜索</a></li>
          </ul>
      </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>姓名</th>
        <th >手机</th>
          <th>密码</th>
         <th width="120">注册时间</th>
        <!--<th>操作</th>       -->
      </tr>
          <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
        <tr>
          <td><input type="checkbox" name="id[]" value="<?php echo $jun['id']; ?>" /><?php echo $jun['id']; ?></td>
          <td><?php echo $jun['username']; ?></td>
          <td><?php echo $jun['mobile']; ?></td>
          <td><?php echo $jun['password']; ?></td>
          <td><?php echo $jun['adtime']; ?></td>
          <!--<td>-->
              <!--<?php if($jun['status'] == 1): ?>-->
              <!--<div class="button-group"> <a class="button border-main" href="javascript:void(0)" onclick="return off(this,<?php echo $jun['id']; ?>)"><span class="icon-drupal"></span> 已启用 </a> </div>-->
              <!--<?php else: ?>-->
              <!--<div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return on(this,<?php echo $jun['id']; ?>)"><span class="icon-drupal"></span> 已禁用 </a> </div>-->
              <!--<?php endif; ?>-->
          <!--</td>-->
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
      <tr>
        <td colspan="8"><div class="pagelist"> <?php echo $page; ?> </div></td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

function off(obj,id){

    layer.confirm('您确定要禁用吗？', {
        btn: ['确定','算了'] //按钮
    }, function(){
        var o = $(obj);
        var url = "/admin/user/ch_user_status.html?type=0&id="+id;
        $.get(url,function(res){
            if(res){
                o.closest('tr').find('td').eq(2).text('禁用');
                o.removeClass('border-red').addClass('border-red').attr('onclick','return on(this,<?php echo $jun['id']; ?>)').html('<span class="icon-vk"></span> 已禁用');

                layer.msg('禁用成功', {icon: 1});

            }
        });


    }, function(){});
}

function on(obj,id){

    layer.confirm('您确定要启用吗？', {
        btn: ['确定','算了'] //按钮
    }, function(){
        var o = $(obj);
        var url = "/admin/user/ch_user_status.html?type=1&id="+id;
        $.get(url,function(res){
            if(res){
                o.closest('tr').find('td').eq(2).text('正常');
                o.removeClass('border-main').addClass('border-red').attr('onclick','return off(this,<?php echo $jun['id']; ?>)').html('<span class="icon-drupal"></span> 禁用');
                layer.msg('启用成功', {icon: 1});

            }
        });


    }, function(){});
}

$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false; 		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

</script>

</body>
</html>