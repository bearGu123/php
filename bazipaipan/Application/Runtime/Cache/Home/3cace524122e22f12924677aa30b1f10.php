<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>八字排盘</title>
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan style='display:none;' id='cnzz_stat_icon_1271417507'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1271417507%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
    <script> (function(designWidth, maxWidth) {
            var doc = document,
            win = window,
            docEl = doc.documentElement,
            remStyle = document.createElement("style"),
            tid;

            function refreshRem() {
                var width = docEl.getBoundingClientRect().width;
                maxWidth = maxWidth || 540;
                width>maxWidth && (width=maxWidth);
                var rem = width * 100 / designWidth;
                remStyle.innerHTML = 'html{font-size:' + rem + 'px;}';
            }

            if (docEl.firstElementChild) {
                docEl.firstElementChild.appendChild(remStyle);
            } else {
                var wrap = doc.createElement("div");
                wrap.appendChild(remStyle);
                doc.write(wrap.innerHTML);
                wrap = null;
            }
            //要等 wiewport 设置好后才能执行 refreshRem，不然 refreshRem 会执行2次；
            refreshRem();

            win.addEventListener("resize", function() {
                clearTimeout(tid); //防止执行两次
                tid = setTimeout(refreshRem, 300);
            }, false);

            win.addEventListener("pageshow", function(e) {
                if (e.persisted) { // 浏览器后退的时候重新计算
                    clearTimeout(tid);
                    tid = setTimeout(refreshRem, 300);
                }
            }, false);

            if (doc.readyState === "complete") {
                doc.body.style.fontSize = "16px";
            } else {
                doc.addEventListener("DOMContentLoaded", function(e) {
                    doc.body.style.fontSize = "16px";
                }, false);
            }
        })(750, 750);</script>
    <!--[if lt IE 9]>  
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>    
    <![endif]-->
    <link rel="stylesheet" href="/bazipaipan/Public/css/LArea.css"/>
    <link rel="stylesheet" href="/bazipaipan/Public/css/YD_calendar.min.css">
    <style>
        *{margin:0;padding:0;}
        body{font-family:PingFangSC-Medium, sans-serif;}
        .banner img{display: block}
        main{padding:0 0.24rem;}
        .cun_msg{padding-bottom: 0.4rem;}
        .cun_msg .f_box{padding:0.3rem 0;overflow:hidden;font-size:0.3rem;}
        .f_left{float:left;}
        .f_right{float:right;-webkit-tap-highlight-color: transparent;text-decoration: none;}
        .f_box :nth-child(1){color:#333333;font-weight:600;}
        .f_box :nth-child(2){color:#cccccc;}
        .opt{height:0.7rem;border:2px solid #D5D5D5;border-radius:0.1rem;padding-right:1.33rem;padding-left:0.2rem;position: relative;}
        .opt #sel{
            height:0.7rem;
            font-size:0.32rem;
            color:#666666;
            line-height: 0.7rem;
            width:100%;
            -webkit-appearance: none;
            outline: none;
            border:none;
            -webkit-tap-highlight-color: transparent;
        }
        #xz_btn{
            width:1.3rem;
            height:0.7rem;
            line-height: 0.7rem;
            font-size:0.32rem;
            background:#E91E1E;
            text-align: center;
            border-top-right-radius:0.1rem;
            border-bottom-right-radius:0.1rem;
            display: inline-block;
            text-decoration: none;
            color:#ffffff;
            position: absolute;
            top:0;
            right:0;
            -webkit-tap-highlight-color: transparent;
        }
        .moren{color:#cccccc;font-size:0.32rem;margin-left:0.2rem;}

        .titel{text-align: center;font-size:0.32rem;color:#333333;padding-bottom: 0.2rem;}
        #xie_frm{overflow: hidden;}
        #xie_frm ul{border:1px solid #D5D5D5;list-style: none;border-radius: 10px;overflow: hidden;}
        #xie_frm ul li{border-bottom: 1px solid #D5D5D5;height:0.9rem;line-height: 0.9rem;}
        #xie_frm ul li:last-child{border:none;}
        .frm_left{font-size:0.28rem;color:#333333;padding:0 0.4rem 0 0.36rem;text-align: center;}

        #man{display: inline-block;font-size:0.32rem;margin-right:0.2rem;-webkit-tap-highlight-color: transparent;}
        #woman{display: inline-block;font-size:0.32rem;-webkit-tap-highlight-color: transparent;}
        .ico{
            width:0.32rem;
            height:0.32rem;
            border-radius: 50%;
            border:1px solid #c72928;
            display:inline-block;
            background-color:#ffffff;
            vertical-align:middle;
            margin-right:0.1rem;
            position: relative;
        }
        .sex::after{
            content: '';
            position: absolute;
            width: 0.2rem;
            height:0.2rem;
            background-color: #c72928;
            border-radius: 50%;
            top:0.06rem;
            left:0.06rem;
        }
        .frm_auto{padding-left:1.9rem;}
        .frm_auto input{width:80%;height:0.9rem;border:none;outline:none;display:block;font-size:0.28rem;color:#333333;-webkit-appearance: none;-webkit-tap-highlight-color: transparent;}
        .pg_btn{padding:0.4rem 1rem 0.4rem 1rem;text-align: center;}
        .pg_btn #xie_btn{
            display:block;
            height:1rem;
            line-height: 1rem;
            font-size:0.32rem;
            text-decoration: none;
            color:#ffffff;
            background:#F24545;
            border-radius: 35px;
            box-shadow:0 5px 0 #C73444;
            border:none;
            -webkit-tap-highlight-color:transparent;
        }
        .calendar label{
            width:1rem;
            height:0.8rem;
            border-radius:0.1rem;
            font-size:0.3rem;
            line-height: 0.8rem;
            display: inline-block;
            border:none;
            text-align: center;
        }
        .calendar .cld{display: none;}
        .calendar :nth-child(2){
            color:#F24545;
            margin-right:0.4rem;
            background:#ffffff;
            border: 1px solid #F24545;
        }
        .calendar :nth-child(4){
            color:#F24545;
            border:1px solid #F24545;
        }
        .calendar input:checked+label{
            background:#F24545;
            color:#ffffff;
        }

        /* 弹出盒子 */
        #tan_box{width:100%;height:100%;background-color:rgba(0,0,0,0.5);position:fixed;top:0;}
        .main_msg{width:5.8rem;background-color:#ffffff;border-radius: 0.16rem;margin:0 auto;border:1px solid #b9b9b9;margin-top:35%;}
        .main_msg .msg_box{padding-left:0.4rem;border-bottom: 1px solid #D0D0D0;}
        .main_msg .msg_box .msg_title{text-align: center;font-family: PingFangSC-Hveavy, sans-serif;font-size:0.36rem;color:#3d4145;padding:0.42rem 0 0.44rem 0;font-weight: 600;}
        .content li{padding-bottom: 0.24rem;list-style: none;font-size:0.3rem;color:#3d4145;}
        .content :first-child p{display: inline-block;}
        .content :first-child p:nth-child(1){padding-right:0.7rem;}
        .msg_btn{display: flex;display: -webkit-flex;}
        .msg_btn a{
            text-align:center;
            width:50%;
            height:0.44rem;
            line-height: 0.44rem;
            display:block;
            color:#db4852;
            font-size:0.34rem;
            text-decoration: none;
            padding:0.3rem;
            -webkit-tap-highlight-color: transparent;
        }
        .msg_btn :first-child span{display:block;border-right:2px solid #D0D0D0;}
    </style>
</head>
<body>
    <div class="banner">
        <img src="/bazipaipan/Public/images/banner.png" width="100%" alt="八字排盘" />
    </div>
    <main>
        <section class="user_msg">
            <div class="cun_msg">
                <div class="f_box">
                    <span class="f_left">选择已保存资料</span>
                    <a href="<?php echo U('Index/msgs','',false);?>" class="f_right">更多&gt</a>
                </div>
                <div class="opt">
                    <div id="sel"><?php echo ($arr[0]['username']); ?><span class="moren">(此选择为默认选项)</span></div>
                    <a href="javascript:;" id="xz_btn">选择</a>
                </div>
            </div>
            <div class="xie_msg">
                <p class="titel">第一步：请先填写您的八字资料</p>
                <form method="post" action="<?php echo U('Index/pp_msg','',false);?>" id="xie_frm">
                    <ul>
                        <li>
                            <div class="frm_left f_left">姓名</div>
                            <div class="frm_auto"><input type="text" name="username"  value="" placeholder="请输入您的姓名"/></div>
                        </li>
                        <li>
                            <div class="frm_left f_left">性别</div>
                            <div class="frm_auto">
                                <span id="man">
                                    <span class="ico sex"></span>
                                    <span>男</span>
                                </span>
                                <span id="woman">
                                    <span class="ico"></span>
                                    <span>女</span>
                                </span>
                                <input type="hidden" name="sex" id="Js_sex" value="1"/>
                            </div>
                        </li>
                        <li>
                            <div class="frm_left f_left">出生日期</div>
                            <div class="frm_auto">
                                <input type="text" id="datetime" data-id="birthday" placeholder="请选择您的出生日期" readonly value="">
                                <input type="hidden" id="birthday" name="birthday"  value="" >
                            </div>
                        </li>
                        <li>
                            <div class="frm_left f_left">出生地点</div>
                            <div class="frm_auto">
                                <input id="place_area" type="text" readonly="" name="PlaceBirth" placeholder="请选择出生所在地"/>
                            </div>  
                        </li>
                        <!--<li>-->
                            <!--<div class="frm_left f_left">手机号码</div>-->
                            <!--<div class="frm_auto"><input type="text" name="phone" value=""  placeholder="请输入您的手机号码"/></div>-->
                        <!--</li>-->
                    </ul>
                    <div class="pg_btn">
                        <a href="javascript:;" id="xie_btn">确认信息</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <div id="tan_box" style="display:none;">
        <div class="main_msg">
            <div class="msg_box">
                <div class="msg_title">请仔细核对信息</div>
                <ul class="content">
                    <li><p>姓名：<span id="msg1">李先生</span></p><p>性别：<span id="msg2">男</span></p></li>
                    <li>出生日期：<span id="msg3">阴历2017年7月1日 18时</span></li>
                    <li>出生地点：<span id="msg4">广东省深圳市</span></li>
                    <!-- <li>手机：<span id="msg5">18588419510</span></li> -->
                </ul>
            </div>
            <div class="msg_btn">
                <a href="javascript:;" id="xg_btn"><span>修改信息</span></a>
                <a href="javascript:;" id="bc_btn"><span>确定保存</span></a>
            </div>
        </div>
    </div>
    <script src="/bazipaipan/Public/js/YD_calendar.min.js"></script>
    <script src="/bazipaipan/Public/js/layer_mobile/layer.js"></script>
    <script src="/bazipaipan/Public/js/LArea.js"></script>
    <script src="/bazipaipan/Public/js/LAreaData1.js"></script>
    <script src="/bazipaipan/Public/js/LAreaData2.js"></script>
    <script>
        const Oman = document.getElementById('man');
        const Owoman = document.getElementById('woman');
        const OJs_sex = document.getElementById('Js_sex');
        const Oxie_btn = document.getElementById('xie_btn');
        const OuserName = document.getElementsByName('username')[0];
        const Ocalendar = document.getElementsByName('calendar');
        const OplaceBirth = document.getElementsByName('PlaceBirth')[0];
        const Obirthday = document.getElementById('datetime');
        // const Ophone = document.getElementsByName('phone')[0];
        const Otan_box = document.getElementById('tan_box');
        const Oxg_btn = document.getElementById('xg_btn');
        const Obc_btn = document.getElementById('bc_btn');
        const Oxz_btn = document.getElementById('xz_btn');
        const OJs_date = document.getElementsByTagName('Js_date');
        const Osel = document.getElementById('sel');
        const Omsg1 = document.getElementById('msg1')
        const Omsg2 = document.getElementById('msg2')
        const Omsg3 = document.getElementById('msg3')
        const Omsg4 = document.getElementById('msg4')
        // const Omsg5 = document.getElementById('msg5')
        // 男女切换
        Oman.onclick = function(){
            Owoman.firstElementChild.classList.remove("sex")
            Oman.firstElementChild.classList.add("sex")
            OJs_sex.value = "1";
        }
        Owoman.onclick = function(){
            Oman.firstElementChild.classList.remove("sex")
            Owoman.firstElementChild.classList.add("sex")
            OJs_sex.value = '0';
        }
        // 时间日期
        var calendar1 = new lCalendar().init('#datetime');
        // 选择地点
        var area = new LArea();  
        area.init({  
            'trigger': '#place_area',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置  
            'valueTo':'#value1',//选择完毕后id属性输出到该位置  
            'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出  
            'type':1,//数据源类型  
            'data':LAreaData//数据源  
        }); 
        // 表单验证
        Oxie_btn.onclick = function(){
            const patrn= /^[\u4E00-\u9FA5]{1,5}$/;
            const phoneYz= /^[1][3,4,5,7,8][0-9]{9}$/;
            var isEnd = false;
            if(OuserName.value == ''){
                layer.open({
                    content: '请输入您的姓名'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            }else if(OuserName.value.length < 2){
                layer.open({
                    content: '姓名字数不能低于2'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            }else if(!patrn.test(OuserName.value)){
                layer.open({
                    content: '请输入中文姓名'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            };
            if(Obirthday.value == ''){
                layer.open({
                    content: '请选择您的出生日期'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            };
            if(document.querySelector('#birthday').value == ''){
                Obirthday.value = '';
                layer.open({
                    content: '请重新选择您的出生日期'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            };
            if(OplaceBirth.value == ''){
                layer.open({
                    content: '请选择您的出生地点'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                return false;
            };
            // if(Ophone.value == ''){
            //     layer.open({
            //         content: '手机号码不能为空！'
            //         ,skin: 'msg'
            //         ,time: 2 //2秒后自动关闭
            //     });
            //     return false;
            // }else if(!phoneYz.test(Ophone.value)){
            //     layer.open({
            //         content: '号码有误，请重新输入！'
            //         ,skin: 'msg'
            //         ,time: 2 //2秒后自动关闭
            //     });
            //     return false;
            // };
            Omsg1.innerHTML = OuserName.value;
            OJs_sex.value =='0'?Omsg2.innerHTML = '女':Omsg2.innerHTML = '男';
            Omsg3.innerHTML = Obirthday.value;
            Omsg4.innerHTML = OplaceBirth.value;
            // Omsg5.innerHTML = Ophone.value;
            Otan_box.style.display = 'block'
        }
        // 修改信息
        Oxg_btn.onclick =function(){
            Otan_box.style.display = 'none'
        };
        // 确定保存
        Obc_btn.onclick =function(){
            document.querySelector('#xie_frm').submit();
        };
        // 开始测算
        Oxz_btn.onclick = function(){
            if("<?php echo ($arr[0]['username']); ?>"!='') {
                setTimeout(function () {
                    layer.open({
                        type: 2
                        , content: '命盘测算中'
                    });
                    setTimeout(function () {
                        layer.closeAll('loading');
                        window.location.href = "<?php echo U('Index/pp_msg','',false);?>?arrnumber=0";
                    }, 1200)
                }, 100);
            }
        }
        sessionStorage.setItem("chufa","2");
    </script>
</body>
</html>