<?php

namespace app\home\lib;

use AlibabaAliqinFcSmsNumSendRequest;
use think\Db;
use TopClient;

/**
 * 手机类
 */
class Mobile {

	protected $app_key;
	protected $app_secret;

	function __construct() {
		$ret = $this->alidayu_config();
		include_once ROOT_PATH . 'extend' . DS . 'alidayu' . DS . 'TopSdk.php';

	}

	/*构造函数调用 读取配置信息*/
	private function alidayu_config() {

		date_default_timezone_set('Asia/Shanghai');
		$this->app_key = Db::name('config')->where('key', 'alidayu_app_key')->value('value');
		$this->app_secret = Db::name('config')->where('key', 'alidayu_app_secret')->value('value');

	} /*alidayu_config*/

	/*发送短信编码*/
	public function send_code($sms_mobile) {

		$sms_format = $mobile_code = $sms_msg = "";

		$sms_format = 'SMS_12921282';
		$sms_msg = '积分店会员';
		$_SESSION['member']['mobile'] = $sms_mobile;
		$_SESSION['member']['mobile_code'] = $mobile_code = mt_rand(10000, 99999);
		$param = json_encode(['code' => $mobile_code . '', 'product' => $sms_msg]);

		$req = new AlibabaAliqinFcSmsNumSendRequest();
		$req->setExtend("积分店");
		$req->setSmsType("normal");
		$req->setSmsFreeSignName("身份验证");
		$req->setSmsParam($param);
		$req->setRecNum($sms_mobile);
		$req->setSmsTemplateCode($sms_format);

		$c = new TopClient;
		$c->appkey = $this->app_key;
		$c->secretKey = $this->app_secret;

		$res = $c->execute($req);

		$result = $res->result;

		if ($result->err_code == 0 && $result->success == true) {
			success_json('短信发送成功，请查收！');
		} elseif ($res->code > 0) {
			fail_json((string) $res->sub_msg);
		} else {
			fail_json('短信发送失败');
		}

	} /*end of send_mobile_code*/

} /*end of class*/