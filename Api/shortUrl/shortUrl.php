<?php
$getUrl=$_REQUEST['url'];
if(empty($getUrl)){
    return 0;
}
$apiUrl =urlencode($getUrl);
$url="http://suo.im/api.htm?format=json&url={$apiUrl}&key=5e0d94e7b1b63c2d905419f6@0fbd6c446925cef60113c46dff49174c";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); //设置请求地址
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//不需要证书验证
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
$json = curl_exec($ch);
echo $json;