<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/admin\show_admin.html";i:1487917454;s:62:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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
    <div class="panel-head"><strong class="icon-reorder"> 管理员列表</strong></div>
    <div class="padding border-bottom">
        <a class="button border-yellow" href=""><span class="icon-plus-square-o"></span> 添加内容</a>
    </div>
    <table class="table table-hover text-center">
        <tr>
            <th width="5%">ID</th>
            <th>名称</th>
            <th>头像</th>
            <th>权限组</th>
            <th>登陆时间</th>
            <th width="250">操作</th>
        </tr>
        <?php if(is_array($admin) || $admin instanceof \think\Collection || $admin instanceof \think\Paginator): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $jun['id']; ?></td>
            <td><?php echo $jun['name']; ?></td>
            <td><img style="height:60px" src="<?php echo $jun['img']; ?>"></td>
            <td><?php echo $jun['group_name']; ?></td>
            <td><?php echo date("Y-m-d H:i:s",$jun['login_time']); ?></td>
            <td>
                <div class="button-group">
                    <a type="button" class="button border-main" href="javascript:void(0)" data-href="/admin/admin/edit_admin.html?id=<?php echo $jun['id']; ?>" onclick="edit_admin(<?php echo $jun['id']; ?>)"><span class="icon-edit"></span>修改</a>
                    <a class="button border-red" href="javascript:void(0)" onclick="return del(this,<?php echo $jun['id']; ?>)"><span class="icon-trash-o"></span> 删除</a>
                </div>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </table>
</div>
<script>
    function edit_admin(id)
    {
        layer.open({
            type: 2,
            title: '修改管理员',
            shadeClose: true,
            shade: 0.8,
            area: ['70%', '70%'],
            content: '/admin/admin/edit_admin.html?id='+id //iframe的url
        });
    }


    function del(obj,id){

        var o = $(obj);
        layer.confirm('您确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var url = "/admin/admin/del_admin.html?id="+id;
            $.getJSON(url,function(data){
                if(data.status == 1)
                {
                    layer.msg(data.msg);
                    o.closest('tr').remove();
                }
                else{
                    layer.msg(data.msg,function(){});
                }
            });

        }, function(){
            layer.msg('你说取消就取消啊？等20秒', {
                time: 20000, //20s后自动关闭
                // btn: ['明白了', '知道了']
            });
        });

    }
</script>
<div class="panel admin-panel margin-top">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加管理员</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">
            <div class="form-group">
                <div class="label">
                    <label>名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="name" value="" data-validate="required:请输入名称" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>管理员头像：</label>
                </div>
                <div class="field">
                    <input type="text" id="url1" name="admin_img" class="input tips" style="width:25%; float:left;"  value="" data-toggle="hover" data-place="right" data-image="" />
                    <input type="button" class="button bg-blue margin-left" id="image1" onclick="return openfile()" value="+ 浏览上传"  style="float:left;">
                    <input type="file" style="display:none" id="img1">
                    <script>
                        function openfile()
                        {
                            $('#img1').click();
                        }

                        $("#img1").change(function(){

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
                                }

                            });

                        });

                    </script>
                    <div class="tipss">图片尺寸：1920*200</div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>密码：</label>
                </div>
                <div class="field">
                    <input type="password" class="input w50" name="password" value=""  data-validate="required:请输入密码" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>确定密码：</label>
                </div>
                <div class="field">
                    <input type="password" class="input w50"  value=""  data-validate="required:请输入确定密码,repeat#password:两次密码输入不一致" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>所属权限组：</label>
                </div>
                <div class="field">
                    <select name="gid" class="input w50">
                        <option value="">请选择分类</option>
                        <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $jun['id']; ?>"><?php echo $jun['group_name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="tips" title=""></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                    <input type="hidden" id="submit_url" value="/admin/admin/add_admin.html">
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>