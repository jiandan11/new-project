<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-04-19
 */
class CMS_Fragment extends DbgMs_Admin {
	public $title = 'CMS_碎片管理';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'fragment';
	public $mysql_table = 'dbg_fragment';
        
	// @action:获取碎片
	public static function get($id = NULL)
	{
		if($id != NULL)
		{
			$obj = new CMS_Fragment ( NULL, TRUE );
			$sql = 'SELECT c.*  FROM ' . $obj->mysql_table . ' AS c  WHERE c.id=' . $id;
			$row = dbg_query ( $sql );
			return $row[0];
		}
		else
		{
			return '碎片不能为空';
		}
	}
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
                        $this->admin_data['enablelanguage'] = $this->enablelanguage;
			$this->admin_data['row'] = $row[0];
			$this->load_view ();
		}
	}
	
	// @action:更新
	public function update()
	{
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
		}
		else
		{
			$field['intime'] = time (); // 插入时间
		}
		$field['sign'] = dbg_input_getpost ( 'sign' ); // 标识
		$field['title'] = dbg_input_getpost ( 'title' ); // 标题
		$field['content'] = dbg_input_getpost ( 'content' ); // 内容
                
                if($this->enablelanguage){
                        $field['econtent'] = dbg_input_getpost ( 'econtent' ); // 英文内容
                }
                
		$field['disable'] = 0; // 是否禁用
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