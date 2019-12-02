<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 单个字段的 参数 $field
function dbg_diyfield_load_city($field, $value)
{
	// $sql = "";
	// $sql = "SELECT hcity.id,hcity.name FROM db_city AS hcity WHERE hcity.level=1 ";
	// $result = $this->db->query ( $sql );
	// $city_1 = $result->result ();
	$value = trim ( $value );
	$value = str_replace ( ',', ',', $value );
	$value = str_replace ( '，', ',', $value );
	$field['value'] = explode ( ",", $value );
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_city($field, $value)
{
	$value = join ( ',', $value );
	$value = trim ( $value );
	return $value;
}
// 解析处理
function dbg_diyfield_parse_city($field, $value)
{
	if(! empty ( $value ))
	{
		$value = str_replace ( ',', ',', $value );
		$value = str_replace ( '，', ',', $value );
		$value_explode = explode ( ",", $value );
		$parse_result = array();
		$parse_result['sheng'] = trim ( $value_explode[0] );
		$parse_result['shi'] = trim ( $value_explode[1] );
		$parse_result['qu'] = trim ( $value_explode[2] );
		$parse_result['address'] = "省" . $parse_result['sheng'] . " - 市" . $parse_result['shi'] . " - 县/区" . $parse_result['qu'];
	}
	else
	{
		$parse_result = '';
	}
	
	return $parse_result;
}