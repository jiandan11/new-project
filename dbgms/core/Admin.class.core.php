<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
class DbgMs_Admin {
	// 当前 模块modules
	public $modules = 'base';
	// 当前 控制器 controllers
	public $con = 'record';
	public $act = '';
	public $page = 1;
	public $pagesize = 8;
	public $admin_view = 'dbgms';
	public $admin_data = array();
	public $_admin = array();
        //开启多语言 中英文设置开关 0关闭 1开启
        public $enablelanguage = 0;
	
	// @action: 构造函数
	public function __construct($data, $jumpgroup = FALSE)
	{
		$this->admin_data = $data;
		$this->admin_data['mod'] = $this->modules;
		$this->admin_data['mod_url'] = site_url () . '/index/' . $this->modules;
		$this->admin_data['con'] = $this->con;
		$this->admin_data['con_url'] = $this->admin_data['mod_url'] . '?con=' . $this->con;
		$this->admin_data['edit_url'] = $this->admin_data['con_url'] . '&act=edit';
		$this->admin_data['update_url'] = $this->admin_data['con_url'] . '&act=update';
        $this->admin_data['add_url'] = $this->admin_data['con_url'] . '&act=add';
		$this->admin_data['delete_url'] = $this->admin_data['con_url'] . '&act=delete&id=';
		$this->admin_data['curr_url'] = $this->admin_data['mod_url'] . '?con=' . $this->con;
		$this->admin_data['con_title'] = $this->title;
		$this->act = $this->admin_data['act'];
                
                $rtn = dbg_domain_website_get();
                $this->enablelanguage = $rtn['base']['enablelanguage'];
		
		$this->group ( $jumpgroup );
		$this->initialize ();
		// foreach遍历 初始化属性
		// if(! empty ( $config ))
		// {
		// foreach($config as $key=>$val)
		// {
		// $this->$key = $val;
		// }
		// }
		// else
		// {
		// foreach($this->admin_data as $key=>$val)
		// {
		// $this->$key = $val;
		// }
		// }
	}
	public function _remap($method, $params = array())
	{
	}
	// @action:进度条 20160330
	public function msgboxLoder($loader = 0, $msg = '', $url = '', $extra = '')
	{
		$this->admin_data['ts'] = '<div class="loader"><div><b style="width:' . $loader . '%"></b></div><span>' . $loader . '%</span></div>';
		if($msg != '')
		{
			$this->admin_data['ts'] .= '<div class="loaderp">' . $msg . '</div>';
		}
		$this->admin_data['title'] = '提示信息：更新缓存_DbgMs';
		if(empty ( $this->admin_data['ts'] ))
		{
			$this->admin_data['ts'] = '提示信息';
		}
		if(empty ( $url ))
		{
			$this->admin_data['url'] = '-1';
		}
		if(empty ( $stime ))
		{
			$this->admin_data['stime'] = 1000;
		}
		if(empty ( $extra ))
		{
			$this->admin_data['extra'] = '';
		}
		if($loader > 100)
		{
			$this->admin_data['stime'] = 3000;
			$this->admin_data['ts'] = "列表更新完毕~3秒后返回!";
			$this->admin_data['url_back'] = $this->admin_data['con_url'];
		}
		else
		{
			$this->admin_data['url_back'] = $url;
			if($url && $url != '-1')
			{
				$this->admin_data['url_back'] = $url;
			}
		}
		// $this->admin_data['views'] = _DBGMS_CORE_ . 'views/upcache.php';
		$this->admin_data['views'] = _DBGMS_CORE_ . 'views/msgbox.php';
		$this->load_view ();
	}
	// @action: 判断权限问题
	public function group($jumpgroup = FALSE)
	{
		if($jumpgroup == TRUE)
		{
			return;
		}
		$this->_admin = $_SESSION['dbgms_admin'];
		
		if(empty ( $this->_admin ))
		{
			echo '未登录';
			exit ();
		}
		if($this->_admin['groupid'] != 1)
		{
			$admin_menu = unserialize ( $this->_admin['menu'] );
			if($admin_menu[$this->modules . '_' . $this->con] != 1)
			{
				exit ( '您无权访问操作此功能！' );
			}
		}
		$this->admin_data['_admin'] = $this->_admin;
		
		if($this->act == 'update' || $this->act == 'delete')
		{
			$dbgms_module_menu = require _DBGMS_MODULES_ . $this->modules . '/menu.php';
			$field['content'] = $this->_admin['name'] . '操作<br>' . $dbgms_module_menu['modules'] . '系统-';
			if(! empty ( $dbgms_module_menu ))
			{
				foreach($dbgms_module_menu['controllers'] as $val)
				{
					if($val['con'] == $this->con)
					{
						$field['content'] .= $val['name'];
					}
				}
			}
			$id = dbg_input_getpost ( 'id' );
			$id = intval ( $id );
			$modelid = dbg_input_getpost ( 'modelid' );
			$modelid = intval ( $modelid );
			switch($this->act)
			{
				case 'update':
					$field['type'] = 2;
					$field['content'] .= '-更新update';
					break;
				case 'delete':
					$field['type'] = 3;
					$field['content'] .= '-删除delete';
					break;
			}
			if(! empty ( $id ))
			{
				$field['content'] .= '-Id为【' . $id . '】';
			}
			if(! empty ( $modelid ))
			{
				$field['content'] .= '-模型Id【' . $modelid . '】';
			}
			$field['ip'] = dbgms_IpGet (); /* 操作ip */
			if($field['ip'] == '127.0.0.1')
			{
				return; /* 本地跳出 */
			}
			$field['adminid'] = $this->_admin['id'];
			$field['intime'] = time ();
			
			$sqllog = $this->parse_table_sql ( 'dbg_admin_log', $field );
			dbg_query ( $sqllog, FALSE );
		}
	}
	// @action:
	public function initialize()
	{
	}
	
