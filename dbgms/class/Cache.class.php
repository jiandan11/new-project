<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
// =================================

/*
 * 1.根据需求,查询 数据库(mysql)-取查询结果ID
 * 2.根据 ID ,查询缓存
 * ->【存在】直接获取缓存结果
 * ->【不存在 】 1.查询数据库.取出所有需要的数据 2.结果 ,新建文件 缓存
 */
class Cache {
	public $dir = NULL; // 存放目录
	public $time = NULL; // 有效期,默认永久(单位为秒)
	/*
	 * 行为---rewrite 此处为一技巧,
	 * 通过xx.Php?cacheact=rewrite更新缓存,以此类推,还可以设定一些其它操作
	 */
	public $act = NULL;
	public $name = NULL; // 缓存文件名
	public $extension = NULL; // 扩展名
	public $isvalid = NULL; // 有效
	/* 重点,回调函数 */
	public $function = array(
			'query' => NULL, /*回调方法,查询sql方法*/ 
			'parse' => NULL /*回调方法,缓存文件解析方法*/ 
	);
	// 缓存文件基本信息
	public $info = array(
			'sign' => NULL, /*文件夹名字*/ 
			'row_sql' => NULL /*查询单条数据语句*/
	);
	
	// 构造函数,初始化,类成员(变量)的值
	function __construct($config = array ())
	{
		// foreach遍历 初始化属性
		foreach($config as $key=>$val)
		{
			$this->$key = $val;
			if($key == 'dir')
			{
				if(is_dir ( $val ))
				{ // is_dir() 函数检查指定的文件是否是目录。
					$this->dir = $val;
				}
				else
				{
					try
					{
						mkdir ( $val, 0777 );
					}
					catch ( Exception $e )
					{
						$this->error ( '所设定缓存目录不存在并且创建失败!请检查目录权限!' );
						return FALSE;
					}
				}
			}
		}
	}
	// ========================重点==============================
	/* 重点,使用回调函数 */
	// 获取缓存 文件内容,获取单条,有空重写
	function get_cache_content($dir = NULL, $name = NULL, $is_update = NULL, $param = array())
	{
		$row = array();
		// 手动更新缓存
		if(! empty ( $is_update ))
		{
			$this->del_filecache ( $dir, $name );
			$row = FALSE;
		}
		else
		{
			$row = $this->get_filecache ( $dir, $name, 3600 );
		}
		// 不存在的話
		if($row == FALSE)
		{
			/**
			 * ****重点回调解析文件***
			 */
			/* 重点回调解析文件 */
			// 自定义解析,可以试着使用 回调方法
			// $row = dbg_parse_cache ( $row );
			// 如果回调函数不为空的话
			if(! empty ( $this->function['parse'] ))
			{
				$row = call_user_func_array ( $this->function['parse'], $param );
			}
			// 删除
			$this->del_filecache ( $dir, $name );
			// 设置
			$this->set_filecache ( $dir, $name, $row );
		}

		return $row;
	}
	/* 重点,使用回调函数 */
	// 获取缓存 文件内容
	function get_cache_content2($model_id, $ids = array(), $is_update = NULL)
	{
		$lists = array();
		
		foreach($ids as $k=>$val_id)
		{
			// 获取缓存文件
			$row = array();
			if(! empty ( $is_update ))
			{
				$this->del_filecache ( $this->info['sign'], $this->info['sign'] . $val_id );
			}
			$row = $this->get_filecache ( $this->info['sign'], $this->info['sign'] . $val_id, 3600 );
			// 不存在的話
			if($row == FALSE)
			{
				// ========================重点==============================
				/**
				 * ****依然使用回调函数***
				 */
				// if(! empty ( $this->function ['query'] )){
				// $row = call_user_func_array ( $this->function ['query'], array (
				// $this->info ['row_sql'] . $val_id
				// ) );
				// }else{
				// // 使用自定义查询数据
				// $row = dbg_query ( $this->info ['row_sql'] . $val_id );
				// }
				/**
				 * ****重点回调解析文件***
				 */
				/* 重点回调解析文件 */
				// 自定义解析,可以试着使用 回调方法
				// $row = dbg_parse_cache ( $row );
				// 如果回调函数不为空的话
				if(! empty ( $this->function['parse'] ))
				{
					$row = call_user_func_array ( $this->function['parse'], array(
							$model_id,
							$val_id,
							$row 
					) );
				}
				// ========================重点==============================
				
				// 删除
				$this->del_filecache ( $this->info['sign'], $this->info['sign'] . $val_id );
				// 设置
				$this->set_filecache ( $this->info['sign'], $this->info['sign'] . $val_id, $row );
			}
			$lists[] = $row;
		}
		return $lists;
	}
	// ========================重点==============================
	
