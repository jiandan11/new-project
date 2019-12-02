<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
/**
 * 发送短信
 * @author DbgMs设计开发者,小庄
 * @param string $config 配置参数
 * @param array $arr 数据
 * @param string $id
 * @copyright DbgMs设计开发者,小庄
 * @version update 2016_05_11
 */
function dbgms_sendPhone($param, $config)
{
}
/**
 * 发送邮件
 * @author DbgMs设计开发者,小庄
 * @param string $config 配置参数
 * @param array $arr 数据
 * @param string $id
 * @copyright DbgMs设计开发者,小庄
 * @version update 2016_05_11
 */
function dbgms_sendEmail($param, $config)
{
	$company_url = base_url ();
	include _DATA_ . 'language/zh.php';
	$type = $param['type'];
	if(empty ( $param['type'] ))
	{
		$param['type'] = 'default';
	}
	$email_arr = $lang['email'][$type];
	
	if(! empty ( $param['company'] ))
	{
		$email_arr['subject'] = str_replace ( '{DbgMs管理系统}', '【 ' . $param['company'] . ' 】 ', $email_arr['subject'] );
		$email_arr['message'] = str_replace ( '{DbgMs管理系统}', '【 ' . $param['company'] . ' 】 ', $email_arr['message'] );
	}
	
	if(isset ( $param['toemail'] ))
	{
		if(empty ( $config ))
		{
			$config_file = include _DATA_ . 'config.website.php';
			$config = $config_file['email'];
		}
		
		$ci_controllers = &get_instance ();
		header ( "Content-type: text/html; charset=utf-8" );
		$smtp_host = $config['smtp_host'];
		$smtp_port = $config['smtp_port'];
		$smtp_user = $config['smtp_user'];
		$smtp_pass = $config['smtp_pass'];
		$ci_email_config = array(
				'crlf' => "\r\n",
				'newline' => "\r\n",
				'charset' => 'utf-8',
				'protocol' => 'smtp', // 邮件发送协议
				'mailtype' => 'html',
				'smtp_host' => $smtp_host, // SMTP服务器地址
				'smtp_port' => $smtp_port,
				'smtp_user' => $smtp_user, // smtp用户账号
				'smtp_pass' => $smtp_pass /*smtp密码*/
		);
		$ci_controllers->load->library ( 'email', $ci_email_config );
		$ci_controllers->email->from ( $smtp_user ); // 来自什么邮箱
		$ci_controllers->email->to ( $param['toemail'] ); // 发到什么邮箱
		$ci_controllers->email->subject ( $email_arr['subject'] ); // 邮件主题
		$ci_controllers->email->message ( $email_arr['message'] ); // 邮件内容
		if($ci_controllers->email->send ())
		{ // 发送email，根据发送结果，成功返回true,失败返回false,就可以用它判断局域
			unset ( $ci_controllers );
			return 1;
		}
		else
		{ // 返回包含邮件内容的字符串，包括EMAIL正文。用于调试
			$errormsg = $ci_controllers->email->print_debugger ();
			unset ( $ci_controllers );
			return $errormsg;
			exit ();
		}
	}
}

/**
 * 核心内容解析(重点,回调函数)
 * @author DbgMs设计开发者,小庄
 * @param string $model_id 模型id
 * @param array $arr 数据
 * @param string $id
 * @copyright DbgMs设计开发者,小庄
 * @version update 2016_03_29
 */
