<?php
namespace app\home\controller;

use app\home\controller\Base;
use think\Db;
use think\Request;

/**
 * 用户控制器
需要登录后才能操作的
无需登录的操作放在 Member 中
 */
class User extends Base {

	protected $user;
	protected $request;

	function __construct() {

		parent::__construct();


		$this->request = Request::instance();

	}


	public function login()
	{
      return $this->fetch();

	}

	public function do_login(Request $request)
	{
		// r(md5(123));
		$name = $request->param('username/s');
		$pass = $request->param('pass/s');

//		$arr = array(
//			'username' => $name,
//			'password' => md5($pass),
//		);
		$arr1 = array(
			'username' => $name,
			'password' => md5($pass),
		);

		$user = Db::name('user')->where($arr1)->find();
		$queue = Db::name('queue')->where(array('uid'=>$user['id']))->find();
		// r($user);
		if($user && $queue)
		{
			$_SESSION['user'] = $user;
			$_SESSION['queue'] = $queue;
			echo json_encode(['code'=> 1,'msg' => '登陆成功']);
		}else{
			echo json_encode(['code'=> 0,'msg' => '登陆失败']);
		}

	}

	public function modify_picture() {
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('picture');
		// 移动到框架应用根目录/public/upload/ 目录下
		$info = $file->validate(['ext' => 'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'upload');
		if ($info) {
			// 成功上传后 获取上传信息

			// 输出 jpg
			//echo $info->getExtension();

			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			//echo $info->getSaveName();

			// 输出 42a79759f284b767dfcb2a0197904287.jpg
			//echo $info->getFilename();

			$data = [
				'code' => 222,
				'msg' => '头像上传成功',
				'picture' => '/upload/' . $info->getSaveName(),
			];

			$ret = Db::name('user')->where('id', $this->user['id'])->update([
				'picture' => $data['picture'],
			]);

			if ($ret) {
				die_json($data);
			} else {
				fail_json('保存失败');
			}

		} else {
			// 上传失败获取错误信息
			fail_json($file->getError());
		}

	} /*modify_picture*/

	/*设置实名信息*/
	public function set_real_info() {

		$post_data = $this->request->param();

		//实例化验证器
		$validate = new \think\Validate([
			'real_name' => 'require|length:2,20',
			'identity_card' => 'require|length:15,18',
		]);

		/*验证*/
		if (!$validate->check($post_data)) {
			fail_json($validate->getError());
		}

		/*是否已经设置过*/
		$real_name_exist = Db::name('user')->where('id', $this->user['id'])->value('real_name');
		if ($real_name_exist) {
			fail_json('已设置过实名信息，不可修改!');
		}

		/*保存数据*/
		$ret = Db::name('user')->where('id', $this->user['id'])->update([
			'real_name' => $post_data['real_name'],
			'identity_card' => $post_data['identity_card'],
		]);

		if ($ret) {
			success_json('设置成功');
		} else {
			fail_json('保存失败');
		}

	} /*end  of  set_real_info*/

	/*绑定邮箱*/
	public function bind_email() {
		$param = $this->request->param();
		$email = strtolower($param['email']);
		$email_code = strtolower($param['email_code']);

		if (empty($email) or $email == $this->user['email']) {
			fail_json('您已绑定该邮箱!');
		}

		if ($email !== $_SESSION['member']['email']) {
			fail_json('邮箱变动了，请重新获取验证码');
		}

		if ($email_code !== $_SESSION['member']['email_code']) {
			fail_json('验证码错误');
		}

		$email_exist = Db::name('user')->where('email', $email)->find();
		if ($email_exist) {
			fail_json('该邮箱已被使用，请更换其他邮箱！');
		}

		$ret = Db::name('user')->where('id', $this->user['id'])->update(['email' => $email]);

		if ($ret) {
			success_json('绑定成功');
		} else {
			fail_json('绑定失败');
		}
	} /* end of bind_email*/

	/*绑定邮箱*/
	public function bind_alipay() {

		$alipay = strtolower($this->request->param('alipay'));

		if (!empty($this->user['alipay'])) {
			fail_json('您已设置过支付宝!');
		}

		$alipay_exist = Db::name('user')->where('alipay', $alipay)->find();

		if ($alipay_exist) {
			fail_json('支付宝已被使用！');
		}

		$ret = Db::name('user')->where('id', $this->user['id'])->update(['alipay' => $alipay]);

		if ($ret) {
			success_json('绑定成功');
		} else {
			fail_json('绑定失败');
		}
	} /* end of bind_email*/

	/*已登录用户  通过旧密码  修改密码*/
	public function change_password() {

		$post_data = $this->request->param();

		//实例化验证器
		$validate = new \think\Validate([
			'old_password' => 'require',
			'new_password' => 'require|length:8,18',
			'repassword' => 'confirm:new_password',
		]);

		/*验证*/
		if (!$validate->check($post_data)) {
			fail_json($validate->getError());
		}

		$old_password = md5(md5($post_data['old_password']));
		if ($old_password != $this->user['password']) {
			fail_json('旧密码错误');
		}

		$new_password = md5(md5($post_data['new_password']));
		if ($new_password == $this->user['password']) {
			fail_json('新密码和旧密码相同');
		}

		$ret = Db::name('user')->where('id',$this->user['id'])->update(['password' => $new_password]);

		if ($ret) {
			success_json('修改成功');
		} else {
			fail_json('修改失败');
		}

	} /*change_password*/

} /*end of Class */
