<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/16 0016
 * Time: 18:23
 */
function yinli($y,$m,$d){  //阳历转阴历
    header("Content-Type:text/html;charset=utf-8");
    $lunar = new \Library\Lunar();
    $month = $lunar->convertSolarToLunar($y,$m,$d);//将阳历转换为阴历
    $data = $lunar->getLeapMonth($month[0]);//判断闰月
    cookie('runyue',$data);

//    if($m==2&&$d==3){
//        $d-=1;
//    }
//    if($y%4==0)$d+=1;

    $jieqi=$lunar->getJieQi($y,$m,$d);
    cookie('jieqi',$jieqi['name1']);
    cookie('jieqi2',$jieqi['name2']);
    return $month;
}
function yangli($y,$m,$d){
    header("Content-Type:text/html;charset=utf-8");
    $lunar = new \Library\Lunar();
    $data = $lunar->getLeapMonth($y);//判断闰月
    if($data>$m){
        $month = $lunar->convertLunarToSolar($y,$m,$d);//将阴历转换为阳历
    }else{
        $month = $lunar->convertLunarToSolar($y,$m+1,$d);//将阴历转换为阳历
    }
    return $month;
}
function jieqi($ymd){//计算节气的日期
    $y=mb_substr($ymd,0,4);
    $m=mb_substr($ymd,5,2); //月
    $d=mb_substr($ymd,8,2);//日
    header("Content-Type:text/html;charset=utf-8");
    $lunar = new \Library\Lunar();
    $jieqi=$lunar->getJieQi($y,$m,$d);
    return $jieqi['name1'];
}
function jieqiapi($ymd,$jieqi){//获取节气的具体时间
    $arrjeiqi=array("小寒","大寒","立春","雨水","惊蛰","春分","清明","谷雨",
        "立夏","小满","芒种","夏至","小暑","大暑","立秋","处暑",
        "白露","秋分","寒露","霜降","立冬","小雪","大雪","冬至");
    $key=array_search($jieqi,$arrjeiqi);
    $arrjeiqix=array("xiaohan","dahan","lichun","yushui","jingzhe","chunfen","qingming","guyu",
        "lixia","xiaoman","mangzhong","xiazhi","xiaoshu","dashu","liqiu","chushu",
        "bailu","qiufen","hanlu","shuangjiang","lidong","xiaoxue","daxue","dongzhi");

    $arr=M()->query("select * from tb_24jieqi where year='{$ymd}'");
    $data=mb_substr($arr[0][$arrjeiqix[$key]],12,5,'utf-8');
    if($data){
        return $data;
    }else{
        return '11:55';
    }

//    $url = "http://www.ximizi.com/JieqiChaxun.php?year={$ymd}";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//不需要证书验证
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//不需要主机验证
//    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
//    $json = curl_exec($ch);
//    preg_match("/{$jieqi}<\/strong>[\s\S]*?<\/li>/",$json,$matches);
//    preg_match("/j2r[\s\S]*?</",$matches[0],$jieqitime);
//    return mb_substr($jieqitime[0],23,5);
//    curl_close($ch);
}
//八字精批
function liunian($bznianzhu){
    $liunian=M()->query("select * from tb_liunian where name='{$bznianzhu}'");
    $GLOBALS['liunian']=$liunian[0];
}
function fortune($shengxiao,$bzrizhu){
    $y=mb_substr(cookie('zymd'),0,4);//年
    $sexNum=cookie('zsex');
    $data=$y%5;
    if($data==0){
        $dataR=5;
    }
    $fortune=M()->query("select * from tb_fortune where name='{$shengxiao}'");
    $GLOBALS['shortcoming']=$fortune[0]['shortcoming'];
    $GLOBALS['fortune']=$fortune[0]['fortune'.$data];
    $GLOBALS['congenital']=$fortune[0]['congenital'];
    $GLOBALS['be_careful']=$fortune[0]['be_careful'];

    $lovefenxi=M()->query("select * from tb_fortune where namegz='".mb_substr($bzrizhu,0,1,'utf-8')."'");
    if($sexNum==1){
        $GLOBALS['lovefenxi']=$lovefenxi[0]['lovefenxi1'];
    }else{
        $GLOBALS['lovefenxi']=$lovefenxi[0]['lovefenxi'];
    }
    $data=$y%3;
    $thnumber=explode(',',$lovefenxi[0]['lovenum'.$data]);
    $arrtaohua=array();
    for($i=0;$i<count($thnumber);$i++){
        $arr=M()->query("select * from tb_taohua_luck where id={$thnumber[$i]}");
        $arrtaohua=array_merge($arrtaohua,$arr);
    }
    $GLOBALS['arrtaohua']=$arrtaohua;

    $shengxiaosh=M()->query("select name,image0,namesh1,image1,namesh2,image2,dizhi1,dizhi2 from tb_fortune where name='{$shengxiao}'");
    $GLOBALS['shengxiaosh']=$shengxiaosh[0];
}
function wuxing_healthy($wuxing){
    $arrdata=M()->query("select * from tb_wuxing_healthy where name='{$wuxing}'");
    $GLOBALS['wuxing']=$arrdata[0];
}
//紫薇斗数
function zsqk($srg,$arrzx,$arrtf,$jix,$xiongx){//自身情况
    $mgwz=array_search('命宫',$srg);$qywz=array_search('迁移',$srg);
    $sywz=array_search('事业',$srg);$vbwz=array_search('财帛',$srg);
    $zsqkwz=array();
    array_push($zsqkwz,$mgwz,$qywz,$sywz,$vbwz);
    $GLOBALS['zsqkwz']=$zsqkwz;
    $zsqkzx='';//拥有主星
    if(!empty($arrzx[$zsqkwz[0]])){$zsqkzx=mb_substr($arrzx[$zsqkwz[0]],0,2,'utf-8').',';}
    if(!empty($arrzx[$zsqkwz[1]])){$zsqkzx=$zsqkzx.mb_substr($arrzx[$zsqkwz[1]],0,2,'utf-8').',';}
    if(!empty($arrtf[$zsqkwz[0]])){$zsqkzx=$zsqkzx.mb_substr($arrtf[$zsqkwz[0]],0,2,'utf-8').',';}
    if(!empty($arrtf[$zsqkwz[1]])){$zsqkzx=$zsqkzx.mb_substr($arrtf[$zsqkwz[1]],0,2,'utf-8').',';}
    $zsqkzx=substr($zsqkzx,0,strlen($zsqkzx)-1);
    $GLOBALS['zsqkzx']=$zsqkzx;

    //吉凶
    $jixing=$jix[$zsqkwz[0]].$jix[$zsqkwz[1]];
    if(!empty($jixing)){$jixing=substr($jixing,0,strlen($jixing)-1).'坐命宫,';}
    $jixingx=$jix[$zsqkwz[2]].$jix[$zsqkwz[3]];
    if(!empty($jixingx)){$jixing=$jixing.substr($jixingx,0,strlen($jixingx)-1).'加会,';}
    $jixing=substr($jixing,0,strlen($jixing)-1);
    $GLOBALS['zsqkjx']=$jixing;

    $xiongxing=$xiongx[$zsqkwz[0]].$xiongx[$zsqkwz[1]];
    if(!empty($xiongxing)){$xiongxing=substr($xiongxing,0,strlen($xiongxing)-1).'坐命宫,';}
    $xiongxingx=$xiongx[$zsqkwz[2]].$xiongx[$zsqkwz[3]];
    if(!empty($xiongxingx)){$xiongxing=$xiongxing.substr($xiongxingx,0,strlen($xiongxingx)-1).'加会,';}
    $dataji=stristr($hyqgzx,$shua[0]['hji']);//化忌
    if(!empty($dataji)){$xiongxing=$xiongxing.$shua[0]['hji'].'化忌,';}
    $xiongxing=substr($xiongxing,0,strlen($xiongxing)-1);
    $GLOBALS['zsqkxx']=$xiongxing;
//宫位
    $dizhix=array('寅','卯','辰','巳','午','未','申','酉','戌','亥','子','丑');
    $mggongwei=M()->query("select * from tb_zwds_dizhi where dizhi='{$dizhix[$zsqkwz[0]]}' and palace='命宫'");
    $GLOBALS['mggongwei']=$mggongwei[0]['text'];
//宫位凶吉
    if(cookie('mgxj'.$zsqkwz[0])==''){$data=mt_rand(60,100).'.'.mt_rand(10,99);cookie('mgxj'.$zsqkwz[0],$data,315360);}
    $GLOBALS['mgxj']=cookie('mgxj'.$zsqkwz[0]);
//自身状况
    $arrzx=explode(',',$zsqkzx);
    $arrzhux=array();
    foreach($arrzx as $key=>$value){
        $arr=M()->query("select * from tb_zwds_zhuxing where star='{$value}' and palace='命宫'");
        $arrzhux=array_merge($arrzhux,$arr);
    }
    $GLOBALS['mgarrzhux']=$arrzhux;


    $jxstrz=$jix[$zsqkwz[0]].$jix[$zsqkwz[1]].$xiongx[$zsqkwz[0]].$xiongx[$zsqkwz[1]];
    $jxstrh=$jix[$zsqkwz[2]].$jix[$zsqkwz[3]].$xiongx[$zsqkwz[2]].$xiongx[$zsqkwz[3]];
    $arrfxz=explode(',',substr($jxstrz,0,strlen($jxstrz)-1));$arrfuxz=array();
    $arrfxj=explode(',',substr($jxstrh,0,strlen($jxstrh)-1));$arrfuxj=array();
    foreach($arrfxz as $key=>$value){
        $arr=M()->query("select * from tb_zwds_fuxing where star='{$value}' and palace='命宫'");
        $arrfuxz=array_merge($arrfuxz,$arr);}
    foreach($arrfxj as $key=>$value){
        $arr=M()->query("select * from tb_zwds_fuxing where star='{$value}' and palace='命宫'");
        $arrfuxj=array_merge($arrfuxj,$arr);}
    for($i=0;$i<count($arrfuxz);$i++){
        if($arrfuxz[$i]['text']==$arrfuxz[$i+1]['text']){
            $arrfuxz[$i]['star']=$arrfuxz[$i]['star'].'坐命宫,'.$arrfuxz[$i+1]['star'];
            $arrfuxz[$i+1]='';$i++;}}
    for($i=0;$i<count($arrfuxj);$i++){
        if($arrfuxj[$i]['text']==$arrfuxj[$i+1]['text']){
            $arrfuxj[$i]['star']=$arrfuxj[$i]['star'].'加会,'.$arrfuxj[$i+1]['star'];
            $arrfuxj[$i+1]='';$i++;}}
    $GLOBALS['mgarrfuxz']=array_filter($arrfuxz);
    $GLOBALS['mgarrfuxj']=array_filter($arrfuxj);
}


//function user_data($uid){
//    $url = "http://sm.ddznzj.com/sm/userhp/list?uid={$uid}&page=0";
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//不需要证书验证
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//不需要主机验证
//    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
//    $json = curl_exec($ch);
//    $arr=json_decode($json);
//    //cookie('arrdata',$arr->content,604800);
//    return json_decode($arr->content);
//}

function dayun(){
    $url = "http://sm.ddznzj.com/sm/newselftest/dayun?day=2013-8-9%2016&sex=0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//不需要证书验证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//不需要主机验证
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
    $json = curl_exec($ch);
//    dump($json);
//    exit;
    $arr=json_decode($json);
}
