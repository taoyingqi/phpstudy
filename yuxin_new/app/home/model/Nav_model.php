<?php
namespace app\home\model;

use think\Config;
use think\Db;
use think\Request;

/**
 *  专门组织首页数据的模块
 */
class Nav_model {

	protected $request;
	protected $config;
	protected $db;
	protected $link_field;
	protected $article_field;

	function __construct() {

		$this->request = Request::instance();
		$this->config = Config::get();
		$this->db = new Db();
		$this->link_field = ['id', 'name', 'icon', 'url'];
		$this->article_field = ['id', 'title', 'url'];

	} /*__construct*/

	/*首页获取站点信息*/
	public function index() {

		/*返回数组 */
		$data['code'] = 222;

		/* 导航条  首页 后面的*/
		$data['bar'] = $this->nav_bar();

		/*热门导航  首页 下一行 */
		$data['hot'] = $this->nav_hot();

		/* 用户自定义全部选项 */
		$data['custom_all'] = $this->nav_custom_default();

		/* 用户自定义 设置 */
		$data['custom_set'] = $this->nav_custom_set();

		/* 分类导航  大循环*/
		$data['cates'] = $this->nav_cates();

		/*侧边文章推荐 大循环*/
		$data['news'] = $this->nav_news();

		/* nav_partner 合作平台 */
		$data['partner'] = $this->nav_partner();

		/* nav_bottom 页面底部 二维码图片*/
		$data['bottom'] = $this->nav_bottom();

		return $data;

	} /*index*/

	private function nav_bar() {
		$data = Db::name('news_link')->field($this->link_field)->select();
		return $data;
	} /*end of nav_bar*/

	/* nav_hot   */
	private function nav_hot() {

		$data = Db::name('news_link')->field($this->link_field)->select();
		return $data;

	} /*end of nav_hot*/

	/* nav_custom_default   */
	private function nav_custom_default() {

		$data = Db::name('news_link')->field($this->link_field)->select();
		return $data;

	} /*end of nav_custom_default*/

	/* nav_custom_set   */
	private function nav_custom_set() {

		$data = Db::name('news_link')->field($this->link_field)->limit(10)->select();
		return $data;

	} /*end of nav_custom_set*/

	/* nav_custom_set   */
	private function nav_cates() {

		$ret = [];
		for ($i = 0; $i < 15; $i++) {
			$ret[] = Db::name('news_link')->field($this->link_field)->order('rand()')->limit('10')->select();
		}

		return $ret;

	} /*end of nav_hot*/

	/* nav_news  左侧文章列表 */
	private function nav_news() {
		/*三个文章分类*/
		$cates = Db::name('news_cate')->field(['id', 'cate_name'])->where('display_mode', 'article')->limit(3)->order('sort')->select();

		$datas = [];

		foreach ($cates as $key => $value) {
			$data = Db::name('news_article')->field($this->article_field)->where('cate_id',$value['id'])->select();

			foreach ($data as $key => $value) {
				if (empty($value['url'])) {
					/*文章链接不存在时 链接为 金融推广页面*/
					$data[$key]['url'] = '/jinrong.html';
				}
			}
			$datas[] = $data;
		}

		return $datas;

	} /*end of nav_news*/

	/* nav_partner   */
	private function nav_partner() {

		$data = Db::name('platform')->field(['id', 'plat_img', 'plat_income'])->where('status', 1)->select();
		return $data;

	} /*end of nav_partner*/

	private function nav_bottom() {
		$image1 = [
			'img_url' => 'http://www.xinyangyp.com/data/img/160923/57e4951c43eea.jpg',
			'href_url' => "http://www.xinyangyp.com/search/礼包.html",
			'title' => '安卓',
		];

		$image2 = [
			'img_url' => 'http://www.xinyangyp.com/data/img/160923/57e4952c548a6.jpg',
			'href_url' => "http://www.xinyangyp.com/search/代金券.html",
			'title' => 'iOS',
		];

		return [$image1, $image2];

	} /*end of nav_bottom*/

} /*end of class nav_model*/