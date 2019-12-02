
var globelVary={languageId:1,
				sessionTimeBool:0,//1表示超时,0表示未超时
				timeMashine:""
};
$(function(){
	var maxWidth =$(window).width();
	var fwmainwidth = $(".fwtop,.fwmain,.fwbottom").width();
	var result2 = -((maxWidth - fwmainwidth)/2);
	if(result2>0){
		result2 = 0;
		maxWidth = fwmainwidth; 
		$(".tLan").css({"width" : "100%"});
	}else{$(".tLan").css({"left" : result2 + "px", "width" : maxWidth + "px"});
	}
	if(isNaN($("#itemLanguage").val()))
		globelVary.languageId=1;
	else
		globelVary.languageId=parseInt($("#itemLanguage").val());	
	})

$.fn.smint = function( options ) {
	// adding a class to users div
	$(this).addClass('smint')
	var settings = $.extend({
		'scrollSpeed '  : 500
		}, options);
	return $('.smint a').each( function() {
		if ( settings.scrollSpeed ) {
			var scrollSpeed = settings.scrollSpeed
		}
		// get initial top offset for the menu 
		var stickyTop = $('.smint').offset().top;	
		var fwtop_mainNavwd = $('.fwtop_mainNav').width();
		if (fwtop_mainNavwd>1300)
		{
			// check position and make sticky if needed
			var stickyMenu = function(){
				// current distance top
				var scrollTop = $(window).scrollTop(); 							
				// if we scroll more than the navigation, change its position to fixed and add class 'fxd', otherwise change it back to absolute and remove the class
				if (scrollTop > stickyTop) { 
					$('.smint').css({ 'position': 'fixed', 'top':0,'z-index':'500','width':'100%'}).addClass('fxd');
					} else {
						$('.smint').css({ 'position': 'absolute','z-index':'500','top':stickyTop,'width':'100%'}).removeClass('fxd'); 
					}   
			};
		}
		else 
		{
			var fwtop_mainNavWidth = "-"+fwtop_mainNavwd/2+"px";
			$('.fwtop_mainNav').css({'left':'50%','marginLeft':fwtop_mainNavWidth});
			// check position and make sticky if needed
			var stickyMenu = function(){
				// current distance top
				var scrollTop = $(window).scrollTop(); 		
				// if we scroll more than the navigation, change its position to fixed and add class 'fxd', otherwise change it back to absolute and remove the class
				if (scrollTop > stickyTop) { 
					$('.smint').css({ 'position': 'fixed', 'top':0,'z-index':'500','left':'50%','marginLeft':fwtop_mainNavWidth }).addClass('fxd');
					} else {
						$('.smint').css({ 'position': 'absolute','z-index':'500','top':stickyTop,'left':'50%','marginLeft':fwtop_mainNavWidth }).removeClass('fxd'); 
					}   
		};
	}		
		// run function
		stickyMenu();
		// run function every time you scroll
		$(window).scroll(function() {
			 stickyMenu();
		});
	});
}	
/********计算折叠标签容器高度************/
function calcFoldingDisplayHeight(userLabelId){
	var foldingDisplayHeightTemp = $(".foldingDisplay"+userLabelId).height();
	var foldingDisplayHeight = foldingDisplayHeightTemp - 36;
	$(".foldingDisplayContent"+userLabelId).height(foldingDisplayHeight);	
}

/********竖形菜单************/
function ShowMenu(obj,noid){	
	if($(obj).hasClass("selected") && $("#"+noid).css('display')=="inline"){
		$(obj).removeClass("selected");
		$("#"+noid).css("display","none");
	}
	else if(!$(obj).hasClass("selected") && $("#"+noid).css('display')=="inline" ){$("#"+noid).css("display","none");}
	else{
		$(obj).addClass("selected");
		$("#"+noid).css("display","inline");
	}	
}
function ShowMenu1(obj,noid,id){
	if($(obj).hasClass("selected") && $("#"+noid).css('display')=="inline"){
		$(obj).removeClass("selected");
		$("#"+noid).css("display","none");
	}
	else if(!$(obj).hasClass("selected") && $("#"+noid).css('display')=="inline" ){$("#"+noid).css("display","none");}
	else{
		$(".verticalNav"+id+" h1").removeClass("selected");
		$(".verticalNav"+id+" span").css("display","none");
		$(obj).addClass("selected");
		$("#"+noid).css("display","inline");
	}	
}
function ShowMenu2(id){
	$(".verticalNav"+id+" span").css("display","none");
}
/******防止mouseover和mouseout多次触发******/
function checkHover(e,target){
	if (getEvent(e).type == "mouseover"){
		return !contains(target, getEvent(e).relatedTarget
				|| getEvent(e).fromElement)
				&& !((getEvent(e).relatedTarget || getEvent(e).fromElement) === target);
	}else{
		return !contains(target, getEvent(e).relatedTarget
				|| getEvent(e).toElement)
				&& !((getEvent(e).relatedTarget || getEvent(e).toElement) === target);
	}
}
function contains(parentNode, childNode){
	if (parentNode.contains){
		return parentNode != childNode && parentNode.contains(childNode);
	}else{
		return !!(parentNode.compareDocumentPosition(childNode) & 16);
	}
}
//取得当前window对象的事件
function getEvent(e) {
	return e || window.event;
}
/********文章列表效果2************/
function item_list2(idName){
	$(".id"+idName+ " ul>li:first-child").addClass("over");
	$(".id"+idName+ " ul>li").on("mouseover",function(){
		$(this).siblings().andSelf().removeClass("over");
		$(this).addClass("over");
	});
}
/********文章列表效果3************/
function item_list3(idName){
	$(".id"+idName+ " ul>li").on("mouseover",function(){
		$(this).addClass("p02");
	});
	$(".id"+idName+ " ul>li").on("mouseout",function(){
		$(this).removeClass("p02");
	});
}
/********文章列表效果5************/
function item_list5(idName){
	$(".id"+idName+ " ul>li").on("mouseover",function(){
		$("#img"+idName).show();
	});
	$(".id"+idName+ " ul>li").on("mouseout",function(){
		$("#img"+idName).css("display","none");
	});
}
var sweetTitles = {
	x : 10,
	y : 20,
	init : function(idName) {
		$(".id"+idName+ " ul>li a").on("mouseover",function(e){
			this.myTitle = this.title;
			this.myHref = this.href;
			this.myHref = (this.myHref.length > 200 ? this.myHref.toString().substring(0,200)+"..." : this.myHref);
			this.title = "";
			var tooltip = "";
			if(this.myTitle == "")
			{
				tooltip = "";
			}
			else
			{
				tooltip = "<div id='tooltip'><p>"+this.myTitle+"</p></div>";
			}
			$('body').append(tooltip);
			$('#tooltip')
				.css({
					"opacity":"0.8",
					"top":(e.pageY+20)+"px",
					"left":(e.pageX+10)+"px"
				}).show('fast');
		}).on("mouseout",function(){
			this.title = this.myTitle;
			$('#tooltip').remove();
		}).on("mousemove",function(e){
			$('#tooltip')
			.css({
				"top":(e.pageY+20)+"px",
				"left":(e.pageX+10)+"px"
			});
		});
	}
};
/****头部搜索分类显示*****/
function displaySiteSearch(obj){
	var objSpanFirst=obj.find("span:first");
	//var offset=objSpanFirst.offset();
	var offset=objSpanFirst.position();
	var top=offset.top;
	var left=offset.left;	
	var inputH=objSpanFirst.outerHeight();
	top+=inputH;
	$("#select_siteSearch").css({"display":"block","top":top+"px","left":left+"px"});
}
/****头部搜索分类隐藏*****/
function hideSiteSearch(event,obj){
	$("#select_siteSearch").hide();
}

/****语言显示*****/
function displayLanguage(obj){
	var objSpanFirst=obj.find("span:first");
	var offset=objSpanFirst.position();
	var top=offset.top;
	var left=offset.left;	
	var inputH=objSpanFirst.outerHeight();
	top+=inputH;
	$("#select_language").css({"top":top+"px","left":left+"px"}).show();
}
/****语言隐藏*****/
function hideLanguage(event,obj){
	$("#select_language").hide();//.css({"display":"none"});
}
$(function(){
	$("#select_language,#select_siteSearch ul>li").on("click",function(){
		$("#select_language,#select_siteSearch").hide();
		});
	})

/******头部搜索******/
function siteSearch(){
	$("#siteSearchSubmit").click(function(){ 
		var siteSearchClass = $("#siteSelect_info").find("a").attr("rel");
		var siteSearchContent = $("#siteSearchContent").val(); 
		window.open("/search/"+siteSearchClass+"/"+siteSearchContent); //跳转新页面
	})
	$("#select_siteSearch").find("a").click(function(){
		var sitePageName = $(this).attr("rel");
		$("#siteSelect_info").children().replaceWith("<a href='javascript:void(0)' rel='"+sitePageName+"'>"+sitePageName+"</a>");
	})	
}
/******多语******/
function siteLanguage(){
	$("#select_language").find("a").click(function(){
		var languageId = $(this).attr("rel");
		window.location.href="/siteLanguage="+languageId; //跳转本页面
	})	
}

/******通用******/
function commonSearch(userLabelId,searchStra){
	var searchStr = searchStra;
	$("#searchContent"+userLabelId).on('keyup',function(e){
		var e=e||window.event;
		var keycode=e.keyCode||e.which||e.charCode;
		if(keycode==13){
			var searchContent = $(this).val();
			var searchClass = $("#select_info"+userLabelId).find("a").attr("rel");
			window.open("/search/"+searchClass+"/"+searchContent+"/"+searchStr); //跳转新页面
		}
	})
	$("#searchSubmit"+userLabelId).click(function(){
		var searchContent = $("#searchContent"+userLabelId).val();
		var searchClass = $("#select_info"+userLabelId).find("a").attr("rel");
		window.open("/search/"+searchClass+"/"+searchContent+"/"+searchStr); //跳转新页面
	})
	var obj=$("#select_search"+userLabelId);
	$("a",obj).click(function(){
		var pageName = $(this).attr("rel");
		$("#select_info"+userLabelId).children().replaceWith("<a href='javascript:void(0)' rel='"+pageName+"'>"+pageName+"</a>");
		obj.hide();
	})
}
function commonSearchNew(userLabelId,searchBegin,searchStra){
	var searchStr = searchStra;
	var searchClass = searchBegin;
	$("#searchContent"+userLabelId).on('keyup',function(e){
		var e=e||window.event;
		var keycode=e.keyCode||e.which||e.charCode;
		if(keycode==13){
			var searchContent = $(this).val();
			window.open("/search/"+searchClass+"/"+searchContent+"/"+searchStr); //跳转新页面
		}
	})
	$("#searchSubmit"+userLabelId).click(function(){
		var searchContent = $("#searchContent"+userLabelId).val();
		window.open("/search/"+searchClass+"/"+searchContent+"/"+searchStr); //跳转新页面
	})
}
/****公共搜索分类显示*****/
function displaySearch(obj,userLabelId){
	var objSpanFirst=obj.find("span:first");
	var position=objSpanFirst.position();
	var top=position.top;
	var left=position.left;
	var inputH=objSpanFirst.outerHeight();
	top+=inputH;
	$("#select_search"+userLabelId).css({"display":"block","top":top+"px","left":left+"px"});
}
/****公共搜索分类隐藏*****/
function hideSearch(event,obj,userLabelId){
	$("#select_search"+userLabelId).css({"display":"none"});
}

/**
 * jQuery jPages v0.4
 * Client side pagination with jQuery
 * http://luis-almeida.github.com/jPages
 *
 * Licensed under the MIT license.
 * Copyright 2012 Luís Almeida
 * https://github.com/luis-almeida
 */

