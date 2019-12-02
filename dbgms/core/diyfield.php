<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
/*
 * 本文件为重点
 */
function dbg_diyfield($act = NULL, $name, $field = array(), $data = array())
{
	// 加载操作函数
	if(file_exists ( _DBGMS_DIYFIELD_ . $name . '/action.php' ))
	{
		require_once _DBGMS_DIYFIELD_ . $name . '/action.php';
		if($act == 'load')
		{
			$diyfunction = 'dbg_diyfield_load_' . $name . '';
			$result = call_user_func_array ( $diyfunction, array(
					$field,
					$data 
			) );
			return $result;
		}
		elseif($act == 'update')
		{
			$diyfunction = 'dbg_diyfield_input_' . $name . '';
			$result = call_user_func_array ( $diyfunction, array(
					$field,
					$data 
			) );
			return $result;
		}
		elseif($act == 'parse')
		{
			$diyfunction = 'dbg_diyfield_parse_' . $name . '';
			$result = call_user_func_array ( $diyfunction, array(
					$field,
					$data 
			) );
			return $result;
		}
	}
	else
	{
		return '-------------';
	}
}
// sql操作
function dbg_field_sql($type = NULL, $table, $val = array())
{
	switch($type)
	{
		// 添加字段
		case 'add':
			$_sql = dbg_field_parse ( $val['name'], $val['field'], $val['type'], $val['length'], $val['default'] );
			$sql = "ALTER TABLE {$table} ADD " . $_sql;
			break;
		// 修改字段
		case 'change':
			$_sql = dbg_field_parse ( $val['name'], $val['field'], $val['type'], $val['length'], $val['default'] );
			$sql = "ALTER TABLE {$table} CHANGE {$val['starfield']} " . $_sql;
			break;
		// 删除字段
		case 'drop':
			$sql = "ALTER TABLE {$table} DROP COLUMN {$val['field']}";
			break;
	}
	return $sql;
}

// 自定义字段 解析
function dbg_field_parse($name = NULL, $field = NULL, $type = NULL, $length = NULL, $defualt = NULL)
{
	$field_sql = "";
	switch($type)
	{
		// 单行文本
		case 'text':
			if($length < 30 || empty ( $length ))
			{
				$length = 90;
			}
			if(empty ( $defualt ))
			{
				$defualt = NULL;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name'  ";
			break;
		// 数字
		case 'number':
			if(empty ( $length ))
			{
				$length = 30;
			}
			if(empty ( $defualt ))
			{
				$defualt = 0;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name' ";
			break;
		// 文件
		case 'file':
			if($length < 30 || empty ( $length ))
			{
				$length = 90;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name' ";
			break;
		// 文件
		case 'download':
			if($length < 30 || empty ( $length ))
			{
				$length = 90;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name' ";
			break;
		// 多行文本
		case 'textarea':
			$field_sql .= "`$field` mediumtext NOT NULL COMMENT '$name' ";
			break;
		// 多图上传
		case 'swfupload':
			$field_sql .= "`$field` mediumtext NOT NULL COMMENT '$name' ";
			break;
		// 内容 编辑
		case 'ueditor':
			$field_sql .= "`$field` mediumtext NOT NULL COMMENT '$name' ";
			break;
		// 城市
		case 'city':
			if($length < 30 || empty ( $length ))
			{
				$length = 90;
			}
			if(empty ( $defualt ))
			{
				$defualt = NULL;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name'  ";
			break;
		// 单选框
		case 'radio':
			if(empty ( $defualt ))
			{
				$defualt = 0;
			}
			$field_sql .= "`$field` tinyint(1) NOT NULL DEFAULT '$defualt' COMMENT '$name' ";
			break;
		// 复选框
		case 'checkbox':
			if($length < 30 || empty ( $length ))
			{
				$length = 90;
			}
			if(empty ( $defualt ))
			{
				$defualt = NULL;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name'  ";
			break;
		// 关联模型
		case 'relation':
			if(empty ( $length ))
			{
				$length = 30;
			}
			if(empty ( $defualt ))
			{
				$defualt = 0;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name' ";
			break;
		// 自定义模板
		case 'template':
			if(empty ( $length ))
			{
				$length = 250;
			}
			if(empty ( $defualt ))
			{
				$defualt = NULL;
			}
			$field_sql .= "`$field` VARCHAR($length) NOT NULL DEFAULT '$defualt' COMMENT '$name' ";
			break;
	}
	return $field_sql;
}