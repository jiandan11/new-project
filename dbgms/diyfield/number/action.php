<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}

// 单个字段的 参数 $field
function dbg_diyfield_load_number($field, $value)
{
	$field['value'] = $value;
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_number($field, $value)
{
	if(! empty ( $value ))
	{
		if(! is_numeric ( $value ))
		{
			echo '请填写有效的 ' . $field['name'];
			exit ();
		}
	}
	$value = trim ( $value );
	return $value;
}
// 解析处理
function dbg_diyfield_parse_number($field, $value)
{
	$parse_result = $value;
	return $parse_result;
}