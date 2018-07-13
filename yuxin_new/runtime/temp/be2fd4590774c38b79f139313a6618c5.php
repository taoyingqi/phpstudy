<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/link\show_article_list.html";i:1524534434;s:66:"E:\phpstudy\WWW\yuxin_new\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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

<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 文章列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
          <li><input type="checkbox" id="checkall"/>
              全选 </li>
        <li> <a class="button border-main icon-plus-square-o" href="add_article.html"> 添加内容</a> </li>
        <li>搜索：</li>
        <!--<li>-->
          <!--<select name="type" class="input" onchange="changesearch();"  id="typeid" style="width:80px; line-height:17px;display:inline-block">-->
            <!--<option value="">选择类型</option>-->
            <!--<option value="article">文章</option>-->
            <!--<option value="link">链接</option>-->
          <!--</select>-->
        <!--</li>-->
          <li>
            <select name="cate" class="input" size="1" style="width:150px; line-height:17px;" id="cateid" onchange="changesearch()">
              <option value="">——选择分类——</option>
                <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
              <option value="<?php echo $jun['id']; ?>"><?php echo $jun['cate_name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" id="keyid" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="changesearch();" > 搜索</a></li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th width="10%">排序</th>
        <th>图片</th>
        <th>文章标题</th>
        <th>链接地址</th>
        <th>点击量</th>
        <th>显示</th>
        <th width="10%">所属分类</th>
        <th width="310">操作</th>
      </tr>
      <tbody id="ajaxid">

        </tbody>
    </table>
  </div>
</form>

<script>
    $(document).on('click','.pagination li',function(e){
        e.preventDefault();
        var url = $(this).find('a').eq(0).attr('href');
        //  alert(url); return false;
        $.get(url,function(data){
            $("#ajaxid").html(data);
        },"html");


    });
</script>

<script type="text/javascript">

   edit_article = function(id){
         layer.open({
             type: 2,
             title: '修改文章',
             shadeClose: true,
             shade: 0.6,
             area: ['90%', '90%'],
             content: '/admin/link/edit_article.html?id='+id, //iframe的url
         });


    }


//搜索
function changesearch(){

      var cate = $('#cateid').val();
     var key = $('#keyid').val();

  //  alert(cate);

   // if(cate || key )

        url = "/admin/link/ajax_article_list.html";
        param = {'cate_id':cate,'title':key};

        $.ajax({
            type: "POST",
            url: url,
            data:param,// 序列化表单值
            async: false,
            dataType : "html",
            error: function(request) {
                alert("Connection error");
            },
            success: function(data) {
                //window.location.href="跳转页面"
                $("#ajaxid").html(data);
            }
        });

}

   $(document).ready(function(){

       //列表初始化
       var init = function(){
        // var url = "/admin/link/ajax_article_list.html";
           $.get("/admin/link/ajax_article_list.html?data={}",function(data){
               $("#ajaxid").html(data);
           },"html");
       }();


   });


//单个删除
function del(obj,id){
    var o = $(obj);

    layer.confirm('您确定要删除吗？', {
        btn: ['确定','取消'] //按钮
    }, function(){

        var url = '/admin/link/del_article.html?id='+id;
        $.getJSON(url,function(data){

             if(data.status == 1)
             {
                 layer.msg(data.msg,{icon:1});
                 o.closest('tr').hide();
             }
            else
             {
                 layer.mag(data.msg,{icon:5});
             }

        });
    }, function(){
    });

}

//全选
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

//批量删除
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
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>

</body>
</html>