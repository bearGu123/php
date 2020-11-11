<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>性格分析</title>
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
    <link rel="stylesheet" href="/bazipaipan/Public/css/swiper-3.4.2.min.css"/>
    <style>
        *{margin:0;padding:0;}
        body{font-family:PingFangSC-Medium, sans-serif;background-color:#f0f0f0;}
        nav{width:100%;height:0.9rem;background-color:#ffffff;-webkit-tap-highlight-color:rgba(0,0,0,0);}
        nav .top_ul{list-style: none;width:100%;-webkit-tap-highlight-color: transparent;-webkit-tap-highlight-color:rgba(0,0,0,0);}
        .nav_btn{height:0.9rem;font-size:0.32rem;color:#555555;text-align: center;line-height: 0.9rem;-webkit-tap-highlight-color: transparent;-webkit-tap-highlight-color:rgba(0,0,0,0);}
        .swiper-container1 .active-nav{color:#f44d4d;font-size:0.32rem;border-bottom: 0.06rem solid #f44d4d;}

        section{padding:0.2rem;box-sizing: border-box;}
        .bg_top{
            padding:0.2rem 0.24rem;
            background-image:url('/bazipaipan/Public/images/mg_bg.png');
            background-position:right bottom;
            background-size:1.7rem 1.25rem;;
            background-repeat: no-repeat;
            background-color:#F44D4D;
            border-radius: 0.16rem;
        }
        .bg_top p{font-size:0.32rem;color:#ffffff;}
        .end_msg{background-color:#ffffff;border-radius: 0.16rem;margin-top:0.3rem;}
        .msg_title{padding-left:0.22rem;font-size:0.38rem;color:#f44d4d;padding-top:0.24rem;}
        .icon_line{
            width:0.08rem;
            height:0.4rem;
            display: inline-block;
            margin-right:0.1rem;
            background-color:#f44d4d;
            vertical-align: middle;
        }
        .msg_cont{padding:0.3rem;}
        .msg_cont p{font-size:0.32rem;color:#5a595a;}
    </style>
</head>
<body>
    <nav class="swiper-container1">
        <ul class="top_ul swiper-wrapper">
            <li class="swiper-slide nav_btn active-nav"><?php echo ($title1); ?></li>
            <li class="swiper-slide nav_btn "><?php echo ($title2); ?></li>
            <li class="swiper-slide nav_btn "><?php echo ($title3); ?></li>
            <!--<li class="swiper-slide nav_btn ">性格劣势1</li>-->
            <!--<li class="swiper-slide nav_btn ">性格劣势2</li>-->
        </ul>
    </nav>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <section class="swiper-slide">
                <div class="bg_top"><p>命宫主星就像人体的大脑一样指挥全盘、发号施令。代表着个人的主要个性物质、可对行动力、自尊心、创造力等能力进行分析。</p></div>
                <div class="end_msg">
                    <div class="msg_title"><span class="icon_line"></span><?php echo ($title1); ?></div>
                    <div class="msg_cont">
                        <p><?php echo ($mggongwei); ?></p>
                    </div>
                </div>
                <div class="end_msg">
                    <div class="msg_cont">
                        <p>主星:<?php echo ($zsqkzx); ?></p>
                        <p>吉凶:<?php echo ($mgxj); ?>%大吉</p>
                    </div>
                </div>

            </section>

            <section class="swiper-slide">
                <div class="bg_top"><p>命宫主星就像人体的大脑一样指挥全盘、发号施令。代表着个人的主要个性物质、可对行动力、自尊心、创造力等能力进行分析。</p></div>
                <div class="end_msg">
                    <div class="msg_title"><span class="icon_line"></span><?php echo ($title2); ?></div>
                    <div class="msg_cont">
                        <p>性格优点：<?php echo ($mgarrzhux[0]['youdian']); ?></p>
                        <p>性格缺点：<?php echo ($mgarrzhux[0]['quedian']); ?></p>
                    </div>
                </div>
                <div class="end_msg">
                    <div class="msg_title"><span class="icon_line"></span>常见表现</div>
                    <div class="msg_cont">
                        <p><?php echo ($mgarrzhux[0]['text']); ?></p>
                    </div>
                </div>
            </section>

            <section class="swiper-slide">
                <div class="bg_top"><p>命宫主星就像人体的大脑一样指挥全盘、发号施令。代表着个人的主要个性物质、可对行动力、自尊心、创造力等能力进行分析。</p></div>
                <div class="end_msg">
                    <div class="msg_title"><span class="icon_line"></span><?php echo ($title3); ?></div>
                    <div class="msg_cont">
                        <p><?php echo ($mgarrzhux[0]['zengyan']); ?></p>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <script src="/bazipaipan/Public/js/swiper-3.4.2.min.js"></script>
    <script>
        var mySwiper1 = new Swiper('.swiper-container1',{
            watchSlidesProgress : true,
            watchSlidesVisibility : true,
            slidesPerView : 3,
            onTap: function(){
                    mySwiper.slideTo( mySwiper1.clickedIndex)
                }
            })
            var mySwiper = new Swiper('.swiper-container',{

            onSlideChangeStart: function(){
                    updateNavPosition()
                }
            })
        function updateNavPosition(){
            var lis = document.querySelectorAll('.swiper-container1 .swiper-slide');
            for(let i=0;i<lis.length;i++){
                lis[i].classList.remove("active-nav");
                if(mySwiper.activeIndex == i){
                    lis[i].classList.add("active-nav");
                    var num = i;
                    if(num > mySwiper1.activeIndex){
                        var thumbsPerNav = Math.floor(mySwiper1.width / lis[i].offsetWidth) -1;
                        mySwiper1.slideTo(num-thumbsPerNav)
                    }else{
                        mySwiper1.slideTo(num)
                    }
                }
            }
        }
    </script>
</body>
</html>