(function ( $, window, document, undefined ) {

	var name = "jPages",
		instance = null,
		defaults = {
			containerID  : "",
			first        : false,
			previous     : "&#8592; previous",
			next         : "next &#8594;",
			last         : false,
			links        : "numeric", // blank || title
			startPage    : 1,
			perPage      : 10,
			midRange     : 5,
			startRange   : 1,
			endRange     : 1,
			keyBrowse    : false,
			scrollBrowse : false,
			pause        : 0,
			clickStop    : false,
			delay        : 50,
			direction    : "forward", // backwards || auto || random ||
			animation    : "", // http://daneden.me/animate/ - any entrance animations
			fallback     : 400,
			minHeight    : true,
			callback     : undefined // function( pages, items ) { }
		};

	function Plugin( element, options ) {
		this.options = $.extend( {}, defaults, options );
		this.options.perPage=(this.options.perPage==0?1:this.options.perPage);
		this._container = $( "#" + this.options.containerID );
		if ( !this._container.length ) { 
			return; 
		}

		this.jQwindow = $(window);
		this.jQdocument = $(document);
		
		this._holder = $( element );
		this._nav = {};

		this._first = $( this.options.first );
		this._previous = $( this.options.previous );
		this._next = $( this.options.next );
		this._last = $( this.options.last );
		
		/* only visible items! */
		//this._items = this._container.children(":visible");
		this._items = this._container.children();
		this._itemsShowing = $([]);
		this._itemsHiding = $([]);

		this._numPages = Math.ceil( this._items.length / this.options.perPage );
		this._currentPageNum = this.options.startPage;

		this._clicked = false;
		this._cssAnimSupport = this.getCSSAnimationSupport();

		this.init();
		
	}

	Plugin.prototype.getCSSAnimationSupport = function () {
		var animation = false,
			animationstring = 'animation',
			keyframeprefix = '',
			domPrefixes = 'Webkit Moz O ms Khtml'.split(' '),
			pfx  = '',
			elm = this._container.get(0);

		if( elm.style.animationName ) { animation = true; } 

		if( animation === false ) {
			for( var i = 0; i < domPrefixes.length; i++ ) {
				if( elm.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
					pfx = domPrefixes[ i ];
					animationstring = pfx + 'Animation';
					keyframeprefix = '-' + pfx.toLowerCase() + '-';
					animation = true;
					break;
				}
			}
		}

		return animation;
	};

	Plugin.prototype.init = function () {
		this.setStyles();
		this.setNav();
		this.paginate( this._currentPageNum );
		this.setMinHeight();
	};

	Plugin.prototype.setStyles = function () {

		var requiredStyles = "<style>" + 
		".jp-invisible { visibility: hidden !important; } " +
		".jp-hidden { display: none !important; }" + 
		"</style>";

		$( requiredStyles ).appendTo("head");

		if ( this._cssAnimSupport && this.options.animation.length ) { 
			this._items.addClass("animated jp-hidden");
		} else {
			this._items.hide();
		}
		
	};

	Plugin.prototype.setNav = function () {
		var navhtml = this.writeNav();

		this._holder.each( this.bind( function( index, element ) {
			var holder = $( element );
			holder.html( navhtml );
			this.cacheNavElements( holder, index );
			this.bindNavHandlers( index );
			this.disableNavSelection( element );
		}, this) );

		if ( this.options.keyBrowse ) this.bindNavKeyBrowse(); 
		if ( this.options.scrollBrowse ) this.bindNavScrollBrowse();
	};

	Plugin.prototype.writeNav = function () {
		var i = 1, navhtml;

		navhtml = this.writeBtn( "first" ) + this.writeBtn( "previous" );

		for ( ; i <= this._numPages; i++ ) {

			if ( i === 1 && this.options.startRange === 0 ) {
				navhtml += "<span>...</span>";
			}

			if ( i > this.options.startRange && i <= this._numPages - this.options.endRange ) {
				navhtml += "<a href='#' class='jp-hidden'>";
			} else {
				navhtml += "<a>";
			}

			switch ( this.options.links ) {
				case "numeric" :
					navhtml += i;
					break;
				case "blank" :
					break;
				case "title" :
					var title = this._items.eq(i-1).attr("data-title");
					navhtml += title !== undefined ? title : "";
					break;
			}

			navhtml += "</a>";

			if ( i === this.options.startRange || i === this._numPages - this.options.endRange ) {
				navhtml += "<span>...</span>";
			}
		}
		
		navhtml += this.writeBtn( "next" ) + this.writeBtn( "last" ) + "</div>";

		return navhtml;
	};

	Plugin.prototype.writeBtn = function ( which ) {

		return this.options[which] !== false && !$( this[ "_" + which ] ).length ? 
			"<a class='jp-" + which + "'>" + this.options[which] + "</a>" : "";

	};

	Plugin.prototype.cacheNavElements = function ( holder, index ) {
		this._nav[index] = {};

		this._nav[index].holder = holder;

		this._nav[index].first = this._first.length ? this._first : this._nav[index].holder.find("a.jp-first");
		this._nav[index].previous = this._previous.length ? this._previous : this._nav[index].holder.find("a.jp-previous");
		this._nav[index].next = this._next.length ? this._next : this._nav[index].holder.find("a.jp-next");
		this._nav[index].last = this._last.length ? this._last : this._nav[index].holder.find("a.jp-last");

		this._nav[index].fstBreak = this._nav[index].holder.find("span:first");
		this._nav[index].lstBreak = this._nav[index].holder.find("span:last");

		this._nav[index].pages = this._nav[index].holder.find("a").not(".jp-first, .jp-previous, .jp-next, .jp-last");
		this._nav[index].permPages = this._nav[index].pages.slice(0, this.options.startRange)
			.add( this._nav[index].pages.slice(this._numPages - this.options.endRange, this._numPages) );
		this._nav[index].pagesShowing = $([]);
		this._nav[index].currentPage = $([]);
	};

	Plugin.prototype.bindNavHandlers = function ( index ) {
		var nav = this._nav[index];

		// default nav
		nav.holder.bind( "click.jPages", this.bind( function( evt ) {
			var newPage = this.getNewPage( nav, $(evt.target) );
			if ( this.validNewPage( newPage ) ) {
				this._clicked = true;
				this.paginate( newPage );
			}
			evt.preventDefault();
		}, this ) );

		// custom first
		if ( this._first.length ) {
			this._first.bind( "click.jPages", this.bind( function() {
				if ( this.validNewPage( 1 ) ) {
					this._clicked = true;
					this.paginate( 1 );
				}
			}, this ) );
		}

		// custom previous
		if ( this._previous.length ) {
			this._previous.bind( "click.jPages", this.bind( function() {
				var newPage = this._currentPageNum - 1;
				if ( this.validNewPage( newPage ) ) {
					this._clicked = true;
					this.paginate( newPage );
				}
			}, this ) );
		}

		// custom next
		if ( this._next.length ) {
			this._next.bind( "click.jPages", this.bind( function() {
				var newPage = this._currentPageNum + 1;
				if ( this.validNewPage( newPage ) ) {
					this._clicked = true;
					this.paginate( newPage );
				}
			}, this ) );
		}

		// custom last
		if ( this._last.length ) {
			this._last.bind( "click.jPages", this.bind( function() {
				if ( this.validNewPage( this._numPages ) ) {
					this._clicked = true;
					this.paginate( this._numPages );
				}
			}, this ) );
		}

	};

	Plugin.prototype.disableNavSelection = function ( element ) {
		if ( typeof element.onselectstart != "undefined" ) {
			element.onselectstart = function() { 
				return false; 
			};
		} else if (typeof element.style.MozUserSelect != "undefined") {
			element.style.MozUserSelect = "none";
		} else {
			element.onmousedown = function() { 
				return false; 
			};
		}
	};

	Plugin.prototype.bindNavKeyBrowse = function () {
		this.jQdocument.bind( "keydown.jPages", this.bind( function( evt ) {
			var target = evt.target.nodeName.toLowerCase();
			if ( this.elemScrolledIntoView() && target !== "input" && target != "textarea" ) {
				var newPage = this._currentPageNum;
				
				if ( evt.which == 37 ) newPage = this._currentPageNum - 1;
				if ( evt.which == 39 ) newPage = this._currentPageNum + 1;

				if ( this.validNewPage( newPage ) ) {
					this._clicked = true;
					this.paginate( newPage );
				}
			}
		}, this ) );
	};

	Plugin.prototype.elemScrolledIntoView = function () {
		var docViewTop, docViewBottom, elemTop, elemBottom;

		docViewTop = this.jQwindow.scrollTop();
		docViewBottom = docViewTop + this.jQwindow.height();

		elemTop = this._container.offset().top;
		elemBottom = elemTop + this._container.height();

		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));

		// comment above and uncomment below if you want keyBrowse to happen 
		// only when container is completely visible in the page 

		/*return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) && 
			(elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );*/
	};

	Plugin.prototype.bindNavScrollBrowse = function () {

		this._container.bind( "mousewheel.jPages DOMMouseScroll.jPages", this.bind( function( evt ) {
			var newPage = ( evt.wheelDelta || -evt.detail ) > 0 ? 
				( this._currentPageNum - 1 ) : ( this._currentPageNum + 1 );

			if ( this.validNewPage( newPage ) ) {
				this._clicked = true;
				this.paginate( newPage );
			}

			return false;

		}, this ) );

	};

	Plugin.prototype.getNewPage = function ( nav, target ) {

		if ( target.is( nav.currentPage ) ) return this._currentPageNum;
		if ( target.is( nav.pages ) ) return nav.pages.index(target) + 1;
		if ( target.is( nav.first ) ) return 1;
		if ( target.is( nav.last ) ) return this._numPages;
		if ( target.is( nav.previous ) ) return nav.pages.index(nav.currentPage);
		if ( target.is( nav.next ) ) return nav.pages.index(nav.currentPage) + 2;

	};

	Plugin.prototype.validNewPage = function ( newPage ) {
		return newPage !== this._currentPageNum && newPage > 0 && newPage <= this._numPages ? 
			true : false;
	};

	Plugin.prototype.paginate = function ( page ) {
		var itemRange, pageInterval;

		itemRange = this.updateItems( page );
		pageInterval = this.updatePages( page );

		this._currentPageNum = page;
		
		if ( $.isFunction( this.options.callback ) ) {
			this.callback( page, itemRange, pageInterval );
		}
		
		this.updatePause();
	};

	Plugin.prototype.updateItems = function ( page ) {
		var range = this.getItemRange( page );

		this._itemsHiding = this._itemsShowing;
		this._itemsShowing = this._items.slice(range.start, range.end);
		
		if ( this._cssAnimSupport && this.options.animation.length ) { 
			this.cssAnimations( page );
		} else {
			this.jQAnimations( page );
		}

		return range;
	};

	Plugin.prototype.getItemRange = function ( page ) {
		var range = {};

		range.start = ( page - 1 ) * this.options.perPage;
		range.end = range.start + this.options.perPage;
		
		if ( range.end > this._items.length ) {
			range.end = this._items.length;
		}

		return range;
	};

	Plugin.prototype.cssAnimations = function ( page ) {
		clearInterval( this._delay );

		this._itemsHiding
			.removeClass( this.options.animation + " jp-invisible" )
			.addClass("jp-hidden");

		this._itemsShowing
			.removeClass("jp-hidden")
			.addClass("jp-invisible");
		
		this._itemsOriented = this.getDirectedItems( page );
		this._index = 0;

		this._delay = setInterval( this.bind( function() {

			if ( this._index === this._itemsOriented.length ) {
				clearInterval( this._delay );
			} else {
				this._itemsOriented
					.eq(this._index)
					.removeClass("jp-invisible")
					.addClass(this.options.animation);
			}

			this._index = this._index + 1;

		}, this ), this.options.delay );
	};


	Plugin.prototype.jQAnimations = function ( page ) {
		clearInterval( this._delay );

		this._itemsHiding.addClass("jp-hidden");
		this._itemsShowing.fadeTo(0, 0).removeClass("jp-hidden");

		this._itemsOriented = this.getDirectedItems( page );
		this._index = 0;

		this._delay = setInterval( this.bind( function() {

			if ( this._index === this._itemsOriented.length ) {
				clearInterval( this._delay );
			} else {
				this._itemsOriented
					.eq(this._index)
					.fadeTo(this.options.fallback, 1);
			}

			this._index = this._index + 1;

		}, this ), this.options.delay );
	};

	Plugin.prototype.getDirectedItems = function ( page ) {
		var itemsToShow;

		switch ( this.options.direction ) {
			case "backwards" : 
				itemsToShow = $( this._itemsShowing.get().reverse() );
				break;
			case "random" :
				itemsToShow = $( this._itemsShowing.get().sort( function() { 
					return ( Math.round( Math.random() ) - 0.5 );
				} ) );
				break;
			case "auto" :
				itemsToShow = page >= this._currentPageNum ? 
					this._itemsShowing : $( this._itemsShowing.get().reverse() );
				break;
			default :
				itemsToShow = this._itemsShowing;
		}

		return itemsToShow;
	};

	Plugin.prototype.updatePages = function ( page ) {
		var interval, index, nav;

		interval = this.getInterval( page );

		for( index in this._nav ) {
			if ( this._nav.hasOwnProperty( index ) ) {
				nav = this._nav[index];
				this.updateBtns( nav, page );
				this.updateCurrentPage( nav, page );
				this.updatePagesShowing( nav, interval );
				this.updateBreaks( nav, interval );
			}
		}

		return interval;
	};

	Plugin.prototype.getInterval = function ( page ) {
		var neHalf, upperLimit, start, end;
		
		neHalf = Math.ceil( this.options.midRange / 2 );
		upperLimit = this._numPages - this.options.midRange;
		start = page > neHalf ? Math.max( Math.min( page - neHalf, upperLimit ), 0 ) : 0;
		end = page > neHalf ? Math.min( page + neHalf - ( this.options.midRange % 2 > 0 ? 1 : 0 ), this._numPages ) : Math.min( this.options.midRange, this._numPages );
		
		return { start: start, end: end };
	};

	Plugin.prototype.updateBtns = function ( nav, page ) {
		
		if ( page === 1 ) {
			nav.first.addClass("jp-disabled");
			nav.previous.addClass("jp-disabled");
		}

		if ( page === this._numPages ) {
			nav.next.addClass("jp-disabled");
			nav.last.addClass("jp-disabled");
		}

		if ( this._currentPageNum === 1 && page > 1 ) {
			nav.first.removeClass("jp-disabled");
			nav.previous.removeClass("jp-disabled");
		}

		if ( this._currentPageNum === this._numPages && page < this._numPages ) {
			nav.next.removeClass("jp-disabled");
			nav.last.removeClass("jp-disabled");
		}
	};
	Plugin.prototype.updateCurrentPage = function ( nav, page ) {
		nav.currentPage.removeClass("jp-current");
		nav.currentPage = nav.pages.eq( page - 1 ).addClass("jp-current");
	};
	Plugin.prototype.updatePagesShowing = function ( nav, interval ) {
		var newRange = nav.pages.slice( interval.start, interval.end ).not( nav.permPages );
		nav.pagesShowing.not( newRange ).addClass("jp-hidden");
		newRange.not( nav.pagesShowing ).removeClass("jp-hidden");
		nav.pagesShowing = newRange;
	};
	Plugin.prototype.updateBreaks = function ( nav, interval ) {
		if ( interval.start > this.options.startRange || ( this.options.startRange === 0 && interval.start > 0 ) ) { 
			nav.fstBreak.removeClass("jp-hidden");
		} else { 
			nav.fstBreak.addClass("jp-hidden");
		}
		if ( interval.end < this._numPages - this.options.endRange ) {
			nav.lstBreak.removeClass("jp-hidden");
		} else { 
			nav.lstBreak.addClass("jp-hidden");
		}
	};
	Plugin.prototype.callback = function ( page, itemRange, pageInterval ) {
		var pages = {
			current  : page,
			interval : pageInterval,
			count    : this._numPages
		},
		items = {
			showing  : this._itemsShowing,
			oncoming : this._items.slice( itemRange.start + this.options.perPage, itemRange.end + this.options.perPage ),
			range    : itemRange,
			count    : this._items.length
		};

		pages.interval.start = pages.interval.start + 1;
		items.range.start = items.range.start + 1;

		this.options.callback( pages, items );
	};
	Plugin.prototype.updatePause = function () {
		if ( this.options.pause && this._numPages > 1) { 
			clearTimeout( this._pause );
			if ( this.options.clickStop && this._clicked ) {
				return;
			} else {
				this._pause = setTimeout( this.bind( function() {
					this.paginate( this._currentPageNum !== this._numPages ? this._currentPageNum + 1 : 1 );
				}, this ), this.options.pause );
			}
		}
	};
	Plugin.prototype.setMinHeight = function () {
		if ( this.options.minHeight && !this._container.is("table, tbody") ) { 
			setTimeout( this.bind( function() {
				this._container.css({
					"min-height" : this._container.css("height")
				});
			}, this ), 1000 );
		}
	};
	Plugin.prototype.bind = function ( fn, me ) {
		return function () { 
			return fn.apply(me, arguments);
		}; 
	};
	Plugin.prototype.destroy = function () {
		this.jQdocument.unbind("keydown.jPages");
		this._container.unbind( "mousewheel.jPages DOMMouseScroll.jPages");

		if ( this.options.minHeight ) {
			this._container.css("min-height", "");
		}

		if ( this._cssAnimSupport && this.options.animation.length ) { 
			this._items.removeClass("animated jp-hidden jp-invisible " + this.options.animation);
		} else {    
			this._items.removeClass("jp-hidden").fadeTo(0, 1);
		}

		this._holder.unbind("click.jPages").empty();
	};
	$.fn[name] = function ( arg ) {
		var type = $.type( arg );

		if ( type === "object" ) {
			if ( this.length && !$.data( this, name ) ) {
				instance = new Plugin( this, arg );
				this.each( function() {
					$.data( this, name, instance );
				} );
			}
			return this;
		}
		if ( type === "string" && arg === "destroy" ) {
			instance.destroy();
			this.each( function() {
				$.removeData( this, name );
			} );
			return this;
		}
		if ( type === 'number' && arg % 1 === 0 ) {
			if ( instance.validNewPage( arg ) ) {
				instance.paginate( arg );
			}
			return this;
		}
		return this;
	};
})( jQuery, window, document );

