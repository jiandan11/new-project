<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-04-07
 */
class CMS_Expand extends DbgMs_Admin {
	public $title = 'CMS_多维栏目扩展';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'expand';
	public $mysql_table = 'dbg_expand_model';
	// @action:默认列表
	public function manageedit()
	{
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{
			$sql = 'SELECT c.*  FROM dbg_expand_model_field AS c WHERE c.id=' . $id;
			$row = dbg_query ( $sql );
			$lists1 = array();
			$lists1 = explode ( "\n", $row[0]['config'] );
			$lists = array();
			foreach($lists1 as $val)
			{
				$new_row = array();
				$new_row = explode ( "|", $val );
				$new_row2 = array();
				$new_row2['title'] = $new_row[0];
				$new_row2['sign'] = $new_row[1];
				$lists[] = $new_row2;
			}
			unset ( $lists1 );
		}
		$this->admin_data['row'] = $row[0];
		$this->load_view ();
	}
	// @action:默认列表 2016-04-07
	public function manage()
	{
		$this->getpage ();
		$expandid = dbg_input_getpost ( 'id' );
		$expandid = intval ( $expandid );
		$sql = 'SELECT * FROM dbg_expand_model_field WHERE expandid=' . $expandid . ' ORDER BY id DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$lists = dbg_query ( $sql );
		$this->admin_data['lists'] = $lists;
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM dbg_expand_model_field  WHERE expandid=' . $expandid . ' ;' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
		$this->load_view ();
	}
	// @action:更新
	public function manageupdate()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
		}
		else
		{
		}
		$field['expandid'] = dbg_input_getpost ( 'expandid' );
		
		$field['title'] = dbg_input_getpost ( 'title' ); // 标题
		$field['sign'] = dbg_input_getpost ( 'sign' ); // 标识
		$field['type'] = dbg_input_getpost ( 'type' );
		$field['rank'] = dbg_input_getpost ( 'rank' );
		$field['config'] = dbg_input_getpost ( 'config' );
		$sql = $this->parse_table_sql ( 'dbg_expand_model_field', $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		include_once _DBGMS_MODULES_ . 'cms/controllers/column.php';
		$columnClass = new CMS_Column ( NULL, TRUE );
		$columnClass->upcache ();
		exit ();
	}
	// @action:删除 2016-04-07
	public function managedelete()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		if($id != NULL)
		{
			$relust_sql = dbg_query ( 'DELETE FROM dbg_expand_model_field WHERE id=' . $id, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $id;
			}
			else
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,数据操作错误";
			}
			echo json_encode ( $result_json );
			exit ();
		}
		else
		{
			redirect ( $this->admin_data['con_url'] ); // 返回列表
			exit ();
		}
	}
	
	// @action:默认列表
	public function index()
	{
		$this->getpage ();
		$sql = 'SELECT * FROM ' . $this->mysql_table . ' ORDER BY id DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$lists = dbg_query ( $sql );
		$this->admin_data['lists'] = $lists;
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM ' . $this->mysql_table . ';' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
		$this->load_view ();
	}
	
	// @action:编辑
	public function edit($api_id, $interface = FALSE)
	{
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{
			$sql = 'SELECT c.*  FROM ' . $this->mysql_table . ' AS c  WHERE c.id=' . $id;
			$row = dbg_query ( $sql );
		}
		if($interface == TRUE)
		{
			return $row[0];
		}
		else
		{
			
			$this->admin_data['row'] = $row[0];
			$this->load_view ();
		}
	}
	// @action:更新
	public function update()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
		}
		$field['title'] = dbg_input_getpost ( 'title' ); // 标识
		$field['table'] = dbg_input_getpost ( 'table' ); // 标题
		$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		echo $result;
		exit ();
	}
	// @action:删除 2016-03-30
	public function delete()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		if($id != NULL)
		{
			$relust_sql = dbg_query ( 'DELETE FROM ' . $this->mysql_table . ' WHERE id=' . $id, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $id;
			}
			else
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,数据操作错误";
			}
			echo json_encode ( $result_json );
			exit ();
		}
		else
		{
			redirect ( $this->admin_data['con_url'] ); // 返回列表
			exit ();
		}
	}
}