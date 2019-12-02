$(document).ready(function() {
	// window.parent.location.reload() 父类刷新
	// window.parent.location.href= " ";
	// 复选框选中的时候，修改其他元素的值 $(document).ready(function(){
	// $("input[type='checkbox']").on('change', function() {
	// if ($(this).is(':checked')) {
	// alert($(this).next("input").attr('value'));
	// alert($(this).next("input").attr('value'));
	// }
	// });
	/* 键盘事件 */
	// $(document).keyup(function(event){if(event.keyCode==13){$("#keyenter").trigger("click");return
	// false;}});
	/*
	 * 复选框选中的时候，修改其他元素的值 $(document).ready(function(){
	 * $("input[type='checkbox']").change(function() {
	 * if($(this).is(':checked')){ alert($(this).next("input").attr('value'));
	 * alert($(this).next("input").attr('value')); } }); });
	 */
});

function now() {
	return new Date().getTime();
}
function dbgmsPause(msg) {
	msg = msg || '';
	if (msg != '') {
		$.msglayer(msg);
	} else {
		$.msglayer('接口还在加紧开发中，请海涵！');
	}

}

/* @action:dbgms常用数据 通用table tr删除删除 */
function dbgmsDelete(ajaxurl) {
	ajaxurl = ajaxurl || '';
	if (!confirm("确认删除？")) {
		window.event.returnValue = false;
	} else {
		$.ajax({
			url : ajaxurl,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$('#tr' + result.id).toggle('normal');
				} else if (result.StatusCode == 404) {
					$.msglayer(result.msg);
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}

/* @action:dbgms常用操作 */
function dbgmsOperate(ajaxurl) {
	ajaxurl = ajaxurl || '';
	if (!confirm("确认此操作？")) {
		window.event.returnValue = false;
	} else {
		$.ajax({
			url : ajaxurl,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$('#tr' + result.id).toggle('normal');
				} else if (result.StatusCode == 404) {
					$.msglayer(result.msg);
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}

/* @action:内容更新或者提交 \更新内容 */
function dbgmsUpdate(form, ajaxurl, jumpurl) {
	form = form || '';
	ajaxurl = ajaxurl || '';
	jumpurl = jumpurl || '';
	$.ajax({
		url : ajaxurl,
		type : "POST",
		async : false,
		data : $('#' + form).serialize(),
		success : function(result) {
			if (result == 1) {
				alert("成功!");
				if (jumpurl != '') {
					location.href = jumpurl;
				} else {
					location.href = ajaxurl;
				}
				return;
			} else {
				$.msglayer(result);
			}
		}
	});
}
// @action: 选中和取消选中*/
function dbgmsCheckAll(o, n) {
	o = o || 'ids[]';
	n = n || 0;
	var i, str = document.getElementsByName(o), len = str.length, chestr = '';
	for (i = 0; i < len; i++) {
		if (n == 1) {
			if (str[i].checked) {
				chestr += (chestr == '' ? '' : ',') + str[i].value;
			}
		} else {
			if (str[i].checked) {
				str[i].checked = false;
			} else {
				str[i].checked = true;
			}
		}
	}
	return chestr;
}
/* @action: 复选框的选择与获取值 */
function dbgmsCheckGet(o) {
	return dbgmsCheckAll(o, 1);
}

// function upcache(id) {
// $.post('index.php?tn=m_catlog&ac=upcache&h=' + now(), function() {
// adminmsg("成功更新栏目缓存");
// });
// if (!confirm("确认更新所有缓存？")) {
// window.event.returnValue = false;
// } else {
// alert("ok");
// $.ajax({
// url : "",
// type : 'POST',
// async : false,
// dataType : 'json',
// success : function(result) {
// if (result.sql == 1) {
// $('#tr' + result.id).toggle('normal');
// }
// if (result.sql == 33) {
// alert('删除失败，没有权限');
// }
// }
// });
// }
// }

/* @action: 更新缓存 */
function dbgjs_upcache(ajaxurl) {
	ajaxurl = ajaxurl || '';
	$.ajax({
		url : ajaxurl + '&act=upcache',
		type : 'POST',
		async : false,
		success : function(result) {
			if (result == 1) {
				alert("成功!");
				location.href = ajaxurl;
				return;
			} else {
				alert(result);
			}
		}
	});
}
/* 启用或者禁用 */
function open_close(ajaxurl, id, val) {
	$.ajax({
		url : ajaxurl + "&act=open_close&id=" + id + "&disable=" + val,
		type : 'POST',
		async : false,
		success : function(result) {
			if (result == 1) {
				location.href = ajaxurl;
				return;
			} else {
				alert(result);
			}
		}
	});
}
function GetProvince(id, OBJ, selected) {
	var str = '';
	// 移除子级
	$("#" + OBJ + " > *").remove();
	jQuery.ajax({
		type : 'POST',
		url : commURI + '/GetAreaProvince',
		data : 'sid=' + id,
		dataType : 'json',
		success : function(Response) {
			$("#" + OBJ).append('<option value="0">请选择</option>');
			for (var i = 0; i < Response.length; i++) {
				if (typeof (selected) != 'undefined' && Response[i].id == selected) {
					str = '<option value="' + Response[i].id + '" selected>' + Response[i].title + '</option>';
				} else {
					str = '<option value="' + Response[i].id + '">' + Response[i].title + '</option>';
				}
				$("#" + OBJ).append(str);
			}
		}
	});
}
function form_ajaxForm() {
	$(document).ready(function() {
		// var options = {
		// target 返回的结果将放到这个target下
		// url 如果定义了，将覆盖原form的action
		// type get和post两种方式
		// dataType 返回的数据类型，可选：json、xml、script
		// clearForm true，表示成功提交后清除所有表单字段值
		// resetForm true，表示成功提交后重置所有字段
		// iframe 如果设置，表示将使用iframe方式提交表单
		// beforeSerialize 数据序列化前：function($form,options){}
		// beforeSubmit 提交前：function(arr,$from,options){}
		// success 提交成功后：function(data,statusText){}
		// error 错误：function(data){alert(data.message);}
		// };
		$('#upload_form').ajaxForm({ // target : '#upMessage',
			url : "<?php echo base_url('dbgcms/music/sql/insert');?>",
			beforeSubmit : validateForm,
			type : "POST",
			dataType : "text",
			success : function(data) {
				/* 下面可以根据后台反馈的信息做相应的处理 */
			},
			resetForm : true
		});
	});
}
/* jquery-form , ajaxSubmit */
function dbgmsAjaxSubmit() {
	// document.getElementById('upload_submit1').click();
	$(document).ready(function() {
		var options = {
			url : "<?php echo base_url('dbgcms/music/sql/insert_oss');?>",// 后台的处理，也就是form里的action
			type : "POST",
			dataType : "text",
			beforeSend : function() {
				$('#upload_window22').show();
			},
			success : function(data) {
				if (data == "ok") {
					$('#upload_window22').hide();// 加载成功后隐藏loading
					// $('#upload-load-image').remove();//移除
					// $('#upload-load-image').empty();//删除所有子节点
					// $('#upload_window22').html(data);
					alert('上传成功！');
					location.href = '<?php echo base_url("dbgcms/music");?>';
				} else if (data == "no") {
					alert('插入数据错误！');
				} else if (data == "category") {
					alert('用户权限不够,请联系管理员！');
					location.href = '<?php echo base_url("dbgcms/music");?>';
					return;
				}
			}
		};
		$('#upload_form').submit(function() {
			$(this).ajaxSubmit(options);
			/* ！重要的！---总是返回false，以防止标准的浏览器提交和页面导航 ,为了防止刷新 */
			return false;
		});

	});
}
function form_ajaxForm() {
	$(document).ready(function() {
		// var options = {
		// target 返回的结果将放到这个target下
		// url 如果定义了，将覆盖原form的action
		// type get和post两种方式
		// dataType 返回的数据类型，可选：json、xml、script
		// clearForm true，表示成功提交后清除所有表单字段值
		// resetForm true，表示成功提交后重置所有字段
		// iframe 如果设置，表示将使用iframe方式提交表单
		// beforeSerialize 数据序列化前：function($form,options){}
		// beforeSubmit 提交前：function(arr,$from,options){}
		// success 提交成功后：function(data,statusText){}
		// error 错误：function(data){alert(data.message);}
		// };
		$('#upload_form').ajaxForm({ // target : '#upMessage',
			url : "<?php echo base_url('dbgcms/music/sql/insert');?>",
			beforeSubmit : validateForm,
			type : "POST",
			dataType : "text",
			success : function(data) {
				// 下面可以根据后台反馈的信息做相应的处理
			},
			resetForm : true
		});
	});
}

/* 加载js和css */
function dbgmsLoadCssJs(filename, filetype) {
	if (isInclude(filename) == true) {
		return false;
	}
	if (filetype == "js") { /* 判断文件类型 */
		var fileref = document.createElement('script')/* 创建标签 */
		fileref.setAttribute("type", "text/javascript")/* 定义属性type的值为text/javascript */
		fileref.setAttribute("src", dbgms_root + filename)/* 文件的地址 */
	} else if (filetype == "css") { /* 判断文件类型 */
		var fileref = document.createElement("link")
		fileref.setAttribute("rel", "stylesheet")
		fileref.setAttribute("type", "text/css")
		fileref.setAttribute("href", dbgms_root + filename)
	}
	if (typeof fileref != "undefined")
		document.getElementsByTagName("head")[0].appendChild(fileref)
}
/* 判断文件是否存在 */
function isInclude(name) {
	var js = /js$/i.test(name);
	var es = document.getElementsByTagName(js ? 'script' : 'link');
	for (var i = 0; i < es.length; i++)
		if (es[i][js ? 'src' : 'href'].indexOf(name) != -1)
			return true;
	return false;
}
/* 获取当前路径 */
(function(exports) {
	var doc = exports.document, a = {};
	var expose = +new Date(), rExtractUri = /((?:http|https|file):\/\/.*?\/[^:]+)(?::\d+)?:\d+/;
	var isLtIE8 = ('' + doc.querySelector).indexOf('[native code]') === -1;
	exports.getCurrAbsPath = function() {
		/* FF,Chrome */
		if (doc.currentScript) {
			console.log(doc.currentScript.src);
			return doc.currentScript.src;
		}
		var stack;
		try {
			a.b();
		} catch (e) {
			stack = e.fileName || e.sourceURL || e.stack || e.stacktrace;
		}
		/* IE10 */
		if (stack) {
			var absPath = rExtractUri.exec(stack)[1];
			if (absPath) {
				return absPath;
			}
		}
		/* IE5-9 */
		for (var scripts = doc.scripts, i = scripts.length - 1, script; script = scripts[i--];) {
			if (script.className !== expose && script.readyState === 'interactive') {
				script.className = expose;
				/*
				 * if less than ie 8, must get abs path by getAttribute(src,4)
				 */
				return isLtIE8 ? script.getAttribute('src', 4) : script.src;
			}
		}
	};
}(window));

/*
 * JavaScript获取当前根目录 主要用到Location 对象，包含有关当前 URL 的信息,是 Window 对象的一个部分，可通过
 * window.location 属性来访问。 方法一
 * (window.document.location.href/window.document.location.pathname)
 */
function getRootPath_web() {
	// 获取当前网址，如： http://localhost:8083/uimcardprj/share/meun.jsp
	var curWwwPath = window.document.location.href;

	// 获取主机地址之后的目录，如： uimcardprj/share/meun.jsp
	var pathName = window.document.location.pathname;
	var pos = curWwwPath.indexOf(pathName);

	// 获取主机地址，如： http://localhost:8083
	var localhostPaht = curWwwPath.substring(0, pos);
	// 获取带"/"的项目名，如：/uimcardprj
	var projectName = pathName.substring(0, pathName.substr(1).indexOf('/') + 1);
	return (localhostPaht + projectName);
}
/* 方法二(window.location.pathname/window.location.protocol/window.location.host) */
function getRootPath_dc() {
	var pathName = window.location.pathname.substring(1);
	var webName = pathName == '' ? '' : pathName.substring(0, pathName.indexOf('/'));
	if (webName == "") {
		return window.location.protocol + '//' + window.location.host;
	} else {
		return window.location.protocol + '//' + window.location.host + '/' + webName;
	}
}