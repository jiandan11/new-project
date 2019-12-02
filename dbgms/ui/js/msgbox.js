var sonwin=0,
    cache={},
    ie=$.browser.msie ? true : false,
    ie6=(ie && $.browser.version < 7) ? true : false;
var msgbox ={
	/*------------
	    核心部件
    ------------------------------------*/
	box:function(msgtitle,cfg,msgid){
       var self,defaultcfg,htm,msgbox,msgdiv,msgtitbox,css;
       self=this;
//		       width = width || 500;
       msgid = msgid&&$.trim(msgid)!='' ? msgid : 'msgbox_relative';
       defaultcfg={
	      //提示框宽度 
          width:'600px',
	      height:'auto',
	      showtype:'swing',
	      //页面是否可点击
          pageclick:false,
	      canmove:true,
	      //额外样式
	      style:'',
	      mwidth:0
       };
       cfg = $.extend(defaultcfg,cfg||{});
       cfg.title=msgtitle||'弹出对话框';
  	   cfg.mwidth=cfg.width*1+16;
       self.msgbox_cfg = cfg;

       //防止已经有弹出窗口 先全部隐藏
       $('.dialog').hide();
       if(cfg.style!=''){
	      if($('#'+msgid+'_css').length>0){
		       $('#'+msgid+'_css').remove();
	      }
	      $('<style id="'+msgid+'_css">'+cfg.style+'</style>').appendTo('head');
       }
       if($('#'+msgid).length>0){
           msgbox=$('#'+msgid);
           msgbox.css({top:-4000,left:0});
           msgbox.show();
       }else{
           htm='<div id="'+msgid+'" class="dialog"><div class="dialog_bg"></div><div class="dialog_wrap"><div class="dialog_main"><div class="dialog_top"><a href="###"'+(ie6 ? ' style="text-indent:0"' : '')+'>×</a><h2></h2></div><blockquote></blockquote></div></div></div>';
           msgbox=$(htm);
           msgbox.css({top:-4000,left:0});
           msgbox.appendTo('body');
       }
       self.msgbox_cfg.msgbox=$('#'+msgid);
       return true;
    },

	msg:function(msg){
       var self,cfg,msgbox,msgboxbg,msgboxw,msgboxm,msgcon,msgtit,closebtn,
           styleh,mwidth,mheight,pw,ph,left,top,hh;
       self=this;
	   hh=$(document).height();
	   cfg=self.msgbox_cfg;
	   msgbox=cfg.msgbox;

	   msgboxbg=$(msgbox.children('div')[0]);
	   msgboxw=$(msgbox.children('div')[1]);
	   msgboxm=$(msgboxw.children('div')[0]);
	   msgtit=$(msgboxm.children('div')[0]).find('h2');
	   closebtn=$(msgboxm.children('div')[0]).find('a');
	   msgcon=$(msgboxm.children('blockquote')[0]);

	   $.extend(cache,{msgboxbg:msgboxbg,msgboxw:msgboxw,msgboxm:msgboxm,msgtit:msgtit,closebtn:closebtn,msgcon:msgcon});
	   
	   styleh=cfg.height=='auto'?'auto':cfg.height;

	   //设置容器
	   msgtit.html(cfg.title);
	   msgbox.css({width:cfg.mwidth});
	   msgboxbg.css({width:cfg.mwidth});
	   msgboxm.css({width:cfg.width});
	   msgcon.css({width:cfg.width,height:styleh});
	   msgcon.html('');
	   msgcon.append(msg);
	   
	   mwidth=msgboxm.width()+16;
	   mheight=msgboxm.height()+16;
	   pw=$(window).width();
	   ph=$(window).height();
	   
	   msgboxbg.css({height:mheight});
	   left=mwidth>pw?0:Math.floor((pw-mwidth)/2);
	   top=mheight>ph?0:Math.floor((ph-mheight)/3.5);
	   if(ie6){
		   top=top+$(document).scrollTop();
	   }
	   msgbox.css({left:left});


	   //若页面不可点击
	   if(!cfg.pageclick){
		   if($('#page_allhide').length>0){
			   $('#page_allhide').css({height:hh});
			   $('#page_allhide').show();
		   }else{
			   $('<div id="page_allhide" class="page_allhide" style="height:'+hh+'px"></div>').appendTo('body');
		   }
		}
		//窗口出现的效果
		if(cfg.showtype=='none'){
			msgbox.css({top:top});
		}else{
			msgbox.css({top:(top-100)});
			msgbox.animate({top:top},200,cfg.showtype,function(){
				self.fixie6(mwidth,mheight);
			});
		}
		closebtn.one('click',function(event){
			event.preventDefault();
			self.close();
		});
		//改变浏览器大小时候 重置Drag 居中窗口(如果不可移动) ie系重置pagehide
		$(window).bind('resize',{obj:self},self.fixpos);
	},
	fixie6:function(mwidth,mheight){
		if(ie6){
			var msgbox=this.msgbox_cfg.msgbox;
			if($('#dialog_ieiframe').length>0){
				$('#dialog_ieiframe').css({width:mwidth,height:mheight}).show();
			}else{
				$('<iframe id="dialog_ieiframe" frameborder="0" style="width:'+mwidth+'px;height:'+mheight+'px;position:absolute;z-index:1002;border:0;margin:0;padding:0;background:#000"></iframe>').appendTo(msgbox);
			}
		}
	},
	fixpos:function(event){
		var self,cfg,msgbox,msgtit,msgboxm,mwidth,mheight,pw,ph,hh,left,top;
		self=event.data.obj;
		cfg=self.msgbox_cfg;

		msgbox=cfg.msgbox;
		msgtit=cache.msgtit;
		msgboxm=cache.msgboxm;

		hh=$(document).height();
		mwidth=msgboxm.width()+16;
		mheight=msgboxm.height()+16;
		pw=$(window).width();
		ph=$(window).height();

		if(!cfg.pageclick && $('#page_allhide').length>0){
			$('#page_allhide').css({height:hh});
		}
		if(cfg.canmove){
			Drag.init(msgtit[0],msgbox[0],0,pw-mwidth,0,(ie6?hh-mheight:ph-mheight));
		}else{
			Drag.move(msgtit[0]);
			left=mwidth>pw?0:Math.floor((pw-mwidth)/2);
			left=Math.max(0,left);
			top=mheight>ph?0:Math.floor((ph-mheight)/2);
			top=Math.max(0,top);
			msgbox.css({left:left,top:top});
		}
	},
	
	close:function(){
		var self=this;
		if(!self.msgbox_cfg.pageclick){
			$('#page_allhide').remove();
		}
		self.msgbox_cfg.msgbox.remove();
		$(window).unbind('resize',self.fixpos);
	},
	show:function(){},
	hide:function(){
		var self=this;
		if(!self.msgbox_cfg.pageclick){
			$('#page_allhide').hide();
		}
		self.msgbox_cfg.msgbox.hide();
		$(window).unbind('resize',self.fixpos);
	},
	resetSize:function(loader){
		var self,cfg,msgbox,msgtit,msgboxm,msgboxbg,mwidth,mheight,pw,ph,left,top,hh;
		loader=loader||0;
		self=this;
		cfg=self.msgbox_cfg;
		
		msgbox=self.msgbox_cfg.msgbox;
		msgtit=cache.msgtit;
		msgboxm = cache.msgboxm;
		msgboxbg = cache.msgboxbg;
		
		mwidth=msgboxm.width()+16;
		mheight=msgboxm.height()+16;
		msgboxbg.css({height:mheight});

		hh=$(document).height();

		pw=$(window).width();
		ph=$(window).height();
		
		if(loader){
			left=mwidth>pw?0:Math.floor((pw-mwidth)/2);
			left=Math.max(0,left);
			top=mheight>ph?0:Math.floor((ph-mheight)/2);
			if(ie6){
				top=top+$(document).scrollTop();
			}
			top=Math.max(0,top);
			msgbox.css({left:left,top:top});
			self.fixie6(mwidth,mheight);
		}
	},
	/*------------
	    Msgbox插件部件
    ------------------------------------*/
	layer:function(msg,t,f){
		var self=this;
		if(sonwin==0 || sonwin==2){
			var id,left,doc,obj;
			id='layer_absolute';
			msg=msg||'提示信息';
			t=t||2500;
			if(self.layer_timeer){
				clearTimeout(self.layer_timeer);
				self.layer_timeer=null;
			}
			doc=window.top.document;
			obj=$('#'+id,doc);
			if(obj.length>0){
				obj.html(msg);
				obj.css({top:'-500px'});
				obj.show();
			}else{
				obj=$('<div class="layer" id="'+id+'" style="cursor:pointer;top:-500px" title="点击立即 解除通知" onclick="this.style.display=\'none\';">'+msg+'</div>',doc);
				obj.appendTo($('body',doc));
			}
			left=Math.floor(($(window.top).width()-obj.width())/2);
			obj.css({left:left,top:5});
			self.layer_timeer=setTimeout(function(){
				obj.hide();
				if($.isFunction(f)){
					f();
				} 
			},t);
		}else{
			alert(msg);
		}
	},
	loader:function(num){
		var self=this;
		num=num||0;
		if($('#dialog_loadline').length>0){
			$('#dialog_loadline b').css(width,num+'%');
			$('#dialog_loadline_num b').html(num);
		}else{
			var htm='<div class="dialog_loadline_wrp"><div class="dialog_loadline" id="dialog_loadline"><b style="width:'+num+'%"></b></div><div id="dialog_loadline_num">已执行：<b>'+num+'</b>%</div></div>';
			self.msg(htm);
		}
	},
	alert:function(msg,callback){
		var self,obj,btns,btn_canel,btn_ok;
		self=this;
		self.box('提示信息');
		obj=$('<span></span>');
		$('<div class="dialog_justtxt">'+msg+'</div>').appendTo(obj);
		btns=$('<div class="dialog_btns"></div>');
		btn_canel=$('<button class="btnno" type="button"> 关 闭 </button>');
		btn_canel.one('click',function(){
			self.close();
			if($.isFunction(callback)){
				callback(0);
			}
		});
		btn_canel.appendTo(btns);
		if($.isFunction(callback)){
			btn_ok=$('<button class="btnyes" type="button"> 确 定 </button>');
			btn_ok.one('click',function(){
				self.close();
				callback(1);
			});
			btn_ok.appendTo(btns);
		}
		btns.appendTo(obj);
		self.msg(obj);
	},			
	
	list_gval:function(ul,hh){
		var self,lis,len,i,rs,arr;
		self=this;
		hh=hh||0;
		lis=$('li',ul);
		len=lis.length;
		rs=[];
		if(len){
			for(i=0;i<len;i++){
				arr={};
				arr.rel=$(lis[i]).attr('rel');
				arr.name=$(lis[i]).html();
				arr.check=$(lis[i]).hasClass('sel');
				if(hh){
					arr.obj=lis[i];
				}
				rs.push(arr);
			}
		}
		return rs;
	},
	list_tog:function(elm){
		var self=this;
		elm.bind('click',function(){
			if($(this).hasClass('sel')){
				$(this).removeClass('sel');
			}else{
				$(this).addClass('sel');
			}
		});
	},
	list_sel:function(wrp,elm){
		var self,sels,ul,rel,name,li,toc,hset,len,i;
		self=this;
		elm=$(elm);
		sels=$('.dialog_ethsel',wrp);
		if(sels){
			rel=elm.attr('rel');
			name=elm.html();
			toc=true;
			ul=$('ul',sels);
			hset=self.list_gval(ul,1);
			len=hset.length;
			for(i=0;i<len;i++){
				if(hset[i].rel == rel){
					toc=false;
					if(!hset[i].check){
						$(hset[i].obj).addClass('sel');
					}
				}
			}
			if(toc){
				li=$('<li rel="'+rel+'" class="sel">'+name+'</li>');
				li.appendTo(ul);
				self.list_tog(li);
				self.resetSize();
			}
		}
	},

	list:function(boxtitle,url,ismore,func,pg,q){
		var self=this;
		self.selbox_topid=0;
		self.box(boxtitle,{width:700,showtype:'none'});
		self.list_load(url,ismore,func,pg,q,1);
	},
	list_load:function(url,ismore,func,pg,q,loader){
		var self,tosear,isload,wrp,lda,edlist,purl;
		self=this;
		ismore=ismore||0;
		func=func||null;
		pg=pg||0;
		q=q||'';
		loader=loader||0;
		tosear = url.indexOf('~key~')>-1 ? 1 : 0;
		isgcom = url.indexOf('load_company')>-1 ? 1 : 0;
		if($('#dialog_selboxab').length>0){
			wrp = $('#dialog_selboxab');
			edlist = $('.dialog_etdlist',wrp);
			isload=false;
		}else{
			wrp=$('<div class="dialog_etwrp" id="dialog_selboxab"></div>');
			edlist=$('<div class="dialog_etdlist"></div>');
			edlist.appendTo(wrp);
			isload=true;
			self.msg(wrp);
		}
		//edlist.html('<div class="dialog_loading"></div>');
		purl = url.replace('~key~',encodeURIComponent(q));
		if(isload){
			purl += '&load=1';
		}else{
			purl += '&page='+pg;
		}
		purl += '&topid='+self.selbox_topid;

		$.getJSON(purl,function(jdata){
			var i,len,li;
			edlist.html('');

			var jlist,jpage,dlist,dlistul,dlistli,dpage,dplink;
			jlist=jdata.data;
			len=jlist.length;
			jpage=jdata.pagebreak;
			dlist = $("<div class=\"dialog_etmsel\" style=\"font-family:'微软雅黑';\"><form name=\"form_addcp\" enctype=\"multipart/form-data\" method=\"post\" style=\"display:none;height:170px;\" id=\"regform\"><div style=\"padding-top:30px;padding-left:30px;\"><input type=\"hidden\" value=\"save_company\" name=\"ac\"><dl><dt style=\"float: left;font-size: 14px;height: 37px;line-height: 37px;text-align: right;width: 109px;\">公司全称：</dt><dd style=\"float:left;padding-left:20px;\"><input type=\"text\" id='fname' name=\"fullname\" style=\"background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #E0E0E0;float: left;height: 35px;line-height: 35px;padding: 0 2px;width:300px;\"><em>*</em></dd></dl><div style=\"clear:both;\"></div><dl style='margin-top:10px;'><dt style=\"float: left;font-size: 14px;height: 37px;line-height: 37px;text-align: right;width: 109px;\">简称：</dt><dd style=\"float:left;padding-left:20px;\"><input type=\"text\" name=\"shortname\" id='sname' style=\"background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #E0E0E0;float: left;height: 35px;line-height: 35px;padding: 0 2px;width:300px;\"><em>*</em></dd></dl><dl><dt style=\"float: left;font-size: 14px;height: 37px;line-height: 37px;text-align: right;width: 109px;\"></dt><dd style=\"float:left;padding-left:20px;\"><input type=\"button\" style=\" background: none repeat scroll 0 0 #CE2029;border: medium none;color: #FFFFFF;cursor: pointer;font-size: 16px; height: 31px; margin: 10px 0 0 114px; width: 91px;\" onclick=\"var fnames=$('#fname').val();if($('#fname').val()==''||$('#fname').val()==''){alert('厂商信息部分为空，请填写完整再提交。');return false;}$.ajax({type:'post',data:$('#regform').serialize(),url:'index.php?tn=a_do',cache:false,dataType:'html',error:function(){alert('接收路径出错。');},success:function(data){var num = Number(data);if(num > 0){$('.dialog_etdlist').siblings().eq(0).show().children('div').eq(0).show();$('.dialog_etdlist .dialog_etmsel').children('form').hide().end().children('ul').show();$('.dialog_etspage').show().siblings().eq(0).css('height','97px');$('.totle b').html('1');$('.btnser').click();}}});\"  value=\"提交\"></dd></dl></div></form></div>");
			dlistul=$('<ul></ul>');
			for(i=0;i<len;i++){
				li=$('<li rel="'+jlist[i].id+'">'+jlist[i].name+(jlist[i].num ? '('+jlist[i].num+')' : '')+'</li>').bind('click',function(){
					if(ismore){
						self.list_sel(wrp,this);
					}else{
						if($.isFunction(func)){
							var rsback={};
							rsback.rel=$(this).attr('rel');
							rsback.name=$(this).html();
							func(rsback);
						}else{
							alert('未设置 CallBack 接口')
						}
						self.close();
					}
				}).appendTo(dlistul);
			}
			if(len<=0&&isgcom){
				$("<div style=\"font-size: 16px;padding-top: 73px;text-align: center;font-family:'微软雅黑';color:#bbb;\">未搜索到您的公司？<span><a id=\"cp_add_btn\" href=\"#\" style=\"color: #CE2029;text-decoration: underline;\" onclick=\"$('.dialog_etssel').hide();$('.dialog_etdlist .dialog_etmsel').children('form').eq(0).show();$('.dialog_search').hide();$('.dialog_etmsel').children('ul').eq(0).hide();$('.dialog_etspage').hide();return false;\">添加公司</a></span></div>").appendTo(dlistul);
			}
			dlistul.appendTo(dlist);
			dlist.appendTo(edlist);
			
			dpage=$('<div class="dialog_etspage"></div>');
			dpage.html('<div class="dialog_pages">'+jpage+'</div>');
			dpage.appendTo(edlist);
			dplink=$('a',dpage);
			dplink.bind('click',function(event){
				var h;
				event.preventDefault();
				h=$(this).attr('rel');
				h=h==''?1:h*1;
				self.list_load(url,ismore,func,h,q);
			});
			
			//dbg页脚选中
			$('#page'+jdata.page).addClass('on');
			
			if(isload)
			{
				var sdlist=edlist;
				if(ismore)
				{
					var hsel,top,topul;
					hsel=jdata.sels;
					top=$('<div class="dialog_ethsel"></div>');
					topul=$('<ul></ul>');
					len=hsel.length;
					
					for(i=0;i<len;i++){
						li=$('<li rel="'+hsel[i].id+'" class="sel">'+hsel[i].name+'</li>');
						self.list_tog(li);
						li.appendTo(topul);
					}
					topul.appendTo(top);
					top.insertBefore(edlist);
					sdlist=top;
					
					var btns,btnok,btncel,rsback;
					btns=$('<div class="dialog_etbsel"><div><button class="btnyes" type="button"> 确 定 </button><button class="btnno" type="button"> 取 消 </button></div></div>');
					btnok=$('.btnyes',btns);
					btncel=$('.btnno',btns);
					btncel.bind('click',function(){self.close(); });
				
					btnok.bind('click',function(){
						if($.isFunction(func)){
							rsback=self.list_gval(topul);
							func(rsback);
						}else{
							alert('未设置 CallBack 接口')
						}
						self.close();
					});
					btns.insertAfter(edlist);
				}

				//确定是否需要筛选或搜索 DIV
				if(jdata.topids || tosear)
				{
					var esear,sall,sclt,sinp,sbtn,keydown;
					sinp=null;
					sall=true;
					esear=$('<div class="dialog_search"></div>');
					if(jdata.topids)
					{
						sall=false;
						len=jdata.topids.length;
						sclt=$('<select class="tsel" style="float:left;width:120px;margin-right:5px"></select>').bind('change',function(){
							self.selbox_topid=this.value;
							if(sinp){
								sinp.val('');
							}
							self.list_load(url,ismore,func,0,'');
						});
						$('<option value="0">--所有--</option>').appendTo(sclt);
						for(i=0;i<len;i++){
							$('<option value="'+jdata.topids[i].id+'">'+jdata.topids[i].name+'</option>').appendTo(sclt);
						}
						sclt.appendTo(esear);
					}
					if(tosear)
					{
						keydown=ie6 ? 'keypress' : 'keydown';
						sinp=$('<input type="text" class="inp">').appendTo(esear);
						sbtn=$('<button class="btnser" type="button"> 确 定 </button>').appendTo(esear);
						sinp.bind(keydown,function(event){
							var key,k=event.which*1;
							if(k==13){
								key=sinp.val();
								self.list_load(url,ismore,func,0,key);
							}
						});
						sbtn.bind('click',function(){
							var key=sinp.val();
							self.list_load(url,ismore,func,0,key);
						});
						if(sall){
							$('<a href="###">全部</a>').bind('click',function(event){
								event.preventDefault();
								sinp.val('');
								self.list_load(url,ismore,func,0,'');
							}).appendTo(esear);
						}
					}
					esear.css("width",(sall ? 280 : 370)).appendTo($('<div class="dialog_etssel"></div>').insertBefore(edlist));
				}

			}//End isload
			self.resetSize(loader);
		})
	},
	/*------------
	    Msgbox载入
    ------------------------------------*/
	init:function(win){
		var self=this;
		win=win||0;
		sonwin=win;
		return self;
	}
}
msgbox.init(0);
