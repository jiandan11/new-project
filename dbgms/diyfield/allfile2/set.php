<?php
if(! defined ( 'BAIYU_ROOT' ))
{
	header ( 'HTTP/1.1 404 Not Found' );
	exit ();
}
function gfields_forms_allfile($key, $fields, $get = array())
{
	global $_glb;
	$field = $fields[$key];
	$type = $field['field'];
	$atts = $field['atts'];
	// 判断是否是图片类型
	$imgtypes = array(
			'jpg',
			'gif',
			'jpeg',
			'png',
			'bmp' 
	);
	$stypes = isset ( $atts['types'] ) ? trim ( $atts['types'] ) : '';
	$stypes = explode ( ',', strtolower ( $stypes ) );
	$isimg = true;
	$types = array();
	foreach($stypes as $stype)
	{
		$stype = trim ( $stype );
		if($stype != '')
		{
			if(! in_array ( $stype, $imgtypes ))
			{
				$isimg = false;
			}
			$types[] = $stype;
		}
	}
	$atts['types'] = implode ( ',', $types );
	/*
	 * 最初设计是 Ajax上传图片时 就根据需求打上水印 考虑到裁剪 采集等需求 此方案不合理 这里先 强制 水印为否 在表单入库时对水印缩放等设置进行操作
	 */
	$atts['water'] = 0;
	// 缩放选项
	$atts['bcolor'] = $atts['bgcolor'] == 'color' ? $atts['color'] : $atts['bgcolor'];
	
	$value = isset ( $get[$key] ) ? $get[$key] : '';
	if($value == '')
	{
		$value = isset ( $atts['val'] ) ? $atts['val'] : '';
	}
	
	$upload_arr = explode ( "\n", $atts['diys'] );
	$upload_options = array();
	foreach($upload_arr as $k=>$val)
	{
		$row = explode ( "|", $val );
		$upload_options[$row[0]] = $row[1];
	}
	
	if($upload_options['uptype'] == 'oss' || $upload_options['uptype'] == 'OSS')
	{
		require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/conf.inc.php';
		$upload_options['url'] = "http://" . OSS_ENDPOINT . '/' . OSS_BUCKET_BENSHOUJI;
	}
	elseif($upload_options['uptype'] == 'fastdfs' || $upload_options['uptype'] == 'FASTDFS')
	{
		$upload_options['url'] = $_glb['down_addr1']; // "http://g1.benimg.com";
	}
	
	$atts['width'] = $upload_options['width'];
	$atts['height'] = $upload_options['height'];
	
	ob_start ();
	include load_template ( BAIYU_FIELDS . '/allfile/form.html' );
	$data = ob_get_contents ();
	ob_clean ();
	return $data;
}

// 入库处理
function gfields_input_allfile($key, $fields, $get = array())
{
	$field = $fields[$key];
	$type = $field['field'];
	$atts = $field['atts'];
	
	$val = isset ( $get[$key] ) ? $get[$key] : '';
	$clt = $key . '_crt';
	$clt = isset ( $get[$clt] ) ? $get[$clt] : 0;
	
	$imgtypes = array(
			'jpg',
			'gif',
			'jpeg',
			'png',
			'bmp' 
	);
	$stypes = isset ( $atts['types'] ) ? trim ( $atts['types'] ) : '';
	$stypes = explode ( ',', strtolower ( $stypes ) );
	$isimg = true;
	$types = array();
	foreach($stypes as $type)
	{
		$type = trim ( $type );
		if($type != '')
		{
			if(! in_array ( $type, $imgtypes ))
			{
				$isimg = false;
			}
			$types[] = $type;
		}
	}
	
	$val = trim ( $val );
	$sval = strtolower ( $val );
	
	return $val;
}

// 前台解析
function gfields_parse_allfile($key, $fields, $row = array())
{
	global $_glb;
	$field = $fields[$key];
	$url = $row[$key];
	
	$upload_arr = explode ( "\n", $atts['diys'] );
	$upload_options = array();
	foreach($upload_arr as $k=>$val)
	{
		$row = explode ( "|", $val );
		$upload_options[$row[0]] = $row[1];
	}
	
	if($upload_options['uptype'] == 'oss' || $upload_options['uptype'] == 'OSS')
	{
		$row[$key] = strpos ( $url, 'http://' ) === false ? ($url == '' ? '' : $_glb['down_oss'] . $url) : $url;
	}
	elseif($upload_options['uptype'] == 'fastdfs' || $upload_options['uptype'] == 'FASTDFS')
	{
		$row[$key] = strpos ( $url, 'http://' ) === false ? ($url == '' ? '' : $_glb['down_addr1'] . $url) : $url;
	}
	
	return $row;
}

// 后台 列表中显示该字段 (当前字段配置 字段名 art值数组)
function gfields_adminListShow_allfile($field = array(), $key = '', $art = array())
{
	global $_glb;
	$val = isset ( $art[$key] ) ? $art[$key] : '';
	$rs = '';
	if($val != '')
	{
		
		$upload_arr = explode ( "\n", $atts['diys'] );
		$upload_options = array();
		foreach($upload_arr as $k=>$val)
		{
			$row = explode ( "|", $val );
			$upload_options[$row[0]] = $row[1];
		}
		
		if($upload_options['uptype'] == 'oss' || $upload_options['uptype'] == 'OSS')
		{
			$file = str_replace ( $_glb['down_oss'], '', $val );
		}
		elseif($upload_options['uptype'] == 'fastdfs' || $upload_options['uptype'] == 'FASTDFS')
		{
			$file = str_replace ( $_glb['down_addr1'], '', $val );
		}
		
		$data = array();
		$data['type'] = $field['field'];
		$data['url'] = $file;
		$data = json_encode ( $data );
		if(strpos ( $file, 'http://' ) === false)
		{
			$rs = '<img src="index.php?tn=do&ac=swfup_show&img=' . urlencode ( $file ) . '"  class="AutoPreview" data=\'' . $data . '\'/>';
		}
		else
		{
			$imgtypes = array(
					'jpg',
					'gif',
					'jpeg',
					'png',
					'bmp' 
			);
			$ext = getext ( $file );
			if(in_array ( $ext, $imgtypes ))
			{
				$rs = '<img src="' . $file . '"  style="width:80px;height:60px" class="AutoPreview" data=\'' . $data . '\'/>';
			}
			else
			{
				$rs = strtoupper ( $ext ) . '文件';
			}
		}
	}
	return $rs;
}

// 删除字段中相关附件
function gfields_delfile_allfile($key, $fields, $row = array())
{
	global $_glb;
	$field = $fields[$key];
	$url = trim ( $row[$key] );
	$vurl = strtolower ( $url );
	if($url != '' && strpos ( $vurl, 'http://' ) === false)
	{
		// $file = BAIYU_FILE . $url;
		$file = ltrim ( $url, "/" ); // 删除开头的/
		if(! empty ( $file ))
		{
			/* 删除oOSS */
			require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/sdk.class.php';
			$client = new ALIOSS ();
			/**
			 * 判断object是否存在
			 */
			$res = $client->is_object_exist ( OSS_BUCKET_BENSHOUJI, $file );
			if($res->status === 404)
			{
			}
			if($res->status === 200)
			{
				$oss_response = $client->delete_object ( OSS_BUCKET_BENSHOUJI, $file );
			}
		}
		// @unlink ( $file );
	}
}

?>