/*判断是否加载过该文件*/
dbgmsLoadCssJs("ui/js/jquery-form.js", "js");
dbgmsLoadCssJs("plugin/jcrop/jcrop.dbg.js", "js");
isInclude('ui/js/dbgimg.js');
dbgmsLoadCssJs("ui/css/dbgimg.css", "css");
/* jq方法的 加载 doc 完 就开始加载 */
/* dbgms后台系统,自定义字段所需的一些js */
/* 图片大小 */
DbgimgReady = (function(){
	var d = [], c = null, b = function(){
		var e = 0;
		for(;e < d.length;e++){
			d[e].end ? d.splice(e--, 1):d[e]()
		}
		!d.length && a()
	}, a = function(){
		clearInterval(c);
		c = null
	};
	return function(f,k,m,j){
		var l, g, n, i, e, h = new Image();
		h.src = f;
		if(h.complete){
			k.call(h);
			m && m.call(h);
			return
		}
		g = h.width;
		n = h.height;
		h.onerror = function(){
			j && j.call(h);
			l.end = true;
			h = h.onload = h.onerror = null
		};
		l = function(){
			i = h.width;
			e = h.height;
			if(i !== g || e !== n || i * e > 1024){
				k.call(h);
				l.end = true
			}
		};
		l();
		h.onload = function(){
			!l.end && l();
			m && m.call(h);
			h = h.onload = h.onerror = null
		};
		if(!l.end){
			d.push(l);
			if(c === null){
				c = setInterval(b, 40)
			}
		}
	}
})();
function getext(u){
	var us,rs;
	if(u.indexOf('?')>-1){
		us=u.split('?');
		u=us[0];
	}else if(u.indexOf('#')>-1){
		us=u.split('#');
		u=us[0];
	}
	us=u.split('/');
	u=us[us.length-1];
	us=u.lastIndexOf('.');
	rs = us>-1 ? u.substr(us+1).toLowerCase() : '';
	return rs;
}

