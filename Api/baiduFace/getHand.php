<?php
require_once 'AipBodyAnalysis.php';
$image_file=$_REQUEST['imgUrl'];

// 你的 APPID AK SK
const APP_ID = '20003744';
const API_KEY = 'efZ4R0ms7Qf5qa0wb3qig1tC';
const SECRET_KEY = '5AuQVQQPyDa2P9UesfgOR0RhagBKCT6K';

$client = new AipBodyAnalysis(APP_ID, API_KEY, SECRET_KEY);

//$image_file= "http://hy.yixueqm.com/other/img/hand.png";

//$image_info             = getimagesize($image_file);
//$base64_image_content   = chunk_split(base64_encode(file_get_contents($image_file)));


$image = file_get_contents($image_file);


// 调用手部关键点识别
$data=$client->handAnalysis($image);

echo json_encode($data,JSON_UNESCAPED_UNICODE);
//文档  https://ai.baidu.com/ai-doc/BODY/Rk7iw6jsi