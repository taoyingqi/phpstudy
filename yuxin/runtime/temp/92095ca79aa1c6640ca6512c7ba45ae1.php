<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\phpstudy\WWW\yuxin\theme/admin_view/template/link\ajax_article_list.html";i:1489046224;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jun): $mod = ($i % 2 );++$i;?>
<tr>
    <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value="" /><?php echo $jun['id']; ?></td>
    <td><input type="text" name="sort[1]" value="<?php echo $jun['sort']; ?>" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td>
    <td width="10%"><img src="<?php echo $jun['img']; ?>" alt="" width="70" height="50" /></td>
    <td>
        <p><?php echo $jun['title']; ?></p>
    </td>
    <td><p style="color:#00CC99"><?php echo $jun['url']; ?></p></td>
    <td><?php echo $jun['hits']; ?></td>
    <td><?php echo $jun['display']; ?></td>
    <td><?php echo $jun['cate_name']; ?></td>
    <td><div class="button-group"> <a class="button border-main" href="javascript:" onclick="edit_article(<?php echo $jun['id']; ?>)"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="javascript:void(0)" onclick="return del(this,<?php echo $jun['id']; ?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; ?>

<tr>
    <td colspan="8"><div class="pagelist"> <?php echo $page; ?></div></td>
</tr>