//导航栏
$(function(){
	var url =  window.location.pathname;
	var boardUrl = url.match(/([^\/]*\/){1}([^\/]*)/)[2];
	var boardUrl_a = "/"+boardUrl

	$(".navBarUlStyle li a").each(function(){
		var v = $(this).attr("href");
		if (v == boardUrl_a)
		{
			if ($(this).parent().parent().hasClass('m'))
			{
				//二级---主导航
				$(this).parent().parent().addClass('on');
			}
			else
			{
				if ($(this).parent().hasClass('m'))
				{
					//一级
					$(this).parent().addClass('on');
				}
				else 
				{
					//三级
					if ($(this).parent().parent().parent().parent().hasClass('m'))
					{
						$(this).parent().parent().parent().parent().addClass('on');
					}
					else
					{
						if ($(this).parent().parent().parent().hasClass('m'))
						{
							//二级-子导航
							$(this).parent().parent().parent().addClass('on');
						}
						else
						{
							//三级-子导航
							$(this).parent().parent().parent().parent().parent().addClass('on');
						}
					}
				}
			}
		}
	});	
	$(".navBarUlStyle li a").each(function(){
		var dh=$(this).parent().parent().parent().attr('dh');
		var bid=$(this).attr('bid');
		if(!dh){return;}
		if(dh==bid){$(this).parent().addClass('on');			
		}		
	})
	var nav = $(".navBarUlStyle");
	var init = $(".navBarUlStyle .m").eq(ind);
	var block = $(".navBarUlStyle .block");
	block.css({
		"left": init.position() - 3
	});
	nav.hover(function() {},
	function() {
		block.stop().animate({
			"left": init.position() - 3
		},
		100);
	});
	$(".navBarUlStyle").slide({
		type: "menu",
		titCell: ".m",
		targetCell: ".sub",
		delayTime: 300,
		triggerTime: 0,
		returnDefault: true,
		defaultIndex: ind,
		startFun: function(i, c, s, tit) {
			block.stop().animate({
				"left": tit.eq(i).position() - 3
			},
			100);
		}
	});
});
var ind;
//导航栏结束
$(function(){
	$(".liShare").hover(function(){
		 $(".shareShow").show();
		var shareTop=$(".share").offset().top,
		shareLeft=$(".share").offset().left,
		bsPanelW=$("#bsPanel").outerWidth(),
		bsPanelTop=shareTop,
		bsPanelLeft=shareLeft-bsPanelW;
		$("#bsPanel").css({"top":bsPanelTop+"px","left":bsPanelLeft+"px"}).show(); 
		//$(".bdshare_popup_bg,.bdshare_popup_box").show();
		},
	function(){
			$('.shareShow').hide();
			//$(".bdshare_popup_bg,.bdshare_popup_box").hide();
		});
	});
function erweimaOver(obj){
	var offset=obj.offset();
	var top=offset.top;
	var left=offset.left;
var divW=$(".erweimaImg").outerWidth();
var addLeft=left-divW;
var addTop=top-$(document).scrollTop();
$(".erweimaImg").css({"left":addLeft+"px","top":addTop+"px","z-index":"999999"}).show();
	}
function erweimaOut(){
	$(".erweimaImg").hide();
	}
