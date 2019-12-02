<!--dbgms_comment_start-->
<!-- 弹出框 -->
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>ui/plugin/comment/comment.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>ui/plugin/comment/pagination.css">
<script src="<?php echo $_baseurl;?>ui/plugin/comment/comment.js"></script>
<script src="<?php echo $_baseurl;?>ui/plugin/comment/jquery.pagination.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>ui/plugin/dsdialog/css/dsdialog.css">
<script src="<?php echo $_baseurl;?>ui/plugin/dsdialog/dsdialog.js"></script>
<div class="dbgms_comment_wrap">
 <div class="comment_wrap">
  <div class="comment_title">
   <span class="hot">热门评论</span>
  </div>
  <div class="clear"></div>
  <div class="comment_list">
   <ul id="CommentListUl">
    <li><p>暂无信息</p></li>
   </ul>
  </div>
  <div class="clear"></div>
  <div id="Pagination" class="flickr"></div>
  <div class="clear"></div>
  <div class="comment_report">
<?php if($is_comment):?>
<?php endif;?>
  <form method="post" id="DbgMsFormComment" onsubmit="javascript:return false;">
    <!--  -->
    <input type="hidden" value="<?php echo $_channel['model']?>" name="form_modelid">
    <!--  -->
    <input type="hidden" value="<?php echo $_channel['id']?>" name="form_columnid">
    <!--  -->
    <input type="hidden" value="<?php echo $_content['id']?>" name="form_contentid"><input type="hidden" value="1" name="form_page" id="form_page">
    <div class="comment_report_img">
     <img src="<?php echo $_baseurl;?>ui/plugin/comment/images/user.png" width='36' height='36'>
    </div>
    <div class="comment_report_form">
     <div class="comment_report_textarea">
      <!-- 暂时关闭表情评论 -->
      <!--<div class="input disscussComment" contenteditable="true"   name="saytext2dis54" onfocus="if (value =='请输入您的评论~'){value=''}" onblur="if (value ==''){value='请输入您的评论~'}">请输入您的评论~</div>
      -->
      <textarea name="form_content" id="CommentContent" placeholder="请输入您的评论~ "></textarea>
     </div>
     <div class="comment_report_toolbar">
      <div class="comment_report_toolbar1">
       <div class="comment_report_feeling">
        <a class="comment_report_feelingimg" id="CommentQqIcon" title="插入表情"></a>
       </div>
      <?php if($is_comment_captcha):?>
      <?php endif;?>
      <div class="comment_report_code">
        <span>验证码:</span><span> <input id="CommentCaptcha" name="form_captcha" type="text" size=6 maxlength=4 class="input"> <img id="CommentCaptchaImg" alt="验证码,看不清楚?请点击刷新验证码" title="验证码,看不清楚?请点击刷新验证码" height="24"></span>
       </div>
      </div>
      <div class="comment_report_toolbar2">
       <button onclick="dbgmsComment('set')" class="comment_button" type="submit">发布评论</button>
       <!-- <input style="cursor: pointer;" value='发布评论' onclick='discussOperate()' class="comment_button" type="button" > -->
      </div>
     </div>
    </div>
   </form>

   <script type='text/javascript'>
