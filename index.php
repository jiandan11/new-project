<?php
/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
// 是否添加360网站安全处理脚本文件，注意文件路径
// if(is_file ( $_SERVER['DOCUMENT_ROOT'] . '/360safe_webscan.php' ))
// {
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/360safe_webscan.php');
// }
/* ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
if(! file_exists ( dirname ( __FILE__ ) . '/data/config/install.lock' ))
{ /* 未安装 */
	header ( 'Location:/install' );
	exit ();
}
include dirname ( __FILE__ ) . '/dbgms/config.php';

/*
 * ---------------------------------------------------------------
 * APPLICATION ENVIRONMENT 应用环境
 * ---------------------------------------------------------------
 * 您可以加载不同的配置，这取决于您的当前环境。设置环境也影响日志和错误报告。
 * 这可以设置为任何，但默认使用是： 发展，测试，产品
 * 注意：如果你改变了这些，也改变error_reporting()代码如下
 */
define ( 'ENVIRONMENT', isset ( $_SERVER['CI_ENV'] ) ? $_SERVER['CI_ENV'] : 'development' );
/*
 * ---------------------------------------------------------------
 * ERROR REPORTING 错误报告
 * ---------------------------------------------------------------
 * 不同的环境将需要不同程度的错误报告。默认的开发将显示错误，但测试和生活将隐藏它们。
 */
switch(ENVIRONMENT)
{
	case 'development':
		error_reporting ( - 1 );
		ini_set ( 'display_errors', 1 );
		break;
	case 'testing':
	case 'production':
		ini_set ( 'display_errors', 0 );
		if(version_compare ( PHP_VERSION, '5.3', '>=' ))
		{
			error_reporting ( E_ALL & ~ E_NOTICE & ~ E_DEPRECATED & ~ E_STRICT & ~ E_USER_NOTICE & ~ E_USER_DEPRECATED );
		}
		else
		{
			error_reporting ( E_ALL & ~ E_NOTICE & ~ E_STRICT & ~ E_USER_NOTICE );
		}
		break;
	default:
		header ( 'HTTP/1.1 503 Service Unavailable.', TRUE, 503 );
		echo 'The application environment is not set correctly.';
		exit ( 1 ); // EXIT_ERROR
}

/*
 * ---------------------------------------------------------------
 * SYSTEM FOLDER NAME 系统文件夹名称
 * ---------------------------------------------------------------
 * 这个变量必须包含“系统”文件夹的名称,包括路径，如果文件夹不在同一个目录中作为该文件。
 */
$system_path = _DBGMS_ . 'ci_system';

/*
 * ---------------------------------------------------------------
 * APPLICATION FOLDER NAME 应用程序文件夹名称
 * ---------------------------------------------------------------
 */

$application_folder = DOMAIN_PROJECT_PATH;

/*
 * ---------------------------------------------------------------
 * 查看文件夹名称
 * ---------------------------------------------------------------
 *
 * 如果你想将视图文件夹移到应用程序中
 * 文件夹设置的路径到文件夹中。该文件夹可以重命名
 * 在服务器上的任何地方。如果空白，它将默认
 * 您的应用程序文件夹内的标准位置。如果你
 * 做移动此操作，使用此文件夹中的全部服务器路径。
 *
 * 没有尾随的！
 */
$view_folder = '';

/*
 * --------------------------------------------------------------------
 * 默认控制器
 * --------------------------------------------------------------------
 *
 * 你通常会在routes.php文件设置默认的控制器。
 * 然而，你可以强制一个自定义路由，通过硬编码
 * 特定的控制器类/功能在这里。对于大多数应用程序，您
 * 将不会设置您的路由，但它是一个选项
 * 特殊情况下，您可能要重写标准
 * 路由在特定的前端控制器，共享一个共同的词安装。
 *
 * 重要的是：如果你在这里设置路由，没有其他的控制器
 * 可赎回。从本质上说，这种偏好限制了你的应用程序
 * 特定控制器。如果你需要的话，把函数名留
 * 调用函数动态通过URI。
 *
 * 联合国评论下面的$routing阵列使用此功能
 */