/****后台语言显示*****/
function displayAdminLanguageSw(obj){
	$("#select_adminLanguage_switchLan").css({"display":"block"});
}
/****后台语言隐藏*****/
function hideAdminLanguageSw(event,obj){
	$("#select_adminLanguage_switchLan").css({"display":"none"});
}
/****点击购物车效果*****/
$(function(){
	$(".shoppingCart").click(function(){
		openShoppingCar();
	});
});
//定义检测函数,返回0/1/2/3分别代表无效/差/一般/强
function getResult(s){
	if(s.length < 4){
		return 0;
	}
	var ls = 0;
	if (s.match(/[a-z]/ig)){
		ls++;
	}
	if (s.match(/[0-9]/ig)){
		ls++;
	}
	if (s.match(/(.[^a-z0-9])/ig)){
		ls++;
	}
	if (s.length < 6 && ls > 0){
		ls--;
	}
	return ls
}
/****************************************有翻译Benin**************************************************************/
/******在线表单******/
function messageOperate1(userLabelId,idStr,num,radioName){
	var num=parseInt(num);
	$("#msgSubmit"+userLabelId).click(function(){
	var data = {userLabelId:userLabelId};
		if($(".onlineFormshow .paraName:input[submit=no]").length>0){
			layer.msg('参数错误');
			return;
		}
	data["number"]=num; 
		var msgCheckcode = $("#msgCheckcode"+userLabelId).val();
		if(msgCheckcode==undefined){}
		else if(!msgCheckcode){
			layer.msg('验证码为空!');
			return;
		} 
		data["msgCheckcode"]=msgCheckcode;
		for(var i=1;i<=num;i++){
			if($("#"+idStr+" .paraName"+i+"").length!=0){
				var type = $("#"+idStr+" .paraName"+i+"").attr("type");	
				if(type=="text"||type=="textarea"||type=="password"){
					data["parameter"+i]=$("#"+idStr+" .paraName"+i+"").val();
					}
				else if(type=="radio"){ 
					 data["parameter"+i]=$("#"+idStr+" .paraName"+i+"").filter(':checked').val();	
				}
				else if(type=="checkbox"){
					data["parameter"+i]=$('input[type=checkbox]:checked').map(function(){return this.value}).get().join(',');
					}
				else{
					data["parameter"+i]=$("#"+idStr+" .paraName"+i+"").val();
					}
				//alert(data["parameter"+i]);
			}
		}
		$.ajax({
			type: "POST",
			url: "/apply/messages/onlineForm_add.asp",
			data:data,
			cache:false,
			error:function(){
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return false;
			},
			success: function(data){
				try{
					var dataMsg=eval("("+data+")");
					if(dataMsg.status=="failed"){
					layer.alert(dataMsg.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
						return false;
					}
				}catch(error){
					$("#"+userLabelId).replaceWith(data);
					var ccImg = document.getElementById("imgcheckcode"+userLabelId);//刷新验证码
					if (ccImg)
					{
						ccImg.src = "/inc/checkcode.asp?t="+(new Date().getTime());
					}
					layer.alert('发表成功', {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				}
			}
		});
	})
}
/**
表单验证
**/
function onlineFormValidata(className){
	$("."+className).each(function() {
		var type=$(this).attr("type");
		if(typeof type=="undefined"){
			type=$(this).get(0).tagName;
		}
		if(type=="text"||type=="TEXTAREA"){
			var regtype=$(this).attr("regtype");
			var data={};
			var isCheck=$(this).attr("isCheck");
			if(isCheck==0)//非必填
				{}
			else if(isCheck==1)//必填
				data.empty="为必填项";
			//纯数字格式
			if(regtype==5){data.type="number";data.error="不是数字";data.right="填写正确";data.width=200;$(this).fwValidateText(data);}
			//纯字母格式
			else if(regtype==6){data.type="english";data.error="不是字母";data.right="填写正确";data.width=200;$(this).fwValidateText(data);}
			//电话格式
			else if(regtype==7){data.type="tel";data.error="电话格式有误";data.right="填写正确";data.width=200;$(this).fwValidateText(data);}
			//手机格式
			else if(regtype==8){data.type="phone";data.error="手机格式有误";data.right="填写正确";data.width=200;$(this).fwValidateText(data);}
			//邮箱格式
			else if(regtype==9){data.type="email";data.error="请正确填写邮箱格式";data.right="填写正确";data.width=200;$(this).fwValidateText(data);}
		}
	});
}

/********购物产品数量********/
function shopingCount(obj,type){
	var changeObj=obj.siblings(".text_shoping");
	var count=changeObj.val();
	if(isNaN(count)){layer.alert('请正确填写购物数量', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;}
	if(type=="add")	changeObj.val(++count);
	else if(type=="remove"){
		if(count<=0)
		return;
		else changeObj.val(--count);
		}
}

/******发表留言******/
function messageOperate(userLabelId){
	$("#msgSubmit"+userLabelId).click(function(){
		var msgUser = $("#msgUser"+userLabelId).val();
		var msgContent = $("#msgContent"+userLabelId).val();
		var msgUserTel = $("#msgUserTel"+userLabelId).val();
		var msgUserEmail = $("#msgUserEmail"+userLabelId).val();
		var msgSex = $("input[name=msgSex"+userLabelId+"]:checked").val();
		var msgCheckcode = $("#msgCheckcode"+userLabelId).val();
		var data = {msgUser:msgUser,msgContent:msgContent,msgUserTel:msgUserTel,msgUserEmail:msgUserEmail,msgSex:msgSex,msgCheckcode:msgCheckcode,userLabelId:userLabelId};
		$.ajax({
			type: "POST",
			url: "/apply/messages/message_add.asp",
			data:data,
			cache:false,
			error:function(){
			layer.alert('服务器连接失败', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return false;
			},
			success: function(data){
				try{
					var dataMsg=eval("("+data+")");
					if(dataMsg.status=="failed"){
					layer.alert(dataMsg.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
						return false;
					}
				}catch(error){
					$("#"+userLabelId).replaceWith(data);
					var ccImg = document.getElementById("imgcheckcode"+userLabelId);//刷新验证码
					if (ccImg)
					{
						ccImg.src = "/inc/checkcode.asp?t="+(new Date().getTime());
					}
					layer.alert('留言成功', {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
					window.location.reload();
				}
			}
		});
	})
	$("#msgReset"+userLabelId).click(function(){
		$("#msgUser"+userLabelId).attr("value","");
		$("#msgContent"+userLabelId).attr("value","");
		$("#msgUserTel"+userLabelId).attr("value","");
		$("#msgUserEmail"+userLabelId).attr("value","");
		$("#msgCheckcode"+userLabelId).attr("value","");
	})
}
/******发表评论******/
function discussOperate(userLabelId,distype,disId){
	var disContentObj=$("#saytext"+userLabelId+"dis"+disId);
		var disContent =$.trim(disContentObj.html());
		if(disContent==="")	return;	
				var disCheckcodeObj=$("#disCheckCode"+userLabelId+"dis"+disId);
		var disCheckcode =$.trim(disCheckcodeObj.val());
		if(disCheckcode==="") {
			//layer.alert($.i18n.prop('identifying code is null'), {title:$.i18n.prop('message'), btn:[$.i18n.prop('confirm')],icon: 2,zIndex : 2147483641});
			layer.alert('验证码为空', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			return;
			}
		var data = {userLabelId:userLabelId,disType:distype,disId:disId,disContent:disContent,disCheckcode:disCheckcode}; 
		$.ajax({
			type: "POST",
			url: "/apply/discuss/discuss_add.asp",
			data:data,
			cache:false,
			error:function(){
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return false;
			},
			success: function(data){
				try{
					var dataMsg=eval("("+data+")");
					if(dataMsg.status=="failed"){
					layer.alert(dataMsg.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
						return false;
					}
				}catch(error){
					disContentObj.html("");
					disCheckcodeObj.attr("value","");
					var disImg = document.getElementById("imgcheckcode"+userLabelId+"dis"+disId);//刷新验证码
					if (disImg)
					{
						disImg.src = "/inc/checkcode.asp?t="+(new Date().getTime());
					}
					layer.alert('评论成功，等待审核', {icon: 1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				}
			}
		});
}
///******会员注册******/

/******会员登陆******/
function userLogin(userLabelId){
	$("#userSubmitLogin"+userLabelId).click(function(){
		var userNameLogin = $("#userNameLogin"+userLabelId).val();
		var passwordLogin = $.md5($("#passwordLogin"+userLabelId).val());
		var userLoginCheckcode = $("#userLoginCheckcode"+userLabelId).val();
		var data = {userNameLogin:userNameLogin,passwordLogin:passwordLogin,userLoginCheckcode:userLoginCheckcode,userLabelId:userLabelId};
		$.ajax({
			type: "POST",
			url: "/apply/member/userLogin.asp",
			data:data,
			cache:false,
			error:function(){
				layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return false;
			},
			success: function(data){
				try{
					var dataMsg=eval("("+data+")");
					if(dataMsg.status=="failed"){
						layer.alert(dataMsg.msg, {icon:2,zIndex : 2147483641,title : ['提示', true],btn: ['确定']});
						return false; 
					}
				}catch(error){
					$(".user_login_sub2").replaceWith(data);
					var ccImg = document.getElementById("imgcheckcode"+userLabelId);//刷新验证码
					if (ccImg)
					{
						ccImg.src = "/inc/checkcode.asp?t="+(new Date().getTime());
					}
					layer.alert('登陆成功', {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
					//setTimeout("openMen2()",3000);
					location.reload();
					
				}
			}
		});
	})
}

// QQ表情插件
(function($){
	$.fn.qqFace = function(options){
		var defaults = {
			id : 'facebox',
			path : '/manager/images/qqface/',
			assign : 'content',
			tip : 'em_'
		};
		var option = $.extend(defaults, options);
		var assign = $('#'+option.assign);
		var id = option.id;
		var path = option.path;
		var tip = option.tip;

		if(assign.length<=0){
			alert('缺少表情赋值对象');
			return false;
		}

		$(this).click(function(e){
			var strFace, labFace;
			if($('#'+id).length<=0){
				strFace = '<div id="'+id+'" class="qqFace">' +
							'<table border="0" cellspacing="0" cellpadding="0"><tr>';
				for(var i=1; i<=75; i++){
					labFace = '['+tip+i+']';
					//strFace += '<td><img src="'+path+i+'.gif" onclick="$(\'#'+option.assign+'\').setCaret();$(\'#'+option.assign+'\').insertAtCaret(\'' + labFace + '\');" /></td>';
					strFace += '<td><img src="'+path+i+'.gif" onclick="$(\'#'+option.assign+'\').setCaret();$(\'#'+option.assign+'\').insertAtCaret(\'<img src='+path+i+'.gif />\');" /></td>';
					if( i % 15 == 0 ) strFace += '</tr><tr>';
				}
				strFace += '</tr></table></div>';
			}
			$(".discuss_report").parent().append(strFace);
			var offset = $(this).position();
			var top = offset.top + $(this).outerHeight();
			$('#'+id).css('top',top);
			$('#'+id).css('left',offset.left);
			$('#'+id).show();
			e.stopPropagation();
		});
		$(document).click(function(){
			$('#'+id).hide();
			$('#'+id).remove();
		});
	};
})(jQuery);

/*************************获取控件的值******************************************/
; (function ($) {
		$.Control = function (json) {
			var defaults = {
				checked: 1,		//0表示全部获取,1表示只获取选中的
				radio: 1,		//0表示全部获取,1表示只获取选中的
				type:"get",		//get表示获取值,reset表示重置
				myVar:"myVar",//控件的属性,用来保存变量名的
				split:","		//多个值在变量中的分隔符
			}
			json = $.extend(defaults, json);
			var result = {};
			var radio = {};
			var con={
				text: "text",
				password:"password",
				hidden:"hidden",
				checkbox:"checkbox",
				textarea: "textarea",
				radio:"radio",
				select: "select"
			}               
			function getVar(obj) {
				return obj.attr(json.myVar);
			}
			if (json.type == "reset") {//重置
				json.objs.each(function () {
				//暂时不写
				});
			}
			else if (json.type == "get") {//获取
				json.objs.each(function () {
				var attrVar= getVar($(this));
				if(!attrVar){
				return true;
				}
					if ($(this).is(":"+con.text)) { //文本框
						result[attrVar] = $(this).val();
					}
					else if ($(this).is(":" + con.password)) {//密码框
						result[attrVar] = $(this).val();
					}
					else if ($(this).is(":"+con.hidden)) { //隐藏框
						result[attrVar] = $(this).val();
					}
					else if ($(this).is(":"+con.checkbox)) {//复选框.如果指定了value的属性,返回value属性值,否则返回值on;返回的值以","分割的字符串
						if (json.checked == 1) {//只获取选中的复选框
							if ($(this).is(":checked")) {
								if(result[attrVar]){
									result[attrVar]+= json.split+ $(this).val();
								}
								else {//不存在
									result[attrVar] = $(this).val();
								}
							}
						}
						else if (json.checked == 0) {//不管有没有选中都获取
							if (result[attrVar]) {//如果存在
							  result[attrVar] +=json.split + $(this).val();
							}
							else {//不存在
								result[attrVar] = $(this).val();
							}
						}
						else {
							alert('参数异常');	//json.checked参数异常
						}
					}
					else if ($(this).is(con.textarea)) {//多行文本框
						result[attrVar]= $(this).val();
					}
					else if ($(this).is(":"+con.radio) && $(this).is(":checked")) {//单选按钮并且被选中  
						result[attrVar] = $(this).val();
					}
					else if ($(this).is(con.select)) {//下拉框
					   result[attrVar]= $("option:selected", $(this)).val(); //如果指定了value属性,获取指定的value值,否则获取option中的文本内容
					}
				});
			}
			return result;
		}
	})(jQuery);
/*************************获取控件的值*end*****************************************/
jQuery.extend({ 
unselectContents: function(){
	if(window.getSelection)
		window.getSelection().removeAllRanges();
	else if(document.selection)
		document.selection.empty();
	}
});
jQuery.fn.extend({
	selectContents: function(){
		$(this).each(function(i){
			var node = this;
			var selection, range, doc, win;
			if ((doc = node.ownerDocument) && (win = doc.defaultView) && typeof win.getSelection != 'undefined' && typeof doc.createRange != 'undefined' && (selection = window.getSelection()) && typeof selection.removeAllRanges != 'undefined'){
				range = doc.createRange();
				range.selectNode(node);
				if(i == 0){
					selection.removeAllRanges();
				}
				selection.addRange(range);
			} else if (document.body && typeof document.body.createTextRange != 'undefined' && (range = document.body.createTextRange())){
				range.moveToElementText(node);
				range.select();
			}
		});
	},
	setCaret: function(){
		if(! $.support.msie) return;
		var initSetCaret = function(){
			var textObj = $(this).get(0);
			textObj.caretPos = document.selection.createRange().duplicate();
		};
		$(this).click(initSetCaret).select(initSetCaret).keyup(initSetCaret);
	},
	insertAtCaret: function(textFeildValue){
		var textObj = $(this).get(0);
		if(document.all && textObj.createTextRange && textObj.caretPos){
			var caretPos=textObj.caretPos; 
			caretPos.text = caretPos.text.charAt(caretPos.text.length-1) == '' ?
			textFeildValue+'' : textFeildValue;
		} else if(textObj.setSelectionRange){
			var rangeStart=textObj.selectionStart;
			var rangeEnd=textObj.selectionEnd;
			var tempStr1=textObj.value.substring(0,rangeStart);
			var tempStr2=textObj.value.substring(rangeEnd);
			textObj.value=tempStr1+textFeildValue+tempStr2;
			textObj.focus();
			var len=textFeildValue.length;
			textObj.setSelectionRange(rangeStart+len,rangeStart+len);
			textObj.blur();
		}else{
			$(textObj).append(textFeildValue);
		}
	}
});

/**div加载ajax效果***/
function fwajaxStar(str){//str提示信息
	var html="";
	 html+="<div id='fwajaxLoadDiv'></div>";
	 html+="<div class='fwajaxLoadIcon'>";
	html+= "<span class='fwajaxIcon'></span>";
	 if(str)
		html+="<span class='fwajaxInfo'>"+str+"</span>";
	 html+="</div>";
	$("body").append(html);
	var divH=$(document).height();//-$("#admin_topbj").height();
	$("#fwajaxLoadDiv").height(divH).css({"top":0,"opacity":0.5,"left":0});
	var iconTop=$(window).height()/2;
	iconTop=iconTop+$(document).scrollTop();
	$(".fwajaxLoadIcon").css({"top":iconTop+"px"});
	getSessionTimeBool();
	}
/****关闭ajax遮罩*****/
function fwajaxClose(){
	$("#fwajaxLoadDiv").remove();
	$(".fwajaxLoadIcon").remove();
	}

/********文本框的验证的封装************/
$.fn.extend({
	fwValidateText:function(json){
		var pdMeth=function(obj,rightOrErr){
			//rightOrErr=rightOrErr;
			var con=$.trim(obj.val());
			if(json.min){
			if(con.length>=json.min) rightOrErr=true;
			else rightOrErr=false;
		 }
			else rightOrErr=true
		 if(rightOrErr){
				if(json.max){
				if(con.length<=json.max) rightOrErr=true;
				else rightOrErr=false;
				}
				else rightOrErr=true;
			}
		if(rightOrErr){
			insertStr(obj,json.right,"right");
			if(!json.type) return;
			}
		else {
			insertStr(obj,json.error,"error");
			return;
		}
		if(json.reg){
			rightOrErr=json.reg.test(con);
			if(rightOrErr)
			insertStr(obj,json.right,"right");
			else
			insertStr(obj,json.error,"error");
			return;
		}
		var tel=/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/,
			phone=/^(13|14|15|17|18)[0-9]{9}$/,
			url=new RegExp("^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=:]*)?$"),   
			english=/^[A-Za-z]+$/,
			dEngiish=/^[A-Z]+$/,
			xEngiish=/^[a-z]+$/,
			chinese=/^[\u4E00-\u9FA5\uF900-\uFA2D]+$/,							//汉字
			number=/^([+-]?)\d*\.?\d+$/,										//数字判断
			ChEnNum=/^[\u4e00-\u9fa5 a-z A-Z 0-9 \'\_\.\(\)\-]+$/,				//中文+英文+数字+_+'+(+)判断
			EnNum=/^[a-z A-Z 0-9 \'\_\.\(\)\-]+$/,								//英文+数字+_+'+(+)判断
			EnNumNoU=/^[a-z A-Z 0-9]+$/,										//英文+数字
			pic=/(.*)\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/,			//图片格式判断
			music=/(.*)\.(mp3|wma)$/,			//音乐判断
			QQ=/^[1-9]*[1-9][0-9]*$/,			//扣扣号判断
			email=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/,			//邮箱格式
			int=/^-?[1-9]\d*$/,			//整数
			fint=/^-[1-9]\d*$/,			//负整数,不包括0
			zint=/^[1-9]\d*$/,			//正整数,不包括0
			fint0=/^((-\d+)|(0+))$/,			//负整数+0
			zint0=/^\d*$/,
			idCard=/^[1-9]([0-9]{14}|[0-9]{17})$/,		//身份证
			color=/^#[a-fA-F0-9]{6}$/;
			if(typeof eval(json.type)=="underfined")
				alert("underfined");			
			rightOrErr=eval(json.type).test(con);
			if(rightOrErr)
			insertStr(obj,json.right,"right");
			else
			insertStr(obj,json.error,"error");
			};
			var getPdTSPosition=function(obj){
			var position=obj.position();
			var top=position.top;
			var left=position.left;
			var inputH=obj.outerHeight();
			var inputW=obj.outerWidth()*2/3;
			top=top+inputH;
			left=left+inputW;	
			return {"top":top,"left":left};
		};
		var insertStr=function (obj,Con,type){
		if(obj.next().is(".fwPdBox"))
			obj.next().remove();
		var html="";
		html+="<div class='fwPdBox'>";
		html+="<div class='pdTop'>";
		html+="<div class='pdLeftTopJiao'></div>";
		html+="<div class='pdDingJiao'></div>";
		html+="<div class='pdRightTopJiao'></div>";
		html+="</div>";
		html+="<div class='pdRighrBoder'>";
		html+="<div class='pdbottomBorder'>";
		html+="<div class='pdLeftBorder'>";
		html+="<div class='pdContent'>";
		if(type=="right"){
			obj.attr("submit","yes").removeClass("fwpdTextErrColor");
			html+="<div class='PdRightCon'>"+Con+"</div>";
			}
		else if(type=="error"){
			obj.attr("submit","no").addClass("fwpdTextErrColor");
			html+="<div class='PdErrorCon'>"+Con+"</div>";
			}
		else if(type=="empty"){
			html+="<div class='pdEmptyCon'>"+Con+"</div>";
			}		
		html+="</div>";
		html+="</div>";
		html+="<div class='pdbottomJiao'>";
		html+="<div class='pdLeftBottomJiao'></div><div class='pdRightBottomJiao'></div>";
		html+="</div>";
		html+="</div>";
		html+="</div>";
		html+="</div>";	
		obj.after(html);
		var pdLeftToDingWidth=$(".pdDingJiao").outerWidth();
		var pos=getPdTSPosition(obj);
		pos.left=pos.left-pdLeftToDingWidth+10;
		$(".fwPdBox").css({"top":pos.top,"left":pos.left});
		if(json.width)
		$(".fwPdBox").width(json.width);
		if(json.height)
		$(".fwPdBox").height(json.height);
		}
		var rightOrErr=false;
		var obj=$(this);
		 $(this).on("focus",function(){
			 if(json.empty&&$(this).val()==""){
				insertStr($(this),json.empty,"empty"); 
				 }
			else if(!json.error&&!json.right&&json.empty)
				insertStr($(this),json.empty,"empty");
			else 
				pdMeth($(this),rightOrErr);	
			 });
		  $(this).on('blur',function(){
			  if(json.empty&&$(this).val()==""){
				 $(this).removeAttr("submit").removeClass("fwpdTextErrColor");
				 }
			  
			 
			if($(this).next().is(".fwPdBox"))
				$(this).next().remove();
			 });  
		$(this).on("keyup",function(){
			if(json.empty&&$(this).val()=="") insertStr($(this),json.empty,"empty");
			else if(!json.error&&!json.right) return;
			else pdMeth($(this),rightOrErr)});
		}	
	});
/********文本框的验证的封装*end***********/

/**************QQ功能************************/
/*
此插件基于Jquery
插件名：jquery.Sonline(在线客服插件)
作者 似懂非懂
版本 2.0
Blog：www.haw86.com
*/
;(function($){
	$.fn.Sonline = function(options){
		var opts = $.extend({}, $.fn.Sonline.defualts, options); 
		$.fn.setList(opts); //调用列表设置
		$.fn.Sonline.styleType(opts);
		if(opts.DefaultsOpen == false){
			$.fn.Sonline.closes(opts.Position,0);
		}
		//展开
		$("#SonlineBox > .openTrigger").on("click",function(){$.fn.Sonline.opens(opts);});
		//关闭
		$("#SonlineBox > .contentBox > .closeTrigger").on("click",function(){$.fn.Sonline.closes(opts.Position,"fast");});
		
		//Ie6兼容或滚动方式显示
		if ( $.support.msie && ( $.support.version == "6.0") && !$.support.style||opts.Effect==1) {$.fn.Sonline.scrollType();}
		else if(opts.Effect==0){$("#SonlineBox").css({position:"fixed"});}
	}
	$.fn.Sonline.defualts ={
		Position:"left",//left或right
		Top:200,//顶部距离，默认200px
		Effect:0, //滚动或者固定两种方式，1.滚动,0表示固定
		Width:170,//顶部距离，默认200px
		DefaultsOpen:false, //默认展开：true,默认收缩：false
		Style:1,//图标的显示风格，默认显示:1
		Tel:"",//服务热线
		Qqlist:"" //多个QQ用','隔开，QQ和客服名用'|'隔开
	}
	
	//展开
	$.fn.Sonline.opens = function(opts){
		var positionType = opts.Position;
		$("#SonlineBox").css({width:opts.Width+4});
		if(positionType=="left"){$("#SonlineBox > .contentBox").animate({left: 0},"fast");}
		else if(positionType=="right"){$("#SonlineBox > .contentBox").animate({right: 0},"fast");}
		$("#SonlineBox > .openTrigger").hide();
	}

	//关闭
	$.fn.Sonline.closes = function(positionType,speed){
		$("#SonlineBox > .openTrigger").show();
		var widthValue =$("#SonlineBox > .openTrigger").width();
		var allWidth =(-($("#SonlineBox > .contentBox").width())-6);
		if(positionType=="left"){$("#SonlineBox > .contentBox").animate({left: allWidth},speed);}
		else if(positionType=="right"){$("#SonlineBox > .contentBox").animate({right: allWidth},speed);}
		$("#SonlineBox").animate({width:widthValue},speed);
	}

	//风格选择
	$.fn.Sonline.styleType = function(opts){
		var typeNum = 1;
		switch(opts.Style)
	   　　{ case 1:
				typeNum = 41;
	 　　    break
			 case 2:
				typeNum = 42;
	　　     break
			 case 3:
				typeNum = 44;
	　　     break
			 case 4:
				typeNum = 45;
	　　     break
			 case 5:
				typeNum = 46;
	　　     break
			 case 6:
				typeNum = 47;
	　　     break
	　　     default:
				typeNum = 41;
	　　   }
		return typeNum;
	}
	//子插件：设置列表参数
	$.fn.setList = function(opts){
		if(opts.Qqlist=="") return;
		$("body").append("<div class='SonlineBox' id='SonlineBox' style='top:-600px; position:absolute;'><div class='openTrigger' style='display:none' title='展开'></div><div class='contentBox'><div class='closeTrigger' title='关闭'></div><div class='titleBox'><span>客服中心</span></div><div class='listBox'></div><div class='tels'><font style='height:10px;'></font><span>"+opts.Tel+"</span></div></div></div>");
		$("#SonlineBox > .contentBox").width(opts.Width)
		if(opts.Qqlist==""){
			$("#SonlineBox > .contentBox > .listBox").append("<p style='padding:15px'>暂无在线客服。</p>")
			}
		else{var qqListHtml = $.fn.Sonline.splitStr(opts);$("#SonlineBox > .contentBox > .listBox").append(qqListHtml);	}
		if(opts.Position=="left"){$("#SonlineBox").css({left:0});}
		else if(opts.Position=="right"){$("#SonlineBox").css({right:0})}
		$("#SonlineBox").css({top:opts.Top,width:opts.Width+4});
		var allHeights=0;
		if($("#SonlineBox > .contentBox").height() < $("#SonlineBox > .openTrigger").height()){
			allHeights = $("#SonlineBox > .openTrigger").height()+4;
		} else{allHeights = $("#SonlineBox > .contentBox").height()+40;}
		$("#SonlineBox").height(allHeights);
		if(opts.Position=="left"){$("#SonlineBox > .openTrigger").css({left:0});}
		else if(opts.Position=="right"){$("#SonlineBox > .openTrigger").css({right:0});}
	}	
	//滑动式效果
	$.fn.Sonline.scrollType = function(){
		$("#SonlineBox").css({position:"absolute"});
		var topNum = parseInt($("#SonlineBox").css("top")+"");
		$(window).scroll(function(){
			var scrollTopNum = $(window).scrollTop();//获取网页被卷去的高
			$("#SonlineBox").stop(true,false).delay(200).animate({top:scrollTopNum+topNum},"slow");
		});
	}	
	//分割QQ
	$.fn.Sonline.splitStr = function(opts){		
		var strs= new Array(); //定义一数组
		var QqlistText = opts.Qqlist;
		strs=QqlistText.split(","); //字符分割
		var QqHtml=""
		for (var i=0;i<strs.length;i++){
			var subStrs= new Array(); //定义一数组
			var subQqlist = strs[i];
			subStrs = subQqlist.split("|"); //字符分割
			QqHtml = QqHtml+"<div class='QQList'><span>"+subStrs[1]+"：</span><div class='ico'><a target='_blank' href='http://wpa.qq.com/msgrd?v=3&uin="+subStrs[0]+"&site=qq&menu=yes'><img border='0' src='http://wpa.qq.com/pa?p=2:"+subStrs[0]+":"+$.fn.Sonline.styleType(opts)+" &amp;r=0.22914223582483828' alt='点击这里'></a></div><div style='clear:both;'></div></div>"
		}
		return QqHtml;
	}
})(jQuery);

$(function(){
	var obj=$("#QQInfo"),
		position=obj.attr("position"), 
		qqTop=parseFloat(obj.attr("qqTop")), 
		effect=parseInt(obj.attr("effect")), 
		defaultsOpen=parseInt(obj.attr("defaultsOpen")), 
		qqList=obj.attr("qqList"); 	
		$().Sonline({ 
			Position:position,//left或right 
			Top:qqTop,//顶部距离，默认200px 
			Width:165,//顶部距离，默认200px 
			Style:6,//图标的显示风格共6种风格，默认显示第一种：1 
			Effect:effect,//effect==1?true:false, //滚动或者固定两种方式，0固定1滚动
			DefaultsOpen:defaultsOpen==1?true:false, //默认展开：true,默认收缩：false 
			// Tel:"400-555-6565",//其它信息图片等 
			Qqlist:qqList //多个QQ用','隔开，QQ和客服名用'|'隔开 */
		}); 
	})
	$(function(){
	$(".nav > ul > li").hover(function(){
			$(this).addClass("current");
			var subHeight = ($(this).find(".subNav").find("a").length)*42;
			$(this).find(".subNav").stop(true,true).animate({height:subHeight},"fast");
			},function(){
				$(this).removeClass("current");
				$(this).find(".subNav").animate({height:0},"fast");
		});
	})
/*****************对联广告**********************************/
 $.extend({
	dLAdv:function(options){
		var defaults={
			leftType:0,//左边广告图片效果0稳固不动,1缓慢复位
			rightType:0,//右边广告图片的效果0稳固不动,1缓慢复位
			leftTime:300,//左边复位时间
			rightTime:300,//右边复位时间
			leftCloseTime:1000,//左边关闭时间
			rightCloseTime:1000,//右边关闭时间
			leftToTop:200,//左边广告top
			leftToLeft:0,//左边广告离浏览器左边距离
			rightToTop:200,//右边广告top
			rightToRight:0,//右边广告离浏览器有变距离
			leftAdvStr:0,//左边的广告,1有,0无
			rightAdvStr:0,//右边的广告,1有,0无
			leftWidth:140,//左边广告宽度
			leftHeight:200,//左边广告高度
			rightWidth:140,//右边广告宽度
			rightHeight:200,//右边广告高度
			leftSrc:"/manager/images/dlAdvPic.jpg",//左边图片路径
			leftAlt:"advertising",//左边广告图片的alt值
			rightSrc:"/manager/images/dlAdvPic.jpg",//右边图片路径
			rightAlt:"advertising",//右边广告图片的alt值
			leftZindex:800,//左边层级
			rightZindex:800,//右边层级
			leftHref:"javascript:void(0)",//左边单击链接
			rightHref:"javascript:void(0)",//右边单击链接
			//下面项不做参数给出
			leftClass:"dlBoxLeft",//左边class
			rightClass:"dlBoxRight"//右边class
		}
		options= $.extend(defaults,options);
		var html="";
		if(options.leftAdvStr===1){
		html+="<div class="+options.leftClass+">";
		html+="<div class='dlAdvLeftImgBox'><a href="+options.leftHref+" target='_blank'> <img class='dlAdvleftImg' src="+options.leftSrc+" alt="+options.leftAlt+"></a></div>";
		html+="<div class='dlAdvCloseDiv'><a class='dlAdvClose dlAdvLeftClose'>关闭</a></div>";
		html+="</div>";
		}
		if(options.rightAdvStr===1){
		html+="<div class="+options.rightClass+">";
		html+="<div class='dlAdvRightImgBox'><a href="+options.rightHref+" target='_blank'><img class='dlAdvRightImg' src="+options.rightSrc+" alt="+options.rightAlt+"></a></div>";
		html+="<div class='dlAdvCloseDiv'><a class='dlAdvClose dlAdvRightClose'>关闭</a></div>";
		html+="</div>";
		}
		$("body").append(html);
		$(".dlAdvLeftClose,.dlAdvRightClose").on("click",function(){
			if($(this).is(".dlAdvLeftClose"))
			$("."+options.leftClass).fadeOut(options.leftCloseTime,function(){
				$(this).remove();
			});
			else if($(this).is(".dlAdvRightClose"))
			$("."+options.rightClass).fadeOut(options.rightCloseTime,function(){
				$(this).remove();
			});
		})
		var leftAdv=$("."+options.leftClass),
		rightAdv=$("."+options.rightClass),
		dlAdvCloseHeight=$(".dlAdvCloseDiv").eq(0).outerHeight();
		leftAdv.css({"z-index":options.leftZindex});
		rightAdv.css({"z-index":options.rightZindex});	
		function changeImgSize(imgObj,width,height){
			height-=dlAdvCloseHeight;
			imgObj.parent().width(width).height(height);
			imgObj.css({height:"100%",width:"100%"});
		}
	   function getAdvTop(pos,type){//pos,左,右,type,效果
			if(type===0){
				if(pos==="left"){
				   return {top:options.leftToTop+"px"};
				}
				else if(pos==="right"){
					return {top:options.rightToTop+"px"};
				}
			}
		   else if(type===1){
				var scrollTop=$(window).scrollTop();
				var top=0;
				if(pos==="left"){
					 top=options.leftToTop+scrollTop;
					return {top:top+"px"};
				}
				else if(pos==="right"){
					 top=options.rightToTop+scrollTop;
					return {top:top+"px"};
				}

			}
			else{alert("error")}	//方法getAdvTop的type有误
		}
		var leftAdvSize={width:options.leftWidth+"px",height:options.leftHeight+"px"};
		var rightAdvSize={width:options.rightWidth+"px",height:options.rightHeight+"px"};
		var leftAdvPos={left:options.leftToLeft+"px"};
		var rightAdvPos={right:options.rightToRight+"px"};
		changeImgSize($(".dlAdvleftImg"),options.leftWidth,options.leftHeight);
		changeImgSize($(".dlAdvRightImg"),options.rightWidth,options.rightHeight);
		function scrollMove(num){//num是数值,不同的数值表示的不同的缓慢恢复的对象
			$(window).scroll(function(){
				var scrollTop=$(window).scrollTop(),top=0;
				if(num===-1){//左边
					 top=scrollTop+options.leftToTop;
					setTimeout(function(){
						leftAdv.css({top:top+"px"});
					},options.leftTime);
				}
				else if(num===1){//右边
					top=options.rightToTop+scrollTop;
					// rightAdv.animate({top:top+"px"},1000)
					setTimeout(function(){
						//rightAdv.animate({top:top+"px"},1000)
						rightAdv.css({top:top+"px"});
					},options.rightTime)
				}
				else if(num===2){//两边
					var leftTop=scrollTop+options.leftToTop;
					var rightTop=scrollTop+options.rightToTop;
					setTimeout(function(){
						leftAdv.css({top:leftTop+"px"});
					},options.leftTime)
					setTimeout(function(){
						rightAdv.css({top:rightTop+"px"});
					},options.rightTime);
				}
			});
		}
	 var whoMove=0;//0,都不缓慢移动,-1,左边缓慢移动,1表示右边缓慢移动,2表示都移动
	if(options.leftType===0){//稳固不动
		leftAdv.css({"position":"fixed"}).css(getAdvTop("left",options.leftType)).css(leftAdvSize).css(leftAdvPos);
	}
		else if(options.leftType===1){//缓慢恢复
		leftAdv.css({"position":"absolute"}).css(getAdvTop("left",options.leftType)).css(leftAdvSize).css(leftAdvPos);
		whoMove=-1;
	}
		else {
		alert('左对联广告的效果参数传递有误');
	}
		if(options.rightType===0){
			rightAdv.css({"position":"fixed"}).css(getAdvTop("right",options.rightType)).css(rightAdvSize).css(rightAdvPos);
		}
		else if(options.rightType===1){
			rightAdv.css({"position":"absolute"}).css(getAdvTop("right",options.rightType)).css(rightAdvSize).css(rightAdvPos);
			whoMove=(whoMove===0?1:2);
		}
		else {
			alert('右对联广告的效果参数传递有误');
		}
		if(whoMove===0){}//都不缓慢恢复
		else if(whoMove===-1){//左边缓慢移动
scrollMove(whoMove);
		}
		else if(whoMove===1){//右边缓慢移动
			scrollMove(whoMove)
		 }
		else if(whoMove===2){//左右都缓慢移动
			scrollMove(whoMove)
		}
	}
});

/*****************对联广告**end********************************/
/*******************漂浮广告***************************************/
$.extend({
	pfAdv:function(options){
		var defaults={
			count:1,
			startTop:200,
			startLeft:200,
			width:140,//图片大小
			height:180,
			imageSrc:"pfAdvPic.jpg",
			step:1,
			delay:30,
			href:"javascript:void(0)",//单击的链接
			idStr:"pfAdv"
		}
		options= $.extend(defaults,options);
		var html="";
		html+="<div id="+options.idStr+" class='pfAdv'>";
		html+="<div class='plCloseDiv'></div>";
		html+="<div><a href="+options.href+" target='_blank'><img src="+options.imageSrc+"></a></div>";
		html+="</div>";
		$("body").append(html);//加入广告html
		var advBoxObj=$("#"+options.idStr);//广告对象
		advBoxObj.css({"position":"absolute","z-index":998}).width(options.width).height(options.height);//给广告定位
		$("img",advBoxObj).width(options.width).height(options.height);
		var advH=advBoxObj.outerHeight();//广告的高度
		var advW=advBoxObj.outerWidth();//广告的宽度
		var advMaxTop=0;//广告的最大top
		var advMaxLeft=0;//广告的最大left
		var stepMashionX=1;//1,表示水平方向加step,-1表示水平方向减step
		var stepMashionY=1;//1,表示垂直方向加step,-1表示垂直方向减step
		var currentX=0;//当前位置
		var currentY=0;
		var divToBrowTop=options.startTop;
		var divToBrowLeft=options.startLeft;
		function getScroll(){
			var scrollTop=$(window).scrollTop();//滚动条离开高度
			var scrollLeft=$(window).scrollLeft();//滚动条左距离
			return {x:scrollLeft,y:scrollTop};
		}
		function move(){
			var browW=$(window).width();//浏览器宽度
			var browH=$(window).height();//浏览器高度
			var scroll=getScroll();
			currentX=divToBrowLeft+scroll.x;//计算广告的top
			currentY=divToBrowTop+scroll.y;//计算出广告的left
			advMaxTop=browH-advH+scroll.y;//广告的最大top,不包括滚动条
			advMaxLeft=browW-advW+scroll.x;//广告的最大left,不包括滚动条
			if(currentY>=advMaxTop){
				stepMashionY=-1;
				currentY=divToBrowTop-options.step;
			}
			else if(currentY>scroll.y&&currentY<advMaxTop){
				if(stepMashionY==-1)
					currentY=divToBrowTop-options.step;
				else if(stepMashionY==1)
					currentY=divToBrowTop+options.step;
				else alert('垂直方向上的stepMashionY有误');
			}
			else if(currentY<=scroll.y){
				stepMashionY=1;
				currentY=divToBrowTop+options.step;
			}
			else {
				alert('垂直方向上比较有误');
			}
			if(currentX>=advMaxLeft){
				stepMashionX=-1;
				currentX=divToBrowLeft-options.step;
			}
			else if(currentX>scroll.x&&currentX<advMaxLeft){
				if(stepMashionX==-1){
					currentX=divToBrowLeft-options.step;
				}
				else if(stepMashionX==1){
					currentX=divToBrowLeft+options.step;
				}
				else alert('水平方向上的stepMashionX有误')
			}
			else if(currentX<=scroll.x){
				stepMashionX=1;
				currentX=divToBrowLeft+options.step;
			}
			else {
				alert('水平方向上比较有误');
			}
			divToBrowLeft=currentX;
			divToBrowTop=currentY;
			//var scroll=getScroll();
			currentX+=scroll.x;
			currentY+=scroll.y;
			advBoxObj.css({top:currentY+"px",left:currentX+"px"});
		}
		$(".plCloseDiv",advBoxObj).on("click",function(){advBoxObj.remove()})
		//$(window).resize(function(){initNum();});
		var moveMashion=null;
		advBoxObj.bind("mouseover",function(){clearTimeout(moveMashion);}).bind("mouseleave",function(){moveMashion=setInterval(move,options.delay);})
		moveMashion=setInterval(move,options.delay);
		move();
	}
});
/************漂浮广告*end*****************/

/************放大镜插件(一):使用单张图片的思路*****************/
/*
<div class="test"><img src="../img/x.jpg"  alt="小图"/></div>
$(".test").bnFdjOne({ zoom: 2 });
*/
 ; (function ($) {
			$.fn.bnFdjOne = function (options) {
				var defaluts = { 
					cameraW: 100, //镜头宽度
					cameraH: 100, //镜头高度
					pointBjColor: "#000", //镜头的背景颜色
					pointOpacity: 0.6, //镜头的透明度
					zoomPos: 10, //放大框距离源框的位置
					zoom: 2//放大倍数
				};
				options = $.extend(defaluts, options);
				var obj = $(this);               
				obj.addClass("gysFdjOrigin");
				var objOriImg=$("img",obj);
				var objOriImgW=objOriImg.width();
				var objOriImgH=objOriImg.height();
				var fdCount = $(".gysFdjOrigin").length;
				var fdAttr = "fd"; //属性变量
				obj.attr(fdAttr, fdCount); //添加属性
				var offset = obj.offset();
				var objLeft = offset.left; //对象left
				var objTop = offset.top; //对象top
				var objWidth = obj.width(); //对象宽度
				var objHeight = obj.height(); //对象高度
				//镜头相对box的活动范围

				var cameraMaxLeft = objWidth + objLeft - options.cameraW; //最大左范围
				var cameraMaxTop = objHeight + objTop - options.cameraH; //最大下范围

				var imgStr = obj.html();
				var html = "";
				html += "<div style='left:" + (objLeft + objWidth + options.zoomPos) + "px; top:" + objTop + "px;display:none; position:absolute;width:" + (options.cameraW * options.zoom) + "px;height:" + (options.cameraH* options.zoom) + "px;overflow:hidden;' class='gysFdjBox' " + fdAttr + "=" + fdCount + ">" + imgStr + "</div>";
				$("body").append(html);
				$("img", $(".gysFdjBox[" + fdAttr + "=" + fdCount + "]")).width(objWidth*options.zoom).height(objHeight*options.zoom);
				var objFdjcamera = null;
				if ($("#gysFdjcamera").length == 0) {
					var pointBlock = "<div id='gysFdjcamera' style='width:" + options.cameraW + "px; height:" + options.cameraH + "px; background-color:" + options.pointBjColor + ";opacity:" + options.pointOpacity + ";filter:alpha(opacity="+options.pointOpacity*100+");cursor:crosshair;position:absolute;display:none;'></div>";
				$("body").append(pointBlock);
				}
				objFdjcamera = $("#gysFdjcamera");
				var nowLeft = 0, nowTop = 0;
				obj.on("mouseover", function (event) {
					objFdjcamera.show().attr(fdAttr, fdCount);
					$(".gysFdjBox["+fdAttr+"="+fdCount+"]").show();
					$(document).on("mousemove", function (event) {
						var pointX = event.clientX+$(document).scrollLeft();
						var pointY = event.clientY+$(document).scrollTop();
						nowLeft = pointX - options.cameraW / 2;
						nowTop = pointY - options.cameraH / 2;
						if (nowLeft <= objLeft) { nowLeft = objLeft; }
						else if (nowLeft >= cameraMaxLeft) { nowLeft = cameraMaxLeft; }
						if (nowTop <= objTop) { nowTop = objTop; }
						else if (nowTop >= cameraMaxTop) { nowTop=cameraMaxTop;}
						objFdjcamera.css({ left: nowLeft + "px", top: nowTop + "px" });
						nowLeft=(nowLeft-objLeft)*options.zoom;
						nowTop=(nowTop-objTop)*options.zoom;
						$("img",$(".gysFdjBox[" + fdAttr + "=" + fdCount + "]")).css({ "margin-top": -nowTop + "px", "margin-left": -nowLeft + "px" });
					});
				});
				objFdjcamera.on("mouseleave", function () {
					$(document).off("mousemove");
					objFdjcamera.hide();
					$(".gysFdjBox["+fdAttr+"="+fdCount+"]").hide();
				});
			}
		})(jQuery);

/***********放大镜插件(一):使用单张图片的思路***end***************/

/************放大镜插件(二):使用二张图片的思路*****************/
/*
<div class="test"><!--整个放大效果的最外区域.-->
	<div class="testOri"><img  width="400px" height="250px" src="../img/small.jpg"  alt="原图"/></div><!--原始区域,为了更好地兼容各种浏览器,请将图片的宽和高注明-->
	<div class="testZoom"><img width="1440px" height="900px" src="../img/big.jpg"  alt="放大图"/></div><!--放大区域,为了更好地兼容各种浏览器,请将图片的宽和高注明-->
</div>
$(".test").bnFdjTwo({ ori: ".testOri", zoom: ".testZoom" });
*/

; (function ($) {
			$.fn.bnFdjTwo = function (options) {
				var defaults = {
					cameraW: 100, //镜头宽度
					cameraH: 100, //镜头高度
					cameraBjColor: "#000", //镜头背景色
					zoomIndex: 10, //放大框div的层级
					cameraOpacity: 0.6, //镜头透明度
					zoomPos: 10, //放大框距离源框的位置
					cameraIndex: 10//镜头的层级
				}
				var opt = $.extend({}, defaults, options); //合并参数          

				if (!opt.ori) { alert('你没有指定源图框'); return; }
				if (!opt.zoom) { alert('你没有指定放大框'); return; }
				var obj = $(this); //当前最大框对象
				if(obj.css("position")=="static"){obj.css("position","relative");}
				var objOriDiv = $(opt.ori, obj); //源div 
				var objOriDivOffset = objOriDiv.offset();
				var objOriDivLeft = objOriDivOffset.left; //源框的left
				var objOriDivTop = objOriDivOffset.top; //源框的top
				var objZoomDiv = $(opt.zoom, obj); //放大的div框
				var objOriImg = $("img", objOriDiv); //源图框               
				var objZoomImg = $("img", objZoomDiv); //放大框
				var objOriImgW = objOriImg.width();
				var objOriImgH = objOriImg.height();
				objOriDiv.width(objOriImgW).height(objOriImgH);
				obj.width(objOriImgW).height(objOriImgH);

				var objOriDivW = objOriDiv.width();
				var objOriDivH = objOriDiv.height();
				var cameraMaxLeft = objOriDivW - opt.cameraW; //镜头的最大left
				var cameraMaxTop = objOriDivH - opt.cameraH; //镜头的做大top

				var cameraCSs = { width: opt.cameraW, height: opt.cameraH, "background-color": opt.cameraBjColor, opacity: opt.cameraOpacity, filter: "alpha(opacity=" + opt.cameraOpacity * 100 + ")", "position": "absolute", display: "none",cursor: "crosshair", "z-index": opt.cameraIndex }; //镜头css               
				obj.append("<div class='camera'></div>"); //填充镜头
				var objCamera = $(".camera", obj);
				objCamera.css(cameraCSs); //添加样式                
				
				var zoom = objZoomImg.width() / objOriImgW; //放大倍数
				objZoomDiv.width(opt.cameraW * zoom).height(opt.cameraH * zoom).css({ position: "absolute", left: (objOriDivW + opt.zoomPos) + "px", top: "0px", overflow: "hidden", "z-index": opt.zoomIndex, display: "none" }); //设置放大的div框

				var nowLeft = 0, nowTop = 0;
				objOriDiv.on("mouseover", function () {
					objCamera.show(); //显示镜头,
					objZoomDiv.show(); //显示放大框 
					$(document).on("mousemove", function (e) {
						nowLeft = e.clientX - objOriDivLeft - opt.cameraW / 2+ $(document).scrollLeft();
						nowTop = e.clientY-objOriDivTop - opt.cameraH / 2 + $(document).scrollTop();
						if (nowLeft <= 0)   nowLeft = 0;                       
						else if (nowLeft >= cameraMaxLeft)   nowLeft = cameraMaxLeft;
						
						if (nowTop <= 0) nowTop = 0;
						else if (nowTop >= cameraMaxTop)  nowTop = cameraMaxTop;

						objCamera.css({ left: nowLeft + "px", top: nowTop + "px" }); //镜头的移动

						nowLeft = nowLeft * zoom;
						nowTop = nowTop * zoom;

						objZoomImg.css({ "margin-left": -nowLeft + "px", "margin-top": -nowTop + "px" });
					});
				});

				objCamera.on("mouseout", function (e) {
					$(this).hide();
					$(document).off("mousemove");
					$(opt.zoom, obj).hide();
				});
			}
		})(jQuery);

/************放大镜插件(二):使用二张图片的思路*end****************/



/***************************前台的会员,购物*********************************/
/**********会员****************/
function loadContentAjax(obj){
	var html="<div>数据正在获取中......</div>";
	obj.html(html);
	}
function closeContentAjax(obj){
	obj.html("");
	}
//会员登录界面
$("#passWord,#msgCheckcode").on("keyup",function(e){
		var code=e.which;
		if(code==13){
			if($(".systemDialog ").length>=2)
				return;
			else 
				memLog();
			}
		});

function openMen(id,type){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"",userLabelId:id,type:type},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			//console.log(data);
			fwajaxClose();
			layer.open({
				title: '',
				area :'auto',
				offset :'auto',
				zIndex : 1001,
				btn: [],
				skin: 'layui-layer-molv', //加上边框
				content:data
			});
		}
	});
}
	
//领取优惠券会员登录界面
function openMen1(id,type){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"",couponID:id,type:type},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			//console.log(data);
			fwajaxClose();
			layer.open({
				title: '',
				area :'auto',
				offset :'auto',
				zIndex : 1001,
				btn: [],
				skin: 'layui-layer-molv', //加上边框
				content:data
			});
		}
	});
}
//购买时会员登录界面
function buyOpenMen(id,type){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"",proId:id,type:type},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			//console.log(data);
			fwajaxClose();
			layer.open({
				title: '',
				area :'auto',
				offset :'auto',
				zIndex : 1001,
				btn: [],
				skin: 'layui-layer-molv', //加上边框
				content:data
			});
		}
	});
}
//个人中心界面
function openMen2(){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/index.asp",
		data:{},
		type:"POST",
		dataType:"html",
		cache:"false",
		error:function(){
				fwajaxClose();
				console.log("error");
			},
		success:function(data){
			fwajaxClose();
			layer.open({
				type: 1,
				title: '个人中心',
				area: ['1100px', '600px'],
				closeBtn: 1,
				skin: 'layui-layer-molv',
				shadeClose: false,
				scrollbar: false,
				content:data
			});
		}
	});
}
function openMen3(cid){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"success",couponID:cid},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			//console.log(data);
			fwajaxClose();
			layer.open({
				title: '',
				area :'auto',
				offset :'auto',
				zIndex : 1001,
				btn: ['确定'],
				skin: 'layui-layer-molv', //加上边框
				content:data
			});
		}
	});
}
//会员的验证码	
function msgCheckcodeFocus(){
	var src='/inc/checkcode.asp?t='+(new Date().getTime());
	$("#imgcheckcode").attr("src",src).show();;
	}
	
