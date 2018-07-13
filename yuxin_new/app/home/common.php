<?php
function j($value = '') {
	echo "<pre>";
	print_r($value);exit;
}

function d($value = '') {
	echo "<pre>";
	var_dump($value);exit;
}

/*返回json字符串*/
function die_json($a = []) {
	die(json_encode($a));
}

/*失败的json消息数据*/
function fail_json($msg = '空消息') {
	die(json_encode(['code' => '444', 'msg' => $msg]));
}

/*成功的json消息数据*/
function success_json($msg = '空消息') {
	die(json_encode(['code' => '222', 'msg' => $msg]));
}