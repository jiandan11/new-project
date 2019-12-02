<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 单个字段的 参数 $field
function dbg_diyfield_load_file($field, $value)
{
	$field['value'] = $value;
	$field['formfield'] = str_replace ( '[', '', $field['field'] );
	$field['formfield'] = str_replace ( ']', '', $field['formfield'] );
	if(empty ( $field['path'] ))
	{
		$field['path'] = 'tmp';
	}
	if(empty ( $field['form'] ))
	{
		$field['form'] = 'DbgMsFormEdit';
	}
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_file($field, $value)
{
	if(empty ( $value ))
	{
		// 为空的话,处理方式
		$value = '/default/style1.jpg';
	}
	return $value;
}
// 解析处理
function dbg_diyfield_parse_file($field, $value)
{
	$parse_result = DBG_FILEURL . $value;
	$parse_result = str_replace ( "file//", "file/", $parse_result );
	$parse_result = str_replace ( "file//", "file/", $parse_result );
	// $content_row[$diykey] = trim ( $content_row[$diykey] );
	// if(! preg_match ( '|^http://|', $content_row[$diykey] ))
	// { // 如果不能匹配
	// $content_row[$diykey]= str_replace ( "//", "/", $content_row[$diykey] );
	// }
	return $parse_result;
}
