<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 *  功能：
 *  富表单元素验证规则
 */
class FORM_Regular extends DbgMs_Admin {
	public $title = 'FORM_表单元素验证规则管理';
	// 当前模块 modules
	public $modules = 'form';
	// 当前控制器 controllers
	public $con = 'regular';
	public $mysql_table = 'dbg_regular';

	// @action:默认列表
	public function index()	{
		$this->getpage ();
                $q = trim(dbg_input_getpost('q'));
                $this->admin_data['q'] = $q;
                
                $where_sql = '';
                $pageurl = '';
                if($q != ''){
                        $where_sql = " WHERE regname like '%{$q}%' ";
                        $pageurl = "&q={$q}";
                }
		$sql = 'SELECT * FROM ' . $this->mysql_table . $where_sql . ' ORDER BY regid DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['lists'] = dbg_query ( $sql );
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(regid) AS d FROM ' . $this->mysql_table . $where_sql .';' );
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
                    $sql = addcslashes($sql, "\\");
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
                    $where_sql = " regid =" . $field['regid'];
                    $sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql);
                    $sql = addcslashes($sql, "\\");
                    $result = dbg_query ( $sql, FALSE );
                    echo $result;
                    exit ();
                }else{
                        $regid = dbg_input_getpost ( 'regid' );
                        if($regid != NULL)
                        {
                                $sql = 'SELECT c.*  FROM ' . $this->mysql_table . ' AS c  WHERE c.regid=' . $regid;
                                $row = dbg_query ( $sql );
                                $this->admin_data['row'] = $row[0];
                        }
                        $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                        $this->load_view ();
                }
        }
        
        /*
         * @action：删除验证规则
         * 当有表单元素绑定验证规则时，不可删除
         */
        public function delete(){
		$regid = dbg_input_getpost ( 'id' );
		$regid = intval ( $regid );

		if($regid != NULL)
		{
                        //判断是否有富表单元素关联，若有则不能删除
                        $num = dbg_query ( "SELECT COUNT(*) AS num FROM dbg_form_element WHERE regid=$regid");
                        if( $num[0]['num'] > 0 ){
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,该验证规则已被引用,请解除引用后再删除！";
                                echo json_encode ( $result_json );
                                exit ();
                        }
                    
			$relust_sql = dbg_query ( 'DELETE FROM ' . $this->mysql_table . ' WHERE regid=' . $regid, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $regid;
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
                $field['regname'] = trim(dbg_input_getpost ( 'regname' )); // 规则名
                $field['description'] = trim(dbg_input_getpost ( 'description' )); // 规则描述
                $field['regid'] = dbg_input_getpost ( 'regid' );
                $field['regtype'] = dbg_input_getpost ( 'regtype' );
                $field['function'] = trim(dbg_input_getpost ( 'function' )); // 验证函数
                $field['expression'] = trim(dbg_input_getpost ( 'expression' )); // 正则表达式
                $field['prompt'] = trim(dbg_input_getpost ( 'prompt' )); // 验证失败提示语
                $field['operatetime'] = time(); // 操作时间

                $this->checkpost(array("'",'"','\\'), array($field['regname'],$field['description'],$field['expression'],$field['prompt'],$field['function']));

                if(!$field['regid']){
                		unset($field['regid']);
                }
                
                if( empty($field['regname']) ){
                        echo '规则名称不能为空';die;
                }
                
                if($field['regid'] != ''){//编辑时
                        //名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE regname="'.$field['regname'].'" AND regid !="'.$field['regid'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该规则名称已存在';die;
                        }
                        
                }else{//新增时
                        //名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE regname="'.$field['regname'].'"';
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