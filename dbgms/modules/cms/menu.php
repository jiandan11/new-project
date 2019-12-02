<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
return array(
		'name' => '内容',
		'modules' => 'cms',
		'default' => 'content&modelid=1',
		'controllers' => array(
				0 => array(
						'con' => 'content',
						'name' => '内容管理',
						'act' => array() 
				),
				1 => array(
						'con' => 'column',
						'home' => 1,
						'name' => '栏目管理',
						'act' => array() 
				),
				2 => array(
						'con' => 'expand',
						'name' => '多维栏目',
						'act' => array() 
				),
				
				3 => array(
						'con' => 'fragment',
						'home' => 1,
						'name' => '碎片管理',
						'act' => array() 
				),
				4 => array(
						'con' => 'feedback',
						'name' => '意见反馈',
						'act' => array() 
				),
				5 => array(
						'con' => 'flink',
						'name' => '友情链接',
						'act' => array() 
				),
				6 => array(
						'con' => 'album',
						'name' => '专题管理',
						'act' => array(
								'index',
								'edit',
								'delete',
								'update' 
						) 
				),
				7 => array(
						'con' => 'model',
						'name' => '模型管理',
						'act' => array() 
				),
				8 => array(
						'con' => 'pages',
						'name' => '单页管理',
						'act' => array() 
				),
				9 => array(
						'con' => 'form',
						'name' => '自定义表单',
						'act' => array() 
				),
				10 => array(
						'con' => 'tags',
						'name' => 'TAG管理',
						'act' => array() 
				) 
		) 
);
