<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Modules extends DbgMs_Admin {
	public $title = 'BASE_系统模块管理';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'modules';
	// 当前对应mysql表单
	public $mysql_table = 'dbgms_base_modules';
	// @action:默认列表
	public function index()
	{
		$sql_select_list = "SELECT c.* FROM {$this->mysql_table} AS c ORDER BY c.id ASC;";
		
		$list_old = dbg_query ( $sql_select_list );
		$list_new = array();
		foreach($list_old as $key=>$val)
		{
			//
			$row = array();
			$row['name'] = $val['name'];
			$row['install'] = $val['install'];
			$row['disable'] = $val['disable'];
			$row['sign'] = strtoupper ( $val['sign'] );
			$list_new[$val['sign']] = $row;
		}
		$this->admin_data['lists'] = $list_new;
		$this->load_view ();
	}
	// @action:安装模块 2016-04-21
	public function install()
	{
		$sign = dbg_input_getpost ( 'sign' );
		$sign = trim ( $sign );
		$sign = strtolower ( $sign );
		
		$file_sql_create = _DBGMS_MODULES_ . $sign . '/data/dbgms_' . $sign . '_create.sql';
		if(! file_exists ( $file_sql_create ))
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "安装失败，请检车文件是否存在~";
			echo json_encode ( $result_json );
			exit ();
		}
		$file_sql_create_content = file_get_contents ( $file_sql_create );
		$sql_arr = explode ( ';', $file_sql_create_content );
		foreach($sql_arr as $sql_row)
		{
			$sql_row = trim ( $sql_row );
			if(empty ( $sql_row ))
			{ // 为空的 执行
				continue;
			}
			$result = dbg_query ( $sql_row, FALSE );
			if($result != TRUE)
			{
				$install_result = FALSE;
				exit ( '安装错误' );
			}
			else
			{
				$install_result = TRUE;
			}
		}
		
		if($install_result == TRUE)
		{
			$source_admin_file = _DBGMS_MODULES_ . $sign . '/data/admin.php';
			$target_admin_file = _DBGMS_MODULES_ . $sign . '/admin.php';
			@copy ( $source_admin_file, $target_admin_file );
			
			$source_menu_file = _DBGMS_MODULES_ . $sign . '/data/menu.php';
			$target_menu_file = _DBGMS_MODULES_ . $sign . '/menu.php';
			@copy ( $source_menu_file, $target_menu_file );
			
			$where_sql = "";
			if($sign != NULL)
			{
				$where_sql = " sign='" . $sign . "'";
			}
			$field['install'] = 1;
			$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
			$result = dbg_query ( $sql, FALSE );
			$result_json['StatusCode'] = 200;
		}
		else
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "安装失败";
		}
		echo json_encode ( $result_json );
		exit ();
	}
	// @action:安装测试数据 2016-04-21
	public function testdata()
	{
		$sign = dbg_input_getpost ( 'sign' );
		$sign = trim ( $sign );
		$sign = strtolower ( $sign );
		
		$file_sql_insert = _DBGMS_MODULES_ . $sign . '/data/dbgms_' . $sign . '_insert.sql';
		if(! file_exists ( $file_sql_insert ))
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "安装失败，请检车文件是否存在~";
			echo json_encode ( $result_json );
			exit ();
		}
		$file_sql_insert_content = file ( $file_sql_insert );
		$sql_arr = array();
		foreach($file_sql_insert_content as $line)
		{
			$line = trim ( $line );
			$sql_arr[] = $line;
			// more statements...
		}
		foreach($sql_arr as $sql_row)
		{
			$sql_row = trim ( $sql_row );
			if(empty ( $sql_row ))
			{ // 为空的 执行
				continue;
			}
			$result = dbg_query ( $sql_row, FALSE );
			if($result != TRUE)
			{
				$install_result = FALSE;
				exit ( '安装错误' );
			}
			else
			{
				$install_result = TRUE;
			}
		}
		
		if($install_result == TRUE)
		{
			$where_sql = "";
			if($sign != NULL)
			{
				$where_sql = " sign='" . $sign . "'";
			}
			$field['testdata'] = 1;
			$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
			$result = dbg_query ( $sql, FALSE );
			$result_json['StatusCode'] = 200;
		}
		else
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "安装失败";
		}
		echo json_encode ( $result_json );
		exit ();
	}
	// @action:安装模块 2016-04-21
	public function uninstall()
	{
		$sign = dbg_input_getpost ( 'sign' );
		$sign = trim ( $sign );
		$sign = strtolower ( $sign );
		$sql_file = _DBGMS_MODULES_ . $sign . '/data/dbgms_' . $sign . '_uninstall.sql';
		if(! file_exists ( $sql_file ))
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "卸载失败，请检车文件是否存在~";
			echo json_encode ( $result_json );
			exit ();
		}
		$install_sql = file_get_contents ( $sql_file );
		$sql_arr = explode ( ';', $install_sql );
		foreach($sql_arr as $sql_row)
		{
			$sql_row = trim ( $sql_row );
			if(empty ( $sql_row ))
			{ // 为空的 执行
				continue;
			}
			$result = dbg_query ( $sql_row, FALSE );
			if($result != TRUE)
			{
				$install_result = FALSE;
				exit ( '安装错误' );
			}
			else
			{
				$install_result = TRUE;
			}
		}
		
		if($install_result == TRUE)
		{
			$target_admin_file = _DBGMS_MODULES_ . $sign . '/admin.php';
			$target_menu_file = _DBGMS_MODULES_ . $sign . '/menu.php';
			@unlink ( $target_admin_file );
			@unlink ( $target_menu_file );
			$where_sql = "";
			if($sign != NULL)
			{
				$where_sql = " sign='" . $sign . "'";
			}
			$field['install'] = 0;
			$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
			$result = dbg_query ( $sql, FALSE );
			$result_json['StatusCode'] = 200;
		}
		else
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "卸载失败";
		}
		echo json_encode ( $result_json );
		exit ();
	}
	
	// @action:是否禁用-开关 2016-04-21
	public function disable()
	{
		$sign = dbg_input_getpost ( "sign" );
		$sign = trim ( $sign );
		$sign = strtolower ( $sign );
		$where_sql = "";
		if($sign != NULL)
		{
			$where_sql = " sign='" . $sign . "'";
		}
		$field['disable'] = dbg_input_getpost ( "val" );
		$field['disable'] = intval ( $field['disable'] ); // 禁用
		$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		if($result == TRUE)
		{
			$result_json['StatusCode'] = 200;
		}
		else
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "修改失败";
		}
		echo json_encode ( $result_json );
		exit ();
	}
}
