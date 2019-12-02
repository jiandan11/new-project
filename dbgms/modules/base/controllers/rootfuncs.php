<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Rootfuncs extends DbgMs_Admin {
	public $title = 'BASE_管理员功能设置';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'rootfuncs';
	public $mysql_table = 'dbg_rootfuncs';
	// @action:默认列表
	public function index()
	{ 
		$sitearr = dbg_query ( "SELECT * FROM dbg_rootfuncs " );
		foreach($sitearr as $key=>$val)
		{
			$site[$val['key']] = $val['value'];
		}
		// 读取文件
		$this->admin_data['row'] = $site;
		$this->load_view ();
	}
	// @action:更新
	public function update()
	{ 
		$sqlstr = array();
		$posy_site_ = array(
			'config'
		);
                
		foreach($posy_site_ as $val)
		{
			$post_param = NULL;
			$post_param = dbg_input_getpost ( $val );
			foreach($post_param as $key=>$value)
			{
				$site[$val][$key] = $value;
				$value = addslashes ( $value );
				$sqlstr[] = " (null,'$key','$value')";
			}
		}

		$insertsql = join ( ",", $sqlstr );
		$configsql = ' INSERT INTO `dbg_rootfuncs` (`id`,`key`,`value`) VALUES ' . $insertsql;
		dbg_query ( " TRUNCATE TABLE dbg_rootfuncs ", FALSE );
		$result = dbg_query ( $configsql, FALSE );
		if($result == TRUE)
		{
                        self::domain_get ( 1, $site );//写入配置文件
			echo 1;
		}
	}
        
        /*
         * 写入配置文件
         */
	public static function domain_get($isupdate = NULL, array $config_rootfuncs = array())
	{
		if($isupdate != NULL)
		{
			unlink ( DBG_DATA . 'config.rootfuncs.php' );
		}
		if(! empty ( $config_rootfuncs ))
		{
			dbg_filecontent ( DBG_DATA . 'config.rootfuncs.php', $config_rootfuncs, 4 );
		}
		if(! file_exists ( DBG_DATA . 'config.rootfuncs.php' ))
		{ /* 文件不存在的情况下 */
			$rootfuncs_arr = dbg_query ( "SELECT * FROM dbg_rootfuncs " );
			foreach($rootfuncs_arr as $key=>$val)
			{
				$config_rootfuncs[$val['sign']][$val['key']] = $val['value'];
			}
			dbg_filecontent ( DBG_DATA . 'config.rootfuncs.php', $config_rootfuncs, 4 );
			unset ( $rootfuncs_arr );
		}
		else
		{
			$config_rootfuncs = require (DBG_DATA . 'config.rootfuncs.php');
		}
		return $config_rootfuncs;
	}
}
