<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
/**
 * @author zhw 常用 手机号码 方法
 * @param string $type 类别
 * @param string $param 参数
 * @return boolean|Ambigous <string, unknown>
 * @version 2016-03-28
 */
function dbgms_Phone($phone = NULL)
{
	if(! empty ( $phone ))
	{
		// preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $field['info_phone']
		if(strlen ( $phone ) != 11 || ! preg_match ( '/^1[3|4|5|7|8][0-9]\d{4,8}$/', $phone ))
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	return FALSE;
}