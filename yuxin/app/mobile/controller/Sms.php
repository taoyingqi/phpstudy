<?php
/**
 * Created by PhpStorm.
 * User: 卢军
 * Date: 2018/3/6
 * Time: 11:41
 */

namespace app\home\controller;

use think\Db;
use think\Request;
use think\Controller;

ini_set("display_errors", "on");

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

require_once VENDOR_PATH .'/aliyun_sms/vendor/autoload.php';
// 加载区域结点配置
Config::load();

class Sms extends Controller
{
    protected $req;

    function __construct(Request $request)
    {
        parent::__construct($request);
        $this->req = $request;
    }

    static $acsClient = null;

    public function get_code($num)
    {
        $str = str_shuffle('012345678901234567890123456789');
        return substr($str,0,$num);
    }

    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public static function getAcsClient() {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
        $accessKeyId = "LTAIaBjTMgS7qU13"; // AccessKeyId

        $accessKeySecret = "Ml5S3Gn6sXHzrCkimhDbkSgYuRCooz"; // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";


        if(static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }

    /**
     * 发送短信
     * @return stdClass
     */
    public function sendSms() {

        $tel = $this->req->param('tel');
        $code = $this->get_code(6);
        $_SESSION['yzm'] = $code;
        $_SESSION['expire_time'] = time()+300;
      //  $tel = 15160198060;
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $send = new SendSmsRequest();
        // 必填，设置短信接收号码
        $send->setPhoneNumbers($tel);
        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $send->setSignName("逸信国际");
        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $send->setTemplateCode("SMS_133045255");
        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $send->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code"=> $code,
           // "product"=>"dsd"
        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
       // $send->setOutId("234234");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
       // $send->setSmsUpExtendCode("1234567");
        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($send);
       // j($acsResponse);
       if($acsResponse->Code == 'OK')
       {
           echo json_encode(array('code'=>1,'msg'=>'短信发送成功'));die;
         //  $this->success('短信发送成功');die;
       }else{
           echo json_encode(array('code'=>0,'msg'=>'短信发送失败,请稍后再试'));die;
          // $this->error('短信发送失败,请稍后再试');die;
       }

    }


    /**
     * 发送短信1
     * @return stdClass
     */
    public static function sendSms1($tel,$tpl,$arr) {
        // $code = $this->get_code(6);
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $send = new SendSmsRequest();
        // 必填，设置短信接收号码
        $send->setPhoneNumbers($tel);
        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $send->setSignName("逸信国际");
        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $send->setTemplateCode($tpl);
        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $send->setTemplateParam(json_encode($arr, JSON_UNESCAPED_UNICODE));

//        array(  // 短信模板中字段的值
//            "status"=> '已注册',
//            "remark"=>"成功注册"
//        )


        // 可选，设置流水号
        // $send->setOutId("234234");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        // $send->setSmsUpExtendCode("1234567");
        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($send);
        // j($acsResponse);
        return $acsResponse;

    }

    /**
     * 批量发送短信
     * @return stdClass
     */
    public static function sendBatchSms() {

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendBatchSmsRequest();

        // 必填:待发送手机号。支持JSON格式的批量调用，批量上限为100个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumberJson(json_encode(array(
            "1500000000",
            "1500000001",
        ), JSON_UNESCAPED_UNICODE));

        // 必填:短信签名-支持不同的号码发送不同的短信签名
        $request->setSignNameJson(json_encode(array(
            "云通信",
            "云通信"
        ), JSON_UNESCAPED_UNICODE));

        // 必填:短信模板-可在短信控制台中找到
        $request->setTemplateCode("SMS_1000000");

        // 必填:模板中的变量替换JSON串,如模板内容为"亲爱的${name},您的验证码为${code}"时,此处的值为
        // 友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        $request->setTemplateParamJson(json_encode(array(
            array(
                "name" => "Tom",
                "code" => "123",
            ),
            array(
                "name" => "Jack",
                "code" => "456",
            ),
        ), JSON_UNESCAPED_UNICODE));

        // 可选-上行短信扩展码(扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段)
        // $request->setSmsUpExtendCodeJson("[\"90997\",\"90998\"]");

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }

    /**
     * 短信发送记录查询
     * @return stdClass
     */
    public static function querySendDetails() {

        // 初始化QuerySendDetailsRequest实例用于设置短信查询的参数
        $request = new QuerySendDetailsRequest();

        // 必填，短信接收号码
        $request->setPhoneNumber("12345678901");

        // 必填，短信发送日期，格式Ymd，支持近30天记录查询
        $request->setSendDate("20170718");

        // 必填，分页大小
        $request->setPageSize(10);

        // 必填，当前页码
        $request->setCurrentPage(1);

        // 选填，短信发送流水号
        $request->setBizId("yourBizId");

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        return $acsResponse;
    }

}