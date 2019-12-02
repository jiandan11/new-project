<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 *  功能：
 *  美化基本表单元素，这一级不做缓存富表单文件
 */
class FORM_Richformelement extends DbgMs_Admin {
	public $title = 'FORM_富表单元素管理';
	// 当前模块 modules
	public $modules = 'form';
	// 当前控制器 controllers
	public $con = 'richformelement';
	public $mysql_table = 'dbg_richformelement';
        
        public function __construct($data, $jumpgroup = FALSE) {
                parent::__construct($data, $jumpgroup);
                //获取系统已实现的基本表单元素
                require_once __DIR__.'/baseformelement.php';
                $baseformeelement = new FORM_Baseformelement();
                $this->admin_data['tags'] = $baseformeelement->elements;
                
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
                        $where_sql = " WHERE rname like '%{$q}%' OR gname like '%{$q}%' ";
                        $pageurl = "&q={$q}";
                }
		$sql = 'SELECT * FROM ' . $this->mysql_table . $where_sql .' ORDER BY rid DESC LIMIT ' . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['lists'] = dbg_query ( $sql );
                
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(rid) AS d FROM ' . $this->mysql_table . $where_sql .';' );
		// 当前模型内容列表
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
                $this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚
                $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                
                $this->admin_data['setstyle_url'] = $this->admin_data['con_url'] . '&act=setstyle';
                
		$this->load_view ();
	}
        
        // @action：实例化基本表单元素为富表单元素 或 创建富表单元素
        public function add(){
                if($_POST['act'] == 'add'){
                        $field = $this->auth();
                        $sql = $this->parse_table_sql ( $this->mysql_table, $field );
                        $result = dbg_query ( $sql, false );
                        echo $result;
                        exit ();
                }else{
                        //获取表单元素风格组
                        $sql = 'SELECT * FROM `dbg_elementstylegroup`';
                        $this->admin_data['groups'] = dbg_query ( $sql );

                        $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                        $this->load_view ();
                }
        }
        
        // @action: 编辑修改富表单元素信息
        public function edit(){
                if($_POST['act'] == 'edit'){
                    $field = $this->auth();
                    $where_sql = " rid =" . $field['rid'];
                    $sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql);
                    $result = dbg_query ( $sql, FALSE );
                    echo $result;
                    exit ();
                }else{
                        $rid = dbg_input_getpost ( 'rid' );
                        if($rid != NULL)
                        {
                                $sql = 'SELECT c.*  FROM ' . $this->mysql_table . ' AS c  WHERE c.rid=' . $rid;
                                $row = dbg_query ( $sql );
                                $this->admin_data['row'] = $row[0];
                        }
                        //获取表单元素风格组
                        $sql = 'SELECT * FROM `dbg_elementstylegroup`';
                        $this->admin_data['groups'] = dbg_query ( $sql );
                        
                        $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'/'.__FUNCTION__.'.php';
                        $this->load_view ();
                }
        }
        
        /* @action: 删除
         * 富表单元素若是有被某个表单富表单引用，则不能删除。
         */
        public function delete(){
		$rid = dbg_input_getpost ( 'id' );
		$rid = intval ( $rid );
		if($rid != NULL)
		{
                        $rtn = dbg_query('SELECT COUNT(*) AS num FROM `dbg_form_element` WHERE rid='.$rid,true);
                        if($rtn[0]['num']){
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,该富表单已被引用！";
                                echo json_encode ( $result_json );
                                exit ();
                        }
			$relust_sql = dbg_query ( 'DELETE FROM '. $this->mysql_table .' WHERE rid=' . $rid, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $rid;
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
        
        /*
         *  @action: 设置style样式
         *  设置样式时，修改html字段
         */
        public function setstyle(){
                $field['attrstyle'] = trim(dbg_input_getpost ( 'attrstyle' )); //样式
                $field['rid'] = dbg_input_getpost ( 'rid' );
                $sql = 'SELECT c.*  FROM ' . $this->mysql_table . ' AS c  WHERE c.rid=' . $field['rid'];
                $info = dbg_query ( $sql );
                $field['html'] =  '<' . $info[0]['bname'];
                if( $info[0]['attrtype'] != '' ){
                        $field['html'] .= ' type="' . $info[0]['attrtype'] . '"';
                }
                $field['html'] .= ' '. $field['attrstyle'];
                unset($info);
                /*
                 * 其它情况 预留
                 */

                $field['html'] .= ' />'; 
                $where_sql = " rid =" . $field['rid'];
                $sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql);
                $result = dbg_query ( $sql, FALSE );
                echo $result;
                exit ();
        }
        
        /*
         * 表单验证 
         */
        protected function auth(){
                $field = array();
                $field['rname'] = trim(dbg_input_getpost ( 'rname' )); // 富表单元素名
                $field['description'] = trim(dbg_input_getpost ( 'description' )); // 富表单元素描述
                $field['attrstyle'] = trim(dbg_input_getpost ( 'attrstyle' )); // 富表单元素样式
                $field['rid'] = dbg_input_getpost ( 'rid' );
                $field['bid'] = dbg_input_getpost ( 'bid' );//基本标签id
                $field['gid'] = dbg_input_getpost ( 'gid' );//风格组id
                $field['operatetime'] = time(); // 操作时间

                if(!$field['rid']){
                		unset($field['rid']);
                }
                
                if( empty($field['bid']) ){
                        echo '请选择基本表单元素标签';die;
                }
                
                $tags = $this->admin_data['tags'];
                $field['bname'] = $tags[$field['bid']]['tagname'];//取得标签名，方便调用
                $field['attrtype'] = $tags[$field['bid']]['type'];//取得标签s属性名，方便调用
                
                if( empty($field['rname']) ){
                        echo '富表单元素名称不能为空';die;
                }
                
                if( $field['attrstyle'] != '' && !strstr($field['attrstyle'], 'style=')){//如果样式有值,则先判断是否规范
                        echo '样式格式为 style="样式值"';die;
                }
                
                if( !empty($field['gid']) ){
                        $sql = 'SELECT c.name  FROM dbg_elementstylegroup AS c  WHERE c.id=' . $field['gid'];
                        $gname = dbg_query ( $sql );
                        $field['gname'] = $gname[0]['name'];
                        unset($gname);
                }else{
                       $field['gname'] = ''; 
                }
                
                if($field['rid'] != ''){//编辑时
                        //富表单元素名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE rname="'.$field['rname'].'" AND rid !="'.$field['rid'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该富表单元素名称已存在';die;
                        }  
                        
                }else{//新增时
                        //富表单元素名称唯一性判断
                        $sql = 'SELECT * FROM ' . $this->mysql_table . ' WHERE rname="'.$field['rname'].'"';
                        $result = dbg_query ( $sql, true );
                        if( count($result) ){
                                echo '该富表单元素名称已存在';die;
                        }  
                }
                
                // 组装用于预览的html
                // 其他属性 如textarea的cols rows 后期考虑
                if( $field['attrstyle'] != '' ){//如果样式有值,则html加上样式
                       $field['html'] =  '<' . $field['bname'];
                       if( $field['attrtype'] != '' ){
                               $field['html'] .= ' type="' . $field['attrtype'] . '"';
                       }
                       $field['html'] .= ' '. $field['attrstyle'];
                       
                       /*
                        * 其它情况 预留
                        */
                       
                       $field['html'] .= ' />'; 
                }else{
                        
                }
                
                return $field;
        }

}