<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 *  功能：
 *  富表单元素所属的风格组
 */
class FORM_Elementstylegroup extends DbgMs_Admin {
	public $title = 'FORM_富表单元素风格组管理';
	// 当前模块 modules
	public $modules = 'form';
	// 当前控制器 controllers
	public $con = 'elementstylegroup';
	public $mysql_table = 'dbg_elementstylegroup';

	// @action:默认列表
	public function index()	{
		$this->getpage ();
		$sql = 'SELECT * FROM ' . $this->mysql_table . ' ORDER BY id DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['lists'] = dbg_query ( $sql );
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM ' . $this->mysql_table . ';' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
                $this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
                $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
		$this->load_view ();
	}
        
        // @action：创建一个新风格组
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
        
        // @action: 编辑修改风格组信息
        public function edit(){
                if($_POST['act'] == 'edit'){
                    $field = $this->auth();
                    $where_sql = " id =" . $field['id'];
                    $sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql);
                    $result = dbg_query ( $sql, FALSE );
                    echo $result;
                    exit ();
                }else{
                        $id = dbg_input_getpost ( 'id' );
                        if($id != NULL)
                        {
                                $sql = 'SELECT c.*  FROM ' . $this->mysql_table . ' AS c  WHERE c.id=' . $id;
                                $row = dbg_query ( $sql );
                                $this->admin_data['row'] = $row[0];
                        }
                        $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                        $this->load_view ();
                }
        }
        
        /*
         * @action：删除某个风格组
         * 当有子元素时，不可删除
         */
        public function delete(){
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );

		if($id != NULL)
		{
                        //判断是否有富表单元素关联，若有则不能删除
                        $num = dbg_query ( "SELECT COUNT(*) AS num FROM dbg_richformelement WHERE gid=$id");
                        if( $num[0]['num'] > 0 ){
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,该分组下还有富表单元素成员！";
                                echo json_encode ( $result_json );
                                exit ();
                        }
                    
			$relust_sql = dbg_query ( 'DELETE FROM ' . $this->mysql_table . ' WHERE id=' . $id, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $id;
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
                $field['name'] = trim(dbg_input_getpost ( 'name' )); // 风格名
                $field['description'] = trim(dbg_input_getpost ( 'description' )); // 描述
                $field['id'] = dbg_input_getpost ( 'id' );
                $field['operatetime'] = time(); // 操作时间

                if(!$field['id']){
                		unset($field['id']);
                }
                
                $this->checkpost(array("'",'"','\\'), array($field['name'],$field['description']));
                
                if( empty($field['name']) ){
                        echo '名称不能为空';die;
                }
                
                if($field['id'] != ''){//编辑时
                        //分组名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE name="'.$field['name'].'" AND id !="'.$field['id'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该分组名称已存在';die;
                        }  
                        
                }else{//新增时
                        //分组名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE name="'.$field['name'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该分组名称已存在';die;
                        }  
                }
                
                return $field;
        }
        
        /*
         * 查看分组成员
         */
        public function member(){
                echo '等下做！';
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