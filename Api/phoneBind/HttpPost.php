<?php
$phone=$_REQUEST['phone'];
$text=$_REQUEST['text'];
function sms($phone,$text){
    $date=date('Y-m-d H:i:s');
	$post_data['action'] = "send";
    $post_data['mobile'] = "{$phone}";//输入号码，多个号码请用英文逗号隔开。
    $post_data['content'] = "{$text}";//输入短信内容，格式为：【签名】+内容，例子：【掌骏传媒】你好
    $post_data['userid'] = "12431";//输入帐号的ID
    $username = "gltwl1";//输入帐号
    $password = "gltwl1";//输入密码
    $post_data['timestamp'] = date('YmdHis', time());
    $he = $username . $password . $post_data['timestamp'];
    $post_data['sign'] = md5($he);
    $post_data['sendtime'] = "";//提交时间，留空意为即时提交短信，有值意为定时提交短信，格式为2011-11-11 10:00:00
    $post_data['extno'] = "";//扩展，可留空
    $url = "http://sms.izjun.cn/v2sms.aspx";
	$result = request_post($url,$post_data);
	return $result;
}
/**
* 模拟post进行url请求
* @param string $url
* @param string $param
*/
function request_post($url = '', $param = ''){
	if (empty($url) || empty($param)) {
		return false;
	}
	$postUrl = $url;
	$curlPost = $param;
	$ch = curl_init();//初始化curl
	curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
	curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
	curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	$data = curl_exec($ch);//运行curl
	curl_close($ch);
	return $data;
}
$str=sms($phone,$text);
echo $str;
?>