<?php
namespace app\home\controller;

use think\Db;
use think\Request;
use app\home\controller\Base;
/**
 * 会员控制器
 */
class Index extends Base {

	protected $request;

	function __construct() {

		parent::__construct();

		$this->request = Request::instance();
	}


	public function jun(Request $request) {
		// r($request->param());
		// echo 1;die;
		//$jun = '15806062633';
		//$this->send_admin_sms($jun);
		
		// echo 1;die;
	}

	public function index() {

       //新闻
		$news = Db::name('news_article')->where('cate_id',24)->order('update_time','desc')->limit(0,11)->select();

		//解读
		$news1 = Db::name('news_article')->where('cate_id',25)->order('update_time','desc')->limit(0,9)->select();

		$this->assign('news',$news);
		$this->assign('news1',$news1);

		return $this->fetch();
	}

	//公司信息
	public function company_info()
	{
		$info = Db::name('news_article')->where('cate_id',9)->find();
		$this->assign('info',$info);
		return $this->fetch();
	}

	//软件下载
	public function download() {

		//新闻列表
		$new_list = Db::name('news_article')->where('display','Y')->order('add_time','desc')->select();
       // r($new_list);
		$this->assign('new_list',$new_list);

		return $this->fetch();

	}

	//产品服务
	public function product() {

		$pro =  Db::name('news_article')->where('cate_id',23)->find();
		$this->assign('pro',$pro);

		return $this->fetch();

	}



	//开户注册
	public function reg() {

		return $this->fetch();

	}

	public function upload($file,$filename,$mobile = 0)
	{
		//  var_dump($_FILES);
		$name = $file['name'];
		$type = $file['type'];
		$tmp = $file['tmp_name'];
		$size = $file['size'];

		if($size > 1024*1024*8*100)
		{
			// echo json_encode(array('status' => 0, 'data' => '上传文件大小超过限制'));die;
			$this->error('上传文件大小超过限制');die;
		}

		$arr = explode('.',$name);
		$ext = array_pop($arr);
		$ext = trim($ext);
		$ext = strtolower($ext);
		$allow_arr = array('jpg','png','jpeg','gif');
		if(in_array($ext,$allow_arr) == false)
		{
			// echo json_encode(array('status' => 0, 'data' => '上传文件扩展名是不允许的扩展名'));die;
			$this->error('上传文件扩展名是不允许的扩展名');die;
		}

		$filepath = $filename.'_'.time().".".$ext;

		$dirpath = ROOT_PATH."/public/data/user/".$mobile.'/';

		if(!file_exists($dirpath))
		{
			@mkdir($dirpath,0777,true);
		}
		move_uploaded_file($tmp,$dirpath.$filepath);

		$path = "/public/data/user/".$mobile.'/'.$filepath;
        return $path;
	}

	//注册操作
	public function do_reg(Request $request)
	{
		$post = $request->param();
		$time = time();

		$addr = $post['province3'].' '.$post['city3'].' '.$post['area3'];

		// j($post);
		$mobile = $post['mobile'];
		$truename = $post['truename'];
		$sex = $post['sex'];
		$cardcode = $post['cardcode'];
		$bankname = $post['bankname'];
		$bankcode = $post['bankcode'];
		$refcode = $post['refcode'] ? $post['refcode'] : '';
		$email = $post['email'];
		$yzm = $post['yzm'];



		if(empty($mobile))
		{
			$arr = array('status' => 1 ,'msg' => '手机号不能为空');
			$_SESSION['yzm'] = '';
			$this->error($arr['msg']);die;
		}

		$db = Db::name('user');
		//查看名称是否重复
		$res = $db->where('mobile',$mobile)->count();
		if($res > 0)
		{
			$arr = array('status' => 3 ,'msg' => '手机已存在，请重新注册');
			$_SESSION['yzm'] = '';
			$this->error($arr['msg']);die;
		}

		if(empty($refcode))
		{
			$arr = array('status' => 1 ,'msg' => '邀请码不能为空');
			$_SESSION['yzm'] = '';
			$this->error($arr['msg']);die;
		}

        if(empty($truename))
        {
            $arr = array('status' => 1 ,'msg' => '姓名不能为空');
			$_SESSION['yzm'] = '';
           $this->error($arr['msg']);die;
        }

		if(empty($yzm))
		{
			$arr = array('status' => 6 ,'msg' => '请填写手机验证码');
			$_SESSION['yzm'] = '';
			$this->error($arr['msg']);die;
		}

		if(!isset( $_SESSION['yzm']) || $yzm != $_SESSION['yzm'])
		{
			$arr = array('status' => 7 ,'msg' => '手机验证码错误');
			$_SESSION['yzm'] = '';
			$this->error($arr['msg']);die;
		}

		if($time > $_SESSION['expire_time'])
		{
			$arr = array('status' => 8 ,'msg' => '手机验证码已过期');
			$_SESSION['yzm'] = '';
			$this->error($arr['msg']);die;
		}

		$file = $_FILES;
		//获取图片操作
		if(empty($file['cardtop']) || empty($file['cardback']) || empty($file['bankimg']))
		{
			$this->error('所需的图片不全,请重新上传');die;
		}

		$cardtop = $this->upload($file['cardtop'],'cardtop',$mobile);
		$cardback = $this->upload($file['cardback'],'cardback',$mobile);
		$bankimg = $this->upload($file['bankimg'],'bankimg',$mobile);

		$data = array(
			'mobile' => $mobile,
			'truename' => $truename,
            'sex' => $sex,
			'cardcode' => $cardcode,
			'bankname' => $bankname,
			'email' => $email,
			'bankcode' => $bankcode,
			'bankaddr' => $addr,
			'refcode' => $refcode,
			'cardtop' => $cardtop,
			'cardback' => $cardback,
			'bankimg' => $bankimg,
			'adtime' => date('Y-m-d H:i:s'),
			'uptime' => date('Y-m-d H:i:s'),
		);

        $userid = $db->insertGetId($data);
		if($userid){
			$admin_tel = '18021007135';
			//$admin_tel1 = '15806062633';
		//	 $this->send_user_sms($mobile,$truename);
			$this->send_admin_sms($admin_tel);
			// $this->send_admin_sms($admin_tel1);
			
			$arr = array('status' => 0 ,'msg' => '尊敬的用户，恭喜你提交成功！');
			$this->success($arr['msg']);die;
		}else{
			$arr = array('status' => 2 ,'msg' => '用户注册失败，请重新注册');
			$this->error($arr['msg']);die;
		}

		// echo json_encode($arr);
	}




	//联系我们
	public function about() {
		$about =  Db::name('news_article')->where('cate_id',26)->find();
		$this->assign('about',$about);
		return $this->fetch();
	}

	//联系我们
	public function show_news(Request $request) {
		$id = $request->param('id');
		$news =  Db::name('news_article')->where('id',$id)->find();
		$this->assign('news',$news);
		return $this->fetch();
	}



	/*退出*/
	public function logout() {
		unset($_SESSION['user']);
		 session_destroy();
		success_json('已退出');

	} /*logout*/

} /*end of class Member*/