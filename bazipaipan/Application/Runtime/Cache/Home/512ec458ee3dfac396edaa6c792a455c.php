<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo ($title1); ?></title>
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
    <style>
        *{margin:0;padding:0;}
        body{background-color:#f0f0f0;font-family: PingFangSC-Medium, sans-serif;}
        a,sapn{-webkit-tap-highlight-color: transparent;}
        section{margin:0 0.2rem;}
        .top_box{
            margin:0.2rem 0.2rem 0.3rem 0.2rem;
            line-height: 0.5rem;
            border-radius: 0.16rem;
            background-color:#F44D4D;
            background-image:url('/bazipaipan/Public/images/mg_bg.png');
            background-position:right bottom;
            background-size:1.7rem 100%;
            background-repeat: no-repeat;
        }
        .top_box .top_msg{font-size:0.32rem;color:#ffffff;padding:0.2rem 0.24rem;}
        .bg_box{
            height:9.54rem;
            background:url('/bazipaipan/Public/images/bg_fuzzy.png') no-repeat;
            background-size:100% 100%;
        }
        .suo_msg{text-align: center;}
        .suo_title{padding-top:0.8rem;font-size:0.32rem;color:#202121;text-indent:2em;padding:0.8rem 0.6rem 0;}
        .suo_cont{padding-top:0.4rem;}
        .suo_cont .jie_btn{
            width:5.3rem;
            height:0.8rem;
            display: inline-block;
            line-height: 0.8rem;
            text-align: center;
            background-color:#F44D4D;
            color:#ffffff;
            font-size:0.32rem;
            border-radius: 0.35rem;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
        }
        .suo_cont .jie_btn .icon_suo{
            width:0.4rem;height: 0.4rem;
            display: inline-block;
            background:url('/bazipaipan/Public/images/img_suo.png') no-repeat;
            background-size:100% 100%;
            vertical-align: middle;
            margin-right:0.1rem;
        }
        .suo_cont .kai_suo{padding-top:0.3rem;font-size:0.32rem;color:#202121;}
        .suo_cont .suo_ul{padding-top:0.4rem;list-style: none;}
        .suo_cont .suo_ul li{
            margin:0 auto;
            margin-bottom: 0.3rem;
            width:2.46rem;
            height:0.6rem;
            text-align: center;
            line-height: 0.6rem;
            background-image:url('/bazipaipan/Public/images/wenbenkuang.png');
            background-repeat: no-repeat;
            background-size:100% 100%;
            font-size:0.32rem;
            color:#ffffff;
            -webkit-tap-highlight-color: transparent;
        }
        /* 弹出支付盒子 */
        .public_pay_popup {
            background-color: rgba(0,0,0,.6);
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 39;
            display: none;
        }
        .public_pp_box {
            position: absolute;
            width: 80%;
            background-color: #fff;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            -webkit-transform: translate(-50%,-50%);
            padding: 20px 10px 10px;
            box-sizing: border-box;
            text-align: center;
            color: #3a3a3a;
            font-size: 0.32rem;
            border-radius: 0.12rem;
        }
        .public_pp_close {
            position: absolute;
            right: 0;
            top: 0;
            width: 0.8rem;
            height: 0.8rem;
            font-weight: 700;
            font-size: 0.4rem;
            line-height: 0.8rem;
            color: #666;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }
        .public_pp_price, .public_pp_tit {
            padding: 0.2rem 0 0.12rem;
        }
        .public_pp_price strong {
            color: #ce0000;
            font-size: 0.36rem;
        }
        .public_pay_box {
            position: relative;
            padding: 0 0.2rem 0.2rem;
        }
        .public_pay_box a {
            font-size:0.32rem;
            display: block;
            height: 0.8rem;
            line-height: 0.8rem;
            text-align: center;
            margin: 0.2rem 0.4rem 0;
            box-shadow:0 0 2px #949494;
            border-radius: 0.1rem;
            text-decoration: none;
            color: #fff;
        }
        .public_pay_box a:nth-child(1){
            background-color:#00C900;
        }
        .public_pay_box a:nth-child(2){
            background-color:#00A7E9;
        }
        .public_pay_box a img{
            width: 0.7rem;
            height: 0.7rem;
            vertical-align: middle;
            padding-right: 0.2rem;
        }
    </style>
</head>
<body>
    <div class="top_box">
        <p class="top_msg">日主壬水生于月得令，秋水通源，印星气旺，月干葵水来助，时柱辛亥金水生扶，日主壬水身旺无疑！身旺取年柱己未官星用神。</p>
    </div>
    <section>
        <div class="bg_box">
            <div class="suo_msg">
                <p class="suo_title"><?php echo ($text); ?></p>
                <div class="suo_cont">
                    <a href="javascript:;" class="jie_btn"><span class="icon_suo"></span>点击解锁您的<?php echo ($title1); ?></a>
                    <p class="kai_suo">解锁后可查看一下分析结果</p>
                    <ul class="suo_ul">
                        <li class="suo_li"><?php echo ($title2); ?></li>
                        <li class="suo_li"><?php echo ($title3); ?></li>
                        <li class="suo_li"><?php echo ($title4); ?></li>
                    </ul>
                </div>
            </div>  
        </div>
    </section>
    <div class="public_pay_popup" id="publicPayPopup">
        <div class="public_pp_box">
            <div class="public_pp_close" id="publicPPClose">X</div>
            <div class="public_pp_tit">解锁查看所有测算结果</div>
            <div class="public_pp_price">
                <span>统一鉴定价：</span><strong>￥68元</strong>
            </div>
            <div class="public_pay_box">
                <a class="alipay" target="_self" href="<?php echo U('Zhifu/paywxshiye','',false);?>"><img src="/bazipaipan/Public/images/wxzf.png" />微信安全支付</a>
                <?php if($wxlogin == 1 ): else: ?>
                <a class="alipay" style="background-color:#00A7E9;" target="_self" href="<?php echo U('Zhifu/payshiye','',false);?>"><img src="/bazipaipan/Public/images/zfbzf.png" />支付宝安全支付</a><?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        for(let i=0;i<document.querySelectorAll('.suo_li').length;i++){
            document.querySelectorAll('.suo_li')[i].onclick = function(){
                document.querySelector('#publicPayPopup').style.display = "block";
            }
        }
        document.querySelector('.jie_btn').onclick = function(){
            document.querySelector('#publicPayPopup').style.display = "block";
        }
        document.querySelector('#publicPPClose').onclick = function(){
            document.querySelector('#publicPayPopup').style.display = "none";
        }
        sessionStorage.setItem("chufa", "2");
    </script>
</body>
</html>