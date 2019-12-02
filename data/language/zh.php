<?php
/* 默认 */
$lang['email']['default'] = array(
		'subject' => '{DbgMs管理系统}_欢迎您!',
		'message' => '<h2 style="font-size:16px;"> {DbgMs管理系统}' . $company_url . ' </h2>
	<p>感谢您的访问，祝您使用愉快！</p>
	<p>此致<br /> {DbgMs管理系统}-管理团队.<br /></p>
	<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>' 
);
/* 会员注册 */
$lang['email']['regist'] = array(
		'subject' => '{DbgMs管理系统}_注册激活邮件',
		'message' => '<h2 style="font-size:16px;"> {DbgMs管理系统}' . $company_url . ' </h2>
	<p>这封信是由  {DbgMs管理系统}管理员 发送的。</p>
	<p>您收到这封邮件，是由于在 {DbgMs管理系统}获取了新用户注册地址使用了这个邮箱地址。</p>
	<p>如果您并没有访问过 {DbgMs管理系统}，或没有进行上述操作，请忽略这封邮件。<br />
		您不需要退订或进行其他进一步的操作。</p>
		----------------------------------------------------------------------<br />
		<strong>新用户注册说明</strong><br />
		----------------------------------------------------------------------<br />
	<p>如果您是  {DbgMs管理系统} 的新用户，或在修改您的注册 Email 时使用了本地址，我们需
		要对您的地址有效性进行验证以避免垃圾邮件或地址被滥用。</p>
	<p>您只需点击下面的链接即可进行用户注册，以下链接有效期为1天。过期可以请重新注册已便发送一封新的邮件验证：</p><br />
	<a style="color:blue;" target="_blank" href="' . $param['link'] . '" >' . $param['link'] . '</a><br />
	<p>(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)</p>
	<p>感谢您的访问，祝您使用愉快！</p>
	<p>此致<br /> {DbgMs管理系统}-管理团队.<br /></p>
	<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>' 
);
/* 忘记密码邮件提示 */
$lang['email']['forget'] = array(
		'subject' => '{DbgMs管理系统}_找回密码邮件',
		'message' => '
	<p>这封信是由  {DbgMs管理系统} 管理员 发送的。</p>
	<p>您收到这封邮件，是由于在{DbgMs管理系统}，您忘记密码，现在重置密码 。</p>
	<p>如果您并没有访问过 {DbgMs管理系统}，或没有进行上述操作，请忽略这封邮件。<br />
		您不需要退订或进行其他进一步的操作。</p>
	----------------------------------------------------------------------<br />
	邮箱验证码为：&nbsp;<strong>' . $param['authcode'] . '</strong><br/>
	----------------------------------------------------------------------<br />
	<p>感谢您的访问，祝您使用愉快！</p>
	<p>此致<br /> {DbgMs管理系统}-管理团队.<br /></p>
	<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>' 
);

/* 成员私信 */
$lang['email']['pm'] = array(
		'subject' => '{DbgMs管理系统}_成员私信',
		'message' => '
	<p>这封信是由 管理组成员【 ' . $param['fromname'] . '  】 发送的。</p>
    ----------------------------------------------------------------------<br/>
	<strong>私信-主题</strong>&nbsp;&nbsp;&nbsp;   ' . $param['subject'] . '<br/>
	----------------------------------------------------------------------<br/>
    <strong>私信人邮箱</strong>&nbsp;&nbsp;      ' . $param['fromemail'] . ' <br/>
	----------------------------------------------------------------------<br/>
	<strong>内容</strong><br />
	<p> ' . $param['content'] . '  </p>
	----------------------------------------------------------------------<br />
	<p>感谢您的访问，祝您使用愉快！</p>
	<p>此致<br /> {DbgMs管理系统}-管理团队.<br /></p>
	<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>' 
);
/* 意见反馈 */
$lang['email']['feedback'] = array(
		'subject' => '{DbgMs管理系统}_用户意见反馈邮件',
		'message' => '
	<p><strong>用户意见反馈</strong></p>
	----------------------------------------------------------------------<br />
	<p><strong>联系邮箱:' . $param['email'] . '</strong></p>
	<p><strong>联系方式:' . $param['lianxi'] . '</strong></p>
	<p><strong>反馈内容:</strong></p>
	----------------------------------------------------------------------<br />
	' . $param['content'] . '
	<p>感谢您的访问，祝您使用愉快！</p>
	<p>此致<br /> {DbgMs管理系统}-管理团队.<br /></p>
	<p>技术支持：<a style="color:#849B2E;" target="_blank" href="http://www.DbgMs.cn/" >http://www.DbgMs.cn/</a></p>' 
);

/* 会员注册 */
$lang['email']['register2'] = array(
		'subject' => '',
		'message' => '' 
);
/* 忘记密码手机短信提示 */
$lang['phone']['forget'] = "【DbgMs管理系统】{$_member_phone_ma} 此验证码只用于登录你的xx，验证码提供给他人将导致XX被盗，请勿丢失，转发";

/* 会员注册 */
$lang['phone']['register'] = "【DbgMs管理系统】尊敬的用户您好，您的短信确认码为{$_member_phone_ma}。请在页面填写验证码完成验证。【如非本人操作，请不予理会】";