<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-04-19
 */
class CMS_Album extends DbgMs_Admin {
	public $title = 'CMS_专辑管理';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'album';
	public $mysql_table = 'dbg_album';
	// @action:默认列表
	public function index()
	{
		$this->load_view ();
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