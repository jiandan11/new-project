-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 06 月 15 日 11:39
-- 服务器版本: 5.5.40
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `basedbgms`
--

-- --------------------------------------------------------

--
-- 表的结构 `dbgms_base_modules`
--

CREATE TABLE IF NOT EXISTS `dbgms_base_modules` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `dbgms_base_modules`
--

INSERT INTO `dbgms_base_modules` (`id`, `name`, `sign`, `intime`, `disable`, `isactive`, `install`, `testdata`, `authcode`, `moban`, `taocan`) VALUES
(1, 'BASE基础系统模块', 'base', 0, 0, 1, 1, 0, '', NULL, NULL),
(2, 'CMS内容管理系统 ', 'cms', 0, 0, 1, 1, 0, '', NULL, NULL),
(3, 'ERP资源管理系统', 'erp', 0, 0, 1, 0, 1, '', NULL, NULL),
(4, 'MEMBER会员系统', 'member', 0, 0, 1, 0, 1, '', NULL, NULL),
(5, 'TOOL扩展工具', 'tool', 0, 0, 1, 0, 1, '', NULL, NULL),
(6, 'TLive直播系统', 'live', 0, 0, 1, 0, 1, '', NULL, NULL),
(7, 'SERVICE客服系统', 'service', 0, 0, 1, 0, 1, '', NULL, NULL),
(8, 'WEIXIN微信公众号开发', 'weixin', 0, 0, 1, 0, 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_admin`
--

CREATE TABLE IF NOT EXISTS `dbg_admin` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dbg_admin`
--

INSERT INTO `dbg_admin` (`id`, `groupid`, `alias`, `name`, `email`, `pwd`, `regtime`, `regip`, `logintime`, `loginip`, `disable`, `ismust`, `qq`) VALUES
(1, 1, '超级管理员', 'dbgms', '240337740@qq.com', 'df5f4ac8a82f15198728d19a77a8fac0', 1430046372, '220.200.61.206', 1465955709, '127.0.0.1', 0, 1, 240337740),
(2, 2, '管理员', 'admin', 'admin', '685f43c00fa531a8fad861feadb54397', 1430046372, '220.200.61.206', 1458704369, '192.168.0.5', 0, 1, 0),
(3, 7, '-', 'test', 'test', '05a671c66aefea124cc08b76ea6d30bb', 1452502840, '127.0.0.1', 1452502846, '127.0.0.1', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_admin_group`
--

CREATE TABLE IF NOT EXISTS `dbg_admin_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` char(90) NOT NULL DEFAULT '' COMMENT '图标,头像',
  `menu` mediumtext COMMENT '权限菜单',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '访问状态',
  `sendpm` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发送私信PM',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `dbg_admin_group`
--

INSERT INTO `dbg_admin_group` (`id`, `name`, `icon`, `menu`, `disable`, `sendpm`) VALUES
(2, '管理员', '', 'a:45:{s:9:"content_1";s:1:"1";s:11:"base_record";s:1:"1";s:9:"base_init";s:1:"1";s:9:"base_site";s:1:"1";s:8:"base_set";s:1:"0";s:10:"base_admin";s:1:"1";s:16:"base_admin_group";s:1:"0";s:14:"base_admin_log";s:1:"1";s:11:"cms_content";s:1:"1";s:10:"cms_column";s:1:"1";s:12:"cms_fragment";s:1:"1";s:12:"cms_feedback";s:1:"1";s:9:"cms_flink";s:1:"1";s:9:"cms_album";s:1:"0";s:10:"cms_duowei";s:1:"0";s:9:"cms_model";s:1:"1";s:9:"cms_pages";s:1:"1";s:10:"erp_record";s:1:"0";s:13:"member_record";s:1:"0";s:14:"member_article";s:1:"0";s:10:"member_ask";s:1:"0";s:11:"member_shop";s:1:"0";s:17:"member_user_group";s:1:"0";s:15:"member_user_set";s:1:"0";s:11:"member_user";s:1:"0";s:14:"member_visitor";s:1:"0";s:12:"member_model";s:1:"0";s:13:"member_liuyan";s:1:"0";s:14:"member_dongtai";s:1:"0";s:14:"member_xinqing";s:1:"0";s:14:"member_payment";s:1:"0";s:7:"tool_ad";s:1:"0";s:13:"tool_autodata";s:1:"0";s:10:"tool_cache";s:1:"0";s:13:"tool_compress";s:1:"0";s:13:"tool_database";s:1:"0";s:10:"tool_files";s:1:"0";s:11:"tool_gather";s:1:"0";s:13:"tool_maintain";s:1:"0";s:7:"tool_mq";s:1:"0";s:11:"tool_plugin";s:1:"0";s:14:"tool_seo_baidu";s:1:"0";s:9:"tool_task";s:1:"0";s:13:"tool_template";s:1:"0";s:9:"tool_zhan";s:1:"0";}', 0, 1),
(4, '版主', '', NULL, 1, 1),
(3, '站长', '', NULL, 0, 1),
(7, '网站编辑', '', 'a:45:{s:9:"content_1";s:1:"1";s:11:"base_record";s:1:"1";s:9:"base_init";s:1:"1";s:9:"base_site";s:1:"0";s:8:"base_set";s:1:"0";s:10:"base_admin";s:1:"0";s:16:"base_admin_group";s:1:"0";s:14:"base_admin_log";s:1:"0";s:11:"cms_content";s:1:"1";s:10:"cms_column";s:1:"1";s:12:"cms_fragment";s:1:"1";s:12:"cms_feedback";s:1:"1";s:9:"cms_flink";s:1:"1";s:9:"cms_album";s:1:"0";s:10:"cms_duowei";s:1:"0";s:9:"cms_model";s:1:"0";s:9:"cms_pages";s:1:"0";s:10:"erp_record";s:1:"0";s:13:"member_record";s:1:"0";s:14:"member_article";s:1:"0";s:10:"member_ask";s:1:"0";s:11:"member_shop";s:1:"0";s:17:"member_user_group";s:1:"0";s:15:"member_user_set";s:1:"0";s:11:"member_user";s:1:"0";s:14:"member_visitor";s:1:"0";s:12:"member_model";s:1:"0";s:13:"member_liuyan";s:1:"0";s:14:"member_dongtai";s:1:"0";s:14:"member_xinqing";s:1:"0";s:14:"member_payment";s:1:"0";s:7:"tool_ad";s:1:"0";s:13:"tool_autodata";s:1:"0";s:10:"tool_cache";s:1:"0";s:13:"tool_compress";s:1:"0";s:13:"tool_database";s:1:"0";s:10:"tool_files";s:1:"0";s:11:"tool_gather";s:1:"0";s:13:"tool_maintain";s:1:"0";s:7:"tool_mq";s:1:"0";s:11:"tool_plugin";s:1:"0";s:14:"tool_seo_baidu";s:1:"0";s:9:"tool_task";s:1:"0";s:13:"tool_template";s:1:"0";s:9:"tool_zhan";s:1:"0";}', 0, 0),
(6, '频道管理员', '', NULL, 1, 1),
(5, '内容审核员', '', NULL, 1, 1),
(1, '程序员', '', NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_admin_log`
--

CREATE TABLE IF NOT EXISTS `dbg_admin_log` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `adminid` mediumint(8) unsigned NOT NULL COMMENT '审核id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `ip` char(15) NOT NULL COMMENT 'ip',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `content` varchar(250) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dbg_column`
--

CREATE TABLE IF NOT EXISTS `dbg_column` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `model` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `column` mediumint(8) NOT NULL DEFAULT '0' COMMENT '上一级栏目ID',
  `name` varchar(255) DEFAULT NULL COMMENT '名字',
  `ename` varchar(255) NOT NULL,
  `sign` varchar(255) NOT NULL COMMENT '标识',
  `rank` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `content` mediumtext NOT NULL COMMENT '栏目内容',
  `econtent` mediumtext NOT NULL,
  `uptime` int(10) DEFAULT '0' COMMENT '更新时间',
  `showtype` tinyint(3) NOT NULL DEFAULT '1' COMMENT '显示类型,前台导航',
  `property` tinyint(3) NOT NULL DEFAULT '1' COMMENT '属性:频道\\列表',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级',
  `icon` varchar(255) NOT NULL DEFAULT '#' COMMENT '图标',
  `template` varchar(255) NOT NULL COMMENT '显示视图,模板',
  `param` mediumtext COMMENT '其他信息配置,高级参数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `dbg_column`
--

INSERT INTO `dbg_column` (`id`, `model`, `column`, `name`, `ename`, `sign`, `rank`, `content`, `econtent`, `uptime`, `showtype`, `property`, `disable`, `level`, `icon`, `template`, `param`) VALUES
(3, 1, 0, '产品中心', 'Products', 'product', 50, '', '', 1465872551, 0, 1, 0, 1, '-', 'a:3:{s:7:"channel";s:11:"channel.php";s:4:"list";s:12:"pic_list.php";s:7:"content";s:15:"pic_content.php";}', 'a:16:{s:5:"pages";s:2:"10";s:6:"expand";s:1:"0";s:4:"sort";s:1:"0";s:8:"sorttype";s:1:"0";s:7:"zhtitle";s:0:"";s:13:"zhdescription";s:0:"";s:10:"zhkeywords";s:0:"";s:7:"entitle";s:0:"";s:13:"endescription";s:0:"";s:10:"enkeywords";s:0:"";s:6:"useris";s:1:"1";s:7:"rewrite";s:1:"1";s:3:"url";s:0:"";s:6:"seourl";s:1:"0";s:6:"second";s:0:"";s:8:"template";s:0:"";}'),
(1, 1, 0, '新闻中心', 'News', 'news', 3, '', '', 1465871059, 0, 1, 0, 1, '-', 'a:3:{s:7:"channel";s:19:"article_channel.php";s:4:"list";s:16:"article_list.php";s:7:"content";s:19:"article_content.php";}', 'a:16:{s:5:"pages";s:2:"10";s:6:"expand";s:1:"0";s:4:"sort";s:1:"0";s:8:"sorttype";s:1:"0";s:7:"zhtitle";s:0:"";s:13:"zhdescription";s:0:"";s:10:"zhkeywords";s:0:"";s:7:"entitle";s:0:"";s:13:"endescription";s:0:"";s:10:"enkeywords";s:0:"";s:6:"useris";s:1:"1";s:7:"rewrite";s:1:"1";s:3:"url";s:0:"";s:6:"seourl";s:1:"0";s:6:"second";s:0:"";s:8:"template";s:0:"";}'),
(2, 1, 0, '公司简介', 'About Us', 'about', 2, '<p style="padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white">&nbsp; 朋友：还在担心您的产品无人问津，还在烦恼您的网站门可罗雀么？</p><p style="padding: 0px;list-style-type: none;text-indent: 35px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white">“好搜推广”——让你网络营销精准投放，品牌直达轻松获客。</p><p style="padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white">&nbsp;&nbsp;&nbsp;好搜推广福建营销服务中心——专注于为各中小企业（机构）和医疗健康及相关衍生行业的企业（机构）提供覆盖面广、精准投放、数字监测、较高性价比的的互联网在线广告服务。</p><p style="padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white">&nbsp; 福州快搜网络技术有限公司——好搜搜索在福州、宁德、南平地区的唯一服务商，公司将以创新的营销模式、优质的推广服务、专业的配套技术，帮助各中小企业（机构）和医疗健康及相关衍生行业的企业 （机构）把自己的产品和服务，精确地展现在目标客户面前，为企业（机构）获得可衡量的价值回报，并满足广大企业日益提升的互联网推广需求。</p><p style="padding: 0px;list-style-type: none;text-indent: 32px;color: rgb(102, 102, 102);line-height: 33px;font-size: 14px;font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑;white-space: normal;background-color: white">&nbsp; 让搜索回归本质，让营销更有价值，我们将与您共同成长。</p><p><br/></p>', '<p><span id="tran_0" data-aligning="#tran_0,#src_0" class="copied" style="widows: auto; margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);">Friend: still worrying about your products, also in trouble your website there?</span><br style="white-space: normal; widows: auto; color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_1" data-aligning="#tran_1,#src_1" class="copied" style="widows: auto; margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);">&quot;Good search marketing&quot; - let you accurately targeted network marketing, brand direct easily won.</span><br style="white-space: normal; widows: auto; color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_2" data-aligning="#tran_2,#src_2" class="copied" style="widows: auto; margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);">Good search promotion fujian marketing service center, to focus on for the small and medium-sized enterprises (institutions) and health care and related derivative industry enterprise (organization) to provide coverage, accurate delivery, digital monitoring, high cost-effective Internet online advertising services.</span><br style="white-space: normal; widows: auto; color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_3" data-aligning="#tran_3,#src_3" class="copied" style="widows: auto; margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);">Fuzhou fast search network technology co., LTD. - good search search in fuzhou, ningde, nanping area the only service provider, the company will promote innovative marketing mode, high-quality service and professional technology, to help the small and medium-sized enterprises (institutions) and health care and related derivative industry enterprises (institutions) their own products and services, accurately show in front of the target customer, for the enterprise (institution) can measure the value of the return, and meet the requirements of enterprises to promote the growing of Internet.</span><br style="white-space: normal; widows: auto; color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_4" data-aligning="#tran_4,#src_4" class="copied" style="widows: auto; margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; background-color: rgba(255, 255, 255, 0.8);">Make search to return to nature, make marketing more valuable, we will grow together with you.</span></p>', 1465875086, 0, 2, 0, 1, '-', 'a:3:{s:7:"channel";s:16:"news_channel.php";s:4:"list";s:16:"article_list.php";s:7:"content";s:19:"article_content.php";}', 'a:16:{s:5:"pages";s:2:"10";s:6:"expand";s:1:"0";s:4:"sort";s:1:"0";s:8:"sorttype";s:1:"0";s:7:"zhtitle";s:0:"";s:13:"zhdescription";s:0:"";s:10:"zhkeywords";s:0:"";s:7:"entitle";s:0:"";s:13:"endescription";s:0:"";s:10:"enkeywords";s:0:"";s:6:"useris";s:1:"1";s:7:"rewrite";s:1:"1";s:3:"url";s:0:"";s:6:"seourl";s:1:"0";s:6:"second";s:0:"";s:8:"template";s:0:"";}'),
(4, 1, 0, '联系我们', 'Contact Us', 'contact', 50, '<p style="padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; list-style-type: none;">360搜索福建营销服务中心</span></p><p style="padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; list-style-type: none;">福州快搜网络技术有限公司</span></p><p style="padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; list-style-type: none;">咨询热线：<strong style="margin: 0px; padding: 0px; list-style-type: none; color: rgb(255, 0, 0);">400-8851-360</strong></span></p><p style="padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; list-style-type: none;">传真：0591-63037800</span></p><p style="padding: 0px; list-style-type: none; text-indent: 2em; color: rgb(102, 102, 102); line-height: 33px; font-size: 14px; font-family: Arial, Helvetica, sans-serif, &#39;Microsoft YaHei&#39;, 微软雅黑; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; list-style-type: none;">地址：福州市鼓楼区西洪路528号印江山商务办公区F楼（空军房管局大院内）</span></p><p><br/></p>', '<p><span id="tran_0" data-aligning="#tran_0,#src_0" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">360 search marketing service center in fujian</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_1" data-aligning="#tran_1,#src_1" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Fuzhou fast search network technology co., LTD</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_2" data-aligning="#tran_2,#src_2" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Hotline: 400-8851-360</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_3" data-aligning="#tran_3,#src_3" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Fax: 0591-63037800</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_4" data-aligning="#tran_4,#src_4" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Address: 528 fuzhou gulou west hung road business district office printing jiangshan F floor compound of room canal bureau (air force)</span></p>', 1465875222, 0, 2, 0, 1, '-', 'a:3:{s:7:"channel";s:11:"channel.php";s:4:"list";s:8:"list.php";s:7:"content";s:19:"article_content.php";}', 'a:16:{s:5:"pages";s:0:"";s:6:"expand";s:1:"0";s:4:"sort";s:1:"0";s:8:"sorttype";s:1:"0";s:7:"zhtitle";s:0:"";s:13:"zhdescription";s:0:"";s:10:"zhkeywords";s:0:"";s:7:"entitle";s:0:"";s:13:"endescription";s:0:"";s:10:"enkeywords";s:0:"";s:6:"useris";s:1:"1";s:7:"rewrite";s:1:"1";s:3:"url";s:0:"";s:6:"seourl";s:1:"0";s:6:"second";s:0:"";s:8:"template";s:0:"";}'),
(5, 1, 3, '办公用具', 'Appliance', 'bangongyongju', 50, '', '', 1465898690, 1, 1, 0, 2, '###', 'a:3:{s:7:"channel";s:11:"channel.php";s:4:"list";s:12:"pic_list.php";s:7:"content";s:15:"pic_content.php";}', 'a:16:{s:5:"pages";s:2:"10";s:6:"expand";s:1:"0";s:4:"sort";s:1:"0";s:8:"sorttype";s:1:"0";s:7:"zhtitle";s:0:"";s:13:"zhdescription";s:0:"";s:10:"zhkeywords";s:0:"";s:7:"entitle";s:0:"";s:13:"endescription";s:0:"";s:10:"enkeywords";s:0:"";s:6:"useris";s:1:"1";s:7:"rewrite";s:1:"1";s:3:"url";s:0:"";s:6:"seourl";s:1:"0";s:6:"second";s:0:"";s:8:"template";s:0:"";}'),
(6, 1, 3, '工业设备', 'Equipment', 'gongyeshebei', 50, '', '', 1465957140, 1, 1, 0, 2, '###', 'a:3:{s:7:"channel";s:11:"channel.php";s:4:"list";s:12:"pic_list.php";s:7:"content";s:15:"pic_content.php";}', 'a:16:{s:5:"pages";s:2:"10";s:6:"expand";s:1:"0";s:4:"sort";s:1:"0";s:8:"sorttype";s:1:"0";s:7:"zhtitle";s:0:"";s:13:"zhdescription";s:0:"";s:10:"zhkeywords";s:0:"";s:7:"entitle";s:0:"";s:13:"endescription";s:0:"";s:10:"enkeywords";s:0:"";s:6:"useris";s:1:"1";s:7:"rewrite";s:1:"1";s:3:"url";s:0:"";s:6:"seourl";s:1:"0";s:6:"second";s:0:"";s:8:"template";s:0:"";}');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_config`
--

CREATE TABLE IF NOT EXISTS `dbg_config` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `sign` varchar(30) NOT NULL DEFAULT '' COMMENT '标识',
  `rank` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型',
  `key` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  `value` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `dbg_config`
--

INSERT INTO `dbg_config` (`id`, `sign`, `rank`, `type`, `key`, `name`, `value`) VALUES
(1, 'base', 50, 1, 'title', '', '福州快搜网络'),
(2, 'base', 50, 1, 'keywords', '', '网站建设，网站推广'),
(3, 'base', 50, 1, 'description', '', '网站建设，网站推广'),
(4, 'base', 50, 1, 'domain', '', '/'),
(5, 'base', 50, 1, 'copyright', '', '© Copyright 2015~ !'),
(6, 'base', 50, 1, 'icp', '', '闽ICP备*****号'),
(7, 'base', 50, 1, 'logo', '', '/site/2016/0613/146578666145169.jpg'),
(8, 'base', 50, 1, 'logow', '', ''),
(9, 'base', 50, 1, 'logoh', '', ''),
(10, 'base', 50, 1, 'enablelanguage', '', '1'),
(11, 'base', 50, 1, 'isopenqq', '', '1'),
(12, 'base', 50, 1, 'qq', '', '123456789'),
(13, 'base', 50, 1, 'phone', '', '123456789'),
(14, 'base', 50, 1, 'isopencnzz', '', '0'),
(15, 'base', 50, 1, 'cnzz', '', ''),
(16, 'base', 50, 1, 'isopensite', '', '0'),
(17, 'base', 50, 1, 'closeinfo', '', ''),
(18, 'en', 50, 1, 'title', '', 'Fuzhou quick search network limited company'),
(19, 'en', 50, 1, 'keywords', '', 'website construction, website seo, website promotion'),
(20, 'en', 50, 1, 'description', '', 'description:website construction, website seo, website promotion'),
(21, 'email', 50, 1, 'smtp_host', '', 'zxcxcv'),
(22, 'email', 50, 1, 'smtp_port', '', 'zxc'),
(23, 'email', 50, 1, 'smtp_user', '', 'zxc'),
(24, 'email', 50, 1, 'smtp_pass', '', 'zxc'),
(25, 'email', 50, 1, 'name', '', ''),
(26, 'trait', 50, 1, 'lang', '', '1'),
(27, 'trait', 50, 1, 'dbgmscaptcha', '', '0'),
(28, 'trait', 50, 1, 'debug', '', '0'),
(29, 'trait', 50, 1, 'static', '', '0'),
(30, 'trait', 50, 1, 'fcache', '', '1'),
(31, 'trait', 50, 1, 'hcache', '', '0'),
(32, 'trait', 50, 1, 'dbcache', '', '0'),
(33, 'trait', 50, 1, 'cookie', '', ''),
(34, 'trait', 50, 1, 'session', '', '0'),
(35, 'trait', 50, 1, 'delsessionopen', '', '0'),
(36, 'upload', 50, 1, 'thumb', '', '1'),
(37, 'upload', 50, 1, 'type', '', '1'),
(38, 'upload', 50, 1, 'thumb_width', '', '500'),
(39, 'upload', 50, 1, 'thumb_height', '', '500'),
(40, 'upload', 50, 1, 'watermark', '', '1'),
(41, 'upload', 50, 1, 'watermark_point', '', '0'),
(42, 'upload', 50, 1, 'watermark_img', '', ''),
(43, 'upload', 50, 1, 'format', '', ''),
(44, 'upload', 50, 1, 'size', '', ''),
(45, 'upload', 50, 1, 'path', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_expand_content_product`
--

CREATE TABLE IF NOT EXISTS `dbg_expand_content_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `contentid` mediumint(8) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `picshow` text,
  `color` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `dbg_expand_content_product`
--

INSERT INTO `dbg_expand_content_product` (`id`, `contentid`, `price`, `picshow`, `color`) VALUES
(1, 17, '4899', 'a:4:{i:0;a:4:{s:3:"url";s:31:"/upload/2013-08/15/thumb_zz.jpg";s:8:"original";s:25:"/upload/2013-08/15/zz.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}i:1;a:4:{s:3:"url";s:31:"/upload/2013-08/15/thumb_45.jpg";s:8:"original";s:25:"/upload/2013-08/15/45.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}i:2;a:4:{s:3:"url";s:30:"/upload/2013-08/15/thumb_h.jpg";s:8:"original";s:24:"/upload/2013-08/15/h.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}i:3;a:4:{s:3:"url";s:30:"/upload/2013-08/15/thumb_c.jpg";s:8:"original";s:24:"/upload/2013-08/15/c.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}}', NULL),
(3, 19, '1099', 'a:4:{i:0;a:4:{s:3:"url";s:35:"/upload/2013-08/15/thumb_A830_Q.jpg";s:8:"original";s:29:"/upload/2013-08/15/A830_Q.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}i:1;a:4:{s:3:"url";s:35:"/upload/2013-08/15/thumb_A830_C.jpg";s:8:"original";s:29:"/upload/2013-08/15/A830_C.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}i:2;a:4:{s:3:"url";s:35:"/upload/2013-08/15/thumb_A830_H.jpg";s:8:"original";s:29:"/upload/2013-08/15/A830_H.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}i:3;a:4:{s:3:"url";s:35:"/upload/2013-08/15/thumb_A830_D.jpg";s:8:"original";s:29:"/upload/2013-08/15/A830_D.jpg";s:5:"title";s:0:"";s:5:"order";s:1:"0";}}', 'a:1:{i:0;s:1:"2";}'),
(4, 20, '123', 'N;', 'N;');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_expand_model`
--

CREATE TABLE IF NOT EXISTS `dbg_expand_model` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `table` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table` (`table`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dbg_expand_model`
--

INSERT INTO `dbg_expand_model` (`id`, `table`, `title`) VALUES
(1, 'product', '产品');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_expand_model_field`
--

CREATE TABLE IF NOT EXISTS `dbg_expand_model_field` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dbg_expand_model_field`
--

INSERT INTO `dbg_expand_model_field` (`id`, `expandid`, `title`, `sign`, `type`, `default`, `rank`, `tip`, `verification`, `verification_msg`, `config`, `delivery`) VALUES
(1, 1, '价格', 'price', 1, '', 0, '', 's:1:"*";', NULL, 'asd|asd\r\nasdasd|123\r\nvvvvv|4\r\nrrrr|5532', 1),
(2, 1, '产品展示', 'picshow', 1, '', 0, '', 's:0:"";', NULL, 'asdasd|12\r\nasdasd|234\r\nasdasdsa|35635', 1),
(3, 1, '颜色', 'color', 0, '', 0, '', 's:0:"";', NULL, '白色|1\r\n黑色|2\r\n黄色|3', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_feedback`
--

CREATE TABLE IF NOT EXISTS `dbg_feedback` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dbg_feedback`
--

INSERT INTO `dbg_feedback` (`id`, `userid`, `url`, `ip`, `uptime`, `info`, `content`, `browser`, `solve`, `param`) VALUES
(1, '0', 'http://192.168.0.5/ci31/zh/feedback/', '192.168.0.5', 1459396876, '', 'asd', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36 SE 2.X MetaSr 1.0', 0, 'a:2:{s:4:"name";s:3:"sad";s:5:"email";s:16:"240337740@qq.com";}'),
(3, '0', 'http://192.168.0.5/ci31/zh/feedback/', '192.168.0.5', 1459406034, '', 'adsad', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36 SE 2.X MetaSr 1.0', 0, 'a:2:{s:4:"name";s:6:"asdasd";s:5:"email";s:16:"240337740@qq.com";}');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_flink`
--

CREATE TABLE IF NOT EXISTS `dbg_flink` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` tinyint(2) DEFAULT '0' COMMENT '类型',
  `title` char(60) NOT NULL COMMENT '链接名称',
  `link` varchar(500) NOT NULL DEFAULT '' COMMENT '友情链接',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `info` char(90) NOT NULL DEFAULT '' COMMENT '简述',
  `icon` varchar(90) NOT NULL COMMENT '商标',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dbg_flink`
--

INSERT INTO `dbg_flink` (`id`, `type`, `title`, `link`, `uptime`, `info`, `icon`) VALUES
(2, 0, '福州快搜网络', 'http://www.kuaisou360.com/', 1459397086, '', '###'),
(1, 0, 'DbgMs管理系统', 'http://www.dbgms.cn', 1459397105, '', '###');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_form`
--

CREATE TABLE IF NOT EXISTS `dbg_form` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `dbg_form`
--

INSERT INTO `dbg_form` (`id`, `name`, `table`, `display`, `verify`, `release`, `page`, `tpl`, `order`, `where`, `return_msg`, `return_url`) VALUES
(2, '留言板', 'guestbook', 1, 1, 1, 10, 'guestbook.html', 'id desc', 'status=1', '表单提交成功！', ''),
(3, 'zhuanti_1111_选择', 'zhuanti_jnh', 0, 0, 0, 10, '', 'id desc', '', '表单提交成功', '');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_form_field`
--

CREATE TABLE IF NOT EXISTS `dbg_form_field` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `dbg_form_field`
--

INSERT INTO `dbg_form_field` (`id`, `fid`, `name`, `field`, `type`, `default`, `sequence`, `tip`, `verification`, `verification_msg`, `config`, `list_display`) VALUES
(4, 2, '昵称', 'name', 1, '', 1, '', 's:1:"s";', NULL, '', 1),
(5, 2, '邮箱', 'email', 1, 's', 2, '', 's:0:"";', NULL, '', 1),
(6, 2, '内容', 'content', 3, '', 3, '', 's:0:"";', NULL, 's', 1),
(7, 2, '时间', 'time', 7, '', 4, '', NULL, NULL, '', 1),
(12, 2, '网址', 'http', 1, '', 0, '', NULL, NULL, '', 0),
(13, 2, '管理员回复', 'reply', 2, '', 0, '', NULL, NULL, '', 0),
(14, 2, '审核', 'status', 8, '0', 0, '', 's:0:"";', NULL, '审核|1\r\n未审核|0', 1),
(15, 3, '存储ip', 'ip', 1, '', 0, '', 's:0:"";', NULL, '', 1),
(16, 3, '时间', 'intime', 1, '', 0, '', 's:0:"";', NULL, '', 0),
(17, 3, '套餐', 'info_taocan', 1, '', 0, '套餐', 's:0:"";', NULL, '', 1),
(18, 3, '名字', 'info_name', 1, '', 0, '名字', 's:0:"";', NULL, '', 1),
(19, 3, '公司', 'info_company', 1, '', 0, '公司', 's:0:"";', NULL, '', 1),
(20, 3, '手机号码', 'info_phone', 1, '', 0, '手机号码', 's:0:"";', NULL, '', 1),
(21, 3, '是否中奖', 'isok', 1, '', 0, '是否中奖', 's:0:"";', NULL, '', 1),
(22, 3, '中奖号', 'num', 1, '', 0, '', 's:0:"";', NULL, '', 1),
(23, 3, '城市', 'city', 1, '', 0, '', 's:0:"";', NULL, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_fragment`
--

CREATE TABLE IF NOT EXISTS `dbg_fragment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sign` char(90) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(205) NOT NULL COMMENT '标题',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` mediumtext NOT NULL COMMENT '内容',
  `econtent` mediumtext NOT NULL,
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dbg_fragment`
--

INSERT INTO `dbg_fragment` (`id`, `sign`, `title`, `intime`, `uptime`, `content`, `econtent`, `disable`) VALUES
(1, '普通', 'DbgMs公告', 1458204632, 1465959660, '<p><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 22px; background-color: rgb(255, 255, 255);">&nbsp; </span><span style="font-size: 14px;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; line-height: 22px; background-color: rgb(255, 255, 255);">&nbsp; &nbsp;[ 欢迎使用DbgMs管理系统 ]</span><br style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 22px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; line-height: 22px; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DbgMs 是一款针对中小企业所开发的专业网站管理系统。</span></span></p><p><span style="font-size: 14px;"><span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; line-height: 22px; background-color: rgb(255, 255, 255);">&nbsp; &nbsp; 支持企业<span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(255, 255, 255);">站点，</span>门户<span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(255, 255, 255);">站点</span>，会员<span style="color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(255, 255, 255);">站点</span>，电商站点</span></span></p>', '<p><span id="tran_0" data-aligning="#tran_0,#src_0" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">[Welcome to use DbgMs management system]</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_1" data-aligning="#tran_1,#src_1" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">DbgMs research in small and medium-sized enterprises (smes) is a professional web site management system development.</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_2" data-aligning="#tran_2,#src_2" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Support business sites, portal sites, membership site, electrical contractor site</span></p>', 0),
(2, '普通', '底部碎片', 1461220974, 1465959604, '<p class="cp" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; text-align: center; white-space: normal;">© Copyright 2015~ ! &nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank" style="text-decoration: none; color: rgb(102, 102, 102); margin-right: 10px; margin-left: 10px;">闽ICP备*****号</a></p><p class="cp" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; text-align: center; white-space: normal;">网站推广&nbsp;|&nbsp;网站建设&nbsp;：<strong><a href="http://www.kuaisou360.com/" target="_blank" style="text-decoration: none; color: rgb(102, 102, 102); margin-right: 10px; margin-left: 10px;">福州快搜网络技术有限公司</a></strong>&nbsp;&nbsp;咨询热线：400-8851-360.</p><p><br/></p>', '<p style="text-align: center;"><span id="tran_0" data-aligning="#tran_0,#src_0" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">© Copyright 2015 ~!</span><span id="tran_1" data-aligning="#tran_1,#src_1" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Fujian ICP for * * * * *</span><br style="color: rgb(67, 67, 67); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; white-space: normal; widows: auto; background-color: rgba(255, 255, 255, 0.8);"/><span id="tran_2" data-aligning="#tran_2,#src_2" class="copied" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, &#39;Malgun Gothic&#39;; font-size: 12px; line-height: 24px; text-align: justify; widows: auto; background-color: rgba(255, 255, 255, 0.8);">Website promotion | website construction: fuzhou fast search network technology co., LTD hotline: 400-8851-360.</span></p>', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_model`
--

CREATE TABLE IF NOT EXISTS `dbg_model` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `dbg_model`
--

INSERT INTO `dbg_model` (`id`, `rank`, `name`, `sign`, `table`, `install`, `disable`, `template`, `must`, `param`, `diyfield`) VALUES
(6, 0, '商品', 'shop', 'db_shop', 0, 1, '无', 1, 'a:9:{s:7:"iscache";s:1:"1";s:10:"cache_open";s:1:"1";s:10:"state_open";s:1:"0";s:13:"comment_table";s:15:"db_shop_comment";s:12:"comment_open";s:1:"0";s:13:"comment_guest";s:1:"0";s:13:"comment_state";s:1:"0";s:15:"comment_captcha";s:1:"0";s:7:"isclick";s:1:"0";}', 'a:8:{i:0;a:4:{s:4:"name";s:9:"缩略图";s:5:"field";s:5:"thumb";s:4:"type";s:4:"file";s:7:"defualt";s:0:"";}i:1;a:4:{s:4:"name";s:6:"大图";s:5:"field";s:4:"datu";s:4:"type";s:4:"file";s:7:"defualt";s:0:"";}i:2;a:4:{s:4:"name";s:6:"图集";s:5:"field";s:4:"imgs";s:4:"type";s:9:"swfupload";s:7:"defualt";s:0:"";}i:3;a:7:{s:4:"name";s:12:"产品详情";s:5:"field";s:7:"content";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:7:"content";}i:4;a:6:{s:4:"name";s:6:"单价";s:5:"field";s:5:"price";s:7:"disable";s:1:"0";s:4:"type";s:6:"number";s:7:"default";s:0:"";s:4:"help";s:0:"";}i:5;a:6:{s:4:"name";s:6:"品牌";s:5:"field";s:5:"brand";s:7:"disable";s:1:"0";s:4:"type";s:4:"text";s:7:"default";s:0:"";s:4:"help";s:0:"";}i:6;a:8:{s:4:"name";s:7:"品牌2";s:5:"field";s:7:"pinpai2";s:7:"disable";s:1:"0";s:4:"type";s:8:"relation";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";s:10:"relationid";s:2:"12";}i:7;a:7:{s:4:"name";s:12:"城市选择";s:5:"field";s:4:"city";s:7:"disable";s:1:"0";s:4:"type";s:4:"city";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";}}'),
(1, 50, '文章内容', 'news', 'db_news', 1, 0, '无', 1, 'a:9:{s:7:"iscache";s:1:"1";s:10:"cache_open";s:1:"0";s:10:"state_open";s:1:"0";s:13:"comment_table";i:0;s:12:"comment_open";s:1:"1";s:13:"comment_guest";s:1:"1";s:13:"comment_state";s:1:"0";s:15:"comment_captcha";s:1:"1";s:7:"isclick";s:1:"0";}', 'a:5:{i:0;a:8:{s:4:"name";s:9:"封面图";s:5:"field";s:5:"thumb";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:4:"help";s:0:"";s:10:"relationid";s:1:"1";s:9:"starfield";s:5:"thumb";}i:1;a:4:{s:4:"name";s:6:"大图";s:5:"field";s:5:"slide";s:4:"type";s:4:"file";s:7:"defualt";s:0:"";}i:2;a:7:{s:4:"name";s:6:"内容";s:5:"field";s:7:"content";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:7:"content";}i:3;a:7:{s:4:"name";s:12:"英文内容";s:5:"field";s:8:"econtent";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";}i:4;a:7:{s:4:"name";s:12:"文件下载";s:5:"field";s:8:"download";s:7:"disable";s:1:"0";s:4:"type";s:8:"download";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";}}'),
(3, 0, '视频', 'video', 'db_video', 0, 1, '无', 1, 'a:4:{s:7:"iscache";s:1:"0";s:9:"iscomment";s:1:"0";s:9:"isexamine";s:1:"0";s:7:"isclick";s:1:"0";}', 'a:0:{}'),
(5, 0, '软件', 'apps', 'db_app', 0, 1, '无', 1, '1', ''),
(4, 0, '音乐', 'music', 'db_music', 0, 1, '无', 1, 'a:4:{s:7:"iscache";s:1:"0";s:9:"iscomment";s:1:"0";s:9:"isexamine";s:1:"0";s:7:"isclick";s:1:"0";}', 'a:0:{}'),
(2, 123, '图库', 'tu', 'db_tu', 0, 1, '无', 1, 'a:9:{s:7:"iscache";s:1:"0";s:10:"cache_open";s:1:"0";s:10:"state_open";s:1:"0";s:13:"comment_table";i:0;s:12:"comment_open";s:1:"1";s:13:"comment_guest";s:1:"1";s:13:"comment_state";s:1:"0";s:15:"comment_captcha";s:1:"0";s:7:"isclick";s:1:"0";}', 'a:3:{i:0;a:4:{s:4:"name";s:9:"封面图";s:5:"field";s:5:"thumb";s:4:"type";s:4:"file";s:7:"defualt";s:0:"";}i:1;a:7:{s:4:"name";s:6:"图集";s:5:"field";s:4:"imgs";s:7:"disable";s:1:"0";s:4:"type";s:9:"swfupload";s:7:"default";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:4:"imgs";}i:2;a:7:{s:4:"name";s:12:"关联文章";s:5:"field";s:6:"newsid";s:7:"disable";s:1:"0";s:4:"type";s:8:"relation";s:7:"default";s:0:"";s:4:"help";s:0:"";s:10:"relationid";s:1:"1";}}'),
(7, 0, '用户提问', 'ask', 'db_ask', 0, 1, '无', 0, 'a:5:{s:7:"iscache";s:1:"1";s:10:"cache_open";s:1:"0";s:10:"state_open";s:1:"0";s:13:"comment_table";s:14:"db_ask_comment";s:7:"isclick";s:1:"0";}', 'a:4:{i:0;a:7:{s:4:"name";s:18:"文章状态推荐";s:5:"field";s:9:"zhuangtai";s:7:"disable";s:1:"0";s:4:"type";s:8:"checkbox";s:7:"default";s:0:"";s:5:"param";s:29:"1|精\r\n2|置顶\r\n3|热\r\n4|图";s:4:"help";s:0:"";}i:1;a:8:{s:4:"name";s:9:"封面图";s:5:"field";s:5:"thumb";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:5:"thumb";}i:2;a:8:{s:4:"name";s:6:"大图";s:5:"field";s:5:"slide";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:5:"slide";}i:3;a:6:{s:4:"name";s:6:"内容";s:5:"field";s:7:"content";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:4:"help";s:0:"";}}'),
(8, 0, '用户文章', 'article', 'db_article', 0, 1, '无', 0, 'a:4:{s:7:"iscache";s:1:"0";s:9:"iscomment";s:1:"0";s:9:"isexamine";s:1:"0";s:7:"isclick";s:1:"0";}', 'a:3:{i:0;a:8:{s:4:"name";s:9:"封面图";s:5:"field";s:5:"thumb";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:5:"thumb";}i:1;a:8:{s:4:"name";s:6:"大图";s:5:"field";s:5:"slide";s:7:"disable";s:1:"0";s:4:"type";s:4:"file";s:7:"default";s:0:"";s:5:"param";s:0:"";s:4:"help";s:0:"";s:9:"starfield";s:5:"slide";}i:2;a:6:{s:4:"name";s:6:"内容";s:5:"field";s:7:"content";s:7:"disable";s:1:"0";s:4:"type";s:7:"ueditor";s:7:"default";s:0:"";s:4:"help";s:0:"";}}');

-- --------------------------------------------------------

--
-- 表的结构 `dbg_pages`
--

CREATE TABLE IF NOT EXISTS `dbg_pages` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sign` char(90) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(205) NOT NULL COMMENT '标题',
  `intime` int(10) NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `content` mediumtext NOT NULL COMMENT '内容',
  `disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `dbg_recommend`
--

CREATE TABLE IF NOT EXISTS `dbg_recommend` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `modelid` mediumint(8) DEFAULT '0' COMMENT '关联模型',
  `name` varchar(20) NOT NULL COMMENT '推荐名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dbg_tags`
--

CREATE TABLE IF NOT EXISTS `dbg_tags` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- 转存表中的数据 `dbg_tags`
--

INSERT INTO `dbg_tags` (`id`, `cid`, `title`, `click`, `quote`) VALUES
(1, 0, '杨元庆', 1, 1),
(2, 0, '二季度', 1, 1),
(3, 0, '净利润', 1, 1),
(4, 0, '总经理', 1, 2),
(5, 0, '互联网', 1, 4),
(6, 0, '媒体报道', 1, 1),
(7, 0, '搜索引擎', 1, 1),
(8, 0, '个性化', 1, 2),
(9, 0, '搜索结果', 1, 5),
(10, 0, '台式电脑', 1, 1),
(75, 0, '流程化', 1, 1),
(74, 0, '自动化', 1, 1),
(73, 0, '阿里巴巴', 1, 1),
(72, 0, '成从武', 1, 4),
(16, 0, '吕再峰', 1, 1),
(17, 0, '联想集团', 1, 1),
(18, 0, '中小企业', 1, 1),
(19, 0, '服务业', 1, 1),
(20, 0, '智能家居', 1, 1),
(21, 0, '路由器', 1, 1),
(22, 0, '红外线', 1, 1),
(23, 0, '远程控制', 1, 1),
(24, 0, 'coursera', 1, 1),
(25, 0, '创始人', 1, 1),
(26, 0, '一部分', 1, 1),
(27, 0, '多语种', 1, 1),
(28, 0, '合作伙伴', 1, 2),
(29, 0, '英语翻译', 1, 1),
(81, 0, '近在眼前', 1, 1),
(80, 0, '中国联通', 1, 1),
(79, 0, '诺基亚', 1, 1),
(33, 0, '发布会', 1, 3),
(78, 0, '会议室', 1, 1),
(77, 0, '起跑线', 1, 1),
(36, 0, '设计师', 1, 1),
(37, 0, '美国专利局', 1, 1),
(38, 0, '消费者', 1, 1),
(41, 0, '长期性', 1, 1),
(42, 0, '真实性', 1, 1),
(85, 0, '三星', 1, 1),
(84, 0, '专利局', 1, 1),
(83, 0, '设计图', 1, 1),
(82, 0, 'GALAXY', 1, 1),
(92, 0, '成本', 1, 1),
(91, 0, 'Siri', 1, 1),
(90, 0, '分析师', 1, 1),
(89, 0, 'iPhone', 1, 1),
(53, 0, '网易手机', 1, 1),
(54, 0, '水立方', 1, 1),
(55, 0, '邀请函', 1, 1),
(64, 0, '3G手机', 1, 3),
(63, 0, '联通3G', 1, 6),
(62, 0, '智能手机', 1, 6),
(61, 0, '三星GALAXY', 1, 1),
(65, 0, '手机类型', 1, 3),
(67, 0, '手机客户端', 1, 4),
(88, 0, '音乐手机', 1, 1),
(87, 0, '拍照手机', 1, 1),
(76, 0, '商业化', 1, 1),
(86, 0, '美国', 1, 1),
(93, 0, '苹果', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `dbg_user`
--

CREATE TABLE IF NOT EXISTS `dbg_user` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `db_news`
--

CREATE TABLE IF NOT EXISTS `db_news` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `columnid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '栏目id',
  `adminid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '审核id',
  `authorid` char(60) NOT NULL DEFAULT '0' COMMENT '作者id',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '内容状态',
  `intime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插入时间',
  `uptime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `indetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收录时间',
  `title` char(90) NOT NULL COMMENT '标题',
  `etitle` char(90) NOT NULL,
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
  `econtent` mediumtext NOT NULL COMMENT '英文内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `db_news`
--

INSERT INTO `db_news` (`id`, `columnid`, `adminid`, `authorid`, `state`, `intime`, `uptime`, `indetime`, `title`, `etitle`, `description`, `keywords`, `weizhi`, `hits`, `indexed`, `param`, `thumb`, `slide`, `content`, `download`, `econtent`) VALUES
(1, 1, 1, '0', 20, 1459397348, 1460527180, 0, '幻灯banner1', '', '', '', '', 0, 0, 'null', '/news/2016/0413/146052717540498.jpg', '/news/2016/0413/146052717540498.jpg', '', '', ''),
(2, 1, 1, '0', 20, 1459397348, 1460527188, 0, '幻灯banner1', '', '', '', '', 0, 0, 'null', '/news/2016/0413/146052718428391.jpg', '/news/2016/0413/146052718428391.jpg', '', '', ''),
(3, 1, 1, '0', 20, 1459397348, 1460527196, 0, '幻灯banner3', '', '', '', '', 0, 0, 'null', '/news/2016/0413/146052719224663.jpg', '/news/2016/0413/146052719224663.jpg', '', '', ''),
(4, 1, 1, '0', 0, 1459397348, 1465891316, 0, '文章1', 'article_first', '', '', '', 11, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>文章1</p>', '', '<p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"><br/></span></p><p><br/></p>'),
(5, 1, 1, '0', 0, 1459397348, 1465891300, 0, '文章2', 'article_second', '', '', '', 2, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>文章2</p>', '', '<p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"><br/></span></p><p><br/></p>'),
(6, 1, 1, '0', 0, 1459397348, 1465885798, 0, '文章3', 'article_third', '', '', '', 2, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>文章2</p>', '', '<p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"><br/></span></p><p><br/></p>'),
(7, 1, 1, '0', 0, 1459397348, 1465885792, 0, '文章4', 'article_fourth', '', '', '', 2, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>文章4</p>', '', '<p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"><br/></span></p><p><br/></p>'),
(8, 1, 1, '0', 0, 1459397348, 1465885785, 0, '文章5', 'article_fifth', 'asdsadsad', '', '', 14, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>文章5</p>', '', '<p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><br/></p>'),
(9, 3, 1, '0', 0, 1459397348, 1465897055, 0, '图文1', 'imgarticle_first', '', '', '', 6, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p><img src="/file/content/2016/0614/146589662310677.jpg" title="146589662310677.jpg" alt="2.jpg" width="352" height="256" style="width: 352px; height: 256px;"/></p><p>图文1</p>', '', '<p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><img src="http://www.basedbgms.com/file/content/2016/0614/146589662310677.jpg" title="146589662310677.jpg" alt="2.jpg" width="352" height="256" style="white-space: normal; width: 352px; height: 256px;"/><img src="http://www.basedbgms.com/file/content/2016/0614/146589662310677.jpg" title="146589662310677.jpg" alt="2.jpg" width="352" height="256" style="white-space: normal; width: 352px; height: 256px;"/></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><br/></p>'),
(10, 3, 1, '0', 0, 1459397348, 1465897041, 0, '图文2', 'imgarticle_second', '', '', '', 3, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>图文2</p><p><img src="/file/content/2016/0614/146589702033048.jpg" title="146589702033048.jpg" alt="bffe60e3f7f6f1c62a91541aa8a6f6a8.jpg" width="471" height="321" style="width: 471px; height: 321px;"/></p>', '', '<p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"><img src="http://www.basedbgms.com/file/content/2016/0614/146589702033048.jpg" title="146589702033048.jpg" alt="bffe60e3f7f6f1c62a91541aa8a6f6a8.jpg" width="471" height="321" style="white-space: normal; width: 471px; height: 321px;"/></span></p><p><br/></p>'),
(11, 3, 1, '0', 0, 1459397348, 1465897003, 0, '图文3', 'imgarticle_third', '', '', '', 1, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3图文3</p>', '', '<p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><img src="http://www.basedbgms.com/file/content/2016/0614/146589692584359.jpg" title="146589692584359.jpg" alt="72c7d57fa6b680348ab807089870394d.jpg" width="592" height="273" style="width: 592px; height: 273px;"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><img src="http://www.basedbgms.com/file/content/2016/0614/146589696779264.jpg" title="146589696779264.jpg" alt="996e76e9b2142abe9972b933ec2ebd84.jpg" width="472" height="281" style="width: 472px; height: 281px;"/></p><p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);"><br/></span></p><p><br/></p>'),
(12, 3, 1, '0', 0, 1459397348, 1465896982, 0, '图文4', 'imgarticle_fourth', '', '', '', 2, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>图文4</p><p><img src="http://www.basedbgms.com/file/content/2016/0614/146589692584359.jpg" title="146589692584359.jpg" alt="72c7d57fa6b680348ab807089870394d.jpg" width="592" height="273" style="white-space: normal; width: 592px; height: 273px;"/></p><p><img src="http://www.basedbgms.com/file/content/2016/0614/146589692584359.jpg" title="146589692584359.jpg" alt="72c7d57fa6b680348ab807089870394d.jpg" width="592" height="273" style="white-space: normal; width: 592px; height: 273px;"/></p>', '', '<p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><img src="http://www.basedbgms.com/file/content/2016/0614/146589692584359.jpg" title="146589692584359.jpg" alt="72c7d57fa6b680348ab807089870394d.jpg" width="592" height="273" style="white-space: normal; width: 592px; height: 273px;"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><img src="/file/content/2016/0614/146589696779264.jpg" title="146589696779264.jpg" alt="996e76e9b2142abe9972b933ec2ebd84.jpg" width="472" height="281" style="width: 472px; height: 281px;"/></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><br/></p>'),
(13, 3, 1, '0', 0, 1459397348, 1465896942, 0, '图文5', 'imgarticle_fifth', '', '', '', 5, 0, 'null', '/default/style1.jpg', '/default/style1.jpg', '<p>图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5图文5</p><p><img src="/file/content/2016/0614/146589692584359.jpg" title="146589692584359.jpg" alt="72c7d57fa6b680348ab807089870394d.jpg" width="592" height="273" style="width: 592px; height: 273px;"/></p>', '', '<p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth is not a time of life; it is a state of mind; it is not a matter of rosy cheeks, red lips and supple knees; it is a matter of the will, a quality of the imagination, a vigor of the emotions; it is the freshness of the deep springs of life.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><img src="http://www.basedbgms.com/file/content/2016/0614/146589692584359.jpg" title="146589692584359.jpg" alt="72c7d57fa6b680348ab807089870394d.jpg" width="592" height="273" style="white-space: normal; width: 592px; height: 273px;"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Youth means a temperamental predominance of courage over timidity, of the appetite for adventure over the love of ease. This often exists in a man of 60 more than a boy of 20. Nobody grows old merely by a number of years. We grow old by deserting our ideals.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Years may wrinkle the skin, but to give up enthusiasm wrinkles the soul. Worry, fear, self-distrust bows the heart and turns the spirit back to dust.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">Whether 60 or 16, there is in every human being’s heart the lure of wonders, the unfailing appetite for what’s next and the joy of the game of living. In the center of your heart and my heart, there is a wireless station; so long as it receives messages of beauty, hope, courage and power from man and from the infinite, so long as you are young.&nbsp;</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 13px; line-height: 21.06px; background-color: rgb(255, 255, 255);">When your aerials are down, and your spirit is covered with snows of cynicism and the ice of pessimism, then you’ve grown old, even at 20; but as long as your aerials are up, to catch waves of optimism, there’s hope you may die young at 80.&nbsp;</span></p><p><br/></p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
