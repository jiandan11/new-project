<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	header ( 'HTTP/1.1 404 Not Found' );
	// echo '<meta http-equiv="refresh" content="5; url=index.com/" />';
	// echo '该页面不允许单独访问,5秒后跳转<br/>';
	exit ( '权限路径.No direct script access allowed' );
}

/**
 * 保存SESSION到Sqlite
 * 
 * @author WeakSun <52132522@qq.com>
 *        
 */
// namespace Think\Session\Driver;
use SessionHandlerInterface;
use PDO;
class Sqlite implements SessionHandlerInterface {
	protected static $tableNameName, $expire, $handler, $nowTime;
	public function __construct()
	{
		empty ( static::$expire ) && static::$expire = C ( 'SESSION_EXPIRE', null, false ) ? C ( 'SESSION_EXPIRE' ) : ini_get ( 'session.gc_maxlifetime' );
		empty ( static::$nowTime ) && static::$nowTime = isset ( $GLOBALS['_beginTime'] ) ? $GLOBALS['_beginTime'] : microtime ( true );
		empty ( static::$tableNameName ) && static::$tableNameName = C ( 'SESSION_TABLE' ) ? C ( 'SESSION_TABLE' ) : 'iSession';
		$dbFile = TEMP_PATH . 'Caches.tmp';
		$isCreate = is_file ( $dbFile );
		if(empty ( static::$handler ))
		{
			static::$handler = new PDO ( "sqlite:{$dbFile}", null, null, array(
					PDO::ATTR_PERSISTENT => true 
			) );
			empty ( $isCreate ) && $this->exec ( "PRAGMA encoding = 'UTF8';PRAGMA temp_store = 2;PRAGMA auto_vacuum = 0;PRAGMA count_changes = 1;PRAGMA cache_size = 9000;" );
			$this->chkTable () || $this->createTable ();
		}
	}
	
	/**
	 * 创建SessionID
	 * @return string
	 */
	public function create_sid()
	{
		return uniqid ( sprintf ( '%08x', mt_rand ( 0, 2147483647 ) ) );
	}
}

// =================================
// define ( 'DBGMS_ROOT', preg_replace ( "/(\/|\\\\){1,}/", '/', dirname ( __FILE__ ) ) );
// require_once (dirname ( __FILE__ ) . "/config.php");
// require_once ("../".dirname ( __FILE__ ) . "/config.php");
// demo_cookie();

// 案例:cookie
function demo_cookie()
{
	dbgms_LoadClass ( 'cookie.class.php' );
	$config = array(
			'dir' => DBG . '/cache', // 缓存目录
			'time' => 3600 
	); // 缓存时间
	
	$cookie = new Cookie ( $config ); // 省略参数即采用缺省设置, $cache = new Cache($cachedir);
	
	$cookie->setcooke ( 'asdas', 'asdasdasd', 20 * 5 );
	echo $cookie->getcooke ( 'asdas' );
}

// =================================
class Cookie {
	// Cookie操作
	function setcooke($name, $value, $kptime = 0, $path = '/')
	{
		global $_glb;
		$extime = $kptime == 0 ? 0 : time () + $kptime;
		$safe = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		$domain = isset ( $_glb['cookie_domain'] ) ? $_glb['cookie_domain'] : '';
		setcookie ( $name, $value, $extime, $path, $domain, $safe );
		setcookie ( $name . '__hash', substr ( md5 ( 'asdas' ), 0, 16 ), $extime, $path, $domain, $safe );
		// 原来是用ip来加密的，现用浏览器信息
		// setcookie ( $name . '__hash', substr ( md5 ( get_evnt ( 'browser' ) . $value . $_glb ['sitekey'] ), 0, 16 ),
		// $extime, $path, $domain, $safe ); // 原来是用ip来加密的，现用浏览器信息
	}
	function clearcooke($name)
	{
		global $_glb;
		$domain = isset ( $_glb['cookie_domain'] ) ? $_glb['cookie_domain'] : '';
		$safe = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		setcookie ( $name, '', time () - 360000, "/", $domain, $safe );
		setcookie ( $name . '__hash', '', time () - 360000, "/", $domain, $safe );
	}
	function getcooke($name)
	{
		global $_glb;
		if(! isset ( $_COOKIE[$name] ) || ! isset ( $_COOKIE[$name . '__hash'] ))
		{
			return '';
		}
		if($_COOKIE[$name . '__hash'] != substr ( md5 ( 'asdas' . $_COOKIE[$name] ), 0, 16 ))
		{
			return '';
		}
		return $_COOKIE[$name];
	}
}

// Cookie操作
function setcooke($name, $value, $kptime = 0, $path = '/')
{
	global $_glb;
	$extime = $kptime == 0 ? 0 : time () + $kptime;
	$safe = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
	$domain = isset ( $_glb['cookie_domain'] ) ? $_glb['cookie_domain'] : '';
	setcookie ( $name, $value, $extime, $path, $domain, $safe );
	setcookie ( $name . '__hash', substr ( md5 ( get_evnt ( 'browser' ) . $value . $_glb['sitekey'] ), 0, 16 ), $extime, $path, $domain, $safe ); // 原来是用ip来加密的，现用浏览器信息
}
function clearcooke($name)
{
	global $_glb;
	$domain = isset ( $_glb['cookie_domain'] ) ? $_glb['cookie_domain'] : '';
	$safe = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
	setcookie ( $name, '', time () - 360000, "/", $domain, $safe );
	setcookie ( $name . '__hash', '', time () - 360000, "/", $domain, $safe );
}
function getcooke($name)
{
	global $_glb;
	if(! isset ( $_COOKIE[$name] ) || ! isset ( $_COOKIE[$name . '__hash'] ))
	{
		return '';
	}
	if($_COOKIE[$name . '__hash'] != substr ( md5 ( get_evnt ( 'browser' ) . $_COOKIE[$name] . $_glb['sitekey'] ), 0, 16 ))
	{
		return '';
	}
	return $_COOKIE[$name];
}
/*
 * 基础安全 session cookie ***********************************************
 */
// 是否本地POST
function locationpost()
{
	return ($_SERVER['REQUEST_METHOD'] == 'POST' && empty ( $_SERVER['HTTP_X_FLASH_VERSION'] ) && (empty ( $_SERVER['HTTP_REFERER'] ) || preg_replace ( "/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER'] ) == preg_replace ( "/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'] )));
}
function checkvcode($vcode, $reset = false)
{
	@session_start ();
	if(! isset ( $_SESSION['vcode'] ))
	{
		$message = '验证码已过期';
	}
	else
	{
		$message = $_SESSION['vcode'] != md5 ( strtolower ( $vcode ) ) ? '验证码错误' : 'ok';
	}
	if($reset)
	{
		unset ( $_SESSION['vcode'] );
	}
	return $message;
}
function rerestvcode()
{
	@session_start ();
	$_SESSION['vcode'] = '';
}