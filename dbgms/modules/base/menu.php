<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
return array(
		'name' => '设置',
		'modules' => 'base',
		'default' => 'record',
		'controllers' => array(
				0 => array(
						'con' => 'record',
						'name' => '数据统计',
						'home' => 1,
						'act' => array() 
				),
				1 => array(
						'con' => 'init',
						'name' => '初始化',
						'home' => 1,
						'act' => array() 
				),
				2 => array(
						'con' => 'site',
						'name' => '站点设置',
						'home' => 1,
						'act' => array() 
				),
				3 => array(
						'con' => 'set',
						'name' => '全局设置',
						'act' => array() 
				),
				4 => array(
						'con' => 'admin',
						'name' => '管理员列表',
						'act' => array() 
				),
				5 => array(
						'con' => 'admin_group',
						'name' => '管理组',
						'act' => array() 
				),
				6 => array(
						'con' => 'admin_log',
						'name' => '操作日志',
						'act' => array() 
				),
				7 => array(
						'con' => 'change',
						'home' => 1,
						'name' => '修改密码',
						'act' => array() 
				),
				8 => array(
						'con' => 'modules',
						'name' => '系统模块管理',
						'act' => array() 
				) 
		) 
);
