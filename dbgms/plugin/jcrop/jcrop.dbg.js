dbgmsLoadCssJs("plugin/jcrop/jquery.Jcrop.js", "js");
function dbg_jcorp_create(imgurl, obj) {
	if (!imgurl) {
		return false;
	}
	/* 加载样式 */
	dbgmsLoadCssJs("plugin/jcrop/jcrop.dbg.css", "css");
	dbg_jcrop = "";
	dbg_jcrop += '<div class="dbg_jcrop_box">';
	dbg_jcrop += ' <div class="dbg_jcrop_box_left">';
	dbg_jcrop += '  <div class="row-fluid">';
	dbg_jcrop += '   <img src="' + imgurl + '" id="target" alt="Jcrop Image" />';
	dbg_jcrop += '   <div id="dbg_jcrop_img_thumb"><div class="preview-container"><img src="' + imgurl + '" class="jcrop-preview" alt="Preview" /></div>';
	dbg_jcrop += '  </div></div><div class="clearfix"></div>';
	dbg_jcrop += '  <div class="dbg_jcrop_box_use_wrap">';
	dbg_jcrop += '   <div class="dbg_jcrop_use_div"><span class="dbg_jcrop_box_use_title">&nbsp;&nbsp;比例：</span>';
	dbg_jcrop += '   <fieldset class="dbg_jcrop_box_use">';
	dbg_jcrop += '    <div class="btn-group" id="jcropuse">';
	dbg_jcrop += '    <button class="btn btn-small" data-use="ratio0">自由裁剪</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="ratio1">1:1</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="ratio64">6:4</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="ratio43">4:3</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="ratio34">3:4</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="ratioall">全选</button>';
	dbg_jcrop += '    <!--<button class="btn btn-small" data-use="ratiobye">Bye!</button>-->';
	dbg_jcrop += '   </div></fieldset></div>';
	dbg_jcrop += '   <div class="dbg_jcrop_use_div"><span class="dbg_jcrop_box_use_title">&nbsp;&nbsp;水印：</span>';
	dbg_jcrop += '   <fieldset class="dbg_jcrop_box_use">';
	dbg_jcrop += '    <div class="btn-group" id="watermark"><input type="hidden" id="dbg_jcrop_watermark" value=""/>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="none">无</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="min">小水印</button>';
	dbg_jcrop += '    <button class="btn btn-small" data-use="max">大水印</button>';
	dbg_jcrop += '   </div></fieldset></div>';
	dbg_jcrop += ' </div></div><!-- left end -->';
	dbg_jcrop += ' <div class="dbg_jcrop_box_right" style="padding-top:200px;">';
	dbg_jcrop += '  <form id="coords" class="coords" onsubmit="return false;" action="">';
	dbg_jcrop += '  <div class="inline-labels">';
	dbg_jcrop += '   <input type="hidden" size="4" id="x1" name="x1" />';
	dbg_jcrop += '   <input type="hidden" size="4" id="y1" name="y1" />';
	dbg_jcrop += '	 <input type="hidden" size="4" id="x2" name="x2" />';
	dbg_jcrop += '   <input type="hidden" size="4" id="y2" name="y2" />';
	
	dbg_jcrop += '   <div style="width:200px;height:50px;"><label style="line-height:30px; padding:10px 0;float:left;">宽 ：<input type="text" size="4" id="w" name="w" /></label>';
	dbg_jcrop += '   <label style="line-height:30px; padding:10px 0;margin-left:15px; float:left;">高： <input type="text" size="4" id="h" name="h" /></label></div><div class="clearfix"></div>';
	dbg_jcrop += '   缩略图：<select name="dbg_jcrop_thumb" id="dbg_jcrop_thumb" value="0">';
	dbg_jcrop += '		<option value="0_0">-------自由裁剪------</option>';
	dbg_jcrop += '		<option value="240_160">最佳尺寸 *6:4 </option>';
	dbg_jcrop += '		<option value="240_160">240_160|横幅缩略图</option>';
	dbg_jcrop += '		<option value="240_180">240_180|横幅缩略图</option>';
	dbg_jcrop += '		<option value="200_150">200_150|横幅小缩略图</option></select>';
	dbg_jcrop += '	 <div class="clearfix"></div>';
    dbg_jcrop += '	 <label style="line-height:30px; padding:10px 0;margin-left:15px; float:left;">裁剪宽： <input type="text" size="4" id="dbg_jcrop_thumb_w" name="dbg_jcrop_thumb_w" value="0"/></label>';
	dbg_jcrop += '	 <div class="clearfix"></div>';
	dbg_jcrop += '  <div style="width:200px;height:70px;">';
	dbg_jcrop += '   <button class="dbg_jcrop_btn_apply">确定裁剪</button>&nbsp;&nbsp;&nbsp; ';
	dbg_jcrop += '    <button class="dbg_jcrop_btn_cancel">取消操作</button>';
	dbg_jcrop += '  </div>';
	dbg_jcrop += '  </div>';
	dbg_jcrop += '  </form>';
	dbg_jcrop += '</div><div class="clearfix"></div><!-- right end -->';
	dbg_jcrop += '</div><!-- box end -->';
	// $('#row').append(dbg_jcrop);
	msgbox.box('dbg-裁剪功能', {
		width : 900,
		height : 450,
		showtype : 'none'
	});
	msgbox.msg(dbg_jcrop);
	/* 关闭 */
	close_btn = $('.dbg_jcrop_btn_cancel');
	close_btn.on('click', function() {
		msgbox.close();
	});

	// 140_90|横幅小缩略图,
	// 140_75|横幅小缩略图,
	// 160_100|横幅小缩略图,
	// 120_160|海报式竖幅图

	jQuery(function($) {
		/* 创建变量（在这个范围内）以保持原料药和图像大小 */
		var jcrop_api, boundx, boundy,
		/* 抓取预览窗格中的一些信息 */
		$preview = $('#dbg_jcrop_img_thumb');
		$pcnt = $('#dbg_jcrop_img_thumb .preview-container');
		$pimg = $('#dbg_jcrop_img_thumb .preview-container img');
		xsize = $pcnt.width(), ysize = $pcnt.height();
		$('#target').Jcrop({
			allowSelect : false,/* 允许新选框,默认 true */
			allowMove : true,/* 允许选框移动,默认 true */
			allowResize : true,/* 允许选框缩放,默认 true */
			onChange : updatePreview,/* 允许选框移动 */
			boxWidth : 580,
			boxHeight : 300,
			onSelect : updatePreview,
			aspectRatio : 0,
			keySupport : true,
			minSize : [ 10, 10 ],
			bgFade : true,
			bgOpacity : .5,
			setSelect : [ 20, 20, 210, 150 ],
		}, function() {
			/* 使用原料药来获得真正的图像大小 */
			var bounds = this.getBounds();
			boundx = bounds[0];
			boundy = bounds[1];
			/* 存储API在jcrop_api变量 */
			jcrop_api = this;
			jcrop_api.ui.selection.addClass('jcrop-selection');
			/* 移动预览到CSS定位的Jcrop实现对集装箱 */
			$preview.appendTo(jcrop_api.ui.holder);
		});
		$('#coords').on('change', 'input', function(e) {
			var x1 = $('#x1').val(), x2 = $('#x2').val();
			var y1 = $('#y1').val(), y2 = $('#y2').val();
			var w = $('#w').val(), h = $('#h').val();
			x2 = parseInt(x1) + parseInt(w);
			y2 = parseInt(y1) + parseInt(h);
			jcrop_api.setSelect([ x1, y1, x2, y2 ]);
		});
		/* 简单的事件处理程序，从变化和onselect ,事件处理程序，按照上面的Jcrop实现对调用 */
		function updatePreview(c) {
			if (parseInt(c.w) > 0) {
				var rx = xsize / c.w;
				var ry = ysize / c.h;
				$pimg.css({
					width : Math.round(rx * boundx) + 'px',
					height : Math.round(ry * boundy) + 'px',
					marginLeft : '-' + Math.round(rx * c.x) + 'px',
					marginTop : '-' + Math.round(ry * c.y) + 'px'
				});
			}
			$('#x1').val(c.x.toFixed(2));
			$('#y1').val(c.y.toFixed(2));
			$('#x2').val(c.x2.toFixed(2));
			$('#y2').val(c.y2.toFixed(2));
			$('#w').val(c.w.toFixed(2));
			$('#h').val(c.h.toFixed(2));
		}
		submit_btn = $('#coords').find('.dbg_jcrop_btn_apply');
		submit_btn.on('click', function(e) {
			c = jcrop_api.tellSelect();
			c.thumb = $('#dbg_jcrop_thumb').val();
			c.watermark = $('#dbg_jcrop_watermark').val();
			c.thumb_w = $('#dbg_jcrop_thumb_w').val();
			msgbox.close();
			obj.callback(c);
			$('#row').find('.dbg_jcrop_box').remove();
			$('#row').html('');
		});
		$('#jcropuse').on('click', 'button', function(e) {
			/* 防止链接打开 URL */
			e.preventDefault();
			var $t = $(this), $g = $t.closest('.btn-group');
			$g.find('button.active').removeClass('active');
			$t.addClass('active');
			$g.find('[data-use]').each(function() {
				var $th = $(this), c = $th.data('use'), a = $th.hasClass('active');
				if (a) {
					switch (c) {
					case 'ratio0':
						jcrop_api.animateTo([ 50, 50, 382, 284 ]);
						jcrop_api.setOptions({
							aspectRatio : 0
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 220,
							height : 220
						});
						return false;
						break;
					case 'ratio1':
						jcrop_api.animateTo([ 50, 50, 300, 300 ]);
						jcrop_api.setOptions({
							aspectRatio : 1
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 240,
							height : 240
						});
						return false;
						break;
					case 'ratio64':
						jcrop_api.animateTo([ 50, 50, 440, 310 ]);
						jcrop_api.setOptions({
							aspectRatio : (6 / 4)
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 240,
							height : 160
						});
						return false;
						break;
					case 'ratio43':
						jcrop_api.animateTo([ 50, 50, 450, 350 ]);
						jcrop_api.setOptions({
							aspectRatio : (4 / 3)
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 240,
							height : 180
						});
						return false;
						break;
					case 'ratio34':
						jcrop_api.animateTo([ 50, 10, 300, 330 ]);
						jcrop_api.setOptions({
							aspectRatio : (3 / 4)
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 180,
							height : 240
						});
						return false;
						break;
					case 'ratioall':
						jcrop_api.animateTo([ 0, 0, boundx, boundy ]);
						jcrop_api.setOptions({
							aspectRatio : (0)
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 240,
							height : 180
						});
						return false;
						break;
					case 'ratiobye':
						jcrop_api.animateTo([ 300, 200, 300, 200 ], function() {
							this.release();
						});
						$('#dbg_jcrop_img_thumb > .preview-container').css({
							width : 220,
							height : 220
						});
						return false;
						break;
					}
				} else {
					jcrop_api.ui.holder.removeClass(c);
				}
				;
			});
		});
		$('#watermark').on('click', 'button', function(e) {
			/* 防止链接打开 URL */
			e.preventDefault();
			var $t = $(this), $g = $t.closest('.btn-group');
			$g.find('button.active').removeClass('active');
			$t.addClass('active');
			$g.find('[data-use]').each(function() {
				var $th = $(this), c = $th.data('use'), a = $th.hasClass('active');
				if (a) {
					switch (c) {
					case 'none':
						$('#dbg_jcrop_watermark').val('none');
						break;
					case 'min':
						$('#dbg_jcrop_watermark').val('min');
						break;
					case 'max':
						$('#dbg_jcrop_watermark').val('max');
						break;
					}
				} else {
					jcrop_api.ui.holder.removeClass(c);
				}
			});
		});
		$('#jcropuse .btn:first,#watermark .btn:first').addClass('active');
		console.log(11);
	});
	$('.jcrop-holder').css({
		'width' : 580,
		'height' : 300,
		'background-color' : '#999'
	});
}

