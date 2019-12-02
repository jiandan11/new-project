<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
function dbg_diyfield_load_ueditor($field, $value)
{
	// $content = str_replace ( "<p>", "", $arr [$val ['field']] );
	// $content = str_replace ( "</p>", "\n", $content );
	$field['value'] = $value;
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_ueditor($field, $value)
{
	return $value;
}
// 解析处理
function dbg_diyfield_parse_ueditor($field, $value)
{
	$parse_result = $value;
	return $parse_result;
}
