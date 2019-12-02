/**
 * @action:DbgMs系统通用工具
 * @author:zhw
 * @version:2016-03-29
 */
$(document).ready(function() {
	/* 当滚动条的位置处于距顶部667像素以下时，跳转链接出现，否则消失 */
	$(window).scroll(function() {
		if ($(window).scrollTop() > 667) {
			$(".dbgms-tool-backtop").fadeIn(1500);
		} else {
			$(".dbgms-tool-backtop").fadeOut(1500);
		}
	});
	/* 当点击跳转链接后，回到页面顶部位置 */
	$(".dbgms-tool-backtop").click(function() {
		$('body,html').animate({
			scrollTop : 0
		}, 1000);
		return false;
	});
});

/*
 * dbgms通用：qq 弹窗客服
 */
;(function(DbgMsTool) {
	DbgMsTool.fn.qq = function(config) {
		var DefaultConfig = {
			"float": 'left',
			minStatue: !1,
			skin: "red",/* 皮肤 */
			durationTime: 1e3,
			AutoOpen:false,/* 是否自动弹出QQ */
			img:null,/**/
			FixedBox:true/* 悬浮框 */
		},
		config = DbgMsTool.extend(DefaultConfig, config);$(".dbgms_qq").css("float", config.float);
		if(config.qq!=false){
			/* 分割QQ数组 */
			var qqstring="";
			var qqarr= new Array(); /* 定义一数组 */
			config.qq = config.qq.replace(",",","); 
			config.qq = config.qq.replace("，",","); 
			qqarr=config.qq.split(","); /* 字符分割 */
			/* 悬浮框 */
			if(config.FixedBox==true){
				for (i=0;i<qqarr.length ;i++ ) 
				{ 	 
					qqstring +='<p><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+qqarr[i]+'&site=qq&menu=yes"> ';
					qqstring +='<img border="0" src="http://wpa.qq.com/pa?p=2:'+qqarr[i]+':52" alt="在线客服" title="在线客服" />客服 &nbsp;'+qqarr[i]+'</a></p>';
				} 
				$('#dbgms_qqarr').append(qqstring);
			}
			/* 自动弹出对话框(影响用户体验，默认不开启，弹出为第一个QQ) */
			if(config.AutoOpen==true){
				 var DbgMsToolQqIframe;
				try{  
				   DbgMsToolQqIframe = document.createElement('<iframe id="DbgMsToolQqIframe" style="display: none;"></iframe>');  
			   }catch(e){ 
				   DbgMsToolQqIframe = document.createElement('iframe');  
				   DbgMsToolQqIframe.id = 'DbgMsToolQqIframe';  
				}
			    setTimeout(function(){
			          src = "tencent://message/?uin="+qqarr[0]+"&Site=&menu=yes";
			      	  DbgMsToolQqIframe.src=src;  
			    }, 300); 
			    document.body.appendChild(DbgMsToolQqIframe);
			}
		}
		/* 显示热线电话 */
		if(config.phone!=false){
			/* 分割QQ数组 */
			var phonestring="";
			var phonearr= new Array(); /* 定义一数组 */
			config.phone = config.phone.replace(",",","); 
			config.phone = config.phone.replace("，",","); 
			phonearr=config.phone.split(","); /* 字符分割 */
			for (i=0;i<phonearr.length ;i++ ) 
			{ 	/* 分割后的字符输出 */
				phonestring +='<p>热线:'+ phonearr[i]+'</p>';
			} 
			$('#dbgtool_phone').append(phonestring);
		}
		this.each(function() {
			var n = DbgMsTool(this),
			minbtn = n.find(".dbgms_qq_minbtn"),
			maxbtn = n.find(".dbgms_qq_maxbtn"),
			s = n.find(".dbgms_qq"),
			o = n.find(".dbgms_qq").width(),
			/* u = n.find(".dbgms_qq"), */
			a = n.offset().top;
			n.css(config.float, 2),
			config.minStatue && (e(".dbgms_qq_maxbtn").css("float", config.float),
			s.css("width", 0), maxbtn.css("width", 25)),
			config.skin && n.addClass("side_" + config.skin),
			
			DbgMsTool(window).bind("scroll",function() {
				var r = a + DbgMsTool(window).scrollTop() + "px";
				n.animate({	top: r},{duration: config.durationTime,	queue: !1})
			}),
			
			minbtn.bind("click",function() {
				s.animate({	width: "0"},"fast"),
				maxbtn.stop(!0, !0).delay(100).animate({width:"35px"},"fast").css("float", config.float)
			}),
			maxbtn.click(function() {
				DbgMsTool(this).animate({width: "0px"},"fast"),
				n.width(o),
				s.stop(!0, !0).delay(100).animate({width: "167px"},"fast")
			});
		});
	}
})(jQuery);
