<?php
namespace Library;
class page{
  public $total;//总数
  public $show;//显示条数
  public $pagenmus;//页数
  public $currentpage;//当前页
  public $start;//初始位置
  
  public function __construct($total,$show){
      $this->total=$total;
      $this->show=$show;
      $this->pagenmus=ceil($this->total/$this->show);
      $this->currentpage=empty($_REQUEST['page'])?1:$_REQUEST['page'];
      $this->start=($this->currentpage-1)*$this->show;
  }
  public function showpage($contion=null){
  	$strdata="当前".$this->currentpage."/".$this->pagenmus."&nbsp;&nbsp;";
  	$strdata.="<a href='?page=".$this->prepage($this->currentpage).$contion."'>上一页</a>&nbsp;&nbsp;";
  	$strdata.="<a href='?page=".$this->nextpage($this->currentpage).$contion."'>下一页</a>&nbsp;&nbsp;";
  	$strdata.="<a href='?page=1".$contion."'>首页</a>&nbsp;&nbsp;";
  	$strdata.="<a href='?page=".$this->pagenmus.$contion."'>尾页</a>&nbsp;&nbsp;";
  	return $strdata;
  }
  public function prepage($page){
    if($page<=1){
        return 1;
    }else{
    	return $page-1;
    }
  }
  public function nextpage($page){
  	 if($page>=$this->pagenmus){
          return $this->pagenmus;
  	 }else{
  	 	return $page+1;
  	 }
  }

}
