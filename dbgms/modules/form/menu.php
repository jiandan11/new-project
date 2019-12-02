<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
return array(
		'name' => '前端表单',
		'modules' => 'form',
		'default' => 'readme&act=index',
		'controllers' => array(
				'a' => array(
						'con' => 'readme',
						'name' => '操作说明',
						'act' => array() 
				),
				'b' => array(
						'con' => 'richform',
						'name' => '富表单管理',
						'act' => array() 
				),  
				0 => array(
						'con' => 'baseformelement',
						'name' => '基本表单元素管理',
						'act' => array() 
				),
				1 => array(
						'con' => 'elementstylegroup',
						'name' => '表单元素风格组管理',
						'act' => array() 
				), 
				2 => array(
						'con' => 'richformelement',
						'name' => '富表单元素管理',
						'act' => array() 
				),  
				4 => array(
						'con' => 'regular',
						'name' => '表单验证规则管理',
						'act' => array() 
				),  
				5 => array(
						'con' => 'jsevent',
						'name' => 'js表单元素事件管理',
						'act' => array() 
				),
				6 => array(
						'con' => 'richformrecycle',
						'name' => '富表单回收管理',
						'act' => array() 
				), 
		) 
);
