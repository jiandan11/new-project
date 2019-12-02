<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-02-18
 */
class CMS_Model extends DbgMs_Admin {
	public $title = 'CMS_模型管理';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'model';
	public $mysql_table = 'dbg_model';
	// @action:判断模型评论表单是否存在
	function comment_table()
	{
		$id = dbg_input_getpost ( 'id' );
		$type = dbg_input_getpost ( 'type' );
		if(empty ( $id ))
		{
			$this->ajaxreturn ( '模型错误~', 404, 'json' );
		}
		else
		{
			$where_sql = ' id=' . $id;
		}
		$model = dbg_query ( 'SELECT * FROM dbg_model WHERE id=' . $id );
		$model_comment_table = $model[0]['table'] . '_comment';
		$model_param = unserialize ( $model[0]['param'] );
		
		$istable = dbg_query ( 'SHOW TABLES  LIKE "' . $model_comment_table . '";' );
		
		if($type == 'install')
		{ // 评论模型
			$create_table_sql = " CREATE TABLE `" . $model_comment_table . "` (
				  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
				  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
				  `modelid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
				  `columnid` mediumint(8) DEFAULT '0' COMMENT '栏目id',
				  `contentid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '评论的内容id',
				  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '提醒|私信|系统',
				  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '审核状态',
				  `ip` char(15) NOT NULL DEFAULT '0' COMMENT 'ip',
				  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
				  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
				  `content` varchar(250) NOT NULL COMMENT '内容',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ";
			if(empty ( $istable ))
			{
				$result = dbg_query ( $create_table_sql, FALSE );
				if($result == TRUE)
				{
					$model_param['comment_table'] = 1;
					$field['param'] = serialize ( $model_param );
					$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
					$result = dbg_query ( $sql, FALSE );
					
					$this->ajaxreturn ( '安装成功~', 200, 'json' );
				}
			}
			else
			{
				$this->ajaxreturn ( '表单已安装，请勿重新操作', 404, 'json' );
			}
		}
		elseif($type == 'uninstall')
		{
			if(! empty ( $istable ))
			{
				$result = dbg_query ( ' DROP TABLE ' . $model_comment_table, FALSE );
				if($result == TRUE)
				{
					$model_param['comment_table'] = 0;
					$field['param'] = serialize ( $model_param );
					$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
					$result = dbg_query ( $sql, FALSE );
					
					$this->ajaxreturn ( '卸载成功~', 200, 'json' );
				}
			}
			else
			{
				$this->ajaxreturn ( '表单未安装', 404, 'json' );
			}
		}
		else
		{
			if(empty ( $istable ))
			{
				$this->ajaxreturn ( '模型_评论表单不存在~', 404, 'json' );
			}
			else
			{
				$this->ajaxreturn ( '存在~', 200, 'json' );
			}
		}
	}
	
