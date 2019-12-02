<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-02-18
 *	module cms 模块
 *	controllers content 内容管理
 */
class CMS_Content extends DbgMs_Admin {
	public $title = 'CMS_内容管理';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'content';
	public $mysql_table = '';
	// 模型
	public $model = NULL;
	public $seo = array(
			'title' => '内容管理' 
	);
	// @action:初始化TODO
	public function initialize($config = array ())
	{
		/* 获取内容模型 */
		$modelid = dbg_input_getpost ( 'modelid' );
		$modelid = isset ( $modelid ) ? intval ( $modelid ) : 1;
		$model = dbg_getModel ( $modelid );
		$this->model = $model;
		// $this->model = CMS_Model::get_model ( $modelid );
		if(! empty ( $this->model ))
		{
			$this->admin_data['model'] = $this->model; /* 当前模型 */
			$this->admin_data['curr_url'] .= empty ( $modelid ) ? '' : '&modelid=' . $modelid;
			$this->admin_data['con_url'] .= empty ( $modelid ) ? '' : '&modelid=' . $modelid;
		}
		$this->admin_data['edit_url'] = $this->admin_data['curr_url'] . '&act=edit&page=' . $page . '&id='; /* 编辑url */
		$this->admin_data['update_url'] = $this->admin_data['curr_url'] . '&act=update'; /* 更新url */
		$this->admin_data['delete_url'] = $this->admin_data['curr_url'] . '&act=delete&id='; /* 删除url */
	}
	// @action:更新缓存 0330TODO
	public function upcache()
	{
		$page = dbg_input_getpost ( 'page' );
		$page = intval ( $page ) >= 1 ? intval ( $page ) : 1; // 当前页数
		$next_page = $page + 1;
		
		$model = $this->model;
		
		$sql_select = 'SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn ';
		
		$sql_from = ' FROM ' . $model['table'] . ' AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id ';
		
		$ids = dbg_input_getpost ( 'ids' );
		$ids = intval ( $ids );
		$ids = isset ( $ids ) ? trim ( $ids ) : '';
		if(! empty ( $ids ))
		{
			// $idary = $ids != '' ? explode ( ',', $ids ) : array();
			$sql_where = '  WHERE c.state>=0 AND c.id IN(' . $ids . ')';
		}
		else
		{
			$sql_where = '  WHERE c.state>=0 ';
		}
		
		$total = dbg_query ( 'SELECT COUNT(c.id) AS d ' . $sql_from . $sql_where );
		if($total[0]['d'] > 0)
		{
			$maxpage = ceil ( $total[0]['d'] / $this->pagesize );
		}
		
		$per = ceil ( 100 * $page / $maxpage );
		
		$sql_limit = " LIMIT " . ($page - 1) * $this->pagesize . "," . $this->pagesize;
		$sql_list = $sql_select . $sql_from . $sql_where . $sql_limit;
		
		$arr = dbg_query ( $sql_list );
		dbgms_ContentParse ( $model['id'], $arr );
		
		$url = $this->admin_data['con_url'] . "&act=upcache&maxpage={$maxpage}&page={$next_page}&ids={$ids}";
		$this->msgboxLoder ( $per, "请等候，正在更新缓存（当前  {$page} 页 / 总  {$maxpage} 页） ", $url );
	}
	// @action: 获取关键词
	public function get_keyword()
	{
		$title = $_POST['title'];
		$content = $_POST['content'];
		$content = strip_tags ( $content );
		$keywords = '';
		if(! empty ( $title ) || ! empty ( $content ))
		{
			dbgms_LoadClass ( 'Http.class.php' );
			$data = Http::doGet ( 'http://keyword.discuz.com/related_kw.html?ics=utf-8&ocs=utf-8&title=' . urlencode ( $title ) . '&content=' . urlencode ( $content ), 10 );
			if(empty ( $data ))
			{
				return;
			}
			preg_match_all ( "/<kw>(.*)A\[(.*)\]\](.*)><\/kw>/", $data, $list, PREG_SET_ORDER );
			if(empty ( $list ))
			{
				return;
			}
			
			foreach($list as $value)
			{
				$keywords .= $value[2] . ',';
			}
		}
		$keyword = substr ( $keywords, 0, - 1 );
		
		if(! empty ( $keyword ))
		{
			$result_json['status'] = 'ok';
			$result_json['data'] = $keyword;
			echo json_encode ( $result_json );
		}
		else
		{
			$result_json['status'] = 'no';
			$result_json['msg'] = '暂时无法获取到关键词！请填写标题和内容，并且提取描述后在进行操作~';
			echo json_encode ( $result_json );
		}
	}
	
