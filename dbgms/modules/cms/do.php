<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 意图：功能
$dbgms_con = $this->input->get_post ( 'con' );
/* ========== use 当前功能 ========== */
$data['use'] = $use = $this->input->get_post ( 'use' );
$data['curr_url'] = site_url () . '/index/' . $modules . '?act=' . $dbgms_con; /* 当前url */
$data['update_url'] = $data['curr_url'] . '&use=update'; /* 更新url */
$data['delete_url'] = $data['curr_url'] . '&use=delete&id='; /* 删除url */

/* 当前页数 */
$page = isset ( $_GET['page'] ) ? intval ( $_GET['page'] ) : 1;
/* ID */
$id = dbg_input_getpost ( 'id' );
$id = isset ( $id ) ? intval ( $id ) : 0;
$pagesize = 8; /* 每页显示个数 */
$data['act'] = $act; /* 当前意图 */
$data['edit_url'] = $data['curr_url'] . '&use=edit&page=' . $page . '&id='; /* 编辑url */
$data['update_url'] = $data['curr_url'] . '&use=update'; /* 更新url */
$data['delete_url'] = $data['curr_url'] . '&use=delete&id='; /* 删除url */
$data['page'] = $page;
switch($use)
{
	// 删除 全部缓存
	case 'delall':
		dbg_file_delete ( DBG_DATA . 'cache/', FALSE );
		$www_htmlpath = _ROOT_ . '/domain/website/cache/';
		dbg_file_delete ( $www_htmlpath, FALSE );
		
		dbg_file_delete ( DBG_DATA . 'public/', FALSE );
		echo 1;
		break;
	// 删除 数据缓存
	case 'delfile':
		dbg_file_delete ( DBG_DATA . 'cache/', FALSE );
		echo 1;
		break;
	// 删除 静态缓存
	case 'delhtml':
		$www_htmlpath = _ROOT_ . '/domain/website/cache/';
		dbg_file_delete ( $www_htmlpath, FALSE );
		
		dbg_file_delete ( DBG_DATA . 'public/', FALSE );
		unlink ( _ROOT_ . '/index.html' );
		echo 1;
		break;
	// 删除 模板缓存
	case 'deltemplate':
		echo "暂无 模板缓存!";
		break;
	
	case 'download':
		$name = dbg_input_getpost ( 'name' );
		$modelsign = dbg_input_getpost ( 'modelsign' );
		$upname = $name . "_down";
		// 存储地址
		$base_path = DBG_FILE . "/" . $modelsign . "/";
		$config['upload_path'] = dbg_img_upload ( $base_path );
                
                $config_file = include _DATA_ . 'config.website.php';
                $config_value = $config_file['upload'];
                
		$config['allowed_types'] = '*'; // 允许格式类别
		$config['max_size'] = intval($config_value['size'])*1024; // 最大文件大小
                //$config['max_size'] = '100000'; // 最大文件大小
                $config['file_name'] = $_FILES['download_down']['name'];// 上传保存的名字
		//$config['file_name'] = time () . rand ( 100, 99999 );

                $file_type_arr = explode('|', $config_value['format']);
                
		$this->load->library ( 'upload', $config ); // 加载
		if($this->upload->do_upload ( $upname ))
		{ // 开始上传,判断是否成功
                        if(!in_array(substr(strrchr($_FILES['download_down']['name'], '.'), 1), $file_type_arr)){
                                unlink($config['upload_path'].'/'.$config['file_name']);
                                $infoda['type'] = "no";
                                $infoda['info'] = $this->upload->display_errors ( '<p>', '</p>' );
                                $infodata = json_encode ( $infoda );
                                echo $infodata;
                                return;
                        }else{
                                $uploadinfodata = $this->upload->data ();
                                $infoda['type'] = "ok";

                                $showurl = explode ( '/' . $modelsign . '/', $config['upload_path'] );
                                $infoda['info'] = '/' . $modelsign . '/' . $showurl[1] . '/' . $uploadinfodata['file_name'];
                                $infodata = json_encode ( $infoda );
                                echo $infodata;
                                return;
                                // ['file_name'];
                                // 注意：$uploadinfodata是你上传文件的所有相关信息的数组,它返回你上传文件的所有相关信息的数组  
                        }
                        /*
                                $uploadinfodata = $this->upload->data ();
                                $infoda['type'] = "ok";

                                $showurl = explode ( '/' . $modelsign . '/', $config['upload_path'] );
                                $infoda['info'] = '/' . $modelsign . '/' . $showurl[1] . '/' . $uploadinfodata['file_name'];
                                $infodata = json_encode ( $infoda );
                                echo $infodata;
                                return;
                                // ['file_name'];
                                // 注意：$uploadinfodata是你上传文件的所有相关信息的数组,它返回你上传文件的所有相关信息的数组  
                         * 
                         */
		}
		else
		{
			$infoda['type'] = "no";
			$infoda['info'] = $this->upload->display_errors ( '<p>', '</p>' );
			$infodata = json_encode ( $infoda );
			echo $infodata;
			return;
		}
		break;
	case 'cut':
		// 注意 1、当$config['create_thumb']等于FALSE并且$config['new_image']没有指定 时，会调整原图的大小
		// 2、当$config['create_thumb']等于TRUE并且$config['new_image']没有指定 时，生成文件名为(原图名_thumb.扩展名)
		// 3、当$config['create_thumb']等于FALSE并且$config['new_image']指定时， 生成文件名为$config['new_image']的值
		// 4、当$config['create_thumb']等于TRUE并且$config['new_image']指定时， 生成文件名为(原图名_thumb.扩展名)
		
		// 缩略图
		
		// 裁剪
		
		// 是否打水印
		
		$img = dbg_input_getpost ( 'imgpath' );
		$cutparame = dbg_input_getpost ( 'cutparame' );
		
		$this->load->library ( 'image_lib' );
		$config['image_library'] = 'gd2';
		$config['source_image'] = DBG_FILE . $img;
		/* 图像缩略图 */
		if($cutparame['thumb'] != '0_0')
		{
			$thumbarr = explode ( '_', $cutparame['thumb'] );
			if($cutparame['thumb_w'] != 0)
			{
				$canjiangao = round ( $cutparame['w'] ) / $cutparame['thumb_w'];
				$config['width'] = $cutparame['thumb_w'];
				$config['height'] = round ( $cutparame['h'] ) / $canjiangao;
			}
			else
			{
				$config['width'] = $thumbarr[0];
				$config['height'] = $thumbarr[1];
			}
			
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$this->image_lib->clear ();
			$this->image_lib->initialize ( $config );
			if(! $this->image_lib->resize ())
			{
				echo $this->image_lib->display_errors ();
			}
			else
			{ /* 打水印 */
				if($cutparame['watermark'] != 'none' && $cutparame['watermark'] != '')
				{
					$config['wm_text'] = 'Copyright 2015 - dbgms';
					$config['wm_type'] = 'text';
					$config['wm_font_path'] = _DBGMS_FONTS_ . 'texb.ttf';
					$config['wm_font_size'] = '16';
					$config['wm_font_color'] = 'ffffff';
					$config['wm_vrt_alignment'] = 'bottom';
					$config['wm_hor_alignment'] = 'center';
					$config['wm_padding'] = '20';
					
					$modelsign = dbg_input_getpost ( 'modelsign' );
					$base_path = DBG_FILE . "/" . $modelsign . "/";
					$sae_path = dbg_img_upload ( $base_path );
					$sae_name = "/" . time () . rand ( 100, 99999 ) . '.jpg';
					$config['new_image'] = $sae_path . $sae_name;
					$this->image_lib->clear ();
					$this->image_lib->initialize ( $config );
					if(! $this->image_lib->watermark ())
					{
						echo $this->image_lib->display_errors ();
					}
					else
					{
						// $file = $config['source_image'];
						// if(unlink ( $file ))
						// {
						$infoda['type'] = "ok";
						$showurl = explode ( '/' . $modelsign . '/', $sae_path );
						$infoda['info'] = '/' . $modelsign . '/' . $showurl[1] . $sae_name;
						echo json_encode ( $infoda );
						// }
					}
				}
				else
				{
					$ext = strrchr ( $img, '.' );
					$showurl = explode ( $ext, $img );
					$infoda['type'] = "ok";
					$infoda['info'] = $showurl[0] . '_thumb' . $ext;
					echo json_encode ( $infoda );
				}
			}
		}
		else
		{
			$config['x_axis'] = round ( $cutparame['x'] ); // (必须)从左边取的像素值
			$config['y_axis'] = round ( $cutparame['y'] ); // (必须)从头部取的像素值
			$config['width'] = round ( $cutparame['w'] );
			$config['height'] = round ( $cutparame['h'] );
			$config['maintain_ratio'] = FALSE; // 保证设置的长宽有效
			$this->image_lib->clear ();
			$this->image_lib->initialize ( $config );
			if(! $this->image_lib->crop ())
			{
				echo $this->image_lib->display_errors ();
			}
			else
			{
				
				/* 打水印 */
				if($cutparame['watermark'] != 'none' && $cutparame['watermark'] != '')
				{
					header ( "Content-type: text/html; charset=utf-8" );
					$sy_config['image_library'] = 'gd2';
					$sy_config['source_image'] = DBG_FILE . $img;
					// // 文字水印---
					$sy_config['wm_type'] = 'text'; // (必须)设置想要使用的水印处理类型(text, overlay)
					$sy_config['wm_padding'] = '0'; // 图像相对位置(单位像素)
					$sy_config['wm_vrt_alignment'] = 'bottom'; // 竖轴位置 top, middle, bottom
					$sy_config['wm_hor_alignment'] = 'right'; // 横轴位置 left, center, right
					$sy_config['wm_vrt_offset'] = '0'; // 指定一个垂直偏移量(以像素为单位)
					$sy_config['wm_hor_offset'] = '0'; // 指定一个横向偏移量(以像素为单位)
					$sy_config['wm_text'] = 'http://www.dbgms.cn/'; // (必须)水印的文字内容
					
					$sy_config['wm_font_path'] = _DBGMS_FONTS_ . 'PilsenPlakat.ttf';
					$sy_config['wm_font_size'] = '14'; // (必须)文字大小
					$sy_config['wm_font_color'] = 'FF0000'; // (必须)文字颜色，十六进制数
					$sy_config['wm_shadow_color'] = 'FF0000'; // 投影颜色，十六进制数
					$sy_config['wm_shadow_distance'] = '0'; // 字体和投影距离(单位像素)。
					
					$modelsign = dbg_input_getpost ( 'modelsign' );
					$base_path = DBG_FILE . "/" . $modelsign . "/";
					$sae_path = dbg_img_upload ( $base_path );
					$sae_name = "/" . time () . rand ( 100, 99999 ) . '.jpg';
					$sy_config['new_image'] = $sae_path . $sae_name;
					$this->image_lib->clear ();
					$this->image_lib->initialize ( $sy_config );
					if(! $this->image_lib->watermark ())
					{
						echo $this->image_lib->display_errors ();
					}
					else
					{
						// $file = $config['source_image'];
						// if(unlink ( $file ))
						// {
						$infoda['type'] = "ok";
						$showurl = explode ( '/' . $modelsign . '/', $sae_path );
						$infoda['info'] = '/' . $modelsign . '/' . $showurl[1] . $sae_name;
						echo json_encode ( $infoda );
						// }
					}
				}
				else
				{
					// $file = $config['source_image'];
					// if(unlink ( $file ))
					// {
					$infoda['type'] = "ok";
					$infoda['info'] = $img;
					echo json_encode ( $infoda );
					// }
				}
			}
		}
		
		// if($_SERVER['REQUEST_METHOD'] == 'POST')
		// {
		// $targ_w = $targ_h = 150;
		// $jpeg_quality = 90;
		// $src = 'demo_files/pool.jpg';
		// $img_r = imagecreatefromjpeg ( $src );
		// $dst_r = ImageCreateTrueColor ( $targ_w, $targ_h );
		
		// imagecopyresampled ( $dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h'] );
		
		// header ( 'Content-type: image/jpeg' );
		// imagejpeg ( $dst_r, null, $jpeg_quality );
		
		// exit ();
		// }
		break;
	case 'img':
		$name = dbg_input_getpost ( 'name' );
		$modelsign = dbg_input_getpost ( 'modelsign' );
		$upname = $name . "_file";
		// 存储地址
		$base_path = DBG_FILE . "/" . $modelsign . "/";
		$config['upload_path'] = dbg_img_upload ( $base_path );
		
		$config['allowed_types'] = 'image|gif|jpg|png'; // 允许格式类别
		$config['max_size'] = '100000'; // 最大文件大小
		                                
		// 上传保存的名字
		$config['file_name'] = time () . rand ( 100, 99999 );
                //获取管理员功能设置
                $rootfuncs = require DBG_DATA . 'config.rootfuncs.php';
                $endelimg = intval($rootfuncs['config']['endelimg']);
                if($endelimg){
                        /**************************删除旧的图片*****************************/
                        if(isset($_REQUEST['base']['logo'])){
                                $logo_uri = dbg_query('SELECT `value` FROM `dbg_config` WHERE `key` = "logo"');
                                $old_logo_uri = dirname(_FILE_.'suibianxie').$logo_uri[0]['value'];//用于删除
                                $new_logo_uri_db = '/site/'.date('Y',time()).'/'.date('md',  time()).'/'.$config['file_name'].'.'.substr($_FILES['baselogo_file']['name'], strrpos($_FILES['baselogo_file']['name'], '.')+1);
                                $sql = "UPDATE `dbg_config` SET `value`='".$new_logo_uri_db."' where `key`='logo'";//UPDATE `dbg_config` SET `value`='sql2' where `key`='logo'
                                //删除旧图片
                                unlink($old_logo_uri);
                                $rtn = dbg_query($sql,false);
                        }
                }
		$this->load->library ( 'upload', $config ); // 加载
		if($this->upload->do_upload ( $upname ))
		{ // 开始上传,判断是否成功
			$uploadinfodata = $this->upload->data ();
			$infoda['type'] = "ok";
			
			$showurl = explode ( '/' . $modelsign . '/', $config['upload_path'] );
			$infoda['info'] = '/' . $modelsign . '/' . $showurl[1] . '/' . $uploadinfodata['file_name'];
			$infodata = json_encode ( $infoda );
			echo $infodata;
			
			// 打水印
			// $this->load->library ( 'image_lib' );
			// // (必须)设置原始图像的名字/路径
			// $sy_config['source_image'] = $uploadinfodata['full_path'];
			
			// // 设置图像的目标名/路径。
			// $sy_config['new_image'] = $patharr[2] . '/' . time () . rand ( 100, 99999 ) . $uploadinfodata['file_ext'];
			
			// $infoda['info'] = str_replace ( DBG_FILE, "", $sy_config['new_image'] );
			
			// // 文字水印---
			// // $sy_config ['wm_type'] = 'text'; // (必须)设置想要使用的水印处理类型(text, overlay)
			// $sy_config['wm_padding'] = '0'; // 图像相对位置(单位像素)
			// $sy_config['wm_vrt_alignment'] = 'bottom'; // 竖轴位置 top, middle, bottom
			// $sy_config['wm_hor_alignment'] = 'right'; // 横轴位置 left, center, right
			// $sy_config['wm_vrt_offset'] = '-5'; // 指定一个垂直偏移量(以像素为单位)
			// $sy_config['wm_hor_offset'] = '0'; // 指定一个横向偏移量(以像素为单位)
			// // $sy_config ['wm_text'] = '后起网 www.hooqo.com'; // (必须)水印的文字内容
			// // $sy_config ['wm_font_path'] = DBG_CI . '/system/fonts/PilsenPlakat.ttf'; // 字体名字和路径
			// // $sy_config ['wm_font_size'] = '30'; // (必须)文字大小
			// // $sy_config ['wm_font_color'] = 'FF0000'; // (必须)文字颜色，十六进制数
			// // $sy_config ['wm_shadow_color'] = 'FF0000'; // 投影颜色，十六进制数
			// // $sy_config ['wm_shadow_distance'] = '3'; // 字体和投影距离(单位像素)。
			
			// // /图像水印　
			
			// // $sy_config['image_library'] = 'gd2';
			// // // $sy_config ['dynamic_output'] = FALSE; // 决定新图像的生成是要写入硬盘还是动态的存在
			// // $sy_config ['quality'] = '90%'; // 设置图像的品质。品质越高，图像文件越大
			// $sy_config['maintain_ratio'] = TRUE; // 维持比例
			// $sy_config['wm_type'] = 'overlay'; // (必须)设置想要使用的水印处理类型(text, overlay)
			// $sy_config['wm_overlay_path'] = DBG_CI . '/system/fonts/watermark.png'; // 水印图像的名字和路径
			// $sy_config['wm_opacity'] = '50'; // 水印图像的透明度
			// $sy_config['wm_x_transp'] = '4'; // 水印图像通道
			// $sy_config['wm_y_transp'] = '4'; // 水印图像通道
			
			// $this->image_lib->initialize ( $sy_config );
			// if(! $this->image_lib->watermark ())
			// {
			// echo $this->image_lib->display_errors ();
			// }
			// else
			// {
			// $file = $uploadinfodata['full_path'];
			// if(unlink ( $file ))
			// {
			// $infodata = json_encode ( $infoda );
			// echo $infodata;
			// }
			// }
			
			return;
			// ['file_name'];
			// 注意：$uploadinfodata是你上传文件的所有相关信息的数组,它返回你上传文件的所有相关信息的数组
		}
		else
		{
			$infoda['type'] = "no";
			$infoda['info'] = $this->upload->display_errors ( '<p>', '</p>' );
			$infodata = json_encode ( $infoda );
			echo $infodata;
			return;
		}
		break;
	case 'swfupload_add':
		// 上传表单字段名
		$field_name = 'Filedata';
		// 存储地址
		$modelsign = dbg_input_getpost ( 'modelsign' );
		$base_path = DBG_FILE . "/" . $modelsign . "/";
		$config['upload_path'] = dbg_img_upload ( $base_path );
		$config['allowed_types'] = '*'; // 允许上传格式
		$config['max_size'] = '100000'; // 允许上传大小
		$config['file_name'] = time () . rand ( 100, 99999 ); // 存放的文件名
		$this->load->library ( 'upload', $config );
		if($this->upload->do_upload ( $field_name ))
		{
			$uploadinfodata = $this->upload->data ();
			
			$out = array();
			$showurl = explode ( '/' . $modelsign . '/', $config['upload_path'] );
			$out['RSINPUT'] = '/' . $modelsign . '/' . $showurl[1] . '/' . $uploadinfodata['file_name'];
			if(DBG_URLSAVECACHE == 0)
			{
				$out['RSURL'] = $data['_baseurl'] . 'file' . $out['RSINPUT']; // 返回给SWF AND JQUERY ,保存的名字 image地址
			}
			else
			{
				$out['RSURL'] = DBG_FILEURL . $out['RSINPUT']; // 返回给SWF AND JQUERY ,保存的名字 image地址
			}
			$msg = json_encode ( $out );
			echo $msg;
			
			/*
			 * // 打水印
			 * $this->load->library ( 'image_lib' );
			 * // (必须)设置原始图像的名字/路径
			 * $sy_config['source_image'] = $uploadinfodata['full_path'];
			 * // 设置图像的目标名/路径。
			 * $sy_config['new_image'] = $patharr[2] . '/' . time () . rand ( 100, 99999 ) . $uploadinfodata['file_ext'];
			 * $out = array();
			 * $out['RSINPUT'] = str_replace ( DBG_FILE, "", $sy_config['new_image'] );
			 * $out['RSURL'] = DBG_FILEURL . $out['RSINPUT']; // 返回给SWF AND JQUERY ,保存的名字 image地址
			 *
			 * // 文字水印---
			 * // $sy_config ['wm_type'] = 'text'; // (必须)设置想要使用的水印处理类型(text, overlay)
			 * $sy_config['wm_padding'] = '0'; // 图像相对位置(单位像素)
			 * $sy_config['wm_vrt_alignment'] = 'bottom'; // 竖轴位置 top, middle, bottom
			 * $sy_config['wm_hor_alignment'] = 'right'; // 横轴位置 left, center, right
			 * $sy_config['wm_vrt_offset'] = '-5'; // 指定一个垂直偏移量(以像素为单位)
			 * $sy_config['wm_hor_offset'] = '0'; // 指定一个横向偏移量(以像素为单位)
			 * // $sy_config ['wm_text'] = '后起网 www.hooqo.com'; // (必须)水印的文字内容
			 * // $sy_config ['wm_font_path'] = DBG_CI . '/system/fonts/PilsenPlakat.ttf'; // 字体名字和路径
			 * // $sy_config ['wm_font_size'] = '30'; // (必须)文字大小
			 * // $sy_config ['wm_font_color'] = 'FF0000'; // (必须)文字颜色，十六进制数
			 * // $sy_config ['wm_shadow_color'] = 'FF0000'; // 投影颜色，十六进制数
			 * // $sy_config ['wm_shadow_distance'] = '3'; // 字体和投影距离(单位像素)。
			 * // /图像水印　
			 *
			 * // $sy_config['image_library'] = 'gd2';
			 * // // $sy_config ['dynamic_output'] = FALSE; // 决定新图像的生成是要写入硬盘还是动态的存在
			 * // $sy_config ['quality'] = '90%'; // 设置图像的品质。品质越高，图像文件越大
			 * $sy_config['maintain_ratio'] = TRUE; // 维持比例
			 * $sy_config['wm_type'] = 'overlay'; // (必须)设置想要使用的水印处理类型(text, overlay)
			 * $sy_config['wm_overlay_path'] = DBG_CI . '/system/fonts/watermark.png'; // 水印图像的名字和路径
			 * $sy_config['wm_opacity'] = '50'; // 水印图像的透明度
			 * $sy_config['wm_x_transp'] = '4'; // 水印图像通道
			 * $sy_config['wm_y_transp'] = '4'; // 水印图像通道
			 * $this->image_lib->initialize ( $sy_config );
			 * if(! $this->image_lib->watermark ())
			 * {
			 * echo $this->image_lib->display_errors ();
			 * }
			 * else
			 * {
			 * $file = $uploadinfodata['full_path'];
			 * if(unlink ( $file ))
			 * {
			 * $msg = json_encode ( $out );
			 * echo $msg;
			 * }
			 * }
			 *
			 * $msg = json_encode ( $out );
			 */
		}
		else
		{
			echo $this->upload->display_errors ( '<p>', '</p>' );
		}
		break;
	case 'swfupload_del':
		$imgname = isset ( $_GET['img'] ) ? $_GET['img'] : "";
		if(! empty ( $imgname ))
		{
			$file = DBG_FILE . $imgname;
			if(@unlink ( $file ))
			{
				echo "删除成功";
			}
			else
			{
				echo "删除失败";
			}
		}
		break;
}
/*
 * 修改了===
 * swfupload_del application/config/mimes.php
 * 修改后的如下
 * 'bmp' => array('image/bmp', 'application/octet-stream'),
 * 'gif' => array('image/gif', 'application/octet-stream'), 'jpeg' => array('image/jpeg', 'image/pjpeg',
 * 'application/octet-stream'), 'jpg' => array('image/jpeg', 'image/pjpeg', 'application/octet-stream'),
 * 'jpe' => array('image/jpeg', 'image/pjpeg', 'application/octet-stream'), 'png' => array('image/png', 'image/x-png',
 * 'application/octet-stream'), 也就是在每一种格式里都加了一个
 * 'application/octet-stream'，因为经过我的测试，SWFUpload上传的文件MIME为'application/octet-stream'
 */
