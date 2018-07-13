<?php

namespace app\home\controller;

use think\Db;
use think\captcha\Captcha;
use think\Validate;

class Login extends Base
{
    public function index()
    {
	    if(session('hid')){
			if($this->user['user_status']){
				$this->redirect(__ROOT__."/");
			}else{
				return $this->view->fetch('user:active');
			}
	    }else{
			return $this->view->fetch('user:login');
	    }
	}
	//验证码
	public function verify()
    {
        if (session('hid')) {
            $this->redirect(__ROOT__."/");
        }
		ob_end_clean();
		$verify = new Captcha (config('verify'));
		return $verify->entry('hid');
    }
	/*
     * 退出登录
     */
	public function logout()
    {
		session('hid',null);
		session('user',null);
		cookie('yf_logged_user',null);
		$this->redirect(__ROOT__."/");
	}
	
    //登录验证
    public function runlogin()
    {
		
var_dump('aaaa');exit;
		include_once('./LXCRM/init.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$tradingPlatformAccountName = $_POST['tradingPlatformAccountName'];
		$password = $_POST['password'];
		try {
			$ownerUserId = new guid();
			$ownerUserId = $config['ownerUserId'];


			$loginAccount = new LoginAccount();

			$loginAccount->ownerUserId = $ownerUserId;
			$loginAccount->organizationName = $config['organization'];
			$loginAccount->businessUnitName = $config['businessUnitName'];
			$loginAccount->tradingPlatformAccountName = $tradingPlatformAccountName;
			$loginAccount->tradingPlatformAccountPassword = $password;

			$leverateCrm = getCrm($config);

			$loginAccountResponse = new LoginAccountResponse();
			$loginAccountResponse = $leverateCrm->LoginAccount($loginAccount);
			$loginResponse = $loginAccountResponse->LoginAccountResult;

			$ResultInfo = new ResultInfo();
			$ResultInfo = $loginResponse->Result;

			$result = $loginResponse->AccountId;
			$success = $ResultInfo->Code;
			$message = $ResultInfo->Message;

		} catch (Exception $e) {
			echo  '<div style="color:#ffffff;">Caught exception: '.  $e. "\n</div>";
		}
		$this->success(lang('login success'),url('home/Login/check_active'));
		} else {
		$result = null;
		$success = 'Success';
		$message = null;
		}
    }
    public function forgot_pwd()
    {
		return $this->view->fetch('user:forgot_pwd');
	}
	//验证码
	public function verify_forgot()
    {
        if (session('hid')) {
            $this->redirect(__ROOT__."/");
        }
		ob_end_clean();
		$verify = new Captcha (config('verify'));
		return $verify->entry('forgot');
    }
    public function runforgot_pwd()
    {
		if(request()->isPost()){
			$member_list_email=input('member_list_email');
			$member_list_username=input('member_list_username');
			$verify =new Captcha ();
			if (!$verify->check(input('verify'), 'forgot')) {
				$this->error(lang('verifiy incorrect'));
			}
			$rule = [
				['member_list_email','require|email','{%email empty}|{%email format incorrect}'],
				['member_list_username','require','{%username empty}'],
			];
			$validate = new Validate($rule);
			$rst   = $validate->check(array('member_list_email'=>$member_list_email,'member_list_username'=>$member_list_username));
			if(true !==$rst){
				$this->error(join('|',$validate->getError()));
			}
			$find_user=Db::name("member_list")->where(array("member_list_username"=>$member_list_username))->find();
			if($find_user){
				if(empty($find_user['member_list_email'])){
					//先更新字段邮箱
					Db::name("member_list")->where(array("member_list_username"=>$member_list_username))->setField('member_list_email',$member_list_email);
					$find_user['member_list_email']=$member_list_email;
				}
				if($find_user['member_list_email']==$member_list_email){
					//发送重置密码邮件
					$activekey=md5($find_user['member_list_id'].time().uniqid());//激活码
					$result=Db::name("member_list")->where(array("member_list_id"=>$find_user['member_list_id']))->update(array("user_activation_key"=>$activekey));
					if(!$result){
						$this->error(lang('activation code generation failed'));
					}
					//生成重置链接
					$url = url('home/Login/pwd_reset',array("hash"=>$activekey), "", true);
					$template = lang('emal text').
								<<<hello
								<a href="http://#link#">http://#link#</a>
hello;
					$content = str_replace(array('http://#link#','#username#'), array($url,$member_list_username),$template);
					$send_result=sendMail($member_list_email, 'YFCMF '.lang('pwd reset'), $content);
					if($send_result['error']){
						$this->error(lang('send pwd reset email failed'));
					}else{
						$this->success(lang('send pwd reset email success'),url('home/Index/index'));
					}
				}else{
					$this->error(lang('email not the same as registered email'));
				}
			}else {
				$this->error(lang('member not exist'));
			}
		}
	}
    public function pwd_reset()
    {
	    $hash=input("get.hash");
	    $find_user=Db::name("member_list")->where(array("user_activation_key"=>$hash))->find();
	    if (empty($find_user)){
	        $this->error(lang('pwd reset hash incorrect'),url('home/Index/index'));
	    }else{
			$this->assign("hash",$hash);
			return $this->view->fetch('user:pwd_reset');
	    }
	}
	//验证码
	public function verify_reset()
    {
        if (session('hid')) {
            $this->redirect(__ROOT__."/");
        }
		ob_end_clean();
		$verify = new Captcha (config('verify'));
		return $verify->entry('pwd_reset');
    }
    public function runpwd_reset()
    {
		if(request()->isPost()){
			$verify =new Captcha();
			if (!$verify->check(input('verify'), 'pwd_reset')) {
				$this->error(lang('verifiy incorrect'));
			}
			$rule = [
				['password','require|length:5,20','{%pwd empty}|{%pwd length}'],
				['repassword','require|confirm:password','{%repassword empty}|{%repassword incorrect}'],
				['hash','require','{%pwd reset hash empty}'],
			];
			$validate = new Validate($rule);
			$rst= $validate->check(array('password'=>input('password'),'hash'=>input('hash'),'repassword'=>input('repassword')));
			if(true !==$rst){
				$this->error(join('|',$validate->getError()));
			}else{
				$password=input('password');
				$hash=input('hash');
				$member_list_salt=random(10);
				$member_list_pwd=encrypt_password($password,$member_list_salt);
				$result=Db::name("member_list")->where(array("user_activation_key"=>$hash))->update(array('member_list_pwd'=>$member_list_pwd,'user_activation_key'=>'','member_list_salt'=>$member_list_salt));
				if($result){
					$this->success(lang('pwd reset success'),url("home/Login/index"));
				}else {
					$this->error(lang('pwd reset failed'));
				}
			}
		}
	}
    public function check_active()
    {
		$this->check_login();
		if($this->user['user_status']){
			$this->redirect(__ROOT__."/");
		}else{
			//判断是否激活
			return $this->view->fetch('user:active');
		}
	}
	//重发激活邮件
    public function resend()
    {
		$this->check_login();
		$current_user=$this->user;
		if($current_user['user_status']==0){
			if($current_user['member_list_email']){
				$active_options=get_active_options();
				$activekey=md5($current_user['member_list_id'].time().uniqid());//激活码
				$result=Db::name('member_list')->where(array("member_list_id"=>$current_user['member_list_id']))->update(array("user_activation_key"=>$activekey));
				if(!$result){
					$this->error(lang('activation code generation failed'));
				}
				//生成激活链接
				$url = url('home/Register/active',array("hash"=>$activekey), "", true);
				$template = $active_options['email_tpl'];
				$content = str_replace(array('http://#link#','#username#'), array($url,$current_user['member_list_username']),$template);
				$send_result=sendMail($current_user['member_list_email'], $active_options['email_title'], $content);
				if($send_result['error']){
					$this->error(lang('send active email failed'));
				}else{
					$this->success(lang('send active email success'),url('home/Login/index'));
				}
			}else{
				$this->error(lang('no registered email'),url('home/Login/index'));
			}
		}else{
		    $this->error(lang('activated'),url('home/Index/index'));
		}
	}
}