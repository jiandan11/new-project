/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.40 : Database - dbgms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbgms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `dbgms`;

/*Table structure for table `db_news` */

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `db_news` */

insert  into `db_news`(`id`,`columnid`,`adminid`,`authorid`,`state`,`intime`,`uptime`,`indetime`,`title`,`description`,`keywords`,`weizhi`,`hits`,`indexed`,`param`,`thumb`,`slide`,`content`,`download`) values (1,1,1,'0',20,1459397348,1460527180,0,'幻灯banner1','','','',0,0,'null','/news/2016/0413/146052717540498.jpg','/news/2016/0413/146052717540498.jpg','',''),(2,1,1,'0',20,1459397348,1460527188,0,'幻灯banner1','','','',0,0,'null','/news/2016/0413/146052718428391.jpg','/news/2016/0413/146052718428391.jpg','',''),(3,1,1,'0',20,1459397348,1460527196,0,'幻灯banner3','','','',0,0,'null','/news/2016/0413/146052719224663.jpg','/news/2016/0413/146052719224663.jpg','',''),(4,1,1,'0',0,1459397348,1459397348,0,'文章1','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>文章1</p>',''),(5,1,1,'0',0,1459397348,1459397348,0,'文章2','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>文章2</p>',''),(6,1,1,'0',0,1459397348,1459397348,0,'文章3','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>文章2</p>',''),(7,1,1,'0',0,1459397348,1459397348,0,'文章4','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>文章4</p>',''),(8,1,1,'0',0,1459397348,1460521498,0,'文章5','asdsadsad','','',0,0,'null','/default/style1.jpg','/default/style1.jpg','<p>文章5</p>',''),(9,3,1,'0',0,1459397348,1459397348,0,'图文1','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>图文1</p>',''),(10,3,1,'0',0,1459397348,1459397348,0,'图文2','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>图文2</p>',''),(11,3,1,'0',0,1459397348,1459397348,0,'图文3','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>图文3</p>',''),(12,3,1,'0',0,1459397348,1459397348,0,'图文4','','','',0,0,'N;','/default/style1.jpg','/default/style1.jpg','<p>图文4</p>',''),(13,3,1,'0',0,1459397348,1460699691,0,'图文5','','','',0,0,'null','/default/style1.jpg','/default/style1.jpg','<p>图文5</p>','');

/*Table structure for table `dbg_admin` */

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_admin` */

insert  into `dbg_admin`(`id`,`groupid`,`alias`,`name`,`email`,`pwd`,`regtime`,`regip`,`logintime`,`loginip`,`disable`,`ismust`,`qq`) values (1,1,'超级管理员','dbgms','240337740@qq.com','df5f4ac8a82f15198728d19a77a8fac0',1430046372,'220.200.61.206',1463649499,'192.168.0.5',0,1,240337740),(2,2,'管理员','admin','admin','685f43c00fa531a8fad861feadb54397',1430046372,'220.200.61.206',1458704369,'192.168.0.5',0,1,0),(3,7,'-','test','test','05a671c66aefea124cc08b76ea6d30bb',1452502840,'127.0.0.1',1452502846,'127.0.0.1',0,0,0);

/*Table structure for table `dbg_admin_group` */

DROP TABLE IF EXISTS `dbg_admin_group`;

CREATE TABLE `dbg_admin_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` char(90) NOT NULL DEFAULT '' COMMENT '图标,头像',
  `menu` mediumtext COMMENT '权限菜单',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '访问状态',
  `sendpm` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发送私信PM',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_admin_group` */

insert  into `dbg_admin_group`(`id`,`name`,`icon`,`menu`,`disable`,`sendpm`) values (2,'管理员','','a:45:{s:9:\"content_1\";s:1:\"1\";s:11:\"base_record\";s:1:\"1\";s:9:\"base_init\";s:1:\"1\";s:9:\"base_site\";s:1:\"1\";s:8:\"base_set\";s:1:\"0\";s:10:\"base_admin\";s:1:\"1\";s:16:\"base_admin_group\";s:1:\"0\";s:14:\"base_admin_log\";s:1:\"1\";s:11:\"cms_content\";s:1:\"1\";s:10:\"cms_column\";s:1:\"1\";s:12:\"cms_fragment\";s:1:\"1\";s:12:\"cms_feedback\";s:1:\"1\";s:9:\"cms_flink\";s:1:\"1\";s:9:\"cms_album\";s:1:\"0\";s:10:\"cms_duowei\";s:1:\"0\";s:9:\"cms_model\";s:1:\"1\";s:9:\"cms_pages\";s:1:\"1\";s:10:\"erp_record\";s:1:\"0\";s:13:\"member_record\";s:1:\"0\";s:14:\"member_article\";s:1:\"0\";s:10:\"member_ask\";s:1:\"0\";s:11:\"member_shop\";s:1:\"0\";s:17:\"member_user_group\";s:1:\"0\";s:15:\"member_user_set\";s:1:\"0\";s:11:\"member_user\";s:1:\"0\";s:14:\"member_visitor\";s:1:\"0\";s:12:\"member_model\";s:1:\"0\";s:13:\"member_liuyan\";s:1:\"0\";s:14:\"member_dongtai\";s:1:\"0\";s:14:\"member_xinqing\";s:1:\"0\";s:14:\"member_payment\";s:1:\"0\";s:7:\"tool_ad\";s:1:\"0\";s:13:\"tool_autodata\";s:1:\"0\";s:10:\"tool_cache\";s:1:\"0\";s:13:\"tool_compress\";s:1:\"0\";s:13:\"tool_database\";s:1:\"0\";s:10:\"tool_files\";s:1:\"0\";s:11:\"tool_gather\";s:1:\"0\";s:13:\"tool_maintain\";s:1:\"0\";s:7:\"tool_mq\";s:1:\"0\";s:11:\"tool_plugin\";s:1:\"0\";s:14:\"tool_seo_baidu\";s:1:\"0\";s:9:\"tool_task\";s:1:\"0\";s:13:\"tool_template\";s:1:\"0\";s:9:\"tool_zhan\";s:1:\"0\";}',0,1),(4,'版主','',NULL,1,1),(3,'站长','',NULL,0,1),(7,'网站编辑','','a:45:{s:9:\"content_1\";s:1:\"1\";s:11:\"base_record\";s:1:\"1\";s:9:\"base_init\";s:1:\"1\";s:9:\"base_site\";s:1:\"0\";s:8:\"base_set\";s:1:\"0\";s:10:\"base_admin\";s:1:\"0\";s:16:\"base_admin_group\";s:1:\"0\";s:14:\"base_admin_log\";s:1:\"0\";s:11:\"cms_content\";s:1:\"1\";s:10:\"cms_column\";s:1:\"1\";s:12:\"cms_fragment\";s:1:\"1\";s:12:\"cms_feedback\";s:1:\"1\";s:9:\"cms_flink\";s:1:\"1\";s:9:\"cms_album\";s:1:\"0\";s:10:\"cms_duowei\";s:1:\"0\";s:9:\"cms_model\";s:1:\"0\";s:9:\"cms_pages\";s:1:\"0\";s:10:\"erp_record\";s:1:\"0\";s:13:\"member_record\";s:1:\"0\";s:14:\"member_article\";s:1:\"0\";s:10:\"member_ask\";s:1:\"0\";s:11:\"member_shop\";s:1:\"0\";s:17:\"member_user_group\";s:1:\"0\";s:15:\"member_user_set\";s:1:\"0\";s:11:\"member_user\";s:1:\"0\";s:14:\"member_visitor\";s:1:\"0\";s:12:\"member_model\";s:1:\"0\";s:13:\"member_liuyan\";s:1:\"0\";s:14:\"member_dongtai\";s:1:\"0\";s:14:\"member_xinqing\";s:1:\"0\";s:14:\"member_payment\";s:1:\"0\";s:7:\"tool_ad\";s:1:\"0\";s:13:\"tool_autodata\";s:1:\"0\";s:10:\"tool_cache\";s:1:\"0\";s:13:\"tool_compress\";s:1:\"0\";s:13:\"tool_database\";s:1:\"0\";s:10:\"tool_files\";s:1:\"0\";s:11:\"tool_gather\";s:1:\"0\";s:13:\"tool_maintain\";s:1:\"0\";s:7:\"tool_mq\";s:1:\"0\";s:11:\"tool_plugin\";s:1:\"0\";s:14:\"tool_seo_baidu\";s:1:\"0\";s:9:\"tool_task\";s:1:\"0\";s:13:\"tool_template\";s:1:\"0\";s:9:\"tool_zhan\";s:1:\"0\";}',0,0),(6,'频道管理员','',NULL,1,1),(5,'内容审核员','',NULL,1,1),(1,'程序员','',NULL,0,1);

/*Table structure for table `dbg_admin_log` */

DROP TABLE IF EXISTS `dbg_admin_log`;

CREATE TABLE `dbg_admin_log` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `adminid` mediumint(8) unsigned NOT NULL COMMENT '审核id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `content` varchar(250) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_admin_log` */

insert  into `dbg_admin_log`(`id`,`adminid`,`type`,`ip`,`intime`,`content`) values (1,1,1,'192.168.0.5',1463649499,' 登录啦~');

