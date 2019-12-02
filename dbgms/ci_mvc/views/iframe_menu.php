<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo $_dbgms_init['base']['title'];?> - DbgMs管理系统</title>
<meta name="description" content="Dbg Ms -第八感管理系统,该系统整合 cms,crm用户管理,微信接口开发,erp,权限管理等,功能全面,适合各种网站的开发与拓展!" />
<meta name="keywords" content="dbgms,第八感,管理系统,cms,crm,erp,微信开发,用户管理,权限管理" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo $_dbgms_baseurl;?>favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_dbgms_baseurl;?>ui/css/dbgms.frame.css" />
<script type="text/javascript" src="<?php echo $_dbgms_baseurl;?>ui/js/jquery.min.js"></script>
<script type="text/javascript">var dbgms_root = '<?php echo $_dbgms_baseurl;?>';</script>
<script type="text/javascript" src="<?php echo $_dbgms_baseurl;?>ui/js/dbgms.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_dbgms_baseurl?>plugin/powerFloat/style.css" />
<script type="text/javascript" src="<?php echo $_dbgms_baseurl?>plugin/powerFloat/powerFloat.js"></script>
<!-- 图标网址 http://www.bootcss.com/p/font-awesome/#icons-web-app -->
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>plugin/FontAwesome/font-awesome.min.css">
</head>
<body>
 <!-- dbgms_nouth -->
 <div class="dbg_nouth">
  <div class="dbg_nouth_logo">
   <img src="<?php echo $_dbgms_baseurl;?>ui/images/dbgms_logo.jpg" width="200" height="50">
  </div>
  <ul class="dbg_nouth_nav" id="nav">
   <li onclick="menu('menu_common')"><a target="main" class="selected" href="<?php echo $_dbgms_url;?>index/cms?con=content&modelid=1">首页</a></li>

<?php foreach ($_dbgms_menu['head'] as $val):?>
   <li onclick="menu('menu_<?php echo $val['sign'];?>')"><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
<?php endforeach;?>


  <li ><a target="main"  href="http://49.235.83.110/baiduMap/map.html">百度地图</a></li>



  </ul>
  <div class="dbg_nouth_set" style="padding-right: 100px;"></div>
  <div class="dbg_nouth_set" id="dbg_user">
      【 <?php echo $_dbgms_admin['name'];?> 】&nbsp;<span class="icon icon-sort-down"></span>
  </div>
  <div class="dbg_nouth_set" id="dbg_clear">
   清除缓存&nbsp;<span class="icon icon-sort-down"></span>
  </div>
  <div class="dbg_nouth_set" id="dbg_site">
   <a href="<?php echo $_baseurl;?>" style="color: #fff;" target="_blank">访问站点</a>&nbsp;<span class="icon icon-sort-down"></span>
  </div>
 </div>
 <!-- dbgms_west -->
 <div class="dbg_west" id="dbg_west">
  <div class="dbg_west_menu dwmicon" id="menu_common">
   <div>常用操作</div>
   <ul class="dbg_west_list">
<?php foreach($_dbgms_menu['content'] as $val):?>
<li><a target="main" href="<?php echo $val['link'];?>" <?php echo $val['id']==1?'class="selected"':""; ?>><?php echo $val['name'];?></a></li>
<?php endforeach;?> 
  <li><div style="border: none;">---</div></li>
<?php foreach($_dbgms_menu['home'] as $val):?>
<li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
<?php endforeach;?>   
    </ul>
  </div>

  <!-- cms -->
  <div class="dbg_west_menu dwmicon" id="menu_cms" style="display: none;">
   <div>内容相关</div>
   <ul class="dbg_west_list">
	<?php foreach($_dbgms_menu['content'] as $val):?>
	<li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
	<?php endforeach;?>
    <li><div style="border: none;">---</div></li>
	<?php foreach($_dbgms_menu['cms'] as $val):?>
	<li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
	<?php endforeach;?>
   </ul>
  </div>

  <!-- base -->  