function dbg_diyfield_file(changei,obj){ 
	var dbg_diyfield_filediv=$('div.dbg_diyfield_file');
	if(dbg_diyfield_filediv.length<1){
		return ;
	}
	isimg=function(src){
		var ext = src=='' ? '' : getext(src);
		return (ext=='jpg'||ext=='jpeg'||ext=='png'||ext=='gif'||ext=='bmp') ? 1 : 0;
	};
	dbg_diyfield_filediv.each(function(i,n){
		var img_obj = $(this).find('img.dbg_diyfield_file_img');/* 预览图片对象 */
		var img_fileurl = img_obj.attr("data-fileurl");/* 资源路径 */
		var field_obj = $(this).find('input.dbg_diyfield_file_value');/* 图片路径存储对象 */
		var img_path = field_obj.val();
		/* (dbg自定义字段插件-文件)=== 图片预览(自适应大小) */
	    field_obj.off('mouseover mouseout change');
		field_obj.on({
			mouseover:function(){
				if(img_path != ''){
					srcval = img_fileurl + img_path;
					if(!isimg(srcval)){return false;/* 图片格式错误 */}
					dw = 600;
					dh = 500;
					DbgimgReady(srcval, function(){
						var img = this, dradot, nradot;
						w = srcw = img.width;
						h = srch = img.height;
						if(srcw > dw || srch > dh){
							dradot = dw / dh;
							nradot = srcw / srch;
							if(nradot > dradot){
								w = dw;
								h = w / nradot;
							}else{
								h = dh;
								w = h * nradot;
							}
						}
						img_obj.css({
							width:w,
							height:h
						});
						img_obj.attr('src', srcval);
						pos = $(this).offset();
						img_obj.css({
							left:pos.left,
							top:(pos.top + 22)
						});
						img_obj.show();
					},null,function(){
						/* console.log('所要裁剪的图片加载失败！'); */
					});
				}else{
					img_obj.hide();
				}
			},
			mouseout:function(){
				img_obj.hide();
			},
			change:function(){
			    dbg_diyfield_file();
			}
		});
		/* (dbg自定义字段插件-文件)=== 上传按钮 */
		var uploadbtn_obj = $(this).find('input.dbg_diyfield_file_upload');/* 上传按钮对象 */
		var upload_data_obj = $(this).find('input.dbg_diyfield_file_data');/* 上传按钮对象 */
		var uploadform = upload_data_obj.attr('data-form');
		var uploadurl =upload_data_obj.attr('data-url');
		uploadbtn_obj.off('change').on('change',function(ev){
			/* 防止链接打开 URL */
			ev.preventDefault();
			 $('#'+uploadform).ajaxSubmit({
				   url:uploadurl+'&use=img' ,// 后台的处理，也就是form里的action
				   type:"POST",
				   dataType:"json",
				   success :function(data){
					   if(data.type=="ok"){field_obj.val(data.info); }else {
						  alert('图片处理失败~');
						}
				       dbg_diyfield_file();
				   }
			  });
			return false; /* 重要的！---总是返回false，以防止标准的浏览器提交和页面导航 为了防止刷新 */
		});
		/* (dbg自定义字段插件-文件)=== 图片裁剪 */
		var cut_obj = $(this).find('a.dbg_diyfield_file_cut');/* 图片裁剪对象 */
		cut_obj.off('click').on('click',function(ev){
			ev.preventDefault();
			var src= img_path;
			if(isimg(src)){
				imgurl = img_fileurl + img_path;
				DbgimgReady(imgurl, function(){
					dbg_jcorp_create(imgurl,{
						watermark:0,/* 后台是否开启水印,当前图片裁剪是否打水印 */
						callback:function(result){
							$.ajax({
							    url:uploadurl+'&use=cut' ,// 后台的处理，也就是form里的action
								type:"POST",
								data:{imgpath:img_path,cutparame:result},
								dataType:"json",
								success :function(data){
									 if(data.type=="ok"){field_obj.val(data.info); }else {
										  alert('图片处理失败~');
									  }
								      dbg_diyfield_file();
								}
							});
					     }
					   });
				},null,function(){
					alert('所要裁剪的图片加载失败！');  
					return false;
				});
			}else{
				alert('所要裁剪的图片加载失败！'); 
			}
		});
	});
}

$(document).ready(function(){
	/* dbg自定义字段插件_文件上传图片 自适应大小 */
    dbg_diyfield_file();
	/* dbg自定义字段插件_帮助提示 */
	var autohpdiv = false;
	$('img.autohelp').on({
		mouseenter:function(){
			var m, x, mw, mh, w, h, pos, mt, top, left;
			m = $(this);
			x = $.trim(m.attr('alt'));
			if(x != ''){
				m.addClass('autohelp_hv');
				m.attr('alt', '');
				m.attr('rel', x);
				if(!autohpdiv){
					autohpdiv = $('<div class="autohelp_show"></div>');
					autohpdiv.appendTo('body');
				}
				autohpdiv.css({
					left:0,
					top:-900
				});
				x = x.replace(/\\n/g, '<br />');
				autohpdiv.html(x);
				mt = $(document).scrollTop();
				mw = $(window).width();
				mh = $(window).height();
				w = autohpdiv.outerWidth();
				h = autohpdiv.outerHeight();
				pos = m.offset();
				pos.width = m.outerWidth();
				pos.height = m.outerHeight();
				left = pos.left + pos.width;
				if((mw - pos.left) < w && pos.left > w){
					left = pos.left - w;
				}
				top = pos.top + pos.height;
				if(mh - (pos.top - mt) < h && (pos.top - mt) > h){
					top = pos.top - h;
				}
				autohpdiv.css({
					top:top,
					left:left
				});
				autohpdiv.show();
			}
		},
		mouseleave:function(){
			$(this).attr('alt', $(this).attr('rel'));
			$(this).removeClass('autohelp_hv');
			if(autohpdiv){
				autohpdiv.hide();
			}
		}
	});

});
 
