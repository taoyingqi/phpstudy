<?php
namespace app\home\model;

use think\Db;

/**
 * 平台页面信息 控制器
 */
class Section_model {

	/*推荐平台*/
	public function promote_plat() {

		$promote = Db::name('platform')->field([
			'id',
			'plat_img',
			'nickname',
			'risk_level',
			'plat_income',
		])->where('status', 1)->select();
		return $promote;
	} /*end of promote_plat*/

	/*最新提现*/
	public function user_recent_cash() {

		$arr = [];

		for ($i = 0; $i < 5; $i++) {
			$arr[] = '187****5228 刚刚提现200元！';
			$arr[] = '180****8998 刚刚提现200元！！';
			$arr[] = '181****7878 刚刚提现200元！！';
		}
		return $arr;
	} /*end of user_recent_cash*/

} /*end of class platform*/