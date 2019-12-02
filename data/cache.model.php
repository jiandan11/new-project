<?php
if(!defined('DBGMS_ROOT')){
	header('HTTP/1.1 404 Not Found');
	exit("权限路径.No direct script access allowed");
}
return array (
  1 => 
  array (
    'id' => '1',
    'rank' => '50',
    'name' => '文章内容',
    'sign' => 'news',
    'table' => 'db_news',
    'install' => '1',
    'disable' => '0',
    'template' => '无',
    'must' => '1',
    'param' => 
    array (
      'iscache' => '1',
      'cache_open' => '0',
      'state_open' => '0',
      'comment_table' => 0,
      'comment_open' => '1',
      'comment_guest' => '1',
      'comment_state' => '0',
      'comment_captcha' => '1',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
      0 => 
      array (
        'name' => '封面图',
        'field' => 'thumb',
        'disable' => '0',
        'type' => 'file',
        'default' => '',
        'help' => '',
        'relationid' => '1',
        'starfield' => 'thumb',
      ),
      1 => 
      array (
        'name' => '大图',
        'field' => 'slide',
        'type' => 'file',
        'defualt' => '',
      ),
      2 => 
      array (
        'name' => '内容',
        'field' => 'content',
        'disable' => '0',
        'type' => 'ueditor',
        'default' => '',
        'help' => '',
        'starfield' => 'content',
      ),
      3 => 
      array (
        'name' => '英文内容',
        'field' => 'econtent',
        'disable' => '0',
        'type' => 'ueditor',
        'default' => '',
        'starfield' => 'content',
        'help' => '',
      ),
      4 => 
      array (
        'name' => '文件下载',
        'field' => 'download',
        'disable' => '0',
        'type' => 'download',
        'default' => '',
        'param' => '',
        'help' => '',
      ),
      5 => 
      array (
        'name' => '选择标签',
        'field' => 'label',
        'disable' => '0',
        'type' => 'radio',
        'default' => '',
        'param' => '1|设计
2|网站维护
3|高级
4|咨询
5|平拍设计
6|营销
7|推荐文章
8|热门服务',
        'help' => '',
        'starfield' => 'label',
      ),
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_news AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  2 => 
  array (
    'id' => '2',
    'rank' => '123',
    'name' => '图库',
    'sign' => 'tu',
    'table' => 'db_tu',
    'install' => '0',
    'disable' => '1',
    'template' => '无',
    'must' => '1',
    'param' => 
    array (
      'iscache' => '0',
      'cache_open' => '0',
      'state_open' => '0',
      'comment_table' => 0,
      'comment_open' => '1',
      'comment_guest' => '1',
      'comment_state' => '0',
      'comment_captcha' => '0',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
      0 => 
      array (
        'name' => '封面图',
        'field' => 'thumb',
        'type' => 'file',
        'defualt' => '',
      ),
      1 => 
      array (
        'name' => '图集',
        'field' => 'imgs',
        'disable' => '0',
        'type' => 'swfupload',
        'default' => '',
        'help' => '',
        'starfield' => 'imgs',
      ),
      2 => 
      array (
        'name' => '关联文章',
        'field' => 'newsid',
        'disable' => '0',
        'type' => 'relation',
        'default' => '',
        'help' => '',
        'relationid' => '1',
      ),
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_tu AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  3 => 
  array (
    'id' => '3',
    'rank' => '0',
    'name' => '视频',
    'sign' => 'video',
    'table' => 'db_video',
    'install' => '0',
    'disable' => '1',
    'template' => '无',
    'must' => '1',
    'param' => 
    array (
      'iscache' => '0',
      'iscomment' => '0',
      'isexamine' => '0',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_video AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  4 => 
  array (
    'id' => '4',
    'rank' => '0',
    'name' => '音乐',
    'sign' => 'music',
    'table' => 'db_music',
    'install' => '0',
    'disable' => '1',
    'template' => '无',
    'must' => '1',
    'param' => 
    array (
      'iscache' => '0',
      'iscomment' => '0',
      'isexamine' => '0',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_music AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  5 => 
  array (
    'id' => '5',
    'rank' => '0',
    'name' => '软件',
    'sign' => 'apps',
    'table' => 'db_app',
    'install' => '0',
    'disable' => '1',
    'template' => '无',
    'must' => '1',
    'param' => false,
    'diyfield' => false,
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_app AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  6 => 
  array (
    'id' => '6',
    'rank' => '0',
    'name' => '商品',
    'sign' => 'shop',
    'table' => 'db_shop',
    'install' => '1',
    'disable' => '0',
    'template' => '无',
    'must' => '1',
    'param' => 
    array (
      'iscache' => '1',
      'cache_open' => '1',
      'state_open' => '0',
      'comment_table' => 'db_shop_comment',
      'comment_open' => '0',
      'comment_guest' => '0',
      'comment_state' => '0',
      'comment_captcha' => '0',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
      0 => 
      array (
        'name' => '缩略图',
        'field' => 'thumb',
        'type' => 'file',
        'defualt' => '',
      ),
      1 => 
      array (
        'name' => '大图',
        'field' => 'datu',
        'type' => 'file',
        'defualt' => '',
      ),
      2 => 
      array (
        'name' => '图集',
        'field' => 'imgs',
        'type' => 'swfupload',
        'defualt' => '',
      ),
      3 => 
      array (
        'name' => '产品详情',
        'field' => 'content',
        'disable' => '0',
        'type' => 'ueditor',
        'default' => '',
        'help' => '',
        'starfield' => 'content',
      ),
      4 => 
      array (
        'name' => '单价',
        'field' => 'price',
        'disable' => '0',
        'type' => 'number',
        'default' => '',
        'help' => '',
      ),
      5 => 
      array (
        'name' => '品牌',
        'field' => 'brand',
        'disable' => '0',
        'type' => 'text',
        'default' => '',
        'help' => '',
      ),
      6 => 
      array (
        'name' => '品牌2',
        'field' => 'pinpai2',
        'disable' => '0',
        'type' => 'relation',
        'default' => '',
        'param' => '',
        'help' => '',
        'relationid' => '12',
      ),
      7 => 
      array (
        'name' => '城市选择',
        'field' => 'city',
        'disable' => '0',
        'type' => 'city',
        'default' => '',
        'param' => '',
        'help' => '',
      ),
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_shop AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  7 => 
  array (
    'id' => '7',
    'rank' => '0',
    'name' => '用户提问',
    'sign' => 'ask',
    'table' => 'db_ask',
    'install' => '1',
    'disable' => '1',
    'template' => '无',
    'must' => '0',
    'param' => 
    array (
      'iscache' => '1',
      'cache_open' => '0',
      'state_open' => '0',
      'comment_table' => 'db_ask_comment',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
      0 => 
      array (
        'name' => '文章状态推荐',
        'field' => 'zhuangtai',
        'disable' => '0',
        'type' => 'checkbox',
        'default' => '',
        'param' => '1|精
2|置顶
3|热
4|图',
        'help' => '',
      ),
      1 => 
      array (
        'name' => '封面图',
        'field' => 'thumb',
        'disable' => '0',
        'type' => 'file',
        'default' => '',
        'param' => '',
        'help' => '',
        'starfield' => 'thumb',
      ),
      2 => 
      array (
        'name' => '大图',
        'field' => 'slide',
        'disable' => '0',
        'type' => 'file',
        'default' => '',
        'param' => '',
        'help' => '',
        'starfield' => 'slide',
      ),
      3 => 
      array (
        'name' => '内容',
        'field' => 'content',
        'disable' => '0',
        'type' => 'ueditor',
        'default' => '',
        'help' => '',
      ),
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_ask AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
  8 => 
  array (
    'id' => '8',
    'rank' => '0',
    'name' => '用户文章',
    'sign' => 'article',
    'table' => 'db_article',
    'install' => '0',
    'disable' => '1',
    'template' => '无',
    'must' => '0',
    'param' => 
    array (
      'iscache' => '0',
      'iscomment' => '0',
      'isexamine' => '0',
      'isclick' => '0',
    ),
    'diyfield' => 
    array (
      0 => 
      array (
        'name' => '封面图',
        'field' => 'thumb',
        'disable' => '0',
        'type' => 'file',
        'default' => '',
        'param' => '',
        'help' => '',
        'starfield' => 'thumb',
      ),
      1 => 
      array (
        'name' => '大图',
        'field' => 'slide',
        'disable' => '0',
        'type' => 'file',
        'default' => '',
        'param' => '',
        'help' => '',
        'starfield' => 'slide',
      ),
      2 => 
      array (
        'name' => '内容',
        'field' => 'content',
        'disable' => '0',
        'type' => 'ueditor',
        'default' => '',
        'help' => '',
      ),
    ),
    'sql' => '
            SELECT c.*,dbg_admin.alias AS adminname,dbg_user.name AS username,
						dbg_column.name AS columnname,dbg_column.sign AS columnsign,dbg_column.column AS columncolumn 					
			FROM db_article AS c
			LEFT JOIN dbg_column ON c.columnid = dbg_column.id
			LEFT JOIN dbg_admin ON c.adminid = dbg_admin.id
		    LEFT JOIN dbg_user ON c.authorid = dbg_user.id 
			WHERE c.id ',
  ),
);
?>