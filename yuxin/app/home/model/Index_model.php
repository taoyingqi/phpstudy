<?php
namespace app\home\model;

use think\Config;
use think\Db;
use think\Request;

/**
 *  专门组织首页数据的模块
 */
class Index_model {

	protected $request;
	protected $config;
	protected $db;
	protected $main_field;

	function __construct() {

		$this->request = Request::instance();
		$this->config = Config::get();
		$this->db = new Db();
		$this->main_field = ['id', 'plat_img', 'nickname', 'plat_income', 'invest_time_limit', 'first_money', 'rebate_rule', 'risk_level'];

	} /*__construct*/

	/*首页获取站点信息*/
	public function index() {

		$data = [];
		/* index_info  站点信息 */
		//$data['info'] = $this->index_info();

		/* index_top  头部 公告*/
		//$data['top'] = $this->index_top();

		/* index_rotate 轮播图片 */
		$data['rotate'] = $this->index_rotate();

		/* index_hot 大分类 热门 推荐 */
		$data['hot'] = $this->index_hot();

		/* index_main 大分类 高收益 */
		$data['main1'] = $this->index_main();

		/* index_main 大分类 精选*/
		$data['main2'] = $this->index_main();

		/* index_list 大分类  列表显示*/
		$data['list'] = $this->index_list();

		/* index_partner 合作平台 */
		$data['partner'] = $this->index_partner();

		/* index_link 友情链接*/
		$data['link'] = $this->index_link();

		/* index_bottom 页面底部*/
		//$data['bottom'] = $this->index_bottom();

		/*返回数组 */
		$data['code'] = 222;

		return $data;

	} /*index*/

	/* index_rotate 轮播图片 */
	private function index_rotate() {

		$image1 = [
			'img_url' => 'http://www.xinyangyp.com/data/img/160923/57e4951c43eea.jpg',
			'href_url' => "http://www.xinyangyp.com/search/礼包.html",
			'alt' => '礼包',
		];

		$image2 = [
			'img_url' => 'http://www.xinyangyp.com/data/img/160923/57e4952c548a6.jpg',
			'href_url' => "http://www.xinyangyp.com/search/代金券.html",
			'alt' => '代金券',
		];

		return [$image1, $image2];

	} /*end of index_rotate*/

	/* index_hot 大分类 热门 推荐 */
	private function index_hot() {

		$hot = Db::name('platform')->field($this->main_field)->where('status', 1)->select();

		return $hot;

	} /*end of index_hot*/

	/* index_main 大分类 图片格子显示 */
	private function index_main() {

		$main1 = Db::name('platform')->field($this->main_field)->where('status', 1)->select();

		return $main1;

	} /*end of index_main*/

	/* index_list 大分类  列表显示*/
	private function index_list() {

		$list = Db::name('platform')->field($this->main_field)->where('status', 1)->select();

		/*参与人数*/
		foreach ($list as $key => $value) {
			$list[$key]['part_num'] = 100;
		}

		return $list;

	} /*end of index_list*/

	/* index_partner 合作平台 */
	private function index_partner() {

		$links = Db::name('platform')->field(['id', 'plat_img', 'plat_income'])->where('status', 1)->select();
		return $links;

	} /* end of index_partner*/

	/* index_link 友情链接*/
	private function index_link() {

		$links = Db::name('platform')->field(['id', 'nickname', 'plat_url'])->where('status', 1)->select();
		return $links;

	} /*end of index_link*/

} /*end of class Index_model*/