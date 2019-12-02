<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Site extends DbgMs_Admin {
	public $title = 'BASE_站点设置';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'site';
	// @action:默认
	public function index()
	{
		$this->admin_data['lists'] = dbg_domain_get ();
		$this->load_view ();
	}
	// @action:站点更新
	public function update()
	{
		$base = dbg_input_getpost ( 'base' );
		foreach($base as $key=>$value)
		{
			$domain['base'][$key] = $value;
		}
		if(trim ( $domain['base']['sign'] ) == '')
		{
			exit ( '标识不能为空!' );
		}
		foreach($_POST['seo'] as $key=>$value)
		{
			$domain['seo'][$key] = $value;
		}
		
		foreach($_POST['db'] as $key=>$value)
		{
			$domain['db'][$key] = $value;
		}
		
		foreach($_POST['trait'] as $key=>$value)
		{
			$domain['trait'][$key] = $value;
		}
		$domain['base']['time'] = time ();
		$filename = DBG_DATA . 'config/domain.' . $domain['base']['sign'] . '.php';
		dbg_file_delete ( $filename );
		dbg_filecontent ( $filename, $domain, 4, FALSE );
		chmod ( $filename, 0755 );
		dbg_domain_website_get ( 1, $site );
		// dbgmsBaseInitGet ( 1, $site );
		echo 1;
	}
	// @action:站点设置
	public function edit()
	{
		$domainid = dbg_input_getpost ( 'domainid' );
		$this->admin_data['row'] = dbg_domain_get ( $domainid );
		$this->load_view ();
	}
	// @action:删除 2016-04-01
	public function delete()
	{
		$domainid = dbg_input_getpost ( 'domainid' );
		$filename = DBG_DATA . 'config/domain.' . $domainid . '.php';
		unlink ( $filename );
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		$result_json['StatusCode'] = 200;
		$result_json['id'] = $id;
		echo json_encode ( $result_json );
		exit ();
	}
}
