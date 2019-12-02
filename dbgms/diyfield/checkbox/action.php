<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}

// 单个字段的 参数 $field
function dbg_diyfield_load_checkbox($field, $value)
{
	$value = trim ( $value );
	$value = str_replace ( ',', ',', $value );
	$value = str_replace ( '，', ',', $value );
	$field['value'] = explode ( ",", $value );
	$_arr = array();
	$_arr = explode ( "\n", $field['param'] );
	foreach($_arr as $val)
	{
		$row = array();
		$row_new = array();
		$row_new = explode ( "|", $val );
		$row['value'] = trim ( $row_new[0] );
		$row['name'] = trim ( $row_new[1] );
		$field['_arr'][] = $row;
	}
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_checkbox($field, $value)
{
	$value = join ( ',', $value );
	$value = trim ( $value );
	return $value;
}
// 解析处理
function dbg_diyfield_parse_checkbox($field, $value)
{
	if(! empty ( $value ))
	{
		$value_explode = explode ( ",", $value );
		$parse_result = array();
		$_arr = array();
		$_arr = explode ( "\n", $field['param'] );
		foreach($_arr as $val)
		{
			$row_new = array();
			$row_new = explode ( "|", $val );
			if(in_array ( $row_new[0], $value_explode ))
			{
				$parse_result[] = trim ( $row_new[1] );
			}
		}
	}
	else
	{
		$parse_result = '';
	}
	return $parse_result;
}