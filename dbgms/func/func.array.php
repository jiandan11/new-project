<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
// 二维数组排序
function dbg_sort($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
{
	if(is_array ( $arrays ))
	{
		foreach($arrays as $array)
		{
			if(is_array ( $array ))
			{
				$key_arrays[] = $array[$sort_key];
			}
			else
			{
				return false;
			}
		}
	}
	else
	{
		return false;
	}
	array_multisort ( $key_arrays, $sort_order, $sort_type, $arrays );
	return $arrays;
}

// @action:数组 object 和 array 互转 即: $arr->k 转 $arr[k]
// @param $type 1.o转a ,后面自动判断
// @param $arr 需要转换的数组
function object_replace_array($type = 1, $arr = array())
{
	// 调用这个函数，将其幻化为数组，然后取出对应值
	// function object_array ( $array) {
	// if(is_object ( $array )){
	// $array = ( array ) $array; // 方法1
	// $array = get_object_vars ( $array ); // 方法2
	// }
	// if(is_array ( $array )){
	// foreach($array as $key => $value){
	// $array [$key] = $this->object_array ( $value );
	// }
	// }
	// return $array;
	// }
	$return_data = array();
	// object 转 array
	if($type == 1)
	{
		if(empty ( $arr ))
		{
			$return_data = $arr;
		}
		elseif(count ( $arr ) == 1)
		{
			$return_data = ( array ) $arr[0];
		}
		else
		{
			foreach($arr as $val)
			{
				$return_data[] = ( array ) $val;
			}
		}
	} // 不转
	else
	{
		$return_data = $arr;
	}
	return $return_data;
}

/* 判断多维数组是否存在某个值 */
function dbg_in_array($value = NULL, $array = array(), $echo = NULL)
{
	foreach($array as $item)
	{
		if(! is_array ( $item ))
		{
			if($item == $value)
			{
				return true;
			}
			else
			{
				continue;
			}
		}
		if(in_array ( $value, $item ))
		{
			return true;
		}
		else if(dbg_in_array ( $value, $item ))
		{
			return true;
		}
	}
	return false;
}

// 访问 接口,接收数据,
function get_api_data($url = NULL, $type = 'json')
{
	$url = 'http://www.benshouji.com/pages/zgsjl2015.htm';
	$file_contents = file_get_contents ( $url );
	
	if($type == 'json')
	{
		$arr_json = json_decode ( $file_contents );
		var_dump ( $arr_json );
	}
	// POST方式得用下面的(需要开启PHP curl支持)。
	// $url = 'http://www.benshouji.com/pages/zgsjl2015.htm';
	// $ch = curl_init ();
	// curl_setopt ( $ch, CURLOPT_URL, $url );
	// curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
	// curl_setopt ( $ch, CURLOPT_POST, 1 ); // 启用POST提交
	// $file_contents2 = curl_exec ( $ch );
	// echo $file_contents2;
	// curl_close ( $ch );
}

/*
 * 可逆加密解密 ***********************************************
 */
function array_encode($post, $key = 'bycms')
{
	if(! is_array ( $post ))
	{
		return;
	}
	$str = '';
	foreach($post as $k=>$v)
	{
		$str .= "$k=$v&";
	}
	return authcode ( $str, 'CODE', $key );
}
function array_decode($str, $key = 'bycms')
{
	if(trim ( $str ) == '')
	{
		return;
	}
	$arystr = authcode ( $str, 'DECODE', $key );
	parse_str ( $arystr, $ary );
	return $ary;
}
// @action dbg_str_replace替换
function dbg_str_replace($htmltext, $clear_html = NULL)
{
	// 2.清除空格--等一些字符,留下纯文本
	$qian = array(
			" ",
			"　",
			"\t",
			"\n",
			"\r" 
	);
	$hou = array(
			"",
			"",
			"",
			"",
			"" 
	);
	$htmltext = str_replace ( $qian, $hou, $htmltext );
	if($clear_html = TRUE)
	{
		// @action 用于替换
		$search = array(
				"'<script[^>]*?>.*?<!-- </script> -->'si", // 去掉 javascript
				"'<[\/\!]*?[^<>]*?>'si", // 去掉 HTML 标记
				"'([\r\n])[\s]+'", // 去掉空白字符
				"'&(quot|#34);'i", // 替换 HTML 实体
				"'&(amp|#38);'i", //
				"'&(lt|#60);'i", //
				"'&(gt|#62);'i", //
				"'&(nbsp|#160);'i", //
				"'&(iexcl|#161);'i", //
				"'&(cent|#162);'i", //
				"'&(pound|#163);'i", //
				"'&(copy|#169);'i", //
				"'&#(\d+);'e" 
		); // 作为 PHP 代码运行
		$replace = array(
				"", //
				"", //
				"\\1", //
				"\"", //
				"&", //
				"<", //
				">", //
				" ", //
				chr ( 161 ), //
				chr ( 162 ), //
				chr ( 163 ), //
				chr ( 169 ), //
				"chr(\\1)" 
		);
		$htmltext = preg_replace ( $search, $replace, $htmltext );
	}
	return $htmltext;
}
// 替换html中标记
function htmltostr($str, $stype = 0, $notsql = 0)
{
	if(trim ( $str ) == '')
		return '';
	$str = stripslashes ( $str );
	if($stype == 1 || $stype == 2)
	{
		$str = trimphpstr ( $str );
		$str = delblank ( $str, $stype, 1 );
	}
	else
	{
		$str = trimphpstr ( $str );
	}
	return $notsql ? $str : addslashes ( $str );
}
/*
 * 字符串处理 ***********************************************
 */
function trimphpstr($v)
{
	$v = str_replace ( array(
			'"',
			"'",
			'<',
			'>' 
	), array(
			'&quot;',
			'&#039;',
			'&lt;',
			'&gt;' 
	), $v );
	return $v;
}
function dbg_object_array($array)
{
	if(is_object ( $array ))
	{
		$array = ( array ) $array;
	}
	if(is_array ( $array ))
	{
		foreach($array as $key=>$value)
		{
			$array[$key] = dbg_object_array ( $value );
		}
	}
	return $array;
}
function string_array($data)
{
	if($data == '')
		return array();
	eval ( "\$array = $data;" );
	return $array;
}
function array_str($array = array(), $sql = 1)
{
	$rs = '';
	if(is_array ( $array ))
	{
		$rs = @serialize ( $array );
		if($sql)
		{
			$rs = addslashes ( $rs );
		}
	}
	return $rs;
}
function str_array($str = '', $sql = 0)
{
	if($sql)
	{
		$str = stripslashes ( $str );
	}
	$us = trim ( $str ) != '' ? @unserialize ( $str ) : false;
	return is_array ( $us ) ? mystrips ( $us ) : array();
}
function mystrips($inp)
{
	if(is_array ( $inp ))
	{
		$rs = array();
		foreach($inp as $k=>$v)
		{
			$rs[$k] = mystrips ( $v );
		}
		return $rs;
	}
	return stripslashes ( $inp );
}

/**
 * ************这个函数的功能是将数值转换成json数据存储格式**************************
 * 使用特定function对数组中所有元素做处理
 * @param string &$array 要处理的字符串
 * @param string $function 要执行的函数
 * @return boolean $apply_to_keys_also 是否也应用到key上
 * @access public
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
	static $recursive_counter = 0;
	if(++ $recursive_counter > 1000)
	{
		die ( 'possible deep recursion attack' );
	}
	foreach($array as $key=>$value)
	{
		if(is_array ( $value ))
		{
			arrayRecursive ( $array[$key], $function, $apply_to_keys_also );
		}
		else
		{
			$array[$key] = $function ( $value );
		}
		
		if($apply_to_keys_also && is_string ( $key ))
		{
			$new_key = $function ( $key );
			if($new_key != $key)
			{
				$array[$new_key] = $array[$key];
				unset ( $array[$key] );
			}
		}
	}
	$recursive_counter --;
}
/*
 * 将数组转换为JSON字符串（兼容中文）
 * @param array $array 要转换的数组
 * @return string 转换得到的json字符串
 * @access public
 *
 */
// function JSON($array)
// {
// arrayRecursive ( $array, 'urlencode', true );
// $json = json_encode ( $array );
// return urldecode ( $json );
// }
// $array = array(
// 'Name' => '希亚',
// 'Age' => 20
// );
// echo JSON ( $array );
// $str="'324是";
// if(!eregi("[^\x80-\xff]","$str")){
// echo "全是中文";
// }else{
// echo "不是";
// }

// 二，判断含有中文
// 复制代码 代码如下:

// $str = "中文";
// if (preg_match("/[\x7f-\xff]/", $str)) {
// echo "含有中文";
// }else{
// echo "没有中文";
// }
// 或
// $pattern = '/[^\x00-\x80]/';
// if(preg_match($pattern,$str)){
// echo "含有中文";
// }else{
// echo "没有中文";
// }
function getfirstchar($s0)
{
	$c = ereg ( '[a-zA-Z]', strtoupper ( substr ( $s0, 0, 1 ) ) );
	if($c)
	{
		return strtoupper ( substr ( $s0, 0, 1 ) );
	}
	else
	{
		if($fchar >= ord ( "a" ) and $fchar <= ord ( "Z" ))
			return strtoupper ( $s0{0} );
		if(is_numeric ( substr ( $s0, 0, 1 ) ))
		{
			$s0 = ToChinaseNum ( substr ( $s0, 0, 1 ) );
		}
		$s = $s0;
		$asc = ord ( $s{0} ) * 256 + ord ( $s{1} ) - 65536;
		if($asc >= - 20319 and $asc <= - 20284)
			return "A";
		if($asc >= - 20283 and $asc <= - 19776)
			return "B";
		if($asc >= - 19775 and $asc <= - 19219)
			return "C";
		if($asc >= - 19218 and $asc <= - 18711)
			return "D";
		if($asc >= - 18710 and $asc <= - 18527)
			return "E";
		if($asc >= - 18526 and $asc <= - 18240)
			return "F";
		if($asc >= - 18239 and $asc <= - 17923)
			return "G";
		if($asc >= - 17922 and $asc <= - 17418)
			return "H";
		if($asc >= - 17417 and $asc <= - 16475)
			return "J";
		if($asc >= - 16474 and $asc <= - 16213)
			return "K";
		if($asc >= - 16212 and $asc <= - 15641)
			return "L";
		if($asc >= - 15640 and $asc <= - 15166)
			return "M";
		if($asc >= - 15165 and $asc <= - 14923)
			return "N";
		if($asc >= - 14922 and $asc <= - 14915)
			return "O";
		if($asc >= - 14914 and $asc <= - 14631)
			return "P";
		if($asc >= - 14630 and $asc <= - 14150)
			return "Q";
		if($asc >= - 14149 and $asc <= - 14091)
			return "R";
		if($asc >= - 14090 and $asc <= - 13319)
			return "S";
		if($asc >= - 13318 and $asc <= - 12839)
			return "T";
		if($asc >= - 12838 and $asc <= - 12557)
			return "W";
		if($asc >= - 12556 and $asc <= - 11848)
			return "X";
		if($asc >= - 11847 and $asc <= - 11056)
			return "Y";
		if($asc >= - 11055 and $asc <= - 10247)
			return "Z";
		return null;
	}
}
function ToChinaseNum($num)
{
	$char = array(
			"零",
			"一",
			"二",
			"三",
			"四",
			"五",
			"六",
			"七",
			"八",
			"九" 
	);
	$dw = array(
			"",
			"十",
			"百",
			"千",
			"万",
			"亿",
			"兆" 
	);
	$retval = "";
	$proZero = false;
	for($i = 0;$i < strlen ( $num );$i ++)
	{
		if($i > 0)
			$temp = ( int ) (($num % pow ( 10, $i + 1 )) / pow ( 10, $i ));
		else
			$temp = ( int ) ($num % pow ( 10, 1 ));
		
		if($proZero == true && $temp == 0)
			continue;
		
		if($temp == 0)
			$proZero = true;
		else
			$proZero = false;
		
		if($proZero)
		{
			if($retval == "")
				continue;
			$retval = $char[$temp] . $retval;
		}
		else
			$retval = $char[$temp] . $dw[$i] . $retval;
	}
	if($retval == "一十")
		$retval = "十";
	return $retval;
}

// 生成Hash字符串
function gethashv($site_key)
{
	$vstr_a = $vstr = '';
	$n = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	for($i = 0;$i < 25;$i ++)
	{
		$j = mt_rand ( 0, (strlen ( $n ) - 1) );
		$vstr_a .= $n{$j};
	}
	$vstr_b = md5 ( $key . $vstr_a );
	$vstr = $vstr_b . '-' . $vstr_a;
	return $vstr;
}

// 验证Hash字符串是否合法
function checkhashv($v, $site_key)
{
	if(trim ( $v ) == '' || ! strpos ( $v, '-' ))
	{
		return false;
	}
	$str = explode ( '-', $v );
	if($str[0] != md5 ( $key . $str[1] ))
	{
		return false;
	}
	return true;
}

// 生成 $length 位随机码
function randhash($length = 6, $numeric = 0, $exper = '')
{
	PHP_VERSION < '4.2.0' ? mt_srand ( ( double ) microtime () * 1000000 ) : mt_srand ();
	$seed = base_convert ( md5 ( $exper . print_r ( $_SERVER, 1 ) . microtime () ), 16, $numeric ? 10 : 35 );
	$seed = $numeric ? (str_replace ( '0', '', $seed ) . '012340567890') : ($seed . 'zZ' . strtoupper ( $seed ));
	$hash = '';
	$max = strlen ( $seed ) - 1;
	for($i = 0;$i < $length;$i ++)
	{
		$hash .= $seed[mt_rand ( 0, $max )];
	}
	return $hash;
}
function num2cn($num = 0)
{
	$cns = array(
			'零',
			'一',
			'二',
			'三',
			'四',
			'五',
			'六',
			'七',
			'八',
			'九',
			'十',
			'十一',
			'十二',
			'十三',
			'十四',
			'十五',
			'十六',
			'十七',
			'十八',
			'十九',
			'二十' 
	);
	$num = intval ( $num );
	return isset ( $cns[$num] ) ? $cns[$num] : $num;
}

/**
 * 汉字转拼音 2016-05-10 
 * @param string $str 待转换的字符串
 * @param string $charset 字符串编码
 * @param bool $ishead 是否只提取首字母
 * @return string 返回结果 
 */
function dbgms_getPinyin($str, $charset = "utf-8", $ishead = 0)
{
	$restr = '';
	$str = trim ( $str );
	if($charset == "utf-8")
	{
		$str = iconv ( "utf-8", "gb2312", $str );
	}
	$slen = strlen ( $str );
	$pinyins = array();
	if($slen < 2)
	{
		return $str;
	}
	
	$pinyin_file_path = _DBGMS_FONTS_ . '/pinyin.dat';
	$fp = fopen ( $pinyin_file_path, 'r' );
	while(! feof ( $fp ))
	{
		$line = trim ( fgets ( $fp ) );
		$pinyins[$line[0] . $line[1]] = substr ( $line, 3, strlen ( $line ) - 3 );
	}
	fclose ( $fp );
	
	for($i = 0;$i < $slen;$i ++)
	{
		if(ord ( $str[$i] ) > 0x80)
		{
			$c = $str[$i] . $str[$i + 1];
			$i ++;
			if(isset ( $pinyins[$c] ))
			{
				if($ishead == 0)
				{
					$restr .= $pinyins[$c];
				}
				else
				{
					$restr .= $pinyins[$c][0];
				}
			}
			else
			{
				$restr .= "_";
			}
		}
		else if(preg_match ( "/[a-z0-9]/i", $str[$i] ))
		{
			$restr .= $str[$i];
		}
		else
		{
			$restr .= "_";
		}
	}
	return $restr;
}
