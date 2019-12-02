<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
// @action:加载 状态 20160330
function dbgms_LoadState($onlytime = 0, $more = 0)
{
	define ( 'MICROTIME_START', microtime () );
	$stime = explode ( ' ', MICROTIME_START );
	$etime = explode ( ' ', microtime () );
	if($onlytime)
		return number_format ( ($etime[1] + $etime[0] - $stime[1] - $stime[0]), 6 );
	$rs = 'processed in ' . number_format ( ($etime[1] + $etime[0] - $stime[1] - $stime[0]), 6 ) . ' second(s),  $msql->quetynum  queries.';
	if($more)
		$rs .= 'memory_use:' . number_format ( memory_get_usage () / 1024 / 1024, 3 ) . 'M,memory_max:' . number_format ( memory_get_peak_usage () / 1024 / 1024, 3 ) . 'M.';
	return $rs;
}
// @action:加载 模型 20160328
function dbgms_LoadModels($models)
{
}
// @action:加载 控制器 20160328
function dbgms_LoadControllers($controllers)
{
}
// @action:加载 视图 20160328
function dbgms_LoadViews($view, $data, $isreturn = FALSE)
{
	$dbg_ci = &get_instance ();
	if(! empty ( $isreturn ))
	{
		return $dbg_ci->load->view ( $view, $data, $isreturn );
	}
	else
	{
		$dbg_ci->load->view ( $view, $data );
	}
}
// @action:加载 类库文件，类 20160328
function dbgms_LoadClass($class = NULL, $class_config = NULL, $check = FALSE)
{
	if($check)
	{
		if(is_file ( $class ))
		{
			require_once ($class);
		}
		else
		{
			echo $class . 'is not exist';
		}
	}
	require_once str_replace ( '//', '/', _DBGMS_CLASS_ . '/' . $class );
}