/*Table structure for table `dbg_column` */

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_column` */

insert  into `dbg_column`(`id`,`model`,`column`,`name`,`sign`,`rank`,`content`,`uptime`,`showtype`,`property`,`disable`,`level`,`icon`,`template`,`param`) values (3,1,0,'产品中心','product',50,'',1461119176,0,1,0,1,'-','a:3:{s:7:\"channel\";s:11:\"channel.php\";s:4:\"list\";s:16:\"article_list.php\";s:7:\"content\";s:19:\"article_content.php\";}','a:16:{s:5:\"pages\";s:2:\"10\";s:6:\"expand\";s:1:\"0\";s:4:\"sort\";s:1:\"0\";s:8:\"sorttype\";s:1:\"0\";s:7:\"zhtitle\";s:0:\"\";s:13:\"zhdescription\";s:0:\"\";s:10:\"zhkeywords\";s:0:\"\";s:7:\"entitle\";s:0:\"\";s:13:\"endescription\";s:0:\"\";s:10:\"enkeywords\";s:0:\"\";s:6:\"useris\";s:1:\"1\";s:7:\"rewrite\";s:1:\"1\";s:3:\"url\";s:0:\"\";s:6:\"seourl\";s:1:\"0\";s:6:\"second\";s:0:\"\";s:8:\"template\";s:0:\"\";}'),(1,1,0,'新闻中心','news',3,'',1461119164,0,1,0,1,'-','a:3:{s:7:\"channel\";s:19:\"article_channel.php\";s:4:\"list\";s:16:\"article_list.php\";s:7:\"content\";s:19:\"article_content.php\";}','a:16:{s:5:\"pages\";s:2:\"10\";s:6:\"expand\";s:1:\"0\";s:4:\"sort\";s:1:\"0\";s:8:\"sorttype\";s:1:\"0\";s:7:\"zhtitle\";s:0:\"\";s:13:\"zhdescription\";s:0:\"\";s:10:\"zhkeywords\";s:0:\"\";s:7:\"entitle\";s:0:\"\";s:13:\"endescription\";s:0:\"\";s:10:\"enkeywords\";s:0:\"\";s:6:\"useris\";s:1:\"1\";s:7:\"rewrite\";s:1:\"1\";s:3:\"url\";s:0:\"\";s:6:\"seourl\";s:1:\"0\";s:6:\"second\";s:0:\"\";s:8:\"template\";s:0:\"\";}'),(2,1,0,'公司简介','about',2,'<p style=\"padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white\">&nbsp; 朋友：还在担心您的产品无人问津，还在烦恼您的网站门可罗雀么？</p><p style=\"padding: 0px;list-style-type: none;text-indent: 35px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white\">“好搜推广”——让你网络营销精准投放，品牌直达轻松获客。</p><p style=\"padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white\">&nbsp;&nbsp;&nbsp;好搜推广福建营销服务中心——专注于为各中小企业（机构）和医疗健康及相关衍生行业的企业（机构）提供覆盖面广、精准投放、数字监测、较高性价比的的互联网在线广告服务。</p><p style=\"padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white\">&nbsp; 福州快搜网络技术有限公司——好搜搜索在福州、宁德、南平地区的唯一服务商，公司将以创新的营销模式、优质的推广服务、专业的配套技术，帮助各中小企业（机构）和医疗健康及相关衍生行业的企业 （机构）把自己的产品和服务，精确地展现在目标客户面前，为企业（机构）获得可衡量的价值回报，并满足广大企业日益提升的互联网推广需求。</p><p style=\"padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white\">&nbsp; 让搜索回归本质，让营销更有价值，我们将与您共同成长。</p><p><br/></p>',1461119156,0,2,0,1,'-','a:3:{s:7:\"channel\";s:16:\"news_channel.php\";s:4:\"list\";s:16:\"article_list.php\";s:7:\"content\";s:19:\"article_content.php\";}','a:16:{s:5:\"pages\";s:2:\"10\";s:6:\"expand\";s:1:\"0\";s:4:\"sort\";s:1:\"0\";s:8:\"sorttype\";s:1:\"0\";s:7:\"zhtitle\";s:0:\"\";s:13:\"zhdescription\";s:0:\"\";s:10:\"zhkeywords\";s:0:\"\";s:7:\"entitle\";s:0:\"\";s:13:\"endescription\";s:0:\"\";s:10:\"enkeywords\";s:0:\"\";s:6:\"useris\";s:1:\"1\";s:7:\"rewrite\";s:1:\"1\";s:3:\"url\";s:0:\"\";s:6:\"seourl\";s:1:\"0\";s:6:\"second\";s:0:\"\";s:8:\"template\";s:0:\"\";}'),(4,1,0,'联系我们','contact',50,'<p style=\"padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; list-style-type: none;\">360搜索福建营销服务中心</span></p><p style=\"padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; list-style-type: none;\">福州快搜网络技术有限公司</span></p><p style=\"padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; list-style-type: none;\">咨询热线：<strong style=\"margin: 0px; padding: 0px; list-style-type: none; color: rgb(255, 0, 0);\">400-8851-360</strong></span></p><p style=\"padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; list-style-type: none;\">传真：0591-63037800</span></p><p style=\"padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; list-style-type: none;\">地址：福州市鼓楼区西洪路528号印江山商务办公区F楼（空军房管局大院内）</span></p><p><br/></p>',1460521479,0,2,0,1,'-','a:3:{s:7:\"channel\";s:11:\"channel.php\";s:4:\"list\";s:8:\"list.php\";s:7:\"content\";s:19:\"article_content.php\";}','a:16:{s:5:\"pages\";s:0:\"\";s:6:\"expand\";s:1:\"0\";s:4:\"sort\";s:1:\"0\";s:8:\"sorttype\";s:1:\"0\";s:7:\"zhtitle\";s:0:\"\";s:13:\"zhdescription\";s:0:\"\";s:10:\"zhkeywords\";s:0:\"\";s:7:\"entitle\";s:0:\"\";s:13:\"endescription\";s:0:\"\";s:10:\"enkeywords\";s:0:\"\";s:6:\"useris\";s:1:\"1\";s:7:\"rewrite\";s:1:\"1\";s:3:\"url\";s:0:\"\";s:6:\"seourl\";s:1:\"0\";s:6:\"second\";s:0:\"\";s:8:\"template\";s:0:\"\";}');

/*Table structure for table `dbg_config` */

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_config` */

insert  into `dbg_config`(`id`,`sign`,`rank`,`type`,`key`,`name`,`value`) values (1,'base',50,1,'title','','福州快搜网络'),(2,'base',50,1,'keywords','','网站建设，网站推广'),(3,'base',50,1,'description','','网站建设，网站推广'),(4,'base',50,1,'domain','','/'),(5,'base',50,1,'copyright','','© Copyright 2015~ !'),(6,'base',50,1,'icp','','闽ICP备*****号'),(7,'base',50,1,'logo','','#'),(8,'base',50,1,'logow','',''),(9,'base',50,1,'logoh','',''),(10,'base',50,1,'isopenqq','','1'),(11,'base',50,1,'qq','','123456789'),(12,'base',50,1,'phone','','123456789'),(13,'base',50,1,'isopencnzz','','0'),(14,'base',50,1,'cnzz','',''),(15,'base',50,1,'isopensite','','0'),(16,'base',50,1,'closeinfo','',''),(17,'en',50,1,'title','',''),(18,'en',50,1,'keywords','',''),(19,'en',50,1,'description','',''),(20,'email',50,1,'smtp_host','','zxcxcv'),(21,'email',50,1,'smtp_port','','zxc'),(22,'email',50,1,'smtp_user','','zxc'),(23,'email',50,1,'smtp_pass','','zxc'),(24,'email',50,1,'name','',''),(25,'trait',50,1,'lang','','1'),(26,'trait',50,1,'dbgmscaptcha','','0'),(27,'trait',50,1,'debug','','0'),(28,'trait',50,1,'static','','0'),(29,'trait',50,1,'fcache','','1'),(30,'trait',50,1,'hcache','','0'),(31,'trait',50,1,'dbcache','','0'),(32,'trait',50,1,'cookie','',''),(33,'trait',50,1,'session','','0'),(34,'upload',50,1,'thumb','','1'),(35,'upload',50,1,'type','','1'),(36,'upload',50,1,'thumb_width','','500'),(37,'upload',50,1,'thumb_height','','500'),(38,'upload',50,1,'watermark','','1'),(39,'upload',50,1,'watermark_point','','0'),(40,'upload',50,1,'watermark_img','',''),(41,'upload',50,1,'format','',''),(42,'upload',50,1,'size','',''),(43,'upload',50,1,'path','','');

/*Table structure for table `dbg_expand_content_product` */

DROP TABLE IF EXISTS `dbg_expand_content_product`;

CREATE TABLE `dbg_expand_content_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `picshow` text,
  `color` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_expand_content_product` */

