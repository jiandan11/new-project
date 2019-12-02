<?php
// DbgMs系统安装路径 _DBGMS_INSTALL_
define ( '_DBGMS_INSTALL_', preg_replace ( '/(\/|\\\\){1,}/', '/', dirname ( __FILE__ ) ) );
if(! function_exists ( 'is_https' ))
{
	/**
	 * Is HTTPS?
	 *
	 * Determines if the application is accessed via an encrypted
	 * (HTTPS) connection.
	 *
	 * @return bool
	 */
	function is_https()
	{
		if(! empty ( $_SERVER['HTTPS'] ) && strtolower ( $_SERVER['HTTPS'] ) !== 'off')
		{
			return TRUE;
		}
		elseif(isset ( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
		{
			return TRUE;
		}
		elseif(! empty ( $_SERVER['HTTP_FRONT_END_HTTPS'] ) && strtolower ( $_SERVER['HTTP_FRONT_END_HTTPS'] ) !== 'off')
		{
			return TRUE;
		}
		
		return FALSE;
	}
}
if(! function_exists ( 'remove_invisible_characters' ))
{
	/**
	 * Remove Invisible Characters
	 *
	 * This prevents sandwiching null characters
	 * between ascii characters, like Java\0script.
	 *
	 * @param
	 *        	string
	 * @param
	 *        	bool
	 * @return string
	 */
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/'; // url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
		
		do
		{
			$str = preg_replace ( $non_displayables, '', $str, - 1, $count );
		}while($count);
		
		return $str;
	}
}
if(isset ( $_SERVER['HTTP_HOST'] ) && preg_match ( '/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST'] ))
{
	$base_url = (is_https () ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . substr ( $_SERVER['SCRIPT_NAME'], 0, strpos ( $_SERVER['SCRIPT_NAME'], basename ( $_SERVER['SCRIPT_FILENAME'] ) ) );
	$base_url2 = substr ( $_SERVER['SCRIPT_NAME'], 0, strpos ( $_SERVER['SCRIPT_NAME'], basename ( $_SERVER['SCRIPT_FILENAME'] ) ) );
}
else
{
	$base_url = 'http://localhost/';
}

/* 配置显示的路径 */
$dbgms_install_lockfile = dirname ( _DBGMS_INSTALL_ ) . '/data/config/install.lock';

$_baseurl = str_replace ( '/install/', '', $base_url );
$_baseurl = str_replace ( '/install', '', $_baseurl );
if(file_exists ( $dbgms_install_lockfile ))
{
	$new_name_sign = '__install' . rand ( 100, 999 ) . time ();
	$new_name = str_replace ( 'install', $new_name_sign, _DBGMS_INSTALL_ );
	rename ( _DBGMS_INSTALL_, $new_name );
	$jumpURL = str_replace ( 'install/', '', $base_url );
	header ( 'Location:' . $jumpURL );
	exit ( '已经安装' );
}
else
{
	// 获取 控制器
	// 获取 控制器
	$dbgms_con = isset ( $_GET['con'] ) ? $_GET['con'] : '';
	$dbgms_con = trim ( $dbgms_con );
	switch($dbgms_con)
	{
		case 'test':
			// dbgms系统安装向导 -- 环境测试
			if(phpversion () < 5)
			{
				die ( '本系统需要PHP5+MYSQL >=4.1环境，当前PHP版本为：' . phpversion () );
			}
			
			$data['phpv'] = @ phpversion ();
			$data['os'] = @PHP_OS;
			$data['os'] = @php_uname ();
			$tmp = function_exists ( 'gd_info' ) ? gd_info () : array();
			$data['server'] = $_SERVER["SERVER_SOFTWARE"];
			$data['host'] = (empty ( $_SERVER["SERVER_ADDR"] ) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
			$data['name'] = $_SERVER["SERVER_NAME"];
			$data['max_execution_time'] = ini_get ( 'max_execution_time' );
			$data['allow_reference'] = (ini_get ( 'allow_call_time_pass_reference' ) ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
			$data['allow_url_fopen'] = (ini_get ( 'allow_url_fopen' ) ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
			$data['safe_mode'] = (ini_get ( 'safe_mode' ) ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');
			
			$err = 0;
			if(empty ( $tmp['GD Version'] ))
			{
				$data['gd'] = '<font color=red>[×]Off</font>';
				$err ++;
			}
			else
			{
				$data['gd'] = '<font color=green>[√]On</font> ' . $tmp['GD Version'];
			}
			if(function_exists ( 'mysqli_connect' ))
			{
				$data['mysql'] = '<font color=green>[√]On</font>';
			}
			else
			{
				$data['mysql'] = '<font color=red>[×]Off</font>';
				$err ++;
			}
			if(ini_get ( 'file_uploads' ))
			{
				$data['uploadSize'] = '<font color=green>[√]On</font> 文件限制:' . ini_get ( 'upload_max_filesize' );
			}
			else
			{
				$data['uploadSize'] = '禁止上传';
			}
			if(function_exists ( 'session_start' ))
			{
				$data['session'] = '<font color=green>[√]On</font>';
			}
			else
			{
				$data['session'] = '<font color=red>[×]Off</font>';
				$err ++;
			}
			$data['err'] = $err;
			$dir_list = array(
					'/',
					'data',
					'data/config',
					'data/cache',
					'data/public',
					'file' 
			);
			$data['dir_list'] = $dir_list;
			// 加载视图
			ob_start ();
			include _DBGMS_INSTALL_ . '/views/test.php';
			$dbgms_views = ob_get_contents ();
			// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
			ob_get_clean ();
			echo $dbgms_views;
			break;
		// dbgms系统安装向导-- 数据库信息
		case 'database':
			// 加载视图
			ob_start ();
			include _DBGMS_INSTALL_ . '/views/database.php';
			$dbgms_views = ob_get_contents ();
			// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
			ob_get_clean ();
			echo $dbgms_views;
			break;
		case 'test_data':
			$link = @mysql_connect ( $_POST['DB_HOST'] . ':' . $_POST['DB_PORT'], $_POST['DB_USER'], $_POST['DB_PWD'] );
			if(! $link)
			{
				echo '数据库连接失败，请检查连接信息是否正确！';
				return;
			}
			if($_POST['create'] == 1)
			{
				echo 1;
				return;
			}
			$status = @mysql_select_db ( $_POST['DB_NAME'], $link );
			if($status)
			{
				echo 1;
			}
			else
			{
				echo '数据库连接成功，请先建立数据库！';
			}
			return;
			break;
		case 'install':
			
			$post_data = $_POST;
			$config_db = $post_data['DB'];
			/* 加载数据库 */
			$dbgms_db = new DBGMS_DB ( $config_db );
			if(! $dbgms_db->connect_database ( $config_db['DB_NAME'] ))
			{
				$sql = "CREATE DATABASE IF NOT EXISTS `" . $config_db['DB_NAME'] . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
				if($dbgms_db->db_query ( $sql ))
				{
					$data['errormsg'] = '数据库创建失败，请检测本帐号是否有权限！';
					$data['state'] = 'error';
					ob_start ();
					include _DBGMS_INSTALL_ . '/views/install.php';
					$dbgms_views = ob_get_contents ();
					// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
					ob_get_clean ();
					echo $dbgms_views;
					exit ();
				}
			}
			$dbgms_db->connect_database ( $config_db['DB_NAME'] );
			/* 设置数据表 前缀 */
			// $DB_PREFIX = $config_db['DB_PREFIX'];
			// if(empty ( $DB_PREFIX ))
			// {
			// $DB_PREFIX = 'dbg_';
			// }
			// exit ( 'asd' );
			
			/* 创建DbgMs表单 */
			$file_sql_create = _DBGMS_INSTALL_ . '/data/dbgms_install_create.sql';
			$file_sql_create_content = file_get_contents ( $file_sql_create );
			$sql_arr = explode ( ';', $file_sql_create_content );
			foreach($sql_arr as $sql_row)
			{
				$sql_row = trim ( $sql_row );
				if(empty ( $sql_row ))
				{ // 为空的 执行
					continue;
				}
				
				if($dbgms_db->db_query ( $sql_row ))
				{
					// 加载视图
					ob_start ();
					$data['errormsg'] = '基础数据导入失败，请检查后手动删除数据库重新安装！';
					$data['state'] = 'error';
					include _DBGMS_INSTALL_ . '/views/install.php';
					$dbgms_views = ob_get_contents ();
					// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
					ob_get_clean ();
					echo $dbgms_views;
					exit ();
				}
			}
			/* 安装 DbgMs 测试数据 */
			if($post_data['test'] == 1)
			{
				$file_sql_insert = _DBGMS_INSTALL_ . '/data/dbgms_install_insert.sql';
				$file_sql_insert_content = file ( $file_sql_insert );
				$sql_arr = array();
				foreach($file_sql_insert_content as $line)
				{
					$line = trim ( $line );
					$sql_arr[] = $line;
					// more statements...
				}
				foreach($sql_arr as $sql_row)
				{
					$sql_row = trim ( $sql_row );
					if(empty ( $sql_row ))
					{ // 为空的 执行
						continue;
					}
					if($dbgms_db->db_query ( $sql_row ))
					{ // 加载视图
						ob_start ();
						$data['errormsg'] = '表结构导入失败，请检查后手动删除数据库重新安装！';
						$data['state'] = 'error';
						include _DBGMS_INSTALL_ . '/views/install.php';
						$dbgms_views = ob_get_contents ();
						// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
						ob_get_clean ();
						echo $dbgms_views;
						exit ();
					}
				}
			}
			unset ( $post_data['create'] );
			unset ( $post_data['test'] );
			if($config_db['DB_HOST'] == 'localhost')
			{
				$config_db['DB_HOST'] = '127.0.0.1';
			}
			$set_config_database_php = "<?php
				defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
				\$active_group = 'default';
				\$query_builder = TRUE;
				\$db['default'] = array(
						'dsn' => '',
						'hostname' => '" . $config_db['DB_HOST'] . "',
						'username' => '" . $config_db['DB_USER'] . "',
						'password' => '" . $config_db['DB_PWD'] . "',
						'database' => '" . $config_db['DB_NAME'] . "',
						'dbdriver' => 'mysqli',
						'dbprefix' => '',
						'pconnect' => FALSE,
						'db_debug' => (ENVIRONMENT !== 'production'),
						'cache_on' => FALSE,
						'cachedir' => '',
						'char_set' => 'utf8',
						'dbcollat' => 'utf8_general_ci',
						'swap_pre' => '',
						'encrypt' => FALSE,
						'compress' => FALSE,
						'stricton' => FALSE,
						'failover' => array(),
						'save_queries' => TRUE 
				);";
			
			$is_config_set = file_put_contents ( dirname ( _DBGMS_INSTALL_ ) . '/data/config.database.php', $set_config_database_php );
			if($is_config_set != FALSE)
			{
				fopen ( $dbgms_install_lockfile, 'w' );
				// 加载视图
				ob_start ();
				$data['state'] = 'success';
				include _DBGMS_INSTALL_ . '/views/install.php';
				$dbgms_views = ob_get_contents ();
				// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
				ob_get_clean ();
				echo $dbgms_views;
				exit ();
			}
			else
			{ // 加载视图
				ob_start ();
				$data['errormsg'] = '配置文件写入失败，请检测 /data/config.database.php 是否有写入权限！';
				$data['state'] = 'error';
				include _DBGMS_INSTALL_ . '/views/install.php';
				$dbgms_views = ob_get_contents ();
				// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
				ob_get_clean ();
				echo $dbgms_views;
				exit ();
			}
			
			break;
		case 'admin':
			// 加载视图
			ob_start ();
			include _DBGMS_INSTALL_ . '/views/admin.php';
			$dbgms_views = ob_get_contents ();
			// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
			ob_get_clean ();
			echo $dbgms_views;
			break;
		case 'copyright':
			// 加载视图
			ob_start ();
			include _DBGMS_INSTALL_ . '/views/copyright.php';
			$dbgms_views = ob_get_contents ();
			// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
			ob_get_clean ();
			echo $dbgms_views;
			break;
		case 'start':
		default:
			// 加载视图
			ob_start ();
			include _DBGMS_INSTALL_ . '/views/start.php';
			$dbgms_views = ob_get_contents ();
			// file_put_contents ( _BASE_ROOT_ . 'index.html',$themes_html );
			ob_get_clean ();
			echo $dbgms_views;
			break;
	}
}
class DBGMS_DB {
	public $DB_HOST = ''; // 数据库服务器地址
	public $DB_PORT = ''; // 数据库端口
	public $DB_USER = ''; // 数据库用户名
	public $DB_PWD = ''; // 数据库密码
	public $DB_NAME = ''; // 数据库名
	public $DB_LINK = ''; // 连接对象
	public $DB_VERSION = '';
	
	// 构造函数
	public function __construct($config = NULL)
	{
		error_reporting ( E_ALL ^ E_NOTICE );
		ignore_user_abort ( false );
		set_time_limit ( 30 );
		// 连接mysql
		// 配置参数
		$this->DB_HOST = trim ( $config['DB_HOST'] );
		$this->DB_PORT = trim ( $config['DB_PORT'] );
		$this->DB_USER = trim ( $config['DB_USER'] );
		$this->DB_PWD = trim ( $config['DB_PWD'] );
		$this->connect_mysql ();
		$this->is_mysql_version ();
	}
	// @action:连接mysql 2016-05-19
	public function connect_mysql()
	{
		$this->DB_LINK = @mysql_connect ( $this->DB_HOST . ':' . $this->DB_PORT, $this->DB_USER, $this->DB_PWD );
		if(! $this->DB_LINK)
		{
			echo '【&nbsp;系统提示&nbsp;】：' . ' 错误2001：数据库服务器连接失败！请返回 上一页 检查连接 参数信息是否正确！<br>';
			echo '【&nbsp;&nbsp;mysql&nbsp;&nbsp;&nbsp;】：' . mysql_error ();
			exit ();
		}
	}
	// @action:检查mysql版本 2016-05-19
	public function is_mysql_version()
	{
		$this->DB_VERSION = mysql_get_server_info ();
		if($this->DB_VERSION < '5.0.0')
		{
			echo '【&nbsp;系统提示&nbsp;】：' . ' Mysql版本低于DbgMs正常运行所需版本。！<a href="install_db.php">上一步 </a><br>';
			exit ();
		}
		else
		{
			mysql_query ( "set names utf8" );
		}
	}
	// @action:连接数据库 2016-05-19
	public function connect_database($name = NULL)
	{
		$this->DB_NAME = mysql_select_db ( $name, $this->DB_LINK );
		return $this->DB_NAME;
		if(! $this->DB_NAME)
		{
			echo '【&nbsp;系统提示&nbsp;】：' . '未知的数据库 --    ' . $name . '<br>';
			echo '【&nbsp;&nbsp;mysql&nbsp;&nbsp;&nbsp;】：' . mysql_error ();
			exit ();
		}
	}
	// @action:查询语句
	public function db_query($sql = NULL)
	{
		mysql_query ( $sql );
	}
}
function installmysql($sql_path, $old_prefix = "", $new_prefix = "", $separator = ";\n")
{
	$commenter = array(
			'#',
			'--' 
	);
	// 判断文件是否存在
	if(! file_exists ( $sql_path ))
		return false;
	$content = file_get_contents ( $sql_path ); // 读取sql文件
	$content = str_replace ( array(
			$old_prefix,
			"\r" 
	), array(
			$new_prefix,
			"\n" 
	), $content ); // 替换前缀
	               // 通过sql语法的语句分割符进行分割
	$segment = explode ( $separator, trim ( $content ) );
	// 去掉注释和多余的空行
	$data = array();
	foreach($segment as $statement)
	{
		$sentence = explode ( "\n", $statement );
		$newStatement = array();
		foreach($sentence as $subSentence)
		{
			if('' != trim ( $subSentence ))
			{
				// 判断是会否是注释
				$isComment = false;
				foreach($commenter as $comer)
				{
					if(preg_match ( "/^(" . $comer . ")/is", trim ( $subSentence ) ))
					{
						$isComment = true;
						break;
					}
				}
				// 如果不是注释，则认为是sql语句
				if(! $isComment)
					$newStatement[] = $subSentence;
			}
		}
		$data[] = $newStatement;
	}
	
	// 组合sql语句
	foreach($data as $statement)
	{
		$newStmt = '';
		foreach($statement as $sentence)
		{
			$newStmt = $newStmt . trim ( $sentence ) . "\n";
		}
		if(! empty ( $newStmt ))
		{
			$result[] = $newStmt;
		}
	}
	return $result;
}

 