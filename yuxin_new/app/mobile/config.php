<?php

return [

	'template' => [
		// 模板引擎类型 支持 php think 支持扩展
		'type' => 'Think',
		// 模板路径
		'view_path' => ROOT_PATH . 'theme/mobile_view/template/',
		// 模板后缀
		'view_suffix' => 'html',
		// 模板文件名分隔符
		'view_depr' => DS,
		// 模板引擎普通标签开始标记
		'tpl_begin' => '{',
		// 模板引擎普通标签结束标记
		'tpl_end' => '}',
		// 标签库标签开始标记
		'taglib_begin' => '{',
		// 标签库标签结束标记
		'taglib_end' => '}',
	],
	
	
	// 默认模块名
	'default_module' => 'mobile',
	// 禁止访问模块
	'deny_module_list' => ['common'],
	// 默认控制器名
	'default_controller' => 'Index',
	// 默认操作名
	'default_action' => 'reg',

	//默认错误跳转对应的模板文件
	'dispatch_error_tmpl' => ROOT_PATH.'theme/mobile_view/template/public/tip.html',
	//默认成功跳转对应的模板文件
	'dispatch_success_tmpl' => ROOT_PATH.'theme/mobile_view/template/public/tip.html',

	// 视图输出字符串内容替换
	'view_replace_str' => [
		// '__url__' => "http://".$_SERVER['SERVER_NAME'],
		'__url__' => "",
		'__upload__' => '/public/upload',
		'__common__' => '/public/common',
		'__plugin__' => '/public/plugin',
		'__noimg__' => '/public/common/img/empty_img.jpg',
		'__pcstatic__' => '/public/static/home',
		'__static__' => '/public/static/mobile',
	],


];

