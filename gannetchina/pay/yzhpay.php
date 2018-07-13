<?php
header("Content-type:text/html;charset=utf-8");

//获取数据
$pickupUrl = $_POST['pickupUrl'];
$receiveUrl =  $_POST['receiveUrl'];
$signType = $_POST['signType'];
$orderNo  = $_POST['orderNo'];
$orderAmount  = $_POST['orderAmount'];
$orderCurrency = $_POST['orderCurrency'];
$customerId = $_POST['customerId'];
$sign = $_POST['sign'];

$newsign = md5($pickupUrl.$receiveUrl.$signType.$orderNo.$orderAmount.$orderCurrency.$customerId.'125683425684');

if($sign!=$newsign)
{
	echo 'Fail';
	return;
}

 $post_url = 'http://www.yzhpay.com/Pay/Index/pay';///易智慧的请求地址
 $order_no = $orderNo;
 $comid = 'A2ENFcfHno';///易智慧的密钥id
 $comkey = 'XCOvLxBDnSTEKuHuU3GBCN9nZA2end';///易智慧的密钥key
 $merid = '8202';//商户号
 $service_type=803;//服务类型 
 $amount = strval($_POST['orderAmount']*100);//单位：分
 $subject = 'sd';//商品名称
 $result_url = 'http://www.gannetchina.com/pay/yzhnotify.php';
 $notify_url = 'http://www.gannetchina.com/pay/yzhnotify.php';
 $type=2;//类型	

 $post_data = array(
  'order_no' => $order_no,
  'mer_id' => $merid,///
  'service_type' => $service_type,
  'order_amount' => $amount,
  'subject' => $subject,
  'sign_type'=>'md5',//验签类型
  'type'=>$type,
 );  
 //md5加密
 $str=linkString ($post_data);
 $sign = md5($comid.$comkey.$str);

 $post_data['sign'] = $sign;
 $post_data['return_url'] = $notify_url;
 $post_data['notify_url'] = $notify_url;
 $post_data['order_time'] = date('Y-m-d H:i:s');
 
 $return = createHtml($post_data, $post_url);
 
 echo $return;
 
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
//拼接字符串
function linkString($para,$sort=true,$encode=true){
    if($para == NULL || !is_array($para))
        return "";

    $linkString = "";
    if ($sort) {
        ksort ( $para );
    }
    while ( list ( $key, $value ) = each ( $para ) ) {
        if($value!=''){
            if ($encode) {
                $value = urlencode ( $value );
            }
            $linkString .= $key . "=" . $value . "&";
        }
    }
    // 去掉最后一个&字符
    $linkString = substr ( $linkString, 0, count ( $linkString ) - 2 );

    return $linkString;

}
?>