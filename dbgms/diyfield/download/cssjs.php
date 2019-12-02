<style type="text/css">
.dbg_diyfield_down {
	position: relative;
}

.dbg_diyfield_down_value {
	width: 350px;
	height: 18px;
	padding: 3px 0 1px 3px;
	border: 1px solid #ccc;
	border-color: #aaa #ccc #ccc #aaa;
	background: #fff;
	color: #222;
	float: left;
}

.dbg_diyfield_down .btns {
	float: left;
	width: 50px;
	height: 23px;
	position: relative;
	margin-left: 6px;
	overflow: hidden;
}

.dbg_diyfield_down .btns input {
	position: absolute;
	font-size: 53px;
	left: -90px;
	top: -30px;
	filter: alpha(opacity = 0);
	opacity: 0;
}

.dbg_diyfield_down .btns button {
	border-style: solid;
	border-width: 1px;
	cursor: pointer;
	overflow: hidden;
	width: 50px;
	text-align: center;
	height: 23px;
	background: #C8CFDA;
	border: 1px solid #5E718C;
}

.dbg_diyfield_down .frr {
	float: left;
	margin-left: 6px;
	margin-top: 4px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {  
dbgmsLoadCssJs("ui/js/jquery-form.js", "js");
/* (dbg自定义字段插件-文件)=== 上传按钮 */
var down_uploadbtn_obj = $(this).find('input.dbg_diyfield_down_upload');/* 上传按钮对象 */
var down_upload_data_obj = $(this).find('input.dbg_diyfield_down_data');/* 上传按钮对象 */
var down_uploadform = down_upload_data_obj.attr('data-form');
console.log($('.diyfield_input_file'),down_uploadform);
var down_field_obj = $(this).find('input.dbg_diyfield_down_value');/* 图片路径存储对象 */
var down_uploadurl =down_upload_data_obj.attr('data-url');
    down_uploadbtn_obj.off('change').on('change',function(ev){
	 /* 防止链接打开 URL */
	 ev.preventDefault();
	  $('#'+down_uploadform).ajaxSubmit({
	     url:down_uploadurl+'&use=download' ,// 后台的处理，也就是form里的action
	     type:"POST",
	     dataType:"json",
	     success :function(data){
		      if(data.type=="ok"){
		    	  down_field_obj.val(data.info); 
	          }else {
			      alert('上传失败~');
			  }
	     }
	   });
	 return false; /* 重要的！---总是返回false，以防止标准的浏览器提交和页面导航 为了防止刷新 */
	});
});
</script>
