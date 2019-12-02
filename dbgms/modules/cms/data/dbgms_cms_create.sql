DROP TABLE IF EXISTS `db_news`;
CREATE TABLE `db_news` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `columnid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',
  `adminid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '审核id',
  `authorid` char(60) NOT NULL DEFAULT '0' COMMENT '作者id',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `indetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收录时间',
  `title` char(90) NOT NULL COMMENT '标题',
  `description` varchar(250) NOT NULL COMMENT '描述',
  `keywords` char(90) NOT NULL COMMENT '关键字',
  `weizhi` char(50) NOT NULL DEFAULT '0' COMMENT '推荐位置',
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `indexed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否收录',
  `param` mediumtext NOT NULL COMMENT '参数',
  `thumb` varchar(90) NOT NULL COMMENT '小图',
  `slide` varchar(90) NOT NULL COMMENT '幻灯片,大图',
  `content` mediumtext NOT NULL COMMENT '内容',
  `download` varchar(90) NOT NULL DEFAULT '' COMMENT '文件下载',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_admin`;
CREATE TABLE `dbg_admin` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `groupid` mediumint(8) NOT NULL COMMENT '组别id',
  `alias` varchar(50) NOT NULL DEFAULT '' COMMENT '别名',
  `name` varchar(50) NOT NULL COMMENT '用户名',
  `email` varchar(100) NOT NULL COMMENT '邮箱,账号',
  `pwd` varchar(200) NOT NULL COMMENT '密码',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `regip` char(15) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `loginip` char(15) NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `ismust` tinyint(1) DEFAULT '0' COMMENT '是否必须',
  `qq` int(18) NOT NULL DEFAULT '0' COMMENT 'QQ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_admin_group`;
CREATE TABLE `dbg_admin_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` char(90) NOT NULL DEFAULT '' COMMENT '图标,头像',
  `menu` mediumtext COMMENT '权限菜单',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '访问状态',
  `sendpm` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发送私信PM',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_admin_log`;
CREATE TABLE `dbg_admin_log` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `adminid` mediumint(8) unsigned NOT NULL COMMENT '审核id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `content` varchar(250) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_column`;
CREATE TABLE `dbg_column` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `model` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `column` mediumint(8) NOT NULL DEFAULT '0' COMMENT '上一级栏目ID',
  `name` varchar(255) DEFAULT NULL COMMENT '名字',
  `sign` varchar(255) NOT NULL COMMENT '标识',
  `rank` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `content` mediumtext NOT NULL COMMENT '栏目内容',
  `uptime` int(10) DEFAULT '0' COMMENT '更新时间',
  `showtype` tinyint(3) NOT NULL DEFAULT '1' COMMENT '显示类型,前台导航',
  `property` tinyint(3) NOT NULL DEFAULT '1' COMMENT '属性:频道\\列表',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级',
  `icon` varchar(255) NOT NULL DEFAULT '#' COMMENT '图标',
  `template` varchar(255) NOT NULL COMMENT '显示视图,模板',
  `param` mediumtext COMMENT '其他信息配置,高级参数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_config`;
