function setmodel(value, id, siteid, q) {
	$("#typeid").val(value);
	$("#search a").removeClass();
	id.addClass('on');
	if (q != null && q != '') {
		window.location = '?keyword=' + q;
	}
}