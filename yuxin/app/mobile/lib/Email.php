<?php
namespace app\home\lib;

use PHPMailer;

require ROOT_PATH . '/extend/mailer/PHPMailerAutoload.php';

/**
 * 邮件发送类
 */
class Email {

	public function send_email_code($email) {

		$_SESSION['member']['email'] = strtolower($email);
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";

		if (!preg_match($pattern, $email)) {
			fail_json('请填写正确的邮箱地址');
		}

		$email_code = mt_rand(1000, 9999);
		$_SESSION['member']['email_code'] = strtolower($email_code);

		//邮件配置
		$c_email = include ROOT_PATH . '/app/home/extra/email.php';
		$mail = new PHPMailer;
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->isHTML(true); // Set email format to HTML
		$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
		$mail->SMTPAuth = true;
		$mail->CharSet = "utf-8";
		$mail->Host = $c_email['host']; // Specify main and backup SMTP servers
		$mail->Port = $c_email['port']; // TCP port to connect to
		$mail->Username = $c_email['address']; // SMTP username
		$mail->Password = $c_email['password']; // SMTP password

		$mail->setFrom($c_email['address'], $c_email['username']);
		$mail->Subject = '积分店';
		$mail->Body = '积分店账号绑定邮箱验证码:' . $email_code;
		$mail->addAddress($email, 'kehu'); // Add a recipient

		if ($mail->send()) {
			//保存到SESSION
			success_json('验证码已发至' . $email . '请前往查看。');
		} else {
			fail_json($mail->ErrorInfo);
		}
	} /*end of send_email_code*/
} /*end of class  Email*/
