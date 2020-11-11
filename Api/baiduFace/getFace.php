<?php
require_once 'AipFace.php';
$image=$_REQUEST['imgUrl'];

// 你的 APPID AK SK
const APP_ID = '16751979';
const API_KEY = 'yLmVPctOyYRYrRjHceW2622G';
const SECRET_KEY = 'Ag60RLZRcfsfcHzBbLV4SVxw3xGEQwvk';

$client = new AipFace(APP_ID, API_KEY, SECRET_KEY);

//$image="http://hy.yixueqm.com/other/img/face1.png";
//$imageType = "BASE64";
$imageType="URL";

// 调用人脸检测
//$data=$client->detect($image, $imageType);

// 如果有可选参数
$options = array();
$options["face_field"] = "age,beauty,expression,face_shape,quality,landmark";
//beauty(美丑打分，范围0-100，越大表示越美)
//expression(表情  none:不笑；smile:微笑；laugh:大笑)
//face_shape(脸型  square: 正方形 triangle:三角形 oval: 椭圆 heart: 心形 round: 圆形 )
//quality(人脸质量信息 occlusion[人脸各部分遮挡的概率，范围[0~1]，0表示完整，1表示不完整] )

// 带参数调用人脸检测
$data=$client->detect($image, $imageType, $options);

echo json_encode($data,JSON_UNESCAPED_UNICODE);

//开发文档  https://ai.baidu.com/ai-doc/FACE/yk37c1u4t     SDK:https://ai.baidu.com/ai-doc/FACE/zk37c1qrv#人脸检测