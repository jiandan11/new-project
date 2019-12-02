<?php
header ( "Content-type: text/html; charset=utf-8" );
define ( '_ROOT_', preg_replace ( '/(\/|\\\\){1,}/', '/', dirname ( dirname ( __FILE__ ) ) ) . '/' );
define ( '_DATA_', _ROOT_ . 'data/' );
define ( '_DBGMS_', _ROOT_ . 'dbgms/' );
define ( '_FILE_', _ROOT_ . 'file/' );
define ( '_UI_', _ROOT_ . 'ui/' );

/* :::::::::::::::::::::::::::::: */
/* 删除24小时 session 时间差（秒）：86400 */
/* 删除12小时 session 时间差（秒）：43200 */
$data_public_session_lock = _DATA_ . 'config/public.session.lock';
$current_time = time ();
if(! file_exists ( $data_public_session_lock ))
{ /* 未安装 */
	$data_public_session_file_time = 0;
}
else
{
	$data_public_session_file_time = filemtime ( $data_public_session_lock );
}
$chajutime = ($current_time - $data_public_session_file_time);
if($chajutime > 86400)
{ /* 删除public——session */
	$data_public_dir = _DATA_ . "public/";
	// Open a known directory, and proceed to read its contents
	if(is_dir ( $data_public_dir ))
	{
		if($dh = opendir ( $data_public_dir ))
		{
			while(($data_public_file_name = readdir ( $dh )) !== false)
			{
				if($data_public_file_name == "." || $data_public_file_name == "..")
				{
					continue;
				}
				// $is_user_session = strpos ( $data_public_file_name, 'user_' );
				$is_user_session = TRUE;
				if($is_user_session === FALSE)
				{
					continue;
				}
				else
				{
					$data_public_file_path = $data_public_dir . $data_public_file_name;
					unlink ( $data_public_file_path );
				}
			}
			closedir ( $dh );
			fopen ( $data_public_session_lock, 'w' );
		}
	}
}
/* :::::::::::::::::::::::::::::: */
/* 站点配置(多域名 参数) */
$domain = array();
$domain = glob ( _ROOT_ . 'data/config/domain.*.php' );
$result = array();
foreach($domain as $value)
{
	$result[] = require $value;
}
$_domain = array();
foreach($result as $val)
{
	$_domain[] = $val['base'];
}
if(! empty ( $_domain ))
{
	$_project = '';
	$_themes = '';
	/* 设置站点APP */
	foreach($_domain as $key=>$val)
	{
		if($val['sign'] == 'default')
		{
			$_themes = $val['themes'];
		}
		if(in_array ( $_SERVER['HTTP_HOST'], ( array ) $val['domain'] ))
		{
			$_project = $val['project'];
			$_themes = $val['themes'];
		}
	}
}
$_project = empty ( $_project ) ? 'website/' : $_project;
$_themes = empty ( $_themes ) ? 'default' : $_themes;

// @action:判断是否属手机 2016_04_12
function dbgms_is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array(
			"240x320",
			"acer",
			"acoon",
			"acs-",
			"abacho",
			"ahong",
			"airness",
			"alcatel",
			"amoi",
			"android",
			"anywhereyougo.com",
			"applewebkit/525",
			"applewebkit/532",
			"asus",
			"audio",
			"au-mic",
			"avantogo",
			"becker",
			"benq",
			"bilbo",
			"bird",
			"blackberry",
			"blazer",
			"bleu",
			"cdm-",
			"compal",
			"coolpad",
			"danger",
			"dbtel",
			"dopod",
			"elaine",
			"eric",
			"etouch",
			"fly ",
			"fly_",
			"fly-",
			"go.web",
			"goodaccess",
			"gradiente",
			"grundig",
			"haier",
			"hedy",
			"hitachi",
			"htc",
			"huawei",
			"hutchison",
			"inno",
			"ipad",
			"ipaq",
			"ipod",
			"jbrowser",
			"kddi",
			"kgt",
			"kwc",
			"lenovo",
			"lg ",
			"lg2",
			"lg3",
			"lg4",
			"lg5",
			"lg7",
			"lg8",
			"lg9",
			"lg-",
			"lge-",
			"lge9",
			"longcos",
			"maemo",
			"mercator",
			"meridian",
			"micromax",
			"midp",
			"mini",
			"mitsu",
			"mmm",
			"mmp",
			"mobi",
			"mot-",
			"moto",
			"nec-",
			"netfront",
			"newgen",
			"nexian",
			"nf-browser",
			"nintendo",
			"nitro",
			"nokia",
			"nook",
			"novarra",
			"obigo",
			"palm",
			"panasonic",
			"pantech",
			"philips",
			"phone",
			"pg-",
			"playstation",
			"pocket",
			"pt-",
			"qc-",
			"qtek",
			"rover",
			"sagem",
			"sama",
			"samu",
			"sanyo",
			"samsung",
			"sch-",
			"scooter",
			"sec-",
			"sendo",
			"sgh-",
			"sharp",
			"siemens",
			"sie-",
			"softbank",
			"sony",
			"spice",
			"sprint",
			"spv",
			"symbian",
			"tablet",
			"talkabout",
			"tcl-",
			"teleca",
			"telit",
			"tianyu",
			"tim-",
			"toshiba",
			"tsm",
			"up.browser",
			"utec",
			"utstar",
			"verykool",
			"virgin",
			"vk-",
			"voda",
			"voxtel",
			"vx",
			"wap",
			"wellco",
			"wig browser",
			"wii",
			"windows ce",
			"wireless",
			"xda",
			"xde",
			"zte" 
	);
	$is_mobile = false;
	foreach($mobile_agents as $device)
	{
		if(stristr ( $user_agent, $device ))
		{
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}

$is_mobile_themes = dbgms_is_mobile ();
if(! empty ( $is_mobile_themes ) && is_dir ( _ROOT_ . 'themes/mobile/' ))
{ // 设置默认手机模板
	$_themes = "mobile";
}
define ( 'DOMAIN_PROJECT', $_project );
define ( 'DOMAIN_THEMES', $_themes );
define ( 'DOMAIN_PROJECT_PATH', _ROOT_ . 'domain/' . DOMAIN_PROJECT . '/' );
define ( 'DOMAIN_THEMES_PATH', _ROOT_ . 'themes/' . DOMAIN_THEMES . '/views/' );
unset ( $domain, $result, $_domain, $_project, $_themes );
/*@author:zhw V2016-04-12*/