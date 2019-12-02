<?php
if(! defined ( 'DBG_OPEN' ))
{ // 页面跳转
	header ( 'HTTP/1.1 404 Not Found' );
	// header ( 'Location:install' );
	// echo '<meta http-equiv="refresh" content="5; url=index.com/" />'该页面不允许单独访问,5秒后跳转<br/>'';
	exit ( '权限路径.No direct script access allowed' );
}
// 根权限
define ( 'DBGMS_ROOT', TRUE );
// header ( "Content-type: text/html; charset=utf-8" );
// header ( "Content-type:application/json" );
// 定义应用目录
require (dirname ( __FILE__ ) . '/config.inc.php');
// require _DBGMS_CORE_ . 'Admin.class.core.php';
// require _DBGMS_MODULES_ . 'base/controllers/init.php';
$_dbg_glb = dbg_domain_website_get ();
define ( 'DBG_TITLE', $_dbg_glb['base']['title'] ); // 网站标题
define ( 'DBG_SITEURL', $_dbg_glb['base']['domain'] ); // 默认站点
define ( 'DBG_MOBILEURL', $_dbg_glb['domain']['mobile'] ); // 手机站点
define ( 'DBG_FILEURL', $_dbg_glb['domain']['file'] ); // 文件站点

/* 是否加zh */
// define ( 'DBG_SITETYPE', '' );
define ( 'DBG_SITETYPE', 'zh/' ); // 是否加zh
define ( 'DBG_URLSAVECACHE', $_dbg_glb['domain']['savecache'] ); // url写入缓存

// url参数说明
/*
 * xxx.com?m=1&c=2&a=3&u=4&do=5&t=5
 * m = modules 模块
 * c = controllers 控制器
 * a = action 意图
 * u = use 功能
 * do= do 做什么
 * t = type 类别
 * ...其他参数
 */
// url参数说明
/*
 * xxx.com/index/mod?con=1&act=2&use=3&do=5&t=5
 * mod = modules 模块
 * con = controllers 控制器
 * act = action 意图
 * use = use 功能
 * do= do 做什么
 * t = type 类别
 * ...其他参数
 */