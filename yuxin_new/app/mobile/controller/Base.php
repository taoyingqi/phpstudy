<?php
namespace app\mobile\controller;

use think\Controller;
use think\Db;
// use think\Route;
/**
 * 基础类
 */
class Base extends Controller {

	function __construct() {
		parent::__construct();
		// 给User控制器设置快捷路由
		// Route::controller('mobile','mobile/Index');
//		if(isset($_SESSION['user']))
//		{
//			$this->user = $_SESSION['user'];
//			// $this->user = Db::name('user')->where('id',$_SESSION['user']['id'])->find();
//		}else{
//			$this->user = array();
//		}
//
//		$this->assign('user',$this->user);

		$seo1 = Db::name('config')->where('cate','SEO')->select();
		$web1  = Db::name('config')->where('cate','网站')->select();
		$seo = $web = array();
		foreach($seo1 as $v)
		{
			$seo[$v['key']] = $v['value'];
		}

		// j($seo);
		foreach($web1 as $v)
		{
			$web[$v['key']] = $v['value'];
		}
		$this->assign('seo',$seo);
		$this->assign('web',$web);

	}

	public function send_user_sms($tel,$username='')
	{
       $tpl = "SMS_133115002";
		$arr = array(
			'mtname' => $username,
		    'submittime' => time(),
		);
	  $rs =	\app\home\controller\Sms::sendSms1($tel,$tpl,$arr);

	}

	public function send_admin_sms($tel)
	{
		$tpl = "SMS_132970214";
		$arr = array(
			'status' => '有人注册',
			'remark' => date('Y-m-d'),
		);
		$rs = \app\home\controller\Sms::sendSms1($tel,$tpl,$arr);
	}


	protected function is_login()
	{
		// j($_SESSION);
		if(isset($_SESSION['user']))
		{
			return true;
		}else{
			return $this->redirect('/home/user/login');die;
		}
	}

	/*站点基本配置*/
	public function base_config() {
		$base_config = [];

		/*配置在数据库中的*/

		$db_config = [];
		$db_config = Db::name('config')->select();
		/* 临时生成的 默认值*/

		$default_config = [];
		$db_config = array_merge($db_config, $default_config);

		return $base_config;

	} /*end of base_config*/
}