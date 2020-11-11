<?php
namespace Library;
class verify{
    /*
     初始化参数
     */
    public $config = array(
         'width'=>100, //宽
         'height'=>25,//高
         'fontsize'=>15,//字体大小
         'fontfamily'=>"./public/font/STXIHEI.TTF",//字体文件
         'start'=>10, //文字起始
         'ystart'=>20,
         'step'=>20, //步进
         'pixels'=>100 //像素点的个数
    );


    public function __construct($arr=null){//重新初始化
        if(is_array($arr)){
            foreach($arr as $key=>$value){
               if(array_key_exists($key,$this->config)){
                   $this->config[$key] = $value;
               }
            }
        }
    }


    public function getData(){  //从数组中随机返回数据
        $arr1 = range(0,9);
        $arr2 = range('a','z');
        $arr3 = range('A','Z');
        $arr4 = array_merge($arr1,$arr2,$arr3);
        $charData = $arr4[array_rand($arr4)];
        return $charData;
    }


    public function code(){  //GD库输出验证码
        header("content-type:image/png");
        $resData = imagecreate($this->config['width'],$this->config['height']);
        //给画布分配颜色
        imagecolorallocate($resData,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        //给文字的颜色
        $white = imagecolorallocate($resData,mt_rand(100,199),mt_rand(100,199),mt_rand(100,199));
        $strData="";
        for($i=0;$i<4;$i++){
            $charData = $this->getData();
            $strData.=$charData;
            //画文字
            imagettftext($resData,$this->config['fontsize'],mt_rand(-40,40),$this->config['start'],$this->config['ystart'],$white,$this->config['fontfamily'], $charData);
            $this->config['start']+=$this->config['step'];
            if($i>0){
                $linecolor = imagecolorallocate($resData,mt_rand(100,199),mt_rand(100,199),mt_rand(100,199));
                imageline($resData,mt_rand(0,$this->config['width']/3),mt_rand(0,$this->config['height']),mt_rand($this->config['width']*2/3,$this->config['width']),mt_rand(0,$this->config['height']),$linecolor);
            }
        }
        $_SESSION['yzm'] = $strData;
        //干扰点
        for($j=0;$j<$this->config['pixels'];$j++){
            $linecolor = imagecolorallocate($resData,mt_rand(100,199),mt_rand(100,199),mt_rand(100,199));
            imagesetpixel($resData,mt_rand(0,$this->config['width']),mt_rand(0,$this->config['height']),$linecolor);
        }
        //输出画布
        imagepng($resData);
    }
}