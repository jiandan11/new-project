<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	header ( 'HTTP/1.1 404 Not Found' );
	exit ( '权限路径.No direct script access allowed' );
}
// header ( "Content-type: text/html; charset=utf-8" );
// header ( "Content-type:application/json" );
// 文件路径
// 定义一个常量,正则替换-获取当前文件的绝对目录
define ( 'DBGMS', preg_replace ( '/(\/|\\\\){1,}/', '/', dirname ( __FILE__ ) ) ); // DBG框架路径
define ( '_DBGMS_CLASS_', DBGMS . '/class/' ); // DbgMs 类库
define ( '_DBGMS_CORE_', DBGMS . '/core/' ); // DbgMs 核心
define ( '_DBGMS_DIYFIELD_', DBGMS . '/diyfield/' ); // DbgMs 自定义字段
define ( '_DBGMS_FONTS_', DBGMS . '/fonts/' ); // DbgMs 字体 水印
define ( '_DBGMS_FUNC_', DBGMS . '/func/' ); // DbgMs 函数
define ( '_DBGMS_MODULES_', DBGMS . '/modules/' ); // DbgMs 模块

define ( 'DBG_DATA', dirname ( DBGMS ) . '/data/' ); // DBG data
define ( 'DBG_FILE', dirname ( DBGMS ) . '/file/' ); // DBG data
define ( 'DBG_CACHE', DBG_DATA . 'cache/' ); // 缓存文件路径
define ( 'DBG_CONFIG', DBG_DATA . 'config/' ); // 配置文件路径

require (_DBGMS_CORE_ . 'Dbgms.core.php'); // 模型 类
                                           
// -重要

require (_DBGMS_CORE_ . 'common.php'); // 常用
require (_DBGMS_CORE_ . 'domain.dbg.php'); // 常用
require (_DBGMS_CORE_ . 'diyfield.php'); // 常用
                                         
// -常用函数
                                         
// require (_DBGMS_FUNC_ . 'func.common.php'); // 常用函数

require (_DBGMS_FUNC_ . 'func.array.php'); // 常用函数_数组_字符串
require (_DBGMS_FUNC_ . 'func.file.php'); // 常用函数_文件操作
require (_DBGMS_FUNC_ . 'func.ip.php'); // 常用函数_ip
require (_DBGMS_FUNC_ . 'func.load.php'); // 常用函数_load
                                          
// require (_DBGMS_FUNC_ . 'func.sql.php'); // 常用函数_sql语句,数据库

require (_DBGMS_FUNC_ . 'func.time.php'); // 常用函数_时间
require (_DBGMS_FUNC_ . 'func.img.php'); // 常用函数_时间

