<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Set extends DbgMs_Admin {
	public $title = 'BASE_全局配置管理';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'set';
	public $mysql_table = 'dbg_user';
	// @action:默认列表
	public function index()
	{
		$sign = isset ( $_GET['sign'] ) ? $_GET['sign'] : 'base';
		$this->admin_data['sign'] = $sign; // 当前模型
		$sql_config = "SELECT dsc.* FROM dbg_config AS dsc WHERE dsc.sign='" . $sign . "' ORDER BY dsc.rank ASC";
		$this->admin_data['config_info'] = dbg_query ( $sql_config );
		$this->load_view ();
	}
	// @action:编辑
	public function edit()
	{ // 内容模型
		$sign = isset ( $_GET['sign'] ) ? $_GET['sign'] : 'base';
		$this->admin_data['sign'] = $sign; // 当前模型
		if($dbg_user['groupid'] == 1)
		{
			$count = count ( $_GET );
			$sign = dbg_input_getpost ( 'sign' ); // 栏目
			foreach($_GET as $k=>$v)
			{
				$sql = "UPDATE `dbg_config` SET `value`='$v' WHERE `aid`='$k'";
				$result = dbg_query ( $sql );
				if($result != 1)
				{
					echo "mysql错误--" . $sql;
					return;
				}
			}
			echo 1;
			return;
		}
		
		$this->load_view ();
	}
	// @action:删除
	public function delete()
	{
		$sign = isset ( $_GET['sign'] ) ? $_GET['sign'] : 'base';
		$this->admin_data['sign'] = $sign; // 当前模型
		if($id != null)
		{
			$delete_sql = 'DELETE FROM dbg_config WHERE id=' . $id;
			$result_delete['sql'] = dbg_query ( $delete_sql );
			$result_delete['id'] = $id;
			$result_delete = json_encode ( $result_delete );
			echo $result_delete;
			return;
		}
		else
		{
			redirect ( $this->admin_data['curr_url'] ); // 返回列表
			exit ();
		}
	}
	// @action:更新
	public function update()
	{
		$sign = isset ( $_GET['sign'] ) ? $_GET['sign'] : 'base';
		$this->admin_data['sign'] = $sign; // 当前模型
		$config_id = dbg_input_getpost ( 'config_id' ); // id
		$config_sign = dbg_input_getpost ( 'config_sign' ); // 标识
		$config_name = dbg_input_getpost ( 'config_name' ); // 描述
		$config_key = dbg_input_getpost ( 'config_key' ); // 键值
		$config_value = dbg_input_getpost ( 'config_value' ); // 值
		
		if(! empty ( $config_name ) || ! empty ( $config_key ))
		{
			for($i = 0;$i < count ( $config_name );$i ++)
			{
				$wsql = "";
				if(! empty ( $config_id[$i] ))
				{
					$wsql = " id =" . $config_id[$i];
				}
				else
				{
				}
				$field['sign'] = trim ( $config_sign[$i] );
				$field['name'] = trim ( $config_name[$i] );
				$field['key'] = trim ( $config_key[$i] );
				$field['value'] = trim ( $config_value[$i] );
				$sql = getsql_table ( 'dbg_config', $field, $wsql );
				$result = dbg_query ( $sql );
			}
			if($result == 1)
			{
				$sql_config = "SELECT dsc.sign,dsc.key,dsc.name,dsc.value FROM dbg_config AS dsc WHERE dsc.sign = '" . $sign . "' ORDER BY dsc.rank ASC;";
				$config_info = dbg_query ( $sql_config );
				$config_content = array();
				
				foreach($config_info as $k=>$val)
				{
					$config_content[$val['sign']][$val['key']] = $val['value'];
				}
				dbg_file ( DBG_DATA . '/config/' . $sign . '.inc.php', $config_content, 1 );
				dbg_file ( DBG_DATA . '/config/' . $sign . '.cache.php', $config_content, 4 );
			}
		}
		echo 1;
	}
}
