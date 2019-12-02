T=window.top;
StyleDir=T.StyleDir===undefined?'default':T.StyleDir;

//jquery-include
;(function(l){var p=[],i=[],m=0;function n(b,a){if(a.isCalled){return}var d=false;if(/webkit/i.test(navigator.userAgent)){if(b.sheet){d=true}}else{if(b.sheet){try{if(b.sheet.cssRules){d=true}}catch(c){if(c.code===1000){d=true}}}}if(d){setTimeout(function(){a()},1)}else{setTimeout(function(){n(b,a)},1)}}function o(b,a){if(b.attachEvent){b.attachEvent("onload",a)}else{setTimeout(function(){n(b,a)},0)}}function k(c,a){var b=l("<link/>").attr("rel","stylesheet").attr("href",c);l(l("head")[0]).append(b);o(b[0],a)}function j(b,a){var d,f,h,e,g,c;a=a||0;b=b||0;d=i[b];if(d){h=d.func||null;f=d.dat||[];c=f.length}else{return}if(a>=c){if(h){h()}return}e=f[a];g=function(){p.push(e.src);a++;j(b,a)};if(e.type=="css"){k(e.src,g)}else{l.getScript(e.src,g)}}l.include=function(b,a,e){a=a||null;e=e||0;var d=b.split(","),c=d.length,g,u,f,v,w,h;w=[];for(g=0;g<c;g++){u=l.trim(d[g]);if(u!=""){u=(e||u.indexOf("http://")>-1)?u:"js/"+u;if(l.inArray(u,p)>-1){continue}f={};f.src=u;f.type="."+(u.split(".")[u.split(".").length-1]).toLowerCase();f.type=f.type.indexOf(".css")>-1?"css":"js";w.push(f)}}v={};v.dat=w;v.func=a;i[m]=v;j(m);m++}})(jQuery);


