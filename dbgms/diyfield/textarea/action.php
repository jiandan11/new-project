<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
function dbg_diyfield_load_textarea($field, $value)
{
	// $content = str_replace ( "<p>", "", $arr [$val ['field']] );
	// $content = str_replace ( "</p>", "\n", $content );
	$field['value'] = $value;
	include 'form.php';
	unset ( $field );
}
function dbg_diyfield_input_textarea($field, $value)
{
	// $content1 = $this->input->get_post ( $val ['field'] ); // 内容
	// $content2 = explode ( "\n", $content1 );
	// $content3 = "";
	// foreach($content2 as $value){
	// // 去除空格
	// // $qian = array (
	// // " ","　","\t","\n","\r"
	// // );
	// // $hou = array (
	// // "","","","",""
	// // );
	// // $value = str_replace ( $qian, $hou, $value );
	
	// // if ( ! empty ( $value ) && $value != "" && $value != null) {
	// // $field ['name'] = $value;
	// // $sql = getsql_table ( '{db}tagdict', $field, '' );
	// // // echo $sql."<br/>";
	// // $msql->execquery ( $sql );
	// // }
	// $content3 .= '<p>' . $value . '</p>';
	// }
	// // $content = str_replace ( "\n", "</p><p>", $content );
	// // $content = "<p>" . $content;
	// // 入库处理
	// $diy_field_put_db = "";
	// $diy_field_put_db = trim ( $content3 ); // 内容
	// 入库处理
	return $value;
}
// 解析处理
function dbg_diyfield_parse_textarea($field, $value)
{
	$parse_result = $value;
	return $parse_result;
}

