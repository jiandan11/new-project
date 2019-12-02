<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 单个字段的 参数 $field
function dbg_diyfield_load_swfupload($field, $value)
{
	$field['value'] = unserialize ( $value );
	if(empty ( $field['path'] ))
	{
		$field['path'] = 'tmp';
	}
	if(DBG_URLSAVECACHE == 0)
	{
		$url = base_url ();
		$url = str_replace ( 'dbgms/', '', $url );
		$field['fileurl'] = $url . 'file'; // 返回给SWF AND JQUERY ,保存的名字 image地址
	}
	else
	{
		$field['fileurl'] = DBG_FILEURL; // 返回给SWF AND JQUERY ,保存的名字 image地址
	}
	include 'form.php';
	unset ( $field );
}
// 入库处理
function dbg_diyfield_input_swfupload($field, $value)
{
	// 入库处理
	$imgs_url = $_POST[$field['field'] . '_img']; // 图集连接和名字
	$imgs_msg = $_POST[$field['field'] . '_msg']; // 描述
	if(! empty ( $imgs_url ))
	{
		$swfupload = array();
		for($k = 0;$k < count ( $imgs_url );$k ++)
		{
			$row = array();
			$row['url'] = $imgs_url[$k];
			$row['msg'] = $imgs_msg[$k];
			$swfupload[] = $row;
		}
		$value = serialize ( $swfupload ); // 转序列化
	}
	if(empty ( $value ))
	{ // 为空的话,处理方式
		$value = NULL;
	}
	return $value;
}
// 解析处理
function dbg_diyfield_parse_swfupload($field, $value)
{
	$swfupload = unserialize ( $value );
	$parse_result = array();
	foreach($swfupload as $key=>$val)
	{
		$imgs = array();
		$imgs['url'] = DBG_FILEURL . $val['url'];
		$imgs['url'] = str_replace ( "file///", "file/", $imgs['url'] );
		$imgs['url'] = str_replace ( "file//", "file/", $imgs['url'] );
		$imgs['msg'] = $val['msg'];
		$parse_result[] = $imgs;
	}
	return $parse_result;
}