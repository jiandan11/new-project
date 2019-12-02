<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
function dbg_diyfield_load_music($field, $value)
{
	$field['value'] = $value;
	include 'form.php';
	unset ( $field );
}
function dbg_diyfield_input_music($field, $value)
{
	// 入库处理
	return $value;
}
// 解析处理
function dbg_diyfield_parse_music($field, $value)
{
	$parse_result = $value;
	return $parse_result;
}