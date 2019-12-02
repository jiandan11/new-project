/*jquery-msglayer*/
;(function(a){a.msglayer=function(d,b){d=a.trim(d)||"";if(d!=""){if(!a("win_msglayer_css").length){a(a("head")[0]).append('<style type="text/css" rel="stylesheet" id="win_msglayer_css">.win_msglayer{width:100%;height:50px;position:fixed;z-index:2147483647;left:0;top:50%;margin-top:-25px;pointer-events:none;_position:absolute;}.win_msglayer .win_msglayer_pz{position:relative;left:50%;float:left;}.win_msglayer .win_msglayer_pz div{position:relative;float:left;left:-50%;}.win_msglayer .win_msglayer_pz div b{pointer-events:auto;height:50px;font-size:18px;line-height:50px;padding:0 22px;background:#000;color:#fff;filter:alpha(opacity=60);opacity:0.60;border-radius:25px;font-family:"Microsoft YaHei",Arial;overflow:hidden;display:inline-block;}</style>')}a(".win_msglayer").remove();var c=a('<div class="win_msglayer"><div class="win_msglayer_pz"><div><b>'+d+"</b></div></div></div>");if(a.browser.msie&&a.browser.version<7){c.css({top:(a(window).scrollTop()+a(window).height()/2)})}a("body").append(c);setTimeout(function(){c.remove();if(a.isFunction(b)){b()}},2500)}};a.msglayer.Later=function(b){a.cookie("msglayer",b)};a.msglayer.Auto=function(b){var b=a.cookie("msglayer");if(b&&b!=""){a.msglayer(b);a.removeCookie("msglayer")}}})(jQuery);

/*
 * dbgms通用：banner 幻灯片
 */

/*
 * ! SuperSlide v2.1.1 v2.1.1：修复当调用多个SuperSlide，并设置returnDefault:true
 * 时返回defaultIndex索引错误
 */
