<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/link\add_article.html";i:1523674567;s:62:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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

    
<script type="text/javascript" charset="utf-8" src="__static__/js/laydate/laydate.js"></script>
<script type="text/javascript" charset="utf-8" src="__static__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__static__/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__static__/ueditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>


<div class="panel admin-panel margin-top">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加链接</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">

            <div class="form-group check-error">
                <div class="label">
                    <label>链接分类：</label>
                </div>
                <div class="field">
                    <select name="cate_id" class="input w50" data-validate="required:请选择分类">
                        <option value="">请选择链接分类</option>
                        <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $jun['id']; ?>"><?php echo $jun['cate_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="tips" title=""></div>
                    <div class="input-help"><ul><li>请选择链接分类</li></ul></div></div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>文章标题：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="title" value="" data-validate="required:请输入标题">
                    <div class="tips" title=""></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>文章图片：</label>
                </div>
                <div class="field">
                    <input type="text" id="url1" name="img" class="input tips" style="width:25%; float:left;" value="" data-toggle="hover" data-place="right" data-image="" title="">
                    <input type="button" class="button bg-blue margin-left" id="image1" onclick="return openfile()" value="+ 浏览上传" style="float:left;">
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
                    <label>文章内容：</label>
                </div>
                <div class="field">
                    <!--<textarea class="input" name="text" style=" height:150px;"></textarea>-->
                    <script id="editor"  name="text" type="text/plain" style="width:1024px;height:500px;"></script>
                    <div class="tips" title=""></div>
                </div>
            </div>

            <script>

                var ue = UE.getEditor('editor');
            </script>

            <div class="form-group">
                <div class="label">
                    <label>文章链接地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="url" value="" >
                    <div class="tips" title=""></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>是否显示：</label>
                </div>
                <div class="field">
                    <div class="button-group radio">

                        <label class="button active">
                            <span class="icon icon-check"></span>
                            <input name="display" value="1" type="radio" checked="checked">是
                        </label>

                        <label class="button"><span class="icon icon-times"></span>
                            <input name="display" value="0" type="radio">否
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>排序：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="sort" value="0" data-validate="required:,number:排序必须为数字">
                    <div class="tips" title=""></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <input type="hidden" id="submit_url" value="/admin/link/do_add_article.html">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>


</body>
</html>