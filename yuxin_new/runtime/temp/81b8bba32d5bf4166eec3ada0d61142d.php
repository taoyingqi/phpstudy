<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/link\edit_article.html";i:1524535208;s:62:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/base\base.html";i:1487325450;}*/ ?>
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

            <div class="form-group check-error" id="cate_form">
                <div class="label">
                    <label>链接分类：</label>
                </div>
                <div class="field">
                    <select name="cate_id" class="input w50" data-validate="required:请选择分类" id="sel">
                        <option value="">请选择链接分类</option>
                        <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $jun['id']; ?>" <?php if($list['cate_id'] == $jun['id']): ?>selected="selected"<?php endif; ?>><?php echo $jun['cate_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="tips" title=""></div>
                    <div class="input-help"><ul><li>请选择链接分类</li></ul></div></div>
            </div>

            <script>

                //init时如果有选择分类不提示
                $(document).ready(function(){

                    selobj = document.getElementById('sel');

                    var opt = selobj.options;
                    var num = selobj.selectedIndex;
                    if(opt[num].value)
                    {
                        $('#cate_form').removeClass('check-error');
                        $('.input-help').hide();
                    }

                });

            </script>

            <div class="form-group">
                <div class="label">
                    <label>文章标题：</label>
                </div>
                <div class="field">
                    <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                    <input type="text" class="input" name="title" value="<?php echo $list['title']; ?>" data-validate="required:请输入标题">
                    <div class="tips" title=""></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>文章图片：</label>
                </div>
                <div class="field">
                    <input type="text" id="url1" name="img" class="input tips" style="width:25%; float:left;" value="<?php echo $list['img']; ?>" data-toggle="hover" data-place="right" data-image="<?php echo $list['img']; ?>" title="">
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
                    <textarea class="input"  id="areaid" style=" height:150px;display:none"><?php echo $list['text']; ?></textarea>
                    <script id="editor"  name="text" type="text/plain" style="width:1024px;height:500px;"></script>
                    <div class="tips" title=""></div>
                </div>
            </div>
            <script>
                var ue = UE.getEditor('editor');
                //对编辑器的操作最好在编辑器ready之后再做
                ue.ready(function() {
                    //设置编辑器的内容
                    var html = $('#areaid').text();
                    ue.setContent(html);
                    //获取html内容，返回: <p>hello</p>
                 //   var html = ue.getContent();
                    //获取纯文本内容，返回: hello
                //    var txt = ue.getContentTxt();
                });
            </script>

            <div class="form-group">
                <div class="label">
                    <label>文章链接地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="url" value="<?php echo $list['url']; ?>" >
                    <div class="tips" title=""></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>是否显示：</label>
                </div>
                <div class="field">
                    <div class="button-group radio">

                        <label <?php if($list['display'] == 'Y'): ?>class="button active"<?php else: ?>class="button"<?php endif; ?>>
                            <span class="icon icon-check"></span>
                            <input name="display" value="1" type="radio" <?php if($list['display'] == 'Y'): ?>checked="checked"<?php endif; ?>>是
                        </label>

                        <label <?php if($list['display'] == 'N'): ?>class="button active"<?php else: ?>class="button"<?php endif; ?>>
                            <span class="icon icon-times icon-check"></span>
                            <input name="display" value="0" type="radio" <?php if($list['display'] == 'N'): ?>checked="checked"<?php endif; ?>>否
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>排序：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="sort" value="<?php echo $list['sort']; ?>" data-validate="required:,number:排序必须为数字">
                    <div class="tips" title=""></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <input type="hidden" id="submit_url" value="/admin/link/do_edit_article.html">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>


</body>
</html>