window.initFlash={Browser:function(){var a=navigator.userAgent.toLowerCase(),b=window.ActiveXObject&&a.indexOf("msie")!=-1&&a.substr(a.indexOf("msie")+5,3),c=window.opera&&opera.version();return b&&!c},GetArgs:function(a,b,c){var d=new Object;d.embedAttrs=new Object,d.params=new Object,d.objAttrs=new Object;for(var e=0;e<a.length;e=e+2){var f=a[e].toLowerCase();switch(f){case"classid":break;case"pluginspage":d.embedAttrs[a[e]]="http://www.macromedia.com/go/getflashplayer";break;case"src":d.embedAttrs[a[e]]=a[e+1],d.params.movie=a[e+1];break;case"codebase":d.objAttrs[a[e]]="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0";break;case"onafterupdate":case"onbeforeupdate":case"onblur":case"oncellchange":case"onclick":case"ondblclick":case"ondrag":case"ondragend":case"ondragenter":case"ondragleave":case"ondragover":case"ondrop":case"onfinish":case"onfocus":case"onhelp":case"onmousedown":case"onmouseup":case"onmouseover":case"onmousemove":case"onmouseout":case"onkeypress":case"onkeydown":case"onkeyup":case"onload":case"onlosecapture":case"onpropertychange":case"onreadystatechange":case"onrowsdelete":case"onrowenter":case"onrowexit":case"onrowsinserted":case"onstart":case"onscroll":case"onbeforeeditfocus":case"onactivate":case"onbeforedeactivate":case"ondeactivate":case"type":case"id":d.objAttrs[a[e]]=a[e+1];break;case"width":case"height":case"align":case"vspace":case"hspace":case"class":case"title":case"accesskey":case"name":case"tabindex":d.embedAttrs[a[e]]=d.objAttrs[a[e]]=a[e+1];break;default:d.embedAttrs[a[e]]=d.params[a[e]]=a[e+1]}}d.objAttrs.classid=b,c&&(d.embedAttrs.type=c);return d},DetectFlashVer:function(a,b,c){var d=this,e=-1;if(navigator.plugins!=null&&navigator.plugins.length>0&&(navigator.plugins["Shockwave Flash 2.0"]||navigator.plugins["Shockwave Flash"])){var f=navigator.plugins["Shockwave Flash 2.0"]?" 2.0":"",g=navigator.plugins["Shockwave Flash"+f].description,h=g.split(" "),i=h[2].split("."),j=i[0],k=i[1],l=h[3];l==""&&(l=h[4]),l[0]=="d"?l=l.substring(1):l[0]=="r"&&(l=l.substring(1),l.indexOf("d")>0&&(l=l.substring(0,l.indexOf("d")))),e=j+"."+k+"."+l}else if(d.Browser())try{var m=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");e=m.GetVariable("$version")}catch(n){}if(e==-1)return!1;if(e!=0){d.Browser()?(tempArray=e.split(" "),tempString=tempArray[1],versionArray=tempString.split(",")):versionArray=e.split(".");var j=versionArray[0],k=versionArray[1],l=versionArray[2];return j>parseFloat(a)||j==parseFloat(a)&&(k>parseFloat(b)||k==parseFloat(b)&&l>=parseFloat(c))}},GetContent:function(){var a=this,b="",c=a.GetArgs(arguments,"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000","application/x-shockwave-flash");if(a.Browser()){b+="<object ";for(var d in c.objAttrs)b+=d+'="'+c.objAttrs[d]+'" ';b+=">";for(var d in c.params)b+='<param name="'+d+'" value="'+c.params[d]+'" /> ';b+="</object>"}else{b+="<embed ";for(var d in c.embedAttrs)b+=d+'="'+c.embedAttrs[d]+'" ';b+="></embed>"}a.DetectFlashVer(9,0,124)?b+="":b='<div style="position:absolute;left:0;top:-8000px">'+b+'</div><div class="js-needflash"><div>此内容需要 Adobe Flash Player 9.0.124 或更高版本</div><p><a href="http://www.adobe.com/go/getflashplayer/" target="_blank"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="下载 Flash Player" /></a></p></div>';return b}};


imgReady=(function(){var d=[],c=null,b=function(){var e=0;for(;e<d.length;e++){d[e].end?d.splice(e--,1):d[e]()}!d.length&&a()},a=function(){clearInterval(c);c=null};return function(f,k,m,j){var l,g,n,i,e,h=new Image();h.src=f;if(h.complete){k.call(h);m&&m.call(h);return}g=h.width;n=h.height;h.onerror=function(){j&&j.call(h);l.end=true;h=h.onload=h.onerror=null};l=function(){i=h.width;e=h.height;if(i!==g||e!==n||i*e>1024){k.call(h);l.end=true}};l();h.onload=function(){!l.end&&l();m&&m.call(h);h=h.onload=h.onerror=null};if(!l.end){d.push(l);if(c===null){c=setInterval(b,40)}}}})();


;(function($,document,undefined){
	var AutoColor=function(id){
		var objs=$(id);
		$.each(objs,function(i,n){
			var m,rel,bc,bb,vc,vb,css,nc,nb,tit;
			m=$(n);
			rel=m.attr("rel")||'';
			if(rel!=''){
				tit=$("input[name='"+rel+"']");
				bc=$("input[name='c"+rel+"[color]']",m);
				bb=$("input[name='c"+rel+"[b]']",m);
				if(tit.length>0 && bc.length>0 && bb.length>0){
					if($.fn.bigColorpicker===undefined){
						$.plugin('bigColor').get();
					}
					nc=$('em',m);
					nb=$('b',m);
					vc=bc.val();
					vb=bb.val();
					css='';
					if(vc!=''){
						tit.css('color',vc);
					}
					if(vb=='b'){
						tit.css('fontWeight','bold');
						nb.addClass('check');
					}else{
						nb.removeClass('check');
					}
					nb.bind('click',function(){
						if(nb.hasClass('check')){
							nb.removeClass('check');
							tit.css('fontWeight','normal');
							bb.val('');
						}else{
							nb.addClass('check');
							tit.css('fontWeight','bold');
							bb.val('b');
						}
					});
					nc.bigColorpicker(function(el,color){
						if(color==''){
							tit.css('color',bc.val());
						}else{
							tit.css('color',color);
						}
					},function(el,color){
						if(color=='clear'){
							bc.val('');
							tit.css('color','');
						}else if(color==''){
							tit.css('color',bc.val());
						}else{
							bc.val(color);
							tit.css('color',color);
						}
					});
				}
			}
		});
	};
	$.AutoColor=function(id){
		if($(id).length<1){
			return ;
		}
		$.getScript('js/colorpik.js',function(){
			AutoColor(id);
		});
	};
	$.TipHide=function(){
		$('#Tips_error_Auto').hide();
	};
	$.TipError=function(obj,msg){
		var pos,etip,tips,top,left,gt;
		if(!obj || msg==''){
			return ;
		}
		obj=$(obj);
		pos = obj.offset();
		pos.width=obj.outerWidth();
		pos.height=obj.outerHeight();
		etip=$('#Tips_error_Auto');
		if(etip.length<1){
			etip=$('<div class="Tips_error" id="Tips_error_Auto" style="left:0;top:-900px"></div>').bind('click',function(){
				$.TipHide();
			});
			etip.appendTo('body');
		}else{
			etip.css({top:-900});
			etip.show();
		}
		etip.html('<div><b>'+msg+'</b><strong>'+msg+'</strong><span><del><em>◆</em><i>◆</i></del></span></div>');
		tips={};
		tips.width=etip.outerWidth();
		tips.height=etip.outerHeight();
		if(pos.top > tips.height){
			top = pos.top - tips.height - 7;
			etip.removeClass('Tips_error2');
			gt = top-3;
		}else{
			top = pos.top + pos.height + 7;
			etip.addClass('Tips_error2');
			gt = pos.top -3;
		}
		left = pos.left + pos.width - tips.width;
		etip.css({top:top,left:left});
		$(window).scrollTop(gt);
	};
	$.ByImgCut=function(src,cfg){
	    var ImgInfo,CutWrp,CutObj,wrp,dcfg,cfg,img_src,img_obj,img_width,img_height,img_radio,freeCut,previewImg,dlshow;
		var doreset,dobtns,dosels,end_x1=0,end_y1=0,end_x2=0,end_y2=0,end_width=0,end_height=0;
		var defWidth,defHeight;
		wrp=null;
		freeCut=0;
		defWidth=240;
		defHeight=160;
		dlshow=0;
		dcfg={
		   lists:'140_90|横幅小缩略图,140_75|横幅小缩略图,160_100|横幅小缩略图,120_160|海报式竖幅图',
		   width:200,
		   height:100,
		   tosmall:0,
		   bcolor:'#FFFFFF',
		   callback:null
		};
		cfg = $.extend(dcfg,cfg||{});
		var getwh=function(dw,dh,srcw,srch){
		    var w,h,dradot,nradot;
		    w=srcw;
			h=srch;
			if(srcw>dw||srch>dh){
				dradot=dw/dh;
				nradot=srcw/srch;
				if(nradot>dradot){
					w=dw;
					h=w/nradot;
				}else{
					h=dh;
					w=h*nradot;
				}
			}
			w=Math.round(w);
			h=Math.round(h);
			return {w:w,h:h};
		};
		var preview=function(w,h,x1,y1){
		    var wh,width,height,radio,gw,gh,left,top;
			w=w*img_radio;
			h=h*img_radio;
			x1=x1*img_radio;
			y1=y1*img_radio;

			wh=getwh(300,300,w,h);
			width=wh.w;
			height=wh.h;

			radio=w/width;
			gw=Math.round(img_width*img_radio/radio);
			gh=Math.round(img_height*img_radio/radio);
			left= -1 * Math.round(x1/radio);
			top = -1 * Math.round(y1/radio);

            $('.Jsimgcuts_imgshow',wrp).css({width:width,height:height});
			previewImg.css({width:gw,height:gh,left:left,top:top});
		};
		var setval=function(w,h,x,y){
		    var ips=$(".Jsimgcuts_cutinfo input",wrp);
			w=Math.round(w*img_radio);
			h=Math.round(h*img_radio);
			x=Math.round(x*img_radio);
			y=Math.round(y*img_radio);
			$(ips[0]).val(w);
			$(ips[1]).val(h);
			$(ips[2]).val(x);
			$(ips[3]).val(y);
			end_width=w;
			end_height=h;
		};
		var cutset=function(w,h,sets){
			sets.enable=true;
			preview(w,h,sets.x1,sets.y1);
			setval(w,h,sets.x1,sets.y1);
			if(CutObj===false){
			    CutObj=img_obj.imgAreaSelect({instance:true});
			}
			try{
				CutObj.setOptions(sets);	
			}catch(e){};
		};
		var cutcg=function(img,selection){
			end_x1=selection.x1;
			end_y1=selection.y1;
			end_x2=selection.x2;
			end_y2=selection.y2;
			preview(selection.width,selection.height,selection.x1,selection.y1);
			setval(selection.width,selection.height,selection.x1,selection.y1);
		};
		var cut=function(w,h){
		    var wh,sets,isfree;
		    w=parseInt(w);
			h=parseInt(h);
			isfree = (w==0 && h==0) ? 1 : 0;
			if(w==0){
			   w=defWidth;
			}
			if(h==0){
			   h=defHeight;
			}
			w=Math.round(w/img_radio);
			h=Math.round(h/img_radio);

			wh=getwh(img_width,img_height,w,h);
			w=wh.w;
			h=wh.h;

			sets={};
			sets.onSelectChange=cutcg;
			sets.x1 = (img_width-w)/2;
			sets.x1 = Math.max(0,sets.x1);
			sets.y1 = (img_height-h)/2;
			sets.y1 = Math.max(0,sets.y1);
			sets.x2 = sets.x1 + w;
			sets.y2 = sets.y1 + h;

			end_x1=sets.x1;
			end_y1=sets.y1;
			end_x2=sets.x2;
			end_y2=sets.y2;

			if(isfree==1){
				sets.aspectRatio='';
				$(dobtns[1]).hide();
			}else{
			    sets.aspectRatio = w+':'+h;
				$(dobtns[1]).show();
			}
			freeCut=isfree;
			cutset(w,h,sets);
		};
		var resets=function(){
		    var w,h,x1,y1,x2,y2,ips,sets;
			ips=$(".Jsimgcuts_cutinfo input",wrp);
			w=$(ips[0]).val();
			h=$(ips[1]).val();
			x1=$(ips[2]).val();
			y1=$(ips[3]).val();
			w=Math.round(w/img_radio);
			h=Math.round(h/img_radio);
			x1=Math.round(x1/img_radio);
			y1=Math.round(y1/img_radio);

			w=Math.min(img_width,w);
			h=Math.min(img_height,h);
			if( (x1+w) > img_width){
			    x1=img_width-w;
			}
			x1=Math.max(0,x1);
			if( (y1+h) > img_height ){
			    y1=img_height-h;
			}
			y1=Math.max(0,y1);

			x2=x1+w;
			y2=y1+h;
			sets={};
			sets.x1=x1;
			sets.x2=x2;
			sets.y1=y1;
			sets.y2=y2;
			sets.aspectRatio = w+':'+h;
			cutset(w,h,sets);
		};
		var getlists=function(){
			var htm,len,i,as,ad;
			htm='';
			as=cfg.lists.split(',');
			len=as.length;
			for(i=0;i<len;i++){
				ad=as[i].split('|');
				if(ad.length==2){
					htm += '<option value="'+ad[0]+'">'+ad[1]+' * '+ad[0];
				}
			}
			return htm;
		};
	    var create=function(){
		    var htm,h;
			h=$(document).height();
		    CutWrp=$('<span></span>');
			htm='';
			htm+='<div class="Jsimgcuts_bodybg" style="height:'+h+'px"></div><div class="Jsimgcuts_body"><div class="Jsimgcuts_wrp" style="margin-top:'+($(document).scrollTop()+20)+'px;"><div class="Jsimgcuts_fwrp"><div class="Jsimgcuts_bigwrp"><b>Image Loading ...</b></div><div class="Jsimgcuts_cutinfo"><ul><li class="fst"><b>实际尺寸：</b></li><li><b>宽度</b><input type="text"></li><li><b>高度</b><input type="text"></li><li><b>起点X</b><input type="text"></li><li><b>起点Y</b><input type="text"></li><li class="lst"><button>重置</button></li>'+(dlshow>0 ? '<li class="kst"><a href="###" class="dlshow">'+(dlshow==2 ? '正常' : '盗链')+'显示</a></li>' : '')+'</ul></div></div><div class="Jsimgcuts_rwrp" style="display:none"><div class="Jsimgcuts_dos"><div class="Jsimgcuts_btns"><button class="btn2"> 裁剪所选 </button><button class="btn2"> 缩略为所选尺寸 </button><button class="btn3"> 放弃操作 </button></div><select class="tsel">';
			if(cfg.width!=0 && cfg.height!=0){
				htm += '<option value="'+cfg.width+'_'+cfg.height+'">最佳尺寸 * '+cfg.width+'_'+cfg.height;
			}
			htm += '<option value="0_0">-------自由裁剪------';
			if(cfg.lists!=''){
				htm += getlists();
			}
			htm+='</select></div><div class="Jsimgcuts_preview"><div class="Jsimgcuts_imgshow"></div></div>'+(dlshow==0 ? '<div class="Jsimgcuts_saveset"><label><input type="checkbox" name="keep" checked="true">保留原图，将结果保存为新图片</label></div>' : '')+'</div></div></div>';
			CutWrp.html(htm).appendTo('body');

		    wrp=$('.Jsimgcuts_wrp',CutWrp);
			dobtns=$('.Jsimgcuts_btns button',wrp);
			dosels=$('.tsel',wrp);
			doreset=$('.Jsimgcuts_cutinfo button',wrp);
			
			img_obj=$('<img src="'+img_src+'"/>');
			setimgwh(img_obj);
			$(".Jsimgcuts_bigwrp",wrp).html('').append(img_obj);

			previewImg=$('<img src="'+img_src+'"/>').css({width:0,height:0});
			$('.Jsimgcuts_imgshow',wrp).html('').append(previewImg);
			$(".Jsimgcuts_rwrp",wrp).show();

			cutbind();
			$(dobtns[2]).click(function(){
				 cutdel();
			});
			if(dlshow > 0){
				$('.dlshow',wrp).click(function(ev){
					ev.preventDefault();
					changeDL($(this));
				});
			}
			cut(cfg.width,cfg.height);
		};
		var setimgwh=function(obj){
			var img,dw,dh,srcw,srch,wh,w,h,t;
			img=ImgInfo;
			dw=500;
			dh=390;
			srcw=img.width;
			srch=img.height;
			wh=getwh(dw,dh,srcw,srch);
			w=wh.w;
			h=wh.h;
			t=Math.max(0,(dh-h)/2);

			img_width=w;
			img_height=h;
			img_radio=srcw/w;

			obj.css({width:w,height:h,marginTop:t});
		};
		var changeDL=function(m){
			var nsrc,stxt,nlshow,wobj,obj;
			if(dlshow < 1){
				return ;
			}
			wobj=$('.Jsimgcuts_bigwrp',wrp);
			obj=$('img',wobj);
			wobj.css('background-image','url(style/img/lda.gif)');
			obj.hide();
			if(dlshow == 2 ){
				stxt = '盗链显示';
				nsrc = src ;
				nlshow = 1;
			}else{
				stxt = '正常显示';
				nsrc = 'index.php?tn=do&ac=seeimg&src='+src;
				nlshow = 2;
			}
			imgReady(nsrc,function(){
				ImgInfo=this;
				dlshow=nlshow;
				m.html(stxt);
				wobj.css('background-image','none');
				obj.attr('src',nsrc).show();
				setimgwh(obj);
				$('.Jsimgcuts_imgshow img',wrp).attr('src',nsrc);
			},null,function(){
				alert('所要裁剪的图片加载失败！')
			});
		};
		var cutbind=function(){
			dosels.change(function(){
				var vs=this.value.split('_');
				cut(vs[0],vs[1]);
			});
			doreset.click(function(){
				resets();
			});
			$(dobtns[0]).click(function(){
				cutok(0);
			});
			$(dobtns[1]).click(function(){
				cutok(1);
			});
		};
		var cutok=function(resize){
		    var url,loaddiv,w,h,srcs;
		    resize=resize||0;
			dosels.add($(dobtns[0])).add($(dobtns[1])).add(doreset).unbind();
			dosels.attr("disabled",true);
			if(CutObj){
			   CutObj.setOptions({disable:true});
			}
			loaddiv=$('<div style="width:100%;height:100%;position:absolute;left:0;top:0;z-index:2;background:#000 url(style/img/ldb.gif) no-repeat center;"></div>').css('opacity','0.7');
			loaddiv.appendTo($('.Jsimgcuts_imgshow',wrp));
			if(src.indexOf('?')>-1){
				srcs=src.split('?');
				src=srcs[0];
			}
			url="index.php?tn=do&ac=imgcut&src="+encodeURIComponent(src);
			/*===========自定义插件=============*/
			if(cfg.allfileurl != 'undefined' &&cfg.allfileurl!=null &&cfg.allfileurl!=''){
				url=cfg.alluseurl+encodeURIComponent(src);
			}
			/*===========结束=============*/
			if(resize){
			    url+='&resize=1&width='+end_width+'&height='+end_height+'&tosmall='+cfg.tosmall+'&bcolor='+encodeURIComponent(cfg.bcolor);
			}else{
			    url+='&resize=0&radio='+img_radio+'&x1='+end_x1+'&y1='+end_y1+'&x2='+end_x2+'&y2='+end_y2;
			}
			url+= '&keep='+(dlshow==0 && $("input[name='keep']",wrp).attr('checked') ? 1 : 0);
			$.post(url,function(data){
				if(data==''){
			        dosels.attr("disabled",false);
			        loaddiv.remove();
			        cutbind();
			        if(CutObj){
			          CutObj.setOptions({enable:true});
			        }
			        alert( (resize==1 ? '缩略' : '裁剪')+'失败，请重试！');
				}else{
					if($.isFunction(cfg.callback)){
						cutdel();
						cfg.callback(data);
					}
				}
			});
		};
		var cutdel=function(){
		    dosels.add(dobtns).add(doreset).unbind();
			if(CutObj){
			   CutObj.remove();
			}
			CutWrp.remove();
		};
		var load=function(){
			var filepath=_glb['fileurl']||'/file';
			/*========自定义插件=========*/
			if(cfg.allfileurl != 'undefined' &&cfg.allfileurl!=null &&cfg.allfileurl!=''){
				filepath = cfg.allfileurl;
			}
			/*==========结束==========*/
			CutObj=false;
            $.plugin('ByImgCut',{
  		       files:['js/imgareaselect.js','style/'+StyleDir+'/imgcut.css'],
		       selectors:['body'],
  		       callback:function(){
			       create();
		       }
		    });
			if(src.indexOf('http://') >-1 ){
				if( isfdlimg(src) ){
					dlshow=2;
					img_src = 'index.php?tn=do&ac=seeimg&src='+src;
				}else{
					dlshow=1;
					img_src = src ;
				}
			}else{
				img_src = filepath+src;
			}
			imgReady(img_src,function(){
			    if(CutObj===false){
					ImgInfo=this;
					$.plugin('ByImgCut').get();
				}	
			},null,function(){
				alert('所要裁剪的图片加载失败！')
			});
		};
		load();
	};

})(jQuery, document);


function trim(e){
	return $.trim(e);
}
function jumpurl(r){
	location.href=r;
}
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
function now(){
	return new Date().getTime();
}
function adminmsg(msg,url){
	msg=msg||'';
	url=url||'';
	if(window.msgbox){
		msgbox.layer(msg);
	}else{
		alert(msg)
	}
	if(url=='-1'){
		history.go(-1);
	}else if(url!=''){
		if(url!='cc' && url!='cr'){
			location.href=url;
		}
		try{
		   msgbox.close();
		   if(url=='cr'){
			  adminreload();
		   }
		}catch(e){
			 if(url=='cr'){
			   adminreload();
		     }
		};
	}
	return true;
}
//复选框的选择与获取值
function getcheck(o){
	return checkall(o,1);
}
function checkall(o,n){
	o=o||'ids[]';n=n||0;var i,str=document.getElementsByName(o),len=str.length,chestr='';for(i=0;i<len;i++){if(n==1){if(str[i].checked){chestr+=(chestr==''?'':',')+str[i].value;}}else{if(str[i].checked){str[i].checked=false;}else{str[i].checked=true;}}}return chestr;
}
function sdate(o,e){
    $.plugin('CalenDar',{
  		files:['js/calendar.js','style/'+StyleDir+'/calendar.css'],
		selectors:['body'],
  		callback:function(){
			SelectDate(o,e);
		}
	});
	if(typeof(SelectDate)=='undefined'){
		$.plugin('CalenDar').get();
	}else{
		SelectDate(o,e);
	}
}
function subnav()
{
   if($('#selmenu').length<1){
	   return ;
   }
   var lis=$('#selmenu a'),tb=$('.subtab');
   $.each(lis,function(i,n){
	   $(n).bind('click',function(){
		   lis.removeClass('active');
		   $(this).addClass('active');
		   tb.hide();
		   $(tb[i]).show();
		   $('#subtabsub').show();
		   $(this).blur();
	   });
   });
}
//是否是 防盗链网站的图片URL
function isfdlimg(url)
{
	var regex,match,host;
	url=url||'';
	match=null;
	if(url!=''){
		regex = /.*\:\/\/([^\/]*).*/;
		match = url.match(regex);
	}
	host='';
    if(typeof match != "undefined"  && null != match){
		host = match[1];
	}
	if(host!=''){
		var arr,len,i;
		host=host.toLowerCase();
		arr='gtimg.cn,qpic.cn,qiyipic.com';
		arr=arr.split(',');
		len=arr.length;
		for(i=0;i<len;i++){
			if(host.indexOf(arr[i]) >-1 ){
				return true;
			}
		}
	}
	return false;
}
function UponeFile(upbtn,callback){
	if(!upbtn || upbtn === undefined){
		return false;
	}
	callback=callback||'';
	upbtn.unbind('change').bind('change',function(){
		var s,frm,trt,act,ecode,tn,ifrm,types,upary,uary,i,ajtypes,dir,maxsize,water,waterfile,oldfile;
		s=this;
		types=$(s).attr('types');
		upary=[];
		uary=[];
		if(types && types!=''){
			upary=types.split(',');
			for(i=0;i<upary.length;i++){
				if(trim(upary[i])!=''){
					uary.push(upary[i].toLowerCase());
				}
			}
		}
		ajtypes = '';
		if(uary.length>0){
			var ext=getext($(s).val());
			if($.inArray(ext,uary)<0){
				alert('所选文件格式 不在允许范围内');
				return ;
			}
			ajtypes=uary.join(',');
		}
		frm=upbtn.parents('form')[0];
		trt=frm.target;
		act=frm.action;
		ecode=frm.encoding;
		if(frm.tn){
			tn=frm.tn.value;
		}else{
			tn=false;
		}
		ifrm=$('#upfile_autoifm');
		if(ifrm.length<1){
			$('<iframe name="upfile_autoifm" id="upfile_autoifm" src="" style="display:none"></iframe>').insertBefore(frm);
		}
		if(frm.AutoFile_name){
			frm.AutoFile_name.value=s.name;
		}else{
			$('<input type="hidden" name="AutoFile_name" value="'+s.name+'"/>').appendTo(frm);
		}
		if(frm.AutoFile_types){
			frm.AutoFile_types.value=ajtypes;
		}else{
			$('<input type="hidden" name="AutoFile_types" value="'+ajtypes+'"/>').appendTo(frm);
		}
		if(frm.AutoFile_call){
			frm.AutoFile_call.value=callback;
		}else{
			$('<input type="hidden" name="AutoFile_call" value="'+callback+'"/>').appendTo(frm);
		}
		dir=$(s).attr('updir');
		if(dir){
			if(frm.AutoFile_dir){
				frm.AutoFile_dir.value=dir;
			}else{
				$('<input type="hidden" name="AutoFile_dir" value="'+dir+'"/>').appendTo(frm);	
			}
		}
		maxsize=$(s).attr('maxsize');
		if(maxsize){
			if(frm.AutoFile_maxsize){
				frm.AutoFile_maxsize.value=maxsize;
			}else{
				$('<input type="hidden" name="AutoFile_maxsize" value="'+maxsize+'"/>').appendTo(frm);	
			}
		}
		water=$(s).attr('water');
		if(water){
			if(frm.AutoFile_water){
				frm.AutoFile_water.value=water;
			}else{
				$('<input type="hidden" name="AutoFile_water" value="'+water+'"/>').appendTo(frm);	
			}
		}
		waterfile=$(s).attr('waterfile');
		if(waterfile){
			if(frm.AutoFile_waterfile){
				frm.AutoFile_waterfile.value=waterfile;
			}else{
				$('<input type="hidden" name="AutoFile_waterfile" value="'+waterfile+'"/>').appendTo(frm);	
			}
		}
		oldfile=$(s).attr('oldname')||'';
		/* 为了水印功能 重新上传的必须要重命名了 不再传递oldname
		if(oldfile==''){
			var tsname,tsobj;
			tsname = s.name;
			tsname = tsname.substr(0,tsname.length-5);
			tsobj = $("input[name='"+tsname+"']",$(s).parents('.upimg'));
			oldfile = tsobj.val();
		}
		*/
		if(oldfile!=''){
			if(frm.AutoFile_oldname){
				frm.AutoFile_oldname.value=oldfile;
			}else{
				$('<input type="hidden" name="AutoFile_oldname" value="'+oldfile+'"/>').appendTo(frm);	
			}
		}
		frm.encoding = "multipart/form-data";
		frm.target='upfile_autoifm';
		frm.action='index.php';
		if(tn===false){
			$('<input type="hidden" name="tn" value="upfile"/>').appendTo(frm);
		}else{
			frm.tn.value='upfile';
		}
		frm.submit();
		frm.encoding=ecode;
		frm.action=act;
		frm.target=trt;
		if(tn===false){
		}else{
			frm.tn.value=tn;
		}
	});
}
function UponeFile_Error(n,src){
	 var err,errs;
	 errs={"-1":"没有上传文件","-2":"格式不允许","-3":"超过大小限制","-4":"附件不合法","-5":"上传失败"};
	 err=errs[n] ? errs[n] : '上传失败';
	 alert(err);
}
function UpimgAuto(){
	var updiv,filepath,isimg;
	updiv=$('.upimg');
	if(updiv.length<1){
		return ;
	}
	isimg=function(src){
		var ext = src=='' ? '' : getext(src);
		return (ext=='jpg'||ext=='jpeg'||ext=='png'||ext=='gif'||ext=='bmp') ? 1 : 0;
	};
	filepath=_glb['fileurl']||'/file';
	$.each(updiv,function(i,n){
		var tig,ips,upbtn,upip,src;
		tig=$(n);
		ips=$('input',tig);
		upip=$(ips[1]);
		upbtn=$(ips[2]);
		UponeFile(upbtn,'UpimgAuto_End');
		upip.unbind('mouseenter').bind('mouseenter',function(){
			var hash,src,srcw,srch,dw,dh,w,h,obj,pos,s=this;
			hash=$(s).attr('hash')||'fst';
			src=trim($(s).val());
			if(isimg(src)){
				dw=360;
				dh=360;
				src = src.indexOf('http://')>-1 ? src : filepath+src;
				src = src+'?'+hash;
                imgReady(src,function(){
					var img=this,dradot,nradot;
					w=srcw=img.width;
					h=srch=img.height;
					if(srcw>dw||srch>dh){
						dradot=dw/dh;
						nradot=srcw/srch;
						if(nradot>dradot){
							w=dw;
							h=w/nradot;
						}else{
							h=dh;
							w=h*nradot;
						}
					}
					obj=$('#upimg-absolute');
					if(obj.length>0 ){
						obj.css({width:w,height:h});
						obj.attr('src',src);
					}else{
						obj=$('<img src="'+src+'" width="'+w+'" height="'+h+'" id="upimg-absolute" class="upimg-absolute" style="display:none"/>');
						obj.appendTo('body');
					}
					pos=$(s).offset();
					obj.css({left:pos.left,top:(pos.top+$(s).outerHeight()+2)});
					obj.show();
				});
			}
		});
		upip.unbind('mouseleave').bind('mouseleave',function(){
			$('#upimg-absolute').hide();
		});
		if(upip.hasClass('allfile_txt')==true){
			upip.unbind('mouseenter');
			upip.unbind('mouseleave');
			return false;
		}
		$('.upimg-cut',tig).unbind('click').click(function(ev){
			ev.preventDefault();
			var hash,src=upip.val();
			if(isimg(src)){
				hash=upip.attr('hash')||'fst';
				src+='?'+hash;
				$.ByImgCut(src,{
					width: upbtn.attr("fwidth")||0,
					height: upbtn.attr("fheight")||0,
					tosmall: upbtn.attr("tosmall")||0,
					bcolor: upbtn.attr("bcolor")||'#FFFFFF',
					callback:function(vrsrc){
						upip.val(vrsrc).attr('hash',now());
					}
				});
			}
		});
	});
}
function UpimgAuto_End(n,src){
	n=n||'';
	if(n!=''){
		n=n.substr(0,n.length-5);
		var txt=$(".upimg-txt[name='"+n+"']");
		if(txt.length>0){
			if(txt.val()!=''){
				txt.attr('hash',now());
			}
			txt.val(src);
		}
	}
}
function diyViewCfg(cattype,adminid){
	cattype=cattype||0;
	adminid=adminid||0;
	if(cattype==0){
		alert('未指定的模型');
		return ;
	}
	msgbox.box("视图配置",{width:640,height:400});
	$.post("index.php?tn=do&ac=viewcfg&cattype="+cattype+'&adminid='+adminid+'&_='+now(),function(data){
		msgbox.msg(data);
	})
}
$(function(){
	var ie6 = ($.browser.msie && $.browser.version < 7) ? true : false;
	//ie6 当插入为object时 抛出 Ivalid arguement So IE6不使用父级msgbox
	if(!ie6 && T && T.msgbox){
		window.msgbox=T.msgbox;
	}else{
        $.plugin('msgbox',{
  		    files:['js/drag.js','style/'+StyleDir+'/msgbox.css', 'js/msgbox.js'],
		    selectors:['body'],
			cache:false,
  		    callback:function(){
		        if(!window.msgbox){
		           window.msgbox=$.MsgBox((T && T.msgbox ? 2 : 1));
			    }
		    }
		});
		if(!window.msgbox){
			$.plugin('msgbox').get();
		}
	}

	if(T && T.adminreload){
		adminreload=T.adminreload;
	}else{
		adminreload=function(){
			var split,uus,uu,u,s;
			split='randhash=';
			uu=window.location.href;
			uu=uu.replace(/#/g,'');
			s=new Date().getTime();
			if(uu.indexOf(split)>-1){
				uus=uu.split(split);
				u=uus[0]+split+s;
			}else{
				if(uu.indexOf('?')>-1){
					u=uu+'&'+split+s;
				}else{
					u=uu+'?'+split+s;
				}
			}
			window.location.href=u;
		}
	}
	var autohpdiv=false;
	$('img.autohelp').bind({
		mouseenter:function(){
			var m,x,mw,mh,w,h,pos,mt,top,left;
			m=$(this);
			x=$.trim(m.attr('alt'));
			if(x!=''){
				m.addClass('autohelp_hv');
				m.attr('alt','');
				m.attr('rel',x);
				if(!autohpdiv){
					autohpdiv=$('<div class="autohelp_show"></div>');
					autohpdiv.appendTo('body');
				}
				autohpdiv.css({left:0,top:-900});
				x=x.replace(/\\n/g,'<br />');
				autohpdiv.html(x);
				mt=$(document).scrollTop();
				mw=$(window).width();
				mh=$(window).height();
				w=autohpdiv.outerWidth();
				h=autohpdiv.outerHeight();
				pos=m.offset();
				pos.width=m.outerWidth();
				pos.height=m.outerHeight();
				left = pos.left + pos.width;
				if((mw-pos.left) < w  && pos.left > w){
					left = pos.left - w;
				}
				top = pos.top + pos.height;
				if(mh-(pos.top - mt)<h  && (pos.top - mt)>h){
					top = pos.top - h;
				}
				autohpdiv.css({top:top,left:left});
				autohpdiv.show();
			}
		},
        mouseleave:function(){
			$(this).attr('alt',$(this).attr('rel'));
			$(this).removeClass('autohelp_hv');
			if(autohpdiv){
				autohpdiv.hide();
			}
		}
	});

	subnav();
	UpimgAuto();
});
