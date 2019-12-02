<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-03-25
 */
class CMS_Column extends DbgMs_Admin {
	public $title = 'CMS_栏目管理';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'column';
	public $mysql_table = 'dbg_column';
        
	public function getpinyin()
	{
		$name = dbg_input_getpost ( 'name' );
		if(! empty ( $name ))
		{
			$sign = dbgms_getPinyin ( $name );
			echo $sign;
		}
	}
	// 默认显示列表
	public function index()
	{
		// 默认显示列表
		$column_model = "SELECT * FROM dbg_model WHERE install=1 ORDER BY id ASC ";
		$selete_sql = "SELECT * FROM dbg_column ORDER BY rank ASC ";
		$this->admin_data['model_list'] = dbg_query ( $column_model ); // 当前模型内容列表
		$column_list = dbg_query ( $selete_sql ); // 当前模型内容列表
		
		$carr = dbg_query ( $selete_sql ); // 当前模型内容列表
		$column_cache = array();
		for($i = 0;$i < count ( $carr );$i ++)
		{
			if($carr[$i]['column'] == 0)
			{
				$row1 = array();
				$row1['id'] = $carr[$i]['id'];
				$row1['name'] = $carr[$i]['name'];
				$row1['sign'] = $carr[$i]['sign'];
				$row1['link'] = $this->admin_data['url'] . DBG_SITETYPE . $carr[$i]['sign'] . '/';
				$column_cache[$carr[$i]['model']][$row1['id']] = $row1;
			}
			else
			{
				$row2 = array();
				$row2['id'] = $carr[$i]['id'];
				$row2['name'] = $carr[$i]['name'];
				$row2['sign'] = $carr[$i]['sign'];
				$row2['link'] = $this->admin_data['url'] . DBG_SITETYPE . $carr[$i]['sign'] . '/';
				$column_cache[$carr[$i]['model']][$carr[$i]['column']]['next'] = $row2;
			}
		}
		
		foreach($column_list as $key=>$val)
		{
			if($val['property'] == 0)
			{
				$column_list[$key]['property_name'] = '频道';
			}
			elseif($val['property'] == 1)
			{
				$column_list[$key]['property_name'] = '列表';
			}
			elseif($val['property'] == 2)
			{
				$column_list[$key]['property_name'] = '内容单页';
			}
			$column_list[$key]['link'] = $this->admin_data['_baseurl'] . DBG_SITETYPE . $val['sign'] . '/';
		}
		$this->admin_data['column_list'] = $column_list;
		// 文件个数
		// tag标签个数
		$this->load_view ();
	}
	public function delete()
	{
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{
			if($id <= 4)
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = '默认栏目,不可删除！';
			}
			else
			{
				// 根据模型获取表名
				$get_table_sql = "SELECT dbg_column.id,dbg_model.table,dbg_model.id
					FROM dbg_column,dbg_model WHERE dbg_model.id = dbg_column.model AND dbg_column.id =" . $id;
				$t = dbg_query ( $get_table_sql );
				$t = $t[0];
				// 根据表名获取栏目相关文章总量
				$get_total_sql = "SELECT dbg_column.id,COUNT(t.columnid) AS d FROM
					 dbg_column," . $t['table'] . " AS t WHERE t.columnid = dbg_column.id
					AND dbg_column.id=" . $id . " GROUP BY t.columnid";
				$total1 = dbg_query ( $get_total_sql );
				$total1 = $total1[0];
				if($total1['d'] > 0)
				{
					$result_json['StatusCode'] = 404;
					$result_json['msg'] = '删除失败,该栏目下有文章！';
				}
				else
				{
					$clist = dbg_query ( "SELECT COUNT(dbg_column.id) AS d FROM dbg_column WHERE dbg_column.column=" . $id );
					$clist = $clist[0];
					if($clist['d'] > 0)
					{
						$result_json['StatusCode'] = 404;
						$result_json['msg'] = '删除失败,该栏目下 有子栏目！';
					}
					else
					{
						$relust_sql = dbg_query ( 'DELETE FROM dbg_column WHERE id=' . $id, FALSE );
						if($relust_sql == TRUE)
						{ // 缓存文件~~~~~
							$this->dbg_column_parse ();
							$result_json['StatusCode'] = 200;
							$result_json['id'] = $id;
						}
					}
				}
			}
			echo json_encode ( $result_json );
			return;
		}
		else
		{
			redirect ( $this->admin_data['con_url'] ); // 返回列表
			exit ();
		}
	}
	// @action:关联
	public function glexpand()
	{
		$columnid = dbg_input_getpost ( 'columnid' );
		
		if(! empty ( $columnid ))
		{
			$column_lists = include DBG_DATA . 'cache.column.php';
			$result_json = $column_lists[$columnid]['expand'];
			echo json_encode ( $result_json );
			exit ();
		}
	}
	// @action:设置
	public function set()
	{
		$mid = isset ( $_GET['mid'] ) ? $_GET['mid'] : 0;
		$this->load_view ();
	}
	// @action:[编辑][v-zhw-20160325]
	public function edit()
	{
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{ // 编辑
			$column_sql = "SELECT dbg_column.* FROM dbg_column WHERE dbg_column.id =" . $id;
			$row = dbg_query ( $column_sql );
			$row[0]['template'] = unserialize ( $row[0]['template'] );
			$row[0]['param'] = unserialize ( $row[0]['param'] );
			$this->admin_data['row'] = $row[0];
		}
		else
		{
			$cid = dbg_input_getpost ( 'cid' );
			$modelid = dbg_input_getpost ( 'modelid' );
			$level = dbg_input_getpost ( 'level' );
			$row['model'] = $modelid;
			$row['column'] = $cid;
			$row['level'] = $level;
			// 默认
			$row['showtype'] = 1;
			$row['property'] = 1;
			$row['disable'] = 0;
			$row['rank'] = 50;
			$row['param']['pages'] = 10;
			$row['icon'] = '###';
			$this->admin_data['row'] = $row;
		}
                /*start***********************开启多语言处理**********************/
                $this->admin_data['enablelanguage'] = $this->enablelanguage;
                /*end***********************开启多语言处理**********************/
		// 模型列表
		$this->admin_data['model_list'] = dbg_query ( "SELECT * FROM dbg_model WHERE install=1 ORDER BY id ASC " );
		// 栏目列表
		$this->admin_data['column_list'] = dbg_query ( "SELECT * FROM dbg_column ORDER BY id ASC " );
		// 模型列表
		$this->admin_data['expand_list'] = dbg_query ( "SELECT * FROM dbg_expand_model ORDER BY id ASC " );
		// 模板列表
		$this->admin_data['template_list'] = dbg_file_list ( 'template', DOMAIN_THEMES_PATH );
		$this->load_view ();
	}
	// @action:[修改\更新][v-zhw-20160327]
	public function update()
	{
		$where_sql = "";
		$searchname = "";
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		$field['column'] = intval ( dbg_input_getpost ( 'column' ) );
		if($id != NULL)
		{ // 编辑状态
			$where_sql = " id =" . $id;
			$searchname = " dbg_column.id !={$id} AND ";
			
			if($field['column'] == $id)
			{
				echo '不能添加到自己栏目下！';
				return;
			}
		}
		else
		{
		}
		// 展示类型： 顶部导航 栏目分类
		$field['model'] = dbg_input_getpost ( 'model' );
		$field['model'] = empty ( $field['model'] ) ? 1 : $field['model'];
		
		if($field['column'] == 0)
		{
			$field['level'] = 1;
		}
		elseif($field['column'] > 0)
		{
			$topcolumn = dbg_query ( "SELECT * FROM dbg_column WHERE dbg_column.id ='" . $field['column'] . "'" );
			if($topcolumn[0]['column'] == 0)
			{
				
				$field['level'] = 2;
			}
			elseif($topcolumn[0]['column'] > 0)
			{
				$topcolumn2 = dbg_query ( "SELECT * FROM dbg_column WHERE dbg_column.id ='" . $topcolumn[0]['column'] . "'" );
				if($topcolumn2[0]['column'] == 0)
				{
					
					$field['level'] = 3;
				}
				elseif($topcolumn2[0]['column'] > 0)
				{
					exit ( '最多三级目录~' );
				}
			}
		}
		$field['name'] = trim ( dbg_input_getpost ( 'name' ) ); // 栏目名字
		$field['sign'] = trim ( dbg_input_getpost ( 'sign' ) ); // 英文标识
                
                /*start***********************开启多语言处理**********************/
                if($this->enablelanguage){
                        $field['ename'] = trim ( dbg_input_getpost ( 'ename' ) ); // 栏目中文名称
                        if(empty ( $field['ename'] ))
                        {
                                echo '栏目 英文名称 不能为空！';
                                return;
                        }
                        $result_name = dbg_query ( "SELECT id FROM dbg_column WHERE " . $searchname . " dbg_column.name ='" . $field['ename'] . "'" );
                        if($result_name)
                        {
                                echo '栏目 英文名称 ,已经存在！';
                                return;
                        }
                        $field['econtent'] = dbg_input_getpost ( 'econtent' );
                }
                /*end***********************开启多语言处理**********************/
		
		if(empty ( $field['name'] ))
		{
			echo '栏目 中文名称 不能为空！';
			return;
		}
		if(empty ( $field['sign'] ))
		{
			echo '栏目 英文标识 不能为空！';
			return;
		}
		$result_name = dbg_query ( "SELECT id FROM dbg_column WHERE " . $searchname . " dbg_column.name ='" . $field['name'] . "'" );
		if($result_name)
		{
			echo '栏目 中文名称 ,已经存在！';
			return;
		}
		// 系统保留的英文标识
		// $default_save_controllers = array();
		// 'so',
		// 'comment',
		// 'zh',
		// 'user',
		// 'zhuanti',
		// 'pages',
		// 'album'
		// if(in_array ( $field['sign'], $default_save_controllers ))
		// {
		// echo '系统保留英文标识,请更换其他！';
		// return;
		// }
		$result_sign = dbg_query ( "SELECT id FROM dbg_column WHERE " . $searchname . " dbg_column.sign ='" . $field['sign'] . "'" );
		if($result_sign)
		{
			echo '栏目英文标识  ,已经存在！';
			return;
		}
		
		// 展示位置： 顶部导航 栏目分类
		$field['showtype'] = dbg_input_getpost ( 'showtype' );
		$field['showtype'] = $field['showtype'] == "" ? 1 : $field['showtype'];
		
		// 显示顺序
		$field['rank'] = dbg_input_getpost ( 'rank' );
		$field['rank'] = empty ( $field['rank'] ) ? 50 : $field['rank'];
		
		// 是否隐藏
		$field['disable'] = dbg_input_getpost ( 'disable' );
		$field['disable'] = empty ( $field['disable'] ) ? 0 : 1;
		
		// 栏目属性： 频道 (频道页不能发布内容) 列表 单页-- 默认列表
		$field['property'] = dbg_input_getpost ( 'property' );
		$field['property'] = $field['property'] == "" ? 1 : $field['property'];
		
		// 频道模板
		$template['channel'] = dbg_input_getpost ( 'template[channel]' );
		$template['channel'] = empty ( $template['channel'] ) ? "channel.php" : $template['channel'];
		// 列表模板
		$template['list'] = dbg_input_getpost ( 'template[list]' );
		$template['list'] = empty ( $template['list'] ) ? "list.php" : $template['list'];
		// 内容模板
		$template['content'] = dbg_input_getpost ( 'template[content]' );
		$template['content'] = empty ( $template['content'] ) ? "content.php" : $template['content'];
		// 转序列化
		$field['template'] = serialize ( $template );
		// 内容
		$field['content'] = dbg_input_getpost ( 'content' );
		if($field['column'] != 0 && empty ( $id ))
		{
			$field['template'] = $topcolumn[0]['template'];
		}
		$field['uptime'] = time ();
		// 图标
		$field['icon'] = dbg_input_getpost ( 'icon' );
		$field['icon'] = $field['icon'] == "" ? "###" : $field['icon'];
		// 配置其他信息
		foreach($_POST['param'] as $key=>$value)
		{
			$field['param'][$key] = $value;
		}
		$field['param'] = serialize ( $field['param'] );
		
		$sql = $this->parse_table_sql ( 'dbg_column', $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		$showtype = dbg_input_getpost ( 'type' );
		if($result == TRUE)
		{
			// 缓存文件~~~~~
			$this->dbg_column_parse ();
			echo 1;
			return;
		}
		else
		{
			echo '添加失败';
			return;
		}
	}
	// @action:更新缓存
	public function upcache()
	{
		// 缓存文件~~~~~
		$this->dbg_column_parse ();
		echo 1;
	}
	
	/*
	 * 解析栏目
	 * 根据传递进来的 栏目,
	 * 传递回去
	 * 他的 子栏目
	 * 他关联的 文章
	 *
	 */
	// @action:[栏目解析][v-zhw-20160325]
	public function dbg_column_parse($columndata = NULL, $navdata = NULL)
	{
		if($columndata == NULL)
		{
			// 缓存文件~~~~~
			$columndata = dbg_query ( "	SELECT c.* FROM dbg_column AS c ORDER BY c.column,c.id ASC  " );
			$navdata = dbg_query ( "SELECT * FROM dbg_column ORDER BY rank ASC " );
		}
		// 解析栏目
		$columns = array();
		foreach($columndata as $key=>$val)
		{
			// 序列话转数组
			$val['template'] = unserialize ( $val['template'] );
			$columns[$val['id']] = $val;
			// 标识不为空的话,为解析一个
			if($val['property'] == 0)
			{ // 频道视图
				$columns[$val['id']]['views'] = $val['template']['channel'];
			}
			elseif($val['property'] == 1)
			{ // 列表视图
				$columns[$val['id']]['views'] = $val['template']['list'];
			}
			elseif($val['property'] == 2)
			{ // 内容视图
				$columns[$val['id']]['views'] = $val['template']['content'];
				
				$row = array();
				$row['title'] = $val['name'];
				if(empty ( $val['uptime'] ))
				{
					$val['uptime'] = time ();
				}
				$row['intime'] = $row['uptime'] = $val['uptime'];
				$row['content'] = $val['content'];
				$columns[$val['id']]['content'] = $row;
			}
			
			$columns[$val['id']]['clists'] = $val['id'];
			/* 二级目录 */
			// 父栏目不为空的时候,插入的到栏目下
			if($val['column'] != 0)
			{
				$row = array();
				$row['id'] = $val['id'];
				$row['name'] = $val['name'];
				$row['sign'] = $val['sign'];
				$row['rank'] = $val['rank'];
				$row['icon'] = $val['icon'];
				$row['property'] = $val['property'];
                                /*start***********************开启多语言处理**********************/
                                if($this->enablelanguage){
                                        $row['ename'] = $val['ename'] ? $val['ename'] : $val['name'];
                                }
                                /*end***********************开启多语言处理**********************/
				$row['link'] = DBG_SITEURL . DBG_SITETYPE . $val['sign'] . '/';
				$row['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $val['sign'] . '/';
				
				$columns[$val['column']]['list'][] = $row;
				$columns[$val['column']]['clists'] .= ',' . $val['id'];
				$columns[$val['column']]['clists2'][] = $val['id'];
				$columns[$val['column']]['list'] = dbg_sort ( $columns[$val['column']]['list'], 'rank' );
				
				$parent = array();
				$parent['id'] = array();
				$parent[''] = array();
			}
			$columns[$val['id']]['param'] = unserialize ( $val['param'] );
			// 是否开始seourl
			if($columns[$val['id']]['param']['seourl'] == 1)
			{
				$columns[$val['id']]['link'] = DBG_SITEURL . $val['sign'] . '/';
				$columns[$val['id']]['mlink'] = DBG_MOBILEURL . $val['sign'] . '/';
			}
			else
			{
				$columns[$val['id']]['link'] = DBG_SITEURL . DBG_SITETYPE . $val['sign'] . '/';
				$columns[$val['id']]['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $val['sign'] . '/';
			}
			// 是否开始seourl
			if($columns[$val['id']]['param']['expand'] != 0)
			{
				$expandid = $columns[$val['id']]['param']['expand'];
				$expand_arr = dbg_query ( "SELECT * FROM dbg_expand_model_field WHERE expandid=" . $expandid );
				
				foreach($expand_arr as $expval1)
				{
					$expand_row = array();
					$expand_row['id'] = $expval1['id'];
					$expand_row['title'] = $expval1['title'];
					$expand_row['sign'] = $expval1['sign'];
					$expand_row['type'] = $expval1['type'];
                    $expand_row['icon'] = $expval1['icon'];
                                        /*start***********************开启多语言处理**********************/
                                        if($this->enablelanguage){
                                                $expand_row['ename'] = $expval1['ename'] ? $expval1['ename'] : $expval1['name'];
                                        }
                                        /*end***********************开启多语言处理**********************/
					$expand_row['link'] = 'expand=' . $expandid . '&esign=' . $expval1['sign'];
					
					$lists1 = array();
					$expval1['config'] = trim ( $expval1['config'] );
					$lists1 = explode ( "\n", $expval1['config'] );
					if(! empty ( $lists1 ))
					{
						foreach($lists1 as $expval2)
						{
							$expval2 = trim ( $expval2 );
							if(! empty ( $expval2 ))
							{
								$new_row = array();
								$new_row = explode ( "|", $expval2 );
								$new_row2 = array();
								$new_row2['title'] = trim ( $new_row[0] );
								$new_row2['sign'] = trim ( $new_row[1] );
								$new_row2['link'] = $expand_row['link'] . '&evalue=' . $new_row2['sign'];
								
								$expand_row['list'][] = $new_row2;
							}
						}
					}
					
					$columns_expand[] = $expand_row;
				}
				
				$columns[$val['id']]['expand'] = $columns_expand;
			}
			
			// 去除重复的
			// foreach ( $data as $key => $val )
			// {
			// $columns [$val ['id']] = $val;
			// unset ( $data );
			// }
			// $columns [$val ['column']] ['list'] = array_unique ( $columns [$val ['column']] ['list'] );
		}
		
		/* 三级目录 */
		foreach($columns as $key=>$val)
		{
			// 父栏目不为空的时候,插入的到栏目下
			if($val['column'] != 0)
			{
				foreach($columns as $key2=>$val2)
				{ // 子栏目不为空的话
					if(! empty ( $val2['list'] ))
					{
						foreach($val2['list'] as $key3=>$val3)
						{ // 子栏目不为空的话
							if($val3['id'] == $val['column'])
							{
								$row = array();
								$row['id'] = $val['id'];
								$row['name'] = $val['name'];
								$row['sign'] = $val['sign'];
								$row['rank'] = $val['rank'];
                                                                /*start***********************开启多语言处理**********************/
                                                                if($this->enablelanguage){
                                                                        $row['ename'] = $val['ename'] ? $val['ename'] : $val['name'];
                                                                }
                                                                /*end***********************开启多语言处理**********************/
								$row['property'] = $val['property'];
								$row['link'] = DBG_SITEURL . DBG_SITETYPE . $val['sign'] . '/';
								$row['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $val['sign'] . '/';
								$columns[$val2['id']]['list'][$key3]['list'][] = $row;
							}
						}
					}
				}
			}
		}
		// 检索父类
		foreach($columns as $key=>$val)
		{
			if(! empty ( $val['list'] ))
			{
				foreach($val['list'] as $key2=>$val2)
				{
					$parent = array();
					$parent['id'] = $val['id'];
					$parent['name'] = $val['name'];
                                        /*start***********************开启多语言处理**********************/
                                        if($this->enablelanguage){
                                                $parent['ename'] = $val['ename'] ? $val['ename'] : $val['name'];
                                        }
                                        /*end***********************开启多语言处理**********************/
					$parent['sign'] = $val['sign'];
					$parent['rank'] = $val['rank'];
					$parent['link'] = DBG_SITEURL . DBG_SITETYPE . $val['sign'] . '/';
					$parent['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $val['sign'] . '/';
					$columns[$val2['id']]['parent'][$val['id']] = $parent;
					if(! empty ( $val2['list'] ))
					{
						foreach($val2['list'] as $key3=>$val3)
						{
							$parent2 = array();
							$parent2['id'] = $val2['id'];
							$parent2['name'] = $val2['name'];
                                                        /*start***********************开启多语言处理**********************/
                                                        if($this->enablelanguage){
                                                                $parent2['ename'] = $val2['ename'] ? $val2['ename'] : $val2['name'];
                                                        }
                                                        /*end***********************开启多语言处理**********************/
							$parent2['sign'] = $val2['sign'];
							$parent2['rank'] = $val2['rank'];
							$parent2['link'] = DBG_SITEURL . DBG_SITETYPE . $val2['sign'] . '/';
							$parent2['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $val2['sign'] . '/';
							$columns[$val3['id']]['parent'][$val['id']] = $parent;
							$columns[$val3['id']]['parent'][$val2['id']] = $parent2;
						}
					}
				}
			}
		}
		// 去重复
		// foreach($columns as $key=>$val)
		// {
		// if(! empty ( $val['parent'] ))
		// {
		
		// $result = array();
		// for($i = 0;$i < count ( $val['parent'] );$i ++)
		// {
		// $source = $val['parent'][$i];
		// if(array_search ( $source, $val['parent'] ) == $i && $source != "")
		// {
		// $result[] = $source;
		// }
		// }
		// $columns[$key]['parent'] = $result;
		// }
		// }
		
		dbg_filecontent ( DBG_DATA . 'cache.column.php', $columns, 4 );
		
		/*
		 * 解析导航
		 * 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
		 */
		$navs = array();
		foreach($navdata as $navkey=>$nav_level1)
		{
			$navone = array();
			$navone['id'] = $nav_level1['id'];
			$navone['name'] = $nav_level1['name'];
			$navone['sign'] = $nav_level1['sign'];
			$navone['model'] = $nav_level1['model'];
			$navone['icon'] = $nav_level1['icon'];
                        /*start***********************开启多语言处理**********************/
                        if($this->enablelanguage){
                                $navone['ename'] = $nav_level1['ename'];
                        }
                        /*end***********************开启多语言处理**********************/
			$navone['link'] = DBG_SITEURL . DBG_SITETYPE . $nav_level1['sign'] . '/';
			$navone['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $nav_level1['sign'] . '/';
			$nav_level1param = unserialize ( $nav_level1['param'] );
			// 顶部导航
			if($nav_level1['showtype'] == 0)
			{
				// 是否开始seourl
				if($nav_level1param['seourl'] == 1)
				{ // 添加文件
					$this->dbg_column_seo ( 'add', $nav_level1['sign'] );
					$nav_level1['link'] = DBG_SITEURL . $nav_level1['sign'] . '/';
					$nav_level1['mlink'] = DBG_MOBILEURL . $nav_level1['sign'] . '/';
				}
				else
				{ // 删除文件
					$this->dbg_column_seo ( 'del', $nav_level1['sign'] );
					$nav_level1['link'] = DBG_SITEURL . DBG_SITETYPE . $nav_level1['sign'] . '/';
					$nav_level1['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $nav_level1['sign'] . '/';
				}
				
				// 普通分类
				foreach($navdata as $ckey=>$nav_level2)
				{
					$nav_level2param = unserialize ( $nav_level2['param'] );
					if($nav_level2['disable'] == 1)
					{
						continue;
					}
					if($nav_level2['column'] == $nav_level1['id'])
					{
						$row = array();
						$row['id'] = $nav_level2['id'];
						$row['name'] = $nav_level2['name'];
						$row['sign'] = $nav_level2['sign'];
						$row['model'] = $nav_level2['model'];
						$row['icon'] = $nav_level2['icon'];
                                                /*start***********************开启多语言处理**********************/
                                                if($this->enablelanguage){
                                                        $row['ename'] = $nav_level2['ename'];
                                                }
                                                /*end***********************开启多语言处理**********************/
						// 是否开始seourl
						if($nav_level2param['seourl'] == 1)
						{
							// 添加文件
							$this->dbg_column_seo ( 'add', $nav_level2['sign'] );
							$row['link'] = DBG_SITEURL . $nav_level2['sign'] . '/';
							$row['mlink'] = DBG_MOBILEURL . $nav_level2['sign'] . '/';
						}
						else
						{ // 删除文件
							$this->dbg_column_seo ( 'del', $nav_level2['sign'] );
							$row['link'] = DBG_SITEURL . DBG_SITETYPE . $nav_level2['sign'] . '/';
							$row['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $nav_level2['sign'] . '/';
						}
						
						$navone['list'][] = $row;
					}
				}
				$navs[] = $navone;
			}
		}
		/* 三级目录 */
		foreach($navdata as $key=>$val)
		{
			// 父栏目不为空的时候,插入的到栏目下
			if($val['column'] != 0)
			{
				foreach($navs as $key2=>$val2)
				{ // 子栏目不为空的话
					if(! empty ( $val2['list'] ))
					{
						foreach($val2['list'] as $key3=>$val3)
						{ // 子栏目不为空的话
							if($val3['id'] == $val['column'])
							{
								$row = array();
								$row['id'] = $val['id'];
								$row['name'] = $val['name'];
								$row['sign'] = $val['sign'];
								$row['model'] = $val['model'];
								$row['icon'] = $val['icon'];
                                                                /*start***********************开启多语言处理**********************/
                                                                if($this->enablelanguage){
                                                                        $row['ename'] = $val['ename'];
                                                                }
                                                                /*end***********************开启多语言处理**********************/
								$row['link'] = DBG_SITEURL . DBG_SITETYPE . $val['sign'] . '/';
								$row['mlink'] = DBG_MOBILEURL . DBG_SITETYPE . $val['sign'] . '/';
								$navs[$key2]['list'][$key3]['list'][] = $row;
							}
						}
					}
				}
			}
		}
		dbg_filecontent ( DBG_DATA . 'cache.nav.php', $navs, 4 );
	}
	// @action:针对 去zh的
	public function dbg_column_seo()
	{
	}
}

