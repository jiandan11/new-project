<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
// 当前 modules:cms
// 当前 controllers : $con
$dbgms_con = dbg_input_getpost ( 'con' );
$dbgms_act = dbg_input_getpost ( 'act' );
$data['act'] = $dbgms_act;
$dbgms_use = dbg_input_getpost ( 'use' );
require_once _DBGMS_CORE_ . 'Admin.class.core.php';
require _DBGMS_MODULES_ . $modules . '/controllers/' . $dbgms_con . '.php';
$dbgms_mc_class = strtoupper ( $modules ) . '_' . ucfirst ( $dbgms_con ); /* . '.class.php'; */
$dbgms_mc = new $dbgms_mc_class ( $data );
$dbgms_mc->admin_data['views'] = _DBGMS_MODULES_ . $modules . '/views/' . $dbgms_con . '.php';
$dbgms_act = $dbgms_mc->admin_data['act'] = empty ( $dbgms_act ) ? 'index' : $dbgms_act;
if(! method_exists ( $dbgms_mc, $dbgms_act ))
{
	show_error ( '未定义' . $use . '方法！', 404, 404 );
}
$dbgms_mc->$dbgms_act ();



 