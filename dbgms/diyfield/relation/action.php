<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 单个字段的 参数 $field
function dbg_diyfield_load_relation($field, $value)
{
	
	// $diyfields[$k]['value'] = $arr[$val['field']];
	// $model = $this->db->query ( "SELECT * FROM dbg_model WHERE id=" . $diyfields[$k]['relationid'] )->result_array ();
	// if(! empty ( $arr[$val['field']] ))
	// {
	// $text = $this->db->query ( "SELECT title FROM {$model[0]['table']} WHERE id=" . $arr[$val['field']] )->result_array ();
	// $diyfields[$k]['valuetext'] = $text;
	// }
	// $diy['diy_field'] = $diyfields[$k];
	if(empty ( $value ))
	{
		$value = 0;
	}
	$field['value'] = $value;
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_relation($field, $value)
{
	if(empty ( $value ))
	{ // 为空的话,处理方式
		$value = NULL;
	}
	return $value;
}
// 解析处理
function dbg_diyfield_parse_relation($field, $value)
{
	$parse_result = $value;
	return $parse_result;
}