(function($){$.fn.slide = function(options){$.fn.slide.defaults = {type:"slide",effect:"fade",autoPlay:false,delayTime:500,interTime:2500,triggerTime:150,
			defaultIndex:0,titCell:".hd li",
			mainCell:".bd",
			targetCell:null,
			trigger:"mouseover",
			scroll:1,
			vis:1,
			titOnClassName:"on",
			autoPage:false,
			prevCell:".prev",
			nextCell:".next",
			pageStateCell:".pageState",
			opp:false,
			pnLoop:true,
			easing:"swing",
			startFun:null,
			endFun:null,
			switchLoad:null,
			playStateCell:".playState",
			mouseOverStop:true,
			defaultPlay:true,
			returnDefault:false
		};
		return this.each(function(){
			var opts = $.extend({}, $.fn.slide.defaults, options);
			var slider = $(this);
			var effect = opts.effect;
			var prevBtn = $(opts.prevCell, slider);
			var nextBtn = $(opts.nextCell, slider);
			var pageState = $(opts.pageStateCell, slider);
			var playState = $(opts.playStateCell, slider);
			var navObj = $(opts.titCell, slider);/* 导航子元素结合 */
			var navObjSize = navObj.size();
			var conBox = $(opts.mainCell, slider);/* 内容元素父层对象.bd */
			var conBoxSize = conBox.children().size();
			var sLoad = opts.switchLoad;
			var tarObj = $(opts.targetCell, slider);
			/* 字符串转换 */
			var index = parseInt(opts.defaultIndex);
			var delayTime = parseInt(opts.delayTime);
			var interTime = parseInt(opts.interTime);
			var triggerTime = parseInt(opts.triggerTime);
			var scroll = parseInt(opts.scroll);
			var vis = parseInt(opts.vis);
			var autoPlay = (opts.autoPlay == "false" || opts.autoPlay == false) ? false:true;
			var opp = (opts.opp == "false" || opts.opp == false) ? false:true;
			var autoPage = (opts.autoPage == "false" || opts.autoPage == false) ? false:true;
			var pnLoop = (opts.pnLoop == "false" || opts.pnLoop == false) ? false:true;
			var mouseOverStop = (opts.mouseOverStop == "false" || opts.mouseOverStop == false) ? false:true;
			var defaultPlay = (opts.defaultPlay == "false" || opts.defaultPlay == false) ? false:true;
			var returnDefault = (opts.returnDefault == "false" || opts.returnDefault == false) ? false:true;
			var slideH = 0;
			var slideW = 0;
			var selfW = 0;
			var selfH = 0;
			var easing = opts.easing;
			var inter = null; /* autoPlay-setInterval */
			var mst = null; /* trigger-setTimeout */
			var rtnST = null; /* returnDefault-setTimeout */
			var titOn = opts.titOnClassName;
			var onIndex = navObj.index(slider.find("." + titOn));
			var oldIndex = index = onIndex == -1 ? index:onIndex;
			var defaultIndex = index;
			var _ind = index;
			var cloneNum = conBoxSize >= vis ? (conBoxSize % scroll != 0 ? conBoxSize % scroll:scroll):0;
			var _tar;
			var isMarq = effect == "leftMarquee" || effect == "topMarquee" ? true:false;
			var doStartFun = function(){
				if($.isFunction(opts.startFun)){
					opts.startFun(index, navObjSize, slider, $(opts.titCell, slider), conBox, tarObj, prevBtn, nextBtn);
				}
			}
			var doEndFun = function(){
				if($.isFunction(opts.endFun)){
					opts.endFun(index, navObjSize, slider, $(opts.titCell, slider), conBox, tarObj, prevBtn, nextBtn);
				}
			}
			var resetOn = function(){
				navObj.removeClass(titOn);
				if(defaultPlay){
					navObj.eq(defaultIndex).addClass(titOn);
				}
			}

			/* 单独处理菜单效果 */
			if(opts.type == "menu"){
				if(defaultPlay){
					navObj.removeClass(titOn).eq(index).addClass(titOn);
				}
				navObj.hover(function(){
					_tar = $(this).find(opts.targetCell);
					var hoverInd = navObj.index($(this));

					mst = setTimeout(function(){
						index = hoverInd;
						navObj.removeClass(titOn).eq(index).addClass(titOn);
						doStartFun();
						switch(effect){
						case "fade":
							_tar.stop(true, true).animate({
								opacity:"show"
							}, delayTime, easing, doEndFun);
							break;
						case "slideDown":
							_tar.stop(true, true).animate({
								height:"show"
							}, delayTime, easing, doEndFun);
							break;
						}
					}, opts.triggerTime);

				}, function(){
					clearTimeout(mst);
					switch(effect){
					case "fade":
						_tar.animate({
							opacity:"hide"
						}, delayTime, easing);
						break;
					case "slideDown":
						_tar.animate({
							height:"hide"
						}, delayTime, easing);
						break;
					}
				});

				if(returnDefault){
					slider.hover(function(){
						clearTimeout(rtnST);
					}, function(){
						rtnST = setTimeout(resetOn, delayTime);
					});
				}
				return;
			}
			/* 处理分页 */
			if(navObjSize == 0)
				navObjSize = conBoxSize;/* 只有左右按钮 */
			if(isMarq)
				navObjSize = 2;
			if(autoPage){
				if(conBoxSize >= vis){
					if(effect == "leftLoop" || effect == "topLoop"){
						navObjSize = conBoxSize % scroll != 0 ? (conBoxSize / scroll ^ 0) + 1:conBoxSize / scroll;
					}else{
						var tempS = conBoxSize - vis;
						navObjSize = 1 + parseInt(tempS % scroll != 0 ? (tempS / scroll + 1):(tempS / scroll));
						if(navObjSize <= 0){
							navObjSize = 1;
						}
					}
				}else{
					navObjSize = 1;
				}
				navObj.html("");
				var str = "";
				if(opts.autoPage == true || opts.autoPage == "true"){
					for(var i = 0;i < navObjSize;i++){
						str += "<li>" + (i + 1) + "</li>";
					}
				}else{
					for(var i = 0;i < navObjSize;i++){
						str += opts.autoPage.replace("$", (i + 1))
					}
				}
				navObj.html(str);
				var navObj = navObj.children();/* 重置导航子元素对象 */
			}

			if(conBoxSize >= vis){ /* 当内容个数少于可视个数，不执行效果。 */
				conBox.children().each(function(){ /* 取最大值 */
					if($(this).width() > selfW){
						selfW = $(this).width();
						slideW = $(this).outerWidth(true);
					}
					if($(this).height() > selfH){
						selfH = $(this).height();
						slideH = $(this).outerHeight(true);
					}
				});

				var _chr = conBox.children();
				var cloneEle = function(){
					for(var i = 0;i < vis;i++){
						_chr.eq(i).clone().addClass("clone").appendTo(conBox);
					}
					for(var i = 0;i < cloneNum;i++){
						_chr.eq(conBoxSize - i - 1).clone().addClass("clone").prependTo(conBox);
					}
				}

				switch(effect){
				case "fold":
					conBox.css({
						"position":"relative",
						"width":slideW,
						"height":slideH
					}).children().css({
						"position":"absolute",
						"width":selfW,
						"left":0,
						"top":0,
						"display":"none"
					});
					break;
				case "top":
					conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + vis * slideH + 'px"></div>').css({
						"top":-(index * scroll) * slideH,
						"position":"relative",
						"padding":"0",
						"margin":"0"
					}).children().css({
						"height":selfH
					});
					break;
				case "left":
					conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + vis * slideW + 'px"></div>').css({
						"width":conBoxSize * slideW,
						"left":-(index * scroll) * slideW,
						"position":"relative",
						"overflow":"hidden",
						"padding":"0",
						"margin":"0"
					}).children().css({
						"float":"left",
						"width":selfW
					});
					break;
				case "leftLoop":
				case "leftMarquee":
					cloneEle();
					conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + vis * slideW + 'px"></div>').css({
						"width":(conBoxSize + vis + cloneNum) * slideW,
						"position":"relative",
						"overflow":"hidden",
						"padding":"0",
						"margin":"0",
						"left":-(cloneNum + index * scroll) * slideW
					}).children().css({
						"float":"left",
						"width":selfW
					});
					break;
				case "topLoop":
				case "topMarquee":
					cloneEle();
					conBox.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + vis * slideH + 'px"></div>').css({
						"height":(conBoxSize + vis + cloneNum) * slideH,
						"position":"relative",
						"padding":"0",
						"margin":"0",
						"top":-(cloneNum + index * scroll) * slideH
					}).children().css({
						"height":selfH
					});
					break;
				}
			}

			/* 针对leftLoop、topLoop的滚动个数 */
			var scrollNum = function(ind){
				var _tempCs = ind * scroll;
				if(ind == navObjSize){
					_tempCs = conBoxSize;
				}else if(ind == -1 && conBoxSize % scroll != 0){
					_tempCs = -conBoxSize % scroll;
				}
				return _tempCs;
			}

			/* 切换加载 */
			var doSwitchLoad = function(objs){
				var changeImg = function(t){
					for(var i = t;i < (vis + t);i++){
						objs.eq(i).find("img[" + sLoad + "]").each(function(){
							var _this = $(this);
							_this.attr("src", _this.attr(sLoad)).removeAttr(sLoad);
							if(conBox.find(".clone")[0]){ /* 如果存在.clone */
								var chir = conBox.children();
								for(var j = 0;j < chir.size();j++){
									chir.eq(j).find("img[" + sLoad + "]").each(function(){
										if($(this).attr(sLoad) == _this.attr("src"))
											$(this).attr("src", $(this).attr(sLoad)).removeAttr(sLoad)
									})
								}
							}
						})
					}
				}

				switch(effect){
				case "fade":
				case "fold":
				case "top":
				case "left":
				case "slideDown":
					changeImg(index * scroll);
					break;
				case "leftLoop":
				case "topLoop":
					changeImg(cloneNum + scrollNum(_ind));
					break;
				case "leftMarquee":
				case "topMarquee":
					var curS = effect == "leftMarquee" ? conBox.css("left").replace("px", ""):conBox.css("top").replace("px", "");
					var slideT = effect == "leftMarquee" ? slideW:slideH;
					var mNum = cloneNum;
					if(curS % slideT != 0){
						var curP = Math.abs(curS / slideT ^ 0);
						if(index == 1){
							mNum = cloneNum + curP;
						}else{
							mNum = cloneNum + curP - 1;
						}
					}
					changeImg(mNum);
					break;
				}
			}/* doSwitchLoad end */

			/* 效果函数 */
			var doPlay = function(init){
				/* 当前页状态不触发效果 */
				if(defaultPlay && oldIndex == index && !init && !isMarq)
					return;
				/* 处理页码 */
				if(isMarq){
					if(index >= 1){
						index = 1;
					}else if(index <= 0){
						index = 0;
					}
				}else{
					_ind = index;
					if(index >= navObjSize){
						index = 0;
					}else if(index < 0){
						index = navObjSize - 1;
					}
				}

				doStartFun();

				/* 处理切换加载 */
				if(sLoad != null){
					doSwitchLoad(conBox.children())
				}

				/* 处理targetCell */
				if(tarObj[0]){
					_tar = tarObj.eq(index);
					if(sLoad != null){
						doSwitchLoad(tarObj)
					}
					if(effect == "slideDown"){
						tarObj.not(_tar).stop(true, true).slideUp(delayTime);
						_tar.slideDown(delayTime, easing, function(){
							if(!conBox[0])
								doEndFun()
						});
					}else{
						tarObj.not(_tar).stop(true, true).hide();
						_tar.animate({
							opacity:"show"
						}, delayTime, function(){
							if(!conBox[0])
								doEndFun()
						});
					}
				}

				if(conBoxSize >= vis){ /* 当内容个数少于可视个数，不执行效果。 */
					switch(effect){
					case "fade":
						conBox.children().stop(true, true).eq(index).animate({
							opacity:"show"
						}, delayTime, easing, function(){
							doEndFun()
						}).siblings().hide();
						break;
					case "fold":
						conBox.children().stop(true, true).eq(index).animate({
							opacity:"show"
						}, delayTime, easing, function(){
							doEndFun()
						}).siblings().animate({
							opacity:"hide"
						}, delayTime, easing);
						break;
					case "top":
						conBox.stop(true, false).animate({
							"top":-index * scroll * slideH
						}, delayTime, easing, function(){
							doEndFun()
						});
						break;
					case "left":
						conBox.stop(true, false).animate({
							"left":-index * scroll * slideW
						}, delayTime, easing, function(){
							doEndFun()
						});
						break;
					case "leftLoop":
						var __ind = _ind;
						conBox.stop(true, true).animate({
							"left":-(scrollNum(_ind) + cloneNum) * slideW
						}, delayTime, easing, function(){
							if(__ind <= -1){
								conBox.css("left", -(cloneNum + (navObjSize - 1) * scroll) * slideW);
							}else if(__ind >= navObjSize){
								conBox.css("left", -cloneNum * slideW);
							}
							doEndFun();
						});
						break;/* leftLoop end */

					case "topLoop":
						var __ind = _ind;
						conBox.stop(true, true).animate({
							"top":-(scrollNum(_ind) + cloneNum) * slideH
						}, delayTime, easing, function(){
							if(__ind <= -1){
								conBox.css("top", -(cloneNum + (navObjSize - 1) * scroll) * slideH);
							}else if(__ind >= navObjSize){
								conBox.css("top", -cloneNum * slideH);
							}
							doEndFun();
						});
						break;/* topLoop end */

					case "leftMarquee":
						try{
							var tempLeft = conBox.css("left").replace("px", "");
						}catch(e){
							return;
						}
						if(index == 0){
							conBox.animate({
								"left":++tempLeft
							}, 0, function(){
								if(conBox.css("left").replace("px", "") >= 0){
									conBox.css("left", -conBoxSize * slideW)
								}
							});
						}else{
							conBox.animate({
								"left":--tempLeft
							}, 0, function(){
								if(conBox.css("left").replace("px", "") <= -(conBoxSize + cloneNum) * slideW){
									conBox.css("left", -cloneNum * slideW)
								}
							});
						}
						break;/* leftMarquee end */

					case "topMarquee":
						try{
							var tempTop = conBox.css("top").replace("px", "");
						}catch(err){
							break;
						}

						if(index == 0){
							conBox.animate({
								"top":++tempTop
							}, 0, function(){
								if(conBox.css("top").replace("px", "") >= 0){
									conBox.css("top", -conBoxSize * slideH)
								}
							});
						}else{
							conBox.animate({
								"top":--tempTop
							}, 0, function(){
								if(conBox.css("top").replace("px", "") <= -(conBoxSize + cloneNum) * slideH){
									conBox.css("top", -cloneNum * slideH)
								}
							});
						}
						break;/* topMarquee end */

					}/* switch end */
				}

				navObj.removeClass(titOn).eq(index).addClass(titOn);
				oldIndex = index;
				if(!pnLoop){ /* pnLoop控制前后按钮是否继续循环 */
					nextBtn.removeClass("nextStop");
					prevBtn.removeClass("prevStop");
					if(index == 0){
						prevBtn.addClass("prevStop");
					}
					if(index == navObjSize - 1){
						nextBtn.addClass("nextStop");
					}
				}

				pageState.html("<span>" + (index + 1) + "</span>/" + navObjSize);

			};/* doPlay end */

			/* 初始化执行 */
			if(defaultPlay){
				doPlay(true);
			}

			if(returnDefault)/* 返回默认状态 */
			{
				slider.hover(function(){
					clearTimeout(rtnST)
				}, function(){
					rtnST = setTimeout(function(){
						index = defaultIndex;
						if(defaultPlay){
							doPlay();
						}else{
							if(effect == "slideDown"){
								_tar.slideUp(delayTime, resetOn);
							}else{
								_tar.animate({
									opacity:"hide"
								}, delayTime, resetOn);
							}
						}
						oldIndex = index;
					}, 300);
				});
			}

			/* 自动播放函数 */
			var setInter = function(time){
				inter = setInterval(function(){
					opp ? index--:index++;
					doPlay()
				}, !!time ? time:interTime);
			}
			var setMarInter = function(time){
				inter = setInterval(doPlay, !!time ? time:interTime);
			}
			/* 处理mouseOverStop */
			var resetInter = function(){
				if(!mouseOverStop){
					clearInterval(inter);
					setInter()
				}
			}
			/* 前后按钮触发 */
			var nextTrigger = function(){
				if(pnLoop || index != navObjSize - 1){
					index++;
					doPlay();
					if(!isMarq)
						resetInter();
				}
			}
			var prevTrigger = function(){
				if(pnLoop || index != 0){
					index--;
					doPlay();
					if(!isMarq){
						resetInter();
					}
				}
			}
			/* 处理playState */
			var playStateFun = function(){
				clearInterval(inter);
				isMarq ? setMarInter():setInter();
				playState.removeClass("pauseState")
			}
			var pauseStateFun = function(){
				clearInterval(inter);
				playState.addClass("pauseState");
			}

			/* 自动播放 */
			if(autoPlay){
				if(isMarq){
					opp ? index--:index++;
					setMarInter();
					if(mouseOverStop)
						conBox.hover(pauseStateFun, playStateFun);
				}else{
					setInter();
					if(mouseOverStop)
						slider.hover(pauseStateFun, playStateFun);
				}
			}else{
				if(isMarq){
					opp ? index--:index++;
				}
				playState.addClass("pauseState");
			}

			playState.click(function(){
				playState.hasClass("pauseState") ? playStateFun():pauseStateFun();
			});

			/* titCell事件 */
			if(opts.trigger == "mouseover"){
				navObj.hover(function(){
					var hoverInd = navObj.index(this);
					mst = setTimeout(function(){
						index = hoverInd;
						doPlay();
						resetInter();
					}, opts.triggerTime);
				}, function(){
					clearTimeout(mst)
				});
			}else{
				navObj.click(function(){
					index = navObj.index(this);
					doPlay();
					resetInter();
				})
			}
			/* 前后按钮事件 */
			if(isMarq){
				nextBtn.mousedown(nextTrigger);
				prevBtn.mousedown(prevTrigger);
				/* 前后按钮长按10倍加速 */
				if(pnLoop){
					var st;
					var marDown = function(){
						st = setTimeout(function(){
							clearInterval(inter);
							setMarInter(interTime / 10 ^ 0)
						}, 150);
					}
					var marUp = function(){
						clearTimeout(st);
						clearInterval(inter);
						setMarInter();
					}
					nextBtn.mousedown(marDown);
					nextBtn.mouseup(marUp);
					prevBtn.mousedown(marDown);
					prevBtn.mouseup(marUp);
				}
				/* 前后按钮mouseover事件 */
				if(opts.trigger == "mouseover"){
					nextBtn.hover(nextTrigger, function(){
					});
					prevBtn.hover(prevTrigger, function(){
					});
				}
			}else{
				nextBtn.click(nextTrigger);
				prevBtn.click(prevTrigger);
			}

		});/* each End */
	};/* slide End */
})(jQuery);


