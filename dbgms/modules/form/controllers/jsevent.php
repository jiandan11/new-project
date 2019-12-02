<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 *  功能：
 *  富表单元素绑定的js事件
 */
class FORM_Jsevent extends DbgMs_Admin {
	public $title = 'FORM_表单元素js事件管理';
	// 当前模块 modules
	public $modules = 'form';
	// 当前控制器 controllers
	public $con = 'jsevent';
	public $mysql_table = 'dbg_jsevent';

	// @action:默认列表
	public function index()	{
		$this->getpage ();
		$sql = 'SELECT * FROM ' . $this->mysql_table . ' ORDER BY jseid DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['lists'] = dbg_query ( $sql );
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(jseid) AS d FROM ' . $this->mysql_table . ';' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
                $this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
                $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
		$this->load_view ();
	}
        
        // @action:创建规则
        public function add(){
                if($_POST['act'] == 'add'){
                    $field = $this->auth();
                    $sql = $this->parse_table_sql ( $this->mysql_table, $field );
                    $result = dbg_query ( $sql, FALSE );
                    echo $result;
                    exit ();
                }else{
                        $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                        $this->load_view ();
                }
        }
        
        // @action:修改规则信息
        public function edit(){
                if($_POST['act'] == 'edit'){
                    $field = $this->auth();
                    $where_sql = " jseid =" . $field['jseid'];
                    $sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql);
                    $result = dbg_query ( $sql, FALSE );
                    echo $result;
                    exit ();
                }else{
                        $jseid = dbg_input_getpost ( 'jseid' );
                        if($jseid != NULL)
                        {
                                $sql = 'SELECT c.*  FROM ' . $this->mysql_table . ' AS c  WHERE c.jseid=' . $jseid;
                                $row = dbg_query ( $sql );
                                $this->admin_data['row'] = $row[0];
                        }
                        $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                        $this->load_view ();
                }
        }
        
        /*
         * @action：删除js事件
         * 当有表单元素绑定事件时，不可删除
         */
        public function delete(){
		$jseid = dbg_input_getpost ( 'id' );
		$jseid = intval ( $jseid );

		if($jseid != NULL)
		{
                        //判断是否有富表单元素关联，若有则不能删除
                        $num = dbg_query ( "SELECT COUNT(*) AS num FROM dbg_form_element WHERE jseid=$jseid");
                        if( $num[0]['num'] > 0 ){
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,该事件已被引用,请解除引用后再删除！";
                                echo json_encode ( $result_json );
                                exit ();
                        }
                    
			$relust_sql = dbg_query ( 'DELETE FROM ' . $this->mysql_table . ' WHERE jseid=' . $jseid, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $jseid;
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
        
        /*
         * 表单验证 
         */
        protected function auth(){
                $field = array();
                $field['jsename'] = trim(dbg_input_getpost ( 'jsename' )); // 标识名称
                $field['description'] = trim(dbg_input_getpost ( 'description' )); // 描述
                $field['jseid'] = dbg_input_getpost ( 'jseid' );
                $field['eventname'] = trim(dbg_input_getpost ( 'eventname' )); // 事件名称如onclick
                $field['functionname'] = trim(dbg_input_getpost ( 'functionname' )); // 事件触发时执行的js函数
                $field['functioncode'] = trim(dbg_input_getpost ( 'functioncode' )); // 事件触发时执行的代码 完整的代码
                $field['operatetime'] = time(); // 操作时间

                if(!$field['jseid']){
                		unset($field['jseid']);
                }
                
                $this->checkpost(array("'",'"','\\'), array($field['jsename'],$field['description'],$field['eventname'],$field['functionname'],$field['functioncode']));
                
                if( empty($field['jsename']) ){
                        echo '规则名称不能为空';die;
                }
                
                if($field['jseid'] != ''){//编辑时
                        //名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE jsename="'.$field['jsename'].'" AND jseid !="'.$field['jseid'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该规则名称已存在';die;
                        }
                        
                }else{//新增时
                        //名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE jsename="'.$field['jsename'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该规则名称已存在';die;
                        }
                }
                
                return $field;
        }
        
        private function checkpost($unlegalchars,$data){
                foreach ($data as $key => $value) {
                        foreach ($unlegalchars as $key1 => $value1) {
                                if(strstr($value,$value1)){
                                        echo '提交的数据不能有 “' . $value1 . '”字符！' ;exit;
                                }
                        }
                }
        }

}