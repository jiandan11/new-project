<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
//用户模块--安装 

//判断激活码是否正确
//激活码: md5(模板号码)+md5(套餐)+md5(模块)+购买时间+
//例如: md5(0077)+md5(4888)+md5(user)+20160102+

//同时生成 
// 用户 资源文件夹： file/user
// 用户 缓存解析夹： data/user

//数据表dbg_menu添加内容
//添加顶部菜单
// id	type	name	module	act		 table	info	install	disable	 param	diyfield
// 1	0		用户		0		0	 0		无		0		1        null   null
//添加对应功能
// id	type	name	module	act		 	table	info	install	disable	 param	diyfield
// 1	0		用户列表	user	user	 	 0		无		0		1        null   null
// 1	0		用户权限	user	user_set	 0		无		0		1        null   null
// 1	0		用户设置	user	user_group	 0		无		0		1        null   null
//数据表dbg_model添加内容
//添加2个 内容模型表单---》目前支持  提问 和发布文章
// id  rank	 name	sign	table		install	disable	template must	param				diyfield
// 1   0	  提问   	ask		db_ask		0		1		无		 1		a:3:{s:7:"iscache";s:1:"1";s:9:"iscomment";s:1:"0";s:9:"isexamine";s:1:"0";}	a:3:{i:0;a:8:{s:4:"name";s:9:"封面图";s:5:"field";s:5:"thumb";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:4:"help";s:0:"";s:10:"relationid";s:1:"1";s:9:"starfield";s:5:"thumb";}i:1;a:4:{s:4:"name";s:6:"大图";s:5:"field";s:5:"slide";s:4:"type";s:4:"file";s:7:"defualt";s:0:"";}i:2;a:7:{s:4:"name";s:6:"内容";s:5:"field";s:7:"content";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:7:"content";}}
// 1   0	  文章   	article	db_article	0		1		无		 1		a:3:{s:7:"iscache";s:1:"1";s:9:"iscomment";s:1:"0";s:9:"isexamine";s:1:"0";}	a:3:{i:0;a:8:{s:4:"name";s:9:"封面图";s:5:"field";s:5:"thumb";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:4:"help";s:0:"";s:10:"relationid";s:1:"1";s:9:"starfield";s:5:"thumb";}i:1;a:4:{s:4:"name";s:6:"大图";s:5:"field";s:5:"slide";s:4:"type";s:4:"file";s:7:"defualt";s:0:"";}i:2;a:7:{s:4:"name";s:6:"内容";s:5:"field";s:7:"content";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:7:"content";}}


// 是否开启用户
// 并且安装了用户模块---安装后会 留下 module.user.install.lock文件，判断文件是否存在

// 这里先模拟开启
// $dbgms_module['user'] = 'OPEN';
// if($dbgms_module['user'] == 'OPEN')
	// {

	// }