//会员登录方法
function memLog(isCode){
	var memberName = $.trim($("#memberName").val());
	var couponID = $.trim($("#couponID").val());
	var passWord = $.trim($("#passWord").val());
	var RadCode = $.trim($(".RadCode").val());
	if(memberName==""){
		layer.alert('请正确填写登陆账号', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}
	if(passWord==""){
		layer.alert('密码为空无法登陆', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}
	if(RadCode=="" && isCode==1){
		layer.alert('验证码为空', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}	
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"memLog",memberName:memberName,passWord:passWord,RadCode:RadCode,couponID:couponID},
		type:"POST",
		dataType:"json",
		error:function(){
			layer.alert('服务器连接失败', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
			},
		success:function(data){
			if(data.status=="failed")
			layer.alert(data.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			else if(data.status=="success")	{
				$("#timeSessionMashine").val("guoyansi");
				controlTimeMashine();
				//openMen2();
				openMen1(couponID);
				}
			else 
			layer.alert(transKeyWords(globelVary.languageId,13), {icon:2,zIndex : 2147483641,title : ['提示' , true]});
			}
		})
	}
//会员登录方法二
function MemLog2(isCode){
	var memberName = $.trim($("#memberName").val());
	var passWord = $.trim($("#passWord").val());
	var RadCode = $.trim($(".RadCode").val());
	
	if(memberName==""){
		layer.alert('请正确填写登陆账号', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}
	if(passWord==""){
		layer.alert('密码为空无法登陆', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}
	if(RadCode=="" && isCode==1){
		layer.alert('验证码为空', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}	
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"memLog",memberName:memberName,passWord:passWord,RadCode:RadCode},
		type:"POST",
		dataType:"json",
		error:function(){
			layer.alert('服务器连接失败', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
			},
		success:function(data){
			if(data.status=="failed"){
				layer.alert(data.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			}
			else if(data.status=="success")	{
				$("#timeSessionMashine").val("guoyansi");
				controlTimeMashine();
				layer.alert(data.msg, {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				location.reload();
				}
			else {
				layer.alert(transKeyWords(globelVary.languageId,13), {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			}
		}
	})
}

//会员领取优惠券
function checkLevel(cid){
	var data = {sType:"checkLevel",couponId:cid};
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		type:"POST",
		data:data,
		dataType:"json",
		cache:false,
		error:function(data) {
			layer.alert('服务器连接失败!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
		},
		success:function(data){if(data.status=="success"){
				openMen3(cid);
				
				//layer.alert(data.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			}else if(data.status=="failed"){
				layer.alert(data.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			}else {
				//console.log("1"+data.msg);
				layer.alert('参数异常!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			}
		}
	});
}

//会员注册,会员信息提交
function memberInfo_submit(className,type){
	var data=getRegData(className);
	if(data==0)
	return;
	var url;
	if(type=="add"){
		url="/apply/member/new_member/memberReg.asp";
		data.sType="add";
		}
	else if(type=="save"){
		url="/apply/member/new_member/memberInfo.asp";
		data.sType="save";
		}
		fwajaxStar();
		$.ajax({
			url:url,
			data:data,
			dataType:"json",
			type:"POST",
			cache:false,
			error: function(){
				fwajaxClose();
				layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title:['提示',true],btn: ['确定']});
				},
			success: function(data){
				fwajaxClose();
				if(data.status=="success")
					layer.alert(data.msg, {icon:1,zIndex : 2147483641,title : ['提示',true],btn: ['确定']});
				else if(data.status=="failed")
					layer.alert(data.msg, {icon:2,zIndex : 2147483641,title : ['提示',true],btn: ['确定']});
				else 
					layer.alert('参数异常', {icon:2,zIndex : 2147483641,title : ['提示',true],btn: ['确定']});
				}
			});
	}
function getRegData(className){
			var data={};//={sType:"add"};
			var getStr=function(name,con){
				con=$.trim(con);
				if(!data[name])
					data[name]=con;
				else{
					data[name]+=","+con;
					}
				}
			var n=0;var titles="";
			$("."+className).each(function() {
				var name=$(this).attr("name");
				var type=$(this).attr("type");
				titles=$(this).attr("titles");
				if(type=="text"||type=="textarea"||type=="password"){
					var con=$.trim($(this).val());
					if(con=="system_null"){n=1;return false;}//关键字
					if($(this).attr("submit")=="no"){n=3;return false;}//验证错误
					if($(this).attr("regischeck")==1&&con==""){n=4;return false;}//必填项
					getStr(name,con);
					}
				else if(type=="radio"||type=="checkbox"){
					if(this.checked == true)
						getStr(name,$(this).val());
					}
				else if(type=="select"){
					getStr(name,$("option:selected", $(this)).val());
					}
				else{
					n=2;
					return false;
					}
				});
				if(!memberNotice(n,titles))
				return 0;
				for(var i=1;i<=10;i++){
					if(!data["regMem"+i])
					data["regMem"+i]="system_null";
					}
				return data;
				}
function memberNotice(n,titles){
			var con="";var bool=true;
			if(n==1) {con='system_null是关键字,无法提交';bool=false;}
			else if(n==2){con='有未知类型控件';bool=false;}
			else if(n==3) {con=titles+'填写错误';bool=false;}
			else if(n==4){con=titles+'为必填项';bool=false;}
			if(!bool){layer.alert(con, {icon:2,zIndex : 2147483641,title : ['提示',true],btn: ['确定']});return false;}
			return true;
			}
	
//会员资料验证
function memberRegValidata(className){
	$("."+className,$(".user_login_form")).each(function() {
		var type=$(this).attr("type");
		if(typeof type=="undefined")
			type=$(this).get(0).tagName;
		if(type=="text"||type=="TEXTAREA"){
			var regtype=$(this).attr("regtype");
			var data={};
			var regischeck=$(this).attr("regischeck");
			if(regischeck==0)//非必填
				data.empty='不是必填项';
			else if(regischeck==1)//必填
				{
					//data.empty="为必填项";
					}
			//纯数字格式
			if(regtype==5){data.type="number";data.error='不是数字';data.right='填写正确';data.width=200;$(this).fwValidateText(data);}
			//纯字母格式
			else if(regtype==6){data.type="english";data.error='不是字母';data.right='填写正确';data.width=200;$(this).fwValidateText(data);}
			//电话格式
			else if(regtype==7){data.type="tel";data.error='电话格式有误';data.right='填写正确';data.width=200;$(this).fwValidateText(data);}
			//手机格式
			else if(regtype==8){data.type="phone";data.error='手机格式有误';data.right='填写正确';data.width=200;$(this).fwValidateText(data);}
			//邮箱格式
			else if(regtype==9){data.type="email";data.error='请正确填写邮箱格式';data.right='填写正确';data.width=200;$(this).fwValidateText(data);}
			}
		});
	}

//免费注册
function freeReg(){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/memberReg.asp",
		data:{sType:""},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			fwajaxClose();
			layer.open({
				title: '',
				offset :'auto',
				zIndex : 1001,
				btn: [],
				btn1 : function(index, layero){
				  memberInfo_submit('regType','add','1');
				},
				skin: 'layui-layer-molv', //加上边框
				content:data
			});	
			}
		});
	}	
function freeReg1(){
		layer.alert('请升级版本', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
}
//会员密码找回
function forget_pw(){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/forgetPW.asp",
		data:{sType:""},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			fwajaxClose();
			layer.alert(data, {icon:1,zIndex : 2147483641});
			}
		});
	}
function forget_pw1(){
	fwajaxStar();
	$.ajax({
		url:"/apply/member/new_member/forgetPW.asp",
		data:{sType:""},
		type:"POST",
		dataType:'html',
		cache:"false",
		error: function(data){
			console.log(data.responseText);
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			fwajaxClose();
			layer.open({
				title: '',
				area :'auto',
				offset :'auto',
				zIndex : 1001,
				btn: [],
				//skin: 'layui-layer-molv', //加上边框
				content:data
			});
			//layer.alert(data, {icon:1,zIndex : 2147483641});
			}
		});
	}	
	
/**********会员**end**************/
/**********购物车****************/
//选择配送方式
function changeSendPrice(obj){
	if(obj.prop("checked")==true){
		var price=obj.attr("price");
		if(isNaN(price)){
			layer.alert(price+'无法完成计算', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return;
		}		
		$(".sendPriceTotal").html(price);
		//$(".ft_c01").html(parseFloat($(".totalPrice").html())+parseFloat(price));
		var totalPrice = $(".totalPrice").html();
		var couponPrice = $(".sendCouponPrice").html();
		totalPrice=totalPrice.replace(",","")
		total=parseFloat(totalPrice)+parseFloat(price)-parseFloat(couponPrice);
		$(".ft_c01").html(total.toFixed(2));
	}
}
//选择优惠券
function changeCoupon(){
	var selectOne = $("#select option:selected").val();//0
	$(".sendCouponPrice").html(selectOne);

	var totalPrice = $(".totalPrice").html();
	var sendPrice = $(".sendPriceTotal").html();
	var couponPrice = $(".sendCouponPrice").html();
	totalPrice=totalPrice.replace(",","")
	var total=parseFloat(totalPrice)+parseFloat(sendPrice)-parseFloat(couponPrice);
	$(".ft_c01").html(total.toFixed(2)); 
}
//选择付款方式	
function changePayType(obj){
	var currency=obj.attr("currency");
	$(".moneyCoin").html(currency);
	}	
//返回购物车页面
function returnCart(){
	fwajaxStar();
	$.ajax({
		url:"/apply/shopping/shoppingCar.asp",
		data:{sType:""},
		type:"POST",
		dataType:"html",
		cache:"false",
		error:function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 199311160693});
			},
		success:function(data){
			fwajaxClose();
			layer.closeAll();
			layer.open({type: 1,title: "",closeBtn: 1,content: data,zIndex :199211160693})
			}
		})
	}
//获取购物的数量或添加到购物车的数量
function getShoppingCount(){
	var proNum=$(".text_shoping",$(".product_summary")).val();
	if(isNaN(proNum)){layer.alert('请正确填写购物数量', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});return "stop";}
	proNum=parseInt(proNum);
	if(proNum==0) return "stop";
	return proNum;
	}
