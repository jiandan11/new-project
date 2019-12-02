<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
/*
 * 站点管理
 */
// @action 获取站点信息
function dbg_domain_get($sign = NULL)
{
	$result = array();
	if(! empty ( $sign ))
	{
		if(! file_exists ( DBG_DATA . 'config/domain.' . $sign . '.php' ))
		{
			$result = NULL;
		}
		else
		{
			$result = require DBG_DATA . 'config/domain.' . $sign . '.php';
		}
	}
	else
	{
		$domain = glob ( DBG_DATA . 'config/domain.*.php' );
		foreach($domain as $value)
		{
			$result[] = require $value;
		}
	}
	return $result;
}
// @action 后台配置文件设置
function dbg_domain_set()
{
	$domain_default = dbg_domain_get ( 'default' );
	$domain = array();

	$agreement = is_https () ? 'https' : 'http' . '://' ;  //协议

	if(! empty ( $domain_default ) && ! empty ( $domain_default['base']['domain'] ))
	{
		if(! empty ( $domain_default['base']['domain'] ))
		{
			$domain['default'] = $agreement . $domain_default['base']['domain'];
			dbg_strrchr ( $domain['default'], "/" );
		}
	}
	else
	{
		
		$url = base_url ();
		$url = str_replace ( '/dbgms', '', $url );
		$domain['default'] = $url;
		dbg_strrchr ( $domain['default'], "/" );
		// 正则，匹配以http://开头的字符串
//		if(! preg_match ( '|^http://|', $domain['default'] ))
//		{ // 如果不能匹配
//			$domain['default'] = 'http://' . $domain['default'];
//		}

        if(! preg_match ( '|^'.$agreement.'|', $domain['default'] ))
        { // 如果不能匹配
            $domain['default'] = $agreement . $domain['default'];
        }
	}
	$domain_arr = array(
			'mobile',
			'file',
			'usesr' 
	);
	foreach($domain_arr as $val)
	{
		$row = NULL;
		$row = dbg_domain_get ( $val );
		if(! empty ( $row ))
		{
			
			if(! empty ( $row['base']['domain'] ))
			{
				$domain[$val] = $agreement . $row['base']['domain'];
                $domain[$val] = $row['base']['domain'];
				dbg_strrchr ( $domain[$val], "/" );
			}
			else
			{
				$domain[$val] = '';
			}
		}
		else
		{
            $domain[$val] = $domain['default'] . $val . '/';
            if($val == 'file'){
                $domain['file'] = '/'.$val.'/';
            }

		}
	}
	return $domain;
}
// @action 后台配置文件获取
function dbg_domain_website_get($isupdate = NULL, array $website_config = array())
{
	if($isupdate != NULL)
	{
		unlink ( DBG_DATA . 'config.website.php' );
	}
	if(! empty ( $website_config ))
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

