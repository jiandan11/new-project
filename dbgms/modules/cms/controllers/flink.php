<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-03-30
 *	module cms 模块-内容管理系统
 *	controllers flink 友情链接
 */
class CMS_Flink extends DbgMs_Admin {
	public $title = 'CMS_友情链接';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'flink';
	public $mysql_table = 'dbg_flink';
	// @action:默认列表
	public function index()
	{
		$this->getpage ();
		$sql = 'SELECT * FROM ' . $this->mysql_table . ' ORDER BY id DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$lists = dbg_query ( $sql );
		
		foreach($lists as $key=>$val)
		{
			if(empty ( $val['icon'] ) || $val['icon'] == '###')
			{
				$lists[$key]['icon'] = DBG_FILEURL . 'default/style1.jpg';
			}
			else
			{
				$lists[$key]['icon'] = DBG_FILEURL . $val['icon'];
			}
		}
		$this->admin_data['lists'] = $lists;
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM ' . $this->mysql_table . ';' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
		$this->load_view ();
	}
	// @action:数据解析
	private function parse()
	{
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
		$where_sql = "";
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
		}
		$field['type'] = dbg_input_getpost ( 'type' ); // 友链类型
		$field['info'] = dbg_input_getpost ( 'info' ); // 简述
		$field['link'] = dbg_input_getpost ( 'link' ); // 链接
		$field['title'] = dbg_input_getpost ( 'title' ); // 名称
		$field['icon'] = dbg_input_getpost ( 'icon' ); // 名称
		$field['icon'] = $field['icon'] == "" ? "###" : $field['icon'];
		$field['uptime'] = time (); // 更新时间
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