<?php
header("Content-type:text/html;charset=utf-8");

//获取数据
$comid = 'A2ENFcfHno';///易智慧的密钥id
$comkey = 'XCOvLxBDnSTEKuHuU3GBCN9nZA2end';///易智慧的密钥key
$mer_id = '8202';//商户号
$order_no = $_POST['order_no'];//订单号
$service_type = $_POST['service_type'];//服务类型

$merOderidNum = $_POST['transaction_no'];//三方订单号
$code = $_POST['resp_code'];//状态code
$message = $_POST['resp_msg'];//状态信息
$sign_type = $_POST['sign_type'];//验签类型
$order_time = $_POST['order_time'];//订单时间
$type = $_POST['type'];//通道类型
$trade_status = $_POST['trade_status'];//支付状态
$order_amount = $_POST['order_amount'];//金额(以分为单位)
$sign = $_POST['sign'];//签值
$subject = $_POST['subject'];//商品名称
$amount = $order_amount/100;//金额

$data = array(
    'order_no' => $order_no,
    'mer_id' => $mer_id,
    'service_type' => $service_type,
    'order_amount' => $order_amount,
    'subject'=>$subject,
    'sign_type' => $sign_type,
    'type' => $type
);
logOut($data);
//验签
$res = publicSing($comid,$comkey,$data,$sign);
logOut($res);
if($res=='SUCCESS' && $trade_status=='success'){
    //入库操作
    $return = callBackCrm('md5',$order_no,$amount,'CNY',$merOderidNum,'success');
	logOut($return);
	echo $return;
}else{
    //验签失败
    echo 'fail';
}
function logOut($data){
   $log_file = 'E:\log\a'.date('Ymd',time()).'_all.log';
   $content =var_export($data,TRUE);
   $content .= "\r\n\n";
   file_put_contents($log_file,$content, FILE_APPEND);
}
function callBackCrm($signType,$orderNo,$orderAmount,$orderCurrency,$transactionId,$status)
{
  $sign = md5($signType.$orderNo.$orderAmount.$orderCurrency.$transactionId.$status.'125683425684');
 
  $post_data = array(
  'signType' => $signType,
  'orderNo' => $orderNo,
  'orderAmount' => $orderAmount,
  'orderCurrency' => $orderCurrency,
  'transactionId' => $transactionId,
  'status'=>$status,
  'sign'=>$sign,
 );  
 
 $return = request_post($post_data, 'http://publicapi.lwork.com:8080/notify/default_notify');
 //$return = createHtml($post_data, 'http://publicapi.lwork.com:8080/notify/default_notify');

 return $return;
}
 /**
     * 模拟post进行url请求
     * @param string $url
     * @param array $post_data
     */
    function request_post($post_data = array(),$url = '') {
        if (empty($url) || empty($post_data)) {
            return false;
        }
        
        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
		
		
		logOut($data);
        curl_close($ch);
        
        return $data;
    }
 function createHtml($params,$url){
    $encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
    $html='<html><head><meta http-equiv="Content-Type" content="text/html; charset={$encodeType}"/></head><body onload="javascript:document.pay_form.submit();">
			<form id="pay_form" name="pay_form" action="'.$url.'" method="post">';
    foreach ( $params as $key => $value ) {
        $html.= "<input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
    }
    $html.='<!-- <input type="submit" type="hidden">--></form></body></html>';
    return $html;
}
//验签方法
function publicSing($comid,$comkey,$data,$sign){
    $params_str=createLinkString($data,true,false);
    $newsign = md5($comid.$comkey.$params_str);
    if($newsign == $sign){
        return 'SUCCESS';
    }else{
        return 'FAIL';
    } 
}

/**
 * 讲数组转换为string
 *
 * @param $para 数组
 * @param $sort 是否需要排序
 * @param $encode 是否需要URL编码
 * @return string
 */
function createLinkString($para, $sort, $encode) {
    if($para == NULL || !is_array($para))
        return "";

    $linkString = "";
    if ($sort) {
        ksort( $para );
    }

    while ( list ( $key, $value ) = each ( $para ) ) {
        if ($encode) {
            $value = urlencode ( $value );
        }
        $linkString .= $key . "=" . $value . "&";
    }
    // 去掉最后一个&字符
    $linkString = substr ( $linkString, 0, count ( $linkString ) - 2 );

    return $linkString;
}

?>