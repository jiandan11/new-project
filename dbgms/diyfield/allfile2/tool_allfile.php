<?php
@set_time_limit ( 0 );
if(! defined ( 'BAIYU_ADMIN' ))
{
	header ( 'HTTP/1.1 404 Not Found' );
	exit ();
}

$ac = isset ( $ac ) ? $ac : '';
switch($ac)
{
	// 裁剪图片
	case 'imgcut':
		$src = isset ( $src ) ? trim ( $src ) : '';
		$allfile_uptype = isset ( $cuttype ) ? $cuttype : ''; // 裁剪类型
		if($src == '')
		{
			echo 0;
			exit ();
		}
		if(strpos ( $src, 'http://' ) !== false)
		{
			$src = cofile_one ( $src, '', 1 );
			if(strpos ( $src, 'http://' ) === false)
			{
				$nsrc = $src;
			}
			else
			{
				$src = '';
			}
		}
		else
		{
			$keep = isset ( $keep ) ? intval ( $keep ) : 0;
			if($keep > 0)
			{
				$dir = dirname ( $src );
				$nme = time () . rand ( 100, 99999 );
				$ext = getext ( $src );
				// 保存的新名称
				$nsrc = $dir . '/' . $nme . '.' . $ext;
				// 新文件路径
				$newfile = BAIYU_FILE . '/allfile_tempfile/' . $nme . '.' . $ext;
			}
			else
			{
				$nsrc = $src;
			}
		}
		/* 阿里云OSS */
		if($allfile_uptype == 'oss' || $allfile_uptype == 'OSS')
		{
			// 下载文件的路径
			require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/conf.inc.php';
			$fileservepath = "http://" . OSS_ENDPOINT . "/" . OSS_BUCKET_BENSHOUJI;
		}
		elseif($allfile_uptype == 'fastdfs' || $allfile_uptype == 'FASTDFS')
		{
			$fileservepath = $_glb['down_addr1']; // "http://g1.benimg.com";
		}
		$_down_file = allfile_down_image ( BAIYU_FILE . '/allfile_tempfile', $fileservepath . $src );
		if($src == '' || ! is_file ( $_down_file ))
		{
			echo 0;
			exit ();
		}
		// 旧文件名字
		$file = $_down_file;
		// 保存的名字
		$oss_sava_name = ltrim ( $nsrc, "/" );
		$resize = isset ( $resize ) ? $resize : 0;
		if($resize == 1)
		{
			$width = isset ( $width ) ? intval ( $width ) : 0;
			$height = isset ( $height ) ? intval ( $height ) : 0;
			$tosmall = isset ( $tosmall ) ? $tosmall : 0;
			$bcolor = isset ( $bcolor ) ? $bcolor : '#FFFFFF';
			if($bcolor == 'resize')
			{
				$bcolor = '';
			}
			else
			{
				$bcolor = str_replace ( '#', '', $bcolor );
			}
			$rs = false;
			if($width && $height)
			{
				loadlib ( 'image.func' );
				$rs = imgresize ( $file, $newfile, $width, $height, 95, false, '#fff', $tosmall );
			}
			
			/* 阿里云OSS */
			if($allfile_uptype == 'oss' || $allfile_uptype == 'OSS')
			{
				/* 保存到阿里云OSS */
				require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/sdk.class.php';
				$client = new ALIOSS ();
				$oss_file_path = $newfile;
				$oss_options = null;
				$oss_response = $client->upload_file_by_file ( OSS_BUCKET_BENSHOUJI, $oss_sava_name, $oss_file_path, $oss_options );
			}
			elseif($allfile_uptype == 'fastdfs' || $allfile_uptype == 'FASTDFS')
			{
				
				/* 保存到 fastdfs */
				loadlib ( 'fastdfs.class' );
				$fdfs = new FDFS ();
				$fileinfo = $fdfs->upload ( $newfile );
				@unlink ( $file );
				@unlink ( $newfile );
				echo '/' . $fileinfo['remote_filename'];
				exit ();
			}
			@unlink ( $file );
			@unlink ( $newfile );
			echo $rs ? $nsrc : '';
		}
		else
		{
			$radio = isset ( $radio ) ? $radio : 1;
			$x1 = isset ( $x1 ) ? $x1 * $radio : 0;
			$x2 = isset ( $x2 ) ? $x2 * $radio : 0;
			$y1 = isset ( $y1 ) ? $y1 * $radio : 0;
			$y2 = isset ( $y2 ) ? $y2 * $radio : 0;
			$width = intval ( $x2 - $x1 );
			$height = intval ( $y2 - $y1 );
			$x = intval ( $x1 );
			$y = intval ( $y1 );
			// 复制裁剪
			loadlib ( 'image.func' );
			$rs = imgcut ( $file, $newfile, $width, $height, $x, $y );
			
			/* 阿里云OSS */
			if($allfile_uptype == 'oss' || $allfile_uptype == 'OSS')
			{
				/* 保存到阿里云OSS */
				require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/sdk.class.php';
				$client = new ALIOSS ();
				$oss_file_path = $newfile;
				$oss_options = null;
				$oss_response = $client->upload_file_by_file ( OSS_BUCKET_BENSHOUJI, $oss_sava_name, $oss_file_path, $oss_options );
			}
			elseif($allfile_uptype == 'fastdfs' || $allfile_uptype == 'FASTDFS')
			{
				
				/* 保存到 fastdfs */
				loadlib ( 'fastdfs.class' );
				$fdfs = new FDFS ();
				$fileinfo = $fdfs->upload ( $newfile );
				@unlink ( $file );
				@unlink ( $newfile );
				echo '/' . $fileinfo['remote_filename'];
				exit ();
			}
			@unlink ( $file );
			@unlink ( $newfile );
			echo $rs ? $nsrc : '';
		}
		exit ();
		break;
	
	case 'upload':
		$fieldName = isset ( $name ) ? $name . '_file' : ''; // 上传字段的名字
		$allfile_uptype = isset ( $allfile_uptype ) ? $allfile_uptype : ''; // 上传类型
		$allfile_filetype = isset ( $allfile_filetype ) ? $allfile_filetype : ''; // 上传文件类别
		if($allfile_filetype == 'images')
		{
			// 图片类型
			$fileTypes = array(
					'jpg',
					'jpeg',
					'png',
					'gif',
					'ico' 
			);
			$error_msg = "错误的文件类型！图片的格式只允许jpg,jpeg,png,gif,ico 。";
		}
		elseif($allfile_filetype == 'other')
		{
			// 文件类型
			$fileTypes = array(
					'txt',
					'html',
					'zip',
					'gz' 
			);
			$error_msg = "错误的文件类型！其他的格式只允许txt,html,zip,gz 。";
		}
		
		if(! empty ( $_FILES[$fieldName]['name'] ))
		{
			$tempFile = $_FILES[$fieldName]['tmp_name'];
			if(! is_dir ( $targetPath ))
			{
				loadlib ( 'dir.func' );
				File_creatdir ( $targetPath );
			}
			// 获取后缀
			$fileParts = pathinfo ( $_FILES[$fieldName]['name'] );
			$fileParts['extension'] = strtolower ( $fileParts['extension'] );
			// 符合 后缀
			if(in_array ( $fileParts['extension'], $fileTypes ))
			{
				if($allfile_uptype == 'oss' || $allfile_uptype == 'OSS')
				{
					// 保存的名字
					$savasign = isset ( $savasign ) ? $savasign : '';
					$ntime = time ();
					$aname = $ntime . rand ( 100, 699999 );
					$save_path = '/' . $savasign . timetostr ( $ntime, '/Y/md/' ) . $aname . '.' . $fileParts['extension'];
					
					/* 保存到阿里云OSS */
					require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/sdk.class.php';
					$client = new ALIOSS ();
					$oss_file_path = $tempFile;
					$oss_options = null;
					$oss_sava_name = ltrim ( $save_path, "/" ); // 删除开头的/
					$oss_response = $client->upload_file_by_file ( OSS_BUCKET_BENSHOUJI, $oss_sava_name, $oss_file_path, $oss_options );
					$ret['type'] = "ok";
					$ret['info'] = $save_path;
					echo json_encode ( $ret );
				}
				elseif($allfile_uptype == 'fastdfs' || $allfile_uptype == 'FASTDFS')
				{
					/* 保存到 fastdfs */
					loadlib ( 'fastdfs.class' );
					$fdfs = new FDFS ();
					$fileinfo = $fdfs->upload ( $tempFile );
					// $furl = $_glb['down_addr1'].'/'.$fileinfo['remote_filename'];
					
					$ret['type'] = "ok";
					$ret['info'] = '/' . $fileinfo['remote_filename'];
					echo json_encode ( $ret );
				}
			}
			else
			{
				echo $error_msg;
				exit ();
			}
		}
		break;
	case 'delete':
		/**
		 * 删除object
		 */
		$filepath = isset ( $filepath ) ? $filepath : ''; // 裁剪类型
		if(! empty ( $file_path ))
		{
			/* 删除oOSS */
			require_once BAIYU_LIB . DIRECTORY_SEPARATOR . 'oss_php_sdk_20150807/sdk.class.php';
			$client = new ALIOSS ();
			/**
			 * 判断object是否存在
			 */
			$res = $client->is_object_exist ( OSS_BUCKET_BENSHOUJI, $file_path );
			if($res->status === 404)
			{
			}
			if($res->status === 200)
			{
				$oss_response = $client->delete_object ( OSS_BUCKET_BENSHOUJI, $file_path );
			}
		}
		
		break;
}
function allfile_down_image($save_path, $file_url)
{
	$filename = $save_path . '/' . strrchr ( $file_url, "/" );
	ob_start ();
	readfile ( $file_url );
	$img = ob_get_contents ();
	ob_end_clean ();
	$size = strlen ( $img );
	$fp2 = @fopen ( $filename, "a" );
	fwrite ( $fp2, $img );
	fclose ( $fp2 );
	return $filename;
}
?>