// 目录名称，相对于“控制器”文件夹。留空白
// 如果您的控制器没有在“控制器”文件夹中的子文件夹中
// $routing[ 'directory’] =”；
// 控制器类文件名。例如：传递
// $routing[ 'controller’] =”；
// 您希望被调用的控制器函数。
// $routing[ 'function’] =”；

/*
 * -------------------------------------------------------------------
 * 自定义配置值
 * -------------------------------------------------------------------
 *
 * 美元以下assign_to_config阵列将通过动态的
 * 初始化初始化时的*。这允许您设置自定义配置
 * 物品或覆盖任何默认设置值在config.php文件中找到。
 * 这可能是方便的，因为它允许您共享一个应用程序之间
 * 多个前端控制器文件，每个文件包含不同的文件
 * 配置值。
 *
 * 联合国评论$assign_to_config阵列使用此功能
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';

// --------------------------------------------------------------------
// 用户配置设置的结束。不要编辑下面这条线
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 * 解决提高可靠性的系统路径
 * ---------------------------------------------------------------
 */

// 设置当前目录正确的CLI的请求
if(defined ( 'STDIN' ))
{
	chdir ( dirname ( __FILE__ ) );
}

if(($_temp = realpath ( $system_path )) !== FALSE)
{
	$system_path = $_temp . '/';
}
else
{
	// 确保有一个尾随的
	$system_path = rtrim ( $system_path, '/' ) . '/';
}

// 系统路径是否正确？
if(! is_dir ( $system_path ))
{
	header ( 'HTTP/1.1 503 Service Unavailable.', TRUE, 503 );
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: ' . pathinfo ( __FILE__, PATHINFO_BASENAME );
	exit ( 3 ); // 退出配置
}

/*
 * -------------------------------------------------------------------
 * 现在，我们知道路径，设置的主要路径常数
 * -------------------------------------------------------------------
 */
// 这个文件的名称
define ( 'SELF', pathinfo ( __FILE__, PATHINFO_BASENAME ) );

// 系统文件夹的路径
define ( 'BASEPATH', str_replace ( '\\', '/', $system_path ) );

// 前面控制器（此文件）的路径
define ( 'FCPATH', dirname ( __FILE__ ) . '/' );

// “系统文件夹”名称
define ( 'SYSDIR', trim ( strrchr ( trim ( BASEPATH, '/' ), '/' ), '/' ) );

// “应用程序”文件夹的路径
if(is_dir ( $application_folder ))
{
	if(($_temp = realpath ( $application_folder )) !== FALSE)
	{
		$application_folder = $_temp;
	}
	
	define ( 'APPPATH', $application_folder . DIRECTORY_SEPARATOR );
}
else
{
	if(! is_dir ( BASEPATH . $application_folder . DIRECTORY_SEPARATOR ))
	{
		header ( 'HTTP/1.1 503 Service Unavailable.', TRUE, 503 );
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
		exit ( 3 ); // 退出配置
	}
	
	define ( 'APPPATH', BASEPATH . $application_folder . DIRECTORY_SEPARATOR );
}

// “视图”文件夹的路径
if(! is_dir ( $view_folder ))
{
	if(! empty ( $view_folder ) && is_dir ( APPPATH . $view_folder . DIRECTORY_SEPARATOR ))
	{
		$view_folder = APPPATH . $view_folder;
	}
	elseif(! is_dir ( APPPATH . 'views' . DIRECTORY_SEPARATOR ))
	{
		header ( 'HTTP/1.1 503 Service Unavailable.', TRUE, 503 );
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
		exit ( 3 ); // 退出配置
	}
	else
	{
		$view_folder = APPPATH . 'views';
	}
}

if(($_temp = realpath ( $view_folder )) !== FALSE)
{
	$view_folder = $_temp . DIRECTORY_SEPARATOR;
}
else
{
	$view_folder = rtrim ( $view_folder, '/\\' ) . DIRECTORY_SEPARATOR;
}

define ( 'VIEWPATH', $view_folder );

/*
 * --------------------------------------------------------------------
 * 加载引导文件
 * --------------------------------------------------------------------
 *
 * 我们走了…
 */
require_once BASEPATH . 'core/CodeIgniter.php';