	// @action:编辑
	public function edit()
	{
		$this->getpage ();
		$model = $this->model;
		$id = dbg_input_getpost ( 'id' );
		
		if($id != null)
		{
			$sql = 'SELECT c.*,dca2.name AS username,dca.alias AS adminname
				FROM ' . $model['table'] . ' AS c
			 	LEFT JOIN dbg_admin AS dca ON c.adminid = dca.id
				LEFT JOIN dbg_user AS dca2 ON c.authorid = dca2.id
				WHERE c.id=' . $id;
			$row = dbg_query ( $sql );
			$row[0]['param'] = json_decode ( $row[0]['param'] );
			$this->admin_data['row'] = $row[0];
		}
		else
		{
			$row['columnid'] = dbg_input_getpost ( 'columnid' );
			$this->admin_data['row'] = $row;
		}
		if(! empty ( $model['diyfield'] ))
		{
			$this->admin_data['diyfields'] = $model['diyfield'];
		}
                /*start***********************开启多语言处理**********************/
                $this->admin_data['enablelanguage'] = $this->enablelanguage;
                /*end***********************开启多语言处理**********************/
		$this->admin_data['views'] = _DBGMS_MODULES_ . 'cms/views/model_content.php';
		$this->load_view ();
	}
	// @action:删除
	public function delete()
	{
		$model = $this->model;
		$id = dbg_input_getpost ( 'id' );
		if($id != NULL)
		{
			$relust_sql = dbg_query ( 'DELETE FROM ' . $model['table'] . ' WHERE id=' . $id, FALSE );
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
			return;
		}
		else
		{
			redirect ( $this->admin_data['curr_url'] ); // 返回列表
			exit ();
		}
	}
	// @action:更新
	public function update()
	{
		$model = $this->model;
		$id = dbg_input_getpost ( 'id' );
		$where_sql = "";
		
		if($id != null)
		{
			$where_sql = " id =" . $id;
		}
		else
		{
			
			// 这里可以任意格式，因为strtotime函数很强大
			$field['intime'] = dbg_input_getpost ( 'intime' ); // 添加的时间
			
			$is_date = strtotime ( $field['intime'] ) ? strtotime ( $field['intime'] ) : false;
			if($is_date === false)
			{
				exit ( '发布日期格式非法' );
			}
			else
			{
				$field['intime'] = strtotime ( $field['intime'] ); // 只要提交的是合法的日期，这里都统一成2014-11-11格式
			}
			
			$field['hits'] = 0; // 点击量
		}
		
		$field['title'] = dbg_input_getpost ( 'title' ); // 标题
		if(empty ( $field['title'] ))
		{
			echo "标题不能为空!";
			exit ();
		}
                
                /*start***********************开启多语言处理**********************/
                if($this->enablelanguage){
                        $field['etitle'] = dbg_input_getpost ( 'etitle' ); // 标题
                        if(empty ( $field['etitle'] ))
                        {
                                echo "英文标题不能为空!";
                                exit ();
                        }
                }
                /*end***********************开启多语言处理**********************/
                
		$field['adminid'] = dbg_input_getpost ( 'adminid' ); // 责任编辑
		$field['authorid'] = dbg_input_getpost ( 'authorid' ); // 作者
		$field['state'] = dbg_input_getpost ( 'state' ); // 状态
		$field['uptime'] = time (); // 最后修改时间
		$field['description'] = dbg_input_getpost ( 'description' ); // 描述
		$field['keywords'] = dbg_input_getpost ( 'keywords' ); // 关键字
		$field['weizhi'] = dbg_input_getpost ( 'weizhi' ); // 推荐位置
		
		foreach($_POST['param'] as $key=>$value)
		{
			
			// 配置其他信息
			if(is_array ( $value ) && count ( $value ) > 1)
			{
				foreach($value as $pval1)
				{
					$field['param'][$key][] = $pval1;
				}
				// $field['param'][$key] = join ( ',', $value );
			}
			else
			{
				$field['param'][$key] = $value;
			}
		}
		$field['param'] = json_encode ( $field['param'] );
		// 栏目
		$columnid = dbg_input_getpost ( 'columnid' );
		$columnid = intval ( $columnid );
		if(empty ( $columnid ))
		{
			echo "栏目不能为空!";
			exit ();
		}
		$field['columnid'] = dbg_diyfield ( 'update', 'column', NULL, $columnid );
		// 其他自定义字段
		if(! empty ( $model['diyfield'] ))
		{
			foreach($model['diyfield'] as $k=>$val)
			{
				$diydata = "";
				$diydata = dbg_input_getpost ( $val['field'] );
				$field[$val['field']] = dbg_diyfield ( 'update', $val['type'], $val, $diydata );
			}
		}
		$sql = $this->parse_table_sql ( $model['table'], $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		// 写入缓存文件
		if($result == TRUE)
		{
			
			if($id == NULL)
			{ // 获取最后的ID 《mysql_insert_id();
				$id = dbg_db_insert_id ();
			}
			$sql = "SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn
			FROM " . $model['table'] . " AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id WHERE c.id=" . $id;
			$arr = dbg_query ( $sql );
			dbgms_ContentParse ( $model['id'], $arr );
			echo 1;
		}
		else
		{
			echo $result;
		}
	}
	// @action:标识标题唯一性
	public function checkfield()
	{
		$id = isset ( $id ) ? intval ( $id ) : 0;
		$title = isset ( $title ) ? trim ( $title ) : '';
		$catInfo = cattype_gcache ( $cattype );
		$table = '{db}' . $catInfo['table'];
		loadlib ( 'charset.func' );
		$row = false;
		$wsql = '';
		if($title != '')
		{
			$wsql .= " AND (title LIKE '$title' AND state>=0)";
		}
		if($pinyin != '')
		{
			$wsql .= " AND pinyin LIKE '$pinyin'";
		}
		$row = $msql->getone ( "SELECT id FROM `$table` WHERE id!=$id $wsql" );
		if(is_array ( $row ) && $row['id'] != $id)
		{
			if($title != '' && $pinyin != '')
			{
				echo 1;
			}
			elseif($title != '')
			{
				echo 2;
			}
			elseif($pinyin != '')
			{
				echo 3;
			}
		}
		else
		{
			echo 0;
		}
	}
	
	// @action: 列表内容解析
	public function parselist($list)
	{
		$state_array = array(
				0 => '正常发布',
				- 1 => '定时发布',
				- 10 => '内容库',
				- 5 => '待审核',
				3 => '栏目',
				5 => '大头条',
				7 => '短头条_1',
				8 => '短头条_2',
				9 => '黑头条',
				10 => '小头条',
				20 => '首页幻灯banner',
				25 => '滚动',
				30 => '一级推荐',
				35 => '二级推荐',
				40 => '三级推荐',
				45 => '位置一',
				50 => '位置二',
				- 66 => '驳回',
				- 90 => '回收站' 
		);
		foreach($list as $key=>$val)
		{
			// $linkid = num_encode ( $content_list [$i]->id );
			$linkid = $list[$key]['id'];
			
			$list[$key]['link'] = DBG_SITEURL . DBG_SITETYPE . $val['csign'] . '/' . $linkid . '.html';
			
			$list[$key]['statename'] = $state_array[$val['state']];
		}
		return $list;
	}
	// @action: 默认：获取列表
	public function index()
	{
		$model = $this->model;
		$this->getpage ();
		
		$search['id'] = dbg_input_getpost ( 'id' );
		$search['modelid'] = dbg_input_getpost ( 'modelid' );
		$search['modelid'] = empty ( $search['modelid'] ) ? $this->model['id'] : $search['modelid'];
		
		$mysqland = "";
		$pageurl = "";
		$search['qtype'] = dbg_input_getpost ( 'qtype' );
		$search['q'] = $id = dbg_input_getpost ( 'q' );
		
		if(! empty ( $search['qtype'] ) && ! empty ( $search['q'] ) && $search['q'] != '标题、描述、关键词')
		{
			$mysqland .= " AND c.{$search['qtype']} like '%" . $search['q'] . "%'";
			$pageurl .= "&qtype=" . $search['qtype'] . "&q=" . $search['q'];
		}
		
		$search['columnid'] = dbg_input_getpost ( 'columnid' );
		if(! empty ( $search['columnid'] ))
		{
			$mysqland .= ' AND c.columnid = ' . $search['columnid'];
			$pageurl .= "&columnid=" . $search['columnid'];
		}
		
		$search['tlimit'] = dbg_input_getpost ( 'tlimit' );
		if(! empty ( $search['tlimit'] ))
		{
			$mysqland .= " AND DATE_SUB(CURDATE(), INTERVAL {$search['tlimit']} DAY) <= FROM_UNIXTIME(c.intime, '%Y-%m-%d') ";
			$pageurl .= "&tlimit=" . $search['tlimit'];
		}
		
		$search['orderby'] = dbg_input_getpost ( 'orderby' );
		$search['orderby'] = empty ( $search['orderby'] ) ? 'id' : $search['orderby'];
		$pageurl .= "&orderby=" . $search['orderby'];
		
		$search['orderdesc'] = dbg_input_getpost ( 'orderdesc' );
		$search['orderdesc'] = empty ( $search['orderdesc'] ) ? 'DESC' : $search['orderdesc'];
		$pageurl .= "&orderdesc=" . $search['orderdesc'];
		$this->admin_data['search'] = $search;
		
		// 当前内容列表
		$sql_select = "SELECT c.*,dc.name AS cname,dc.sign AS csign,du.name AS username,da.alias AS adminname ";
		$sql_form = "FROM " . $model['table'] . " AS c
			LEFT JOIN dbg_column AS dc ON c.columnid = dc.id
			LEFT JOIN dbg_admin AS da ON c.adminid = da.id
			LEFT JOIN dbg_user AS du ON c.authorid = du.id ";
		$sql_where = " WHERE c.id>0 {$mysqland} ORDER BY c.{$search['orderby']} {$search['orderdesc']} ";
		$sql_limit = " LIMIT " . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$sql_list = $sql_select . $sql_form . $sql_where . $sql_limit;
		
		$content_list = dbg_query ( $sql_list );
		// 当前模型内容总数
		$total = dbg_query ( 'SELECT COUNT(c.id) AS d ' . $sql_form . $sql_where );
		$url = $this->admin_data['curr_url'] . $pageurl . '&page='; // 页脚url
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url ); // 生成页脚exit('asd');
		$this->admin_data['lists'] = $this->parselist ( $content_list );
		// 获取 栏目
		$this->admin_data['views'] = _DBGMS_MODULES_ . 'cms/views/model_content.php';
		$column_lists = include DBG_DATA . 'cache.column.php';
		$column_lists2 = array();
		foreach($column_lists as $val)
		{
			if($val['model'] == $search['modelid'] && $val['column'] == 0)
			{
				$column_lists2[] = $val;
			}
		}
		$this->admin_data['column_list'] = $column_lists2;
		$this->load_view ();
	}
}

