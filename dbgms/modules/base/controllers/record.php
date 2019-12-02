<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Record extends DbgMs_Admin {
	public $title = 'BASE_数据统计';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'record';
	// @action: 默认列表
	public function index()
	{
		// 查询栏目数量
		$sql_column = "SELECT COUNT(c.id) AS total FROM dbg_column AS c ";
		$total_column = dbg_query ( $sql_column );
		$this->admin_data['total_column'] = $total_column[0]['total'];
		// 查询内容数量
		$sql_model = "SELECT dbg_model.table FROM dbg_model WHERE dbg_model.install=1 AND dbg_model.disable=0";
		$modelarr = dbg_query ( $sql_model );
		$total_article = 0;
		foreach($modelarr as $val)
		{
			if($val > 8)
			{
				continue;
			}
			$row = '';
			$sql_total = '';
			$sql_total = "SELECT COUNT(c.id) AS total FROM {$val['table']} AS c WHERE c.state>=0 ;";
			$row = dbg_query ( $sql_total );
			$total_article = ($total_article + $row[0]['total']);
		}
		
		$this->admin_data['total_news'] = $total_article;
		
		// $dirnum = 0;
		// $filenum = 0;
		// $this->total ( DBG_FILE, $dirnum, $filenum );
		// echo "目录总数：" . $dirnum . "<br>";
		// echo "文件总数：" . $filenum . "<br>";
		// 遍历指定文件目录与文件数量结束
		
		/**
		 * 获取系统信息
		 */
		$sys_info['os'] = PHP_OS; // 操作系统
		$sys_info['os_name'] = php_uname ();
		$sys_info['zlib'] = function_exists ( 'gzclose' ); // zlib
		$sys_info['safe_mode'] = ( boolean ) ini_get ( 'safe_mode' ); // safe_mode = Off
		$sys_info['safe_mode_gid'] = ( boolean ) ini_get ( 'safe_mode_gid' ); // safe_mode_gid = Off
		$sys_info['safe_mode2'] = (ini_get ( 'safe_mode' ) ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');
		$sys_info['timezone'] = function_exists ( "date_default_timezone_get" ) ? date_default_timezone_get () : L ( 'no_setting' );
		$sys_info['socket'] = function_exists ( 'fsockopen' );
		$sys_info['web_server'] = strpos ( $_SERVER['SERVER_SOFTWARE'], 'PHP' ) === false ? $_SERVER['SERVER_SOFTWARE'] . 'PHP/' . phpversion () : $_SERVER['SERVER_SOFTWARE'];
		$sys_info['phpv'] = phpversion ();
		$sys_info['fileupload'] = @ini_get ( 'file_uploads' ) ? ini_get ( 'upload_max_filesize' ) : 'unknown';
		$sys_info['host'] = (empty ( $_SERVER["SERVER_ADDR"] ) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
		$sys_info['name'] = $_SERVER["SERVER_NAME"];
		$sys_info['max_execution_time'] = ini_get ( 'max_execution_time' );
		$sys_info['allow_reference'] = (ini_get ( 'allow_call_time_pass_reference' ) ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
		$sys_info['allow_url_fopen'] = (ini_get ( 'allow_url_fopen' ) ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
		$this->admin_data['sys_info'] = $sys_info;
		$this->admin_data['notebook'] = require DBG_DATA . 'cache.notebook.php';
		
		// tag标签个数
		
		$this->load_view ();
	}
	// @action:更新备忘录
	public function update()
	{
		$notebook = dbg_input_getpost ( 'notebook' );
		dbg_filecontent ( DBG_DATA . 'cache.notebook.php', $notebook, 4 );
	}
	public function total($dirname, &$dirnum, &$filenum)
	{
		$dir = opendir ( $dirname );
		echo readdir ( $dir ) . "<br>"; // 读取当前目录文件
		echo readdir ( $dir ) . "<br>"; // 读取上级目录文件
		while($filename = readdir ( $dir ))
		{
			// 要判断的是$dirname下的路径是否是目录
			$newfile = $dirname . "/" . $filename;
			// is_dir()函数判断的是当前脚本的路径是不是目录
			if(is_dir ( $newfile ))
			{
				// 通过递归函数再遍历其子目录下的目录或文件
				$this->total ( $newfile, $dirnum, $filenum );
				$dirnum ++;
			}
			else
			{
				$filenum ++;
			}
		}
		closedir ( $dir );
	}
}
