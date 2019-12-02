<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Common extends CI_Controller {
	public function __construct()
	{
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		date_default_timezone_set ( 'Asia/Shanghai' );
		error_reporting ( 0 );
	}
	// @action:验证码
	public function checkyzm($session_sign)
	{
		// checkyzm,captcha
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'dbgms.php');
		set_time_limit ( 0 ); // 防止出现500 Internal Server Error
		dbgms_LoadClass ( 'Hs.class.php' );
		$hs_yzm = Hs::getInstance ();
		$hs_yzm->startCreateCaptcha ( $session_sign );
	}
	// @action:意见反馈
	// @action:获取意见反馈 [zhw_2016-03-31]
	public function feedback($type)
	{
		if($type != 'set' && $type != 'get')
		{
			echo json_encode ( array(
					'StatusCode' => 404,
					'msg' => '验证码错误~' 
			) );
			exit ();
		}
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'dbgms.php');
		
		if($type == 'get')
		{
			// 意见反馈内容
			$select_sql_lists = "SELECT c.* FROM dbg_feedback AS c ORDER BY c.uptime ASC LIMIT 0,10;";
			$data = dbg_query ( $select_sql_lists );
			
			foreach($data as $key=>$val)
			{
				$param = unserialize ( $val['param'] ); /* 浏览器 */
				$data[$key]['email'] = $param['email'];
				$data[$key]['name'] = $param['name'];
				$data[$key]['uptime'] = date ( 'Y-m-d H:i:s', $val['uptime'] );
			}
			echo json_encode ( array(
					'StatusCode' => 200,
					'data' => $data 
			) );
			exit ();
		}
		else
		{
			/* 开启session */
			session_start ();
			if(! empty ( $_SESSION['feedback'] ))
			{
				$form_captcha = trim ( $this->input->get_post ( 'form_captcha' ) );
				if($_SESSION['feedback'] != md5 ( $form_captcha ))
				{
					echo json_encode ( array(
							'StatusCode' => 404,
							'msg' => '验证码错误~' 
					) );
					exit ();
				}
			}
			
			$param['name'] = $this->input->get_post ( 'form_name' );
			$param['email'] = $this->input->get_post ( 'form_email' );
			if(dbg_email ( 'check', $param['email'] ) == FALSE)
			{
				echo json_encode ( array(
						'StatusCode' => 404,
						'msg' => '邮箱格式有误!' 
				) );
				exit ();
			}
			$user = $_SESSION['dbg_user'];
			if(! empty ( $user ))
			{
				$field['userid'] = $user['id'];
			}
			else
			{
				$field['userid'] = 0;
			}
			
			$field['content'] = $this->input->get_post ( 'form_content' );
			$field['url'] = $_SERVER['HTTP_REFERER']; /* 当前页面 */
			$field['ip'] = dbgms_IpGet (); /* IP */
			$field['uptime'] = time (); /* 时间 */
			$field['browser'] = $_SERVER["HTTP_USER_AGENT"]; /* 浏览器 */
			$field['param'] = serialize ( $param ); /* 浏览器 */
			
			$sql = getsql_table ( 'dbg_feedback', $field, '' );
			$sql_result = $this->db->query ( $sql ); /* CI 自带的执行SQL */
			if($sql_result == TRUE)
			{
				echo json_encode ( array(
						'StatusCode' => 200,
						'msg' => '留言成功~' 
				) );
				exit ();
			}
			else
			{
				echo json_encode ( array(
						'StatusCode' => 404,
						'msg' => '异常错误~' 
				) );
				exit ();
			}
		}
	}
	
	// @action:提交评论
	// @action:获取评论 [zhw_2016-03-31]
	public function comment($type)
	{
		if($type != 'set' && $type != 'get')
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'total' => - 1,
					'msg' => '错误~',
					'error' => '错误~' 
			) );
			exit ();
		}
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'dbgms.php');
		// ob_start ();
		// var_dump ( $da );
		// $html = ob_get_contents ();
		// file_put_contents ( '1.html', $html );
		// ob_get_clean ();
		$field = array();
		// 获取模型id
		$field['modelid'] = dbg_in ( $_POST['form_modelid'] );
		if(empty ( $field['modelid'] ))
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'total' => - 1,
					'msg' => '模型不能为空~',
					'error' => '模型不能为空~' 
			) );
			exit ();
		}
		// 新闻内容id
		$field['contentid'] = dbg_in ( $_POST['form_contentid'] );
		// 获取栏目id
		$field['columnid'] = dbg_in ( $_POST['form_columnid'] );
		if(empty ( $field['contentid'] ) && empty ( $field['columnid'] ))
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'total' => - 1,
					'msg' => '评论Id不能为空~内容ID和栏目ID不能为空~' 
			) );
			exit ();
		}
		// 获取设置选项_模型_栏目
		// 根据模型id modelid 获取表单名字
		$model = dbg_getModel ( $field['modelid'] );
		// $model['param'] = unserialize ( $model['param'] );
		$table = $model['table'] . '_comment';
		if($model['param']['comment_open'] == 0 || empty ( $model['param']['comment_table'] ))
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'total' => - 1,
					'msg' => '该内容模型未开启评论功能~',
					'error' => '该内容模型未开启评论功能~' 
			) );
			exit ();
		}
		
		// 评论功能
		if($type == 'set')
		{
			/* 开启session */
			session_start ();
			$user = $_SESSION['dbg_user'];
			if($model['param']['comment_guest'] == 0)
			{ // 评论是否开启 匿名游客评论：未开启,无需登录；开启,需要登录
				if(empty ( $user ))
				{
					echo json_encode ( array(
							'StatusCode' => 404,
							'error' => '请先登录~' 
					) );
					exit ();
				}
				else
				{ // 会员的id号和会员昵称
					$userid = $user['id'];
				}
			}
			else
			{ // 游客的id和昵称
				if(! empty ( $user ))
				{
					$userid = $user['id'];
				}
				else
				{
					$userid = 0;
				}
			}
			
			if($model['param']['comment_captcha'] == 0)
			{ // 评论是否开启 验证码：未开启,则销毁session；开启,则判断验证码
				unset ( $_SESSION['comment'] );
				// session_destroy ();
			}
			else
			{
				if(! empty ( $_SESSION['comment'] ))
				{
					// $form_captcha = trim ( dbg_input_getpost ( 'comment' ) );
					$form_captcha = dbg_in ( $_POST['form_captcha'] );
					if($_SESSION['comment'] != md5 ( $form_captcha ))
					{
						echo json_encode ( array(
								'StatusCode' => 404,
								'error' => '验证码出错' 
						) );
						exit ();
					}
				}
			}
			if($model['param']['comment_state'] == 0)
			{ // 评论是否开启 后台审核：未开启,状态>=0；开启,状态<0
				$state = 0;
			}
			else
			{
				$state = - 3;
			}
			// 获取评论内容
			$field['content'] = dbg_in ( $_POST['form_content'] );
			if($field['content'] == '')
			{
				echo json_encode ( array(
						'StatusCode' => 404,
						'error' => '内容出错' 
				) );
				exit ();
			}
			// 获取客户端ip
			$field['ip'] = dbgms_IpGet ();
			// 发布时间
			$field['intime'] = $field['uptime'] = time ();
			// 评论的新闻内容id
			
			// 获取siteid
			// $contentid = dbg_query ( "SELECT contentid FROM {$table} WHERE contentid=" . $field['contentid'], FALSE );
			// if(empty ( $contentid ))
			// {
			// // // 第一个评论，楼主位置，则添加表dux_comment的数据
			// // $title = dbg_query ( "SELECT title FROM {$table} WHERE contentid=" . $field['contentid'], FALSE );
			
			// // $field['title'] = $title;
			// // $update_sql = getsql_table ( $table, $field, '' );
			// // // 执行mysql 语句
			// // dbg_query ( $update_sql, FALSE );
			// }
			// else
			// {
			// $contentid = $contentid['contentid'];
			// }
			
			$field['userid'] = $userid;
			$field['state'] = $state;
			
			$update_sql = getsql_table ( $table, $field, '' );
			// 执行mysql 语句
			dbg_query ( $update_sql, FALSE );
		}
		$contentid = $field['contentid'];
		if(! empty ( $contentid ))
		{
			$select_id = ' contentid=' . $field['contentid'];
		}
		else
		{
			$select_id = ' columnid=' . $field['columnid'];
		}
		// 新闻内容的评论总数
		$totals = dbg_query ( "SELECT COUNT(id) AS d FROM  {$table} WHERE {$select_id};" );
		$totals = $totals[0]['d'];
		if(empty ( $totals ))
		{
			$totals = - 1;
		}
		
		// 每页显示条数
		$pageSize = dbg_in ( $_POST['pageSize'] );
		$pageSize = 2;
		$page = ceil ( $totals / $pageSize );
		
		// 当前页
		$p = dbg_in ( $_POST['form_page'] );
		$p = intval ( $p );
		if($p <= 1)
		{
			$p = 1;
		}
		else
		{
			$p = $p;
		}
		
		// 评论内容
		$select_sql_lists = "SELECT c.*,dbg_user.name AS username FROM {$table} AS c 
			LEFT JOIN dbg_user ON dbg_user.id = c.userid 
			WHERE {$select_id} AND c.state >=0 ORDER BY c.uptime ASC 
			LIMIT " . ($p - 1) * $pageSize . "," . $pageSize;
		
		$list = dbg_query ( $select_sql_lists );
		if(empty ( $list ))
		{
			$list = '正在审核，请稍后';
			$list = '已评论。正在审核，请稍后';
		}
		else
		{
			foreach($list as $key=>$val)
			{
				if(empty ( $val['username'] ))
				{
					$list[$key]['username'] = '游客';
				}
				$list[$key]['time'] = date ( 'Y-m-d H:i:s', $val['uptime'] );
				$list[$key]['useravatar'] = base_url () . 'ui/plugin/comment/images/user.png';
			}
		}
		$list = dbg_out ( $list );
		// @header("Content-type:text/html");
		if($type == 'set')
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'msg' => '评论成功~',
					'total' => $totals,
					'list' => $list,
					'page' => $p 
			) );
		}
		else
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'total' => $totals,
					'error' => '暂无信息~',
					'list' => $list,
					'page' => $p 
			) );
		}
		exit ();
		
		// +"("+strJson+")" 跨域问题
		// echo '(' . json_encode ( array(
		// 'StatusCode' => 200,
		// 'msg' => '已经加入购物车~'
		// ) ) . ')';
		// exit ();
	}
	
	// @action:提交商品或者购物车
	public function ajaxshop($type = 'buy')
	{
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'dbgms.php');
		
		// 模型id
		$field['modelid'] = dbg_in ( $_POST['form_modelid'] );
		// 内容id
		$field['contentid'] = dbg_in ( $_POST['form_contentid'] );
		// 数量
		$field['amount'] = dbg_in ( $_POST['form_amount'] );
		
		/* 开启session */
		session_start ();
		
		// 获取设置选项_模型_栏目
		// 根据模型id modelid 获取表单名字
		$model = dbg_getModel ( $field['modelid'] );
		$model['param'] = unserialize ( $model['param'] );
		// 根据 文章id 写入 数据表
		$table = $model['table'] . '_comment';
		
		$user = $_SESSION['dbg_user'];
		if(empty ( $user ))
		{
			echo json_encode ( array(
					'StatusCode' => 'login',
					'error' => '请先登录~',
					'data' => $field 
			) );
			exit ();
		}
		// 会员的id号和会员昵称
		$field['userid'] = $user['id'];
		
		if(empty ( $field['amount'] ) || empty ( $field['contentid'] ) || empty ( $field['modelid'] ))
		{
			echo json_encode ( array(
					'StatusCode' => 404,
					'error' => '参数有误' 
			) );
			exit ();
		}
		
		// 发布时间
		$field['intime'] = $field['uptime'] = time ();
		// 获取评论内容
		$field['content'] = '收藏了';
		// 购买状态，后期交易 或者crm 处理
		$field['state'] = 0;
		$update_sql = getsql_table ( 'dbg_user_shop', $field, '' );
		// 执行mysql 语句
		$sql_result = dbg_query ( $update_sql, FALSE );
		if($sql_result == TRUE)
		{
			echo json_encode ( array(
					'StatusCode' => 200,
					'msg' => '已经加入购物车~' 
			) );
			exit ();
		}
	}
}
