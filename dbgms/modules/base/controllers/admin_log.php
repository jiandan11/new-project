<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Admin_log extends DbgMs_Admin {
	public $title = 'BASE_操作日志';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'admin_log';
	public $mysql_table = 'dbg_admin_log';
	// @action:默认列表
	public function index()
	{
		$this->getpage ();
		/* ID */
		$id = dbg_input_getpost ( 'id' );
		$id = isset ( $id ) ? intval ( $id ) : 0;
		$this->admin_data['page'] = $this->page;
		$sql_select_list = "SELECT  dbg_admin_log.*,dca.name AS aname, dca.alias AS alias , dsg.name AS groupname
			FROM dbg_admin AS dca, dbg_admin_log , dbg_admin_group AS dsg
			WHERE dbg_admin_log.adminid = dca.id AND dca.groupid = dsg.id
			ORDER BY dbg_admin_log.id DESC LIMIT " . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['list'] = dbg_query ( $sql_select_list );
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM dbg_admin_log ;' );
		$url = $this->admin_data['curr_url'] . '&page=';
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url );
		$this->load_view ();
	}
	// @action:清空操作日志
	public function truncate()
	{
		$type = dbg_input_getpost ( 'type' );
		if($type == 'all')
		{
			if($this->_admin['groupid'] == 1)
			{
				dbg_query ( ' TRUNCATE ' . $this->mysql_table . ' ;', FALSE );
			}
		}
		elseif($type == 2)
		{
			if($this->_admin['groupid'] <= 2)
			{
				$sql_delete = "DELETE FROM {$this->mysql_table} WHERE DATE_SUB(CURDATE(), INTERVAL 2 DAY) >= FROM_UNIXTIME({$this->mysql_table}.intime, '%Y-%m-%d') ";
				dbg_query ( $sql_delete, FALSE );
			}
		}
		redirect ( $this->admin_data['con_url'] ); // 返回列表
	}
}