	// cms——高级功能,模型管理
	function guanlian()
	{
		$data = array();
		$title = dbg_input_getpost ( "key" );
		$wsql = "";
		if($title != '')
		{
			$wsql = " WHERE title LIKE '%$title%' ";
		}
		$id = dbg_input_getpost ( "id" );
		$model = dbg_query ( "SELECT * FROM dbg_model WHERE id=" . $id );
		if(empty ( $model ))
		{
			$data['data'] = '';
			$data['page'] = '为空';
			$data['pagebreak'] = '为空';
			echo json_encode ( $data );
			exit ();
		}
		$page = dbg_input_getpost ( "page" );
		$page = empty ( $page ) ? 1 : $page;
		$pagesize = 20;
		$total = dbg_query ( 'SELECT COUNT(id) AS d FROM ' . $model[0]['table'] . $wsql );
		
		$list_sql = "SELECT id,title AS name FROM {$model[0]['table']} " . $wsql . "  ORDER BY id  DESC LIMIT " . ($page - 1) * $pagesize . "," . $pagesize;
		$list = dbg_query ( $list_sql );
		$data['data'] = $list;
		$data['page'] = $page;
		$url = base_url () . 'index/cms?act=model&use=guanlian&id=' . $id . '&page='; // 页脚url
		$data['pagebreak'] = $this->pagebreak ( $page, $total[0]['d'], $pagesize, $url ); // 生成页脚
		echo json_encode ( $data );
	}
	function upcache()
	{
		$this->parse ();
		echo 1;
	}
	// @action:添加
	public function add()
	{
		// 默认开启缓存
		$row['param']['iscache'] = 1;
		$this->admin_data['row'] = $row;
		$this->load_view ();
	}
	// @action:编辑
	public function edit()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = isset ( $id ) ? intval ( $id ) : 0;
		if($id != NULL)
		{
			$row = dbg_query ( 'SELECT * FROM dbg_model WHERE id=' . $id );
			$row[0]['diyfield'] = unserialize ( $row[0]['diyfield'] );
			$row[0]['param'] = unserialize ( $row[0]['param'] );
			$this->admin_data['row'] = $row[0];
		}
		$this->load_view ();
	}
	// @action:修改,更新 \禁用,启用
	public function update()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = isset ( $id ) ? intval ( $id ) : 0;
		
		$action = dbg_input_getpost ( "action" );
		$where_sql = "";
		if($id != NULL)
		{ // 编辑状态
			$where_sql = " id =" . $id;
			$searchname = " dbg_model.id !={$id} AND ";
		}
		else
		{
			$field['name'] = dbg_input_getpost ( 'name' ); // 名称
			$field['sign'] = dbg_input_getpost ( 'sign' ); // 标识
			$field['sign'] = trim ( $field['sign'] );
			$field['table'] = 'db_' . $field['sign']; // 数据表
			if(empty ( $field['name'] ) || empty ( $field['sign'] ) || empty ( $field['table'] ))
			{
				echo "必填项不能为空！";
				exit ();
			}
			//
			// if(! file_exists ( DBG_DATA . 'cache.model.php' ))
			// {
			// // 缓存文件~~~~~
			// $model_cache = dbg_query ( "SELECT * FROM dbg_model ORDER BY id ASC " );
			// $this->parse ( $model_cache );
			// }
			$result_arr = dbg_query ( "SELECT * FROM dbg_model ORDER BY id ASC " );
			foreach($result_arr as $key=>$val)
			{
				if($val['id'] != $id)
				{
					if($val['name'] == $field['name'])
					{
						echo "名称 ,已经存在";
						exit ();
					}
					elseif($val['sign'] == $field['sign'])
					{
						echo "标识 ,已经存在";
						exit ();
					}
					elseif($val['table'] == $field['table'])
					{
						echo "数据表 ,已经存在";
						exit ();
					}
				}
			}
			// $result_name = dbg_query ( "SELECT id FROM dbg_model WHERE " . $searchname . " dbg_model.name ='" . $field ['name'] . "'" );
			// if ($result_name)
			// {
			// echo "中文名称 ,已经存在";
			// exit ();
			// }
			// $result_sign = dbg_query ( "SELECT id FROM dbg_model WHERE " . $searchname . " dbg_model.sign ='" . $field ['sign'] . "'" );
			// if ($result_sign)
			// {
			// echo "标识 ,已经存在";
			// exit ();
			// }
			// $result_table = dbg_query ( "SELECT id FROM dbg_model WHERE " . $searchname . " dbg_model.table ='" . $field ['table'] . "'" );
			// if ($result_table)
			// {
			// echo "数据表 ,已经存在";
			// exit ();
			// }
		}
		$field['rank'] = dbg_input_getpost ( 'rank' ); // 排序
		/* 高级参数 */
		foreach($_POST['param'] as $key=>$value)
		{
			$field['param'][$key] = $value;
		}
		$field['param'] = serialize ( $field['param'] );
		
		if($id == NULL && $field['disable'] == "")
		{
			
			$field['disable'] = 1;
			$field['install'] = 0;
		}
		$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
		
		$result = dbg_query ( $sql, FALSE );
		if($result == TRUE)
		{
			$this->parse ();
		}
		echo 1;
	}
	// @action:开启\关闭
	function open_close()
	{
		$id = dbg_input_getpost ( "id" );
		$action = dbg_input_getpost ( "action" );
		$where_sql = "";
		if($id != NULL)
		{ // 编辑状态
			$where_sql = " id =" . $id;
			$searchname = " dbg_model.id !={$id} AND ";
		}
		$field['install'] = dbg_input_getpost ( 'install' ); // 安装
		$field['disable'] = dbg_input_getpost ( 'disable' ); // 禁用
		if($field['install'] == 0)
		{
			echo "请先安装";
			exit ();
		}
		$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		if($result == TRUE)
		{
			// 缓存文件~~~~~
			$model_cache = dbg_query ( "SELECT * FROM dbg_model ORDER BY id ASC " );
			$this->parse ( $model_cache );
		}
		echo 1;
	}
	// @action:安装
	public function install()
	{
		$this->edit ();
	}
	// @action:卸载
	public function uninstall()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = isset ( $id ) ? intval ( $id ) : 0;
		if($id != NULL)
		{
			$row = dbg_query ( 'SELECT * FROM dbg_model WHERE id=' . $id );
			$row[0]['diyfield'] = unserialize ( $row[0]['diyfield'] );
			$row[0]['param'] = unserialize ( $row[0]['param'] );
			$total = dbg_query ( 'SELECT COUNT(c.id) AS d FROM ' . $row[0]['table'] . ' AS c ' );
			$row[0]['total'] = $total[0]['d'];
			$this->admin_data['row'] = $row[0];
		}
		$this->load_view ();
	}
	// @action:安装或卸载
	public function install_uninstall()
	{
		$id = dbg_input_getpost ( "id" );
		$table = dbg_input_getpost ( "table" );
		$action = dbg_input_getpost ( "action" );
		if($id != NULL && $table != NULL)
		{
			if($action == 'install')
			{
				// 模型查询
				$model_sql = "SELECT dsm.diyfield FROM dbg_model AS dsm WHERE  dsm.id=" . $id;
				$modelinfo = dbg_query ( $model_sql );
				$modelinfo = $modelinfo[0];
				$diyfields = unserialize ( $modelinfo['diyfield'] );
				// 其他需要的字段
				$field_create_sql = " ";
				foreach($diyfields as $val)
				{
					include 'diyfield.php';
					$field_create_sql .= dbg_field_parse ( $val['name'], $val['field'], $val['type'], $val['length'], $val['default'] ) . ',';
				}
				if($id == 'feedflink')
				{ // 友情链接模型
					$create_table_sql = "CREATE TABLE `" . $table . "` (
						  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
						  `type` tinyint(2) DEFAULT '0' COMMENT '类型',
						  `title` char(60) NOT NULL COMMENT '链接名称',
						  `link` varchar(500) NOT NULL DEFAULT '' COMMENT '友情链接',
						  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
						  `info` char(90) NOT NULL DEFAULT '' COMMENT '简述',
						  `icon` varchar(90) NOT NULL COMMENT '商标',
							" . $field_create_sql . "
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ";
				}
				elseif($id == 'feedback')
				{ // 意见反馈模型
					$create_table_sql = " CREATE TABLE `" . $table . "` (
							`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
							`userid` char(60) NOT NULL DEFAULT '0' COMMENT '作者id',
							`url` varchar(500) NOT NULL DEFAULT '' COMMENT '反馈页面',
							`ip` char(60) NOT NULL DEFAULT '0' COMMENT '游客IP',
							`uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
							`info` char(90) NOT NULL DEFAULT '' COMMENT '联系方式',
							`content` mediumtext NOT NULL COMMENT '反馈内容',
							`browser` mediumtext NOT NULL COMMENT '浏览器 信息',
							`solve` tinyint(2) DEFAULT '0' COMMENT '是否解决',
							" . $field_create_sql . "
							PRIMARY KEY (`id`)
					) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ";
				}
				else
				{
					// 基础创建数据表 0407
					$create_table_sql = "CREATE TABLE `" . $table . "` (
					  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
					  `columnid` mediumint(8) unsigned NOT NULL COMMENT '栏目id',
					  `adminid` mediumint(8) unsigned NOT NULL COMMENT '审核id',
					  `authorid` mediumint(8) unsigned NOT NULL COMMENT '作者id',
					  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
					  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '入库时间',
					  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
					  `indetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收录时间：收录1；否则查询时间',
					  `title` char(90) NOT NULL DEFAULT '' COMMENT '标题',
					  `etitle` char(90) NOT NULL DEFAULT '' COMMENT '英文标题',
					  `description` varchar(250) NOT NULL DEFAULT '' COMMENT '描述',
					  `keywords` char(90) NOT NULL DEFAULT '' COMMENT '关键字',
					  `weizhi` char(50) NOT NULL DEFAULT '' COMMENT '推荐位置',
					  `hits` mediumint(8) NOT NULL DEFAULT '0' COMMENT '点击量',
					  `indexed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否收录',
				      `param` mediumtext NOT NULL COMMENT '高级参数设置',
				      `tag` mediumtext NOT NULL COMMENT 'tag标签',
					 	" . $field_create_sql . "
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ";
				}
				
				$result = dbg_query ( $create_table_sql, FALSE );
				if($result == 1)
				{
					$where_sql = " id =" . $id;
					$field['install'] = 1;
				}
			}
			elseif($action == 'uninstall')
			{
				/* 暂时关闭卸载功能 */
				$result = dbg_query ( ' DROP TABLE ' . $table, FALSE );
				if($result == 1)
				{
					$where_sql = " id =" . $id;
					$field['install'] = 0;
					$field['disable'] = 1;
				}
			}
			$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
			$result = dbg_query ( $sql, FALSE );
			echo $result;
		}
	}
	// @action:删除
	public function delete()
	{
		$id = dbg_input_getpost ( "id" );
		$id = intval ( $id );
		if($id != NULL)
		{
			if($id < 11)
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,基础模型不允许删除!";
			}
			else
			{
				$sql1 = "SELECT dbg_model.id,dbg_model.table FROM dbg_model WHERE dbg_model.id=" . $id;
				$result = dbg_query ( $sql1 );
				$result = $result[0];
				$istable = dbg_query ( "SHOW TABLES LIKE '" . $result['table'] . "'" );
				if(! empty ( $istable ))
				{
					$total = dbg_query ( 'SELECT COUNT(id) AS d FROM ' . $result['table'] );
					$total = ( array ) $total[0];
					if($total[d] > 0)
					{
						$result_json['sql'] = 9;
						$result_json['id'] = $id;
						echo json_encode ( $result_json );
						return;
					}
				}
				$relust_sql = dbg_query ( 'DELETE FROM dbg_model WHERE must!=1 AND id=' . $id, FALSE );
				if($relust_sql == TRUE)
				{
					// 缓存文件~~~~~
					$model_cache = dbg_query ( "SELECT * FROM dbg_model ORDER BY id ASC " );
					$this->parse ( $model_cache );
					$result_json['StatusCode'] = 200;
					$result_json['id'] = $id;
				}
				else
				{
					$result_json['msg'] = "删除失败,数据操作错误";
				}
			}
			echo json_encode ( $result_json );
			return;
		}
		else
		{
			redirect ( $this->admin_data['curr_url'] ); // 返回列表
			exit ();
		}
	}
	// @action: 默认查询列表
	public function index()
	{
		$selete_sql = "SELECT * FROM dbg_model ORDER BY id ASC ";
		$this->admin_data['list'] = dbg_query ( $selete_sql ); // 当前模型内容列表
		$this->load_view ();
	}
	// @action:模型解析
	private function parse($data = NULL)
	{
		// 缓存文件~~~~~
		$data = dbg_query ( "SELECT * FROM dbg_model ORDER BY id ASC " );
		$parse_cache = array();
		foreach($data as $key=>$val)
		{
			// 序列话转数组
			$val['diyfield'] = unserialize ( $val['diyfield'] );
			$val['param'] = unserialize ( $val['param'] );
			$parse_cache[$val['id']] = $val;
			// 标识不为空的话,为解析一个
			$parse_cache[$val['id']]['sql'] = '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM ' . $val['table'] . ' AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ';
			if($val['sign'] == 'company')
			{
				$parse_cache[$val['id']]['sql'] = " SELECT c.*,hcn.name AS hcname,hcs.name AS hsname, hc1.name AS city1,hc2.name AS city2,hc3.name AS city3
					FROM db_company AS c
					LEFT JOIN db_city AS hc1 ON hc1.id = c.city_1
					LEFT JOIN db_city AS hc2 ON hc2.id = c.city_2
			  		LEFT JOIN db_city AS hc3 ON hc3.id = c.city_3
					LEFT JOIN db_company_nature AS hcn ON hcn.cnid = c.cnid
		  			LEFT JOIN db_company_scale AS hcs  ON hcs.csid = c.csid
			  		WHERE c.id";
			}
		}
		dbg_filecontent ( DBG_DATA . 'cache.model.php', $parse_cache, 4 );
	}
	function diyfield($use = NULL)
	{
		$use = 'diyfield';
		$this->diyfield_down ( $use );
	}
	function diyfield_edit($use = NULL)
	{
		$use = 'diyfield_edit';
		$this->diyfield_down ( $use );
	}
	function diyfield_update($use = NULL)
	{
		$use = 'diyfield_update';
		$this->diyfield_down ( $use );
	}
	function diyfield_del($use = NULL)
	{
		// 字段 的 排序
		$use = 'diyfield_del';
		$this->diyfield_down ( $use );
	}
	function diyfield_up($use = NULL)
	{
		$use = 'diyfield_up';
		$this->diyfield_down ( $use );
	}
	function diyfield_down($use = NULL)
	{
		if(empty ( $use ))
		{
			$use = 'diyfield_down';
		}
		
		// 当前模型内容列表
		$id = dbg_input_getpost ( 'id' );
		$model = dbg_query ( "SELECT * FROM dbg_model WHERE id=" . $id );
		$model = $model[0];
		$model_istable = dbg_query ( "SHOW TABLES LIKE '%" . $model['table'] . "%'" );
		$model_istable = dbg_query ( "SHOW TABLES LIKE '%" . $model['table'] . "%'" );
		$diyfields = array();
		if($model['diyfield'] != NULL)
		{ // 不为空的话,解析 序列串
			$diyfields = unserialize ( $model['diyfield'] );
		}
		$fid = dbg_input_getpost ( "fid" );
		$sql = "";
		if($use == 'diyfield_update')
		{
			$where_sql = " id=" . $id;
			$row = array();
			$row['name'] = dbg_input_getpost ( "name" ); // 提示文字
			$row['field'] = dbg_input_getpost ( "field" ); // 字段标识
			$row['disable'] = dbg_input_getpost ( "disable" ); // 是否显示
			$row['type'] = dbg_input_getpost ( "type" ); // 字段类型
			$row['default'] = dbg_input_getpost ( "default" ); // 默认值
			$row['param'] = dbg_input_getpost ( "param" ); // 帮助
			$row['help'] = dbg_input_getpost ( "help" ); // 帮助
			$relationid = dbg_input_getpost ( "relationid" ); // 模型数据关联
			if(! empty ( $relationid ))
			{
				$row['relationid'] = $relationid;
			}
			if(empty ( $row['name'] ) || empty ( $row['field'] ) || empty ( $row['type'] ))
			{
				echo "不能为空!";
				exit ();
			}
			if(preg_match ( "/[\x7f-\xff]/", $row['field'] ))
			{
				echo "字段标识不能含有中文！!";
				exit ();
			}
			if(! preg_match ( "/^[a-zA-Z][a-zA-Z_0-9]/", $row['field'] ))
			{ // /^[a-za-z]{1}([a-zA-Z0-9]|[._]){3,19}$/
				echo "字段标识,请以英文开头";
				exit ();
			}
			// if(! preg_match ( "/^[a-zA-Z][a-zA-Z_0-9]{5,14}/", $row['field'] ))
			// { // /^[a-za-z]{1}([a-zA-Z0-9]|[._]){3,19}$/
			// echo "字段标识,已经存在!";
			// exit ();
			// }
			if($fid != '')
			{
				$uparr = array();
				$row['starfield'] = $diyfields[$fid]['field'];
				$uparr[] = $row;
				array_splice ( $diyfields, $fid, 1, $uparr ); // 删除 并用其它值代替。
				
				if(! empty ( $model_istable ))
				{ // 如果表单存在，更新表单字段
					$updatesql = dbg_field_sql ( 'change', $model['table'], $row );
					dbg_query ( $updatesql, FALSE );
				}
			}
			else
			{ // 末尾添加
				array_push ( $diyfields, $row );
				if(! empty ( $model_istable ))
				{ // 如果表单存在，添加一个字段
					$addsql = dbg_field_sql ( 'add', $model['table'], $row );
					dbg_query ( $addsql, FALSE );
				}
			}
			$field['diyfield'] = serialize ( $diyfields ); // 转序列化
			$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
			$result = dbg_query ( $sql, FALSE );
			if($result)
			{
				$this->parse ();
				echo 1;
			}
		}
		elseif($use == 'diyfield_del' && $fid != '')
		{
			$where_sql = " id=" . $id;
			if($fid != '')
			{
				if(! empty ( $model_istable ))
				{ // 如果表单存在，删除一个字段
					$delsql = dbg_field_sql ( 'drop', $model['table'], $diyfields[$fid] );
					dbg_query ( $delsql, FALSE );
				}
				array_splice ( $diyfields, $fid, 1 ); // 删除1条
			}
			$field['diyfield'] = serialize ( $diyfields ); // 转序列化
			$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
			$resulta = dbg_query ( $sql, FALSE );
			$this->parse ();
			echo $resulta;
		}
		elseif(($use == 'diyfield_down' || $use == 'diyfield_up') && $fid != '')
		{
			$where_sql = " id=" . $id;
			$uparr = array();
			if($use == 'diyfield_up')
			{
				$uparr[] = $diyfields[$fid];
				$uparr[] = $diyfields[$fid - 1];
				array_splice ( $diyfields, ($fid - 1), 2, $uparr ); // 删除 并用其它值代替。
			}
			elseif($use == 'diyfield_down')
			{
				$uparr[] = $diyfields[$fid + 1];
				$uparr[] = $diyfields[$fid];
				array_splice ( $diyfields, $fid, 2, $uparr ); // 删除 并用其它值代替。
			}
			$field['diyfield'] = serialize ( $diyfields ); // 转序列化
			$sql = $this->parse_table_sql ( 'dbg_model', $field, $where_sql );
			$resulta = dbg_query ( $sql, FALSE );
			if($resulta)
			{
				$this->parse ();
				redirect ( $this->admin_data['curr_url'] . '&act=diyfield&id=' . $id );
			}
		}
		else
		{
			$column_model = "SELECT * FROM dbg_model WHERE install=1 ORDER BY id ASC ";
			$this->admin_data['model_list'] = dbg_query ( $column_model ); // 当前模型内容列表
			
			if($use == 'diyfield_edit' && $fid != '')
			{
				$this->admin_data['row'] = $diyfields[$fid];
				$this->admin_data['fid'] = $fid;
			}
			else
			{
				$this->admin_data['list'] = $diyfields;
			}
			$this->admin_data['model_id'] = $id;
			$this->load_view ();
		}
	}
}