function dbgms_ContentParse($model_id = NULL, array $arr = array(), $id = NULL)
{
	// 1.获取模型 缓存
	$model_info = dbg_getModel ( $model_id );
	// 2.获取栏目 缓存
	$column_info = include DBG_DATA . 'cache.column.php';
	// 3.取数据
	$content_list = array();
	if(! empty ( $id ) && empty ( $arr ))
	{ // 强制取单条数据
		$content_list = dbg_query ( $model_info['sql'] . '=' . $id );
	}
	else
	{ // 取多条数据或单条
	  // if(! empty ( $arr ) && count ( $arr ) == 1)
	  // {
	  // $arr = $arr[0];
	  // }
		$content_list = $arr;
	}
	// 文章状态
	$state_name = array(
			0 => '正常发布',
			- 1 => '定时发布',
			- 10 => '内容库',
			- 5 => '待审核',
			3 => '栏目',
			5 => '大头条',
			7 => '短头条_1',
			8 => '短头条_2',
			9 => '黑头条',
			10 => '小头条',
			20 => '首页幻灯banner',
			25 => '滚动',
			30 => '一级推荐',
			35 => '二级推荐',
			40 => '三级推荐',
			45 => '位置一',
			50 => '位置二',
			- 66 => '驳回',
			- 90 => '回收站' 
	);
	$result = array();
	foreach($content_list as $val)
	{
		$content_row = array();
		$content_row['id'] = $val['id'];
		$content_row['state'] = $val['state'];
		$content_row['statename'] = $state_name[$val['state']];
		$content_row['hits'] = $val['hits'];
		$content_row['intime'] = $val['intime'];
		$content_row['uptime'] = $val['uptime'];
		// 解析 栏目相关
		$content_row['columnid'] = $val['columnid'];
		$content_row['columnname'] = $val['columnname'];
		$content_row['columnsign'] = $val['columnsign'];
		// 解析 管理员-审核
		$content_row['adminid'] = $val['adminid'];
		$content_row['adminname'] = $val['adminname'];
		// 解析 作者与编辑
		$content_row['userid'] = $val['authorid'];
		$content_row['username'] = empty ( $val['username'] ) ? "互联网" : $val['username'];
		// 解析 来源
		$content_row['source'] = empty ( $val['source'] ) ? "互联网" : $val['source'];
		// 解析 SEO 相关
		$content_row['title'] = $val['title'];
		$content_row['keywords'] = $val['keywords'];
		$content_row['description'] = $val['description'];
		// 模型自定义字段信息解析
		foreach($model_info["diyfield"] as $mval)
		{
			$diykey = $mval['field'];
			if($mval['type'] == 'template')
			{ // 自定义模板路径
				$diytemplate = empty ( $val[$diykey] ) ? $column_info[$val['columnid']]['template']['content'] : $val[$diykey];
			}
			else
			{ // 其他字段解析
				$content_row[$diykey] = dbg_diyfield ( 'parse', $mval['type'], $mval, $val[$diykey] );
			}
		}
		// 显示视图
		$content_row['views'] = empty ( $diytemplate ) ? $column_info[$val['columnid']]['template']['content'] : $diytemplate;
		
		// 是否加密 id
		// $linkid = num_encode ( $id );
		$linkid = $val['id'] . '.html';
		$content_row['link'] = $column_info[$val['columnid']]['link'] . $linkid;
		$content_row['mlink'] = $column_info[$val['columnid']]['mlink'] . $linkid;
		/* 解析高级参数设置-如是否开启评论,开启缓存 */
		$content_row['param'] = json_decode ( $val['param'] );
		$content_row['param'] = ( array ) ($content_row['param']);
		// 是否写入缓存
		// 判断内容是否-设置允许缓存
		// if($content_row['param']['iscache'] == 1)
		// {
		// echo '判断内容是否-设置允许缓存';
		// }
		// 判断 栏目-模型 是否同时-设置允许缓存
		// if($column_info['param']['iscache'] == 1 && $model_info['param']['iscache'] == 1)
		// {
		// echo '判断 栏目-模型 是否同时-设置允许缓存';
		// }
		// else
		// {
		// echo '不缓存，跳过';
		// return 1;
		// }
		// 判断 栏目-模型 是否 -设置允许缓存
		if($model_info['param']['iscache'] == 1)
		{
			dbgms_LoadClass ( 'Cache.class.php' );
			$cache_config = array(
					'dir' => DBG_CACHE,
					'time' => 36000 
			);
			$cacheClass = new Cache ( $cache_config );
			// 首次运行或缓存过期,生成缓存
			$cacheClass->del_filecache ( $model_info['sign'], $model_info['sign'] . $content_row['id'] );
			// $cache_content = $cache->get_filecache ( $model ['sign'], $model ['sign'] . $id, 3600 );
			$cacheClass->set_filecache ( $model_info['sign'], $model_info['sign'] . $content_row['id'], $content_row );
			unset ( $cacheClass );
		}
		$result[] = $content_row;
	}
	if(count ( $result ) == 1)
	{
		$result = $result[0];
	}
	return $result;
}
/**
 * @action:常用的获取站点设置
 *   模块：Base 基础系统
 *   控制器：Site 站点设置
 *   行为：获取
 * @filesource zhw
 * @param number $id
 * @return $model_data
 * @version 20160328
 */