/**
 * ds.dialog.js
 */
;(function(global,document,$,undefined){var view=$(global),DOC=$(document),ds=global.ds||(global.ds={});var _guid=0,_noop=function(){},_tmpl='<div class="ds_dialog_outer"><table class="ds_dialog_border"><tr><td class="ds_dialog_tl"></td><td class="ds_dialog_tc"></td><td class="ds_dialog_tr"></td></tr><tr><td class="ds_dialog_ml"></td><td class="ds_dialog_mc"><div class="ds_dialog_inner"><table class="ds_dialog_panel"><tr><td colspan="2" class="ds_dialog_header"><div class="ds_dialog_title"><h3></h3></div><div class="ds_dialog_close"><a href="javascript:;">\u00d7</a></div></td></tr><tr><td class="ds_dialog_icon" style="display:none"><div class="ds_dialog_icon_bg"></div></td><td class="ds_dialog_main"><div id="{id}_content" class="ds_dialog_content"></div></td></tr><tr><td colspan="2" class="ds_dialog_footer"><div class="ds_dialog_buttons"></div></td></tr></table></div></td><td class="ds_dialog_mr"></td></tr><tr><td class="ds_dialog_bl"></td><td class="ds_dialog_bc"></td><td class="ds_dialog_br"></td></tr></table></div>',_ops={id:null,title:null,content:'',className:null,padding:'20px 25px',height:'auto',width:'auto',left:'50%',top:'40%',zIndex:1990,icon:null,iconBasePath:global.iconBasePath||'images/',buttons:null,follow:null,followOffset:null,autoOpen:true,esc:true,lock:true,lockOpacity:0.6,lockColor:'#000',showCloseButton:true,drag:true,fixed:true,anim:true,animDuration:320,timeout:0,oninit:_noop,onopen:_noop,onfocus:_noop,onmaskclick:_noop,onhide:_noop,onclose:_noop,yesText:'\u786e\u5b9a',noText:'\u53d6\u6d88',onyes:null,onno:null},Dialog=ds.Dialog=function(ops){return this.init(ops||{});};$.extend(Dialog,{items:{},defaults:_ops,currIndex:1990,defaultTmpl:_tmpl,activeDialog:null,dialogQueue:[],addDialog:function(dialog){var queue=this.dialogQueue;this.removeDialog(dialog);queue.push(dialog);dialog.inQueue=true;dialog.queueIndex=queue.length-1;},removeDialog:function(dialog){var i=dialog.queueIndex,queue=this.dialogQueue;if(dialog.inQueue){queue.splice(i,1);for(var len=queue.length;i<len;i++){queue[i].queueIndex--;}}dialog.inQueue=false;dialog.queueIndex=-1;},maskQueue:[],addMask:function(dialog){this.removeMask(dialog);this.maskQueue.push(dialog);dialog.maskIndex=this.maskQueue.length-1;},removeMask:function(dialog){var i=dialog.maskIndex,maskQueue=this.maskQueue;if(dialog.locked){maskQueue.splice(i,1);for(var len=maskQueue.length;i<len;i++){maskQueue[i].maskIndex--;}}dialog.maskIndex=-1;}});Dialog.items={};Dialog.defaults=_ops;Dialog.currZIndex=1990;Dialog.defaultTmpl=_tmpl;Dialog.prototype={version:'2.0',constructor:Dialog,init:function(ops){var id=typeof ops.id==='string'?ops.id:('ds_dialog_'+(++_guid));if(Dialog.items[id]){var dialog=Dialog.items[id],rOps=dialog.ops;var opsChangeMaps={left:1,top:1,follow:1,onopen:1,onfocus:1,onhide:1,onclose:1,onyes:1,onno:1,esc:2,lock:2,anim:2,drag:2,fixed:2,autoOpen:2,icon:3,content:3};$.each(ops,function(k,val){if(k in opsChangeMaps&&val!==void 0){var type=opsChangeMaps[k];if(type===2){val=!!val;}if(val!==rOps[k]){rOps[k]=val;type===3&&dialog[k](val);}}});dialog[rOps.drag?'initDrag':'releaseDrag']();dialog[rOps.fixed?'initFixed':'releaseFixed']();rOps.autoOpen&&dialog.show();return dialog;}$.each(_ops,function(k,val){typeof ops[k]==='undefined'&&(ops[k]=val);});if(!$.isArray(ops.followOffset)){ops.followOffset=[0,0];}this.id=id;this.ops=ops;this._getElem(ops);Dialog.items[id]=this;this._initEvent();this.padding(ops.padding).size(ops.width,ops.height).title(ops.title).button(ops.buttons).icon(ops.icon).content(ops.content).timeout(ops.timeout);typeof ops.oninit==='function'&&ops.oninit.call(this);ops.fixed&&this.initFixed&&this.initFixed();ops.drag&&this.initDrag&&this.initDrag();ops.autoOpen&&this.show();},_getElem:function(ops){var shell=document.createElement('div');shell.id=this.id;shell.tabIndex=-1;shell.style.position='absolute';shell.className='ds_dialog'+(ops.className?' '+ops.className:'');shell.innerHTML=Dialog.defaultTmpl.replace(/\{id\}/g,this.id);shell=this.shell=$(shell);this.contentShell=shell.find('.ds_dialog_content').eq(0);this.buttonShell=shell.find('.ds_dialog_buttons').eq(0);this.titleShell=shell.find('.ds_dialog_title').eq(0);this.closeShell=shell.find('.ds_dialog_close').eq(0);this.iconShell=shell.find('.ds_dialog_icon').eq(0);this.closeShell[ops.showCloseButton?'show':'hide']();var buttons=ops.buttons;if(!$.isArray(buttons)){buttons=ops.buttons=[];}if(ops.onyes===true||typeof ops.onyes==='function'){buttons.push({autoFocus:true,text:ops.yesText,className:'ds_dialog_yes',onclick:function(){return $.type(ops.onyes)==='function'&&ops.onyes.call(this)===false||!ops.onyes?false:this.hide();}});}if(ops.onno===true||typeof ops.onno==='function'){buttons.push({text:ops.noText,className:'ds_dialog_no',onclick:function(){return $.type(ops.onno)==='function'&&ops.onno.call(this)===false||!ops.onno?false:this.hide();}});}return shell;},_initEvent:function(){var self=this;this.closeShell.bind('click',function(e){e.stopPropagation();e.preventDefault();self.hide();});this.shell.bind('mousedown',function(){self.focus();});},isOpen:false,show:function(left,top){var ops=this.ops,shell=this.shell;if(!this._inDOM){this._inDOM=true;shell.appendTo('body');}if(!this.isOpen){ops.lock&&this.lock();!ops.follow||arguments.length>=1?this.position(left||ops.left,top||ops.top):this.follow(ops.follow,ops.followOffset[0],ops.followOffset[1]);ops.anim?shell.stop().animate({opacity:1},ops.animDuration):shell.stop().css('opacity',1);shell.css('display','block');this.isOpen=true;ops.onopen.call(this);}return this.focus();},hide:function(){var ops=this.ops;if(this.isOpen){this.isOpen=false;if(ops.onhide.call(this)!==false){this.blur().unlock();ops.anim?this.shell.stop().animate({opacity:0},ops.animDuration,function(){this.style.display='none';}):this.shell.stop().hide();Dialog.removeDialog(this);}else{this.isOpen=true;}}return this;},focus:function(){var ops=this.ops;if(this.isOpen&&!this.hasFocus&&ops.onfocus.call(this)!==false){Dialog.activeDialog&&Dialog.activeDialog._blur();Dialog.addDialog(this);var shell=this.shell;this.zIndex=Dialog.currZIndex=Math.max(++Dialog.currZIndex,this.ops.zIndex);shell.addClass('ds_dialog_active').css('zIndex',this.zIndex);if('focus'in shell[0]){shell[0].focus();this.focusButton&&this.focusButton.focus();}Dialog.activeDialog=this;this.hasFocus=true;}return this;},_blur:function(){this.hasFocus=false;this.shell.removeClass('ds_dialog_active');},blur:function(){if(this.hasFocus){this._blur();var queue=Dialog.dialogQueue,len=queue.length;if(len>1){queue[len-2].focus();}else{Dialog.activeDialog=null;}}return this;},close:function(){var self=this,ops=this.ops;if(this.shell&&ops.onclose.call(this)!==false){if(ops.anim){this.hide();setTimeout(function(){self.destory();},ops.animDuration);}else{this.hide().destory();}}},timeout:function(delay){var self=this;clearTimeout(this.timer);if(~~delay>0){this.timer=setTimeout(function(){self.close();},~~delay*1000);}return this;},destory:function(){delete Dialog.items[this.id];if(this.shell){this.shell.hide().remove();}this.shell=this.contentShell=this.buttonShell=this.titleShell=this.closeShell=this.iconShell=this.focusButton=null;},_getPositionLimit:function(){var ops=this.ops,shell=this.shell,offset=shell.offset(),viewScrollLeft=view.scrollLeft(),viewScrollTop=view.scrollTop(),shellWidth=shell.outerWidth(),shellHeight=shell.outerHeight(),viewWidth=view.width(),viewHeight=view.height(),minTop=ops.fixed?0:viewScrollTop,minLeft=ops.fixed?0:viewScrollLeft,maxTop=minTop+viewHeight-shellHeight,maxLeft=minLeft+viewWidth-shellWidth;return{minTop:minTop,minLeft:minLeft,maxTop:maxTop,maxLeft:maxLeft,viewHeight:viewHeight,viewWidth:viewWidth,height:shellHeight,width:shellWidth,top:offset.top,left:offset.left,viewScrollTop:viewScrollTop,viewScrollLeft:viewScrollLeft};},_position:function(left,top){var ops=this.ops,style=this.shell[0].style;style.left=left+'px';style.top=top+'px';},position:function(left,top){if(arguments.length<1){return this.shell.offset();}var ops=this.ops,rper=/(\d+\.?\d+)%/,limit=this._getPositionLimit();if(rper.test(left)){left=(limit.viewWidth-limit.width)*parseFloat(RegExp.$1)/100;left+=ops.fixed?0:limit.viewScrollLeft;}if(rper.test(top)){top=(limit.viewHeight-limit.height)*parseFloat(RegExp.$1)/100;top+=ops.fixed?0:limit.viewScrollTop;}left=Math.max(limit.minLeft,Math.min(limit.maxLeft,left));top=Math.max(limit.minTop,Math.min(limit.maxTop,top));this._position(left,top);return this;},size:function(width,height){this.contentShell.css('width',width).css('height',height);return this;},padding:function(padding){this.contentShell.css('padding',padding);return this;},follow:(function(){var _offsetMaps={left:function(){return 0;},right:function(shell,target){return target.outerWidth()-shell.outerWidth();},top:function(shell,target){return-shell.outerHeight();},bottom:function(shell,target){return target.outerHeight();}},_getOffset=function(shell,target,_offset){if(_offsetMaps[_offset[0]]){_offset[0]=_offsetMaps[_offset[0]](shell,target);}if(_offsetMaps[_offset[1]]){_offset[1]=_offsetMaps[_offset[1]](shell,target);}return[~~_offset[0],~~_offset[1]];};return function(target,left,top){target=$(target);var pos=$(target).offset(),offset=_getOffset(this.shell,target,[left,top]);if(this.ops.fixed){pos.left-=view.scrollLeft();pos.top-=view.scrollTop();}return this.position(pos.left+offset[0],pos.top+offset[1]);};})(),title:function(title){if(!title){this.titleShell.hide();}else{this.titleShell.html('<h3>'+title+'</h3>');this.titleShell.show();}return this;},content:function(content){this.contentShell.html(content);return this.position(this.ops.left,this.ops.top);},button:function(buttons){var self=this,ops=this.ops,shell=this.buttonShell.hide();if($.isArray(buttons)&&buttons.length>0){$.each(buttons,function(i){var btn=document.createElement('button');btn.disabled=this.disabled;btn.innerHTML='<span>'+this.text+'</span>';btn.className=this.className+(this.disabled?' disabled':'');btn=$(btn);var onclick=this.onclick;btn.bind('click',function(e){e.stopPropagation();typeof onclick==='function'&&onclick.call(self,this,e);});if(this.autoFocus){self.focusButton=btn;}shell.append(btn);});shell.show();}return this;},icon:function(iconUrl){var shell=this.iconShell;if(!!iconUrl){shell.find('div')[0].style.backgroundImage='url('+this.ops.iconBasePath+iconUrl+')';shell.show();}else{shell.hide();}return this;},lock:function(opacity,lockColor){var ops=this.ops,mask=Dialog.mask;if(!mask){mask=Dialog.mask=new ds.Mask({opacity:_ops.lockOpacity,background:_ops.lockColor,onclick:function(){var dialog=Dialog.activeDialog;dialog&&dialog.ops.onmaskclick.call(dialog);}});}Dialog.addMask(this);lockColor=lockColor||ops.lockColor;if(mask._lastBackground!==lockColor){mask._lastBackground=lockColor;mask._getElem().css('background',lockColor);}mask.show(opacity||ops.opacity);this.locked=true;return this;},unlock:function(){if(this.locked){Dialog.removeMask(this);var maskQueue=Dialog.maskQueue;if(maskQueue.length>0){maskQueue[maskQueue.length-1].lock();}else{Dialog.mask.hide();}this.locked=false;}return this;}};(function(){var rinput=/INPUT|TEXTAREA/i;DOC.bind('keydown',function(e){var dialog=Dialog.activeDialog;if(dialog&&dialog.ops.esc&&e.keyCode===27&&!rinput.test(e.target.nodeName)){dialog.hide();}});})();$.extend(Dialog.prototype,(function(){var supportFixed;return{initFixed:function(){if(typeof supportFixed!=='boolean'){supportFixed=ds.Mask.fixedPositionSupport();}if(!this._initFixed){var shell=this.shell;shell[0].style.position=supportFixed?'fixed':'absolute';this.ops.fixed=true;if(!supportFixed){this.ops.fixed=false;}this._initFixed=true;}return this;},releaseFixed:function(){if(this._initFixed){var pos=this.position(),scrollLeft=view.scrollLeft(),scrollTop=view.scrollTop();this.position(pos.left+scrollLeft,pos.top+scrollTop);this.shell[0].style.position='absolute';this.ops.fixed=false;}return this;}};})());$.extend(Dialog.prototype,(function(){var html=document.documentElement,hasCapture='setCapture'in html,hasCaptureEvt='onlosecapture'in html,clearRanges='getSelection'in global?function(){global.getSelection().removeAllRanges();}:function(){document.selection&&document.selection.empty();},isNotDragArea=function(dialog,target){var content=dialog.contentShell[0],close=dialog.closeShell[0];if(target==content||$.contains(content,target)||target===close||$.contains(close,target)||$.contains(dialog.buttonShell[0],target)){return true;}return false;};return{initDrag:function(){if(!this._dragHandler){var self=this;this._dragHandler=function(e){if(e.button!==0&&e.button!==1||isNotDragArea(self,e.target)){return;}var ops=self.ops,shell=self.shell,limit=self._getPositionLimit(),currDrag=Dialog._currDrag={limit:limit,dialog:self,offsetTop:e.pageY-limit.top,offsetLeft:e.pageX-limit.left,onmousemove:function(e){var top=e.pageY-currDrag.offsetTop,left=e.pageX-currDrag.offsetLeft;top-=ops.fixed?limit.viewScrollTop:0;left-=ops.fixed?limit.viewScrollLeft:0;top=Math.min(limit.maxTop,top);left=Math.min(limit.maxLeft,left);ops.top=Math.max(limit.minTop,top);ops.left=Math.max(limit.minLeft,left);self._position(ops.left,ops.top);clearRanges();},onmouseup:function(){hasCapture&&shell[0].releaseCapture();hasCaptureEvt?shell.unbind('losecapture',currDrag.onmouseup):view.unbind('blur',currDrag.onmouseup);DOC.unbind('mousemove',currDrag.onmousemove).unbind('mouseup',currDrag.onmouseup);shell.removeClass('ds_dialog_drag');Dialog._currDrag=null;}};hasCaptureEvt?shell.bind('losecapture',currDrag.onmouseup):view.bind('blur',currDrag.onmouseup);hasCapture&&shell[0].setCapture();DOC.bind('mousemove',currDrag.onmousemove).bind('mouseup',currDrag.onmouseup);shell.addClass('ds_dialog_drag');return false;};this.shell.bind('mousedown',this._dragHandler);}return this;},releaseDrag:function(){if(this._dragHandler){this.shell.unbind('mousedown',this._dragHandler);this._dragHandler=null;}return this;}};})());ds.dialog=function(ops,onyes,onno){if(typeof ops==='string'){ops={content:ops,title:arguments[1]||'\u6d88\u606f\u63d0\u793a',onyes:onyes,onno:onno};}return new Dialog(ops||{});};$.extend(ds.dialog,{items:Dialog.items,alert:function(content,onhide,icon){if(typeof onhide==='string'){icon=onhide;}return new Dialog({id:'ds_dialog_alert',fixed:true,left:'50%',top:'40%',icon:icon?icon:'info.png',title:'\u6d88\u606f\u63d0\u793a',content:content,buttons:[{text:'\u786e\u5b9a',autoFocus:true,className:'ds_dialog_yes',onclick:function(){this.close();}}],onhide:typeof onhide==='function'?onhide:function(){}});},confirm:function(content,onyes,onno,onhide){return new Dialog({id:'ds_dialog_confirm',fixed:true,left:'50%',top:'40%',icon:'confirm.png',title:'\u6d88\u606f\u786e\u8ba4',content:content,onyes:onyes||true,onhide:onhide,onno:onno||true});},prompt:function(content,onyes,defaultValue){return new Dialog({id:'ds_dialog_prompt',fixed:true,left:'50%',top:'40%',icon:'confirm.png',title:'\u6d88\u606f\u786e\u8ba4',content:'<p style="margin:0;padding:0 0 5px;">'+content+'</p><div><input type="text" style="color:#333;font-size:12px;padding:.42em .33em;width:18em;" /></div>',onopen:function(){var self=this,input=this._input;if(!input){input=this._input=this.contentShell.find('input');input.bind('keydown',function(e){if(e.keyCode===13&&self.focusButton){self.focusButton.trigger('click');return false;}});}input.val(defaultValue||'');},onfocus:function(){var input=this._input[0];setTimeout(function(){input.select();input.focus();},32);},onclose:function(){this._input=null;},onyes:function(){var input=this._input[0];return typeof onyes==='function'?onyes.call(this,input.value,input):void 0;},onno:true});},tips:function(content,timeout,follow,lock){if(typeof follow==='boolean'){lock=follow;follow=null;}return new Dialog({id:'ds_dialog_tips',fixed:true,esc:false,lock:!!lock,follow:follow,followOffset:[0,'bottom'],drag:false,content:content,padding:'12px 50px',showCloseButton:false,timeout:timeout||0});}});})(this,this.document,jQuery);
/**
 * jquery.mask.js
 */
