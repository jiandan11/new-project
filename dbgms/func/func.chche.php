<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );

/*
 * 可被删除或放弃的数据库缓存 *********************************************************
 */
function upcaches($cachename = '', $value = '')
{
	global $msql;
	if(trim ( $cachename ) == '')
		return;
	$ntime = time ();
	if(is_array ( $value ))
	{
		$type = 1;
		$data = array_str ( $value );
	}
	else
	{
		$type = 0;
		$data = $value;
	}
	$msql->execquery ( "REPLACE INTO `{db}caches` (`cachename`,`type`,`dateline`,`data`) Values ('$cachename','$type','$ntime','$data');" );
}
// 自己加的
function delcaches($cachename = '')
{
	global $msql;
	$msql->execquery ( "DELETE FROM `{db}caches` WHERE cachename like '{$cachename}%';" );
}
function getcaches($cachename = '', $cachetime = 0)
{
	global $msql, $_glb;
	if(trim ( $cachename ) == '')
		return false;
	$cachetime = intval ( $cachetime );
	if($cachetime > 0)
	{
		$ctime = $cachetime;
	}
	else
	{
		$ctime = isset ( $_glb['cachetime'] ) ? $_glb['cachetime'] : 1800;
	}
	$row = $msql->getone ( "SELECT * FROM `{db}caches` WHERE cachename LIKE '$cachename'" );
	if(! is_array ( $row ))
	{
		return false;
	}
	else
	{
		if(($row['dateline'] + $ctime) < time ())
		{
			return false;
		}
		if($row['type'] == 1)
		{
			return str_array ( $row['data'] );
		}
		return $row['data'];
	}
}

/*
 * 永久保存的缓存数据 (用于存储后续数据 如插件安装后插件所属ID) *********************************************************
 */
function setSyscfg($sysname = '', $value = '')
{
	global $msql;
	if(trim ( $sysname ) == '')
		return;
	if(is_array ( $value ))
	{
		$type = 1;
		$data = array_str ( $value );
	}
	else
	{
		$type = 0;
		$data = $value;
	}
	$msql->execquery ( "REPLACE INTO `{db}syscfg` (`sysname`,`type`,`data`) Values ('$sysname','$type','$data');" );
	upSyscfg ();
}
function getSyscfg($sysname = '')
{
	$sysname = trim ( $sysname );
	if($sysname == '')
		return false;
	$file = BAIYU_DATA . '/php/syscfg.php';
	if(! is_file ( $file ))
	{
		upSyscfg ();
	}
	$arr = include ($file);
	return isset ( $arr[$sysname] ) ? $arr[$sysname] : false;
}
function delSyscfg($sysname = '')
{
	global $msql;
	$msql->execquery ( "DELETE FROM `{db}syscfg` WHERE `sysname`='$sysname';" );
	upSyscfg ();
	return true;
}
function upSyscfg()
{
	global $msql;
	$cfile = BAIYU_DATA . '/php/syscfg.php';
	$cache = array();
	$msql->setquery ( "SELECT * FROM `{db}syscfg`;" );
	$msql->execute ( 'syscfg' );
	while($arr = $msql->getarray ( 'syscfg' ))
	{
		$cache[$arr['sysname']] = $arr['type'] == 1 ? array_str ( $arr['data'] ) : $arr['data'];
	}
	$msql->freeresult ( 'syscfg' );
	$cache = var_export ( $cache, true );
	$cata = '<?php' . "\r\n" . 'if(!defined(\'BAIYU_ROOT\')){' . "\r\n" . 'header(\'HTTP/1.1 404 Not Found\');' . "\r\n" . 'exit();' . "\r\n" . '}' . "\r\n" . 'return ';
	$cata .= $cache;
	$cata .= ";\r\n?>";
	file_put_contents ( $cfile, $cata );
	@chmod ( $cfile, 0777 );
}

/*
 * 可被删除或放弃的文件缓存 关于文件缓存格式 是 var_export | serialize 效率对比 这个有待商榷 很多文档支持serialize 在本系统中实测并未发现太大差别
 * *********************************************************
 */
// (key-唯一键 val-值 dir-目录 min-去除空格)
function setfcache($key = '', $val = '', $dir = 'com', $min = false, $slize = false)
{
	$md5 = md5 ( $key );
	$cdir = BAIYU_DATA . '/cache' . ($dir == '' ? '' : '/' . $dir) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 );
	if(! is_dir ( $cdir ))
	{
		loadlib ( 'dir.func' );
		creatdir ( $cdir );
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
		$cata = '<?php' . "\r\n" . 'if(!defined(\'BAIYU_ROOT\')){' . "\r\n" . 'header(\'HTTP/1.1 404 Not Found\');' . "\r\n" . 'exit();' . "\r\n" . '}' . "\r\n" . 'return ';
		$cata .= $cache;
		$cata .= ";\r\n?>";
	}
	file_put_contents ( $cfile, $cata );
	@chmod ( $cfile, 0777 );
}
function getfcache($key = '', $dir = 'com', $time = -1, $slize = false)
{
	if(trim ( $key ) == '')
		return false;
	$md5 = md5 ( $key );
	$cfile = BAIYU_DATA . '/cache' . ($dir == '' ? '' : '/' . $dir) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 ) . '/' . substr ( $md5, 4, 28 ) . ($slize ? '.inc' : '.php');
	if(! is_file ( $cfile ))
	{
		return false;
	}
	if($time == - 1)
	{
		$rs = parsefcache ( $cfile, $slize );
		return $rs;
	}
	$time = intval ( $time );
	$date = @filemtime ( $cfile );
	if(($date + $time) < time ())
	{
		return false;
	}
	$rs = parsefcache ( $cfile, $slize );
	return $rs;
}
function parsefcache($file = '', $slize = false)
{
	if($slize)
	{
		$str = file_get_contents ( $file );
		$rs = str_array ( $str, 1 );
		$rs = isset ( $rs['data'] ) ? $rs['data'] : false;
	}
	else
	{
		$rs = include ($file);
	}
	return $rs;
}
function delfcache($key = '', $dir = 'com')
{
	if(trim ( $key ) == '')
		return false;
	$md5 = md5 ( $key );
	$cfile = BAIYU_DATA . '/cache' . ($dir == '' ? '' : '/' . $dir) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 ) . '/' . substr ( $md5, 4, 28 ) . '.php';
	@unlink ( $cfile );
}