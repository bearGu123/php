<?php
namespace Home\Controller;
use Think\Controller;
class ZhifuController extends Controller {
    public function lingqiAppJump(){//灵旗App跳转查看结果
        $typeName=$_REQUEST['typeName'];//宫位名称
        $birthday=$_REQUEST['birthday'];
        $sex=$_REQUEST['sex'];
        $ymdArr=explode('-',$birthday);
        $ymd=$ymdArr[1].'-'.$ymdArr[2].'-'.$ymdArr[3];
        cookie('zymd',$ymd,60);
        cookie('zsex',$sex,60);
        cookie('zhour',$ymdArr[4],60);
        if($typeName=='性格'){$this->xinggeFx();
        }else if($typeName=='事业'){$this->zfshiye();
        }else if($typeName=='命运'){$this->zfmingyun();
        }else if($typeName=='财运'){$this->zfcaiyun();
        }else if($typeName=='婚恋'){$this->zfhunlian();
        }else if($typeName=='健康'){$this->zfjiankang();
        }
    }
    public function zzhifu(){
        $data=M()->query("select status from sm_h5test where ordernum='".cookie('orderid')."'");
        $this->assign('status',$data[0]['status']);
        $this->display("Index/zzhifu");
    }
    public function xinggeFx(){//性格分析  灵旗App使用
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
    public function zfshiye(){//事业分析
        if(cookie('zsex')==1){$zsex='男';}else{$zsex='女';}
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            $this->assign('shengxiao',I('globals.shengxiao'));//生肖
            $this->assign('xiys',I('globals.xiys'));//喜用神
            fortune(I('globals.shengxiao'),I('globals.bzrizhu'));
            $this->assign('shengxiaosh',I('globals.shengxiaosh'));//生肖三合
            wuxing_healthy(I('globals.xiys'));
            $this->assign('cause',I('globals.wuxing'));//事业喜用神
        }
        $this->assign('title1','事业前景');
        $this->assign('title2','事业方向');
        $this->assign('title3','三和贵人');
      $this->display("Zhifu/shiye");
    }
    public function payshiye(){
        $price=cookie('price');
        header("location:https://{$_SERVER['HTTP_HOST']}/bazipaipan/api/wappay/pay.php?orderid=".cookie('orderid')."&price={$price}");exit;
    }
    public function paywxshiye(){//微信支付
        $arrdata=M()->query("select * from sm_h5test where ordernum='".cookie('orderid')."' and status=-1");
        if(!empty($arrdata)){
            $orderid='BZPP'.date('Y').mt_rand(10000,99999).date('His');//重新生成订单
            cookie('orderid',$orderid,604800);
            M()->query("update sm_h5test set ordernum='".cookie('orderid')."' where id='{$arrdata[0]['id']}'");
        }else{
            header('location:'.U('Index/bz_fenxi','',false));
            exit;
        }

        $price=cookie('price');
        $price*=100;

        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ip=preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
        $scene_info="{\"h5_info\": {\"type\":\"Wap\",\"wap_url\": \"https://hy.yixueqm.com\",\"wap_name\": \"知命支付\"}}";

        $name='八字排盘';

        $noncestr=noncestr(15);
        $MCHID=C('GMCHID');
        $body=$name;
        $type='MWEB';
        $notifyUrl="https://{$_SERVER['HTTP_HOST']}/bazipaipan/index.php/Home/Zhifu/return_urlwxx?orderid=".cookie('orderid');
        $stringA="appid=".C('APPID')."&body={$body}&mch_id={$MCHID}&nonce_str={$noncestr}&notify_url={$notifyUrl}&out_trade_no={$orderid}&scene_info={$scene_info}&spbill_create_ip={$ip}&total_fee={$price}&trade_type={$type}";
        $stringSignTemp=$stringA."&key=".C('KEY'); //注：key为商户平台设置的密钥key
        $sign=strtoupper(md5($stringSignTemp));

        $strData=array(
            'appid'=>C('APPID'),
            'mch_id'=>$MCHID,
            'nonce_str'=>$noncestr,
            'sign'=>$sign,
            'body'=>$body,
            'out_trade_no'=>$orderid,
            'total_fee'=>$price,
            'spbill_create_ip'=>$ip,
            'notify_url'=>$notifyUrl,
            'trade_type'=>$type,
            'scene_info'=>$scene_info,
        );
        $xml = "<xml>";
        foreach ($strData as $key=>$val)//数组转xml
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        $strData=$xml;
        //$json=json_encode($data,JSON_UNESCAPED_UNICODE);
        $headers=array(
            'Content-Type:text/xml;charset=utf-8',
        );
        $url="https://api.mch.weixin.qq.com/pay/unifiedorder";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_URL,$url); //设置请求地址
        curl_setopt($ch,CURLOPT_POST,true); //post请求
        curl_setopt($ch,CURLOPT_POSTFIELDS,$strData);// post请求的数据
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//不需要证书验证
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//不直接输出到页面
        $json = curl_exec($ch);
        $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        $xmlstring = simplexml_load_string($json, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring),true);
        curl_close($ch);
        $redirect_url='https://'.$_SERVER['HTTP_HOST']."/bazipaipan/index.php/Home/Zhifu/return_urlwx?orderid=".cookie('orderid');
        $redirect_url=urlencode($redirect_url);

        header("location:".$val['mweb_url']."&redirect_url=".$redirect_url);
    }

    public function zfmingyun(){//八字命运
        if(cookie('zsex')==1){$zsex='男';}else{$zsex='女';}
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            zsqk(I('globals.srg'),I('globals.arrzx'),I('globals.arrtf'),I('globals.arrjix'),I('globals.arrxiongx'));
            $this->assign('zsqkwz',I('globals.zsqkwz'));//自身情况
            $this->assign('zsqkzx',I('globals.zsqkzx'));//自身主星
            $this->assign('zsqkjx',I('globals.zsqkjx'));//自身吉星
            $this->assign('zsqkxx',I('globals.zsqkxx'));//自身凶星
            $this->assign('mggongwei',I('globals.mggongwei'));//自身宫位
            $this->assign('mgxj',I('globals.mgxj'));//自身宫位凶吉
            $this->assign('mgarrzhux',I('globals.mgarrzhux'));//自身主星状况
            $this->assign('mgarrfuxz',I('globals.mgarrfuxz'));//自身副星状况坐命宫
            $this->assign('mgarrfuxj',I('globals.mgarrfuxj'));//自身副星状况加会
        }
        $this->assign('title1','命宫分析');
        $this->assign('title2','自身状况');
        $this->assign('title3','命运赠言');
        $this->display("Zhifu/mingyun");
    }

    public function zfcaiyun(){//财运分析
        if(cookie('zsex')==1){$zsex='男';}else{$zsex='女';}
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            fortune(I('globals.shengxiao'),I('globals.bzrizhu'));
            $this->assign('shortcoming',I('globals.shortcoming'));//生肖缺点
            $this->assign('fortune',I('globals.fortune'));//流年财运
            $this->assign('congenital',I('globals.congenital'));//先天财运
            $this->assign('becareful',I('globals.be_careful'));//注意事项
        }
        $this->assign('title1','流年财运');
        $this->assign('title2','先天财运');
        $this->assign('title3','注意事项');
        $this->display("Zhifu/caiyun");
    }

    public function zfhunlian(){//婚恋分析
        if(cookie('zsex')==1){$zsex='男';}else{$zsex='女';}
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            fortune(I('globals.shengxiao'),I('globals.bzrizhu'));
            $this->assign('lovefenxi',I('globals.lovefenxi'));//爱情分析
            $this->assign('arrtaohua',I('globals.arrtaohua'));//爱情桃花
        }
        $this->assign('title1','爱情分析');
        $this->assign('title2','桃花运');
        $this->assign('title3','桃花解析');
        $this->display("Zhifu/hunlian");
    }

    public function zfjiankang(){//健康分析
        if(cookie('zsex')==1){$zsex='男';}else{$zsex='女';}
        if(cookie('zymd')!=''){
            zwmp(cookie('zymd'),cookie('zhour'),$zsex,'zw');
            liunian(I('globals.bznianzhu'));
            $this->assign('liunian',I('globals.liunian'));//流年性格分析
            $liunian=I('globals.liunian');
            wuxing_healthy(mb_substr($liunian['ny'],2,1,'utf-8'));
            $this->assign('wuxing',I('globals.wuxing'));//健康五行
        }
        $this->assign('title1','健康建议');
        $this->assign('title2','养生要点');
        $this->assign('title3','起居饮食');
        $this->display("Zhifu/jiankang");
    }


    public function return_urlwx(){//微信回调
        if(!empty($_REQUEST['uid'])){cookie('uid',$_REQUEST['uid']);}
        if($_REQUEST['result']==1){
            M()->query("update sm_h5test set status=1,paykind=1 where ordernum='{$_REQUEST['orderid']}'");
        }
        header('location:'.U('Index/bz_fenxi','',false));
    }
    public function return_urlwxx(){//微信异步回调
        if($_REQUEST['orderid']){
            $ordernum=$_REQUEST['orderid'];
            $paykind=1;
        }else{
            $strData = $GLOBALS["HTTP_RAW_POST_DATA"];//接收到xml数据
            $obj = simplexml_load_string($strData);//把xml字符串解析成对象
            $ordernum=$obj->out_trade_no;
            $paykind=0;
        }
        $updateTime=date("Y-m-d H:i:s");
        M()->query("update sm_h5test set status=1,paykind='{$paykind}',updatetime='{$updateTime}' where ordernum='{$ordernum}'");
    }
}