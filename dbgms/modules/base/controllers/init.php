<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Init extends DbgMs_Admin {
	public $title = 'BASE_初始化设置';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'init';
	public $mysql_table = 'dbg_config';
	// @action:默认列表
	public function index()
	{ // if(! file_exists ( DBG_DATA . 'config.website.php' ))
	  // {
	  // $sitearr = dbg_query( "SELECT * FROM dbg_config " ) ;
	  // foreach($sitearr as $key=>$val)
	  // {
	  // $site[$val['sign']][$val['key']] = $val['value'];
	  // }
	  // dbg_filecontent ( DBG_DATA . 'config.website.php', $site, 4 );
	  // }
	  // // 读取文件
	  // $this->admin_data['site'] = include (DBG_DATA . 'config.website.php');
		$sitearr = dbg_query ( "SELECT * FROM dbg_config " );
		foreach($sitearr as $key=>$val)
		{
			$site[$val['sign']][$val['key']] = $val['value'];
		}
		
		// 读取文件
		$this->admin_data['row'] = $site;
		$this->load_view ();
	}
	// @action:更新
	public function update()
	{ // 删除
		unlink ( DBG_DATA . 'config.website.php' );
		$sqlstr = array();
		$posy_site_ = array(
				'base',
				'tool',
				'en',
				'email',
				'trait',
				'upload',
				'domain'
		);
                
                $dir = $_SERVER['DOCUMENT_ROOT'].'/data/public';

                $dh=opendir($dir);
                while ($file=readdir($dh)) {
                  if($file!="." && $file!="..") {
                    $fullpath=$dir."/".$file;
                    if(!strstr($fullpath, 'user_')){
                        continue;
                    }
                    if(!is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        deldir($fullpath);
                    }
                  }
                }
                closedir($dh);
                
		foreach($posy_site_ as $val)
		{
			$post_param = NULL;
			$post_param = dbg_input_getpost ( $val );
			foreach($post_param as $key=>$value)
			{
				$site[$val][$key] = $value;
				$value = addslashes ( $value );
				$sqlstr[] = " (null,'$val','$key','$value')";
			}
		}
//		 var_dump ( $site['base']['domain'] );
		
		// dbg_strrchr ( $site['base']['domain'], "/" );
		// var_dump ( $site['base']['domain'] );
		// exit ();
		$insertsql = join ( ",", $sqlstr );

		$configsql = ' INSERT INTO `dbg_config` (`id`, `sign`, `key`, `value`) VALUES ' . $insertsql;
		dbg_query ( " TRUNCATE TABLE dbg_config ", FALSE );
		$result = dbg_query ( $configsql, FALSE );
		if($result == TRUE)
		{
			self::domain_get ( 1, $site );
			echo 1;
		}
	}

	public static function domain_get($isupdate = NULL, array $website_config = array())
	{
		if($isupdate != NULL)
		{
			unlink ( DBG_DATA . 'config.website.php' );
		}
		if(! empty ( $config ))
		{
			$website_config['domain'] = dbg_domain_set ();
			dbg_filecontent ( DBG_DATA . 'config.website.php', $website_config, 4 );
			unset ( $set );
		}
		if(! file_exists ( DBG_DATA . 'config.website.php' ))
		{ /* 文件不存在的情况下 */
			$website_arr = dbg_query ( "SELECT * FROM dbg_config " );
			foreach($website_arr as $key=>$val)
			{
				$website_config[$val['sign']][$val['key']] = $val['value'];
			}
			$website_config['domain'] = dbg_domain_set ();
			dbg_filecontent ( DBG_DATA . 'config.website.php', $website_config, 4 );
			unset ( $website_arr );
		}
		else
		{
			$website_config = require (DBG_DATA . 'config.website.php');
		}
		return $website_config;
	}
}
