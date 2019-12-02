//提交表单
function saveform(url) {
	$("#form").Validform({
		ajaxPost : true,
		postonce : true,
		tiptype : function(msg, o, cssctl) {
			if (!o.obj.is("form")) {
				var objtip = o.obj.siblings(".Validform_checktip");
				cssctl(objtip, o.type);
				objtip.text(msg);
			} else {
				var objtip = o.obj.find("#tip");
				cssctl(objtip, o.type);
				if (o.type == 2) {
					if (url) {
						objtip.text(msg);
						art.dialog.through({
							content : msg,
							lock : true,
							icon : 'warning',
							button : [ {
								name : '返回列表',
								callback : function() {
									window.location.href = url;
								},
								focus : true
							}, {
								name : '继续操作',
								callback : function() {
									window.location.reload();
								}
							} ]
						});
					} else {
						objtip.text(msg + ' 3秒后刷新本页面');
						window.setTimeout(function() {
							window.location.reload();
						}, 3000);
					}
				} else {
					objtip.text(msg);
				}
			}
		}
	});
	$("#reset").click(function() {
		window.location.reload();
	});
}

// tabs菜单
function tabs() {
	$("#tabs").idTabs({
		selected : 'z-crt'
	});
}

// ajax提交含有确认提示
function ajaxpost(config) {
	art.dialog.through({
		content : config.name,
		lock : false,
		icon : 'warning',
		button : [ {
			name : '确认操作',
			callback : function() {
				$.ajax({
					type : 'POST',
					url : config.url,
					data : config.data,
					dataType : 'json',
					success : function(json) {
						if (config.tip) {
							art.dialog.tips(json.info, 3);
						}
						if (json.status == 'y') {
							if (typeof config.success == "function") {
								config.success(json.message);
							}
						} else {
							if (typeof config.failure == "function") {
								config.failure(json.message);
							}
						}
					}
				});
			},
			focus : true
		}, {
			name : '取消',
			callback : function() {
				if (typeof config.cancel == "function") {
					config.cancel();
				}
			}
		} ]
	});

}
// 弹出框
function urldialog(config) {
	if (!config.width) {
		config.width = 640;
	}
	art.dialog.open(config.url, {
		title : config.title,
		width : config.width,
		height : config.height
	});
}