<?php
namespace app\home\controller;

use think\Cache;
use think\Db;
use think\captcha\Captcha;

class Index extends Base
{
	public function index()
    {
		$this->assign('annment',news_text(2,'',10,$this->lang));
		$this->assign('fnew_data',news_text(5,16,10,$this->lang));
		$this->assign('fnew_today',news_text(5,17,10,$this->lang));
		$this->assign('fnew_anly',news_text(5,18,10,$this->lang));
		$this->assign('lear_know',news_text(15,19,10,$this->lang));
		$this->assign('lear_down',news_text(15,20,10,$this->lang));
		$this->assign('lear_video',news_text(15,21,10,$this->lang));
		return $this->view->fetch(':index');
	}
	public function visit()
    {
		$user=Db::name("member_list")->where(array("member_list_id"=>input('id',0,'intval')))->find();
		if(empty($user)){
			$this->error(lang('member not exist'));
		}
		$this->assign($user);
		return $this->view->fetch('user:index');
	}
	public function verify_msg()
	{
		ob_end_clean();
		$verify = new Captcha (config('verify'));
		return $verify->entry('msg');
	}
	public function lang()
	{
		if (!request()->isAjax()){
			$this->error(lang('submission mode incorrect'));
		}else{
			$lang=input('lang_s');
			switch ($lang) {
				case 'cn':
					cookie('think_var', 'zh-cn');
				break;
				case 'en':
					cookie('think_var', 'en-us');
				break;
				//其它语言
				default:
					cookie('think_var', 'zh-cn');
			}
			Cache::clear();
			$this->success(lang('success'),url('home/Index/index'));
		}
	}
	public function addmsg()
    {
		if (!request()->isAjax()){
			$this->error(lang('submission mode incorrect'));
		}else{
			$verify =new Captcha ();
			if (!$verify->check(input('verify'), 'msg')) {
				$this->error(lang('verifiy incorrect'));
			}
			$data=array(
				'plug_sug_name'=>input('plug_sug_name'),
				'plug_sug_email'=>input('plug_sug_email'),
				'plug_sug_content'=>input('plug_sug_content'),
				'plug_sug_addtime'=>time(),
				'plug_sug_open'=>0,
				'plug_sug_ip'=>request()->ip(),
			);
			$rst=Db::name('plug_sug')->insert($data);
			if($rst!==false){
				$this->success(lang('message success'));
			}else{
				$this->error(lang('message failed'));
			}
		}
	}
	public function selectOrderID()
    {
		$data['order_time']=date("Y-m-d H:i:s");
		$data['tranAmt']=$_POST["tranAmt"];
		$data['order_tpid']=$_POST['order_tpid'];
		$addid = Db::name('order')->insertGetId($data);
		return $addid;
	}
}