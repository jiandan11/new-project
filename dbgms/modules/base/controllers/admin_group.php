<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Admin_group extends DbgMs_Admin {
	public $title = 'BASE_管理员权限';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'admin_group';
	public $mysql_table = 'dbg_admin_group';
	// @action:默认列表
	public function index()
	{
		$this->getpage ();
		$this->admin_data['page'] = $this->page;
		$pagesize = 8;
		// 当前模型内容列表
		$sql_select_list = 'SELECT * FROM dbg_admin_group WHERE id!=1 AND id>' . $this->_admin['groupid'] . " ORDER BY id ASC LIMIT " . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['list'] = dbg_query ( $sql_select_list );
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM dbg_admin_group WHERE id!=1 AND id>' . $this->_admin['groupid'] );
		$url = $this->admin_data['curr_url'] . '&page='; // 页脚url
		
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]->d, $this->pagesize, $url ); // 生成页脚
		$this->load_view ();
	}
	// @action:编辑
	public function edit()
	{ /* ID */
		$id = dbg_input_getpost ( 'id' );
		$id = isset ( $id ) ? intval ( $id ) : 0;
		if($id != null)
		{
			$sql_edit = "SELECT c.* FROM dbg_admin_group AS c WHERE c.id=" . $id;
			$row = dbg_query ( $sql_edit );
			$row[0]['menu'] = unserialize ( $row[0]['menu'] );
			$row[0]['menu'] = dbg_out ( $row[0]['menu'] );
			$this->admin_data['row'] = $row[0];
		}
		
		// 获取菜单
		$dbgms_modules_menu_arr = glob ( _DBGMS_MODULES_ . '*/menu.php' );
		$dbgms_module_menu = array();
		$dbgms_menu = array();
		foreach($dbgms_modules_menu_arr as $value)
		{
			$dbgms_module_menu = require $value;
			if(! empty ( $dbgms_module_menu ))
			{
				$dbgms_menu[$dbgms_module_menu['modules']] = $dbgms_module_menu;
			}
		}
		// 设置头部链接
		$dbgms_menu_head = array();
		foreach($dbgms_menu as $key=>$val)
		{
			$dbgms_menu_head_row = array();
			$dbgms_menu_head_row['name'] = $val['name'];
			$dbgms_menu_head_row['sign'] = $val['modules'];
			$dbgms_menu_head[] = $dbgms_menu_head_row;
		}
		$this->admin_data['dbg_menu'] = $dbgms_menu;
		$this->admin_data['dbg_menu']['head'] = $dbgms_menu_head;
		$frame_menu_sql = "SELECT m.id,m.name FROM dbg_model AS m WHERE m.disable = 0 AND m.install = 1 ORDER BY m.id ASC";
		$this->admin_data['dbg_menu']['content'] = dbg_query ( $frame_menu_sql );
		//
		$this->load_view ();
	}
	// @action:删除
	public function delete()
	{
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{
			if($id <= 2)
			{
				$result_json['msg'] = '默认权限,不可删除！';
			}
			else
			{
				$relust_sql = dbg_query ( 'DELETE FROM dbg_admin_group WHERE id=' . $id );
				if($relust_sql == TRUE)
				{
					$result_json['type'] = 'ok';
					$result_json['id'] = $id;
				}
				else
				{
					$result_json['msg'] = "删除失败,数据操作错误";
				}
				echo json_encode ( $result_json );
				return;
			}
			echo json_encode ( $result_json );
			return;
		}
		else
		{
			redirect ( $this->admin_data['curr_url'] ); // 返回列表
			exit ();
		}
	}
	// @action:更新
	public function update()
	{
		$where_sql = "";
		$id = dbg_input_getpost ( 'id' );
		if($id != null)
		{
			$where_sql = " id =" . $id;
		}
		$menu = dbg_input_getpost ( 'menu' );
		$menu = dbg_in ( $menu );
		$menu = serialize ( $menu );
		$field['menu'] = $menu;
		$field['name'] = dbg_input_getpost ( 'name' );
		$field['icon'] = dbg_input_getpost ( 'icon' );
		$field['disable'] = intval ( dbg_input_getpost ( 'disable' ) ); // 是否禁用
		$field['sendpm'] = intval ( dbg_input_getpost ( 'sendpm' ) ); // 禁用
		$sql = $this->parse_table_sql ( 'dbg_admin_group', $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		echo $result;
	}
	// @action:是否禁用-开关 2016-04-05
	public function disable()
	{
		$id = dbg_input_getpost ( "id" );
		$id = intval ( $id );
		$where_sql = "";
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
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
