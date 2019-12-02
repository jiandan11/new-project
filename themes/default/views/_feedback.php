<style type="text/css">
/*______留言板______dbgms_guestbook_box______0318*/
.dbgms_guestbook_box {
	border: 1px solid #ddd
}

.dbgms_guestbook_title {
	height: 30px;
	line-height: 30px;
	background-color: #ECECEC;
	padding-left: 10px;
	padding-right: 10px;
}

.dbgms_guestbook {
	padding: 20px
}

.dbgms_guestbook_list {
	border-bottom: 1px dotted #ccc;
	padding: 10px 20px;
}

.dbgms_guestbook_list .content {
	font-size: 14px;
	line-height: 25px;
	padding-bottom: 10px;
}

.dbgms_guestbook_list .content .reply {
	border: 1px solid #ddd;
	line-height: 25px;
	padding-left: 5px;
	padding-right: 5px;
	margin-top: 10px;
	background-color: #f4f4f4
}

.dbgms_guestbook_list .info {
	color: #666;
	line-height: 25px;
}

.dbgms_guestbook_form {
	padding: 20px 30px;
}

.dbgms_guestbook_form h5 {
	line-height: 30px;
	font-size: 14px;
	font-weight: bold
}

.dbgms_guestbook_form tr {
	margin-bottom: 20px;
	height: 50px;
}

.dbgms_guestbook_text {
	border: 1px solid #ccc;
	line-height: 25px;
	height: 25px;
	width: 250px;
}

.dbgms_guestbook_content {
	border: 1px solid #ccc;
	height: 100px;
	width: 500px;
	margin-top: 10px;
}

.dbgms_guestbook_captcha {
	width: 80px;
	height: 35px;
	margin-right: 10px;
	border: 1px solid #ccc;
	line-height: 25px;
}

.dbgms_guestbook_captcha_img {
	width: 75;
	height: 35;
	border: 0;
	vertical-align: top;
	margin-left: 3px;
}

.dbgms_guestbook_submit {
	cursor: pointer;
	border: 1px solid #ddd;
	width: 60px;
	line-height: 35px;
	height: 35px;
	vertical-align: top;
	margin-left: 15px;
}
</style>
<div class="dbgms_guestbook_box">
 <div class="dbgms_guestbook_title">
  <h3>留言板</h3>
 </div>
 <div id="FeedbackList"></div>

 <div class="pagenum"></div>
 <div class="dbgms_guestbook_form">
  <form method="post" id="DbgMsFormFeedback">
   <h5>发布留言</h5>
   <table>
    <tbody>
     <tr>
      <td>昵称：</td>
      <td><input class="dbgms_guestbook_text" type="text" name="form_name" /></td>
     </tr>
     <tr>
      <td>邮箱：</td>
      <td><input class="dbgms_guestbook_text" type="text" name="form_email" /></td>
     </tr>
     <tr>
      <td>内容：</td>
      <td><textarea class="dbgms_guestbook_content" name="form_content"></textarea></td>
     </tr>
     <tr>
      <td>验证码：</td>
      <td>
       <div>
        <input class="dbgms_guestbook_captcha" type="text" maxlength="4" name="form_captcha">
        <!--  -->
        <img alt="如果您无法识别验证码，请点图片更换" class="dbgms_guestbook_captcha_img" id="FeedbackCaptchaImg" />
        <!--  -->
        <input type="button" class="dbgms_guestbook_submit" id="FeedbackSubmit" value="提交">
       </div>
      </td>
     </tr>
    </tbody>
   </table>
   <div style="clear: both"></div>
  </form>
  <script type="text/javascript">
     var commonurl = '<?php echo $_baseurl;?>';
     $(document).ready(function() {
    		var FeedbackCaptchaImg = $('#FeedbackCaptchaImg');
    		FeedbackCaptchaImg.on('click', function() {
    			$('input[name=comment_captcha]').val('');
    			this.src = commonurl + 'common/checkyzm/feedback?t=' + (new Date().getTime());
    		});
    		FeedbackCaptchaImg.trigger('click');
    		$.ajax({
				type : "POST",
				url : commonurl + 'common/feedback/get',
                dataType:'json',
				success : function(result) {
					var htmls = '';
					if (result.StatusCode == 200) {
						$.each(result.data,function(i,row){
                             htmls += '<div class="dbgms_guestbook_list">';
                             htmls +='<div class="content">'+row.content+'</div>'
                             htmls +=' <div class="info">邮箱:'+row.email+'&nbsp;&nbsp;昵称:'+row.name+'&nbsp;&nbsp;时间:'+row.uptime+'</div>';
                             htmls +='</div>';
						 });
						 $("#FeedbackList").html(htmls); 
					} else {
						alert(result.msg);
						htmls += '<div class="dbgms_guestbook_list">';
                        htmls +='<div class="content">暂无留言~</div>'
                        htmls +='</div>';
                        $("#FeedbackList").html(htmls); 
					}
				}
			});

    		$('#FeedbackSubmit').on('click', function() {
    			var form = $('#DbgMsFormFeedback');
    			var ispass = false, isnull = 0;
    			form.find("  input[type=text],textarea").each(function() {
    				if ($(this).val() == "") {
    					$(this).attr('placeholder', '此栏目不能为空!');
    					ispass = false;
    					isnull += 1;
    				} else {
    					if (isnull == 0) {
    						$(this).attr('placeholder', '');
    						ispass = true;
    					}
    				}
    			});
    			if (ispass == true) {
	    			$.ajax({
	    				type : "POST",
	    				url : commonurl + 'common/feedback/set',
	    				data : form.serialize(),
	                    dataType:'json',
	    				success : function(result) {
	    					if (result.StatusCode == 200) {
	    						alert(result.msg);
	    						setTimeout(function(){window.location.reload();},1000);
	    					} else {
	    						alert(result.msg);
	    					}
	    				}
	    			});
    			}
    		});
    	});
    </script>
 </div>
 <div class="fn-clear"></div>
</div>