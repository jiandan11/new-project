<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
function dayget($ntime, $ctime)
{
	$dayst = 3600 * 24;
	$cday = ceil ( ($ntime - $ctime) / $dayst );
	return $cday;
}
function dayadd($ntime, $aday)
{
	$dayst = 3600 * 24;
	$oktime = $ntime + ($aday * $dayst);
	return $oktime;
}
/**
 * @author zhw   @action 计算时间差
 * @param $start_time 传递进来的开始时间        	
 * @return 返回差值
 */
function get_time_deviation($start_time = null)
{
	date_default_timezone_set ( 'PRC' );
	/* 方法2,根据时间戳,秒数来判断 */
	$endtime = time ();
	$deviation = $endtime - $start_time;
	if($deviation < 0 || $deviation > 3600)
	{
		if(date ( 'Y', $endtime ) != date ( 'Y', $start_time ))
		{
			return date ( 'Y-m-d', $start_time );
		}
		return date ( 'm-d H:i', $start_time );
	}
	if($deviation < 30)
	{
		return ' 刚刚';
	}
	elseif($deviation < 60)
	{
		return $deviation . ' 秒钟前';
	}
	else
	{
		return floor ( $deviation / 60 ) . ' 分钟前';
	}
	// 方法1
	// $startdate = $start_time;
	$startdate = date ( 'Y-m-d H:i:s', $start_time );
	$enddate = date ( 'Y-m-d H:i:s', time () );
	// 差距-天
	$time_date = floor ( (strtotime ( $enddate ) - strtotime ( $startdate )) / 86400 );
	if($time_date <= 0)
	{
		// 差距-小时
		$time_hour = floor ( (strtotime ( $enddate ) - strtotime ( $startdate )) % 86400 / 3600 );
		// 差距-分钟
		$time_minute = floor ( (strtotime ( $enddate ) - strtotime ( $startdate )) % 86400 / 60 );
		// 差距-秒
		$time_second = floor ( (strtotime ( $enddate ) - strtotime ( $startdate )) % 86400 % 60 );
		if($time_hour <= 0)
		{
			if($time_minute < 1)
			{
				if($time_second < 30)
				{
					return "刚刚";
				}
				else if($time_second < 60)
				{
					return $time_second . " 秒前";
				}
			}
			elseif($time_minute <= 60)
			{
				return $time_minute . " 分钟前";
			}
		}
		else if($time_hour > 0 && $time_hour < 1)
		{
			return $time_hour . " 小时前";
		}
		else
		{
			return date ( "m-d H:i", strtotime ( $startdate ) ) . "";
		}
	}
	else if($time_date > 0 && $time_date < 365)
	{
		/**
		 * 1年内
		 */
		return date ( "m-d H:i", strtotime ( $startdate ) ) . "";
	}
	else
	{
		return date ( "Y-m-d", strtotime ( $startdate ) ) . "";
	}
	// echo $time_date . "天<br>";
	// echo $time_hour . "时<br>";
	// echo $time_minute . "分钟<br>";
	// echo $time_second . "秒<br>";
}
/*
 * 时间戳处理 ***********************************************
 */
function stotime($str)
{
	global $_glb;
	$_glb['time_zone'] = isset ( $_glb['time_zone'] ) ? $_glb['time_zone'] : 8;
	$str = trim ( preg_replace ( '/[ \r\n\t\f\日\秒]{1,}/', ' ', $str ) );
	$str = preg_replace ( '/[\年\月]{1,}/', '-', $str );
	$str = preg_replace ( '/[\时\点\分]{1,}/', ':', $str );
	$dates = $str;
	$times = '';
	if(strpos ( $str, " " ) !== false)
	{
		$dtstr = explode ( " ", $str );
		$dates = $dtstr[0];
		$times = explode ( ":", $dtstr[1] );
		$times[0] = empty ( $times[0] ) ? '00' : $times[0];
		$times[1] = empty ( $times[1] ) ? '00' : $times[1];
		$times[2] = empty ( $times[2] ) ? '00' : $times[2];
		$times = implode ( ':', $times );
	}
	// $rstime = strtotime($dates.' '.$times)- $_glb['time_zone']*3600;
	$rstime = strtotime ( $dates . ' ' . $times );
	return $rstime;
}
function timetostr($times = 0, $format = 'Y-m-d H:i')
{
	global $_glb;
	$_glb['time_zone'] = isset ( $_glb['time_zone'] ) ? $_glb['time_zone'] : 8;
	$format = empty ( $format ) ? 'Y-m-d H:i' : $format;
	// return date($format,$times+$_glb['time_zone']*3600);
	return date ( $format, $times );
}