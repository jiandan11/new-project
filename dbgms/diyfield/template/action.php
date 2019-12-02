<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 单个字段的 参数 $field
function dbg_diyfield_load_template($field, $value)
{
	$field['value'] = $value;
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_template($field, $value)
{
	if(empty ( $value ))
	{ // 为空的话,处理方式
		$value = NULL;
	}
	return $value;
}
// 解析处理
function dbg_diyfield_parse_template($field, $value)
{
	$parse_result = $value;
	return $parse_result;
}