	// @action:通用 ajax返回json
	public function ajaxreturn($msg, $StatusCode, $dataType = 'text')
	{
		if($dataType == 'json')
		{
			echo json_encode ( array(
					'StatusCode' => $StatusCode,
					'msg' => $msg 
			) );
			exit ();
		}
		elseif($dataType == 'text')
		{
			return $msg;
		}
	}
	// @action:通用 ajax返回json
	public function msg($msg, $title = NULL, $dataType = 'text')
	{
		if(empty ( $title ))
		{
			$title = '系统提示';
		}
		$errormsg = ' <br><br>【类型】：' . $title . ' <br><br>';
		$errormsg .= '【说明】：' . $msg;
		exit ( $errormsg );
	}
	// @action:加载视图
	public function load_view($isreturn = NULL)
	{
		if(! empty ( $isreturn ))
		{
			return dbgms_LoadViews ( $this->admin_view, $this->admin_data, TRUE );
		}
		else
		{
			dbgms_LoadViews ( $this->admin_view, $this->admin_data );
		}
	}
	// @action:获取当前页
	public function getpage($name = 'page')
	{
		$page = dbg_input_getpost ( 'page' );
		$page = intval ( $page );
		$this->page = empty ( $page ) ? 1 : $page;
		$this->admin_data['page'] = $this->page;
	}
	// @action:获取当前查询
	public function search($config = 'page', $search_url)
	{
		if(! empty ( $config['like'] ))
		{
			// 判断查询 like
			$config['like']['qtype'] = dbg_input_getpost ( 'qtype' );
			$config['like']['q'] = $id = dbg_input_getpost ( 'q' );
			
			if(! empty ( $config['like']['qtype'] ) && ! empty ( $config['like']['q'] ) && $config['like']['q'] != '标题、描述、关键词')
			{
				$mysqland .= " AND c.{$search['qtype']} like '%" . $search['q'] . "%'";
				$pageurl .= "&qtype=" . $search['qtype'] . "&q=" . $search['q'];
			}
		}
		// $config['like']['qtype']
		// $config['like']['q']=
		
		$config['like']['qtype'] = 'name';
		$config['like']['q'] = '账号、昵称、邮箱';
		
		$config['and']['groupid'] = 'name';
		
		$page = dbg_input_getpost ( 'page' );
		$page = intval ( $page );
		$this->page = empty ( $page ) ? 1 : intval ( $page );
		
		$search_url .= '&';
	}
	// @action: 分页
	public function pagebreak($currentPage, $total, $pageSize, $url, $style = NULL)
	{
		/* style风格样式 */
		if($style == NULL)
		{
			$style = '<style type="text/css">
    div.dbgms_pagebreak{text-align: center;padding:30px 10px;height: 36px; overflow: hidden;}
	div.dbgms_pagebreak a{border:1px solid #e4e4e4; font-family:"Tahoma","Arial"; font-size:14px; height:30px; line-height: 30px; padding:0 12px; margin-left: 2px; display: inline-block; overflow: hidden; background: #FFF; color:#6a6a6a}
	div.dbgms_pagebreak a:hover{background:#0666c5;color:#FFF;text-decoration:none}
	div.dbgms_pagebreak a.on{background:#6e2685;color:#FFF}
	div.dbgms_pagebreak input.gopage{width:30px;position:relative;top:-11px;font-size:14px;height:30px;line-height:30px;margin-left:2px;display: inline-block; overflow: hidden;}</style>';
		}
		/* javascript设置选中 */
		$javascript = "<script type=\"text/javascript\">var dbgms_pagebreak =document.getElementById('page" . $currentPage . "');if(dbgms_pagebreak!=undefined){dbgms_pagebreak.setAttribute('class','on');}</script>";
		// $javascript = "<script type=\"text/javascript\">$(function(){ $('#page" . $currentPage . "').addClass('on');});</script>";
		$pagetotal = ceil ( $total / $pageSize ); // 向上取整,算出分页
		$paging = '<div class="dbgms_pagebreak">';
		if($pagetotal == 1)
		{
			$paging .= '<a id="page1" rel="1" href=" ' . $url . '1" >1</a>';
		}
		else
		{
			// 开头部分,是否显示上一页
			if(($currentPage - 3) > 1)
			{
				$paging .= '<a id="page1" rel="1" href=" ' . $url . '1" >1...</a>
				<a  href=" ' . $url . ($currentPage - 1) . '"  rel="' . ($currentPage - 1) . '" class="next">上一页</a>';
			}
			// 中间部分,输出7个分页
			for($i = $currentPage - 3;$i < $currentPage + 4;$i ++)
			{
				if($i < 1 || $i > $pagetotal)
				{
					continue;
				}
				$paging .= '<a id="page' . $i . '" rel="' . $i . '" href=" ' . $url . $i . '">' . $i . '</a>';
			}
			// 结尾部分,是否显示下一页
			if(($currentPage + 4) <= $pagetotal)
			{
				$paging .= '<a href=" ' . $url . ($currentPage + 1) . '" rel="' . ($currentPage + 1) . '" class="next">下一页</a>
						<a id="page' . $pagetotal . '" rel="' . $pagetotal . '" href="' . $url . $pagetotal . '">...' . $pagetotal . '</a>';
			}
		}
		// 是否开启跳转
		$pagego = '<input type="text" class="gopage" maxlength="3"/><a href="javascript:goPage(' . htmltostr ( $indexurl ) . ');">GO</a>';
		$paging .= "<br/>(总共" . $total . "条记录 )</div>";
		return $style . $paging . $javascript;
	}
	// @action:解析表单sql语句，更新update，或插入insert
	public function parse_table_sql($table = '', $data = array(), $where_sql = '')
	{
		if($table == '' || ! is_array ( $data ))
		{
			return '';
		}
		if($where_sql != '')
		{
			$field_update = '';
			foreach($data as $k=>$v)
			{
				$field_update .= ($field_update == '' ? '' : ',') . "`$k`='$v'";
			}
			$sql = "UPDATE `$table` SET $field_update WHERE $where_sql;";
		}
		else
		{
			$field_key = $field_val = '';
			foreach($data as $k=>$v)
			{
				$field_key .= ($field_key == '' ? '' : ',') . "`$k`";
				$field_val .= ($field_val == '' ? '' : ',') . "'$v'";
			}
			if($field_key != '' && $field_val != '')
			{
				$sql = "INSERT INTO `$table` ($field_key) VALUES ($field_val)";
			}
		}
		return $sql;
	}
}