insert  into `dbg_expand_content_product`(`id`,`contentid`,`price`,`picshow`,`color`) values (1,17,'4899','a:4:{i:0;a:4:{s:3:\"url\";s:31:\"/upload/2013-08/15/thumb_zz.jpg\";s:8:\"original\";s:25:\"/upload/2013-08/15/zz.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:1;a:4:{s:3:\"url\";s:31:\"/upload/2013-08/15/thumb_45.jpg\";s:8:\"original\";s:25:\"/upload/2013-08/15/45.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:2;a:4:{s:3:\"url\";s:30:\"/upload/2013-08/15/thumb_h.jpg\";s:8:\"original\";s:24:\"/upload/2013-08/15/h.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:3;a:4:{s:3:\"url\";s:30:\"/upload/2013-08/15/thumb_c.jpg\";s:8:\"original\";s:24:\"/upload/2013-08/15/c.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}}',NULL),(3,19,'1099','a:4:{i:0;a:4:{s:3:\"url\";s:35:\"/upload/2013-08/15/thumb_A830_Q.jpg\";s:8:\"original\";s:29:\"/upload/2013-08/15/A830_Q.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:1;a:4:{s:3:\"url\";s:35:\"/upload/2013-08/15/thumb_A830_C.jpg\";s:8:\"original\";s:29:\"/upload/2013-08/15/A830_C.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:2;a:4:{s:3:\"url\";s:35:\"/upload/2013-08/15/thumb_A830_H.jpg\";s:8:\"original\";s:29:\"/upload/2013-08/15/A830_H.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}i:3;a:4:{s:3:\"url\";s:35:\"/upload/2013-08/15/thumb_A830_D.jpg\";s:8:\"original\";s:29:\"/upload/2013-08/15/A830_D.jpg\";s:5:\"title\";s:0:\"\";s:5:\"order\";s:1:\"0\";}}','a:1:{i:0;s:1:\"2\";}'),(4,20,'123','N;','N;');

/*Table structure for table `dbg_expand_model` */

DROP TABLE IF EXISTS `dbg_expand_model`;

CREATE TABLE `dbg_expand_model` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `table` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table` (`table`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_expand_model` */

insert  into `dbg_expand_model`(`id`,`table`,`title`) values (1,'product','产品');

/*Table structure for table `dbg_expand_model_field` */

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_expand_model_field` */

insert  into `dbg_expand_model_field`(`id`,`expandid`,`title`,`sign`,`type`,`default`,`rank`,`tip`,`verification`,`verification_msg`,`config`,`delivery`) values (1,1,'价格','price',1,'',0,'','s:1:\"*\";',NULL,'asd|asd\r\nasdasd|123\r\nvvvvv|4\r\nrrrr|5532',1),(2,1,'产品展示','picshow',1,'',0,'','s:0:\"\";',NULL,'asdasd|12\r\nasdasd|234\r\nasdasdsa|35635',1),(3,1,'颜色','color',0,'',0,'','s:0:\"\";',NULL,'白色|1\r\n黑色|2\r\n黄色|3',1);

/*Table structure for table `dbg_feedback` */

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_feedback` */

insert  into `dbg_feedback`(`id`,`userid`,`url`,`ip`,`uptime`,`info`,`content`,`browser`,`solve`,`param`) values (1,'0','http://192.168.0.5/ci31/zh/feedback/','192.168.0.5',1459396876,'','asd','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36 SE 2.X MetaSr 1.0',0,'a:2:{s:4:\"name\";s:3:\"sad\";s:5:\"email\";s:16:\"240337740@qq.com\";}'),(3,'0','http://192.168.0.5/ci31/zh/feedback/','192.168.0.5',1459406034,'','adsad','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36 SE 2.X MetaSr 1.0',0,'a:2:{s:4:\"name\";s:6:\"asdasd\";s:5:\"email\";s:16:\"240337740@qq.com\";}');

/*Table structure for table `dbg_flink` */

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_flink` */

insert  into `dbg_flink`(`id`,`type`,`title`,`link`,`uptime`,`info`,`icon`) values (2,0,'福州快搜网络','http://www.kuaisou360.com/',1459397086,'','###'),(1,0,'DbgMs管理系统','http://www.dbgms.cn',1459397105,'','###');

/*Table structure for table `dbg_form` */

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_form` */

insert  into `dbg_form`(`id`,`name`,`table`,`display`,`verify`,`release`,`page`,`tpl`,`order`,`where`,`return_msg`,`return_url`) values (2,'留言板','guestbook',1,1,1,10,'guestbook.html','id desc','status=1','表单提交成功！',''),(3,'zhuanti_1111_选择','zhuanti_jnh',0,0,0,10,'','id desc','','表单提交成功','');

/*Table structure for table `dbg_form_field` */

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_form_field` */

insert  into `dbg_form_field`(`id`,`fid`,`name`,`field`,`type`,`default`,`sequence`,`tip`,`verification`,`verification_msg`,`config`,`list_display`) values (4,2,'昵称','name',1,'',1,'','s:1:\"s\";',NULL,'',1),(5,2,'邮箱','email',1,'s',2,'','s:0:\"\";',NULL,'',1),(6,2,'内容','content',3,'',3,'','s:0:\"\";',NULL,'s',1),(7,2,'时间','time',7,'',4,'',NULL,NULL,'',1),(12,2,'网址','http',1,'',0,'',NULL,NULL,'',0),(13,2,'管理员回复','reply',2,'',0,'',NULL,NULL,'',0),(14,2,'审核','status',8,'0',0,'','s:0:\"\";',NULL,'审核|1\r\n未审核|0',1),(15,3,'存储ip','ip',1,'',0,'','s:0:\"\";',NULL,'',1),(16,3,'时间','intime',1,'',0,'','s:0:\"\";',NULL,'',0),(17,3,'套餐','info_taocan',1,'',0,'套餐','s:0:\"\";',NULL,'',1),(18,3,'名字','info_name',1,'',0,'名字','s:0:\"\";',NULL,'',1),(19,3,'公司','info_company',1,'',0,'公司','s:0:\"\";',NULL,'',1),(20,3,'手机号码','info_phone',1,'',0,'手机号码','s:0:\"\";',NULL,'',1),(21,3,'是否中奖','isok',1,'',0,'是否中奖','s:0:\"\";',NULL,'',1),(22,3,'中奖号','num',1,'',0,'','s:0:\"\";',NULL,'',1),(23,3,'城市','city',1,'',0,'','s:0:\"\";',NULL,'',1);

/*Table structure for table `dbg_fragment` */

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_fragment` */

insert  into `dbg_fragment`(`id`,`sign`,`title`,`intime`,`uptime`,`content`,`disable`) values (1,'普通','DbgMs公告',1458204632,1460366520,'<p><span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 22px; background-color: rgb(255, 255, 255);\">&nbsp; </span><span style=\"font-size: 14px;\"><span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; line-height: 22px; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp;[ 欢迎使用DbgMs管理系统 ]</span><br style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 22px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; line-height: 22px; background-color: rgb(255, 255, 255);\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DbgMs 是一款针对中小企业所开发的专业网站管理系统。</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; line-height: 22px; background-color: rgb(255, 255, 255);\">&nbsp; &nbsp; 支持企业<span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(255, 255, 255);\">站点，</span>门户<span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(255, 255, 255);\">站点</span>，会员<span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(255, 255, 255);\">站点</span>，电商站点</span></span></p>',0),(2,'普通','底部碎片',1461220974,1461220974,'<p class=\"cp\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; text-align: center; white-space: normal;\">© Copyright 2015~ ! &nbsp;<a href=\"http://www.miitbeian.gov.cn/\" target=\"_blank\" style=\"text-decoration: none; color: rgb(102, 102, 102); margin-right: 10px; margin-left: 10px;\">闽ICP备*****号</a></p><p class=\"cp\" style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; text-align: center; white-space: normal;\">网站推广&nbsp;|&nbsp;网站建设&nbsp;：<strong><a href=\"http://www.kuaisou360.com/\" target=\"_blank\" style=\"text-decoration: none; color: rgb(102, 102, 102); margin-right: 10px; margin-left: 10px;\">福州快搜网络技术有限公司</a></strong>&nbsp;&nbsp;咨询热线：400-8851-360.</p><p><br/></p>',0);