CREATE TABLE `dbg_config` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `sign` varchar(30) NOT NULL DEFAULT '' COMMENT '标识',
  `rank` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型',
  `key` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  `value` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_expand_content_product`;
CREATE TABLE `dbg_expand_content_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `picshow` text,
  `color` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_expand_model`;
CREATE TABLE `dbg_expand_model` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `table` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table` (`table`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_expand_model_field`;
CREATE TABLE `dbg_expand_model_field` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `expandid` mediumint(8) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `sign` varchar(250) DEFAULT NULL,
  `type` int(5) DEFAULT '1',
  `default` varchar(250) DEFAULT NULL,
  `rank` int(10) DEFAULT '0',
  `tip` varchar(250) DEFAULT NULL,
  `verification` varchar(250) DEFAULT '0',
  `verification_msg` varchar(250) DEFAULT NULL,
  `config` text,
  `delivery` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mid` (`expandid`),
  KEY `field` (`sign`),
  KEY `sequence` (`rank`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_feedback`;
CREATE TABLE `dbg_feedback` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` char(60) NOT NULL DEFAULT '0' COMMENT '用户id',
  `url` varchar(500) NOT NULL DEFAULT '' COMMENT '反馈页面',
  `ip` char(60) NOT NULL DEFAULT '0' COMMENT '游客IP',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `info` char(90) NOT NULL DEFAULT '' COMMENT '联系方式',
  `content` mediumtext NOT NULL COMMENT '反馈内容',
  `browser` mediumtext NOT NULL COMMENT '浏览器 信息',
  `solve` tinyint(2) DEFAULT '0' COMMENT '是否解决',
  `param` mediumtext NOT NULL COMMENT '更多字段',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_flink`;
CREATE TABLE `dbg_flink` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` tinyint(2) DEFAULT '0' COMMENT '类型',
  `title` char(60) NOT NULL COMMENT '链接名称',
  `link` varchar(500) NOT NULL DEFAULT '' COMMENT '友情链接',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `info` char(90) NOT NULL DEFAULT '' COMMENT '简述',
  `icon` varchar(90) NOT NULL COMMENT '商标',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_form`;
CREATE TABLE `dbg_form` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `table` varchar(20) DEFAULT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '0',
  `verify` tinyint(1) DEFAULT NULL,
  `release` tinyint(1) DEFAULT NULL,
  `page` int(5) NOT NULL DEFAULT '10',
  `tpl` varchar(250) DEFAULT NULL,
  `order` varchar(20) DEFAULT NULL,
  `where` varchar(250) DEFAULT NULL,
  `return_msg` varchar(250) DEFAULT NULL,
  `return_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table` (`table`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_form_field`;
CREATE TABLE `dbg_form_field` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(10) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `field` varchar(250) DEFAULT NULL,
  `type` int(5) DEFAULT '1',
  `default` varchar(250) DEFAULT NULL,
  `sequence` int(10) DEFAULT '0',
  `tip` varchar(250) DEFAULT NULL,
  `verification` varchar(250) DEFAULT NULL,
  `verification_msg` varchar(250) DEFAULT NULL,
  `config` text,
  `list_display` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`),
  KEY `field` (`field`),
  KEY `sequence` (`sequence`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_fragment`;
CREATE TABLE `dbg_fragment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sign` char(90) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(205) NOT NULL COMMENT '标题',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` mediumtext NOT NULL COMMENT '内容',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_model`;
CREATE TABLE `dbg_model` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank` tinyint(4) DEFAULT '50' COMMENT '排序',
  `name` varchar(100) NOT NULL COMMENT '名字',
  `sign` varchar(255) NOT NULL DEFAULT '0' COMMENT '标识',
  `table` varchar(255) NOT NULL DEFAULT '0' COMMENT '表单',
  `install` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否安装',
  `disable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否禁用',
  `template` varchar(255) DEFAULT '无' COMMENT '模型文件',
  `must` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否必须',
  `param` mediumtext NOT NULL COMMENT '高级参数(缓存,评论)',
  `diyfield` mediumtext NOT NULL COMMENT '字段',
  PRIMARY KEY (`id`,`must`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_pages`;
CREATE TABLE `dbg_pages` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sign` char(90) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(205) NOT NULL COMMENT '标题',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` mediumtext NOT NULL COMMENT '内容',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_recommend`;
CREATE TABLE `dbg_recommend` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `modelid` mediumint(8) DEFAULT '0' COMMENT '关联模型',
  `name` varchar(20) NOT NULL COMMENT '推荐名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_tags`;
CREATE TABLE `dbg_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned DEFAULT '0',
  `title` varchar(20) NOT NULL,
  `click` int(10) DEFAULT '1',
  `quote` int(10) DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `quote` (`quote`),
  KEY `click` (`click`),
  KEY `name` (`title`) USING BTREE,
  KEY `cid` (`cid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbg_user`;
CREATE TABLE `dbg_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `groupid` mediumint(8) NOT NULL COMMENT '组别id',
  `name` varchar(50) NOT NULL COMMENT '用户名',
  `email` varchar(100) NOT NULL COMMENT '邮箱,账号',
  `pwd` varchar(200) NOT NULL COMMENT '密码',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `regip` char(15) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `loginip` char(15) NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `disable` tinyint(1) DEFAULT '0' COMMENT '是否禁用',
  `isActive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否已激活',
  `authcode` varchar(100) DEFAULT '' COMMENT '临时激活码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `dbgms_base_modules`;
CREATE TABLE `dbgms_base_modules` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) NOT NULL COMMENT '模块名称',
  `sign` char(15) NOT NULL DEFAULT '0' COMMENT '标识',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '激活时间',
  `disable` tinyint(1) DEFAULT '0' COMMENT '是否禁用',
  `isactive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已激活',
  `install` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否安装',
  `testdata` tinyint(1) DEFAULT '0' COMMENT '测试数据',
  `authcode` varchar(100) DEFAULT '' COMMENT '临时激活码',
  `moban` char(15) DEFAULT NULL COMMENT '模板',
  `taocan` char(15) DEFAULT NULL COMMENT '套餐价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