;(function(global,document,$,undefined){var DOC=$(document),_noop=function(){},ds=global.ds||(global.ds={});var _uuid=0,_ops={id:null,anim:true,animDuration:320,zIndex:999,opacity:0.8,background:'#000',onshow:_noop,onhide:_noop,onclick:_noop},Mask=ds.Mask=function(ops){return this.init(ops);};Mask._cache={};Mask.prototype={constructor:Mask,init:function(ops){this.ops=ops=ops||{};$.each(_ops,function(k,val){typeof ops[k]==='undefined'&&(ops[k]=val);});var id=ops.id;if(typeof id!=='string'){id='ds_mask_'+(++_uuid);}this.id=id;if(Mask._cache[id]){var _mask=Mask._cache[id];_mask.ops=ops;return _mask;}Mask._cache[id]=this;return this;},_getElem:function(){var elem=this.elem,self=this;if(!elem){var ops=this.ops,css='border:0;margin:0;padding:0;height:100%;width:100%;left:0;top:0;opacity:0;';elem=this.elem=$(document.createElement('div'));elem.bind('click.jquery_mask',function(){self.ops.onclick.call(self);});elem[0].className = 'ds_dialog_zz';elem[0].style.cssText=css+'display:none;position:fixed;background:'+ops.background+';z-index:'+ops.zIndex;if(!Mask.fixedPositionSupport()){elem[0].style.position='absolute';css+='position:absolute;filter:Alpha(opacity=0);';elem[0].innerHTML='<iframe src="javascript:false" frameborder="0" height="100%" width="100%" style="'+css+'z-index:1;"></iframe><div style="'+css+'background:#fff;z-index:9;"></div>';}elem[0].id=this.id;elem.appendTo('body');}return elem;},show:function(opacity){var self=this,ops=this.ops,elem=this._getElem();opacity=typeof opacity==='number'?opacity:ops.opacity;if(!Mask.fixedPositionSupport()){elem.css('height',DOC.height());}this.elem.css('background',ops.background).show();if(ops.anim){elem.stop().animate({opacity:opacity},ops.animDuration,function(){ops.onshow.call(self,opacity);});}else{elem.stop().css('opacity',opacity);ops.onshow.call(this,opacity);}return this;},hide:function(){var self=this,ops=this.ops,elem=this._getElem();if(ops.onhide.call(this)!==false){if(ops.anim){elem.stop().animate({opacity:0},ops.animDuration,function(){this.style.display='none';});}else{elem[0].style.display='none';}}return this;},destory:function(){if(this.elem){this.elem.remove();this.elem=null;}delete Mask._cache[this.id];}};Mask.fixedPositionSupport=function(){if(typeof $.support.fixedPosition==='boolean'){return $.support.fixedPosition;}var div,ret=false,body=document.body,css='border:0;margin:0;padding:0;position:fixed;left:0;top:20px;';if(body){div=document.createElement('div');div.style.cssText=css+'position:absolute;top:0;';div.innerHTML='<div style="'+css+'"></div>';body.insertBefore(div,body.firstChild);ret=$.support.fixedPosition=div.firstChild.offsetTop===20;body.removeChild(div);}return ret;};ds.mask=$.mask=function(opacity,background){var ops=typeof opacity==='object'?opacity:{opacity:opacity,background:background};ops.id='ds_global_mask';return new Mask(ops).show();};})(this,this.document,jQuery);

