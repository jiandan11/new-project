<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Change extends DbgMs_Admin {
	public $title = 'BASE_密码修改';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'change';
	public $mysql_table = 'dbg_admin';
	// @action:默认列表
	public function index()
	{
		$sql_edit = "SELECT dbg_admin.* FROM dbg_admin WHERE dbg_admin.id=" . $this->_admin['id'];
		$row = dbg_query ( $sql_edit );
		$this->admin_data['row'] = $row[0];
		$this->load_view ();
	}
	
	// @action:更新
	public function update()
	{
		$id = $this->_admin['id']; // id
		$where_sql = "";
		if($id != NULL)
		{ // 编辑状态
			$where_sql = " id =" . $id;
			$searchname = " dbg_admin.id !={$id} AND ";
			
			$pwd = dbg_input_getpost ( 'pwd' );
			if(! empty ( $pwd ))
			{
				$field['pwd'] = md5 ( $pwd );
			}
		}
		else
		{
			$field['name'] = dbg_input_getpost ( 'name' ); // 用户名
			$field['pwd'] = dbg_input_getpost ( 'pwd' ); // 密码
			if(empty ( $field['name'] ) || empty ( $field['pwd'] ))
			{
				echo "必填项不能为空！";
				exit ();
			}
			$field['pwd'] = md5 ( $field['pwd'] );
			
			$field['regtime'] = $field['logintime'] = time (); // 时间
			$field['regip'] = $field['loginip'] = dbgms_IpGet (); // ip
		}
		$field['name'] = empty ( $field['name'] ) ? dbg_input_getpost ( 'name' ) : $field['name'];
		$result_name = dbg_query ( "SELECT id FROM dbg_admin WHERE " . $searchname . " dbg_admin.name ='" . $field['name'] . "'" );
		if($result_name)
		{
			echo " 该账户 ,已经存在";
			exit ();
		}
		$field['alias'] = dbg_input_getpost ( 'alias' ); // 别名
		$field['alias'] = empty ( $field['alias'] ) ? '-' : $field['alias'];
		$field['qq'] = dbg_input_getpost ( 'qq' ); // QQ
		$field['qq'] = empty ( $field['qq'] ) ? '0' : $field['qq'];
		$field['email'] = dbg_input_getpost ( 'email' ); // 邮箱
		
		$sql = $this->parse_table_sql ( 'dbg_admin', $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		echo $result;
	}
}
