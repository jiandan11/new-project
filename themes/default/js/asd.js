function dbgmsDisable(disableSign, disableVal) {
	if (confirm('确定要切换【' + disableSign + '】系统模块 状态吗？')) {
		$.ajax({
			url : ajaxurl + '&act=disable&val=' + disableVal + '&sign=' + disableSign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					location.href = ajaxurl;
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}