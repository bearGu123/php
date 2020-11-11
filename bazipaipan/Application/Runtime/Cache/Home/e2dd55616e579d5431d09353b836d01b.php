<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>资料信息</title>
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
        a,span{ -webkit-tap-highlight-color: transparent;}
        .usermsg_title{font-size:0.28rem;color:#8d8d93;padding:0.26rem 0 0.3rem;text-align: center;}
        .user_ul{padding:0 0.24rem;list-style: none;}
        .user_ul li{height:1.2rem;border:1px solid #db4852;padding:0 0.22rem 0 0.3rem;margin-bottom: 0.2rem;border-radius: 0.1rem;line-height: 0.6rem;}
        .user_ul li p{display: flex;justify-content:space-between;align-items: center;}
        .del{
            width:1.3rem;
            height:0.44rem;
            background-color:#ffffff;
            border:2px solid #f44e4d;
            border-radius: 0.22rem;
            color:#f44e4d;
            display: inline-block;
            font-size:0.24rem;
            line-height: 0.34rem;
            text-align: center;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        .set_mo{
            width:1.3rem;
            height:0.44rem;
            background-color:#f44e4d;
            border-radius: 0.22rem;
            color:#ffffff;
            display: inline-block;
            font-size:0.24rem;
            line-height: 0.44rem;
            text-align: center;
        }
        .moren{
            width:1.3rem;
            height:0.44rem;
            background-color:#cfcfcf;
            border-radius: 0.22rem;
            color:#ffffff;
            display: inline-block;
            font-size:0.24rem;
            line-height: 0.44rem;
            text-align: center;
        }
        .btn_box{padding:0 0.24rem;}
        .apend{
            width:100%;
            height: 0.8rem;
            line-height: 0.8rem;
            background-color:#f44e4d;
            text-align: center;
            display: block;
            color:#ffffff;
            text-decoration: none;
        }
        a{display: block;}
    </style>
</head>
<body>
    <p class="usermsg_title">请选择需要的八字排盘人信息</p>
    <ul class="user_ul">
        <?php if(is_array($arrdata)): foreach($arrdata as $key=>$value): if($value['status'] == 0): ?><li>
                    <p><span><?php echo ($key); ?>. <?php echo ($value['username']); ?>    ID:<?php echo ($value['id']); ?></span><span><?php if($value['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?></span><span></span><a
                            href="<?php echo U('Index/moren','',false);?>?id=<?php echo ($value['id']); ?>"><span class="set_mo" >设为默认</span></a></p>
                    <p><span><?php if($value['datatype'] == 0): ?>阳历<?php else: ?>阴历<?php endif; ?> <?php echo ($value['birthday1']); ?> <?php echo ($value['birthday2']); ?>时</span><span class="del">删除</span></p>
                    <span style="display:none;" class="sid"><?php echo ($value['id']); ?></span>
                </li>
                <?php else: ?>
                <li>
                    <p><span><?php echo ($key); ?>. <?php echo ($value['username']); ?>    ID:<?php echo ($value['id']); ?></span><span><?php if($value['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?></span><span></span><span class="set_mo moren" >已设默认</span></p>
                    <p><span><?php if($value['datatype'] == 0): ?>阳历<?php else: ?>阴历<?php endif; ?> <?php echo ($value['birthday1']); ?> <?php echo ($value['birthday2']); ?>时</span><span class="del">删除</span></p>
                    <span style="display:none;" class="sid"><?php echo ($value['id']); ?></span>
                </li><?php endif; endforeach; endif; ?>
    </ul>
    <div class="btn_box"><a href="<?php echo U('Index/index','',false);?>" class="apend"><span class="jia_icon"></span>新增排盘人信息</a></div>
    <script src="/bazipaipan/Public/js/layer_mobile/layer.js"></script>
    <script src="/bazipaipan/Public/js/jquery-1.8.3.min.js"></script>
    <script>
        var odel = document.getElementsByClassName('del');
        var oset_mo = document.getElementsByClassName('set_mo');
        $('.del').click(function(){
            var index=$('.del').index(this);
            var sid=$('.sid').eq(index).text();
            sessionStorage.setItem("sid",sid);
        });
        for(let i=0;i<odel.length;i++){
            odel[i].onclick=function(){
                let del = this.parentNode.parentNode;
                layer.open({
                    content: '是否删除该用户：'+del.children[0].firstChild.innerHTML+'<br>删除后此用户的付费信息将会被清空!'
                    ,btn: ['删除', '取消']
                    ,skin: 'center'
                    ,yes: function(index){
                    layer.open({content: '删除成功'},
                            $.getJSON("<?php echo U('Index/delete','',false);?>",{sid:sessionStorage.getItem("sid")},function(data){
                            }),
                        del.parentNode.removeChild(del))
                        setTimeout(function(){
                            javascript:location.reload();//刷新
                        },2000);
                    }
                });
                event.stopImmediatePropagation();
            }
        };
        for(let i=0;i<oset_mo.length;i++){
            oset_mo[i].onclick = function(){
                for(let i=0;i<oset_mo.length;i++){
                    oset_mo[i].classList.remove('moren')
                    oset_mo[i].innerHTML = "设为默认";
                }
                this.classList.add('moren');
                this.innerHTML = '已设默认';
                 //提示
                layer.open({
                    content: '设置默认成功'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                event.stopImmediatePropagation();
            }
        }
        var oli = document.querySelectorAll('li');
        for(let i=0;i<oli.length;i++){
            oli[i].onclick = function(){
                var sid=$('.sid').eq(i).text();
                document.location.href="<?php echo U('Index/moren','',false);?>?moren=1&id="+sid;
            }
        }

    </script>
</body>
</html>