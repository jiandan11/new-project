<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-02-18
 *	module tool 模块-工具
 *	controllers database 数据库管理
 *  action:[
 * 			1.新增
 * 			2.删除
 * 			3.修改 ,更新
 * 			4.查看
 * 			5.更新缓存
 *  ]
 */
class XX_A extends DbgMs_Admin {
	// 当前控制器 controllers
	public $modules = 'xxx';
	public $con = 'aa';
	// @action:默认列表
	public function index()
	{
		$this->load_view ();
	}
	// @action:编辑
	public function edit()
	{
		$this->load_view ();
	}
	// @action:删除
	public function delete()
	{
	}
	// @action:更新
	public function update()
	{
	}
}