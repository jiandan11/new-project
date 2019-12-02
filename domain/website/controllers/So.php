<?php
if(! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class So extends CI_Controller {
	public function __construct()
	{
		parent::__construct ();
        $this->load->library('session');
		$this->load->helper ( 'url' );
		date_default_timezone_set ( 'Asia/Shanghai' );
		error_reporting ( 0 );
	}
	// 允许index传参
	// function _remap($method, $params = array())
	// {
	// if(method_exists ( $this, $method ))
	// {
	// return call_user_func_array ( array(
	// $this,
	// $method
	// ), $params );
	// }
	// else
	// {
	// $arr1stParam = array(
	// $method
	// );
	// $params = array_merge ( $arr1stParam, $params );
	// call_user_func_array ( array(
	// $this,
	// 'index'
	// ), $params );
	// }
	// }
	public function index()
	{
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'website_common.php');
		/***其他标签***/
		$columnid = $this->input->get_post ( 'columnid' );
		
		$columnid = empty ( $columnid ) ? 1 : $columnid;
		$so_keyword = $this->input->get_post ( 'keyword' );
		$so_keyword = trim ( $so_keyword );
		// 转义 addslashes//反转移 stripslashes
		$so_keyword = addslashes ( $so_keyword );
		
		$so_column = getColumn ( NULL, $columnid );
		$so_model = dbg_getModel ( $so_column['model'] );
		
		// $so_list_sql = "SELECT c.id,c.title,c.intime,c.columnid FROM {$so_model[0]['table']} AS c
		// WHERE c.title LIKE '%{$so_keyword}%'
		// OR c.keywords LIKE '%{$so_keyword}%'
		// OR c.description LIKE '%{$so_keyword}%' AND c.columnid ={$so_column['id']}";
		// $so_list = dbg_query ( $so_list_sql );
		
		// $so_list_sql = "model|{$so_column['model']};nostate|20;cid|{$so_column['id']};sort|id;sorttype=desc;wsql|{$wsql}";
		if(! empty ( $so_keyword ))
		{
			$all_model = dbg_getModel ();
			$so_all_list = array();
			foreach($all_model as $val)
			{
				if($val['install'] == 1 && $val['disable'] == 0)
				{
					
					$wsql = "  c.title LIKE '%{$so_keyword}%'
                OR c.etitle LIKE '%{$so_keyword}%'
                OR c.content LIKE '%{$so_keyword}%' 
                OR c.econtent LIKE '%{$so_keyword}%' 
				OR c.keywords LIKE '%{$so_keyword}%'
				OR c.description LIKE '%{$so_keyword}%' ";
					$so_list_sql = "model|{$val['id']};nostate|20;sort|id;sorttype=desc;wsql|{$wsql}";
					$so_list = getLists ( $val['id'], $so_list_sql );
					
					$so_all_list[]['list'] = $so_list;
				}
			}
			if(! empty ( $so_all_list ))
			{
				foreach($so_all_list as $key1=>$val1)
				{
					if(! empty ( $so_all_list[$key1]['list'] ))
					{
						foreach($so_all_list[$key1]['list'] as $key2=>$val2)
						{
							$website['_so_list'][] = $val2;
						}
					}
				}
			}
		}
		require (_DBGMS_ . 'website.php');
		$website['_column'] = 'solistphp';
		$website['tep_path'] = '_so_list.php';
		if(! empty ( $so_keyword ))
		{
			$website['keyword'] = $so_keyword;
			$website['act'] = 'result';
		}
		$this->load->view ( 'search.php', $website );
	}
	// 简单搜索功能
	public function json($model = 1)
	{
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'website_common.php');
		/***其他标签***/
		$columnid = $this->input->get_post ( 'columnid' );
		$columnid = empty ( $columnid ) ? 1 : $columnid;
		$so_keyword = $this->input->get_post ( 'keyword' );
		$so_column = getColumn ( NULL, $columnid );

		$so_model = dbg_getModel ( $so_column['model'] );

		// $so_list_sql = "SELECT c.id,c.title,c.intime,c.columnid FROM {$so_model[0]['table']} AS c
		// WHERE c.title LIKE '%{$so_keyword}%'
		// OR c.keywords LIKE '%{$so_keyword}%'
		// OR c.description LIKE '%{$so_keyword}%' AND c.columnid ={$so_column['id']}";
		// $so_list = dbg_query ( $so_list_sql );

		// $so_list_sql = "model|{$so_column['model']};nostate|20;cid|{$so_column['id']};sort|id;sorttype=desc;wsql|{$wsql}";

		$wsql = "  c.title LIKE '%{$so_keyword}%'
		OR c.etitle LIKE '%{$so_keyword}%'
		OR c.content LIKE '%{$so_keyword}%' 
		OR c.econtent LIKE '%{$so_keyword}%' 
  		OR c.keywords LIKE '%{$so_keyword}%'  
  		OR c.description LIKE '%{$so_keyword}%' ";
		$so_list_sql = "model|{$so_column['model']};nostate|20;sort|id;sorttype=desc;wsql|{$wsql}";
		$so_list = getLists ( $so_column['model'], $so_list_sql );
		if(! empty ( $so_list ))
		{
			$StatusCode = 200;
		}
		else
		{
			$StatusCode = 404;
		}
		echo json_encode ( array(
				'StatusCode' => $StatusCode,
				'error' => '该内容模型未开启评论功能~',
				'data' => $so_list,
				'tree' => null
		) );
		exit ();
	}
}