<?php if(!empty($_dbgms_menu['base'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_base" style="display: none;">
   <div>基本设置</div>
   <ul class="dbg_west_list">
 <?php foreach($_dbgms_menu['base'] as $val):?>
 <li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
 <?php endforeach;?>  
   </ul>
  </div>
<?php endif;?>
  
  <!-- form -->  
<?php if(!empty($_dbgms_menu['form'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_form" style="display: none;">
   <div>前端表单管理</div>
   <ul class="dbg_west_list">
    <?php foreach($_dbgms_menu['form'] as $val):?>
    <li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
    <?php endforeach;?>
    <div>==表单数据管理==</div>
    <?php foreach($_dbgms_menu['formtable'] as $val):?>
    <li><a target="main" href="index/form?con=formdatamanage&rfid=<?php echo $val['rfid'];?>"><?php echo $val['rfname'];?></a></li>
    <?php endforeach;?> 
   </ul>
  </div>
<?php endif;?>

  <!-- erp -->  
<?php if(!empty($_dbgms_menu['erp'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_erp" style="display: none;">
   <div>ERP管理</div>
   <ul class="dbg_west_list">
 <?php foreach($_dbgms_menu['erp'] as $val):?>
 <li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
 <?php endforeach;?>  
   </ul>
  </div>
<?php endif;?>

  <!-- live -->
<?php if(!empty($_dbgms_menu['live'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_live" style="display: none;">
   <div>直播管理</div>
   <ul class="dbg_west_list">
 <?php foreach ($_dbgms_menu['live'] as $val):?>
 <li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
 <?php endforeach;?>   
   </ul>
  </div>
<?php endif;?>

  <!-- member -->
<?php if(!empty($_dbgms_menu['member'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_member" style="display: none;">
   <div>会员管理</div>
   <ul class="dbg_west_list">
 <?php foreach($_dbgms_menu['member'] as $val):?>
 <li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
 <?php endforeach;?>  
   </ul>
  </div>
<?php endif;?>

  <!-- tool -->
<?php if(!empty($_dbgms_menu['tool'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_tool" style="display: none;">
   <div>功能插件</div>
   <ul class="dbg_west_list">
	<?php foreach ($_dbgms_menu['tool'] as $val):?>
	<li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
	<?php endforeach;?>   
   </ul>
  </div>
<?php endif;?>

  <!-- weixin -->
<?php if(!empty($_dbgms_menu['weixin'])):?>
  <div class="dbg_west_menu dwmicon" id="menu_weixin" style="display: none;">
   <div>微信管理</div>
   <ul class="dbg_west_list">
 <?php foreach ($_dbgms_menu['weixin'] as $val):?>
 <li><a target="main" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
 <?php endforeach;?>   
   </ul>
  </div>
<?php endif;?>

 </div>
 <!-- dbgms_main -->
 <div class="g-mn" id="dbg_main">
  <iframe src="<?php echo $_dbgms_url;?>index/cms?con=content&model=1" name="main" id="dbgmsiframe" width="100%" height="100%" frameborder="0"></iframe>
 </div>
 <?php if($_dbgms_admin['openqq']==1):?>
 <!-- 在线客服 -->
 <div id="floatTools" class="frame-service">
  <div class="floatL">
   <a style="display: block" id="aFloatTools_Show" class="btnOpen" title="查看在线客服" href="javascript:void(0);" onClick="$('#divFloatToolsView').show(500);$('#aFloatTools_Show').attr('style','display:none');$('#aFloatTools_Hide').attr('style','display:block');">展开</a> <a style="display: none" id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" href="javascript:void(0);"
    onClick="$('#divFloatToolsView').hide(500);$('#aFloatTools_Show').attr('style','display:block');$('#aFloatTools_Hide').attr('style','display:none');">收缩</a>
  </div>
  <div id="divFloatToolsView" class="floatR" style="display: none">
   <div class="cn">
    <h3 class="titZx"></h3>
    <ul>
     <li><span>dbgms</span><a href="http://wpa.qq.com/msgrd?v=3&uin=240337740&site=qq&menu=yes" target="_blank">&nbsp;<img src="<?php echo $_dbgms_baseurl;?>ui/img/pa.jpg" width="74" height="24" alt="" /></a></li>
     <li></li>
     <li></li>
     <li></li>
    </ul>
   </div>
  </div>
 </div>
 <?php endif;?>
 <script type="text/javascript"> 
$(document).ready(function () {
	function fixHeight() {
	var headerHeight = $("#dbgmstop").height();
	    $("#dbgmsiframe").attr("height", $(window).height()-48 + "px");
	}
	$(window).resize(function () {
	     fixHeight();
	}).resize();

	//左边菜单选中
	$('.dbg_west_list li a').click(function() {
		$('.dbg_west_list li a').removeClass('selected');
	 	$('.dbg_west_list li').removeClass('selected');
	 	$(this).addClass('selected');
	});
	$('#nav li a').click(function() {
		$('#nav li a').removeClass('selected');
	 	$(this).addClass('selected');
	});
	$('#dbg_west').height($(window).height()-50);
});	
function menu(id){
	$('.dbg_west .dbg_west_menu').css("display","none");
	$('#'+id).css("display","block");
	$('.dbg_west .dbg_west_menu ul li a').removeClass('selected');
	$('#'+id +' ul li:first-child a').addClass('selected');
}
var navhref= new function(){};
var clear= new function(){};
var site= new function(){};
$(document).ready(function(){
  //处理样式
  window.onresize = function () {
    $('#dbg_west').height($(window).height()-50);
  }
  $("#dbg_user").powerFloat({
    reverseSharp:true,width: 100,
    targetMode : 'main',
	targetAttr : 'main',
    target: [
        {target:"main",href:"<?php echo $_dbgms_url;?>index/base?con=change",text:"修改资料"},
        {href:"javascript:dbgmsLoginOut('<?php echo $_dbgms_url;?>index/login/quit/');",text:"安全退出"}
    ],
    targetMode: "list"  
  });
  $("#dbg_site").powerFloat({
    reverseSharp:true,width: 120,
    target: [
      {href: "javascript:navhref('<?php echo DBG_SITEURL;?>');",text: "网站首页"},  
      {href: "javascript:navhref('<?php echo DBG_MOBILEURL;?>');",text: "手机站"}
    ],
        targetMode: "list"  
  });
  $("#dbg_clear").powerFloat({
    reverseSharp:true,width: 120,
    target: [
      {href: "javascript:clear('delfile')",text: "清除数据缓存"},
      {href: "javascript:clear('delhtml')",text: "清除静态缓存"},
      {href: "javascript:clear('deltemplate')",text: "清除模板缓存"},
      {href: "javascript:clear('delall')",text: "清除所有缓存"},
      {href: "javascript:createindex()",text: "生成首页"}
    ],
    targetMode: "list"  
  });
  window.navhref = function navhref(url) {
    window.open(url); 
  }
  window.clear = function clear(type){
    var ajaxurl="<?php echo $_dbgms_url;?>index/cms?do=do&use="+type;
 	if (confirm("确认清除？")) {
      $.ajax({
        url : ajaxurl,
        type : 'POST',
        async : false,
        success : function(result){ if(result==1){window.location.reload();}else{console.log('错误');} }
      });
    }
  }

  window.createindex = function createindex(type){
	  $('#DbgMsCreateHtml').attr('src', "<?php echo $_baseurl;?>zh?html=index");
	  setTimeout(function(){
		  $('#DbgMsCreateHtml').attr('src', "");
		  $('#DbgMsCreateHtml').html();
	  },1000);
  }
});
function dbgmsLoginOut(ajaxurl) {
   if (confirm("确认要退出系统？")) {
    $.ajax({
     url : ajaxurl,
     type : 'POST',
     async : false,
     success : function(result) {
      if (result == 1) {
       window.location.href = ajaxurl;
      }
     }
    });
   }
  } 
</script>
 <iframe style="display: none;" id="DbgMsCreateHtml" src=""></iframe>
</body>
</html>