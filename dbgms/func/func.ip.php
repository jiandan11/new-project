<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
/**
 * @author zhw ip
 * @param string $type 类别
 * @param string $param 参数
 * @return boolean|Ambigous <string, unknown>
 * @version 2016-03-28
 */
function dbgms_IpGet($type = 'get', $param = NULL)
{
	switch($type)
	{
		// 判断IP 是否合法
		case 'check':
			// if ( ! preg_match ( "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $this->_IP )) {
			// $this->_IP = '0.0.0.0';
			// }
			$arr = explode ( '.', $ip );
			if(count ( $arr ) != 4)
			{
				return false;
			}
			else
			{
				for($i = 0;$i < 4;$i ++)
				{
					if(($arr[$i] < '0') || ($arr[$i] > '255'))
					{
						return false;
					}
				}
			}
			return true;
			break;
		// 获取IP
		case 'get':
			if(! empty ( $_SERVER["HTTP_CDN_SRC_IP"] ))
			{
				$cip = $_SERVER["HTTP_CDN_SRC_IP"];
			}
			elseif(! empty ( $_SERVER["HTTP_CLIENT_IP"] ))
			{
				$cip = $_SERVER["HTTP_CLIENT_IP"];
			}
			else if(! empty ( $_SERVER["HTTP_X_FORWARDED_FOR"] ))
			{
				$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			else if(! empty ( $_SERVER["REMOTE_ADDR"] ))
			{
				$cip = $_SERVER["REMOTE_ADDR"];
			}
			else
			{
				$cip = '';
			}
			preg_match ( "/[\d\.]{7,15}/", $cip, $cips );
			$cip = isset ( $cips[0] ) ? $cips[0] : 'unknown';
			unset ( $cips );
			return $cip;
			break;
	}
}

/**
 * @author zhw 城市
 * @param string $type 类别
 * @param string $param 参数
 * @return boolean|Ambigous <string, unknown>
 * @version 2016-03-28
 */
function dbgms_IpCity($ip = '', $type = 'sina', $param = '')
{
	if(empty ( $ip ))
	{
		$ip = dbgms_IpGet ();
	}
	// 【方法1】 ***********************获取新浪api**********************
	$result = @file_get_contents ( 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip );
	if(empty ( $result ))
	{
		return false;
	}
	$jsonMatches = array();
	preg_match ( '#\{.+?\}#', $result, $jsonMatches );
	if(! isset ( $jsonMatches[0] ))
	{
		return false;
	}
	$json = json_decode ( $jsonMatches[0], true );
	if(isset ( $json['ret'] ) && $json['ret'] == 1)
	{
		$json['ip'] = $ip;
		unset ( $json['ret'] );
	}
	else
	{
		return false;
	}
	return $json;
	
	// header ( 'Content-Type:text/html;Charset=utf-8' );
	// $myip = dbgms_IpGet ();
	// $myip = '59.56.62.237';
	// $ipInfos = dbgms_IpCity ( $myip ); // baidu.com IP地址
	// var_dump ( $ipInfos );
	
	// 根据ip
	
	// 【方法2】 ***********************获取淘宝接口**********************
	// $result = file_get_contents ( "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip );
	// $ipinfo = json_decode ( $result );
	// if($ipinfo->code == '1')
	// {
	// return FALSE;
	// }
	// $city = $ipinfo->data->region . $ipinfo->data->city . "-" . $ipinfo->data->isp;
	// return $city;
	// 这样调用，显示山东省临沂市
	// var_dump ( dbgms_IpCity ( "112.234.69.189" ) );
}
