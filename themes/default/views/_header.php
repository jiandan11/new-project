<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta property="qc:admins" content="20431000557642753636" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo $_seo['title']?></title>
<meta name="description" content="<?php echo $_seo['description']?>">
<meta name="keywords" content="<?php echo $_seo['keywords']?>">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>css/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo dbg_ui($_uipath,'css/dbgms.css,css/main.css');?>">
<script type="text/javascript">
     var defaultEncoding = "2";
     var translateDelay = "50";
     var cookieDomain = "";
     var msgToTraditionalChinese = "繁體中文";
     var msgToSimplifiedChinese = "简体中文";
     var translateButtonId = "GB_BIG";
</script>
<script src="<?php echo dbg_ui($_uipath,'js/jquery-1.7.2.min.js,js/dbgms.common.js');?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/dbgms.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery.smallslider.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery.cookie.js"></script>
<script type="text/javascript">
/*禁止右键*///window.onload = function (){var table = document.getElementById ('by');table.oncontextmenu = function () {return false;}}
</script>
</head>
<body>
 <!-- 通用头部-北部 -->
 <div class="dbgms_nouth_wrap">
  <div class="dbgms_nouth_hd_wrap">
   <div class="dbgms_nouth_hd">
    <ul class="nouth_left">
     <li><a href="<?php echo $_baseurl;?>" class="homepage">主页</a></li>
     <li>首页</li>
     <li>首页</li>
     <li><a href="#" class="homepage" onclick="setHomepage();">设为主页</a></li>
     <li><a id="GB_BIG" href="javascript:translatePage();">繁體中文</a></li>
    </ul>
    <script type="text/javascript">
					translateInitilization();
				</script>
    <div class="nouth_right">
<?php if(!empty($_my)):?>
<a class="nouth_login" href="<?php echo $_my['link'];?>"><?php echo $_my['name'];?>&nbsp;&nbsp;您好&nbsp;|&nbsp;个人中心</a> <a class="nouth_logout" onclick="dbgjs_passport('quit','<?php echo base_url()?>')">退出</a>
<?php else:?>
<a href="<?php echo $_baseurl?>passport/login" class="nouth_login">登录</a> <a href="<?php echo $_baseurl?>passport/register" class="nouth_logout">注册</a>
<?php endif;?>
    </div>
   </div>
  </div>

  <div class="dbgms_wrap">
   <div class="dbgms_nouth_logo">
    <img src="<?php echo $_uiurl;?>images/logo.gif">
   </div>
   <form id="DbgMsFormSo" name="DbgMsFormSo" target="_blank" action="<?php echo $_baseurl;?>so" method="get">
    <div class="dbgms_nouth_so_wrap">
     <select name="columnid" class="dbgms_nouth_so_span">
      <option value="0">全站</option>
     <?php  foreach ($_navs as $key=>$val):?>
      <option value="<?php echo $val['id']?>"><?php echo $val['name']?></option>
      <?php endforeach;?>
     </select> <input type="text" placeholder="请输入关键词" value="" name="keyword" class="dbgms_nouth_so_keywords">
     <!--  -->
     <input type="button" value="搜索" class="dbgms_nouth_so_submit">
    </div>
    <ul class="dbgms_nouth_so_result" id="DbgMsSoResult"></ul>
    <script type="text/javascript">
             $(document).ready(function(){
                 $(".nav_ul").find("a[href='"+window.location.pathname+"']").addClass("cur_a");
                 //console.log("path:"+window.location.pathname);
                 $(".dbgms_nouth_so_keywords").live("keyup",function(){
                     //$(".dbgms_nouth_so_keywords").removeClass("search_input_on");
                     //$(this).addClass("search_input_on");
                     kwd=$(this).attr("value");
                     col=$(this).attr("name");
                     if(kwd.length < 1){$("#DbgMsSoResult").html("").hide();return false};
                     tp=$(this).offset().top;
                     lft=$(this).offset().left;
                     ht=$(this).height();
                     wd=$(this).width()-4;
                     $("#DbgMsSoResult").stop(true); 
                     $("#DbgMsSoResult").css({"left":lft,"top":tp+ht,"width":wd}).html("loading...").show();
                     $.get("<?php echo $_baseurl;?>so/json",{columnid:1,keyword:kwd, col:col},function(result){
                         if(result.StatusCode==200){
                             html="";
                             for(var i in result.data){
                                 _title = result.data[i].title+" "+result.data[i].columnname;
                                 html+='<li mall_id="'+result.data[i].id+'"><a target="_blank" href="'+result.data[i].link+'"> '+_title+'</a></li>';
                             }
                             $("#DbgMsSoResult").html(html);
                         }else{
                             $("#DbgMsSoResult").html("无匹配记录").delay(2000).hide(0);
                         }
                     },"json");
                 });
                 $("#DbgMsSoResult li").live("click",function(){
                     $(".dbgms_nouth_so_keywords").attr("value",$(this).text())
                     $("#DbgMsSoResult").hide();
                 });

                 $(".dbgms_nouth_so_submit").click(function(){
                   if($(".dbgms_nouth_so_keywords").val()!=""){
                    document.DbgMsFormSo.submit();
                   } else{
                    $.msglayer("请输入关键词");}
                  });
                  $(".carNumber").text($.cookie("carNumber"));
             });
         </script>
   </form>
  </div>
 </div>
 <?php include '_nav.php';?>