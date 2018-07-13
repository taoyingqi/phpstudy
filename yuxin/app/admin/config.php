<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10 0010
 * Time: 11:58
 */

return [

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => ROOT_PATH.'theme/admin_view/template/',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [
       // '__url__'    => "http://".$_SERVER['SERVER_NAME'],
        '__url__'    => "",
        '__upload__' => '/public/upload',
        '__common__' => '/public/common',
        '__plugin__' => '/public/plugin',
        '__noimg__'  => '/public/common/img/empty_img.jpg',
        '__static__' => '/public/static/admin/static' ,
    ],

];