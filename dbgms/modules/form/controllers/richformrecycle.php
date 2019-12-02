<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 *  功能：
 *  富表单回收管理
 */
class FORM_Richformrecycle extends DbgMs_Admin {
	public $title = 'FORM_富表单回收管理';
	// 当前模块 modules
	public $modules = 'form';
	// 当前控制器 controllers
	public $con = 'richformrecycle';
	public $mysql_table = 'dbg_richform';
        
        public function __construct($data, $jumpgroup = FALSE) {
                parent::__construct($data, $jumpgroup);
                $this->admin_data['resuscitate_url'] = $this->admin_data['con_url'] . '&act=resuscitate&id=';
        }

	// @action:默认列表
	public function index()	{
		$this->getpage ();
                // 搜索关键字
                $where_sql = '';
                $pageurl = '';
                $q = trim(dbg_input_getpost('q'));
                $this->admin_data['q'] = $q;
                if($q != ''){
                        $where_sql = " AND (rfname like '%{$q}%' OR bindproduct like '%{$q}%') ";
                        $pageurl = "&q={$q}";
                }
		$sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE isdelete=1 '.$where_sql.' ORDER BY rfid DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['lists'] = dbg_query ( $sql );
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(rfid) AS d FROM ' . $this->mysql_table . ' WHERE isdelete=1 ' . $where_sql . ' ;' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
                $this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
                $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
		$this->load_view ();
	}
        
        
        /*
         * @action：恢复某个富表单
         */
        public function resuscitate(){
		$rfid = dbg_input_getpost ( 'id' );
		$rfid = intval ( $rfid );

		if($rfid != NULL)
		{
			$relust_sql = dbg_query ( 'UPDATE '. $this->mysql_table .' SET isdelete=0 WHERE rfid=' . $rfid, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $rfid;
			}
			else
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "恢复失败,数据操作错误";
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
        
        /*
         * @action：删掉某个表单
         */
        public function delete(){
		$rfid = dbg_input_getpost ( 'id' );
		$rfid = intval ( $rfid );

		if($rfid != NULL)
		{
                        //获得表名和html文件地址
                        $relativeinfo = dbg_query('SELECT tablename,cachefile FROM `dbg_richform` WHERE rfid='.$rfid, TRUE);
                        //删除dbg_richform中的记录
			$relust_sql = dbg_query ( 'DELETE FROM ' . $this->mysql_table . ' WHERE rfid=' . $rfid, FALSE );
                        //删除dbg_form_element中的记录
                        $relust_sql = dbg_query ( 'DELETE FROM `dbg_form_element` WHERE rfid=' . $rfid, FALSE );
                        //删除数据库表
                        $relust_sql = dbg_query("DROP TABLE IF EXISTS `{$relativeinfo[0]['tablename']}`;",false);
                        //删除html文件
                        if(file_exists($relativeinfo[0]['cachefile'])){
                                unlink($relativeinfo[0]['cachefile']);
                        }
                        
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $rfid;
			}
			else
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,数据操作错误！";
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