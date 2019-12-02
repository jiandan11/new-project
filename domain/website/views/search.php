<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title></title>
<link href="<?php echo base_url()?>ui/so/css/search.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url()?>ui/so/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>ui/so/js/cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>ui/so/js/search_common.js"></script>
</head>
<body>
<?php if($act == 'result'):?>
 <div class="clr sr_body sr_list">
  <div class="sr_main">
   <div class="sr_head">
    <div class="l" id="search">
     <a href="<?php echo base_url();?>">首页</a>
<?php $_navs =getNavs(); foreach ($_navs as $val):?>
 -<a href="<?php echo $val['link']?>"> <?php echo $val['name']?></a>
<?php endforeach;?>
    </div>
    <div class="r"></div>
   </div>
   <div class="wrap sr_logo">
    <a href="<?php echo base_url();?>" class="l" style="margin-top: 30px;"><img src="<?php echo base_url()?>ui/so/images/logo.gif" width="181" height="67"></a>
    <div class="l">
     <div class="sr_frm_box">
      <form name="search" method="get">
       <div class="sr_frmipt">
        <input type="hidden" name="columnid" value="">
        <!--  -->
        <input type="text" name="keyword" class="ipt" id="q" value="<?php echo $keyword;?>">
        <div class="sp" id="aca">▼</div>
        <input type="submit" class="ss_btn" value="搜 索">
       </div>
      </form>
      <div id="sr_infos" class="wrap sr_infoul"></div>
     </div>
     <div class="jg">获得约 <?php echo count($_so_list);?>条结果 （用时0.13 秒）</div>
    </div>
   </div>
   <div class="fn-clear"></div>
   <div class="brd1s"></div>
   <div class="wrap sr_lists">
    <div class="l">
     <div>
      <span>网页结果</span>
      <ul>
       <li><a href="###" class="ac">全部</a></li>
       <li><a href="###">新闻</a></li>
       <li><a href="###">产品</a></li>
      </ul>
     </div>
     <div>
      <span>按时间搜索</span>
      <ul>
       <li><a href="###" class="ac">全部时间</a></li>
       <li><a href="###">一天内</a></li>
       <li><a href="###">一周内</a></li>
       <li><a href="###">一月内</a></li>
       <li><a href="###">一年内</a></li>
      </ul>
     </div>
     <div class="bgno">
      <span>搜索历史</span>
      <ul id="history_ul">
      </ul>
     </div>
    </div>
    <div class="c wrap">
     <ul class="wrap">
<?php foreach ($_so_list as $val):?>
     <li class="wrap">
       <div>
        <h5>
         <a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>">
  <?php echo str_replace($keyword,'<font color="red">'.$keyword.'</font>',$val['title']);?>
         </a>
        </h5>
        <p><?php echo $val['description'];?></p>
       </div>
       <div class="adds">发布时间：<?php echo date("Y-m-d H:i:s",$val['intime']);?></div>
      </li> 
  <?php endforeach;?>
     </ul>
     <div id="pages" class="text-c mg_t20"></div>
    </div>
   </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url()?>ui/so/js/search_history.js"></script>
 </div>
<?php else:?>
 <div class="clr sr_body">
  <div class="sr_main">
   <div class="sr_head">
    <div class="l" id="search">
     <a href="<?php echo base_url();?>">首页</a>
<?php $_navs =getNavs(); foreach ($_navs as $val):?>
 -<a href="<?php echo $val['link']?>"> <?php echo $val['name']?></a>
<?php endforeach;?>
    </div>
    <div class="r"></div>
   </div>
   <div class="sr_logo">
    <a href="###"><img src="<?php echo base_url()?>ui/so/images/logo.gif" width="181" height="67"></a>
   </div>
   <form name="search" method="get">
    <input type="hidden" name="columnid" value="">
    <div class="sr_frm">
     <div class="sr_frm_box">
      <div class="sr_frmipt">
       <input type="text" name="keyword" id="q" class="ipt">
       <div class="sp" id="aca">▼</div>
       <input type="submit" class="ss_btn" value="搜 索">
      </div>
     </div>
     <div id="sr_infos" class="wrap sr_infoul"></div>
    </div>
   </form>
   <script>
<!--
$(document).ready(function(){
 $("#q").focus();
}); 
//-->
</script>

  </div>
 </div>
<?php endif;?>
 <div class="dbgms_user_footer">
  <a href="#">网站推广</a> | <a href="#">网站建设</a> | <a href="http://www.dbgms.cn" target="_blank">版权声明</a> | <a href="http://www.soacme.com" target="_blank">更多资讯</a> | <a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=team@dbgms.cn" target="_blank">意见反馈</a>
  <p class="cp">Powered by <strong><a href="http://www.dbgms.cn" target="_blank">DbgMs.cn</a></strong> <em>v2</em> © 2016
  </p>
 </div>
</body>
</html>