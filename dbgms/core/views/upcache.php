<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>内容模型_DbgMs管理系统</title>
<script type="text/javascript">var dbgms_root = '<?php echo $_dbgms_baseurl;?>';</script>
<script type="text/javascript" src="<?php echo base_url()?>ui/js/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>plugin/progressbar/style/style.css">
</head>
<body>
 <div style="width: 300px; float: left;">
  <button type="button" onClick="processerbar(3000)">上传</button>
  <!-- 父级元素 -->
  <div style="position: relative; margin: 10px; padding: 10px; width: 300px; height: 50px; background: #EEE;">
   <!-- 进度条 -->
   <div class="barline" id="probar">
    <div id="percent"></div>
    <div id="line" w="100" style="width: 0px;"></div>
    <div id="msg" style=""></div>
   </div>
  </div>

  <script language="javascript">
function processerbar(time){
     document.getElementById('probar').style.display="block";
	$("#line").each(function(i,item){
		var a=parseInt($(item).attr("w"));
		$(item).animate({
			width: a+"%"
		},time);
	});
   var si = window.setInterval(
	function(){
		a=$("#line").width();
		b=(a/200*100).toFixed(0);
		document.getElementById('percent').innerHTML=b+"%";
// 		document.getElementById('percent').style.left=a-12+"px";
		document.getElementById('msg').innerHTML="上传中";
		if(document.getElementById('percent').innerHTML=="100%") {
		clearInterval(si);
		document.getElementById('msg').innerHTML="&nbsp;&nbsp;成功";
		}
	},70);
};
</script>
 </div>
 <!-- 案例1 -->
 <div style="width: 300px; float: left;"></div>
 <!-- 案例3 -->
 <div style="width: 300px; margin-left: 300px; float: left;">
  <link rel="stylesheet" type="text/css" href="css/default.css">
  <br>
  <article class="htmleaf-container">
   <div class="htmleaf-content">
    <svg id="container"></svg>
   </div>
  </article>

  <script type="text/javascript" src="<?php echo base_url()?>plugin/progressbar/style3/jquery.progress.js"></script>
  <script type="text/javascript">
  var jintu = 20;
  var progress = $("#container").Progress({
 percent: jintu,
 width: 180,
 height: 40,
 fontSize: 16
  });
  setTimeout(function(){
	  jintu+= 50;
     progress.percent(jintu);
  }, 500);
  setTimeout(function(){
	  jintu+= 50;
     progress.percent(jintu);
     if(jintu>=100){
		  setTimeout(function(){
// 	     $("#container").hide();
	  }, 2500);
	  }
  }, 1000);
  
</script>
 </div>
 <!-- 案例4 -->
 <div>
  <link type="text/css" href="<?php echo base_url()?>plugin/progressbar/style4/css/jquery.spider.disk.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url()?>plugin/progressbar/style4/js/jquery.spider.disk.js"></script>
  <script type="text/javascript">
var data1={total:'1T',users:'500G',peruser:'50%',disks:[
{id:'10000',name:'进度条：/',value:'50',total:'500G'},
{id:'10001',name:'D：/',value:'20',total:'500G'} ]}; 

var data2={total:'1T',users:'500G',peruser:'50%',disks:[
{id:'10000',name:'进度条：/',value:'90',total:'500G'},
{id:'10001',name:'D：/',value:'20',total:'500G'}  ]}; 


$(document).ready(function(){
 refresh(data1);
});
function refresh(data){
 $("#disk_a").disk("poll1",{
  title:'硬盘使用情况',
  //titleColor:'#ff6600',
  width:'100%',
  data:data
 }); 
}
</script>
  <div class="formbody">
   <div id="disk_a"></div>
  </div>
  <!--demo end-->
  <br /> <br />
  <div style="text-align: center">
   <input type="button" value="刷新查看效果" onclick="refresh(data2);">
  </div>
 </div>