<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
// $controllers = DbgMs::getInstance ();
// $model = CMS_Model::get_model ( $modelid );
// dbg基础控制器类
abstract class DbgMs {
	// CodeIgniter 框架下的 控制器、session、cookie
	public $ci_controllesr = 'user';
	public $ci_session = 'dbg_user';
	public $ci_cookie = NULL;
	
	// ThinkPhp框架下的 控制器、session、cookie
	public $tp_controllesr = NULL;
	public $tp_session = NULL;
	public $tp_cookie = NULL;
	
	// dbgms系统 - 模块m(modules)-控制器c(controllers)-意图a(action)
	public $dbgms_m = 'core'; //
	public $dbgms_c = 'core';
	
	// 数据库字段
	// public $field_id = null;
	// public $field_name = null;
	// public $field_icon = null;
	// public $field_disable = null;
	// public $field_sendpm = null;
	// public $field_homeact = null;
	// public $field_cmsact = null;
	// public $field_toolact = null;
	// public $field_crmact = NULL;
	public $show_view = 'dbgms';
	public $views = NULL;
	public $act = NULL;
	public $use = NULL;
	public $admin_data = array();
	public $page = 1;
	// 保存类实例的静态成员变量
	private static $_instance;
	// private标记的构造方法
	// 构造函数
	public function __construct($config = array ())
	{
		// foreach遍历 初始化属性
		if(! empty ( $config ))
		{
			foreach($config as $key=>$val)
			{
				if(property_exists ( $this, $key ))
				{ // 属性是否存在
					$this->$key = $val;
				}
			}
		}
		else
		{
			foreach($this->admin_data as $key=>$val)
			{
				if(property_exists ( $this, $key ))
				{ // 属性是否存在
					$this->$key = $val;
				}
			}
		}
	}
	public function _remap($method, $params = array())
	{
	}
	// 创建__clone方法防止对象被复制克隆
	public function __clone()
	{
		trigger_error ( 'Clone is not allow!', E_USER_ERROR );
	}
	// 单例方法,用于访问实例的公共的静态方法
	public static function getInstance()
	{
		if(! (self::$_instance instanceof self))
		{
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
	// @action:写入缓存
	public function set_filecache()
	{
	}
	// @action: 分页
	public function pagebreak($currentPage, $total, $pageSize, $url, $style = NULL)
	{
		/* style风格样式 */
		if($style == NULL)
		{
			$style = '<style type="text/css">
    div.zhw_htmlpage{text-align: center;padding:30px 10px;height: 36px; overflow: hidden;}
	div.zhw_htmlpage a{border:1px solid #e4e4e4; font-family:"Tahoma","Arial"; font-size:14px; height:30px; line-height: 30px; padding:0 12px; margin-left: 2px; display: inline-block; overflow: hidden; background: #FFF; color:#6a6a6a}
	div.zhw_htmlpage a:hover{background:#0666c5;color:#FFF;text-decoration:none}
	div.zhw_htmlpage a.on{background:#6e2685;color:#FFF}
	div.zhw_htmlpage input.gopage{width:30px;position:relative;top:-11px;font-size:14px;height:30px;line-height:30px;margin-left:2px;display: inline-block; overflow: hidden;}</style>';
		}
		/* javascript设置选中 */
		$javascript = "<script type=\"text/javascript\">var zhw_htmlpagea =document.getElementById('page" . $currentPage . "');if(zhw_htmlpagea!=undefined){zhw_htmlpagea.setAttribute('class','on');}</script>";
		// $javascript = "<script type=\"text/javascript\">$(function(){ $('#page" . $currentPage . "').addClass('on');});</script>";
		$pagetotal = ceil ( $total / $pageSize ); // 向上取整,算出分页
		$paging = '<div class="zhw_htmlpage">';
		if($pagetotal == 1)
		{
			$paging .= '<a id="page1" href=" ' . $url . '1" >1</a>';
		}
		else
		{
			// 开头部分,是否显示上一页
			if(($currentPage - 3) > 1)
			{
				$paging .= '<a id="page1" href=" ' . $url . '1" >1...</a>
				<a  href=" ' . $url . ($currentPage - 1) . '" class="next">上一页</a>';
			}
			// 中间部分,输出7个分页
			for($i = $currentPage - 3;$i < $currentPage + 4;$i ++)
			{
				if($i < 1 || $i > $pagetotal)
				{
					continue;
				}
				$paging .= '<a id="page' . $i . '" href=" ' . $url . $i . '">' . $i . '</a>';
			}
			// 结尾部分,是否显示下一页
			if(($currentPage + 4) <= $pagetotal)
			{
				$paging .= '<a href=" ' . $url . ($currentPage + 1) . '" class="next">下一页</a>
						<a id="page' . $pagetotal . '" href="' . $url . $pagetotal . '">...' . $pagetotal . '</a>';
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