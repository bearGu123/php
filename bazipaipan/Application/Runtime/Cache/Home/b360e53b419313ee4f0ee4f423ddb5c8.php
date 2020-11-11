<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>排盘信息</title>
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
        body{color:#333333;font-family: PingFangSC-Medium, sans-serif;padding-bottom: 1.5rem;}
        .cent{padding-bottom: 0.2rem;background-color:#fff;}
        .detail_info{padding:0 0.4rem 0 0.4rem;list-style: none;font-size:0.32rem;}
        .detail_info li {height: auto;overflow: hidden;padding-bottom: 0.3rem;}
        .detail_info .info_head {text-align: left; color: #db4852;width: 12%;}
        .detail_info .info_heads {width: 22%;text-align: center;}
        .detail_info span {
            display: block;
            width: 22%;
            float: left;
            text-align: center;
        }
        .detail_info .info_ts {width: 12%;}
        .if_ul {padding:0 0.4rem;overflow: hidden;list-style: none;font-size:0.32rem;}
        .main_info li {padding-bottom: 0.3rem;}
        .main_info li div {width: 37%;}
        .main_info li div.m_w_bai { width: 100%;}
        .main_info li .ts_a { width: 100%;}
        .main_info dl {
            overflow: hidden;
            border: 1px solid #db4852;
            margin:0.1rem;
            font-size:0.32rem;
        }
        .main_info dl dt {
            float: left;
            width: 10%;
            padding: 0.4rem 0.2rem;
            text-align: center;
            writing-mode: lr-tb;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        .main_info dl dd {float: left;width:90%;height: auto;}
        .main_info dl dd .num {height: auto;overflow: hidden;width: 100%;}
        .main_info dl dd .word {height: auto;overflow: hidden;width: 100%;}
        .main_info dl dd .num span, .main_info dl dd .word span {
            border-left: 1px solid #db4852;
            border-bottom: 1px solid #db4852;
            box-sizing: border-box;
            float: left;
            text-align: center;
            display: block;
        }
        .main_info dl dd .num span {
            height: 0.7rem;
            width:calc(100%/8);
            text-align: center;
            line-height: 0.7rem;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        .main_info dl dd .word span {
            height: 1.1rem;
            padding-top:0.1rem;
            width:calc(100% / 8);
            color: #333333;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border-bottom:none;
        }
        .base_info span, .main_info dl dd .num, .main_info dl dt, .main_info li div span {color: #db4852;}

        .lis3{display:-webkit-flex;display:flex;align-items: center;}
        .ft_left{float:left;width:88%;}
        .ft_left .flb{width:100%;display: flex;}
        .ft_left .flb:first-child{padding-bottom: 0.3rem;}
        .ft_left .flb span{flex-grow: 1;}

        .top_msg{border-bottom: 0.3rem solid #f0f0f0;}
        .top{margin:0.1rem 0.18rem 0.1rem 0.24rem;overflow: hidden;height:1rem;line-height: 1rem;position: relative;font-size:0.32rem;color:#333333;}
        .top .user_hd{width:0.8rem;height:0.8rem;display:inline-block;vertical-align: middle;margin-right:0.2rem;}
        .top .user_qh{width:1.7rem;height:0.74rem;display: inline-block;vertical-align: middle;position: absolute;right:0;margin-top:0.2rem;-webkit-tap-highlight-color: transparent;}
        .content{margin:0 0.24rem;border-top:1px solid #cccccc;font-size: 0.28rem;color:#333333;}
        .content p{padding:0.2rem 0;}
        .btn_box{padding: 0.2rem 0.4rem;display: flex;display: -webkit-flex;justify-content:space-between;}
        .btn_box .znfx_btn,.btn_box .dsfx_btn{
            width:48%;
            height:1rem;
            background-color: #F44E4D;
            color:#ffffff;
            font-size:0.36rem;
            text-decoration: none;
            line-height: 1rem;
            display: inline-block;
            text-align: center;
            border-radius: 0.7rem;
            -webkit-tap-highlight-color: transparent;
        }
        .ft_sever{
            position: fixed;
            bottom: 0;
            left:0;
            width: 100%;
            z-index: 99;
        }
    </style>
</head>
<body>
    <section class="top_msg">
        <div class="top">
            <div class="user_hd">
                <?php if($sex == 1): ?><img src="/bazipaipan/Public/images/02_icon_Head_man.png" width="100%" alt="用户头像"/>
                    <?php else: ?>
                    <img src="/bazipaipan/Public/images/02_icon_Head_woman.png" width="100%" alt="用户头像"/><?php endif; ?>

            </div>
            您的八字命盘
            <a href="<?php echo U('Index/index','',false);?>" class="user_qh"><img src="/bazipaipan/Public/images/02_btn_qiehuan.png" width="100%" alt="切换用户"/></a>
        </div>
        <div class="content">
            <p><?php echo (cookie('znickname')); ?>，生于公元<?php echo (cookie('zyangli')); ?>，农历<?php echo (cookie('zyinli')); ?>&nbsp;&nbsp;<?php echo mb_substr($sizhu[3],1,1,'utf-8');?>时，年干支为<?php echo ($sizhu[0]); ?>，为<?php echo ($arryysz[0]); ?>年<?php echo ($arryysz[1]); ?>月<?php echo ($arryysz[2]); ?>日<?php echo ($arryysz[3]); ?>时出生，其生辰八字与一生大运列示如下，请仔细参详！</p>
        </div>
    </section>
    <section class="cent">
        <ul class="detail_info">
            <li>
                <span class="info_head info_heads info_ts">&nbsp;</span>
                <span class="info_head info_heads">年柱</span>
                <span class="info_head info_heads">月柱</span>
                <span class="info_head info_heads">日柱</span>
                <span class="info_head info_heads">时柱</span>
            </li>
            <li>
                <span class="info_head">十神</span>
                <span><?php echo ($nianzhuss[0]); ?></span>
                <span><?php echo ($nianzhuss[1]); ?></span>
                <span>命主</span>
                <span><?php echo ($nianzhuss[2]); ?></span>
            </li>
            <li class="lis3">
                <span class="info_head">八字</span>
                <div class="ft_left">
                    <p class="flb">
                        <span><?php echo mb_substr($sizhu[0],0,1,'utf-8');?></span>
                        <span><?php echo mb_substr($sizhu[1],0,1,'utf-8');?></span>
                        <span><?php echo mb_substr($sizhu[2],0,1,'utf-8');?></span>
                        <span><?php echo mb_substr($sizhu[3],0,1,'utf-8');?></span>
                    </p>
                    <p class="flb">
                        <span><?php echo mb_substr($sizhu[0],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($sizhu[1],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($sizhu[2],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($sizhu[3],1,1,'utf-8');?></span>
                    </p>
                </div>
            </li>
            <li>
                <span class="info_head">藏干</span>
                <span><?php echo ($canggan[0]); ?></span>
                <span><?php echo ($canggan[1]); ?></span>
                <span><?php echo ($canggan[2]); ?></span>
                <span><?php echo ($canggan[3]); ?></span>
            </li>
            <li>
                <span class="info_head ts-list m_ts_list">支神</span>
                <span><?php echo mb_substr($zhishen[0],0,2,'utf-8');?><br/><?php echo mb_substr($zhishen[0],2,2,'utf-8');?><br/><?php echo mb_substr($zhishen[0],4,2,'utf-8');?></span>
                <span><?php echo mb_substr($zhishen[1],0,2,'utf-8');?><br/><?php echo mb_substr($zhishen[1],2,2,'utf-8');?><br/><?php echo mb_substr($zhishen[1],4,2,'utf-8');?></span>
                <span><?php echo mb_substr($zhishen[2],0,2,'utf-8');?><br/><?php echo mb_substr($zhishen[2],2,2,'utf-8');?><br/><?php echo mb_substr($zhishen[2],4,2,'utf-8');?></span>
                <span><?php echo mb_substr($zhishen[3],0,2,'utf-8');?><br/><?php echo mb_substr($zhishen[3],2,2,'utf-8');?><br/><?php echo mb_substr($zhishen[3],4,2,'utf-8');?></span>
            </li>
            <li>
                <span class="info_head">纳音</span>
                <span><?php echo ($sizhuny[0]); ?></span>
                <span><?php echo ($sizhuny[1]); ?></span>
                <span><?php echo ($sizhuny[2]); ?></span>
                <span><?php echo ($sizhuny[3]); ?></span>
            </li>
            <li>
                <span class="info_head">地势</span>
                <span><?php echo ($bzdishi[0]); ?></span>
                <span><?php echo ($bzdishi[1]); ?></span>
                <span><?php echo ($bzdishi[2]); ?></span>
                <span><?php echo ($bzdishi[3]); ?></span>
            </li>
        </ul>
        <div class="main_info">
            <ul class="if_ul">
                <li>
                    <div class="m_w_bai"><span>旺相休囚死: </span><?php echo ($wxsqs); ?></div>
                </li>
                <!--<li>-->
                    <!--<div><span>喜用神：</span>&lt;!&ndash;{$xiys}&ndash;&gt;</div>-->
                <!--</li>-->
                <li class="lis3">
                    <div><span>胎元：</span><?php echo ($taiyuan); ?></div>
                    <div><span>日空：</span><?php echo ($rikong); ?></div>
                </li>
                <li>
                    <div class="ts_a"><span><?php echo mb_substr($jieqiname,0,3,'utf-8');?></span><?php echo mb_substr($jieqiname,3,18,'utf-8');?></div>
                    <div class="ts_a"><span>起大运：</span>出生后<?php echo ($dayunx); ?>年<?php echo abs($dayuny);?>月起大运</div>
                </li>
            </ul>
            <dl>
                <dt>大运</dt>
                <dd>
                    <div class="num">
                        <span><?php echo ($dayun+1); ?></span>
                        <span><?php echo ($dayun+11); ?></span>
                        <span><?php echo ($dayun+21); ?></span>
                        <span><?php echo ($dayun+31); ?></span>
                        <span><?php echo ($dayun+41); ?></span>
                        <span><?php echo ($dayun+51); ?></span>
                        <span><?php echo ($dayun+61); ?></span>
                        <span><?php echo ($dayun+71); ?></span>
                    </div>
                    <div class="word">
                        <span><?php echo mb_substr($dayungz[0],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[0],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[1],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[1],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[2],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[2],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[3],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[3],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[4],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[4],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[5],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[5],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[6],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[6],1,1,'utf-8');?></span>
                        <span><?php echo mb_substr($dayungz[7],0,1,'utf-8');?><br><?php echo mb_substr($dayungz[7],1,1,'utf-8');?></span>
                    </div>
                </dd>
            </dl>
        </div>
    </section>
    <footer class="ft_sever">
        <div class="btn_box">
            <a href="<?php echo U('Index/bz_fenxi','',false);?>" class="znfx_btn">智能分析</a>
            <a  class="dsfx_btn" onclick="dashifx()">大师分析</a>
            <!--href="&lt;!&ndash;{:U('Index/end_pp','',false)}&ndash;&gt;"-->
        </div>
    </footer>
</body>
<script type="text/javascript" src="/bazipaipan/Public/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/bazipaipan/Public/js/html2canvas.js"></script>
<script src="/bazipaipan/Public/js/layer_mobile/layer.js"></script>
<script  type="text/javascript" >
    // 生成图片
    var value = sessionStorage.getItem("chufa");
    if(value==2){
    $(document).ready(function(){
            event.preventDefault();
            html2canvas($('.cent'), {
                allowTaint: true,
                taintTest: false,
                onrendered: function(canvas) {
                    canvas.id = "mycanvas";
                    // document.body.appendChild(canvas);
                    // 生成base64图片数据
                    var dataUrl = canvas.toDataURL();
                    var newImg = document.createElement("img");
                    newImg.setAttribute('id','imgLis');
                    newImg.src =  dataUrl;
                    newImg.crossOrigin = "Anonymous";
                    document.body.appendChild(newImg);
                    $('.fangda').css('display','block')
                    var imgsrc = $('#imgLis').attr('src');
                    $('#imgLis').css('display','none')
                        $.ajax({
                            type:'post',
                            url:"<?php echo U('Index/generateImg','',false);?>",
                            data:{imgsrc:imgsrc},
                            dataType:'text',
                            success: function (data) {
                                    sessionStorage.setItem("chufa", "1");
                                    javascript:location.reload();//刷新
                            },
                            error: function (msg) {
                                alert('图片加载失败');
                            }
                        });
            },  
        }); 
    });
    }
    // 大师分析
    var u = navigator.userAgent;
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    var valuedsfx= sessionStorage.getItem("dashifx");
    if(valuedsfx==1){
        sessionStorage.setItem("dashifx", "0");
        dashifx();
    }
    function dashifx(){
        if(value==2){
            sessionStorage.setItem("dashifx", "1");
            layer.open({
                type: 2
                ,content: '请等待图片加载'
            });
            exit;}

        $.ajax({
            type: 'post',
            url: "<?php echo U('Index/fenxiang','',false);?>",
            data: {imgsrc: 1},
            dataType: 'text',
            success: function (data) {
            }
        });

        if(isiOS){
            window.webkit.messageHandlers.askques.postMessage("{\"askUserRq\":\"阳历<?php echo (cookie('zyangli')); ?>\"," +
            "\"askUserRq1\":\"<?php echo ($zymh); ?>\"," +
            "\"askUserSex\":\"<?php echo (cookie('zsex')); ?>\"," +
            "\"askUserName\":\"<?php echo (cookie('znickname')); ?>\"," +
            "\"city\":\"<?php echo (cookie('placebirth')); ?>\"," +
            "\"asktype\":\"12\"," +
            "\"typename\":\"八字命盘\"," +
            "\"description\":\"试着将问题尽可能清晰、详尽地描述出来，这样大师们才能更完整、更高质量的为您解答。(非必填)暂不支持emoji表情发布提问\"," +
            "\"photourl\":'<?php echo (cookie('imageaddpp')); ?>'}");
        }else{
            android.askques("{\"askUserRq\":'阳历<?php echo (cookie('zyangli')); ?>'," +
            "\"askUserRq1\":\"<?php echo ($zymh); ?>\"," +
            "\"askUserSex\":'<?php echo (cookie('zsex')); ?>'," +
            "\"askUserName\":'<?php echo (cookie('znickname')); ?>'," +
            "\"city\":'<?php echo (cookie('placebirth')); ?>'," +
            "\"asktype\":'12'," +
            "\"typename\":'八字命盘'," +
            "\"description\":'试着将问题尽可能清晰、详尽地描述出来，这样大师们才能更完整、更高质量的为您解答。(非必填)暂不支持emoji表情发布提问'," +
            "\"photourl\":'<?php echo (cookie('imageaddpp')); ?>'}");
        }
    }
</script>
</html>