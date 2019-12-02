<?php
// header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
// header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
date_default_timezone_set ( "Asia/chongqing" );
error_reporting ( E_ERROR );
header ( "Content-Type: text/html; charset=utf-8" );

$CONFIG = json_decode ( preg_replace ( "/\/\*[\s\S]+?\*\//", "", file_get_contents ( "config.json" ) ), true );
//获取管理员功能设置
// 如果站点关闭了删除图片功能 则文章里面的图片资源就放在临时图片路径
/*   
define ( 'DBGMS_ROOT', TRUE );
$rootfuncs = require_once $_SERVER['DOCUMENT_ROOT'] . '/data/config.rootfuncs.php';
$endelimg = intval($rootfuncs['config']['endelimg']);
if( !$endelimg ){//如果设置关闭了 删除文章的同时 删除图片 就把图片放到content目录下
        $CONFIG['imagePathFormat'] = str_replace('tmp_img', 'content', $CONFIG['imagePathFormat']);
}
 */
$action = $_GET['action'];

switch($action)
{
	case 'config':
		$result = json_encode ( $CONFIG );
		break;
	
	/* 上传图片 */
	case 'uploadimage':
	/* 上传涂鸦 */
	case 'uploadscrawl':
	/* 上传视频 */
	case 'uploadvideo':
	/* 上传文件 */
	case 'uploadfile':
		$result = include ("action_upload.php");
		break;
	
	/* 列出图片 */
	case 'listimage':
		$result = include ("action_list.php");
		break;
	/* 列出文件 */
	case 'listfile':
		$result = include ("action_list.php");
		break;
	
	/* 抓取远程文件 */
	case 'catchimage':
		$result = include ("action_crawler.php");
		break;
	
	default:
		$result = json_encode ( array(
				'state' => '请求地址出错' 
		) );
		break;
}

/* 输出结果 */
if(isset ( $_GET["callback"] ))
{
	if(preg_match ( "/^[\w_]+$/", $_GET["callback"] ))
	{
		echo htmlspecialchars ( $_GET["callback"] ) . '(' . $result . ')';
	}
	else
	{
		echo json_encode ( array(
				'state' => 'callback参数不合法' 
		) );
	}
}
else
{
	echo $result;
}
