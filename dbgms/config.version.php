<?php
// ACCESS_ID
define ( 'DBGMS_ACCESS_ID', 'V20160404' );
// ACCESS_KEY
define ( 'DBGMS_ACCESS_KEY', 'dbgmsV20160404' );
// 是否输出DEBUG
define ( 'DEBUG', FALSE );

// 语言版本设置
define ( 'LANG', 'zh' );
// 设置每个php进程的内存消耗值,对应于php.ini里的memory_limit
define ( 'MAX_MEMORY_LIMIT', '256M' );
// 设置每个php进程的最大执行时间
define ( 'MAX_EXECUTE_TIME', '3600' );
define ( 'MAX_UPLOAD_FILE_SIZE', 128 * 1024 * 1024 * 1024 * 1024 );
// 定义软件名称，版本号等信息
define ( 'DBGMS_NAME', 'dbgms-sdk-php' );
define ( 'DBGMS_VERSION', '2.04.14' );
define ( 'DBGMS_BUILD', '201604140948' );
define ( 'DBGMS_AUTHOR', '240337740@qq.com' );

// 自定义日志路径，如果没有设置，则使用系统默认路径，在./logs/
// define('ALI_LOG_PATH','');
// 是否记录日志
define ( 'ALI_LOG', FALSE );
// 是否显示LOG输出
define ( 'ALI_DISPLAY_LOG', FALSE );
// 语言版本设置
define ( 'ALI_LANG', 'zh' );