	/*
	 * @可被删除或放弃的文件缓存 关于文件缓存格式 是 var_export | serialize * @效率对比 这个有待商榷 ,有的地方说 serialize序列化的效率更高 @很多文档支持serialize
	 * @在本系统中实测并未发现太大差别
	 */
	/**
	 * ===设置文件缓存
	 * @param string $path 	路径
	 * @param string $key 唯一键
	 * @param string $val 值
	 * @param string $min 去除空格
	 * @param string $slize        	
	 */
	public function set_filecache($path = 'com', $key = '', $val = '', $min = FALSE, $slize = FALSE)
	{
		$md5 = md5 ( $key );
		$cdir = $this->dir . ($path == '' ? '' : '/' . $path) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 );
		if(! is_dir ( $cdir ))
		{
			$this->creat_dir ( $cdir );
		}
		$cfile = substr ( $md5, 4, 28 ) . ($slize ? '.inc' : '.php');
		$cfile = $cdir . '/' . $cfile;
		
		if($slize)
		{
			$cache = array();
			$cache['data'] = $val;
			$cata = array_str ( $cache, 0 );
		}
		else
		{
			$cache = var_export ( $val, true );
			if($min)
			{
				$cache = preg_replace ( "'([\r\n])[\s]+'", "", $cache );
			}
			
			$cata = '<?php' . "\r\n" . 'if(!defined(\'DBGMS_ROOT\')){' . "\r\n" . 'header(\'HTTP/1.1 404 Not Found\');' . "\r\n" . 'exit();' . "\r\n" . '}' . "\r\n" . 'return ';
			$cata .= $cache;
			$cata .= ";\r\n?>";
		}
		// ob_start ();
		try
		{
			file_put_contents ( $cfile, $cata );
			@chmod ( $cfile, 0777 );
		}
		catch ( Exception $e )
		{
			echo '<div style="color:red;">' . '写入缓存失败!请检查目录权限!' . '</div>';
		}
	}
	private function creat_dir($path = NULL, $basefix = '')
	{
		if(trim ( $path ) == '')
			return '';
		if($basefix != '')
		{
			$basedir = $basefix;
		}
		else
		{
			$basedir = $this->dir;
		}
		$path = str_replace ( $basedir, '', $path );
		$path = str_replace ( "\\", "/", $path );
		$path = $path{0} == '/' ? substr ( $path, 1, strlen ( $path ) ) : $path;
		$path = $path{strlen ( $path ) - 1} == '/' ? substr ( $path, 0, strlen ( $path ) - 1 ) : $path;
		$ars = explode ( '/', $path );
		if(count ( $ars ) < 2)
		{
			return makedir ( $basedir . '/' . $path );
		}
		$path = '';
		foreach($ars as $k=>$ar)
		{
			if($ar == '')
				continue;
			$path .= '/' . trim ( $ar );
			if(! is_dir ( $basedir . $path ) || ! is_writeable ( $basedir . $path ))
			{
				if(! is_dir ( $basedir . $path ))
				{
					if(! @mkdir ( $basedir . $path, 0777 ))
						return '创建目录失败';
				}
				else
				{
					chmod ( $basedir . $path, 0777 );
				}
			}
		}
		return "";
	}
	/**
	 * ==获取文件缓存
	 *
	 * @param string $path        	
	 * @param string $key        	
	 * @param unknown $time        	
	 * @param string $slize        	
	 * @return boolean|Ambigous <boolean, unknown>
	 */
	function get_filecache($path = 'com', $key = '', $time = -1, $slize = FALSE)
	{
		if(trim ( $key ) == '')
			return FALSE;
		
		$md5 = md5 ( $key );
		$cfile = $this->dir . ($path == '' ? '' : '/' . $path) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 ) . '/' . substr ( $md5, 4, 28 ) . ($slize ? '.inc' : '.php');
		if(! is_file ( $cfile ))
		{
			return FALSE;
		}
		if($time == - 1)
		{
			$rs = $this->parse_filecache ( $cfile, $slize );
			return $rs;
		}
		$time = intval ( $time );
		$date = @filemtime ( $cfile ); // 本函数返回文件中的数据块上次被写入的时间，也就是说，文件的内容上次被修改的时间。
		if(($date + $time) < time ())
		{ // 根据判断,返回是否符合在时间段内 - -- filemtime() 函数返回文件内容上次的修改时间。
			return FALSE;
		}
		$rs = $this->parse_filecache ( $cfile, $slize );
		return $rs;
	}
	// 解析文件缓存 parse_file_cache()
	function parse_filecache($file = '', $slize = FALSE)
	{
		if($slize)
		{
			$str = file_get_contents ( $file );
			$rs = str_array ( $str, 1 );
			$rs = isset ( $rs['data'] ) ? $rs['data'] : FALSE;
		}
		else
		{
//		    var_dump($file);
			$rs = include ($file);
		}

		return $rs;
	}
	function del_filecache($path = 'com', $key = '')
	{
		if(trim ( $key ) == '')
			return FALSE;
		$md5 = md5 ( $key );
		$cfile = $this->dir . ($path == '' ? '' : '/' . $path) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 ) . '/' . substr ( $md5, 4, 28 ) . '.php';
		
		try
		{
			unlink ( $cfile );
		}
		catch ( Exception $e )
		{
			echo '<div style="color:red;">' . '清除缓存文件失败!请检查目录权限!' . '</div>';
		}
		// 存放缓存文件的默认目录
		// if ($handle = opendir ( $cfile )) { // 打开 images 目录,opendir打开一个目录句柄，可
		// while ( FALSE !== ($file = readdir ( $handle )) ) { // readdir() 函数返回由 opendir() 打开的目录句柄中的条目。
		// if (is_file ( $cfile )) { // is_file() 函数检查指定的文件名是否是正常的文件。
		// // 存在的话,删除文件 、文件为全名,若成功，则返回 true，失败则返回 FALSE。
		// unlink ( $cfile );
		// }
		// }
		// // 重置目录流 rewinddir($path);
		// closedir ( $handle ); // closedir() 函数关闭由 opendir() 函数打开的目录句柄。
		// }
	}
}

// 案例:文件缓存
function demo_cache($nid = NULL, $content = NULL)
{
	dbgms_LoadClass ( 'Cache.class.php' );
	$config = array(
			'dir' => DBG . '/cache', // 缓存目录
			'time' => 3600 
	); // 缓存时间
	
	$cache = new Cache ( $config ); // 省略参数即采用缺省设置, $cache = new Cache($cachedir);
	if($nid == null)
	{
		echo "没有需要更新的ID！";
	}
	else
	{
		// $cache->del_filecache ( 'news', 'news/' . $nid ); // 首次运行或缓存过期,生成缓存
		$ids = $cache->get_filecache ( 'news', "news/" . $nid );
		if($ids === false)
		{
			
			// 首次运行或缓存过期,生成缓存
			if(! $cache->set_filecache ( 'news', 'news/' . $nid, $content ))
			{
				echo '更新缓存成功！<br/>';
			}
			else
			{
				echo '更新缓存error！<br/>';
			}
		}
		else
		{
			if(is_array ( $ids ))
			{
				foreach($ids as $key=>$val)
				{
					echo $key . var_dump ( $val );
				}
			}
			else
			{
				echo $ids;
			}
		}
	}
}
?>