/*Table structure for table `dbg_model` */

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_model` */

insert  into `dbg_model`(`id`,`rank`,`name`,`sign`,`table`,`install`,`disable`,`template`,`must`,`param`,`diyfield`) values (6,0,'商品','shop','db_shop',0,1,'无',1,'a:9:{s:7:\"iscache\";s:1:\"1\";s:10:\"cache_open\";s:1:\"1\";s:10:\"state_open\";s:1:\"0\";s:13:\"comment_table\";s:15:\"db_shop_comment\";s:12:\"comment_open\";s:1:\"0\";s:13:\"comment_guest\";s:1:\"0\";s:13:\"comment_state\";s:1:\"0\";s:15:\"comment_captcha\";s:1:\"0\";s:7:\"isclick\";s:1:\"0\";}','a:8:{i:0;a:4:{s:4:\"name\";s:9:\"缩略图\";s:5:\"field\";s:5:\"thumb\";s:4:\"type\";s:4:\"file\";s:7:\"defualt\";s:0:\"\";}i:1;a:4:{s:4:\"name\";s:6:\"大图\";s:5:\"field\";s:4:\"datu\";s:4:\"type\";s:4:\"file\";s:7:\"defualt\";s:0:\"\";}i:2;a:4:{s:4:\"name\";s:6:\"图集\";s:5:\"field\";s:4:\"imgs\";s:4:\"type\";s:9:\"swfupload\";s:7:\"defualt\";s:0:\"\";}i:3;a:7:{s:4:\"name\";s:12:\"产品详情\";s:5:\"field\";s:7:\"content\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:7:\"ueditor\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:7:\"content\";}i:4;a:6:{s:4:\"name\";s:6:\"单价\";s:5:\"field\";s:5:\"price\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:6:\"number\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";}i:5;a:6:{s:4:\"name\";s:6:\"品牌\";s:5:\"field\";s:5:\"brand\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"text\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";}i:6;a:8:{s:4:\"name\";s:7:\"品牌2\";s:5:\"field\";s:7:\"pinpai2\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:8:\"relation\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";s:10:\"relationid\";s:2:\"12\";}i:7;a:7:{s:4:\"name\";s:12:\"城市选择\";s:5:\"field\";s:4:\"city\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"city\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";}}'),(1,50,'文章内容','news','db_news',1,0,'无',1,'a:9:{s:7:\"iscache\";s:1:\"1\";s:10:\"cache_open\";s:1:\"0\";s:10:\"state_open\";s:1:\"0\";s:13:\"comment_table\";i:0;s:12:\"comment_open\";s:1:\"1\";s:13:\"comment_guest\";s:1:\"1\";s:13:\"comment_state\";s:1:\"0\";s:15:\"comment_captcha\";s:1:\"1\";s:7:\"isclick\";s:1:\"0\";}','a:4:{i:0;a:8:{s:4:\"name\";s:9:\"封面图\";s:5:\"field\";s:5:\"thumb\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"file\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";s:10:\"relationid\";s:1:\"1\";s:9:\"starfield\";s:5:\"thumb\";}i:1;a:4:{s:4:\"name\";s:6:\"大图\";s:5:\"field\";s:5:\"slide\";s:4:\"type\";s:4:\"file\";s:7:\"defualt\";s:0:\"\";}i:2;a:7:{s:4:\"name\";s:6:\"内容\";s:5:\"field\";s:7:\"content\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:7:\"ueditor\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:7:\"content\";}i:3;a:7:{s:4:\"name\";s:12:\"文件下载\";s:5:\"field\";s:8:\"download\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:8:\"download\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";}}'),(3,0,'视频','video','db_video',0,1,'无',1,'a:4:{s:7:\"iscache\";s:1:\"0\";s:9:\"iscomment\";s:1:\"0\";s:9:\"isexamine\";s:1:\"0\";s:7:\"isclick\";s:1:\"0\";}','a:0:{}'),(5,0,'软件','apps','db_app',0,1,'无',1,'1',''),(4,0,'音乐','music','db_music',0,1,'无',1,'a:4:{s:7:\"iscache\";s:1:\"0\";s:9:\"iscomment\";s:1:\"0\";s:9:\"isexamine\";s:1:\"0\";s:7:\"isclick\";s:1:\"0\";}','a:0:{}'),(2,123,'图库','tu','db_tu',0,1,'无',1,'a:9:{s:7:\"iscache\";s:1:\"0\";s:10:\"cache_open\";s:1:\"0\";s:10:\"state_open\";s:1:\"0\";s:13:\"comment_table\";i:0;s:12:\"comment_open\";s:1:\"1\";s:13:\"comment_guest\";s:1:\"1\";s:13:\"comment_state\";s:1:\"0\";s:15:\"comment_captcha\";s:1:\"0\";s:7:\"isclick\";s:1:\"0\";}','a:3:{i:0;a:4:{s:4:\"name\";s:9:\"封面图\";s:5:\"field\";s:5:\"thumb\";s:4:\"type\";s:4:\"file\";s:7:\"defualt\";s:0:\"\";}i:1;a:7:{s:4:\"name\";s:6:\"图集\";s:5:\"field\";s:4:\"imgs\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:9:\"swfupload\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:4:\"imgs\";}i:2;a:7:{s:4:\"name\";s:12:\"关联文章\";s:5:\"field\";s:6:\"newsid\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:8:\"relation\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";s:10:\"relationid\";s:1:\"1\";}}'),(7,0,'用户提问','ask','db_ask',0,1,'无',0,'a:5:{s:7:\"iscache\";s:1:\"1\";s:10:\"cache_open\";s:1:\"0\";s:10:\"state_open\";s:1:\"0\";s:13:\"comment_table\";s:14:\"db_ask_comment\";s:7:\"isclick\";s:1:\"0\";}','a:4:{i:0;a:7:{s:4:\"name\";s:18:\"文章状态推荐\";s:5:\"field\";s:9:\"zhuangtai\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:8:\"checkbox\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:29:\"1|精\r\n2|置顶\r\n3|热\r\n4|图\";s:4:\"help\";s:0:\"\";}i:1;a:8:{s:4:\"name\";s:9:\"封面图\";s:5:\"field\";s:5:\"thumb\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"file\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:5:\"thumb\";}i:2;a:8:{s:4:\"name\";s:6:\"大图\";s:5:\"field\";s:5:\"slide\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"file\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:5:\"slide\";}i:3;a:6:{s:4:\"name\";s:6:\"内容\";s:5:\"field\";s:7:\"content\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:7:\"ueditor\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";}}'),(8,0,'用户文章','article','db_article',0,1,'无',0,'a:4:{s:7:\"iscache\";s:1:\"0\";s:9:\"iscomment\";s:1:\"0\";s:9:\"isexamine\";s:1:\"0\";s:7:\"isclick\";s:1:\"0\";}','a:3:{i:0;a:8:{s:4:\"name\";s:9:\"封面图\";s:5:\"field\";s:5:\"thumb\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"file\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:5:\"thumb\";}i:1;a:8:{s:4:\"name\";s:6:\"大图\";s:5:\"field\";s:5:\"slide\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:4:\"file\";s:7:\"default\";s:0:\"\";s:5:\"param\";s:0:\"\";s:4:\"help\";s:0:\"\";s:9:\"starfield\";s:5:\"slide\";}i:2;a:6:{s:4:\"name\";s:6:\"内容\";s:5:\"field\";s:7:\"content\";s:7:\"disable\";s:1:\"0\";s:4:\"type\";s:7:\"ueditor\";s:7:\"default\";s:0:\"\";s:4:\"help\";s:0:\"\";}}');

/*Table structure for table `dbg_pages` */

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_pages` */

/*Table structure for table `dbg_recommend` */

DROP TABLE IF EXISTS `dbg_recommend`;

CREATE TABLE `dbg_recommend` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `modelid` mediumint(8) DEFAULT '0' COMMENT '关联模型',
  `name` varchar(20) NOT NULL COMMENT '推荐名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_recommend` */

/*Table structure for table `dbg_tags` */

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
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

/*Data for the table `dbg_tags` */

insert  into `dbg_tags`(`id`,`cid`,`title`,`click`,`quote`) values (1,0,'杨元庆',1,1),(2,0,'二季度',1,1),(3,0,'净利润',1,1),(4,0,'总经理',1,2),(5,0,'互联网',1,4),(6,0,'媒体报道',1,1),(7,0,'搜索引擎',1,1),(8,0,'个性化',1,2),(9,0,'搜索结果',1,5),(10,0,'台式电脑',1,1),(75,0,'流程化',1,1),(74,0,'自动化',1,1),(73,0,'阿里巴巴',1,1),(72,0,'成从武',1,4),(16,0,'吕再峰',1,1),(17,0,'联想集团',1,1),(18,0,'中小企业',1,1),(19,0,'服务业',1,1),(20,0,'智能家居',1,1),(21,0,'路由器',1,1),(22,0,'红外线',1,1),(23,0,'远程控制',1,1),(24,0,'coursera',1,1),(25,0,'创始人',1,1),(26,0,'一部分',1,1),(27,0,'多语种',1,1),(28,0,'合作伙伴',1,2),(29,0,'英语翻译',1,1),(81,0,'近在眼前',1,1),(80,0,'中国联通',1,1),(79,0,'诺基亚',1,1),(33,0,'发布会',1,3),(78,0,'会议室',1,1),(77,0,'起跑线',1,1),(36,0,'设计师',1,1),(37,0,'美国专利局',1,1),(38,0,'消费者',1,1),(41,0,'长期性',1,1),(42,0,'真实性',1,1),(85,0,'三星',1,1),(84,0,'专利局',1,1),(83,0,'设计图',1,1),(82,0,'GALAXY',1,1),(92,0,'成本',1,1),(91,0,'Siri',1,1),(90,0,'分析师',1,1),(89,0,'iPhone',1,1),(53,0,'网易手机',1,1),(54,0,'水立方',1,1),(55,0,'邀请函',1,1),(64,0,'3G手机',1,3),(63,0,'联通3G',1,6),(62,0,'智能手机',1,6),(61,0,'三星GALAXY',1,1),(65,0,'手机类型',1,3),(67,0,'手机客户端',1,4),(88,0,'音乐手机',1,1),(87,0,'拍照手机',1,1),(76,0,'商业化',1,1),(86,0,'美国',1,1),(93,0,'苹果',1,1);

