<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Json extends CI_Controller {
	public function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		date_default_timezone_set ( 'Asia/Shanghai' );
		error_reporting ( 0 );
	}
	/* 允许index传参 */
	function _remap($method, $params = array())
	{
		if(method_exists ( $this, $method ))
		{
			return call_user_func_array ( array(
					$this,
					$method 
			), $params );
		}
		else
		{
			$arr1stParam = array(
					$method 
			);
			$params = array_merge ( $arr1stParam, $params );
			call_user_func_array ( array(
					$this,
					'index' 
			), $params );
		}
	}
	function getcolumn()
	{
		define ( 'DBG_OPEN', TRUE );
		require (_ROOT_ . 'dbgms/' . 'website_common.php');
		$pcid = trim ( $_GET['pcid'] );
		if(! empty ( $pcid ))
		{
			$son_list = getColumn ( NULL, $pcid );
			echo json_encode ( array(
					'StatusCode' => 200,
					'msg' => '验证码错误~',
					'list' => $son_list 
			) );
			exit ();
		}
	}
	/***前台调用***/
	public function index($column = NULL, $id = NULL)
	{
		define ( 'DBG_OPEN', TRUE );
		require (_ROOT_ . 'dbgms/' . 'website_common.php');
		$website['_column'] = $column = trim ( $column );
		
		// 频道-栏目-当前列表
		// 当前栏目频道 内容列表
		if($column != NULL)
		{
			$website['_channel'] = getColumn ( NULL, $column );
			
			if(empty ( $website['_channel'] ))
			{
				echo json_encode ( array(
						'StatusCode' => 404,
						'msg' => '验证码错误~' 
				) );
				exit ();
			}
			else
			{
				// 单个内容（文章、图文、产品、app、音乐等*）
				if($id != NULL)
				{ // 获取完整的url
					dbg_is_suffix ( NULL, '.html' );
					$id = intval ( $id );
					if(! is_numeric ( $id ) || $id == 0)
					{
						echo json_encode ( array(
								'StatusCode' => 404,
								'msg' => ' id 不为数字 ,并且不等于0 ~' 
						) );
						exit ();
					}
					/* 获取单条内容 */
					$website['_content'] = getRow ( $website['_channel']['model'], $id );
					if(empty ( $website['_content'] ))
					{
						echo json_encode ( array(
								'StatusCode' => 404,
								'msg' => ' 内容为空~' 
						) );
						exit ();
					}
					if($website['_channel']['id'] != $website['_content']['columnid'])
					{
						echo json_encode ( array(
								'StatusCode' => 404,
								'msg' => ' 不是当前栏目' 
						) );
						exit ();
					}
				}
				else
				{
				}
				$website['_page'] = $this->input->get_post ( 'p' );
				$website['_page'] = empty ( $website['_page'] ) ? 1 : $website['_page'];
				if(! is_numeric ( $website['_page'] ))
				{
					echo json_encode ( array(
							'StatusCode' => 404,
							'msg' => '_page 不为数字' 
					) );
					exit ();
				}
				if($column != 'feedback')
				{ // 栏目 内容列表
					$website['_list'] = dbgColumnContentLists ( $website['_channel'], $website['_page'], $website['_pagebreak'] );
				}
			}
		}
		$return_json['list'] = $website['_list'];
		$return_json['length'] = count ( $website['_list'] );
		$return_json['page'] = $website['_page'];
		echo json_encode ( $return_json );
	}
	function test()
	{
		$list = array();
		for($i = 0;$i < 100;$i ++)
		{
			$row = array();
			$row['id'] = 'id=' . $i;
			$row['name'] = 'name=' . $i;
			$list[] = $row;
		}
		echo json_encode ( array(
				'StatusCode' => 200,
				'list' => $list 
		) );
	}
	//
	function testlogin()
	{
		$name = $_POST['username'];
		if($name == 'xiaolong')
		{
			echo 'yes';
			exit ();
		}
		else
		{
			echo 'no';
		}
	}
}
