<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );

// 模式 描述
// r 打开文件为只读。文件指针在文件的开头开始。
// w 打开文件为只写。删除文件的内容或创建一个新的文件，如果它不存在。文件指针在文件的开头开始。
// a 打开文件为只写。文件中的现有数据会被保留。文件指针在文件结尾开始。创建新的文件，如果文件不存在。
// x 创建新文件为只写。返回 FALSE 和错误，如果文件已存在。
// r+ 打开文件为读/写、文件指针在文件开头开始。
// w+ 打开文件为读/写。删除文件内容或创建新文件，如果它不存在。文件指针在文件开头开始。
// a+ 打开文件为读/写。文件中已有的数据会被保留。文件指针在文件结尾开始。创建新文件，如果它不存在。
// x+ 创建新文件为读/写。返回 FALSE 和错误，如果文件已存在。
// 我的直接

// @action: dir 目录替换
function dbg_dir_replace($dir = '')
{
	if($dir != '')
	{
		$dir = str_replace ( "\\", "/", $dir );
		$dir = preg_replace ( "/(.+?)\/*$/", "/\\1", $dir );
		$dir = preg_replace ( "/\/{1,}/", '/', $dir );
	}
	return $dir;
}
// @action:文件下载
function dbg_file_download($url = NULL, $savepath = NULL, $savetype = NULL, $savename = NULL)
{
	if($url == NULL)
	{
		exit ( 'url链接不能为空' );
	}
	if($savepath == NULL)
	{
		exit ( '保存 路径 链接不能为空' );
	}
	if($savename == NULL)
	{
		$savename = strrchr ( $url, "/" ) . "\n";
		$savename = str_replace ( "/", '', $savename ); // 文件名
	}
	// 保存形式,也要根据 链接的最后 一节，判断类型
	switch($savetype)
	{
		case 'css':
		case 'images':
		case 'js':
			
			$savepath .= "/" . $savetype . "/";
			dbg_file_create ( $savepath );
			$savepath .= $savename;
			$savepath = dbg_str_replace ( $savepath );
			$content = file_get_contents ( $url );
			file_put_contents ( $savepath, $content );
			break;
		case 'html':
			$savepath .= "/";
			dbg_file_create ( $savepath );
			$savepath .= $savename;
			$savepath = dbg_str_replace ( $savepath );
			$content = file_get_contents ( $url );
			file_put_contents ( $savepath, $content );
			break;
	}
}
// @action:创建多级目录文件
function dbg_file_create($dir = NULL, $mode = 0777, $type = 1)
{
	// 方法1
	if($type == 1)
	{
		if(trim ( $dir ) == '')
			exit ( '路径不能为空' );
		$dir = str_replace ( "\\", "/", $dir );
		// 文件存在或者 创建成功
		if(is_dir ( $dir ) || @mkdir ( $dir, $mode ))
		{
			chmod ( $dir, 0777 );
			return TRUE;
		}
		// 创建上级目录失败的话
		if(! dbg_file_create ( dirname ( $dir ), $mode ))
		{
			return FALSE;
		}
		// return @mkdir ( $dir, $mode );原本
		@mkdir ( $dir, $mode );
		return chmod ( $dir, $mode );
	}
	// 方法3
	elseif($type == 3)
	{
		$basefix = DBG_FILE;
		if(trim ( $dir ) == '')
			return '';
		if($basefix != '')
		{
			$basedir = $basefix;
		}
		else
		{
			if(strpos ( $dir, BAIYU_FILE ) !== false)
			{
				$basedir = BAIYU_FILE;
			}
			else
			{
				$basedir = BAIYU_ROOT;
			}
		}
		$dir = str_replace ( $basedir, '', $dir );
		$dir = str_replace ( "\\", "/", $dir );
		$dir = $dir{0} == '/' ? substr ( $dir, 1, strlen ( $dir ) ) : $dir;
		$dir = $dir{strlen ( $dir ) - 1} == '/' ? substr ( $dir, 0, strlen ( $dir ) - 1 ) : $dir;
		$ars = explode ( '/', $dir );
		if(count ( $ars ) < 2)
		{
			return makedir ( $basedir . '/' . $dir );
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
		return '';
	}
}

// 创建文件夹 确定文件夹上级目录 存在
function makedir($dir)
{
	if(trim ( $dir ) == '')
		return '';
	$dir = str_replace ( "\\", "/", $dir );
	if(! is_dir ( $dir ))
	{
		if(@mkdir ( $dir, 0777 ))
		{
			chmod ( $dir, 0777 );
			return '';
		}
		else
		{
			return '创建目录失败';
		}
	}
	return '';
}

// 创建文件 文件存储目录确定存在 文件名 写入数据str
function makefile($file, $data)
{
	if($file == '')
		return '';
	if(@file_put_contents ( $file, $data ))
	{
		chmod ( $file, 0777 );
		return '';
	}
	else
	{
		return '创建文件失败';
	}
	return '';
}

// 创建文件 文件存储目录不一定存在 文件名 写入数据str
function creatfile($file, $data)
{
	$file_dir = preg_replace ( '/^(.*)\/(.*)/', '\\1', $file );
	echo $file_dir;
	if(! is_dir ( $file_dir ))
	{
		$rs = dbg_file_create ( $file_dir, 0777, 3 );
		if($rs != '')
		{
			return $rs;
		}
	}
	return makefile ( $file, $data );
}

// @action: 文件删除
function dbg_file_delete($dir, $type = TRUE)
{
	// 先删除目录下的文件：
	$dh = opendir ( $dir );
	while($file = readdir ( $dh ))
	{
		if($file != "." && $file != "..")
		{
			$fullpath = $dir . "/" . $file;
			if(! is_dir ( $fullpath ))
			{
				if(file_exists ( $fullpath ))
				{
					unlink ( $fullpath );
				}
			}
			else
			{
				dbg_file_delete ( $fullpath );
			}
		}
	}
	closedir ( $dh );
	if($type == TRUE)
	{
		// 删除当前文件夹：
		if(rmdir ( $dir ))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
/**
 * @uses 文件列表
 * @param string $dir
 * @param number $level
 * @param array $config
 */
function dbg_file_list($type = NULL, $dir, array $config = array(), $orderby = false, $orderdesc = 'asc')
{
	if($type == 'template')
	{
		$list = dbg_file_templatelist ( $dir, NULL, $config );
	}
	return $list;
}

// @action: 获取模板
function dbg_file_templatelist($dir = NULL, $level, array $config = array())
{
	/*
	 * 多种情况,筛选目录
	 */
	if(! empty ( $config['remove'] ))
	{ // 不排查的文件夹
		$config['remove'] = array(
				'errors' 
		);
	}
	else
	{
		$config['remove'] = array(
				'errors' 
		);
	}
	// 文件夹名字,默认不显示
	$config['showfile'] = FALSE;
	// 显示类型,默认显示类型1
	$config['showtype'] = 1;
	$arr = array();
	if(is_dir ( $dir ))
	{ // 开启 句柄
		$fp = opendir ( $dir );
		$file_list = array();
		while(FALSE !== $file = readdir ( $fp ))
		{
			if($file != '.' && $file != '..')
			{
				$file_ = iconv ( 'gb2312', 'utf-8', $file ); /* 保存目录名 可以取消注释 */
				// 为目录,递归
				if(is_dir ( $dir . '/' . $file_ ))
				{
					if(! in_array ( $file_, $config['remove'] ))
					{
						$list = dbg_file_templatelist ( $dir . '/' . $file_, $file_ );
						$file_list = array_merge ( $file_list, $list );
					}
				}
				else
				{
					$list = $dir . '/' . $file_;
					array_push ( $file_list, $list );
					// $list = empty ( $level ) ? $file_ : $level . '/' . $file_;
				}
			}
		}
		/* 关闭 句柄 */
		closedir ( $fp );
		/* 除去不要的数组 */
		if(empty ( $level ))
		{
			$result_list = array();
			foreach($file_list as $val)
			{
				$removepath = $dir . '/';
				$result_list[] = str_replace ( $removepath, '', $val );
			}
			unset ( $file_list );
			return $result_list;
		}
		else
		{
			return $file_list;
		}
	}
	else
	{
		return $dir . '不是有效目录';
	}
}
/*
 * @action: 写入文件
 * 【文件】 $path,文件存放路径; $type,模式; $content,文件内容;
 */
function dbg_file_put_contents($filename, $data)
{
}
function dbg_filecontent($filename = NULL, $content = NULL, $type = 1, $is_root = TRUE)
{
	/*
	 * 使用方法
	 * dbg_filecontent ( DBG_CONFIG . 'site.conf.php', $arr, 1 );
	 * dbg_filecontent ( DBG_CACHE . 'site.cache.php', $arr, 4 );
	 * $data = include (DBG_CONFIG . 'site.conf.php');
	 * $data = include (DBG_CACHE . 'site.cache.php');
	 * var_dump ( $data );
	 */
	switch($type)
	{
		/* 写入文件 */
		case 1: // 创建写入
		case 2: // 末尾追加
		case 3:
			$put_content = "";
			if($type == 1)
			{
				// 判断是否存在目录
				if(! is_dir ( $path ))
				{
					dbg_file_create ( $path );
				}
				// 创建新文件--增加开头define开头,判断权限
				$put_content .= "<?php \nif(!defined('DBGMS_ROOT')){\n\theader('HTTP/1.1 404 Not Found' );\n\texit('权限路径.No direct script access allowed');\n}\n";
				// w+ 打开文件为读/写。删除文件内容或创建新文件，如果它不存在。文件指针在文件开头开始。
				$open_type = "w+";
				$myfile = fopen ( $path, $open_type ) or die ( "无法打开文件！" );
				foreach($content as $arr_name=>$v0)
				{
					foreach($v0 as $k1=>$v1)
					{
						if(! is_array ( $v1 ))
						{
							if(is_numeric ( $v2 ))
							{
								$put_content .= "\${$arr_name}['$k1'] = $v1;\n";
							}
							else
							{
								$put_content .= "\${$arr_name}['$k1'] = '$v1';\n";
							}
						}
						else
						{
							foreach($v1 as $k2=>$v2)
							{
								if(is_numeric ( $v2 ))
								{
									$put_content .= "\${$arr_name}['$k1']['$k2'] = $v2;\n";
								}
								else
								{
									$put_content .= "\${$arr_name}['$k1']['$k2'] = '$v2';\n";
								}
							}
						}
					}
					$put_content .= "\n";
				}
			}
			elseif($type == 2)
			{
				// 开头
				// 'a' 写入方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
				// 'a+' 读写方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
				$open_type = "a";
				$myfile = fopen ( $path, $open_type ) or die ( "无法打开文件！" );
				foreach($content as $k0=>$v0)
				{
					foreach($v0 as $k1=>$v1)
					{
						foreach($v1 as $k2=>$v2)
						{
							if(is_numeric ( $v2 ))
							{
								$put_content .= "\$" . "{$k0}['$k1']['$k2'] = $v2;\n";
							}
							else
							{
								$put_content .= "\$" . "{$k0}['$k1']['$k2'] = \"$v2\";\n";
							}
						}
					}
					$put_content .= "\n";
				}
			}
			elseif($type == 3)
			{
				$put_content .= "<?php \nif(!defined('DBGMS_ROOT')){\n\theader('HTTP/1.1 404 Not Found' );\n\texit('权限路径.No direct script access allowed');\n}\n";
				
				// 打开文件
				$myfile = fopen ( $path, "w+" ) or die ( "无法打开文件！" );
				// 其他写入
				foreach($content as $val)
				{
					$put_content .= $val . "\n";
				}
			}
			// 写入
			fwrite ( $myfile, $put_content );
			// 关闭
			fclose ( $myfile );
			break;
		case 4:
			$file_dir = preg_replace ( '/^(.*)\/(.*)/', '\\1', $filename );
			
			// 判断是否存在目录
			if(! is_dir ( $file_dir ))
			{
				dbg_file_create ( $file_dir );
			}
			
			$put_content = var_export ( $content, true );
			// if($min){
			// $put_content = preg_replace("'([\r\n])[\s]+'", "",$cache);
			// }
			// $cata = "<?php \r\nif(!defined('DBGMS_ROOT')){\n\theader('HTTP/1.1 404 Not Found' );\n\texit('权限路径.No
			// direct script access allowed');\n}\nreturn ";
			$cata = '<?php' . "\r\n";
			if($is_root == TRUE)
			{
				$cata .= 'if(!defined(\'DBGMS_ROOT\')){' . "\r\n\t" . 'header(\'HTTP/1.1 404 Not Found\');' . "\r\n\t" . 'exit("权限路径.No direct script access allowed");' . "\r\n" . '}' . "\r\n";
			}
			$cata .= 'return ';
			$cata .= $put_content;
			$cata .= ";\r\n?>";
			file_put_contents ( $filename, $cata );
			break;
		/* 读取文件 */
		case 8:
			$myfile = fopen ( $path, "r+" ) or die ( "无法打开文件！" );
			// fread() 函数读取打开的文件。第一个参数包含待读取文件的文件名，第二个参数规定待读取的最大字节数。
			echo fread ( $myfile, filesize ( $path ) );
			// 读取单行文件 - fgets()文件的首行：
			echo fgets ( $myfile );
			// 输出单行直到 end-of-file
			while(! feof ( $myfile ))
			{
				echo fgets ( $myfile ) . "<br>";
			}
			// 输出单字符直到 end-of-file
			while(! feof ( $myfile ))
			{
				echo fgetc ( $myfile );
			}
			// 关闭
			fclose ( $myfile );
			break;
		/* 读取文件 */
		case 9:
			$html_text = file ( $path );
			foreach($html_text as $key=>$val)
			{
				echo "Line <b> $key</b> : " . htmlspecialchars ( $val ) . "<br />\n";
			}
			break;
	}
}

// @action:获取文件大小,并且格式化显示形式
function dbg_file_extsize($size = 0, $unit = 'Bty')
{
	$a = 1024 * 1024 * 1024 * 1024;
	$b = 1024 * 1024 * 1024;
	$c = 1024 * 1024;
	$d = 1024;
	$unit = strtolower ( $unit );
	$bsize = 0;
	if($unit == 'bty' || $unit == 'b')
	{
		$bsize = $size;
	}
	else if($unit == 'k' || $unit == 'kb')
	{
		$bsize = $size * $d;
	}
	else if($unit == 'm' || $unit == 'mb')
	{
		$bsize = $size * $c;
	}
	else if($unit == 'g' || $unit == 'gb')
	{
		$bsize = $size * $b;
	}
	else if($unit == 't' || $unit == 'tb')
	{
		$bsize = $size * $a;
	}
	$bsize = 10 * $bsize;
	if($bsize > $a * 10)
	{
		$rs = floor ( $bsize / $a ) / 10;
		$rs .= ' TB';
	}
	else if($bsize > $b * 10)
	{
		$rs = floor ( $bsize / $b ) / 10;
		$rs .= ' GB';
	}
	else if($bsize > $c * 10)
	{
		$rs = floor ( $bsize / $c ) / 10;
		$rs .= ' MB';
	}
	else if($bsize > $d * 10)
	{
		$rs = floor ( $bsize / $d ) / 10;
		$rs .= ' KB';
	}
	else
	{
		$rs = $bsize / 10;
		$rs .= ' Bty';
	}
	return $rs;
}
function ext_dir($ext = '')
{
	$ext = strtolower ( $ext );
	if(in_array ( $ext, array(
			'gif',
			'jpg',
			'jpeg',
			'png',
			'bmp' 
	) ))
	{
		$dir = 'image';
	}
	else if(in_array ( $ext, array(
			'doc',
			'docx',
			'xls',
			'xlsx',
			'ppt',
			'htm',
			'html',
			'txt',
			'zip',
			'rar',
			'gz',
			'bz2' 
	) ))
	{
		$dir = 'docs';
	}
	else if(in_array ( $ext, array(
			'swf',
			'flv' 
	) ))
	{
		$dir = 'flash';
	}
	else if(in_array ( $ext, array(
			'swf',
			'flv',
			'mp3',
			'wav',
			'wma',
			'wmv',
			'mid',
			'avi',
			'mpg',
			'asf',
			'rm',
			'rmvb' 
	) ))
	{
		$dir = 'media';
	}
	else
	{
		$dir = 'upload';
	}
	return $dir;
}

/*
 * 获取内容字段里面的图片地址 并将原来的内容替换
 */
function get_content_and_imgs($content = '',$img_path_word = 'content'){
        $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern,$content,$match);
        $content = str_replace('tmp_img', $img_path_word, $content);
        return array(
            'contents'=>$content,
            'imgs'=>$match['1']
        );
}

/*
 * 获取内容字段里面的图片地址
 */
function get_content_imgs($content = ''){
        $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern,$content,$match);
        return $match['1'];
}

/*
 * 将图片转移到file/content/年/月日 之下
 */
function move_tmp_imgs($imgarr = array(),$path_key_word = 'content'){
        foreach ($imgarr as $key => $value) {
                //找出图片数组中需要替换的成员
                if(strpos($value,'tmp_img')){
                        $img_need_move = dirname(_FILE_).$value;//存放需要转移的图片
                        $img_move_addr = dirname(_FILE_).str_replace('tmp_img',$path_key_word,dirname($value)).'/';//对应的图片要放到哪里
                        $img_new_name = $img_move_addr.basename($img_need_move);
                        //判断路径是否已经存在,若不存在则创建完整路径
                        if(!is_dir($img_move_addr)){
                            $rtn = mkdir($img_move_addr, 0777,true);
                        }
                        //开始移动图片到正确的路径
                        copy($img_need_move, $img_new_name);
                        unlink($img_need_move);
                        
                        $rtn_img_arr[] = str_replace('tmp_img',$path_key_word,$value);
                }else{
                        $rtn_img_arr[] = $value;
                }
        }
        return $rtn_img_arr;
}

function hello(){
    echo 'hi,I am here!';
}

/*
 * 在点击碎片管理的时候，执行清除临时图片操作
 */
function deldir($path) {
        $thisyear = date('Y', time());
        $thisdate = date('md', time());
        $today_tmp_dir = _FILE_ . 'tmp_img/' . $thisyear . '/' . $thisdate;
        if(!is_dir($today_tmp_dir)){
            mkdir($today_tmp_dir, 0777,TRUE);
        }
        $thisyear_tmp_dir = _FILE_ . 'tmp_img/' . $thisyear;
        $dh = opendir($path);
        while (($d = readdir($dh)) !== false) {
                if ($d == '.' || $d == '..') {//如果为.或..
                        continue;
                }
                $tmp = $path . '/' . $d;
                if($tmp == $today_tmp_dir){
                        continue;
                }
                if (!is_dir($tmp)) {//如果为文件
                        unlink($tmp);
                } else {//如果为目录
                        deldir($tmp);
                }
                rmdir($tmp);
        }
        closedir($dh);
}

/*
 * 对于本地文件的操作
 */

// 移动文件 旧路径 新路径
function move_file($old_path, $new_path, $isFiledir = 0, $error = '移动文件失败')
{
	$newdir = dirname ( $new_path );
	// echo $newdir;
	if(! is_dir ( $newdir ))
	{
		$ct = $isFiledir ? dbg_file_create ( $newdir, 0777, 3 ) : dbg_file_create ( $newdir, 0777, 3 );
		if($ct == '')
		{
			if(@rename ( $old_path, $new_path ))
			{
				return '';
			}
		}
	}
	else
	{
		if(@rename ( $old_path, $new_path ))
		{
			return '';
		}
	}
	return $error;
}

// 更改文件夹 文件
function change_file($path, $old_name, $new_name, $isFiledir = 0, $del_local = true)
{
	$path = preg_replace ( "/(.+?)\/*$/", "\\1/", $path );
	return move_file ( $path . $old_name, $path . $new_name, $isFiledir, '重命名文件失败' );
}

// 上传 移动文件
function file_put($locafile, $new_path, $isFiledir = 0, $del_local = true)
{
	if(empty ( $locafile ) || empty ( $new_path ))
	{
		return '';
	}
	$file_dir = preg_replace ( '/^(.*)\/(.*)/', '\\1', $new_path );
	if(! is_dir ( $file_dir ))
	{
		$rs = dbg_file_create ( $file_dir, 0777, 3 );
		if($rs != '')
		{
			return $rs;
		}
	}
	if(@move_uploaded_file ( $locafile, $new_path ))
	{
		@unlink ( $locafile );
		$result = '';
	}
	else
	{
		$rns = $del_local ? @rename ( $locafile, $new_path ) : copy ( $locafile, $new_path );
		if($rns)
		{
			$result = '';
		}
		else
		{
			$result = '移动文件失败';
		}
	}
	return $result;
}

// 清空一个目录
function clear_dir($dir)
{
	if(empty ( $dir ))
	{
		return '';
	}
	if(is_dir ( $dir ))
	{
		$dr = dir ( $dir );
		while($file = $dr->read ())
		{
			if($file == "." || $file == "..")
			{
				continue;
			}
			elseif(is_dir ( "$dir/$file" ))
			{
				clear_dir ( "$dir/$file" );
			}
			else
			{
				@unlink ( "$dir/$file" );
			}
		}
		$dr->close ();
		@rmdir ( $dir );
	}
	else
	{
		return '文件夹不存在';
	}
	return '';
}

/*
 * 上传一个文件 表单名 保存文件名 上传格式 最大上传 是否水印 水印地址 结果 -1 没有上传文件 -2 格式不允许 -3 超过大小限制 -4 附件不合法 -5 上传失败
 */
function upone($filefield, $setname = '', $upary = '', $maxsize = 0, $watermark = false, $waterfile = '', $isfls = true)
{
	global $_glb;
	$upfile = isset ( $_FILES[$filefield] ) ? $_FILES[$filefield] : '';
	if($upfile == '' || ! is_uploaded_file ( $upfile["tmp_name"] ) || $upfile["error"] != 0)
	{
		return - 1;
	}
	$safeext = array(
			'jpg',
			'jpeg',
			'gif',
			'png',
			'swf',
			'bmp',
			'txt',
			'zip',
			'rar',
			'doc',
			'mp3' 
	);
	$exttrue = getext ( $upfile['name'] );
	$upary = empty ( $upary ) ? join ( ',', $safeext ) : $upary;
	// 格式不允许
	if(! in_array ( $exttrue, explode ( ',', $upary ) ))
	{
		return - 2;
	}
	
	/*
	 * 文件名包含这些 强制拒绝
	 * if(preg_replace("/\.(php|phtml|php3|php4|jsp|exe|dll|asp|cer|asa|shtml|shtm|aspx|asax|cgi|fcgi|pl)/i",$upfile['name'])){
	 * return -4; }
	 */
	// 安全文件之外的 后缀重命名
	// $ext = in_array($exttrue, $safeext) ? $exttrue : $exttrue.'.rename';
	
	$ext = $exttrue;
	$isimg = 0;
	
	// 图片上传 源检测
	if(in_array ( $ext, array(
			'gif',
			'jpg',
			'jpeg',
			'png',
			'bmp' 
	) ))
	{
		$isimg = 1;
		$sparr = Array(
				"image/pjpeg",
				"image/jpeg",
				"image/gif",
				"image/png",
				"image/xpng",
				"image/x-png",
				"image/wbmp" 
		);
		if($isfls)
			$sparr[] = "application/octet-stream";
		$imgfile_type = strtolower ( trim ( $upfile['type'] ) );
		if(! in_array ( $imgfile_type, $sparr ))
		{
			return - 2;
		}
	}
	
	// 超过大小限制
	$maxsize = intval ( $maxsize );
	if($maxsize != 0 && isset ( $upfile['size'] ) && $upfile['size'] > $maxsize * 1000)
	{
		return - 3;
	}
	$ntime = time ();
	if($setname == '')
	{
		$savename = timetostr ( time (), '/Y/md/' ) . ($ntime . rand ( 100, 69999 )) . '.' . $ext;
		$savefile = BAIYU_FILE . $savename;
	}
	else
	{
		$savename = $setname . '.' . $ext;
		$savefile = $setname . '.' . $ext;
	}
	$move = file_put ( $upfile['tmp_name'], $savefile );
	$file_saved = $move == '' ? true : false;
	
	if($file_saved)
	{
		@chmod ( $savefile, 0777 );
		$width = $height = $type = 0;
		if($isimg || $ext == 'swf')
		{
			$imagesize = @getimagesize ( $savefile );
			list($width,$height,$type) = ( array ) $imagesize;
			$size = $width * $height;
			if($size > 16777216 || $size < 4 || empty ( $type ) || ($isimg && ! in_array ( $type, array(
					1,
					2,
					3,
					6,
					13 
			) )))
			{
				@unlink ( $savefile );
				return - 4;
			}
		}
		if($isimg && $watermark)
		{
			loadlib ( 'image.func' );
			$waterfile = empty ( $waterfile ) ? (isset ( $_glb['waterfile'] ) ? $_glb['waterfile'] : '') : $waterfile;
			if($waterfile != '')
			{
				$waterfile = BAIYU_DAT . '/watermark/' . $waterfile;
				$waterpos = isset ( $_glb['waterpos'] ) ? $_glb['waterpos'] : 9;
				imagewatermark ( $savefile, $waterpos, $waterfile );
			}
		}
		$rs = array();
		$rs['isimg'] = $isimg;
		$rs['ext'] = $ext;
		$rs['filename'] = $upfile["name"];
		$rs['size'] = $upfile['size'];
		$rs['type'] = $upfile['type'];
		$rs['downurl'] = $savename;
		$rs['width'] = $rs['height'] = 0;
		if($isimg || $ext == 'swf')
		{
			$imagesize = @getimagesize ( $savefile );
			list($width,$height) = ( array ) $imagesize;
			$rs['width'] = $width;
			$rs['height'] = $height;
		}
		return ! empty ( $rs ) ? $rs : - 5;
	}
	return - 5;
}
// 由文件后缀 得到mime类型
function mime_type($ext = '')
{
	$mime_types = array(
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpe' => 'image/jpeg',
			'bmp' => 'image/bmp',
			'gif' => 'image/gif',
			'png' => 'image/png',
			'tif' => 'image/tiff',
			'tiff' => 'image/tiff',
			'txt' => 'text/plain',
			
			'doc' => 'application/msword',
			'xsl' => 'application/xml',
			'xslt' => 'application/xslt+xml',
			'xhtml' => 'application/xhtml+xml',
			"rar" => "application/x-rar-compressed",
			'zip' => 'application/zip',
			'gz' => 'application/x-gzip',
			"zip" => "application/x-zip-compressed",
			'swf' => 'application/x-shockwave-flash',
			"swf" => "application/x-shockwave-flash",
			'flv' => 'video/x-flv',
			'css' => 'text/css',
			'html' => 'text/html',
			'htm' => 'text/html',
			'pdf' => 'application/pdf',
			
			'mp3' => 'audio/mpeg',
			'mp4' => 'video/mp4',
			'ico' => 'image/x-icon',
			'jp2' => 'image/jp2',
			'xml' => 'application/xml',
			"lrc" => "application/lrc",
			'wbmp' => 'image/vnd.wap.wbmp',
			
			'3gp' => 'video/3gpp',
			'ai' => 'application/postscript',
			'aif' => 'audio/x-aiff',
			'aifc' => 'audio/x-aiff',
			'aiff' => 'audio/x-aiff',
			'asc' => 'text/plain',
			'atom' => 'application/atom+xml',
			'au' => 'audio/basic',
			'avi' => 'video/x-msvideo',
			'bcpio' => 'application/x-bcpio',
			'bin' => 'application/octet-stream',
			'cdf' => 'application/x-netcdf',
			'cgm' => 'image/cgm',
			'class' => 'application/octet-stream',
			'cpio' => 'application/x-cpio',
			'cpt' => 'application/mac-compactpro',
			'csh' => 'application/x-csh',
			'dcr' => 'application/x-director',
			'dif' => 'video/x-dv',
			'dir' => 'application/x-director',
			'djv' => 'image/vnd.djvu',
			'djvu' => 'image/vnd.djvu',
			'dll' => 'application/octet-stream',
			'dmg' => 'application/octet-stream',
			'dms' => 'application/octet-stream',
			'dtd' => 'application/xml-dtd',
			'dv' => 'video/x-dv',
			'dvi' => 'application/x-dvi',
			'dxr' => 'application/x-director',
			'eps' => 'application/postscript',
			'etx' => 'text/x-setext',
			'exe' => 'application/octet-stream',
			'ez' => 'application/andrew-inset',
			'gram' => 'application/srgs',
			'grxml' => 'application/srgs+xml',
			'gtar' => 'application/x-gtar',
			'hdf' => 'application/x-hdf',
			'hqx' => 'application/mac-binhex40',
			'ice' => 'x-conference/x-cooltalk',
			'ics' => 'text/calendar',
			'ief' => 'image/ief',
			'ifb' => 'text/calendar',
			'iges' => 'model/iges',
			'igs' => 'model/iges',
			'jnlp' => 'application/x-java-jnlp-file',
			'js' => 'application/x-javascript',
			'kar' => 'audio/midi',
			'latex' => 'application/x-latex',
			'lha' => 'application/octet-stream',
			'lzh' => 'application/octet-stream',
			'm3u' => 'audio/x-mpegurl',
			'm4a' => 'audio/mp4a-latm',
			'm4p' => 'audio/mp4a-latm',
			'm4u' => 'video/vnd.mpegurl',
			'm4v' => 'video/x-m4v',
			'mac' => 'image/x-macpaint',
			'man' => 'application/x-troff-man',
			'mathml' => 'application/mathml+xml',
			'me' => 'application/x-troff-me',
			'mesh' => 'model/mesh',
			'mid' => 'audio/midi',
			'midi' => 'audio/midi',
			'mif' => 'application/vnd.mif',
			'mov' => 'video/quicktime',
			'movie' => 'video/x-sgi-movie',
			'mp2' => 'audio/mpeg',
			'mpe' => 'video/mpeg',
			'mpeg' => 'video/mpeg',
			'mpg' => 'video/mpeg',
			'mpga' => 'audio/mpeg',
			'ms' => 'application/x-troff-ms',
			'msh' => 'model/mesh',
			'mxu' => 'video/vnd.mpegurl',
			'nc' => 'application/x-netcdf',
			'oda' => 'application/oda',
			'ogg' => 'application/ogg',
			'ogv' => 'video/ogv',
			'pbm' => 'image/x-portable-bitmap',
			'pct' => 'image/pict',
			'pdb' => 'chemical/x-pdb',
			'pgm' => 'image/x-portable-graymap',
			'pgn' => 'application/x-chess-pgn',
			'pic' => 'image/pict',
			'pict' => 'image/pict',
			'pnm' => 'image/x-portable-anymap',
			'pnt' => 'image/x-macpaint',
			'pntg' => 'image/x-macpaint',
			'ppm' => 'image/x-portable-pixmap',
			'ppt' => 'application/vnd.ms-powerpoint',
			'ps' => 'application/postscript',
			'qt' => 'video/quicktime',
			'qti' => 'image/x-quicktime',
			'qtif' => 'image/x-quicktime',
			'ra' => 'audio/x-pn-realaudio',
			'ram' => 'audio/x-pn-realaudio',
			'ras' => 'image/x-cmu-raster',
			'rdf' => 'application/rdf+xml',
			'rgb' => 'image/x-rgb',
			'rm' => 'application/vnd.rn-realmedia',
			'roff' => 'application/x-troff',
			'rtf' => 'text/rtf',
			'rtx' => 'text/richtext',
			'sgm' => 'text/sgml',
			'sgml' => 'text/sgml',
			'sh' => 'application/x-sh',
			'shar' => 'application/x-shar',
			'silo' => 'model/mesh',
			'sit' => 'application/x-stuffit',
			'skd' => 'application/x-koan',
			'skm' => 'application/x-koan',
			'skp' => 'application/x-koan',
			'skt' => 'application/x-koan',
			'smi' => 'application/smil',
			'smil' => 'application/smil',
			'snd' => 'audio/basic',
			'so' => 'application/octet-stream',
			'spl' => 'application/x-futuresplash',
			'src' => 'application/x-wais-source',
			'sv4cpio' => 'application/x-sv4cpio',
			'sv4crc' => 'application/x-sv4crc',
			'svg' => 'image/svg+xml',
			't' => 'application/x-troff',
			'tar' => 'application/x-tar',
			'tcl' => 'application/x-tcl',
			'tex' => 'application/x-tex',
			'texi' => 'application/x-texinfo',
			'texinfo' => 'application/x-texinfo',
			'tr' => 'application/x-troff',
			'tsv' => 'text/tab-separated-values',
			'ustar' => 'application/x-ustar',
			'vcd' => 'application/x-cdlink',
			'vrml' => 'model/vrml',
			'vxml' => 'application/voicexml+xml',
			'wav' => 'audio/x-wav',
			'wbxml' => 'application/vnd.wap.wbxml',
			'webm' => 'video/webm',
			'wml' => 'text/vnd.wap.wml',
			'wmlc' => 'application/vnd.wap.wmlc',
			'wmls' => 'text/vnd.wap.wmlscript',
			'wmlsc' => 'application/vnd.wap.wmlscriptc',
			'wmv' => 'video/x-ms-wmv',
			'wrl' => 'model/vrml',
			'xbm' => 'image/x-xbitmap',
			'xht' => 'application/xhtml+xml',
			'xls' => 'application/vnd.ms-excel',
			'xpm' => 'image/x-xpixmap',
			'xul' => 'application/vnd.mozilla.xul+xml',
			'xwd' => 'image/x-xwindowdump',
			'xyz' => 'chemical/x-xyz',
			"apk" => "application/vnd.android.package-archive",
			"bin" => "application/octet-stream",
			"cab" => "application/vnd.ms-cab-compressed",
			"gb" => "application/chinese-gb",
			"gba" => "application/octet-stream",
			"gbc" => "application/octet-stream",
			"jad" => "text/vnd.sun.j2me.app-descriptor",
			"jar" => "application/java-archive",
			"nes" => "application/octet-stream",
			"sis" => "application/vnd.symbian.install",
			"sisx" => "x-epoc/x-sisx-app",
			"smc" => "application/octet-stream",
			"smd" => "application/octet-stream",
			"wap" => "text/vnd.wap.wml wml",
			"mrp" => "application/mrp",
			"wma" => "audio/x-ms-wma" 
	);
	$ext = strtolower ( trim ( $ext ) );
	if($ext == 'baiyu')
	{
		return $mime_types;
	}
	if($ext == '')
	{
		return 'application/octet-stream';
	}
	return isset ( $mime_types[$ext] ) ? $mime_types[$ext] : 'application/octet-stream';
}