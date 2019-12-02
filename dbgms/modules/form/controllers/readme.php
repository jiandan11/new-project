<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 *  功能：
 *  富表单元素所属的风格组
 */
class FORM_Readme extends DbgMs_Admin {
	public $title = 'FORM_操作说明';
	// 当前模块 modules
	public $modules = 'form';
	// 当前控制器 controllers
	public $con = 'readme';

	// @action:默认列表
	public function index()	{
                $this->admin_data['views'] = _DBGMS_MODULES_ . 'form/views/'.$this->con.'.php';
		$this->load_view ();
	}

}