/********* 初始化评论内容 *************/
var p = 0;     //页面索引初始值  
var pageSize = 2;     //每页显示条数初始化，修改显示条数，修改这里即可 
var DbgMsFormComment = $("#DbgMsFormComment");   //表单序列化所用
var pagetotal = 0;
var commonurl = '<?php echo $_baseurl;?>';
var toolurl = '<?php echo $_baseurl?>ui/plugin/comment';
var CommentCaptchaImgObj;
var CommentCaptchaObj;
		$(document).ready(function(){
			CommentCaptchaImgObj = $('#CommentCaptchaImg');
			CommentCaptchaImgObj.on('click',function(){
            	$('input[name=form_captcha]').val('');
                this.src = commonurl+'common/checkyzm/comment?t='+(new Date().getTime());
            });
			CommentCaptchaImgObj.trigger('click');
// 			$('#CommentQqIcon').qqFace({
// 				  assign:'CommentContent', //给那个控件赋值
// 				  path:toolurl+'/qqface/' //表情存放的路径
//      	 });
		    dbgmsComment('get',0);    //Load事件，初始化表格数据，页面索引为0（第一页）  
		});
        function setpagebreak(total,p){
            if(p<=1){
            	p=1;
            }
        	//分页，PageCount是总条目数，这是必选参数，其它参数都是可选  
        	 $("#Pagination").pagination(total, {  
 	            callback: PageCallback,  
 	            prev_text: '上一页',       //上一页按钮里text  
 	            next_text: '下一页',       //下一页按钮里text  
 	            items_per_page: pageSize,  //显示条数  
 	            num_display_entries: 6,    //连续分页主体部分分页条目数  
 	            current_page: p,           //当前页索引  
 	            num_edge_entries: 2,        //两侧首尾分页条目数  
 	        });
        }
		//翻页调用  
        function PageCallback(page, jq) { 
            console.log(page); 
            $('#form_page').val(page);           
        	dbgmsComment('get',page); 
            return false;
        }
        
        //dbgmsComment(userLabelId,distype,disId) 
        /******@action:DbgMs系统前端评论 @version:[小庄_2016-03-31]******/
        function dbgmsComment(ajaxType,page){
            ajaxType = ajaxType || 'get';
            if(ajaxType !='get' && ajaxType!='set'){ 
      	        return ;
	      	      ds.dialog({width:'210px',title:'系统提示',content:'请求链接错误~',timeout:3,
						buttons:[{text:'关闭',autoFocus:true,className:'ds_dialog_yes',onclick:function(){this.close();}}],
					});
				return;
            }
            if(ajaxType=='set'){
                var CommentContentObj=$("#CommentContent");
         		var CommentContent =$.trim(CommentContentObj.val()); 
         		if(CommentContent===""){
         			ds.dialog({width:'210px',title:'系统提示',content:'评论内容不能为空~',timeout:3,
 						buttons:[{text:'关闭',autoFocus:true,className:'ds_dialog_yes',onclick:function(){this.close();}}],
 					});
         			return;
 		        } 
         		var CommentCheckcodeObj=$("#CommentCaptcha");
         		var CommentCheckcode =$.trim(CommentCheckcodeObj.val());
         		if(CommentCheckcode==="") {
         			ds.dialog({width:'210px',title:'系统提示',content:'验证码不能为空~',timeout:3,
 						buttons:[{text:'关闭',autoFocus:true,className:'ds_dialog_yes',onclick:function(){this.close();}}],
 					});
         			return;
         		}
            } 
            $.ajax({   
            	url: commonurl+'common/comment/'+ajaxType,     
                type: "POST",  
                dataType: "json",  
                data: DbgMsFormComment.serialize(),
    			cache:false, 
    			error:function (XMLHttpRequest, textstatus, errorThrown) {
    				console.log(textstatus+"====="+errorThrown);
    				return false; 
    			}, 
	            success: function(result) {
	            	if(result.StatusCode==404){
    					ds.dialog({width:'210px',title:'系统提示',content:result.error,timeout:3,
    						buttons:[{text:'关闭',autoFocus:true,className:'ds_dialog_yes',onclick:function(){this.close();}}],
    					});
    					if(ajaxType=='set'){
                            CommentCaptchaImgObj.trigger('click');
                        }
    					return false; 
    				}else if(result.StatusCode==200){
                        if(ajaxType=='set'){
                        	ds.dialog({width:'210px',title:'评论成功',content:result.msg,timeout:3,});
                            $('textarea[name=form_content]').val('');
                            CommentCaptchaImgObj.trigger('click');
                        }
                        pagetotal= result.total;
                        $('#form_page').val(result.page);
                        console.log(result.page);
                    	setpagebreak(pagetotal, result.page);
                    	$("#CommentListUl").html(" ");
						var htmls = '';
	    				if(result.total!='-1'){
	    					$.each(result.list,function(i,row){
   							    if(i==0){
                                    i ='沙发';
                                }else if(i==1){
                                    i ='板凳';
                                }else if(i==2){
                                    i ='地板';
                                }else{
                                    i = '#'+(i+1);
                                }
   							    htmls += "<li>";
                                htmls +='<div class="floor">'+i+'</div>';
                                htmls +='<div class="avatar"><img src="'+row.useravatar+'" width="36" height="36" ></div>';
                                htmls +='<div class="inner"><p>'+row.content+'</p>';
                                htmls +=' <div class="meta">';
                                htmls +=' [ <span class="blue">'+row.username+'</span>  ]<span class="time">'+row.time +'</span>';
                                htmls +=' </div>';
                                htmls +='</div>';
                                htmls +='</li>';
   						   });
	   					 }else{
	   						htmls = "<li><p>"+result.error+"</p></ul>"; 
	   					 }
	   					 $("#CommentListUl").html(htmls);	 
	    			  }  
                   }  
            });
        }  
function trim(str){
	 return str.replace(/(^\s*)|(\s*$)/g, "");
}
$.fn.serializeObject = function() { 
	var o = {}; 
	var a = this.serializeArray(); 
	$.each(a, function() { 
		if (o[this.name]) { 
			if (!o[this.name].push) { 
				o[this.name] = [ o[this.name] ]; 
			} 
			o[this.name].push(this.value || ''); 
		} else { 
			o[this.name] = this.value || ''; 
		} 
	}); 
	return o; 
}
function getFormJson(form) {
	 var o = {};
	 var a = $(form).serializeArray();
	 $.each(a, function () {
		 if (o[this.name] !== undefined) {
		    if (!o[this.name].push) {
		        o[this.name] = [o[this.name]];
		    }
		    o[this.name].push(this.value || '');
		 } else {
		    o[this.name] = this.value || '';
		 }
	 });
	 return o;
 }
</script>
  </div>
  <div class="clear"></div>
 </div>
</div>
<!--dbgms_comment_end-->
