<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-03-30
 */
class CMS_Feedback extends DbgMs_Admin {
	public $title = 'CMS_意见反馈';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'feedback';
	public $mysql_table = 'dbg_feedback';
	// @action:默认列表
	public function index()
	{
		$this->getpage ();
		$sql = 'SELECT * FROM ' . $this->mysql_table . ' ORDER BY id DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['lists'] = dbg_query ( $sql );
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
			$this->getpage ();
			$this->admin_data['row'] = $row[0];
			$this->load_view ();
		}
	}
	
	// @action:更新
	public function update()
	{
		$id = dbg_input_getpost ( 'id' );
		$where_sql = '';
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
		}
		$field['author'] = dbg_input_getpost ( 'name' );
		$field['info'] = dbg_input_getpost ( 'email' );
		$field['content'] = dbg_input_getpost ( 'content' );
		$field['url'] = $_SERVER['HTTP_REFERER']; // 当前页面
		$field['ip'] = dbgms_IpGet (); // IP
		$field['uptime'] = time (); // 时间
		$field['browser'] = $_SERVER["HTTP_USER_AGENT"]; // 浏览器
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