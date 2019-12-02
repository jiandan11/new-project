<?php
if(! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		date_default_timezone_set ( 'Asia/Shanghai' );
		error_reporting ( 0 );
		define ( 'CI31_DBGFRAMEWORK', preg_replace ( '/(\/|\\\\){1,}/', '/', FCPATH ) . '/dbgms.php' );
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
	/* $module为哪个模块 */
	public function index($modules = 'iframe')
	{
		define ( 'DBG_OPEN', TRUE );
		require (CI31_DBGFRAMEWORK);
		$data['_dbgms_baseurl'] = base_url ();
		// dbg管理系统url
		$data['_dbgms_url'] = site_url () . '/';
		$data['_baseurl'] = str_replace ( 'dbgms/', '', $data['_dbgms_baseurl'] );
		
		if(! file_exists ( DBG_DATA . 'config/install.lock' ))
		{ /* 未安装 */
			redirect ( $data['_baseurl'] . 'install' );
			exit ();
		}
		
		$session_id = $_POST['PHPSESSID'];
		if($session_id && ($session_id != session_id ()))
		{ /* swfupload插件 */
			session_destroy ();
			session_id ( $session_id );
			@session_start ();
		}
		$data['_dbgms_init'] = $_dbg_glb;
		/* 获取登陆session 或者cookie */
		$data['_dbgms_admin'] = $_SESSION['dbgms_admin'];
		if(empty ( $data['_dbgms_admin'] ))
		{ /* 没有登陆 */
			$this->load->view ( 'login', $data );
			return;
		}
		
		switch($modules)
		{
			/* base 设置 */
			case 'base':
			/* cms 管理系统 */
			case 'cms':
			/* crm 管理系统 */
                        case 'form':
                        /* form 前端表单管理*/
			case 'crm':
			/* erp 管理系统 */
			case 'erp':
			/* live 管理系统 */
			case 'live':
			/* member_user 会员系统 */
			case 'member':
			/* tool 功能插件 */
			case 'tool':
				$dbgms_admin = _DBGMS_MODULES_ . $modules . '/admin.php';
				if(! file_exists ( $dbgms_admin ))
				{
					exit ( '该模块功能未安装,请联系dbgms开发者!' );
				}
				require $dbgms_admin;
				break;
			/* 微信系统 */
			case 'weixin':
				$dbgms_admin = _DBGMS_MODULES_ . $modules . '/admin.php';
				if(! file_exists ( $dbgms_admin ))
				{
					exit ( '该模块功能未安装,请联系dbgms开发者!' );
				}
				require $dbgms_admin;
				break;
			default:
				// 获取菜单
				$dbgms_modules_menu_arr = glob ( _DBGMS_MODULES_ . '*/menu.php' );
				$dbgms_module_menu = array();
				$dbgms_menu = array();
				
				foreach($dbgms_modules_menu_arr as $value)
				{
					$dbgms_module_menu = require $value;
					if(! empty ( $dbgms_module_menu ))
					{
						$dbgms_menu[$dbgms_module_menu['modules']] = $dbgms_module_menu;
					}
				}
				
				// 判断权限
				if($data['_dbgms_admin']['groupid'] != 1)
				{
					$admin_menu = unserialize ( $data['_dbgms_admin']['menu'] );
					foreach($dbgms_menu as $mkey=>$mval)
					{
						foreach($mval['controllers'] as $ckey=>$cval)
						{
							if(empty ( $admin_menu[$mkey . '_' . $cval['con']] ))
							{
								unset ( $dbgms_menu[$mkey]['controllers'][$ckey] );
							}
						}
					}
				}
				// 设置头部链接
				$dbgms_menu_head = array();
				$dbgms_menu_left = array();
				foreach($dbgms_menu as $key=>$val)
				{
					$dbgms_menu_head_row = array();
					$dbgms_menu_head_row['name'] = $val['name'];
					$dbgms_menu_head_row['sign'] = $val['modules'];
					$dbgms_menu_head_row['link'] = $data['_dbgms_url'] . 'index/' . $val['modules'] . '?con=' . $val['default'];
					$dbgms_menu_head[] = $dbgms_menu_head_row;
					
					foreach($val['controllers'] as $key2=>$val2)
					{
						$dbgms_menu_row = array();
						$dbgms_menu_row['name'] = $val2['name'];
						$dbgms_menu_row['link'] = $data['_dbgms_url'] . 'index/' . $val['modules'] . '?con=' . $val2['con'];
						if($val2['home'] == 1)
						{
							$dbgms_menu_left['home'][] = $dbgms_menu_row;
						}
						$dbgms_menu_left[$val['modules']][] = $dbgms_menu_row;
					}
				}
				$data['_dbgms_menu'] = $dbgms_menu_left;
				$data['_dbgms_menu']['head'] = $dbgms_menu_head;
                                $data['_dbgms_menu']['formtable'] = dbg_query('SELECT rfid,rfname,tablename,bindproduct FROM `dbg_richform` WHERE istablebuild=1',true);
				$dbgms_menu_content_sql = "SELECT c.id,c.name FROM dbg_model AS c WHERE c.disable = 0 AND c.install = 1 ORDER BY c.id ASC";
				$dbgms_menu_content = $this->db->query ( $dbgms_menu_content_sql )->result_array ();
				foreach($dbgms_menu_content as $key=>$val)
				{
					$dbgms_menu_content[$key]['link'] = $data['_dbgms_url'] . 'index/cms?con=content&modelid=' . $val['id'];
				}
				$data['_dbgms_menu']['content'] = $dbgms_menu_content;
				$this->load->view ( 'iframe_menu', $data );
				break;
		}
	}
	/* 记录日志 */
	public function log_add($type = 1, $msg = NULL)
	{
		if(! isset ( $_SESSION['dbgms_admin'] ))
		{
			redirect ( $this->config->base_url () );
		}
		define ( 'DBG_OPEN', TRUE );
		/* 这边要用 require_once；防止多次加载 报错误 */
		require_once (CI31_DBGFRAMEWORK);
		$field['ip'] = dbgms_IpGet (); /* 操作ip */
		if($field['ip'] == '127.0.0.1')
		{
			return; /* 本地跳出 */
		}
		$field['adminid'] = $_SESSION['dbgms_admin']['id'];
		$field['intime'] = time (); /* 操作时间 */
		$field['type'] = $type;
		switch($type)
		{
			case 1:
				$field['content'] = " 登录啦~";
				break;
			case 2:
				$field['content'] = " 退出登录 !";
				break;
			case 3:
				$field['content'] = " 删除操作(重要) !";
				break;
		}
		$sql = getsql_table ( 'dbg_admin_log', $field );
		$result = $this->db->query ( $sql );
		return;
	}
	/* @action:验证码 */
	public function captcha($session_sign)
	{
		// checkyzm,captcha
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'dbgms.php');
		set_time_limit ( 0 ); // 防止出现500 Internal Server Error
		dbgms_LoadClass ( 'Hs.class.php' );
		$hs_yzm = Hs::getInstance ();
		$hs_yzm->startCreateCaptcha ( $session_sign );
	}
	
	/* 登录相关验证 */
	public function login($act = NULL)
	{
		switch($act)
		{
			/* 验证登陆 */
			case "check":
				$uemail = trim ( $this->input->get_post ( 'form_name' ) );
				$upwd = trim ( $this->input->get_post ( 'form_password' ) );
				/* 开启session */
				session_start ();
				define ( 'DBG_OPEN', TRUE );
				require (CI31_DBGFRAMEWORK);
				
				if(! empty ( $_SESSION['login'] ))
				{
					$fyzm = trim ( $this->input->get_post ( 'form_captcha' ) );
					if($_SESSION['login'] != md5 ( $fyzm ))
					{
						echo "验证码错误~";
						return;
					}
				}
				$user_sql = "SELECT c.*,dag.name AS groupname,dag.icon,dag.menu
						FROM dbg_admin AS c,dbg_admin_group AS dag 
						WHERE c.groupid = dag.id AND c.name = '" . $uemail . "'";
				$user_arr = $this->db->query ( $user_sql )->result_array ();
				$user_arr = $user_arr[0];
				/* 返回查询的数据 */
				if(! empty ( $user_arr ))
				{
					if($user_arr['pwd'] == md5 ( $upwd ))
					{
						if($user_arr['disable'] == 1)
						{
							echo "error-not disable";
							return;
						}
						$user_arr['pwd'] = "";
						/* ci 3 */
						$_SESSION['dbgms_admin'] = $user_arr;
						/* 判断是否激活 */
						$where_sql = " id =" . $user_arr['id'];
						$field['loginip'] = dbgms_IpGet ();
						$field['logintime'] = time ();
						/* 添加日志 */
						$this->log_add ( 1 );
						$sql = getsql_table ( 'dbg_admin', $field, $where_sql );
						$result = $this->db->query ( $sql );
						if($result == TRUE)
						{
							echo 1;
						}
						else
						{
							echo "异常错误";
						}
						return;
					}
					else
					{
						echo "error-password";
						return;
					}
				}
				else
				{
					echo "error-email";
					return;
				}
				break;
			/* 退出登录 */
			case "quit":
				$this->log_add ( 2 );
				unset ( $_SESSION );
				$this->session->sess_destroy ();
				echo 1;
				break;
			default:
				/*其他都跳入,主接口进入系统*/
				redirect ( $this->config->base_url () );
				break;
		}
	}
}