/*
 * 修改了
 * application/config/mimes.php
 * 修改后的如下
 * 'bmp' => array('image/bmp', 'application/octet-stream'),
 * 'gif' => array('image/gif', 'application/octet-stream'),
 * 'jpeg' => array('image/jpeg', 'image/pjpeg', 'application/octet-stream'),
 * 'jpg' => array('image/jpeg', 'image/pjpeg', 'application/octet-stream'),
 * 'jpe' => array('image/jpeg', 'image/pjpeg', 'application/octet-stream'),
 * 'png' => array('image/png', 'image/x-png', 'application/octet-stream'),
 *
 * 也就是在每一种格式里都加了一个 'application/octet-stream'，因为经过我的测试，SWFUpload上传的文件MIME为'application/octet-stream'
 */
function ciimg()
{
	$this->load->library ( 'image_lib' );
	define ( 'DBGMS_ROOT', TRUE );
	require_once (dirname ( __FILE__ ) . "/dbg/config.php");
	
	$this->load->library ( 'image_lib' );
	$config['source_image'] = $uploadinfodata['upload_data']['full_path']; // (必须)设置原始图像的名字/路径
	$config['new_image'] = DBG_FILE . "/bbb/" . $uploadinfodata['upload_data']['file_name']; // 设置图像的目标名/路径。
	
	/**
	 */
	// $config ['image_library'] = 'gd2'; // (必须)设置图像库
	// $config ['dynamic_output'] = FALSE; // 决定新图像的生成是要写入硬盘还是动态的存在
	// $config ['quality'] = '90%'; // 设置图像的品质。品质越高，图像文件越大
	// $config ['width'] = 500; // (必须)设置你想要得图像宽度。
	// $config ['height'] = 500; // (必须)设置你想要得图像高度
	// $config ['create_thumb'] = TRUE; // 让图像处理函数产生一个预览图像(将_thumb插入文件扩展名之前)
	// $config ['thumb_marker'] = '_thumb'; // 指定预览图像的标示。它将在被插入文件扩展名之前。
	// $config ['maintain_ratio'] = TRUE; // 维持比例
	// $config ['master_dim'] = 'auto'; // auto, width, height 指定主轴线
	
	// 文字水印
	$config['wm_type'] = 'text'; // (必须)设置想要使用的水印处理类型(text, overlay)
	$config['wm_padding'] = '5'; // 图像相对位置(单位像素)
	$config['wm_vrt_alignment'] = 'bottom'; // 竖轴位置 top, middle, bottom
	$config['wm_hor_alignment'] = 'right'; // 横轴位置 left, center, right
	$config['wm_vrt_offset'] = '0'; // 指定一个垂直偏移量(以像素为单位)
	$config['wm_hor_offset'] = '0'; // 指定一个横向偏移量(以像素为单位)
	$config['wm_text'] = 'Copyright 2015 '; // (必须)水印的文字内容
	                                        
	// $config ['wm_font_path'] = 'ptj_system/fonts/type-ra.ttf'; // 字体名字和路径
	$config['wm_font_path'] = './system/fonts/texb.ttf'; // 字体名字和路径
	$config['wm_font_size'] = '16'; // (必须)文字大小
	$config['wm_font_color'] = 'FF0000'; // (必须)文字颜色，十六进制数
	$config['wm_shadow_color'] = 'FF0000'; // 投影颜色，十六进制数
	$config['wm_shadow_distance'] = '3'; // 字体和投影距离(单位像素)。
	
	$this->image_lib->initialize ( $config );
	if(! $this->image_lib->watermark ())
	{
		echo $this->image_lib->display_errors ();
	}
	else
	{
		$file = $uploadinfodata['upload_data']['full_path'];
		echo $file;
		if(unlink ( $file ))
		{
			return TRUE;
		}
	}
	
	// // 图像旋转
	// $config ['rotation_angle'] = 'vrt'; // 有5个旋转选项 逆时针90 180 270 度 vrt 竖向翻转 hor 横向翻转
	// $this->image_lib->initialize ( $config );
	// if (! $this->image_lib->rotate ()) {
	// echo $this->image_lib->display_errors ();
	// }
}