/*Table structure for table `dbg_user` */

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user` */

/*Table structure for table `dbg_user_detailed` */

DROP TABLE IF EXISTS `dbg_user_detailed`;

CREATE TABLE `dbg_user_detailed` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` mediumint(8) NOT NULL COMMENT '用户ID',
  `nationality` tinyint(1) NOT NULL COMMENT '国籍',
  `birthprovince` tinyint(3) NOT NULL DEFAULT '0' COMMENT '出生省份',
  `birthcity` smallint(5) NOT NULL DEFAULT '0' COMMENT '出生地',
  `resideprovince` tinyint(3) NOT NULL DEFAULT '0' COMMENT '居住省份',
  `residecity` smallint(5) NOT NULL DEFAULT '0' COMMENT '居住地',
  `education` tinyint(1) NOT NULL DEFAULT '0' COMMENT '教育程度',
  `school` char(90) DEFAULT NULL COMMENT '毕业学校',
  `political_status` tinyint(1) NOT NULL DEFAULT '3' COMMENT '政治面貌',
  `occupation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '职业',
  `blood` tinyint(1) NOT NULL DEFAULT '0' COMMENT '血型',
  `bodytype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '体型',
  `height` char(90) DEFAULT NULL COMMENT '身高',
  `weight` char(90) DEFAULT NULL COMMENT '体重',
  `marital` tinyint(1) NOT NULL DEFAULT '0' COMMENT '婚姻',
  `zipcode` char(90) DEFAULT NULL COMMENT '邮编',
  `address` char(90) DEFAULT NULL COMMENT '邮寄地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_detailed` */

/*Table structure for table `dbg_user_expandlogin` */

DROP TABLE IF EXISTS `dbg_user_expandlogin`;

CREATE TABLE `dbg_user_expandlogin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户id',
  `openid` varchar(250) NOT NULL DEFAULT '0' COMMENT '第三方登录id',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `type` char(20) NOT NULL DEFAULT '0' COMMENT '登录类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_expandlogin` */

/*Table structure for table `dbg_user_fans` */

DROP TABLE IF EXISTS `dbg_user_fans`;

CREATE TABLE `dbg_user_fans` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户id',
  `fansid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '粉丝id',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_fans` */

/*Table structure for table `dbg_user_group` */

DROP TABLE IF EXISTS `dbg_user_group`;

