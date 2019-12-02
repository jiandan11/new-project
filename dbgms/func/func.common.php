<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
function dbg_get_evnt($u)
{
	switch($u)
	{
		case 'ip':
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
		case 'self':
			return isset ( $_SERVER['PHP_SELF'] ) ? $_SERVER['PHP_SELF'] : (isset ( $_SERVER['SCRIPT_NAME'] ) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
			break;
		case 'referer':
			return isset ( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';
			break;
		case 'domain':
			return $_SERVER['SERVER_NAME'];
			break;
		case 'scheme':
			return isset ( $_SERVER['SERVER_PORT'] ) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
			break;
		case 'port':
			return isset ( $_SERVER['SERVER_PORT'] ) && $_SERVER['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER['SERVER_PORT'];
			break;
		case 'url':
			if(! empty ( $_SERVER['REQUEST_URI'] ))
			{
				$url = $_SERVER['REQUEST_URI'];
			}
			else
			{
				$url = ! empty ( $_SERVER['argv'] ) ? $_SERVER['PHP_SELF'] . '?' . $_SERVER['argv'][0] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
			}
			if(isset ( $_SERVER['HTTP_HOST'] ))
			{
				return get_evnt ( 'scheme' ) . $_SERVER['HTTP_HOST'] . (strpos ( $_SERVER['HTTP_HOST'], ':' ) === false ? get_evnt ( 'port' ) : '') . $url;
			}
			return '';
			break;
		case 'browser':
			if(! empty ( $_SERVER["HTTP_USER_AGENT"] ))
			{
				$ua = $_SERVER["HTTP_USER_AGENT"];
			}
			return $ua;
			break;
		default:
			return '';
			break;
	}
}
/**
 * @action
 * @author Name zhw Email 343196936@qq.com Data 2015年3月21日
 * @param unknown $thead  需要显示的表头和sql字段,对应
 * @param unknown $tbody
 * @return string
 */
function dbg_table(array $thead = array(), array $tbody = array(), array $sql_field = array())
{
	$_table = '<table>';
	if(! empty ( $thead ))
	{
		/* thead */
		$_table .= '<thead><tr>';
		foreach($thead as $value)
		{
			$_table .= '<th>' . $value . '</th>';
		}
		$_table .= '</tr></thead>';
		/* tbody */
		if(empty ( $tbody ))
		{
			$_table .= '<tbody>';
			for($i = 0;$i < count ( $tbody );$i ++)
			{
				$_table .= '<tr id="tr' . $tbody[$i]->id . '">';
				foreach($tbody[$i] as $key=>$val)
				{
					if(in_array ( $key, $sql_field ))
					{
						$_table .= "<td>" . $val . "</td>";
					}
				}
				$_table .= "<td><a onclick='edit(" . $tbody[$i]->id . ")' >编辑</a><a onclick='del(" . $tbody[$i]->id . ")' >删除 </a></td></tr>";
			}
			$_table .= '</tbody>';
		}
		$_table .= '</table>';
	}
	return $_table;
}
function sum()
{
	$ary = func_get_args ();
	$sum = 0;
	foreach($ary as $int)
	{
		$sum += intval ( $int );
	}
	return $sum;
}
// 数字(>0)加密变长
function num_encode($int = 0, $type = 'ENCODE')
{
	if($type == 'ENCODE')
	{
		$int = ( int ) $int;
		if($int == 0)
		{
			return 0;
		}
		$len = strlen ( $int );
		$temp = (300000000 + $int - 19750806) * 2;
		return $temp . $len;
	}
	else
	{
		$num = ( int ) substr ( $int, 0, strlen ( $int ) - 1 );
		$len = ( int ) substr ( $int, - 1, 1 );
		if($num == 0 || $len == 0)
		{
			return 0;
		}
		$new = ( int ) (($num / 2) + 19750806 - 300000000);
		if(strlen ( $new ) == $len)
		{
			return $new;
		}
	}
	return 0;
}
function num_decode($int = 0, $type = 'ENCODE')
{
	return num_encode ( $int, 'DECODE' );
}
function get_robot()
{
	$useragent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
	if(strpos ( $useragent, 'http://' ) === FALSE)
	{
		if(strpos ( $useragent, 'googlebot' ) !== false)
		{
			return 'google';
		}
		if(strpos ( $useragent, 'msnbot' ) !== false)
		{
			return 'msn';
		}
		if(strpos ( $useragent, 'slurp' ) !== false)
		{
			return 'yahoo';
		}
		if(strpos ( $useragent, 'baiduspider' ) !== false)
		{
			return 'baidu';
		}
		if(strpos ( $useragent, 'sohu-search' ) !== false)
		{
			return 'sohu';
		}
		if(strpos ( $useragent, 'lycos' ) !== false)
		{
			return 'Lycos';
		}
		if(strpos ( $useragent, 'robozilla' ) !== false)
		{
			return 'Robozilla';
		}
	}
	return false;
}

// 去除连续(stype=1) 所有(stype=2) 空格
function delblank($str, $stype = 1, $notsql = 0)
{
	if(trim ( $str ) == '')
		return '';
	$str = str_replace ( "　", ' ', stripslashes ( $str ) );
	$str = $stype == 1 ? preg_replace ( "/[\r\n\t ]{1,}/", ' ', $str ) : preg_replace ( "/[\r\n\t ]/", '', $str );
	return $notsql ? $str : addslashes ( $str );
}
function deldanger($str)
{
	if(trim ( $str ) == '')
		return '';
	$str = stripslashes ( $str );
	$str = DelXSS ( $str );
	$str = preg_replace ( "/[\r\n\t ]{1,}/", ' ', $str );
	$str = preg_replace ( "/script/i", 'ｓｃｒｉｐｔ', $str );
	$str = preg_replace ( "/<[/]{0,1}(link|meta|ifr|fra)[^>]*>/i", '', $str );
	return addslashes ( $str );
}
function DelXSS($val)
{
	$val = preg_replace ( '/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val );
	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';
	for($i = 0;$i < strlen ( $search );$i ++)
	{
		$val = preg_replace ( '/(&#[xX]0{0,8}' . dechex ( ord ( $search[$i] ) ) . ';?)/i', $search[$i], $val );
		$val = preg_replace ( '/(&#0{0,8}' . ord ( $search[$i] ) . ';?)/', $search[$i], $val ); // with a ;
	}
	$ra1 = array(
			'javascript',
			'vbscript',
			'expression',
			'applet',
			'meta',
			'xml',
			'blink',
			'link',
			'style',
			'script',
			'embed',
			'object',
			'iframe',
			'frame',
			'frameset',
			'ilayer',
			'layer',
			'bgsound',
			'title',
			'base' 
	);
	$ra2 = array(
			'onabort',
			'onactivate',
			'onafterprint',
			'onafterupdate',
			'onbeforeactivate',
			'onbeforecopy',
			'onbeforecut',
			'onbeforedeactivate',
			'onbeforeeditfocus',
			'onbeforepaste',
			'onbeforeprint',
			'onbeforeunload',
			'onbeforeupdate',
			'onblur',
			'onbounce',
			'oncellchange',
			'onchange',
			'onclick',
			'oncontextmenu',
			'oncontrolselect',
			'oncopy',
			'oncut',
			'ondataavailable',
			'ondatasetchanged',
			'ondatasetcomplete',
			'ondblclick',
			'ondeactivate',
			'ondrag',
			'ondragend',
			'ondragenter',
			'ondragleave',
			'ondragover',
			'ondragstart',
			'ondrop',
			'onerror',
			'onerrorupdate',
			'onfilterchange',
			'onfinish',
			'onfocus',
			'onfocusin',
			'onfocusout',
			'onhelp',
			'onkeydown',
			'onkeypress',
			'onkeyup',
			'onlayoutcomplete',
			'onload',
			'onlosecapture',
			'onmousedown',
			'onmouseenter',
			'onmouseleave',
			'onmousemove',
			'onmouseout',
			'onmouseover',
			'onmouseup',
			'onmousewheel',
			'onmove',
			'onmoveend',
			'onmovestart',
			'onpaste',
			'onpropertychange',
			'onreadystatechange',
			'onreset',
			'onresize',
			'onresizeend',
			'onresizestart',
			'onrowenter',
			'onrowexit',
			'onrowsdelete',
			'onrowsinserted',
			'onscroll',
			'onselect',
			'onselectionchange',
			'onselectstart',
			'onstart',
			'onstop',
			'onsubmit',
			'onunload' 
	);
	$ra = array_merge ( $ra1, $ra2 );
	$found = true;
	while($found == true)
	{
		$val_before = $val;
		for($i = 0;$i < sizeof ( $ra );$i ++)
		{
			$pattern = '/';
			for($j = 0;$j < strlen ( $ra[$i] );$j ++)
			{
				if($j > 0)
				{
					$pattern .= '(';
					$pattern .= '(&#[xX]0{0,8}([9ab]);)';
					$pattern .= '|';
					$pattern .= '|(&#0{0,8}([9|10|13]);)';
					$pattern .= ')*';
				}
				$pattern .= $ra[$i][$j];
			}
			$pattern .= '/i';
			$replacement = substr ( $ra[$i], 0, 2 ) . '<x>' . substr ( $ra[$i], 2 );
			$val = preg_replace ( $pattern, $replacement, $val );
			if($val_before == $val)
			{
				$found = false;
			}
		}
	}
	return $val;
}
function filterstr($str)
{
	global $_glb;
	if($_glb['web_lang'] == 'utf-8')
	{
		$str = preg_replace ( "/[\"\r\n\t\$\\><']/", '', $str );
		if($str != stripslashes ( $str ))
		{
			return '';
		}
		else
		{
			return $str;
		}
	}
	else
	{
		$rs = '';
		for($i = 0;isset ( $str[$i] );$i ++)
		{
			if(ord ( $str[$i] ) > 0x80)
			{
				if(isset ( $str[$i + 1] ) && ord ( $str[$i + 1] ) > 0x40)
				{
					$rs .= $str[$i] . $str[$i + 1];
					$i ++;
				}
				else
				{
					$rs .= ' ';
				}
			}
			else
			{
				if(preg_replace ( "/[^0-9a-z@#\.]/i", $str[$i] ))
				{
					$rs .= ' ';
				}
				else
				{
					$rs .= $str[$i];
				}
			}
		}
	}
	return $rs;
}
function myiconv($str, $in_charset, $out_charset = '')
{
	echo "das";
	exit ();
	$in_charset = strtoupper ( trim ( $in_charset ) );
	$out_charset = strtoupper ( trim ( $out_charset ) );
	if($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312'))
	{
		return utf_gbk ( $str );
	}
	elseif($out_charset == 'UTF-8' && ($in_charset == 'GBK' || $in_charset == 'GB2312'))
	{
		return gbk_utf ( $str );
	}
	elseif($in_charset == 'GBK' && $out_charset == 'BIG5')
	{
		return big5_gbk ( $str );
	}
	elseif($in_charset == 'BIG5' && $out_charset == 'GBK')
	{
		return gbk_big5 ( $str );
	}
	elseif($in_charset == 'BIG5' && $out_charset == 'UTF-8')
	{
		return gbk_utf ( big5_gbk ( $str ) );
	}
	elseif($in_charset == 'UNICODE')
	{
		return un_gbk ( $str );
	}
	elseif($in_charset == 'PINYIN')
	{
		return gbk_pinyin ( $str );
	}
	elseif($in_charset == 'PY')
	{
		return gbk_py ( $str );
	}
	else
	{
		return $str;
	}
}
function mustutf($r)
{
	global $_glb;
	if($_glb['web_lang'] != 'utf-8')
	{
		return myiconv ( $r, 'gb2312', 'utf-8' );
	}
	return $r;
}

// 中文字符串截取 长度指字节数 字母一字节 汉字两字节
function substring($str, $len, $dot = '', $delblank = true)
{
	global $_glb;
	if($delblank)
		$str = preg_replace ( "/[\r\n]{1,}/", "\n", $str );
	$strlen = strlen ( $str );
	if($strlen <= $len)
		return $str;
	$str = str_replace ( array(
			'&nbsp;',
			'&amp;',
			'&quot;',
			'&#039;',
			'&ldquo;',
			'&rdquo;',
			'&mdash;',
			'&lt;',
			'&gt;',
			'&middot;',
			'&hellip;' 
	), array(
			' ',
			'&',
			'"',
			"'",
			'“',
			'”',
			'—',
			'<',
			'>',
			'·',
			'…' 
	), $str );
	$rs = '';
	if(strtolower ( $_glb['web_lang'] ) == 'gb2312' || strtolower ( $_glb['web_lang'] ) == 'gbk')
	{
		$dotlen = strlen ( $dot );
		$maxi = $len - $dotlen - 1;
		for($i = 0;$i < $maxi;$i ++)
		{
			$rs .= ord ( $str[$i] ) > 127 ? $str[$i] . $str[++ $i] : $str[$i];
		}
	}
	else
	{
		$n = $tn = $noc = 0;
		while($n < $strlen)
		{
			$t = ord ( $str[$n] );
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126))
			{
				$tn = 1;
				$n ++;
				$noc ++;
			}
			elseif(194 <= $t && $t <= 223)
			{
				$tn = 2;
				$n += 2;
				$noc += 2;
			}
			elseif(224 <= $t && $t < 239)
			{
				$tn = 3;
				$n += 3;
				$noc += 2;
			}
			elseif(240 <= $t && $t <= 247)
			{
				$tn = 4;
				$n += 4;
				$noc += 2;
			}
			elseif(248 <= $t && $t <= 251)
			{
				$tn = 5;
				$n += 5;
				$noc += 2;
			}
			elseif($t == 252 || $t == 253)
			{
				$tn = 6;
				$n += 6;
				$noc += 2;
			}
			else
			{
				$n ++;
			}
			if($noc >= $len)
				break;
		}
		if($noc > $len)
			$n -= $tn;
		if($dot != '')
			$n -= strlen ( $dot );
		$rs = substr ( $str, 0, $n );
	}
	$rs = str_replace ( array(
			'&',
			'"',
			"'",
			'<',
			'>' 
	), array(
			'&amp;',
			'&quot;',
			'&#039;',
			'&lt;',
			'&gt;' 
	), $rs );
	return $rs . $dot;
}

// 中文字符串截取 长度指字符数
function mysubstr($str, $len, $dot = '', $delblank = true)
{
	global $_glb;
	$_glb['web_lang'] = isset ( $_glb['web_lang'] ) ? strtoupper ( $_glb['web_lang'] ) : 'UTF-8';
	if($delblank)
	{
		$str = preg_replace ( "/[\r\n]{1,}/", "\n", $str );
	}
	$str = str_replace ( array(
			'&nbsp;',
			'&amp;',
			'&quot;',
			'&#039;',
			'&ldquo;',
			'&rdquo;',
			'&mdash;',
			'&middot;',
			'&hellip;' 
	), array(
			' ',
			'&',
			'"',
			"'",
			'“',
			'”',
			'—',
			'·',
			'…' 
	), $str );
	if(strpos ( $str, '&lt;' ) === false)
	{
		$rpLF = false;
	}
	else
	{
		$str = str_replace ( '&lt;', '<', $str );
		$rpLF = true;
	}
	if(strpos ( $str, '&gt;' ) === false)
	{
		$rpRT = false;
	}
	else
	{
		$str = str_replace ( '&gt;', '>', $str );
		$rpRT = true;
	}
	if($_glb['web_lang'] == 'UTF-8')
	{
		$str = myiconv ( $str, 'UTF-8', 'GBK' );
	}
	$strcut = '';
	$sublen = 0;
	for($i = 0;$i < strlen ( $str );$i ++)
	{
		if(ord ( $str[$i] ) > 127)
		{
			$strcut .= $str[$i] . $str[$i + 1];
			$i ++;
			$sublen ++;
		}
		else
		{
			$strcut .= $str[$i];
			$sublen ++;
		}
		if($sublen == $len)
			break;
	}
	$rdot = false;
	if($dot != '' && strlen ( $str ) > strlen ( $strcut ))
	{
		$rdot = true;
		$strcut = substr ( $strcut, 0, strlen ( $strcut ) - strlen ( $dot ) );
	}
	if($_glb['web_lang'] == 'UTF-8')
	{
		$strcut = myiconv ( $strcut, 'GBK', 'UTF-8' );
	}
	$strcut = str_replace ( array(
			'&',
			'"',
			"'" 
	), array(
			'&amp;',
			'&quot;',
			'&#039;' 
	), $strcut );
	if($rpLF)
	{
		$strcut = str_replace ( '<', '&lt;', $strcut );
	}
	if($rpRT)
	{
		$strcut = str_replace ( '>', '&gt;', $strcut );
	}
	
	return $strcut . ($rdot ? $dot : '');
	
	/*
	 * if(function_exists('mb_substr')) { if($_glb['web_lang']=='GB2312'||$_glb['web_lang']=='GBK'){ return
	 * mb_substr($str,0,$len,'GBK').$dot; }else{ return mb_substr($str,0,$len,'UTF-8').$dot; } }
	 */
}

// string(字符串) operation(DECODE-解密 其他-加密) key(混淆字符) expiry(过期时间) fixed(加密结果是否固定)
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0, $fixed = false)
{
	global $_glb;
	$ckey_length = $fixed ? 0 : 4;
	$key = md5 ( $key ? $key : $_glb['sitekey'] );
	$keya = md5 ( substr ( $key, 0, 16 ) );
	$keyb = md5 ( substr ( $key, 16, 16 ) );
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
	$cryptkey = $keya . md5 ( $keya . $keyc );
	$key_length = strlen ( $cryptkey );
	$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen ( $string );
	$result = '';
	$box = range ( 0, 255 );
	$rndkey = array();
	for($i = 0;$i <= 255;$i ++)
	{
		$rndkey[$i] = ord ( $cryptkey[$i % $key_length] );
	}
	for($j = $i = 0;$i < 256;$i ++)
	{
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0;$i < $string_length;$i ++)
	{
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr ( ord ( $string[$i] ) ^ ($box[($box[$a] + $box[$j]) % 256]) );
	}
	if($operation == 'DECODE')
	{
		if((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 ))
		{
			return substr ( $result, 26 );
		}
		else
		{
			return '';
		}
	}
	else
	{
		return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
	}
}
// 表单令牌加密
function input_hashcode($s = 0)
{
	$code = authcode ( 'BAIYU/POST/CODE', 'ENCODE', 'YouDianYiSi', 3600 );
	return $s == 1 ? $code : '<input type="hidden" name="SyScode" id="SyScode" value="' . $code . '"/>';
}
function check_hashcode($s = '')
{
	if(trim ( $s ) != '')
	{
		return authcode ( $s, 'DECODE', 'YouDianYiSi' ) == 'BAIYU/POST/CODE' ? true : false;
	}
	global $_POST;
	$v = isset ( $_POST['SyScode'] ) ? $_POST['SyScode'] : '';
	if($v == '' || ! locationpost ())
	{
		return false;
	}
	return authcode ( $v, 'DECODE', 'YouDianYiSi' ) == 'BAIYU/POST/CODE' ? true : false;
}
function getalbumnum($number, $num = 3)
{
	if(strlen ( $number ) >= $num)
		return $number;
	$nums = '1';
	for($i = 0;$i < $num;$i ++)
	{
		$nums .= '0';
	}
	$nums = $nums * 1;
	return substr ( strval ( $number + $nums ), 1, $num );
}

// 随机文件名
function randfilename($filename)
{
	$ext = getext ( basename ( $filename ) );
	return nmd5 ( uniqid ( rand (), true ) ) . '.' . ($ext == '' ? 'jpg' : $ext);
}

// 模板中 自定义查询SQL
function get($sql, $rows = 0, $cachetime = -1)
{
	global $msql;
	if(! $sql)
	{
		return array();
	}
	$rows = intval ( $rows );
	$limit = $rows > 1 ? " LIMIT $rows" : '';
	$sql = $sql . $limit;
	$cachetime = $cachetime == - 1 ? 3600 : $cachetime;
	if($cachetime > 0)
	{
		$md5 = md5 ( $sql );
		$caches = getfcache ( $md5, 'getList', $cachetime );
		if($caches !== false)
		{
			return $caches;
		}
	}
	$data = array();
	if($rows < 2)
	{
		$arr = $msql->getone ( $sql );
		if(is_array ( $arr ))
		{
			$data[] = $arr;
		}
	}
	else
	{
		$data = $msql->select ( $sql );
	}
	if($cachetime > 0)
	{
		setfcache ( $md5, $data, 'getList' );
	}
	return $data;
}

// 生成静态文件
function createhtml($file)
{
	$data = ob_get_contents ();
	ob_clean ();
	loadlib ( 'dir.func' );
	$strlen = creatfile ( $file, $data );
	return $strlen;
}
function datelist($data, &$lists, &$pagelist)
{
	loadlib ( 'page.func' );
	$rs = datelist_func ( $data );
	$lists = $rs[0];
	$pagelist = $rs[1];
}
function msgbox($msg = '提示信息', $back = '-1', $stime = 2500, $extra = '')
{
	global $_glb;
	$url_back = '';
	if($back && $back != '-1')
	{
		$url_back = $back;
	}
	include defined ( 'BAIYU_ADMIN' ) ? admintpl ( 'msgbox' ) : systpl ( 'msgbox' );
	exit ();
}

/*
 * 扩展类 ***********************************************
 */
function ipaddress($ip)
{
	include_once (BAIYU_LIB . '/ip.func.php');
	return convertip ( $ip );
}
function ckgfw($w = '', $much = 0)
{
	if(trim ( $w ) == '')
	{
		return '';
	}
	$cachefile = BAIYU_DATA . '/config/gfw' . ($much == 1 ? 'much' : '') . '.inc.php';
	if(! is_file ( $cachefile ))
	{
		return '';
	}
	$wds = include ($cachefile);
	foreach($wds as $wd)
	{
		if(trim ( $wd ) == '')
			continue;
		$ds = explode ( ',', $wd );
		if(is_array ( $ds ) && count ( $ds ) > 0)
		{
			foreach($ds as $d)
			{
				if(strpos ( $w, $d ) !== FALSE)
				{
					return $d;
				}
			}
		}
	}
	return '';
}