function dbgmsBaseSiteGet()
{
	require_once _DBGMS_CORE_ . 'Admin.class.core.php';
	require_once _DBGMS_MODULES_ . '/base/controllers/site.php';
	$dbgmsCon = BASE_Site ( $id );
	$result = $dbgmsCon->apiGet ();
	return $result;
}
function dbgmsBaseInitGet($isupdate = NULL, array $website_config = array())
{
	require_once _DBGMS_CORE_ . 'Admin.class.core.php';
	require_once _DBGMS_MODULES_ . 'base/controllers/init.php';
	$dbgmsCon = BASE_Init ( NULL, TRUE );
	$result = $dbgmsCon->initGet ( $isupdate, $website_config );
	return $result;
}
/**
 * @action:常用的获取模型
 * @author zhw
 * @param number $id
 * @return $model_data
 * @version 20160328
 */
function dbg_getModel($id = NULL)
{
	$model_data = NULL;
	// 1. 先加载文件,查询文件是存在查询文件
	if(! file_exists ( DBG_DATA . 'cache.model.php' ))
	{ // 不存在查询
		if($id != 0)
		{
			$select_sql = 'SELECT c.* FROM dbg_model AS c  WHERE c.id=' . $id;
			$model_data = dbg_query ( $select_sql );
			return $model_data[0];
		}
		else
		{
			$select_sql = 'SELECT c.* FROM dbg_model AS c ';
			$model_data = dbg_query ( $select_sql );
			return $model_data;
		}
		// 输入缓存
	}
	else
	{
		$model_data = include DBG_DATA . 'cache.model.php';
		if($id != 0 && ! empty ( $id ))
		{
			$model_row = array();
			$model_row = $model_data[$id];
			if(empty ( $model_row ))
			{
				return '模型为空';
				exit ( '模型未安装' );
			}
			if($model_row['install'] == 0 || $model_row['disable'] == 1)
			{
				exit ( "模型未安装 or 模型未 启用 !" );
			}
			return $model_row;
			// $data['diyfield'] = unserialize ( $data['diyfield'] );
		}
		return $model_data;
	}
}
/**
 * 返回重新编写好的sql语句
 * @author Name zhw Email 343196936@qq.com Data 2016年3月28日
 * @param string $table 数据表名
 * @param unknown $data 更新或插入的数据
 * @param string $where_sql 查询条件
 * @return string 返回重新编写好的sql语句
 */
function getsql_table($table = '', $data = array(), $where_sql = '')
{
	if($table == '' || ! is_array ( $data ))
	{
		return '';
	}
	if($where_sql != '')
	{
		$field_update = '';
		foreach($data as $k=>$v)
		{
			$field_update .= ($field_update == '' ? '' : ',') . "`$k`='$v'";
		}
		$sql = "UPDATE `$table` SET $field_update WHERE $where_sql;";
	}
	else
	{
		$field_key = $field_val = '';
		foreach($data as $k=>$v)
		{
			$field_key .= ($field_key == '' ? '' : ',') . "`$k`";
			$field_val .= ($field_val == '' ? '' : ',') . "'$v'";
		}
		if($field_key != '' && $field_val != '')
		{
			$sql = "INSERT INTO `$table` ($field_key) VALUES ($field_val)";
		}
	}
	return $sql;
}
/**
 * @action 分页函数
 * @author Name zhw Email 343196936@qq.com Data 2016年3月28日
 * @param unknown $currentPage当前页
 * @param unknown $pageTotal总页数
 * @param unknown $pageSize每页个数
 * @param unknown $url URL地址
 * @param unknown $style 风格
 * @return string
 */