/**
 * 图片按比例自适应缩放
 * 
 * @param img
 *            {Element} 用户上传的图片
 * @param maxWidth
 *            {Number} 预览区域的最大宽度
 * @param maxHeight
 *            {Number} 预览区域的最大高度
 */
// /* 修改图片大小 */使用方法
// window.onload = function() {
// changeImgSize();
function changeImgSize() {
	// <style type="text/css">.sy_pic {width: 600px;height: 450px;border: #000
	// solid 1px;text-align: center;}</style>
	// <div class="dbg_jcrop_box">
	// <div class="dbg_jcrop_box_left">
	// <div class="sy_pic" id="imgcontainer">
	// <img id="target"src="' + imgurl + '" />
	// </div>
	var getContainer = document.getElementById('imgcontainer');
	var getIMG = getContainer.getElementsByTagName('img')[0];
	var fw = getContainer.offsetWidth - (2 * getContainer.clientLeft);
	var fh = getContainer.offsetHeight - (2 * getContainer.clientTop);
	var iw = getIMG.width;
	var ih = getIMG.height;
	var m = iw / fw;
	var n = ih / fh;
	if (m >= 1 && n <= 1) {
		iw = Math.ceil(iw / m);
		ih = Math.ceil(ih / m);
		getIMG.width = iw;
		getIMG.height = ih;
	} else if (m <= 1 && n >= 1) {
		iw = Math.ceil(iw / n);
		ih = Math.ceil(ih / n);
		getIMG.width = iw;
		getIMG.height = ih;
	} else if (m >= 1 && n >= 1) {
		getMAX = Math.max(m, n);
		iw = Math.ceil(iw / getMAX);
		ih = Math.ceil(ih / getMAX);
		getIMG.width = iw;
		getIMG.height = ih;
	}
	if (getIMG.height < fh) {
		var getDistance = Math.floor((fh - getIMG.height) / 2);
		getIMG.style.marginTop = getDistance.toString() + "px";
	}

}
function AutoResizeImage(maxWidth, maxHeight, objImg) {
	// <div style="width: 500px; height: 500px; text-align: center; background:
	// #000 no-repeat center 100%; border: 1px solid #c3c3c3;">
	// <img src="file/content/144904022790388.png" border="0" width="0"
	// height="0" onload="AutoResizeImage(500,500,this)" alt="534 X 800" />
	// </div>
	var img = new Image();
	img.src = objImg.src;
	var hRatio;
	var wRatio;
	var Ratio = 1;
	var w = img.width;
	var h = img.height;
	wRatio = maxWidth / w;
	hRatio = maxHeight / h;
	if (maxWidth == 0 && maxHeight == 0) {
		Ratio = 1;
	} else if (maxWidth == 0) {//
		if (hRatio < 1)
			Ratio = hRatio;
	} else if (maxHeight == 0) {
		if (wRatio < 1)
			Ratio = wRatio;
	} else if (wRatio < 1 || hRatio < 1) {
		Ratio = (wRatio <= hRatio ? wRatio : hRatio);
	}

	if (Ratio < 1) {
		w = w * Ratio;
		h = h * Ratio;
	}
	objImg.height = h;
	objImg.width = w;
}
