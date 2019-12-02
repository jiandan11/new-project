<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
/**
 * @author dbgms-zhw
 * @version 2016-02-18
 *	module cms 模块-会员
 *	controllers album 数据统计
 */
/*
 * 评论功能
 * 开始设计的时候,
 * 先判断是否 未来数据量会多，是否启用
 * 根据 模型 创建 评论 数据表
 * 根据 栏目 创建 评论 数据表
 */
class CMS_Comment extends DbgMs_Admin {
	public $title = 'CMS_评论管理';
	// 当前模块 modules
	public $modules = 'cms';
	// 当前控制器 controllers
	public $con = 'comment';
	public $mysql_table = 'dbg_pages';
	// @action 获取评论列表
	public function dbg_comment_get($model_id = NULL, $column_id = NULL)
	{
		return $comment_list;
	}
	// @action 添加评论内容
	public function dbg_comment_add($model_id = NULL, $column_id = NULL, $content_id = NULL, $user_id = NULL)
	{
		
		// 获取 模型数据，判断 模型是否开启 评论功能
		
		// 获取 栏目数据，判断 栏目是否开启 评论功能
		
		// 获取 内容数据，判断 内容是否开启 评论功能
		
		// 都满足的情况下,插入数据
		// 游客 or 用户 评论
	}
	// @action 删除评论内容
	public function dbg_comment_del($id, $model_id = NULL, $column_id = NULL)
	{
		// 开始设计的时候,先判断是否 未来数据量会多，是否启用 根据 模型 创建评论表,根据栏目 创建评论表
	}
	// @action:删除 2016-03-30
	public function delete()
	{
		$id = dbg_input_getpost ( 'id' );
		$id = intval ( $id );
		if($id != NULL)
		{
			$relust_sql = dbg_query ( 'DELETE FROM ' . $this->mysql_table . ' WHERE id=' . $id, FALSE );
			if($relust_sql == TRUE)
			{
				$result_json['StatusCode'] = 200;
				$result_json['id'] = $id;
			}
			else
			{
				$result_json['StatusCode'] = 404;
				$result_json['msg'] = "删除失败,数据操作错误";
			}
			echo json_encode ( $result_json );
			exit ();
		}
		else
		{
			redirect ( $this->admin_data['con_url'] ); // 返回列表
			exit ();
		}
	}
}
