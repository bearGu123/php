<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        cookie('post',null);
        cookie('sid',null);
        if($_REQUEST['uid']!=''){
            cookie('uid',$_REQUEST['uid']);//453346258
        }
        $imei=cookie('uidimei');//生成唯一标识imei
        if(empty($imei)){$imei=mt_rand(10000,99999).date('Hi');cookie('uidimei',$imei);}
        if(cookie('uid')==''){cookie('uid',$imei);}
//        $url = "http://test.tomome.com/sm/userhp/list?uid=453346258&page=0";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//不需要证书验证
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//不需要主机验证
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
//        $json = curl_exec($ch);
//        $arr=json_decode($json);
//        cookie('arrdata',$arr->content,604800);
//        $arr=json_decode($arr->content);
        $arr=user_data(cookie('uid'));
        $arrnumber=count($arr);
        for($i=0;$i<$arrnumber;$i++){
            $arrdata[$i]=json_decode(json_encode($arr[$i]),true);
        }
        cookie('arr',$arrdata[0],604800);
        $this->assign('arr',$arrdata);
        $this->display("Index/impt_msg");
    }
    public function pp_msg(){//排盘信息
        if($_REQUEST['birthday']!=''){
            cookie('znickname',I('request.username'),7200);
            cookie('zymd',mb_substr($_REQUEST['birthday'],2,10),7200);
            cookie('zhour',mb_substr($_REQUEST['birthday'],13,2),7200);
            cookie('zsex',$_REQUEST['sex'],7200);
            cookie('placebirth',I('request.PlaceBirth'),7200);
            cookie('phone',I('request.phone'),7200);
            cookie('datatype',mb_substr($_REQUEST['birthday'],0,1),7200);
            cookie('sid',null);
            if(cookie('post')==''){
                save();//添加信息
                cookie('post',1);
            }
        }
        if($_REQUEST['arrnumber']!=''){
            $arrdata=cookie('arr');
            cookie('znickname',$arrdata['username'],7200);
            cookie('zymd',$arrdata['birthday1'],7200);
            cookie('zhour',$arrdata['birthday2'],7200);
            cookie('zsex',$arrdata['sex'],7200);
            cookie('placebirth',$arrdata['address'],7200);
            cookie('phone',$arrdata['phone'],7200);
            cookie('datatype',$arrdata['datatype'],7200);
            cookie('sid',$arrdata['id'],7200);
        }
        $zymd=cookie('zymd');//获取日期 2017-10-01
        $zhour=cookie('zhour');//获取生辰
        $zsex=cookie('zsex');//获取0 女 1 男
        $imgurl="http://hy.yixueqm.com/bazipaipan/index.php/Home/Index/end_pp?ymd={$zymd}&hour={$zhour}&sex={$zsex}";//图片地址
        cookie('imgurl',$imgurl,7200);
        cookie('askUserRq',$zymd.'-'.$zhour,7200);  //用户日期

        $y=mb_substr($zymd,0,4);//年
        $m=mb_substr($zymd,5,2); //月
        $d=mb_substr($zymd,8,2);//日
        $zyinli=yinli($y,$m,$d);
        cookie('zyangli',$y.'年'.$m.'月'.$d.'日'.' '.cookie('zhour').'时',604800);//阳历
        cookie('zyinli',$zyinli[0].'年'.$zyinli[1].$zyinli[2],604800);//阴历
        $zhourPad=str_pad($zhour,2,"0",STR_PAD_LEFT);
        $this->assign('zymh',$zymd." {$zhourPad}:00:00");

        if(cookie('zsex')==1){
            $zsex='男';
        }else{
            $zsex='女';
        }
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            $this->assign('shengxiao',I('globals.shengxiao'));//生肖
            $this->assign('arryysz',I('globals.arryysz'));//四柱阴阳
            $this->assign('sizhu',I('globals.sizhu'));//Z四柱
            $ssarray=array();
            array_push($ssarray,implode(I('globals.nianzhuss')));
            array_push($ssarray,implode(I('globals.yuezhuss')));
            array_push($ssarray,implode(I('globals.shizhuss')));
            $this->assign('nianzhuss',$ssarray);//十神
            $this->assign('canggan',I('globals.canggan'));//藏干
            $this->assign('zhishen',I('globals.zhishen'));//支神
            $this->assign('sizhuny',I('globals.sizhuny'));//四柱纳音
            $this->assign('bzdishi',I('globals.bzdishi'));//八字地势
            $this->assign('wxsqs',I('globals.wxsqs'));//旺相休囚死
            $this->assign('xiys',I('globals.xiys'));//喜用神
            $this->assign('taiyuan',I('globals.taiyuan'));//胎元
            $this->assign('rikong',I('globals.rikong'));//日空
            $this->assign('dayun',I('globals.dayun'));//大运
            $this->assign('dayunx',I('globals.dayunx'));//大运x
            $this->assign('dayuny',I('globals.dayuny'));//大运y
            $this->assign('dayungz',I('globals.dayungz'));//大运干支
            $this->assign('dayunss',I('globals.dayunss'));//大运十神

            $this->assign('jieqiname',cookie('jieqiname'));
        }
        $this->assign('sex',cookie('zsex'));
        $this->display("Index/pp_msg");
    }

    public function bz_fenxi(){ //智能分析
        cookie('orderid',null);
        if(cookie('sid')==''){
            $arr=user_data(cookie('uid'));
            $arrnumber=count($arr);

            $arrdata=json_decode(json_encode($arr[$arrnumber-1]),true);
            cookie('sid',$arrdata['id']);
        }
        $this->assign('sex',cookie('zsex'));
        $this->display("Index/bz_fenxi");
    }
    public function msgs(){//更多选择
        $arr=user_data(cookie('uid'));
        $arrnumber=count($arr);
        for($i=0;$i<$arrnumber;$i++){
            $arrdata[$i]=json_decode(json_encode($arr[$i]),true);
        }
        $this->assign('arrdata',$arrdata);
        $this->display("Index/msgs");
    }
    public function end_suo(){//性格分析
        if(cookie('zsex')==1){$zsex='男';}else{$zsex='女';}
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            $this->assign('sizhu',I('globals.sizhu'));//Z四柱
            liunian(I('globals.bznianzhu'));
            $this->assign('liunian',I('globals.liunian'));//流年性格分析
            fortune(I('globals.shengxiao'),I('globals.bzrizhu'));
            $this->assign('shortcoming',I('globals.shortcoming'));//生肖缺点
        }
        $liunian=I('globals.liunian');
        preg_match('/一、\S+/',$liunian['text'],$biaoxian1);preg_match('/二、\S+/',$liunian['text'],$biaoxian2);
        preg_match('/三、\S+/',$liunian['text'],$biaoxian3);preg_match('/四、\S+/',$liunian['text'],$biaoxian4);
        preg_match('/五、\S+/',$liunian['text'],$biaoxian5);
        $arrbx=array();
        array_push($arrbx,$biaoxian1[0],$biaoxian2[0],$biaoxian3[0],$biaoxian4[0],$biaoxian5[0]);
        $this->assign('arrbx',$arrbx);
        $this->display("Index/end_suo");
    }
    public function moren(){//设置默认
        $data=[
            'uid'=>cookie('uid'),	   //用户id
            'sid'=>$_REQUEST['id'],	      //id号
        ];
        $url = "http://test.tomome.com/sm/userhp/updatestatus";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url); //设置请求地址
        curl_setopt($ch,CURLOPT_POST,true); //post请求
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);// post请求的数据
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//不需要证书验证
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
        $json = curl_exec($ch);
        curl_close($ch);
        if($_REQUEST['moren']==1){
            redirect(U('Index/index','',false));exit;
        }
        redirect(U('Index/index','',false));
    }
    public function delete(){//删除信息
        $data=[
            'uid'=>cookie('uid'),	   //用户id
            'sid'=>$_REQUEST['sid'],	      //id号
        ];
        $url = "http://test.tomome.com/sm/userhp/delete";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url); //设置请求地址
        curl_setopt($ch,CURLOPT_POST,true); //post请求
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);// post请求的数据
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//不需要证书验证
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
        $json = curl_exec($ch);
    }
    public function shiye_fx(){
        cookie('orderidnum','shiye',604800);
        $data=cookie('orderid');//获取订单号
        $datatitle=mb_substr($data,0,4);
        if(empty($data)||$datatitle!='PPSY'){
            $orderid='BZPP'.date('Y').mt_rand(10000,99999).date('His');
            cookie('orderid',$orderid,604800);
        }
        //创建订单
        $hour=cookie('zhour');$shop=cookie('orderid');
        $znickname=cookie('znickname');$zsex=cookie('zsex');
        $imei=cookie('uid').cookie('sid');
        $uid=cookie('uid');
        $sid=cookie('sid');
        $y=mb_substr(cookie('zymd'),0,4);//年
        $m=mb_substr(cookie('zymd'),5,2); //月
        $d=mb_substr(cookie('zymd'),8,2);//日
        cookie('price',38,604800);//价格
        $datastr=stristr(cookie('znickname'),'测试');if($datastr){cookie('price',0.01,604800);}//测试价格
        $price=cookie('price');
        $arrstatus=M()->query("select id,status from sm_h5test where place='{$uid}{$sid}'");
        if($arrstatus[0]['status']==1){
            redirect(U('Zhifu/zfshiye','',false));
        }
        if(empty($_REQUEST['ordernum'])){
            if(empty($arrstatus)){
                M()->query("insert into sm_h5test (ordernum,price,username,typeid,sex,status,datetype,year,month,day,hour,paykind,place,date_remark,ip)values(
                                              '{$shop}','{$price}','{$znickname}',20,{$zsex},-1,0,{$y},{$m},{$d},{$hour},-1,'{$imei}','{$uid}','{$_SERVER['REMOTE_ADDR']}')");
            }else{
                M()->query("update sm_h5test set ordernum='{$shop}' where place='{$imei}'");
            }
        }
        $this->assign('text','分析您一生的事业成就，提供有利于您发展的职业方向，以及事业的信息。');
        $this->assign('title1','事业分析');
        $this->assign('title2','事业前景');
        $this->assign('title3','事业方向');
        $this->assign('title4','三和贵人');
        $this->assign('jieguoye','shiye');
        $this->display("Zhifu/zhifu");
    }
    public function bazi_my(){
        cookie('orderidnum','mingyun',604800);
        $data=cookie('orderid');//获取订单号
        $datatitle=mb_substr($data,0,4);
        if(empty($data)||$datatitle!='PPMY'){
            $orderid='BZPP'.date('Y').mt_rand(10000,99999).date('His');
            cookie('orderid',$orderid,604800);
        }
        //创建订单
        $hour=cookie('zhour');$shop=cookie('orderid');
        $znickname=cookie('znickname');$zsex=cookie('zsex');
        $imei=cookie('uid').cookie('sid');
        $uid=cookie('uid');
        $sid=cookie('sid');
        $y=mb_substr(cookie('zymd'),0,4);//年
        $m=mb_substr(cookie('zymd'),5,2); //月
        $d=mb_substr(cookie('zymd'),8,2);//日
        cookie('price',38,604800);//价格
        $datastr=stristr(cookie('znickname'),'测试');if($datastr){cookie('price',0.01,604800);}//测试价格
        $price=cookie('price');
        $arrstatus=M()->query("select id,status from sm_h5test where place='{$uid}{$sid}'");
        if($arrstatus[0]['status']==1){
            redirect(U('Zhifu/zfmingyun','',false));
        }
        if(empty($_REQUEST['ordernum'])){
            if(empty($arrstatus)){
                M()->query("insert into sm_h5test (ordernum,price,username,typeid,sex,status,datetype,year,month,day,hour,paykind,place,date_remark,ip)values(
                                              '{$shop}','{$price}','{$znickname}',20,{$zsex},-1,0,{$y},{$m},{$d},{$hour},-1,'{$imei}','{$uid}','{$_SERVER['REMOTE_ADDR']}')");
            }else{
                M()->query("update sm_h5test set ordernum='{$shop}' where place='{$imei}'");
            }
        }
        $this->assign('text','分析您一生的命运，提供有利于您人生的情况，让你对自己的命运一目了然。');
        $this->assign('title1','八字命运');
        $this->assign('title2','命宫分析');
        $this->assign('title3','自身状况');
        $this->assign('title4','命运赠言');
        $this->assign('jieguoye','mingyun');
        $this->display("Zhifu/zhifu");
    }
    public function caiyun_fx(){
        cookie('orderidnum','caiyun',604800);
        $data=cookie('orderid');//获取订单号
        $datatitle=mb_substr($data,0,4);
        if(empty($data)||$datatitle!='PPCY'){
            $orderid='BZPP'.date('Y').mt_rand(10000,99999).date('His');
            cookie('orderid',$orderid,604800);
        }
        //创建订单
        $hour=cookie('zhour');$shop=cookie('orderid');
        $znickname=cookie('znickname');$zsex=cookie('zsex');
        $imei=cookie('uid').cookie('sid');
        $uid=cookie('uid');
        $sid=cookie('sid');
        $y=mb_substr(cookie('zymd'),0,4);//年
        $m=mb_substr(cookie('zymd'),5,2); //月
        $d=mb_substr(cookie('zymd'),8,2);//日
        cookie('price',38,604800);//价格
        $datastr=stristr(cookie('znickname'),'测试');if($datastr){cookie('price',0.01,604800);}//测试价格
        $price=cookie('price');
        $arrstatus=M()->query("select id,status from sm_h5test where place='{$uid}{$sid}'");
        if($arrstatus[0]['status']==1){
            redirect(U('Zhifu/zfcaiyun','',false));
        }
        if(empty($_REQUEST['ordernum'])){
            if(empty($arrstatus)){
                M()->query("insert into sm_h5test (ordernum,price,username,typeid,sex,status,datetype,year,month,day,hour,paykind,place,date_remark,ip)values(
                                              '{$shop}','{$price}','{$znickname}',20,{$zsex},-1,0,{$y},{$m},{$d},{$hour},-1,'{$imei}','{$uid}','{$_SERVER['REMOTE_ADDR']}')");
            }else{
                M()->query("update sm_h5test set ordernum='{$shop}' where place='{$imei}'");
            }
        }
        $this->assign('text','分析您一生的财运,对财运深度解析，让您找到正确的守财、发财之道。');
        $this->assign('title1','财运分析');
        $this->assign('title2','流年财运');
        $this->assign('title3','先天财运');
        $this->assign('title4','注意事项');
        $this->assign('jieguoye','caiyun');
        $this->display("Zhifu/zhifu");
    }
    public function hunlian_fx(){
        cookie('orderidnum','hunlian',604800);
        $data=cookie('orderid');//获取订单号
        $datatitle=mb_substr($data,0,4);
        if(empty($data)||$datatitle!='PPHL'){
            $orderid='BZPP'.date('Y').mt_rand(10000,99999).date('His');
            cookie('orderid',$orderid,604800);
        }
        //创建订单
        $hour=cookie('zhour');$shop=cookie('orderid');
        $znickname=cookie('znickname');$zsex=cookie('zsex');
        $imei=cookie('uid').cookie('sid');
        $uid=cookie('uid');
        $sid=cookie('sid');
        $y=mb_substr(cookie('zymd'),0,4);//年
        $m=mb_substr(cookie('zymd'),5,2); //月
        $d=mb_substr(cookie('zymd'),8,2);//日
        cookie('price',38,604800);//价格
        $datastr=stristr(cookie('znickname'),'测试');if($datastr){cookie('price',0.01,604800);}//测试价格
        $price=cookie('price');
        $arrstatus=M()->query("select id,status from sm_h5test where place='{$uid}{$sid}'");
        if($arrstatus[0]['status']==1){
            redirect(U('Zhifu/zfhunlian','',false));
        }
        if(empty($_REQUEST['ordernum'])){
            if(empty($arrstatus)){
                M()->query("insert into sm_h5test (ordernum,price,username,typeid,sex,status,datetype,year,month,day,hour,paykind,place,date_remark,ip)values(
                                              '{$shop}','{$price}','{$znickname}',20,{$zsex},-1,0,{$y},{$m},{$d},{$hour},-1,'{$imei}','{$uid}','{$_SERVER['REMOTE_ADDR']}')");
            }else{
                M()->query("update sm_h5test set ordernum='{$shop}' where place='{$imei}'");
            }
        }
        $this->assign('text','分析您一生的爱情,剖析您今生姻缘运势，分析当下感情状况和不利因素的破解之法。');
        $this->assign('title1','婚恋分析');
        $this->assign('title2','爱情分析');
        $this->assign('title3','桃花运');
        $this->assign('title4','桃花解析');
        $this->assign('jieguoye','hunlian');
        $this->display("Zhifu/zhifu");
    }
    public function jiankang_fx(){
        cookie('orderidnum','jiankang',604800);
        $data=cookie('orderid');//获取订单号
        $datatitle=mb_substr($data,0,4);
        if(empty($data)||$datatitle!='PPJK'){
            $orderid='BZPP'.date('Y').mt_rand(10000,99999).date('His');
            cookie('orderid',$orderid,604800);
        }
//创建订单
        $hour=cookie('zhour');$shop=cookie('orderid');
        $znickname=cookie('znickname');$zsex=cookie('zsex');
        $imei=cookie('uid').cookie('sid');
        $uid=cookie('uid');
        $sid=cookie('sid');
        $y=mb_substr(cookie('zymd'),0,4);//年
        $m=mb_substr(cookie('zymd'),5,2); //月
        $d=mb_substr(cookie('zymd'),8,2);//日
        cookie('price',38,604800);//价格
        $datastr=stristr(cookie('znickname'),'测试');
        if($datastr){cookie('price',0.01);}//测试价格
        $price=cookie('price');
        $arrstatus=M()->query("select id,status from sm_h5test where place='{$uid}{$sid}'");
        if($arrstatus[0]['status']==1){
            redirect(U('Zhifu/zfjiankang','',false));
        }
        if(empty($_REQUEST['ordernum'])){
            if(empty($arrstatus)){
                M()->query("insert into sm_h5test (ordernum,price,username,typeid,sex,status,datetype,year,month,day,hour,paykind,place,date_remark,ip)values(
                           '{$shop}','{$price}','{$znickname}',20,{$zsex},-1,0,{$y},{$m},{$d},{$hour},-1,'{$imei}','{$uid}','{$_SERVER['REMOTE_ADDR']}')");
            }else{
                M()->query("update sm_h5test set ordernum='{$shop}' where place='{$imei}'");
            }
        }
        $this->assign('text','分析您一生的健康,未来的健康状况如何？那怎样的生活方式能让你拥有健康的体态？');
        $this->assign('title1','健康分析');
        $this->assign('title2','健康建议');
        $this->assign('title3','养生要点');
        $this->assign('title4','起居饮食');
        $this->assign('jieguoye','jiankang');
        $this->display("Zhifu/zhifu");
    }
    public function generateImg(){//生成图片
        $imgBase64=$_REQUEST['imgsrc'];
        $base64_image_content =$imgBase64 ;
//匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            $new_file = mb_substr(THINK_PATH,0,-9).'Upload/'.date("Y-m").'/';
            if(!is_dir($new_file))
            {
//检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file);
                chmod($new_file,0777);
            }
            $new_file_hd=$new_file;
            $new_file = $new_file.cookie('uid').cookie('sid').".{$type}";
            $new_file_hd = $new_file_hd.cookie('uid').cookie('sid')."_hd.{$type}";
            $imageadd="http://{$_SERVER['HTTP_HOST']}/bazipaipan/Upload/".date("Y-m").'/'.cookie('uid').cookie('sid').".{$type}";
            cookie('imageaddpp',$imageadd);
//            if(is_file($new_file)){exit;}
            if (file_put_contents($new_file, base64_decode(str_replace($result[1],'', $base64_image_content)))){
                file_put_contents($new_file_hd, base64_decode(str_replace($result[1],'', $base64_image_content)));
                echo '1';//成功
            }else{
                echo '0';
            }
        }
    }

    public function return_url(){//支付宝回调
        if($_REQUEST['appid']==2016101302144443){
            M()->query("update sm_h5test set status=1,paykind=0 where ordernum='{$_REQUEST['shop']}'");
        }
        header('location:'.U('Index/bz_fenxi','',false));
    }
    public function notify_url(){//异步支付宝回调
        if($_REQUEST['app_id']=='2016101302144443'&&$_REQUEST['trade_status']=='TRADE_SUCCESS'){//过虑
        }else{
            echo 'false';exit;
        }
        $updateTime=date("Y-m-d H:i:s");
        M()->query("update sm_h5test set status=1,paykind=0,updatetime='{$updateTime}' where ordernum='{$_REQUEST['out_trade_no']}'");
    }
    public function select_pay(){//微信支付json返回
        $arr=M()->query("select * from sm_h5test where ordernum='".$_REQUEST['orderid']."'");
        $data=$arr[0]['status'];
        if($data!=1){
            $data=2;
        }
        echo $data;
    }
}