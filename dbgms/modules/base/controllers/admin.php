<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( 'No direct script access allowed' );
}
/**
 * @author zhw
 * @version 2016-04-24
 */
class BASE_Admin extends DbgMs_Admin {
	public $title = 'BASE_管理员';
	// 当前模块 modules
	public $modules = 'base';
	// 当前控制器 controllers
	public $con = 'admin';
	public $mysql_table = 'dbg_admin';
	// @action:默认列表
	public function index()
	{ /* 当前页数 */
		$this->getpage ();
		$this->admin_data['page'] = $this->page;
		/* ID */
		$id = dbg_input_getpost ( 'id' );
		$id = isset ( $id ) ? intval ( $id ) : 0;
		
		$sql_select_list = "SELECT c.*, g.name AS groupname 
			FROM {$this->mysql_table} AS c 
				LEFT JOIN dbg_admin_group AS g ON c.groupid = g.id
			WHERE c.id!=1 ORDER BY c.id DESC 
			LIMIT	" . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
		$this->admin_data['list'] = dbg_query ( $sql_select_list );
		$total = dbg_query ( "SELECT COUNT(id) AS d FROM {$this->mysql_table} WHERE id!=1;" );
		$url = $this->admin_data['curr_url'] . '&page=';
		$this->admin_data['pagebreak'] = $this->pagebreak ( $this->page, $total[0]['d'], $this->pagesize, $url );
		$this->load_view ();
	}
	// @action:发送私信
	public function sendpm()
	{
		$this->admin_data['toemail'] = dbg_input_getpost ( 'email' );
		$this->load_view ();
	}
	// @action:发送
	public function sendemail()
	{
		$fromname = dbg_input_getpost ( 'name' );
		$fromemail = dbg_input_getpost ( 'email' );
		$toemail = dbg_input_getpost ( 'toemail' );
		$subject = dbg_input_getpost ( 'subject' );
		$content = dbg_input_getpost ( 'content' );
		$param = array(
				'fromemail' => $fromemail,
				'fromename' => $fromname,
				'toemail' => $toemail,
				'subject' => $subject,
				'content' => $content 
		);
		$dbgmsg = dbg_sendemail ( 'pm', $param );
		echo $dbgmsg;
	}
	// @action:是否禁用-开关 2016-04-05
	public function disable()
	{
		$id = dbg_input_getpost ( "id" );
		$id = intval ( $id );
		$where_sql = "";
		if($id != NULL)
		{
			$where_sql = " id =" . $id;
		}
		$field['disable'] = dbg_input_getpost ( "val" );
		$field['disable'] = intval ( $field['disable'] ); // 禁用
		$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		if($result == TRUE)
		{
			$result_json['StatusCode'] = 200;
		}
		else
		{
			$result_json['StatusCode'] = 404;
			$result_json['msg'] = "修改失败";
		}
		echo json_encode ( $result_json );
		exit ();
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
	// @action:编辑
	public function edit()
	{
		$id = intval ( dbg_input_getpost ( 'id' ) ); // id
		if($this->_admin['id'] != 1)
		{
			if($this->_admin['id'] != $id)
			{
				exit ( '权限问题' );
			}
		}
		if($id != null)
		{
			$sql_edit = "SELECT c.* FROM {$this->mysql_table} AS c WHERE c.id=" . $id;
			$row = dbg_query ( $sql_edit );
			$this->admin_data['row'] = $row[0];
		}
		$this->admin_data['grouplist'] = dbg_query ( "SELECT dbg_admin_group.* FROM dbg_admin_group WHERE id!=1 ORDER BY id DESC" );
		$this->load_view ();
	}
	// @action:更新
	public function update()
	{
		$id = intval ( dbg_input_getpost ( 'id' ) ); // id
		$where_sql = "";
		if($id != NULL)
		{ // 编辑状态
			$where_sql = " id =" . $id;
			$searchname = " c.id !={$id} AND ";
			
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
		$result_name = dbg_query ( "SELECT id FROM {$this->mysql_table} AS c WHERE " . $searchname . " c.name ='" . $field['name'] . "'" );
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
		$field['groupid'] = dbg_input_getpost ( 'groupid' ); // 组别
		$field['disable'] = intval ( dbg_input_getpost ( 'disable' ) ); // 是否禁用
		$field['ismust'] = intval ( dbg_input_getpost ( 'ismust' ) ); // 是否必须
		$sql = $this->parse_table_sql ( $this->mysql_table, $field, $where_sql );
		$result = dbg_query ( $sql, FALSE );
		echo $result;
	}
	public function sendemail2($type = NULL, $param = NULL)
	{
		if(! empty ( $param['company'] ))
		{
			$company = $param['company'];
		}
		else
		{
			$company = 'DbgMs';
		}
		$company_url = base_url ();
		switch($type)
		{
			// 注册验证
			case 'regist':
				$subject = $company . '_注册激活邮件';
				$message = '
					<h2> ' . $company . '   ' . $company_url . ' </h2>
		  			<p>这封信是由 ' . $company . '管理员 发送的。</p>
		  			<p>您收到这封邮件，是由于在 ' . $company . '获取了新用户注册地址使用
		  			了这个邮箱地址。如果您并没有访问过 ' . $company . '，或没有进行上述操作，请忽
		  			略这封邮件。您不需要退订或进行其他进一步的操作。</p>
		  			----------------------------------------------------------------------<br />
		  			<strong>新用户注册说明</strong><br />
		  			----------------------------------------------------------------------<br />
		  			<p>如果您是  ' . $company . '的新用户，或在修改您的注册 Email 时使用了本地址，我们需
			 		要对您的地址有效性进行验证以避免垃圾邮件或地址被滥用。</p>
		  			<p>您只需点击下面的链接即可进行用户注册，以下链接有效期为1天。过期可以请重新注册已便发送一封新的邮件验证：</p><br />
		  			<a style="color:blue;" target="_blank" href="' . $param['link'] . '" >' . $param['link'] . '</a><br />
		 			<p>(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)</p>
		  			<p>感谢您的访问，祝您使用愉快！</p>
		 			<p>此致<br /> ' . $company . '管理团队.<br /></p>
		 			<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>';
				break;
			// 忘记密码
			case 'forget':
				$subject = $company . '_找回密码邮件';
				$message = '
		  			<p>这封信是由 ' . $company . '管理员 发送的。</p>
		  			<p>您收到这封邮件，是由于在 ' . $company . '，您忘记密码，现在重置密码 。</p>
		  			<p>如果您并没有访问过 ' . $company . '，或没有进行上述操作，请忽略这封邮件。您不需要退订或进行其他进一步的操作。</p>
		  			----------------------------------------------------------------------<br />
		  			新密码为：&nbsp;<strong>' . $param['pwd'] . '</strong><br/>
		  			----------------------------------------------------------------------<br />
		  			<p>您只需点击下面的链接进行登录，登录后进入安全中心修改密码~</p>
		  		    <p>以下链接有效期为1天。过期可以请重新找回密码!</p>
		  			<a style="color:blue;" target="_blank" href="' . $param['link'] . '" >' . $param['link'] . '</a><br />
		 			<p>(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)</p>
		  			<p>感谢您的访问，祝您使用愉快！</p>
		 			<p>此致<br /> ' . $company . ' 管理团队.<br /></p>
					<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>';
				break;
			// 私信
			case 'pm':
				$subject = $company . '_成员私信';
				$message = '
						<p>这封信是由 管理组成员【 ' . $param['fromname'] . '  】 发送的。</p>
					    ----------------------------------------------------------------------<br />
						<strong>私信-主题</strong>&nbsp;&nbsp;&nbsp;     ' . $param['subject'] . '<br />
						----------------------------------------------------------------------<br />
					    <strong>私信人邮箱</strong>&nbsp;&nbsp;&nbsp; ' . $param['fromemail'] . '<br />
						----------------------------------------------------------------------<br />
						<strong>内容</strong><br />
						<p> ' . $param['content'] . '  </p>
						----------------------------------------------------------------------<br />
						<p>感谢您的访问，祝您使用愉快！</p>
						<p>此致<br /> ' . $company . '管理团队.<br /></p>
						<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>';
				break;
			// 意见反馈
			case 'feedback':
				$subject = $company . '-用户意见反馈邮件';
				$message = '
	  			<p><strong>用户意见反馈</strong></p>
	 			----------------------------------------------------------------------<br />
	  			<p><strong>联系邮箱:' . $param['email'] . '</strong></p>
	 			<p><strong>联系方式:' . $param['lianxi'] . '</strong></p>
	 			<p><strong>反馈内容:</strong></p>
	  			----------------------------------------------------------------------<br />
	 			' . $param['content'] . '
		 			<p>感谢您的访问，祝您使用愉快！</p>
		 			<p>此致<br /> ' . $company . '管理团队.<br /></p>
					<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>';
				break;
		}
		
		$ci_controllers = &get_instance ();
		if(isset ( $param['toemail'] ))
		{
			header ( "Content-type: text/html; charset=utf-8" );
			$smtp_host = $this->config['email']['smtp_host'];
			$smtp_port = $this->config['email']['smtp_port'];
			$smtp_user = $this->config['email']['smtp_user'];
			$smtp_pass = $this->config['email']['smtp_pass'];
			$config = array(
					'crlf' => "\r\n",
					'newline' => "\r\n",
					'charset' => 'utf-8',
					'protocol' => 'smtp', // 邮件发送协议
					'mailtype' => 'html',
					'smtp_host' => $smtp_host, // SMTP服务器地址
					'smtp_port' => $smtp_port,
					'smtp_user' => $smtp_user, // smtp用户账号
					'smtp_pass' => $smtp_pass /*smtp密码*/
			);
			
			/* == 腾讯企业邮箱-延迟== */
			// 'smtp_host' => 'smtp.exmail.qq.com', // SMTP服务器地址
			// 'smtp_port' => '25',
			// 'smtp_user' => 'team@dbgms.cn', // smtp用户账号
			// 'smtp_pass' => 'xxxx' /*smtp密码*/
			
			/* ==163邮箱-快== */
			// 'smtp_host' => 'smtp.163.com', // SMTP服务器地址
			// 'smtp_port' => '25',
			// 'smtp_user' => '15060842423@163.com', // smtp用户账号
			// 'smtp_pass' => 'xxxx' /*smtp密码*/
			
			/* ==商务中国邮箱-延迟== */
			// 'smtp_host' => 'smtp.jhxssj.com', // SMTP服务器地址
			// 'smtp_port' => '25',
			// 'smtp_user' => 'test@jhxssj.com', // smtp用户账号
			// 'smtp_pass' => 'WWWjhxssj123' /*smtp密码*/
			
			$ci_controllers->load->library ( 'email', $config );
			$ci_controllers->email->from ( 'test@jhxssj.com' ); // 来自什么邮箱
			$ci_controllers->email->to ( $param['toemail'] ); // 发到什么邮箱
			$ci_controllers->email->subject ( $subject ); // 邮件主题
			$ci_controllers->email->message ( $message ); // 邮件内容
			if($ci_controllers->email->send ())
			{ // 发送email，根据发送结果，成功返回true,失败返回false,就可以用它判断局域
				unset ( $ci_controllers );
				return 1;
			}
			else
			{ // 返回包含邮件内容的字符串，包括EMAIL正文。用于调试
				$errormsg = $ci_controllers->email->print_debugger ();
				unset ( $ci_controllers );
				return $errormsg;
				exit ();
			}
		}
	}
}
