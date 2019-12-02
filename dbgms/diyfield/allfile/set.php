<?php
if(! defined ( 'DBGMS_ROOT' ))
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
		$upload_options['url'] = "http://benshouji.oss-cn-hangzhou.aliyuncs.com";
		// 文件夹 || 栏目 || model
		$upload_options['modelsign'] = "aaaaaa";
	}
	elseif($upload_options['uptype'] == 'fastdfs' || $upload_options['uptype'] == 'FASTDFS')
	{
		$upload_options['url'] = "http://g1.benimg.com"; // $_glb['down_addr1']
	}
	var_dump ( $upload_arr );
	var_dump ( $upload_options );
	
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
	if($isimg)
	{
		// 之前上传
		$dkey = $key . '_old';
		$oldfile = isset ( $get[$dkey] ) ? $get[$dkey] : '';
		$needWater = false;
		if(strpos ( $sval, 'http://' ) === false || strpos ( $sval, 'https://' ) === false)
		{
			/*
			 * 本地地址 不再进行后缀判断了 部分情况图片地址也不一定是后缀可以唯一确定的
			 */
			if($val == '')
			{
				// 留空 放弃原文件
				if($oldfile != '' && strpos ( $oldfile, 'http://' ) === false && is_file ( BAIYU_FILE . $oldfile ))
				{
					@unlink ( BAIYU_FILE . $oldfile );
				}
			}
			else
			{
				if($oldfile != $val)
				{
					$needWater = true;
				}
			}
		}
		else
		{
			// 如需采集
			if($clt == 1)
			{
				$tdir = str_replace ( 'http://', '', $sval );
				$tdirs = explode ( '/', $tdir );
				$tdir = $tdirs[count ( $tdirs ) - 1];
				$ext = $tdir != '' ? getext ( $tdir ) : '';
				if($ext == '' || in_array ( $ext, $imgtypes ))
				{
					loadlib ( 'httpdown' );
					loadlib ( 'dir.func' );
					$http = new HttpDown ();
					$http->openurl ( $val );
					if($http->getok ())
					{
						if($ext == '')
						{
							$mimetype = $http->get_head ( 'content-type' );
							$ext = mime_ext ( $mimetype );
							if(! in_array ( $ext, $imgtypes ))
							{
								$ext = '';
							}
						}
						if($ext != '')
						{
							$ntime = time ();
							$dir = $atts['dir'] == '' ? ext_dir ( $ext ) : $atts['dir'];
							$basename = $ntime . rand ( 100, 9999 );
							$url = '/' . $dir . timetostr ( $ntime, '/Y/md/' ) . $basename . '.' . $ext;
							$savefile = BAIYU_FILE . $url;
							$dir = dirname ( $savefile );
							if(! is_dir ( $dir ))
							{
								File_creatdir ( $dir );
							}
							$rs = $http->down ( $savefile );
							if($rs)
							{
								$val = $url;
							}
						}
					}
					$http->close ();
				}
			} // End clt
			  
			// 本次填写HTTP 代表放弃原文件
			if($oldfile != '' && strpos ( $oldfile, 'http://' ) === false && is_file ( BAIYU_FILE . $oldfile ))
			{
				@unlink ( BAIYU_FILE . $oldfile );
			}
			if(strpos ( $sval, 'http://' ) === false)
			{
				$needWater = true;
			}
		}
		$sval = strtolower ( $val );
		if($sval != '' && strpos ( $sval, 'http://' ) === false)
		{
			loadlib ( 'image.func' );
			// 强制缩放
			if($atts['resize'] == 1 && $atts['width'] > 0 && $atts['height'] > 0)
			{
				$bcolor = $atts['bgcolor'];
				if($bcolor == 'resize')
				{
					$bcolor = '';
				}
				elseif($bcolor == 'color')
				{
					$bcolor = $atts['color'];
				}
				imgresize ( BAIYU_FILE . $val, BAIYU_FILE . $val, $atts['width'], $atts['height'], 95, false, $bcolor, $atts['tosmall'] );
			}
			// 水印
			if($needWater && $atts['water'] == 1)
			{
				$waterfile = $atts['waterfile'];
				if($waterfile != '')
				{
					$waterfile = BAIYU_DAT . '/watermark/' . $waterfile;
					$waterpos = isset ( $atts['waterpos'] ) ? $atts['waterpos'] : 9;
					imagewatermark ( BAIYU_FILE . $val, $waterpos, $waterfile );
				}
			}
		}
	}
	else
	{
		// 之前上传
		$dkey = $key . '_old';
		$oldfile = isset ( $get[$dkey] ) ? $get[$dkey] : '';
		
		if(strpos ( $sval, 'http://' ) === false)
		{
			// 本地地址 不再进行后缀判断了 留空 放弃原文件
			if($val == '' && $oldfile != '' && strpos ( $oldfile, 'http://' ) === false && is_file ( BAIYU_FILE . $oldfile ))
			{
				@unlink ( BAIYU_FILE . $oldfile );
			}
		}
		else
		{
			if($clt)
			{
				// 非图片类型的附近采集 就不那么迁就了 必须符合后缀
				$tdir = str_replace ( 'http://', '', $sval );
				$tdirs = explode ( '/', $tdir );
				$tdir = $tdirs[count ( $tdirs ) - 1];
				$ext = $tdir != '' ? getext ( $tdir ) : '';
				if($ext != '' && in_array ( $ext, $types ))
				{
					loadlib ( 'httpdown' );
					loadlib ( 'dir.func' );
					$http = new HttpDown ();
					$http->openurl ( $val );
					if($http->getok ())
					{
						$ntime = time ();
						$dir = $atts['dir'] == '' ? ext_dir ( $ext ) : $atts['dir'];
						$basename = $ntime . rand ( 100, 9999 );
						$url = '/' . $dir . timetostr ( $ntime, '/Y/md/' ) . $basename . '.' . $ext;
						$savefile = BAIYU_FILE . $url;
						$dir = dirname ( $savefile );
						if(! is_dir ( $dir ))
						{
							File_creatdir ( $dir );
						}
						$rs = $http->down ( $savefile );
						if($rs)
						{
							$val = $url;
						}
					}
					$http->close ();
				}
			} // End clt
			  
			// 本次填写HTTP 代表放弃原文件
			if($oldfile != '' && strpos ( $oldfile, 'http://' ) === false && is_file ( BAIYU_FILE . $oldfile ))
			{
				@unlink ( BAIYU_FILE . $oldfile );
			}
		}
	}
	return $val;
}

// 前台解析
function gfields_parse_allfile($key, $fields, $row = array())
{
	global $_glb;
	$field = $fields[$key];
	$url = $row[$key];
	$row[$key] = strpos ( $url, 'http://' ) === false ? ($url == '' ? '' : $_glb['fileurl'] . $url) : $url;
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
		$file = str_replace ( $_glb['fileurl'], '', $val );
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
		$file = BAIYU_FILE . $url;
		@unlink ( $file );
	}
}

?>