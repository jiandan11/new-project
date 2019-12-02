<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}

// 单个字段的 参数 $field
function dbg_diyfield_load_radio($field, $value)
{
	$field['value'] = $value;
	$radio_arr = array();
	$radio_arr = explode ( "\n", $field['param'] );
	foreach($radio_arr as $val)
	{
		$row = array();
		$row_new = array();
		$row_new = explode ( "|", $val );
		$row['value'] = trim ( $row_new[0] );
		$row['name'] = trim ( $row_new[1] );
		$field['radio_arr'][] = $row;
	}
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_radio($field, $value)
{
	return $value;
}
// 解析处理
function dbg_diyfield_parse_radio($field, $value)
{
	$parse_result = array();
	if($value == 0)
	{
		$parse_result = '无';
	}
	else
	{
		$_arr = array();
		$_arr = explode ( "\n", $field['param'] );
		foreach($_arr as $val)
		{
			$row_new = array();
			$row_new = explode ( "|", $val );
			if($row_new[0] == $value)
			{
				$parse_result = trim ( $row_new[1] );
			}
		}
	}
	return $parse_result;
}