function dbg_pagebreak($currentPage, $total, $pageSize, $url, $style = NULL)
{
	/* style风格样式 */
	if($style == NULL)
	{
		$style = '<style type="text/css">
    div.dbgms_pagebreak{text-align: center;padding:30px 10px;height: 36px; overflow: hidden;}
	div.dbgms_pagebreak a{border:1px solid #e4e4e4; font-family:"Tahoma","Arial"; font-size:14px; height:30px; line-height: 30px; padding:0 12px; margin-left: 2px; display: inline-block; overflow: hidden; background: #FFF; color:#6a6a6a}
	div.dbgms_pagebreak a:hover{background:#0666c5;color:#FFF;text-decoration:none}
	div.dbgms_pagebreak a.on{background:#6e2685;color:#FFF}
	div.dbgms_pagebreak input.gopage{width:30px;position:relative;top:-11px;font-size:14px;height:30px;line-height:30px;margin-left:2px;display: inline-block; overflow: hidden;}</style>';
	}
	/* javascript设置选中 */
	$javascript = "<script type=\"text/javascript\">var dbgms_pagebreak =document.getElementById('page" . $currentPage . "');if(dbgms_pagebreak!=undefined){dbgms_pagebreak.setAttribute('class','on');}</script>";
	// $javascript = "<script type=\"text/javascript\">$(function(){ $('#page" . $currentPage . "').addClass('on');});</script>";
	$pagetotal = ceil ( $total / $pageSize ); // 向上取整,算出分页
	$paging = '<div class="dbgms_pagebreak">';
	if($pagetotal == 1)
	{
		$paging .= '<a id="page1" rel="1" href=" ' . $url . '1" >1</a>';
	}
	else
	{
		// 开头部分,是否显示上一页
		if(($currentPage - 3) > 1)
		{
			$paging .= '<a id="page1" rel="1" href=" ' . $url . '1" >1...</a>
				<a  href=" ' . $url . ($currentPage - 1) . '"  rel="' . ($currentPage - 1) . '" class="next">上一页</a>';
		}
		// 中间部分,输出7个分页
		for($i = $currentPage - 3;$i < $currentPage + 4;$i ++)
		{
			if($i < 1 || $i > $pagetotal)
			{
				continue;
			}
			$paging .= '<a id="page' . $i . '" rel="' . $i . '" href=" ' . $url . $i . '">' . $i . '</a>';
		}
		// 结尾部分,是否显示下一页
		if(($currentPage + 4) <= $pagetotal)
		{
			$paging .= '<a href=" ' . $url . ($currentPage + 1) . '" rel="' . ($currentPage + 1) . '" class="next">下一页</a>
						<a id="page' . $pagetotal . '" rel="' . $pagetotal . '" href="' . $url . $pagetotal . '">...' . $pagetotal . '</a>';
		}
	}
	// 是否开启跳转
	$pagego = '<input type="text" class="gopage" maxlength="3"/><a href="javascript:goPage(' . htmltostr ( $indexurl ) . ');">GO</a>';
	$paging .= "<br/>(总共" . $total . "条记录 )</div>";
	return $style . $paging . $javascript;
}

/**@action 截取短数组---文章简介等
 * @author Name zhw Email 343196936@qq.com Data 2016年3月28日
 * @param unknown $str 需要截取的数组
 * @param unknown $max_length 截取的长度
 * @param string $istags 是否去除html标签
 * @return unknown
 */
function dbg_strcut($str, $max_length, $istags = TRUE)
{
	/* 去除html 标签,并且 截取 一段文字 */
	if($istags != FALSE)
	{
		$content = strip_tags ( $str );
	}
	// 按照字节来划分(不会出现乱码)
	$str = mb_strcut ( $content, 0, $max_length, 'utf-8' );
	// 函数2 $str = mb_substr ( $str, 0, $max_length, 'utf-8' );
	return $str;
}

/**
 * @action 生成一个随机字符串
 * @author Name zhw Email 343196936@qq.com Data 2016年3月28日
 * @param $type 随机字符串类型
 * @param $length 随机字符串长度
 * @return string 随机码的长度
 */
function dbg_rand($type, $length)
{
	$random_str = NULL;
	switch($type)
	{
		case 'num':
			for($i = 0;$i < $length;$i ++)
			{
				$id = rand ( 0, 9 );
				$random_str = $random_str . $id;
			}
			break;
		case 'id':
			date_default_timezone_set ( 'PRC' );
			$random_str = date ( 'YmdHis', time () );
			if($model == null)
			{
				$random_str = $random_str . rand ( 1000, 9999 );
			}
			else
			{
				$random_str = $random_str . rand ( 1000, 999999 );
			}
			break;
		case 'md5':
			break;
		case 'code':
			$random_code = "";
			$strChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$max = strlen ( $strChars ) - 1;
			mt_srand ( ( double ) microtime () * 1000000 );
			for($i = 0;$i < $length;$i ++)
			{
				$random_str .= $strChars[mt_rand ( 0, $max )];
			}
			
			break;
		case 'captcha':
			break;
	}
	return $random_str;
}
// @action: 常用的gei 、post 接收
function dbg_input_getpost($name = NULL, $type = 1)
{
	$dbg_ci = &get_instance ();
	$return = $dbg_ci->input->get_post ( $name );
	return $return;
}
/*
 * 功能：用来过滤字符串和字符串数组，防止被挂马和sql注入
 * 参数$data，待过滤的字符串或字符串数组，
 * $force为true，忽略get_magic_quotes_gpc
 */
function dbg_in($data, $force = false)
{
	if(is_string ( $data ))
	{
		$data = trim ( htmlspecialchars ( $data ) ); // 防止被挂马，跨站攻击
		if(($force == true) || (! get_magic_quotes_gpc ()))
		{
			$data = addslashes ( $data ); // 防止sql注入
		}
		return $data;
	}
	else if(is_array ( $data ))
	{
		foreach($data as $key=>$value)
		{
			$data[$key] = dbg_in ( $value, $force );
		}
		return $data;
	}
	else
	{
		return $data;
	}
}
// 用来还原字符串和字符串数组，把已经转义的字符还原回来
function dbg_out($data)
{
	if(is_string ( $data ))
	{
		return $data = stripslashes ( $data );
	}
	else if(is_array ( $data ))
	{
		foreach($data as $key=>$value)
		{
			$data[$key] = dbg_out ( $value );
		}
		return $data;
	}
	else
	{
		return $data;
	}
}

// 修改CI的跳转
function dbg_redirect($uri = '', $method = 'location', $http_response_code = 302)
{
	// if ( ! preg_match ( '#^https?://#i', $uri )) {
	// $uri = site_url ( $uri );
	// }
	switch($method)
	{
		case 'js':
			echo "<script>" . "function redirect() {window.location.replace('$uri');}\n" . "setTimeout('redirect();', 0);\n" . "</script>";
			break;
		case 'refresh':
			header ( "Refresh:0;url=" . $uri );
			break;
		default:
			header ( "Location: " . $uri, TRUE, $http_response_code );
			break;
	}
	exit ();
}
// @action:压缩 css,js文件
/*
 * 存放 自定义函数
 * 这里面的函数 将会被全局引用 可以任何地方使用 这里最好只存放 较为通用的全局信息
 */
function dbg_ui($uipath, $assets, $ver = 0)
{
	// $uiarr = 'js/jquery-1.7.2.min.js,';
	// $uiarr = str_replace ( ',', ',', $uiarr );
	// $uiarr = str_replace ( '，', ',', $uiarr );
	$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	// $url = 'http://' . $_SERVER['HTTP_HOST'] . substr ( $PHP_SELF, 0, strrpos ( $PHP_SELF, '/' ) + 1 );
	// echo $_SERVER['HTTP_HOST'].'<br/>';
	$_root_ = substr ( $PHP_SELF, 0, strrpos ( $PHP_SELF, '/' ) + 1 );
	// 注意，第二种方法我不太会，如文件路径为：/wjj/wjj1/wjj2/a.php，它只返回 /wjj 后面的/自己加！
	
	$baseurl = base_url ();
	
	// explode ( ',', $uiarr );
	if(! empty ( $assets ))
	{
		$assets = str_replace ( ',', ',', $assets );
		$assets = str_replace ( '，', ',', $assets );
		$files = explode ( ',', $assets );
		$t = '';
		foreach($files as $file)
		{
			$file = _ROOT_ . '/themes/default/' . $file;
			$t .= @filemtime ( $file );
		}
		foreach($files as $file)
		{
			$news_assets[] = $uipath . $file;
		}
		$news_assets = join ( ',', $news_assets );
		unset ( $files );
		
		return $baseurl . 'minify.php?f=' . $news_assets . (empty ( $ver ) ? '&v=' . substr ( md5 ( $t ), 0, 8 ) : '&v=' . $ver);
	}
	else
		return '';
}

/*
 * Head 类 ***********************************************
 */
function myheader($string, $replace = true, $http_response_code = 0)
{
	$string = str_replace ( array(
			"\r",
			"\n" 
	), array(
			'',
			'' 
	), $string );
	if(empty ( $http_response_code ) || PHP_VERSION < '4.3')
	{
		@header ( $string, $replace );
	}
	else
	{
		@header ( $string, $replace, $http_response_code );
	}
	if(preg_match ( '/^\s*location:/is', $string ))
	{
		exit ();
	}
}
function head404()
{
	@header ( 'HTTP/1.1 404 Not Found' );
	@header ( 'Status: 404 Not Found' );
}
function head301($url = '')
{
	header ( 'HTTP/1.1 301 Moved Permanently' );
	header ( 'Location: ' . $url );
}

// @action:输出
function dbg_jsmsg($str = NULL, $isF5 = NULL)
{
	$message = '<script language="javascript">alert("' . $str . '!");</script>';
	echo $message;
}

/**
 * ******重点：可做回调函数********
 * @action dbgms 
 * @author dbgms-zhw  
 * @version 2016-01-20 
 * @param string $sql sql语句
 * @param boolean $isreturn 是否返回
 * @param number $type 框架选择 1.CodeIgniter 2.ThinkPHP  
 * @return unknown
 */
function dbg_query($sql = NULL, $isreturn = TRUE, $type = 1)
{
	/*
	 * global $dbg_ci;
	 * $result = "";
	 */
	switch($type)
	{
		// 1.获取ci控制器，和数据查询为 CI自带执行sql语句
		case 1:
			$dbg_ci = &get_instance ();
			if($isreturn)
			{
				$result = $dbg_ci->db->query ( $sql )->result_array ();
			}
			else
			{
				$result = $dbg_ci->db->query ( $sql );
			}
			// if(count ( $result ) == 1)
			// {
			// $result = $result[0];
			// }
			return $result;
			// return object_replace_array ( 1, $result );
			break;
		// 2.为 TP自带执行sql语句
		case 2:
			
			break;
		// 默认为自己写的
		default:
			break;
	}
}
function dbg_db_insert_id()
{
	$dbg_ci = &get_instance ();
	return $dbg_ci->db->insert_id ();
}
/**
 * @action 判断 末尾是 以什么结尾
 * @param string $str  需要引用的字符串
 * @param string $char  在什么断尾
 * @param string $char2 以什么结尾
 */
function dbg_strrchr(&$str = NULL, $char = NULL, $char2 = NULL)
{
	if($char2 == NULL)
	{
		$char2 = $char;
	}
	$str = strtolower ( $str ); // 将英文字母转成小写
	if(strrchr ( $str, "{$char}" ) != "{$char2}")
	{
		$str .= "{$char2}";
	}
}
// 判断后缀type=1 本地 type=2 服务器
function dbg_is_suffix($str, $type = '.html')
{
	// $str_arr = explode ( '.', $str );
	$the_host = $_SERVER['HTTP_HOST']; // 取得当前域名
	$the_url = isset ( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : ''; // 判断地址后面部分
	$the_url = strtolower ( $the_url ); // 将英文字母转成小写
	$curr_url_arr = explode ( '?', $the_url );
	if(strrchr ( $curr_url_arr[0], "." ) != $type)
	{
		show_404 ();
		exit ();
		dbg_redirect ( DBG_SITEURL . $modelinfo['sign'] . '/' . $column_or_id . '.html' );
	}
	
	// // 判断是否为数字ID
	// if(is_numeric ( $column_or_id ) && (count ( $column_or_id_arr ) == $type))
	// {
	// // ID 是否转换
	// $id = $column_or_id;
	// // 获取模型,并且判断模型是否存在
	// $modelinfo = dbg_getModel ( $model_id );
	// $the_host = $_SERVER['HTTP_HOST']; // 取得当前域名
	// $the_url = isset ( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : ''; // 判断地址后面部分
	// $the_url = strtolower ( $the_url ); // 将英文字母转成小写
	// if(strrchr ( $the_url, "." ) != ".html")
	// {
	// dbg_redirect ( DBG_SITEURL . $modelinfo['sign'] . '/' . $id . '.html' );
	// exit ();
	// }
	// // 判断数据库是否存在该ID
	// $sql_id = "SELECT c.id FROM " . $modelinfo['table'] . " AS c WHERE c.id=" . $id;
	// $row_id = dbg_query ( $sql_id );
	// if(empty ( $row_id ))
	// {
	// // 404错误
	// show_404 ( '不存在该ID', 'log_error' );
	// exit ();
	// }
	// // ===============url不为 id.html的时候,进行跳转,或者404
	// if(count ( $column_or_id_arr ) >= 2)
	// {
	// $id = $column_or_id_arr[0];
	// // 获取模型,并且判断模型是否存在
	// $modelinfo = dbg_getModel ( 1 );
	// $the_host = $_SERVER['HTTP_HOST']; // 取得当前域名
	// $the_url = isset ( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : ''; // 判断地址后面部分
	// $the_url = strtolower ( $the_url ); // 将英文字母转成小写
	// $curr_url = str_replace ( '/' . $modelinfo['sign'] . '/' . $id, '', $the_url );
	// $curr_url_arr = explode ( '.', $curr_url );
	// if(($column_or_id_arr[1] != 'html') || (count ( $curr_url_arr ) > 2))
	// {
	// // 404错误
	// show_404 ( '不存在该ID', 'log_error' );
	// exit ();
	// }
	// }
	// return $id;
	// }
}
// MD5加密截取 默认24位
function nmd5($str, $len = 24, $start = 5)
{
	// 此值不要更改 否则会员会登录失败
	$hash = 'dbgms!@$=#=%+#com';
	return substr ( md5 ( $str . $hash ), $start, $len );
}

// $myReg = "/^[A-Za-z\x80-\xff0-9_-]{2,24}$/";
// $allNum = "/^[0-9]+$/";
// if(! preg_match ( "/^[0-9]+(.[0-9])?$/", $this->input->post ( 'artistID', true ) ))
// {
// echo "<script>alert('服务项目原价格格式有误，修改失败');location.href='showitems';</script>";
// }
// if(! preg_match ( "/^[\d]{1,6}$/", $this->input->post ( 'm_popular', true ) ))
// {
// echo "<script>alert('人气值格式有误，修改失败');location.href='showitems';</script>";
// }
// if($user)
// {
// echo "<script>alert('卡号已存在,请重新填写！');location.href='http://127.0.0.1/fqsjc/index.php/member';</script>";
// exit ();
// }
// if(! preg_match ( "/^(0|[1-9][0-9]*)$/", $this->input->post ( 'm_number', true ) ))
// {
// echo "<script>alert('卡号必须为不为0开头的纯数字,请重新填写！');location.href='http://127.0.0.1/ci/index.php/vip';</script>";
// exit ();
// }
/**
 * @author zhw 常用 邮箱 方法
 * @param string $type 类别
 * @param string $param 参数
 * @return boolean|Ambigous <string, unknown>
 */
function dbg_email($type = NULL, $param = NULL)
{
	if(! empty ( $param ))
	{
		$regex = '/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[-_a-z0-9][-_a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,})$/i';
		if(preg_match ( $regex, $param ))
		{
			return TRUE;
		}
	}
	return FALSE;
}
