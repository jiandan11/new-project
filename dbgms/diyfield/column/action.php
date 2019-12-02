<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 输出表单
function dbg_diyfield_load_column($field, $value)
{
	$field['value'] = $value['columnid'];
	if(! empty ( $value['param'] ))
	{
		$field['param'] = json_encode ( $value['param'] );
	}
	// 1.1 先加载文件,查询文件是存在查询文件
	if(! file_exists ( DBG_DATA . 'cache.column.php' ))
	{
		echo "导航栏目解析缓存文件不存在,请后台更新缓存!";
		exit ();
	}
	$columnlist = include DBG_DATA . 'cache.column.php';
	$result = array();
	foreach($columnlist as $val)
	{
		if($val['model'] == $field['id'] && $val['column'] == 0)
		{
			$column_arr[] = $val;
		}
	}
	
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_column($field, $value)
{
	if(empty ( $value ))
	{
		$value = 1;
	}
	return $value;
}