CREATE TABLE `dbg_user_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `credit` int(10) NOT NULL DEFAULT '0' COMMENT '信用-荣誉-积分',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '图标,头像',
  `state_show` tinyint(3) NOT NULL DEFAULT '0' COMMENT '显示状态',
  `state_visit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '访问状态',
  `sendpm` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发送私信PM',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `info` varchar(250) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`),
  KEY `creditsrange` (`credit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_group` */

/*Table structure for table `dbg_user_job` */

DROP TABLE IF EXISTS `dbg_user_job`;

CREATE TABLE `dbg_user_job` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` mediumint(8) unsigned NOT NULL COMMENT '用户ID',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `name` varchar(200) NOT NULL DEFAULT '0' COMMENT '企业名称',
  `companytype` varchar(200) NOT NULL COMMENT '行业类别',
  `jobtype` varchar(200) NOT NULL COMMENT '职位类别',
  `job` varchar(200) NOT NULL DEFAULT '0' COMMENT '职位名称',
  `wage` enum('0-1500元/月','1500-4000元/月','4000-7000元/月','7000-10000元/月','10001-15000元/月','15000-25000元/月','25000元/月以上','保密') NOT NULL DEFAULT '保密' COMMENT '月薪',
  `revenue` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '年收入',
  `info` longtext NOT NULL COMMENT '工作描述',
  `entrytime` int(10) NOT NULL DEFAULT '0' COMMENT '入职时间',
  `quittime` int(10) NOT NULL DEFAULT '0' COMMENT '离职时间',
  `cause` longtext NOT NULL COMMENT '离职原因',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_job` */

/*Table structure for table `dbg_user_log` */

DROP TABLE IF EXISTS `dbg_user_log`;

CREATE TABLE `dbg_user_log` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `content` varchar(250) NOT NULL COMMENT '描述',
  `city` varchar(50) NOT NULL COMMENT '城市',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_log` */

/*Table structure for table `dbg_user_medal` */

DROP TABLE IF EXISTS `dbg_user_medal`;

CREATE TABLE `dbg_user_medal` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `expiration` smallint(6) unsigned NOT NULL DEFAULT '0',
  `permission` mediumtext NOT NULL,
  `credit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `displayorder` (`displayorder`),
  KEY `available` (`available`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_medal` */

/*Table structure for table `dbg_user_message` */

DROP TABLE IF EXISTS `dbg_user_message`;

CREATE TABLE `dbg_user_message` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `senduserid` mediumint(8) unsigned NOT NULL COMMENT '发送用户id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '提醒|私信|系统',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` varchar(250) NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_message` */

/*Table structure for table `dbg_user_personal` */

DROP TABLE IF EXISTS `dbg_user_personal`;

CREATE TABLE `dbg_user_personal` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` mediumint(8) NOT NULL COMMENT '用户id',
  `realname` char(36) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `birthyear` smallint(4) NOT NULL DEFAULT '0' COMMENT '出生年份',
  `birthmonth` tinyint(2) NOT NULL DEFAULT '0' COMMENT '出生月份',
  `birthday` tinyint(2) NOT NULL DEFAULT '0' COMMENT '生日',
  `constellation` char(36) NOT NULL DEFAULT '' COMMENT '星座',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '手机',
  `qq` char(16) NOT NULL DEFAULT '' COMMENT 'QQ',
  `signature` varchar(250) DEFAULT NULL COMMENT '个性签名',
  `weixin` char(50) DEFAULT NULL COMMENT '微信',
  `weibo` varchar(250) DEFAULT NULL COMMENT '微博',
  `avatar` varchar(250) NOT NULL DEFAULT '' COMMENT '头像',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_personal` */

/*Table structure for table `dbg_user_profile_set` */

DROP TABLE IF EXISTS `dbg_user_profile_set`;

CREATE TABLE `dbg_user_profile_set` (
  `fieldid` varchar(255) NOT NULL DEFAULT '',
  `sign` char(30) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `needverify` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `formtype` varchar(255) NOT NULL,
  `choices` text NOT NULL,
  `validate` text NOT NULL,
  PRIMARY KEY (`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_profile_set` */

/*Table structure for table `dbg_user_scores` */

DROP TABLE IF EXISTS `dbg_user_scores`;

CREATE TABLE `dbg_user_scores` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `logouttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登出时间',
  `session_id` varchar(250) NOT NULL COMMENT '登录后系统产生的session_id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_scores` */

/*Table structure for table `dbg_user_security` */

DROP TABLE IF EXISTS `dbg_user_security`;

CREATE TABLE `dbg_user_security` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userid` mediumint(8) NOT NULL COMMENT '用户id',
  `growth` mediumint(8) DEFAULT '0' COMMENT '成长值',
  `scores` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '分数，积分',
  `level` tinyint(3) NOT NULL DEFAULT '1' COMMENT '等级',
  `spacesta` smallint(6) DEFAULT '0' COMMENT '空间站',
  `safequestion` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '安全问题',
  `safeanswer` char(30) NOT NULL DEFAULT '' COMMENT '安全回答',
  `checkmail` tinyint(3) NOT NULL DEFAULT '-1' COMMENT '验证邮箱',
  `checkmobile` tinyint(3) NOT NULL DEFAULT '-1' COMMENT '验证手机',
  `idcardtype` tinyint(30) NOT NULL DEFAULT '0' COMMENT '证件类型',
  `idcard` char(30) NOT NULL DEFAULT '' COMMENT '证件号',
  `online` int(10) DEFAULT '0' COMMENT '在线时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_security` */

/*Table structure for table `dbg_user_shop` */

DROP TABLE IF EXISTS `dbg_user_shop`;

CREATE TABLE `dbg_user_shop` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `modelid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `columnid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',
  `contentid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `amount` int(5) NOT NULL DEFAULT '0' COMMENT '数量',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` varchar(250) NOT NULL COMMENT '内容',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbg_user_shop` */

/*Table structure for table `dbgms_base_modules` */

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `dbgms_base_modules` */

insert  into `dbgms_base_modules`(`id`,`name`,`sign`,`intime`,`disable`,`isactive`,`install`,`testdata`,`authcode`,`moban`,`taocan`) values (1,'BASE基础系统模块','base',0,0,1,1,0,'',NULL,NULL),(2,'CMS内容管理系统 ','cms',0,0,1,1,0,'',NULL,NULL),(3,'ERP资源管理系统','erp',0,0,1,0,1,'',NULL,NULL),(4,'MEMBER会员系统','member',0,0,1,1,1,'',NULL,NULL),(5,'TOOL扩展工具','tool',0,0,1,1,1,'',NULL,NULL),(6,'TLive直播系统','live',0,0,1,0,1,'',NULL,NULL),(7,'SERVICE客服系统','service',0,0,1,0,1,'',NULL,NULL),(8,'WEIXIN微信公众号开发','weixin',0,0,1,0,1,'',NULL,NULL);

/*Table structure for table `dbgms_tool_ad` */

DROP TABLE IF EXISTS `dbgms_tool_ad`;

CREATE TABLE `dbgms_tool_ad` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `areaid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '所属区域',
  `name` char(60) NOT NULL DEFAULT '' COMMENT '广告名称',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '显示状态',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `html` mediumtext NOT NULL,
  `exbody` mediumtext NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `click` int(10) unsigned NOT NULL DEFAULT '0',
  `param` mediumtext NOT NULL COMMENT '参数',
  `img` varchar(250) DEFAULT NULL COMMENT '图片',
  `link` varchar(250) DEFAULT NULL COMMENT '链接',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `dbgms_tool_ad` */

insert  into `dbgms_tool_ad`(`id`,`areaid`,`name`,`uptime`,`state`,`endtime`,`html`,`exbody`,`inputtime`,`click`,`param`,`img`,`link`) values (1,1,'后起网_1225',0,0,1440901105,'<style>\r\n.wallpaper-gg { display: block;width: 100%;  position: relative; top:0px;   }\r\n.wallpaper-link{margin: 0 auto; position: absolute;top: 0;width: 100%;height: 100%;}\r\n.wrap{position:relative;margin-top:70px;}\r\n.bgclosebtn{position: absolute;top: 5px;right:5px;background: url(/ui3/images/close.jpg) no-repeat; width:21px;height:21px;cursor: pointer; z-index: 9;}\r\n@media screen and (-webkit-min-device-pixel-ratio:0){\r\n.wrap{left:-1px;}\r\n.wrap{position: relative;z-index:99;}\r\n}\r\n</style>\r\n<div class=\"wallpaper-gg\" id=\"sfspot_1\">\r\n  <span class=\"bgclosebtn\" onclick=\'$(\".wallpaper-gg\").hide();$(\".wrap\").animate({\"margin-top\":\"0px\"});\'></span>\r\n  <a style=\"background: url(\'http://f1.benimg.com/image/diy/2015/08/1440467125.jpg\') 50% 0px no-repeat;height:1080px;\"\r\n target=\"_blank\" href=\" \"\r\n class=\"wallpaper-link\"></a>\r\n</div>\r\n','a:4:{s:3:\"img\";s:0:\"\";s:4:\"href\";s:0:\"\";s:5:\"width\";s:0:\"\";s:6:\"height\";s:0:\"\";}',1440901105,0,'0',NULL,'http://www.kuaisou360.com/'),(2,1,'DbgMs系统',0,0,1440901105,'<script src=\"http://s1.benimg.com/fuli/js/fuli.js\" type=\"text/javascript\"></script>\r\n<link rel=\"stylesheet\" href=\"http://s1.benimg.com/fuli/css/fuli.css\">\r\n<div class=\"fuli fuli_center\">\r\n<p></p>\r\n<a href=\"http://www.benshouji.com/clickhits.php?n=%E9%A6%96%E9%A1%B5%E5%BC%B9%E7%AA%97&jl=http%3A%2F%2Ftrack.blueview.cc%2Fpc_click%3Fa%3D8a808ab94d7b37fd014d8aa31d4d0163\" target=\"_blank\">\r\n<img src=\"http://f1.benimg.com/image/diy/2015/05/1432604056.jpg\" ></a>\r\n</div>\r\n','',1440901105,0,'a:3:{s:8:\"showtime\";s:1:\"0\";s:5:\"width\";s:1:\"0\";s:6:\"height\";s:1:\"0\";}','/ad/2015/1225/14510307223828.jpg','http://www.dbgms.cn/');

/*Table structure for table `dbgms_tool_ad_area` */

DROP TABLE IF EXISTS `dbgms_tool_ad_area`;

CREATE TABLE `dbgms_tool_ad_area` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '显示状态',
  `name` char(60) NOT NULL DEFAULT '' COMMENT '是必须',
  `ismust` smallint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否必须',
  `signtype` smallint(6) NOT NULL DEFAULT '0' COMMENT '调用形式',
  `showtype` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '显示形式',
  `defaulthtml` mediumtext NOT NULL COMMENT '默认代码',
  `exbody` mediumtext NOT NULL COMMENT '过期显示',
  `info` mediumtext NOT NULL COMMENT '描述',
  `defaultimg` char(100) NOT NULL DEFAULT '###img' COMMENT '默认图片',
  `defaultlink` char(50) NOT NULL DEFAULT '###link' COMMENT '默认链接',
  `disable` smallint(3) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`id`),
  KEY `rank` (`signtype`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `dbgms_tool_ad_area` */

insert  into `dbgms_tool_ad_area`(`id`,`state`,`name`,`ismust`,`signtype`,`showtype`,`defaulthtml`,`exbody`,`info`,`defaultimg`,`defaultlink`,`disable`) values (1,0,'【pc】- 背投 1920*920',1,0,0,'<style>\r\n.wallpaper-gg { display: block;width: 100%;  position: relative; top:0px;   }\r\n.wallpaper-link{margin: 0 auto; position: absolute;top: 0;width: 100%;height: 100%;}\r\n.wrap{position:relative;margin-top:70px;}\r\n.bgclosebtn{position: absolute;top: 5px;right:5px;background: url(\'<?php echo base_url();?>ui/base/tool/close.jpg\') no-repeat; width:21px;height:21px;cursor: pointer; z-index: 9;}\r\n@media screen and (-webkit-min-device-pixel-ratio:0){\r\n.wrap{left:-1px;}\r\n.wrap{position: relative;z-index:99;}\r\n}\r\n</style>\r\n<script>\r\n$(\".header_wrap\").after(\'<div class=\"wallpaper-gg\" id=\"sfspot_1\">\'\r\n    +\'<span class=\"bgclosebtn\" onclick=\"\\\'$(\".wallpaper-gg\").hide();$(\".wrap\").animate({\"margin-top\":\"0px\"});\\\'\"></span>\'\r\n    +\'<a style=\"background: url(\\\'<?php echo DBG_FILEURL;?>defualt/1440467125.jpg\\\') 50% 0px no-repeat;height:1080px;\"\'\r\n    +\' target=\"_blank\" href=\" \" class=\"wallpaper-link\"></a></div>\');\r\n</script>\r\n','a:4:{s:3:\"img\";s:0:\"\";s:4:\"href\";s:0:\"\";s:5:\"width\";s:0:\"\";s:6:\"height\";s:0:\"\";}','【pc】- 背投','###img','###link',0),(11,0,'【pc首页】- 原创专栏上方banner',1,0,0,'<div class=\"banner-ads\" style=\"margin-top:20px;\">\r\n<a href=\"http://www.benshouji.com/clickhits.php?n=%E4%BA%9A%E6%B4%B2%E7%A7%BB%E5%8A%A8%E5%A4%A7%E4%BC%9A0617&jl=http%3A%2F%2Fmobilegameasia.eventdove.com%2F\" target=\"_blank\" rel=\"nofollow\" style=\"width:850px;float:left;\">\r\n<img class=\"lazy\" data-original=\"http://f1.benimg.com/image/diy/2015/06/1434505290.jpg\" alt=\"\" style=\"width:850px;\"></a>\r\n\r\n<a href=\"http://fahao.benshouji.com/\" target=\"_blank\" rel=\"nofollow\" style=\"width:330px;float:right;\">\r\n<img class=\"lazy\" data-original=\"http://f1.benimg.com/image/diy/2015/06/1434505294.jpg\" alt=\"\" style=\"width:330px;\"></a>\r\n\r\n\r\n</div>','','','###img','###link',0),(10,0,'【pc】- 正文上方banner',1,0,0,'','','','###img','###link',0),(3,0,'【pc】- 右下角弹窗 270*200',1,0,0,'<script src=\"http://s1.benimg.com/fuli/js/fuli.js\" type=\"text/javascript\"></script>\r\n<link rel=\"stylesheet\" href=\"http://s1.benimg.com/fuli/css/fuli.css\">\r\n<div class=\"fuli fl_bot_right\" id=\"sfspot_3\"><a href=\" \" title=\"#\" target=\"_blank\"><img src=\"http://f1.benimg.com/image/diy/2015/08/1440729939.jpg\" alt=\"\"></a></div>\r\n','','','###img','###link',0),(18,0,'【m全站】- 底部弹栏js',1,0,0,'<link rel=\"stylesheet\" href=\"ui/tool/gg.css\">\r\n<style>\r\n .fuli_app {height: 60px}\r\n.footer_app {position: fixed;bottom: 0;z-index: 20;height: 60px;background: #222;display: box;display: -webkit-box;display: -moz-box;width: 100%;box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;padding: 10px 13px}\r\n.footer_appimg {display: block;width: 40px;height: 40px;margin: 0 10px 0 0;border-radius: 8px;-webkit-background-size: 40px 40px}\r\n.footer_app.fappcon {box-flex: 1;-webkit-box-flex: 1;-moz-box-flex: 1;display: block;padding-right: 70px;overflow: hidden}\r\n.footer_app .fappconh3 {height: 20px;line-height: 20px;font-size: 16px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color: #FFF}\r\n.footer_app .fappconp {height: 20px;line-height: 20px;color: #757575}\r\n.footer_app .fappcon p span:after {content: \"|\";color: #757575;margin: 0 5px}\r\n.footer_app .fappcon p span:last-child:after {display: none}\r\n.footer_app .btn {width: 60px;height: 30px;line-height: 30px;background: #ce2029;text-align: center;display: block;font-size: 16px;margin-top: 5px;position: absolute;right: 50px;top: 10px}\r\n.footer_app .btn a {color: #FFF}\r\n.footer_app .close {width: 30px;height: 30px;background: url(\"/dbgms/modules/tool/ad/images/m_close.jpg\") no-repeat;background-size: 30px 30px;position: absolute;right: 13px;top: 15px}\r\n</style>\r\n<script>\r\nfunction close_fuli_app(){$(\'.fuli_app\').hide();}\r\ndocument.writeln(\'<div class=\"fuli_app\"><div class=\"footer_app\"><a href=\"###\"><img src=\"/file/default/style1.jpg\" /></a><a href=\"###\"><div class=\"fappcon\" style=\"padding-right: 95px\"><h3><span style=\"color:#fff;\">标题</span></h3><p style=\"font-size: 14px;\"><span>简述！</span></p></div></a><span class=\"btn\"><a href=\"###\">查看</a></span><div class=\"close\" onclick=\"close_fuli_app()\"></div></div></div>\');</script>','a:4:{s:3:\"img\";s:0:\"\";s:4:\"href\";s:0:\"\";s:5:\"width\";s:0:\"\";s:6:\"height\";s:0:\"\";}','asdad','###img','###link',0),(16,0,'【pc文章】- 内容上方',1,0,0,'<div class=\"fuli2\" style=\"width:728px;margin:20px auto -20px;\">\r\n<script type=\"text/javascript\">\r\n    var cpro_id = \"u1949061\";\r\n</script>\r\n<script src=\"http://cpro.baidustatic.com/cpro/ui/c.js\" type=\"text/javascript\"></script>\r\n</div>','','新闻内容页的 内部上方的 推荐广告','###img','###link',0),(7,0,'【pc】- 右侧300*200',1,0,0,' <div class=\"fuli1\" style=\"width: 300px; margin-bottom: 20px;\">\r\n   <p><a href=\"#\" target=\"_blank\" rel=\"nofollow\"><img width=\"302\" src=\"./file/14503176056597.png\"></a></p>\r\n  </div>\r\n','<div class=\"fuli1\" style=\"width:300px;margin-bottom:20px;\">\r\n<script type=\"text/javascript\">\r\n    var cpro_id = \"u1949067\";\r\n</script>\r\n<script src=\"http://cpro.baidustatic.com/cpro/ui/c.js\" type=\"text/javascript\"></script>\r\n<p><a href=\"http://2015.chinajoy.net/index.php/index/news_detail/43\" target=\"_blank\" rel=\"nofollow\"><img width=\"302\" src=\"http://f1.benimg.com/image/diy/2015/04/1428564649.jpg\"></a></p>\r\n</div>','','###img','###link',0),(12,0,'【pc首页】- 资讯上方banner',1,0,0,'<div class=\"banner-ads\" style=\"margin-top:20px;\">\r\n<a href=\"http://www.benshouji.com/clickhits.php?n=%E7%83%AD%E9%97%A8%E4%B8%8A0609&jl=http%3A%2F%2Fwww.7881.com%2Fouterlink%2FouterlinkEnter.action%3Fsource%3Dbenshouji%26channel%3Dcj%26cid%3Dcjbsj01%26wi%3Db35883bd36856b080b043bf05965cdd1%26target%3Dhttp%3A%2F%2Fchinajoy.7881.com\" target=\"_blank\" rel=\"nofollow\">\r\n<img class=\"lazy\" data-original=\"http://f1.benimg.com/image/diy/2015/06/1433497144.jpg\" alt=\"\"></a>\r\n		</div>','','','###img','###link',0),(13,0,'【pc首页】- 攻略上方banner',1,0,0,'<div class=\"banner-ads\" style=\"margin-top:20px;\">\r\n<a href=\"http://www.benshouji.com/clickhits.php?n=%E3%80%90%E9%A6%96%E9%A1%B5banner2%E3%80%91-%E7%83%AD%E9%97%A8%E5%90%88%E9%9B%86%E4%B8%8A%E6%96%B9&jl=http%3A%2F%2Fwww.gf.cgigc.com.cn%2F+\" target=\"_blank\" rel=\"nofollow\">\r\n<img class=\"lazy\" data-original=\"http://f1.benimg.com/image/diy/2015/06/1433122705.jpg\" alt=\"\"></a>\r\n</div>','','','###img','###link',0),(14,0,'【pc首页】- 视频上方banner',1,0,0,'a:3:{s:3:\"txt\";s:0:\"\";s:4:\"href\";s:0:\"\";s:5:\"color\";s:0:\"\";}','a:3:{s:3:\"txt\";s:0:\"\";s:4:\"href\";s:0:\"\";s:5:\"color\";s:0:\"\";}','','###img','###link',0),(2,0,'【pc】- 中间弹窗785 * 520',1,0,0,'<script src=\"http://s1.benimg.com/fuli/js/fuli.js\" type=\"text/javascript\"></script>\r\n<link rel=\"stylesheet\" href=\"http://s1.benimg.com/fuli/css/fuli.css\">\r\n<div class=\"fuli fuli_center\">\r\n<p></p>\r\n<a href=\"http://www.benshouji.com/clickhits.php?n=%E9%A6%96%E9%A1%B5%E5%BC%B9%E7%AA%97&jl=http%3A%2F%2Ftrack.blueview.cc%2Fpc_click%3Fa%3D8a808ab94d7b37fd014d8aa31d4d0163\" target=\"_blank\">\r\n<img src=\"http://f1.benimg.com/image/diy/2015/05/1432604056.jpg\" ></a>\r\n</div>\r\n','','','###img','###link',0),(6,0,'【pc】- 通栏 1200*90',1,0,0,'  <div style=\"height: 100px; margin: 0 auto; margin-top: 20px; width: 1100px;\">\r\n   <a href=\" \" target=\"_blank\">\r\n    <img class=\"lazy\" src=\"<?php echo DBG_FILEURL;?>defualt/1438938306.jpg\" alt=\"广告位置\" style=\"width: 1100px; display: block; height: 100px;\">\r\n   </a>\r\n  </div>','<script src=\"http://s1.benimg.com/fuli/js/fuli.js?201504203\" type=\"text/javascript\"></script><link rel=\"stylesheet\" href=\"http://s1.benimg.com/fuli/css/fuli.css?15420\"><div class=\"fuli fl_bot\" style=\"height:auto;display:none;\"><a href=\"http://www.sojump.com/jq/4876801.aspx\" target=\"_blank\" rel=\"nofollow\"><img src=\"http://f1.benimg.com/image/2015/0430/1430386164640134.jpg\" alt=\"\"></a></div>','','###img','###link',0),(15,0,'【pc首页】- 排行榜上方banner',1,0,0,'<div class=\"banner-ads\" style=\"margin-top:20px;\">\r\n<a href=\"http://www.benshouji.com/clickhits.php?n=%E7%83%AD%E9%97%A8%E4%B8%8A0609&jl=http%3A%2F%2Fwww.7881.com%2Fouterlink%2FouterlinkEnter.action%3Fsource%3Dbenshouji%26channel%3Dcj%26cid%3Dcjbsj01%26wi%3Db35883bd36856b080b043bf05965cdd1%26target%3Dhttp%3A%2F%2Fchinajoy.7881.com\" target=\"_blank\" rel=\"nofollow\">\r\n<img class=\"lazy\" data-original=\"http://f1.benimg.com/image/diy/2015/06/1433497144.jpg\" alt=\"\"></a>\r\n		</div>','a:3:{s:3:\"txt\";s:0:\"\";s:4:\"href\";s:0:\"\";s:5:\"color\";s:0:\"\";}','','###img','###link',0),(4,0,'【pc】- 两边对联 150*380',1,0,0,'<script src=\"http://s1.benimg.com/fuli/js/fuli.js\" type=\"text/javascript\"></script>\r\n<link rel=\"stylesheet\" href=\"http://s1.benimg.com/fuli/css/fuli.css\">\r\n<div class=\"fuli fl_bot_right\" id=\"sfspot_3\"><a href=\" \" title=\"#\" target=\"_blank\"><img src=\"http://f1.benimg.com/image/diy/2015/08/1440729939.jpg\" alt=\"\"></a></div>\r\n','','','###img','###link',0),(5,0,'【pc】- 中间吊窗',1,0,0,'div id=\"fanliAlertBox\">\r\n  <div class=\"fanliimg\">\r\n   <img src=\"./file/fanliimg.png\" alt=\"\" /><i class=\"fanliclose\"></i><a class=\"fanlibtn\" target=\"_blank\" href=\"\" title=\"立即下载\">立即下载</a>\r\n   <div class=\"countdown\"></div>\r\n  </div>\r\n </div>\r\n <script>\r\n		$(function() {\r\n			var fanlibox = $(\'#fanliAlertBox\'), fanliimg = fanlibox.find(\'.fanliimg\'), fanliclose = fanlibox.find(\'.fanliclose\'), countdown = fanlibox.find(\'.countdown\'), countdownFun, showTime = 5, showFanliBox = function() {\r\n			}, hideFanliBox = function() {\r\n				window.clearInterval(countdownFun);\r\n				fanlibox.fadeOut(function() {\r\n					$(this).remove()\r\n				});\r\n			};\r\n			if ($(window).height() <= 800) {\r\n				fanliimg.addClass(\'narrowBox\');\r\n			}\r\n			fanliclose.bind(\'click\', function() {\r\n				hideFanliBox();\r\n			});\r\n			countdownFun = setInterval(function() {\r\n				if (!showTime) {\r\n					hideFanliBox();\r\n				}\r\n				countdown.html(\'马上下载，\' + showTime + \'秒后将自动关闭\');\r\n				showTime--;\r\n			}, 1000);\r\n		});\r\n	</script>','','','###img','###link',0),(17,0,'【pc刷量】模拟点击刷量代码',1,0,0,'<script>\r\nwindow.onload=function(){\r\n	function iframecontrol(url,id){\r\n		var rand = parseInt(Math.random()*100+1);\r\n		var rtime = parseInt(Math.random()*100+10)*200;\r\n\r\n             	var slisIE = (document.all) ? true : false; document.all;  \r\n		if(rand>20 && rand<=50 && !slisIE ){\r\n			var iframe = document.createElement(\"iframe\");\r\n			iframe.src = url;\r\n			iframe.id = id;\r\n			iframe.style.display=\"none\";\r\n			iframe.style.width=\"0\";\r\n			iframe.style.height=\"0\";\r\n			 document.body.appendChild(iframe);\r\n				iframe.onload=function(){\r\n				setTimeout(function(){\r\n					document.body.removeChild(iframe);\r\n\r\n				},rtime);\r\n			}\r\n		}\r\n\r\n	}\r\n	var ahandle = $(\"[id^=sfspot_]\").find(\"a\").eq(0);\r\n	var aurl = ahandle.attr(\"href\");\r\n	iframecontrol(aurl,\"iframeA\");\r\n}\r\n</script>','','【固定不可删】模拟点击刷量代码','###img','###link',1),(38,0,'asdasd',1,0,0,'','','','','###link',0);

/*Table structure for table `dbgms_tool_click_hits` */

DROP TABLE IF EXISTS `dbgms_tool_click_hits`;

CREATE TABLE `dbgms_tool_click_hits` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `adminid` mediumint(8) unsigned NOT NULL COMMENT '审核id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `hits` char(15) NOT NULL COMMENT '点击次数',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `link` varchar(250) NOT NULL COMMENT '点击链接',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `dbgms_tool_click_hits` */

/*Table structure for table `dbgms_tool_plugin` */

DROP TABLE IF EXISTS `dbgms_tool_plugin`;

CREATE TABLE `dbgms_tool_plugin` (
  `pluginid` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '插件ID',
  `available` tinyint(1) NOT NULL DEFAULT '0' COMMENT '可用',
  `adminid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `identifier` varchar(40) NOT NULL DEFAULT '' COMMENT '标识符',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `datatables` varchar(255) NOT NULL DEFAULT '' COMMENT '数据表',
  `directory` varchar(100) NOT NULL DEFAULT '' COMMENT '目录',
  `copyright` varchar(100) NOT NULL DEFAULT '' COMMENT '版权所有',
  `modules` text NOT NULL COMMENT '模块',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '版本',
  PRIMARY KEY (`pluginid`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `dbgms_tool_plugin` */

insert  into `dbgms_tool_plugin`(`pluginid`,`available`,`adminid`,`name`,`identifier`,`description`,`datatables`,`directory`,`copyright`,`modules`,`version`) values (1,0,1,'QQ互联','qqconnect','','','qqconnect/','Comsenz Inc.','a:7:{i:0;a:11:{s:4:\"name\";s:7:\"connect\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:11:{s:4:\"name\";s:7:\"connect\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:10:\"ac=setting\";s:4:\"menu\";s:8:\"QQ互联\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:11:{s:4:\"name\";s:7:\"spacecp\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:8:\"QQ绑定\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"7\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"1\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:4;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:10:\"ac=service\";s:4:\"menu\";s:6:\"其他\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"1\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:4:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.18.2'),(2,0,1,'腾讯分析','cloudstat','','','cloudstat/','Comsenz Inc.','a:6:{i:0;a:11:{s:4:\"name\";s:9:\"cloudstat\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:11:{s:4:\"name\";s:9:\"cloudstat\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:10:\"ac=summary\";s:4:\"menu\";s:12:\"网站概况\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:7:\"ac=base\";s:4:\"menu\";s:12:\"设置图标\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"1\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:3:{s:11:\"installtype\";s:0:\"\";s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.06.1'),(3,0,1,'SOSO表情','soso_smilies','','','soso_smilies/','Comsenz Inc.','a:4:{i:0;a:10:{s:4:\"name\";s:4:\"soso\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:4:\"soso\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:3:{s:11:\"installtype\";s:0:\"\";s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.4'),(4,0,1,'纵横搜索','cloudsearch','','','cloudsearch/','Comsenz Inc.','a:6:{i:0;a:11:{s:4:\"name\";s:6:\"search\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:11:{s:4:\"name\";s:10:\"search_wap\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:10:\"ac=setting\";s:4:\"menu\";s:12:\"基本设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:10:\"ac=iwenwen\";s:4:\"menu\";s:7:\"Iwenwen\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"1\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:4:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.07.1'),(5,0,1,'防水墙','security','','','security/','Comsenz Inc.','a:4:{i:0;a:10:{s:4:\"name\";s:8:\"security\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"1\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:8:\"security\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"2\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:4:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.11.1'),(6,0,1,'旋风存储','xf_storage','','','xf_storage/','Comsenz Inc.','a:3:{i:0;a:10:{s:4:\"name\";s:10:\"xf_storage\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:2:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;}}','1.04'),(7,1,1,'掌上论坛','mobile','','','mobile/','Comsenz Inc.','a:4:{i:0;a:10:{s:4:\"name\";s:6:\"mobile\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:6:\"mobile\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:2:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;}}','1.4.4'),(8,1,1,'电脑管家网址保镖','pcmgr_url_safeguard','','','pcmgr_url_safeguard/','Tencent','a:3:{i:0;a:10:{s:4:\"name\";s:19:\"pcmgr_url_safeguard\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:1:{s:11:\"installtype\";s:0:\"\";}}','1.1'),(9,0,0,'漫游应用','manyou','','','manyou/','Comsenz Inc.','a:4:{i:0;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:9:\"ac=manage\";s:4:\"menu\";s:18:\"漫游应用管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:7:\"ac=base\";s:4:\"menu\";s:12:\"基本设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"1\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:3:{s:11:\"installtype\";s:0:\"\";s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.0'),(10,0,1,'Discuz!联盟','cloudunion','','','cloudunion/','Comsenz Inc.','a:3:{i:0;a:11:{s:4:\"name\";s:7:\"admincp\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:3:{s:11:\"installtype\";s:0:\"\";s:10:\"enablefile\";s:10:\"switch.php\";s:11:\"disablefile\";s:10:\"switch.php\";}}','1.0'),(11,0,1,'云验证码','cloudcaptcha','','','cloudcaptcha/','Comsenz Inc.','a:2:{s:6:\"system\";i:2;s:5:\"extra\";a:3:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;s:10:\"enablefile\";s:10:\"switch.php\";}}','1.0'),(12,0,1,'微信登录','wechat','','','wechat/','Comsenz Inc.','a:15:{i:1;a:11:{s:4:\"name\";s:6:\"wechat\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:11:{s:4:\"name\";s:7:\"spacecp\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"微信绑定\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"7\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:11:{s:4:\"name\";s:6:\"wechat\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"28\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:4;a:11:{s:4:\"name\";s:11:\"wsq_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:15:\"微社区设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:5;a:11:{s:4:\"name\";s:20:\"showactivity_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:6:\"晒图\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:6;a:11:{s:4:\"name\";s:14:\"wechat_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"微信设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:7;a:11:{s:4:\"name\";s:12:\"menu_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"菜单设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:8;a:11:{s:4:\"name\";s:16:\"response_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"消息设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:9;a:11:{s:4:\"name\";s:16:\"resource_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"素材设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:10;a:11:{s:4:\"name\";s:11:\"api_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:6:\"接口\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:11;a:11:{s:4:\"name\";s:16:\"masssend_setting\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"群发设置\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:12;a:11:{s:4:\"name\";s:8:\"wsq_stat\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:15:\"微社区统计\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:0:\"\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:13;a:11:{s:4:\"name\";s:7:\"wsq_app\";s:5:\"param\";s:0:\"\";s:4:\"menu\";s:12:\"应用中心\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";s:1:\"0\";s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:6:\"system\";i:2;s:5:\"extra\";a:2:{s:11:\"installtype\";s:0:\"\";s:10:\"langexists\";i:1;}}','1.1.3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
