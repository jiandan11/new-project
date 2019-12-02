<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
/*
 * dbg 图片处理常用方法
 */
// 获取字符串中的图片地址
function matchImgs($str = '', $ishttp = 0)
{
	$rs = array();
	$str = stripslashes ( $str );
	if(preg_match_all ( "/<img( ||.*?)src=('|\"|)(.*?)('|\"|>| )([^>].*?>)/is", $str, $ary ))
	{
		$imgs = $ary[3];
		$imgs = array_unique ( $imgs );
		foreach($imgs as $img)
		{
			$img = trim ( $img );
			$go = $img == '' ? 0 : ($ishttp ? (strpos ( $img, 'http://' ) === false ? 0 : 1) : 1);
			if($go)
			{
				$rs[] = $img;
			}
		}
	}
	return $rs;
}
/*
 * 图片上传
 * $save_path 保存路径
 */
function dbg_img_upload($save_path, $save_type = 1)
{
	// 存储路径,保存类别 ,默认： 根路径/年/月日
	if($save_type == 1)
	{
		$patharr = array(
				$save_path,
				$save_path . date ( 'Y', time () ),
				$save_path . date ( 'Y', time () ) . "/" . date ( 'md', time () ) 
		);
		$return_path = $patharr[2];
	}
	elseif($save_type == 2)
	{
		$patharr = array(
				$save_path 
		);
		$return_path = $patharr[0];
	}
	// 如果路径不存在,创建文件夹
	foreach($patharr as $val)
	{
		if(! file_exists ( $val ))
		{
			if(! mkdir ( $val, 0777, true ))
			{ // 如果指定文件夹不存在，则创建文件夹,权限0777
				exit ( '创建保存文件目录失败,请联系管理员检查目录权限' );
			}
		}
	}
	return $return_path;
}

/*
 * 文件操作类 ***********************************************
 */
function basedir($filename)
{
	$dirs = explode ( '/', $filename );
	$dir = '';
	foreach($dirs as $dd)
	{
		if(trim ( $dd ) != '')
		{
			$dir .= ($dir != '' ? '/' : '') . $dd;
		}
	}
	return $dir;
}
function getext($filename)
{
	return strtolower ( trim ( substr ( strrchr ( $filename, '.' ), 1, 10 ) ) );
}

// 文件名存在检测
function filenametest($filedir, $givename)
{
	$ext = '.' . getext ( $givename );
	$filename = substr ( $givename, 0, strlen ( $givename ) - strlen ( $ext ) );
	if(file_exists ( $filedir . '/' . $filename . $ext ))
	{
		for($i = 1;$i <= 5000;$i ++)
		{
			if(! file_exists ( $filedir . '/' . $filename . '-' . getalbumnum ( $i ) . $ext ))
			{
				$filename = $filename . '-' . getalbumnum ( $i );
				break;
			}
		}
	}
	return $filename . $ext;
}
function files_isimg($filetype = '')
{
	$sparr = Array(
			'image/pjpeg',
			'image/jpeg',
			'image/gif',
			'image/png',
			'image/xpng',
			'image/wbmp' 
	);
	return in_array ( $filetype, $sparr );
}
// 图片打水印
function dbg_img_watermark()
{
}
// 图片缩略图
function dbg_img_thumb()
{
}
// 图片删除
function dbg_img_delete()
{
}