//购物车购买
function payCart(){
	var name=$(".deliveryAddr_name").val();
	var address=$(".deliveryAddr_addr").val();
	var post=$(".deliveryAddr_post").val();
	var phone=$(".deliveryAddr_phone").val();
	var userinfo=$(".userinfo").val();
	var couponID = $("#select option:selected").attr("cId");
	var finalPrice = $(".ft_c01").html();
	var data={sType:"pay",name:name,address:address,post:post,phone:phone,userinfo:userinfo,shoppingStr:window["shoppingCountAndIdStr"],couponID:couponID,finalPrice:finalPrice};
	$("input[name=sendSelect]").each(function() {
		if(this.checked == true){
			data.sendType=$(this).val();
			return false;
			}
		});
	if($(".deliveryAddr_name").val()==""){
		layer.alert('收货人不能为空', {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']});return;
		}
	if($(".deliveryAddr_addr").val()==""){
		layer.alert('收货地址不能为空', {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']});return;
		}
	if($(".deliveryAddr_phone").val()==""){
		layer.alert('联系方式不能为空', {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']});return;
		}

	if(!data.sendType){
		layer.alert('请选择配送方式', {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']});return;
		}
	
	$("input[name=payType]").each(function() {
		if(this.checked == true){
			data.payType=$(this).val();
			return false;
			}
		});
	if(!data.payType){
		layer.alert('请选择付款方式', {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']});return;
		}	
	fwajaxStar();
	$.ajax({
		url:"/apply/shopping/shopFinish.asp",
		data:data,
		cache:false,
		dataType:"html",
		type:"POST",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']})
			},
		success:function(data){
			fwajaxClose();
			try{
				 data=eval("("+data+")");
				 if (data.status=="error"){
				layer.alert(data.msg, {icon:2,zIndex : 199311160693,title : ['提示' , true],btn: ['确定']})
			}
				}
			catch(e){
				$(".systemDialog").remove();
				layer.closeAll();
				layer.open({type: 1,title: "",closeBtn: 0,content: data,zIndex :199211160693})
				window["shoppingCountAndIdStr"]=null;
				}
			}
		});
	}
	
//产品展示的立即购买
function nowShopping(proId){
	var reg=/[\d*,*]{0,}\d{1,}\.*\d*/gi;
	var buyObj=$(".buy",$(".admin_tool"));
	var proNum = $('.text_shoping').prop('value');
	var proPrice = $('.price_Detail').html();
	proPrice=proPrice.match(reg)[0];
	var pro_S_Value='';
	var inventory=$('.ck').html();
	$('.cpgg').each(function(){
		if($(this).hasClass('cpgg-selected')){
			pro_S_Value+=$(this).html();
			pro_S_Value+=',';
		}
	})
	if(proNum=="stop")
		return;
	var data={sType:"buyNow",proNum:proNum,proId:proId,proPrice:proPrice,pro_S_Value:pro_S_Value,inventory:inventory};
	fwajaxStar();
	$.ajax({
		url:"/apply/shopping/buyNow.asp",
		//dataType:"html",
		cache:false,
		type:"POST",
		data:data,
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']})
			},
		success:function(data){
			fwajaxClose();
			if(data=="login"){buyOpenMen(proId,"buyShopping");}
			else layer.open({type: 1,title: "",closeBtn: 1, skin: 'demo-class',content: data,zIndex :10000})
			}
		});
	}
//购物出之后的立即购买确认	
function payNow(){
	var name=$(".deliveryAddr_name").val();
	var address=$(".deliveryAddr_addr").val();
	var post=$(".deliveryAddr_post").val();
	var phone=$(".deliveryAddr_phone").val();
	var userinfo=$(".userinfo").val();
	var proId=$(".buyNowshoppingTr").attr("proId");
	var orderPrice = $(".buyNowshoppingTr .shoppingName:eq(1)").html();
	var proNum=$(".buyNowshoppingTr .shoppingName:eq(2)").html();
	var pro_S_Value=$(".buyNowshoppingTr .shoppingName:eq(3)").html();
	var couponID = $("#select option:selected").attr("cId");
	var finalPrice = $(".ft_c01").html();	
	var data={sType:"payNow",name:name,address:address,post:post,phone:phone,userinfo:userinfo,proId:proId,proNum:proNum,orderPrice:orderPrice,pro_S_Value:pro_S_Value,couponID:couponID,finalPrice:finalPrice};
	if($(".deliveryAddr_name").val()==""){
		layer.alert('收货人不能为空', {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});return;
		}
	if($(".deliveryAddr_addr").val()==""){
		layer.alert('收货地址不能为空', {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});return;
		}
	if($(".deliveryAddr_phone").val()==""){
		layer.alert('联系方式不能为空', {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});return;
		}
	$("input[name=sendSelect]").each(function() {
		if(this.checked == true){
			data.sendType=$(this).val();
			return false;
			}
		});
	if(!data.sendType){
		layer.alert('请选择邮递方式', {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});return;
		}
	$("input[name=payType]").each(function() {
		if(this.checked == true){
			data.payType=$(this).val();
			return false;
			}
		});
	if(!data.payType){
		layer.alert('请选择付款方式', {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});return;
		}
	fwajaxStar();
	$.ajax({
		url:"/apply/shopping/shopFinish.asp",
		data:data,
		cache:false,
		dataType:"html",
		type:"POST",
		error: function(){
			fwajaxClose();
			layer.alert('服务器连接错误', {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			fwajaxClose();
			 try{
				 data=eval("("+data+")");
				 if (data.status=="error"){
				layer.alert(data.msg, {icon:2,zIndex : 199511160693,title : ['提示' , true],btn: ['确定']});
			}
				}
			catch(e){ 
				$(".systemDialog").remove();
				layer.open({ type: 1,title: "",closeBtn: 0,content: data});
				}
			}
		});
	}
//改变购物车的价格
function changeTotalPrice(commonTr,count){
	var shoppPrice=parseFloat(commonTr.find(".shoppPrice").html());	
	var shoppingOneTotalPrice=(count*shoppPrice).toFixed(2);	
	commonTr.find(".shopingOneTotalPrice").html(shoppingOneTotalPrice);
}
//改变购物车的价格
function changeShopPrice(proNum,shoppTotalPrice){
	shoppPrice = $(".product_summary .price").attr('rel');
	realTotalPrice = $("#shoppingCart").find("b").eq(1).attr('rel');
	proNumcount = proNumcount+proNum;
	shoppTotalPrice = (parseInt(proNumcount)*parseFloat(shoppPrice)+ parseFloat(realTotalPrice)).toFixed(2);
	$("#shoppingCart").find("b").eq(1).html(shoppTotalPrice);
}
//产品展示的购物车
var proNumcount = 0;
function addShoppingToCart(obj,proId){
	var reg=/[\d*,*]{0,}\d{1,}\.*\d*/gi;
	var buyObj=$(".buy",$(".admin_tool"));
	var proNum = $('.text_shoping').prop('value');
	var proPrice = $('.price_Detail').html();
	proPrice=proPrice.match(reg)[0];
	var pro_S_Value='';
	$('.cpgg').each(function(){
		if($(this).hasClass('cpgg-selected')){
			pro_S_Value+=$(this).html();
			pro_S_Value+=',';
		}
	})
	if(document.getElementById('shoppingCart')) {    
			if (document.getElementById('shoppingCart_notlogin'))
			{
				layer.alert('请登录!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return;
			}else{
				
				if(proNum=="stop")
					return;
				var data={proNum:proNum,proId:proId,pro_S_Value:pro_S_Value,proPrice:proPrice};
				$.ajax({
					url:"/apply/shopping/addCart.asp",
					dataType:"json",
					cache:false,
					type:"POST",
					data:data,
					error: function(){
						fwajaxClose();
						layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
						},
					success:function(data){
						 if(data.status=="success"){
							$("body").append("<div class='addShoppingToCartCount'><div class='addShoppingCount'>+"+proNum+"</div></div>");
							changeShopPrice(proNum);

							var originOffset=obj.offset();
							$(".addShoppingToCartCount").css({"top":originOffset.top+"px",left:originOffset.left+"px"});
							var offset=buyObj.offset();	
							var targetTop = $("#shoppingCart").offset().top;
							var targetLeft = $("#shoppingCart").offset().left + 15;
							var time=1000;
							$(".addShoppingToCartCount").animate({left:targetLeft,top:targetTop},time,'swing');
							setTimeout(function(){$(".addShoppingToCartCount").remove();},time);
							}
						else if(data.status=="failed")
							layer.alert('添加商品到购物车失败!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
						else 
							 layer.alert(transKeyWords(globelVary.languageId,13), {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
						}
					});
			}
		} else {
			if (document.getElementById('shoppingCart_notlogin'))
			{
				layer.alert('请登录!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return;
			}else{
				layer.alert('请添加购物车标签到页面!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return;
			}
		}
	}
/**********购物车**end**************/
function memberCenterShow(url) {
			loadContentAjax($(".user_center_sub2"));
			$.ajax({
				url:url,
				dataType:"html",
				cache:false,
				error: function(){
					closeContentAjax($(".user_center_sub2"));
					layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});},
				success:function(data){
					closeContentAjax($(".user_center_sub2"));
					$(".user_center_sub2").html(data);
					}
				});
		}
function memberCenterShow1(url) {
			loadContentAjax($("#Umian"));
			$.ajax({
				url:url,
				dataType:"html",
				cache:false,
				error: function(){
					closeContentAjax($("#Umian"));
					layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});},
				success:function(data){
					closeContentAjax($("#Umian"));
					$("#Umian").html(data);
					}
				});
}
//订单列表（未支付）
function memberCenterShow3(url) {
			loadContentAjax($(".cupBox"));
			$.ajax({
				url:url,
				dataType:"html",
				cache:false,
				error: function(){
					closeContentAjax($(".cupBox"));
					layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});},
				success:function(data){
					closeContentAjax($(".cupBox"));
					$(".cupBox").html(data);
					}
				});
}
//订单列表（未收货）
function memberCenterShow5(url) {
			loadContentAjax($(".cupBox1"));
			$.ajax({
				url:url,
				dataType:"html",
				cache:false,
				error: function(){
					closeContentAjax($(".cupBox1"));
					layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});},
				success:function(data){
					closeContentAjax($(".cupBox1"));
					$(".cupBox1").html(data);
					}
				});
}
//购物车
function memberCenterShow4(url) {
			loadContentAjax($(".shoppingCar"));
			$.ajax({
				url:url,
				dataType:"html",
				cache:false,
				error: function(){
					closeContentAjax($(".shoppingCar"));
					layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});},
				success:function(data){
					closeContentAjax($(".shoppingCar"));
					$(".shoppingCar").html(data);
					}
				});
}
function memberCenterShow2(url) {
			loadContentAjax($("#LoginBox"));
			$.ajax({
				url:url,
				dataType:"html",
				cache:false,
				error: function(){
					closeContentAjax($("#LoginBox"));
					layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});},
				success:function(data){
					closeContentAjax($("#LoginBox"));
					$("#LoginBox").html(data +" <div>12341564</div>");
					}
				});
}
function memberLogout(){
	$.ajax({
		url:"/apply/member/new_member/login1.asp",
		data:{sType:"loginOut"},
		type:"POST",
		dataType:"json",
		cache:"false",
		error: function(){},
		success:function(data){
			if(data.status=="success"){
				closeDialog("all");
				window.location.reload();
				}
			else if(data.status=="falied"){
				layer.alert(data.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				}
			else {
				layer.alert('参数异常!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				}
			}
		});
	}	
//购物车
function openShoppingCar(){
	fwajaxStar()
	$.ajax({
		url:"/apply/shopping/shoppingCar.asp",
		data:{sType:""},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose()
			layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			fwajaxClose();
			layer.open({type: 1,title: "",closeBtn: 1,content: data,zIndex: 2147483641})
			}
		});
	}

//超时处理
function controlTimeMashine(){//登录后调用,开始计时
	clearTimeout(globelVary.timeMashine); 	
	globelVary.timeMashine=setTimeout(function(){globelVary.sessionTimeBool=1;$("#timeSessionMashine").val("");},1000*60*20-20);//超时
	}

function getSessionTimeBool(){//每次ajax请求时调用,返回false后面的ajax不在调用,返回true表示未超时,可以继续执行后面的代码
	 if(globelVary.sessionTimeBool==1){
		 //bool=false;
		 window["destroySessionAjax"]=1;
		$.ajax({
			url:"/apply/member/logout.asp",
			type:"GET",
			cache:false,
			error: function(){
				layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				},
			success:function(){
				if(confirm('登录超时,请重新登陆?'))
					window.top.location.reload();
				else 
					window.top.location.reload();
				}
			});
		}
	}
/**
放大镜
**/
(function($){
	$.fn.imagezoom=function(options){
		var settings={xzoom:310,yzoom:310,offset:10,position:"BTR",preload:1};
		if(options){$.extend(settings,options);}
		/*var noalt='';*/
		var self=this;
		$(this).bind("mouseenter",function(ev){
			var imageLeft=$(this).offset().left;
			var imageTop=$(this).offset().top;
			var imageWidth=$(this).get(0).offsetWidth;
			var imageHeight=$(this).get(0).offsetHeight;
			var boxLeft=$(this).parent().offset().left;
			var boxTop=$(this).parent().offset().top;
			var boxWidth=$(this).parent().width();
			var boxHeight=$(this).parent().height();
			/*noalt=$(this).attr("alt");*/
			var bigimage=$(this).attr("rel");
			$(this).attr("alt",'');
			if($("div.zoomDiv").get().length==0){
				$(document.body).append("<div class='zoomDiv'><img class='bigimg' src='"+bigimage+"'/></div><div class='zoomMask'>&nbsp;</div>");
			}
			if(settings.position=="BTR"){
				if(boxLeft+boxWidth+settings.offset+settings.xzoom>screen.width){
					leftpos=boxLeft-settings.offset-settings.xzoom;
				}else{
					leftpos=boxLeft+boxWidth+settings.offset;
				}
			}else{
				leftpos=imageLeft-settings.xzoom-settings.offset;
				if(leftpos<0){leftpos=imageLeft+imageWidth+settings.offset;}
			}
			$("div.zoomDiv").css({top:boxTop,left:leftpos});
			$("div.zoomDiv").width(settings.xzoom);
			$("div.zoomDiv").height(settings.yzoom);
			$("div.zoomDiv").show();
			$(this).css('cursor','crosshair');
			$(document.body).mousemove(function(e){
				mouse=new MouseEvent(e);
				if(mouse.x<imageLeft||mouse.x>imageLeft+imageWidth||mouse.y<imageTop||mouse.y>imageTop+imageHeight){
					mouseOutImage();
					return;
				}
				var bigwidth=$(".bigimg").get(0).offsetWidth;
				var bigheight=$(".bigimg").get(0).offsetHeight;
				var scaley='x';
				var scalex='y';
				if(isNaN(scalex)|isNaN(scaley)){
					var scalex=(bigwidth/imageWidth);
					var scaley=(bigheight/imageHeight);
					var zoomMaskWidth=((settings.xzoom)/scalex>$(".jqzoom").width())?$(".jqzoom").width():(settings.xzoom)/scalex
					var zoomMaskHeight=((settings.yzoom)/scaley>$(".jqzoom").height())?$(".jqzoom").height():(settings.yzoom)/scaley;
					$("div.zoomMask").width(zoomMaskWidth);
					$("div.zoomMask").height(zoomMaskHeight);
					$("div.zoomMask").css('visibility','visible');
				}
				xpos=mouse.x-$("div.zoomMask").width()/2;
				ypos=mouse.y-$("div.zoomMask").height()/2;
				xposs=mouse.x-$("div.zoomMask").width()/2-imageLeft;
				yposs=mouse.y-$("div.zoomMask").height()/2-imageTop;
				xpos=(mouse.x-$("div.zoomMask").width()/2<imageLeft)?imageLeft:(mouse.x+$("div.zoomMask").width()/2>imageWidth+imageLeft)?(imageWidth+imageLeft-$("div.zoomMask").width()):xpos;
				ypos=(mouse.y-$("div.zoomMask").height()/2<imageTop)?imageTop:(mouse.y+$("div.zoomMask").height()/2>imageHeight+imageTop)?(imageHeight+imageTop-$("div.zoomMask").height()):ypos;
				$("div.zoomMask").css({top:ypos,left:xpos});
				$("div.zoomDiv").get(0).scrollLeft=xposs*scalex;
				$("div.zoomDiv").get(0).scrollTop=yposs*scaley;
			});
		});
		function mouseOutImage(){
			$(document.body).unbind("mousemove");
			$("div.zoomMask").remove();
			$("div.zoomDiv").remove();
		}
		count=0;
		if(settings.preload){
			$('body').append("<div style='display:none;' class='jqPreload"+count+"'></div>");
			$(this).each(function(){
				var imagetopreload=$(this).attr("rel");
				var content=jQuery('div.jqPreload'+count+'').html();
				jQuery('div.jqPreload'+count+'').html(content+'<img src=\"'+imagetopreload+'\">');
			});
		}
	}
})(jQuery);
function MouseEvent(e){this.x=e.pageX;this.y=e.pageY;}
/**
发送邮箱验证码
**/
function getCode(){
	var memberMail = $("input[name='regMem5']").val();
	if(memberMail=="" ||!(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/).test(memberMail)){
		layer.alert('请正确填写邮箱格式!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
	return;
	}
	fwajaxStar();
	$.ajax({
		url:"/apply/member/mailVerification.asp",
		data:{"memberMail":memberMail},
		type:"POST",
		dataType:"html",
		cache:"false",
		error: function(){
			fwajaxClose();
				layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			},
		success:function(data){
			fwajaxClose();
			layer.alert('验证码已发送到邮箱!', {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			}
		});
	}
/**
验证邮箱
**/
function checkCode(){
	var mailCode = $("#mailCode").val();
	$.ajax({
	type:"post",
	url:"/apply/member/memberReg.asp",
	data:{"sType":"maicheck","mailCode":mailCode},
	dataType:"json",
	cache:"false",
	error:function(){
		layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
		},
	})
}
/**
投票
**/
function vote(userLabelId){
	var voteNameChecked="";
	$('input[name="voteName'+userLabelId+'"]:checked').each(function(){
		voteNameChecked+=$(this).val()+",";
	})
	if (voteNameChecked === "")
	{
		layer.alert('填写错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
		return false;
	}else{
		$.ajax({
			type: "POST",
			url: "/apply/vote/vote_add.asp",
			data:{"userLabelId":userLabelId,"voteNameChecked":voteNameChecked},
			cache:false, 
			error:function(){ 
			layer.alert('服务器连接错误!', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				return false;
			}, 
			success: function(data){
				var dataMsg=eval("("+data+")");
				if(dataMsg.status=="failed"){ 
					layer.alert(dataMsg.msg, {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
					return false;
				}else if(dataMsg.status=="success"){
					layer.alert(dataMsg.msg, {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
				}
			} 
		});
	}
}

/**
查看投票结果
**/
function voteResult(userLabelId){
	$.ajax({
		type: "POST",
		url: "/apply/vote/vote_result.asp",
		data:{"userLabelId":userLabelId},
		cache:false,
		error:function(){
		layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
			return false;
		},
		success: function(data){
			layer.alert(data, {icon:1,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
		}
	});
}

/**
分页(layPage)
**/
function lay_page(userLabelId,totalpageno,className,listShowPageNum,curr){
	laypage({
		cont: document.getElementById("pager" + userLabelId),
		pages: totalpageno, //总页数
		//skin: '#CCC', //加载内置皮肤，也可以直接赋值16进制颜色值，如:#c00
		first: '<<',		//首页 如 1,
		last:'>>',			//末页 如 totalpageno,
		prev: '<',			//上一页 如'<', 
		next: '>',			//下一页 如'>',
		curr: curr, //当前页
		groups: listShowPageNum, //连续显示分页数"
		jump: function(obj,first){
			if(!first){
			document.cookie="beforeCUU="+obj.curr;
			document.cookie="userLabelId="+userLabelId;
			//console.log(document.cookie);
				var data={"pageno":obj.curr,"userLabelId": userLabelId,"className":className };
				$.ajax({
					url:"/inc/pageContent.asp",
					data:data,
					type:"POST",
					dataType:"html",
					cache:false,
					error:function(){
						layer.alert('服务器连接错误', {icon:2,zIndex : 2147483641,title : ['提示' , true],btn: ['确定']});
					},
					success:function(data){
						{$("#" + userLabelId).replaceWith(data);}
					}
				});
			}
		}
	});
}
/****************************************有翻译 End**************************************************************/

/****************交易类型产品图片展示**************************/
function tradeproImg(){
	function G(s){
		return document.getElementById(s);
	}

	function getStyle(obj, attr){
		if(obj.currentStyle){
			return obj.currentStyle[attr];
		}else{
			return getComputedStyle(obj, false)[attr];
		}
	}

	function Animate(obj, json){
		if(obj.timer){
			clearInterval(obj.timer);
		}
		obj.timer = setInterval(function(){
			for(var attr in json){
				var iCur = parseInt(getStyle(obj, attr));
				iCur = iCur ? iCur : 0;
				var iSpeed = (json[attr] - iCur) / 5;
				iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
				obj.style[attr] = iCur + iSpeed + 'px';
				if(iCur == json[attr]){
					clearInterval(obj.timer);
				}
			}
		}, 30);
	}
	var oPic = G("picBox");
	var oList = G("listBox");
	var oPrev = G("prev");
	var oNext = G("next");
	var oPicLi = oPic.getElementsByTagName("li");
	var oListLi = oList.getElementsByTagName("li");
	var len1 = oPicLi.length;
	var len2 = oListLi.length;
	var oPicUl = oPic.getElementsByTagName("ul")[0];
	var oListUl = oList.getElementsByTagName("ul")[0];
	var w1 = oPicLi[0].offsetWidth;
	var w2 = oListLi[0].offsetWidth;
	oPicUl.style.width = w1 * len1 + "px";
	oListUl.style.width = w2 * len2 + "px";
	var index = 0;
	var num = 9;
	var num2 = Math.ceil(num /2);
	function Change(){
		Animate(oPicUl, {left: - index * w1});
		if(index < num2){
			Animate(oListUl, {left: 0});
		}else if(index + num2 <= len2){
			Animate(oListUl, {left: - (index - num2 + 1) * w2});
		}else{
			Animate(oListUl, {left: - (len2 - num2) * w2});
		}
		for (var i = 0; i < len2; i++) {
			oListLi[i].className = "";
			if(i == index){
				oListLi[i].className = "on";
			}
		}
	}
	if($(".listBox li").length<=5){
			for (var i = 0; i < len2; i++) {
			oListLi[i].index = i;
			oListLi[i].onmouseover = function(){
				index = this.index;
				Change();
			}
		}
	}else{
		oNext.onclick = oNext.onclick = function(){
			index ++;
			index = index == len2 ? 0 : index;
			Change();
		}
		oPrev.onclick = oPrev.onclick = function(){
			index --;
			index = index == -1 ? len2 -1 : index;
			Change();
		}
	}
	 for (var i = 0; i < len2; i++) {
		oListLi[i].index = i;
		oListLi[i].onmouseover = function(){
			index = this.index;
			Change();
		}
	}
}
function closeLayer(e){
	e.parents('.layui-layer').remove();
	$("body").find(".layui-layer-shade").eq(1).remove();
}
//动画效果  vigro
function animatev(){
	$('.'+arguments[0]+arguments[1]).addClass(arguments[2]).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){$(this).removeClass(arguments[2])});
	$('.'+arguments[0]+arguments[1]).attr({'data-wow-duration':arguments[3]+'s','data-wow-delay':arguments[4]+'s','data-wow-offset':arguments[5],'data-wow-iteration':arguments[6]});
	$('.'+arguments[0]+arguments[1]).css({'animation-duration':arguments[7],'animation-delay':arguments[8],'animation-iteration-count':arguments[6],'animation-fill-mode':'both'})
	for(i in arguments){
	}
}
//计算通栏里面的left  vigro
function tlancv(){
	var screenWidth = $(window).width();
	var labelWidth = $("#" +arguments[0]).width();
	if (labelWidth == 0){labelWidth = screenWidth;}
	var halfScreenWidth = screenWidth/2;
	var bodyWidth = $(".fwtop,.fwmain,.fwbottom").width();
	var x1 = (screenWidth - bodyWidth)/2;
	var labelLeft = arguments[1];
	if(labelLeft.indexOf('%')<0){
		labelLeft = $("#" + arguments[0]).position().left;
	}else{labelLeft=$("#" + arguments[0]).parent().width()*labelLeft}
	var left=0;
	if(x1>0){
		left = x1 + labelLeft;
	}else{if(labelLeft<0){left = 0;}else{left = labelLeft;}}
	if ($("#" + arguments[0]).parent().hasClass("tLan"))
	{
		if (labelWidth == screenWidth)
		{
			$("#" + arguments[0]).css({"left":"0px"});
		}
		else
		{
			if (labelLeft == halfScreenWidth){$("#" + arguments[0]).css({"left":"50%"});}
			else if (labelLeft == 0){$("#" + arguments[0]).css({"left":"0"});}
			else{$("#" + arguments[0]).css({"left":left + "px"});}}
	}
}