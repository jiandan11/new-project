<?php
if(! defined ( 'DBGMS_ROOT' ))
{
	header ( 'HTTP/1.1 404 Not Found' );
	exit ();
}
class Contentlist {
	public $currtime;
	public $cfg;
	public $usecmt;
	public $modelCache;
	public $catlogCache;
	public $update;
	public $msql;
	// 兼容php5构造函数
	function __construct($setting = array())
	{
		global $dbg_ci;
		// 缺省配置
		$defaultcfg = array(
				'model' => '', // 模型
				'id' => '', // id
				'noid' => '', // 排除id
				'cid' => '', // 栏目id
				'nocid' => '', // 排除栏目
				'state' => '', // 状态
				'nostate' => '', // 排除状态
				'keywords' => '', // 关键字
				'keyextra' => '',
				'keyfield' => 'keywords', // 关键词限制
				'wsql' => '', // where 语句
				'sort' => 'intime', // 默认排序字段
				'sorttype' => 'desc', // 默认排序-倒叙
				'time' => 0,
				'row' => 10, // 默认limt 0,10
				'page' => 1,
				'limit' => '',
				'mrow' => 0,
				'parsealbum' => 0,
				'cache' => 0, // -1永久缓存 0不缓存 >0 (单位 秒)
				'func' => '',
				'extra' => '',
				'debug' => 0 
		); // 开启debug模式,输出sql语句
		
		$setting = $this->attsext ( $setting, NULL );
		$setting = array_merge ( $setting, compact ( 'model', 'cid' ) );
		$cfg2 = array();
		foreach($defaultcfg as $k=>$v)
		{
			$cfg2[$k] = isset ( $setting[$k] ) ? $setting[$k] : $v;
		}
		$cfg2['sort'] = trim ( $cfg2['sort'] );
		$cfg2['sorttype'] = strtoupper ( trim ( $cfg2['sorttype'] ) );
		$cfg2['sorttype'] = in_array ( $cfg2['sorttype'], array(
				'DESC',
				'ASC' 
		) ) ? $cfg2['sorttype'] : 'DESC';
		$this->currtime = time ();
		$this->cfg = $cfg2;
		
		$this->usecmt = ($this->cfg['sort'] == 'cmt' || $this->cfg['sort'] == 'comment');
		// 获取模型缓存
		$this->modelCache = dbg_getModel ( $cfg2['model'] );
		// $this->catlogCache = catlog_gcache ();//获取栏目缓存
		$this->update = 0;
		$this->msql = $dbg_ci;
	}
	function contentlist($setting = array())
	{
		$this->__construct ( $setting );
	}
	// 用于 func 文件的atts默认解析
	function attsext($default, $atts)
	{
		$row = array();
		if(! empty ( $default ))
		{
			$defaultAry = explode ( ';', $default );
			foreach($defaultAry as $ary)
			{
				list($k,$v) = explode ( '|', $ary );
				$row[$k] = $v;
			}
		}
		if(! empty ( $atts ) && is_array ( $atts ))
		{
			foreach($atts as $m=>$att)
			{
				$row[$m] = $att;
			}
		}
		return $row;
	}
	/*
	 * 重置配置
	 */
	function setcfg($key = '', $val = '')
	{
		$settings = array();
		if(is_array ( $key ))
		{
			$settings = $key;
		}
		else
		{
			$settings[$key] = $val;
		}
		foreach($settings as $k=>$v)
		{
			if(isset ( $this->cfg[$k] ))
			{
				$this->cfg[$k] = $v;
			}
		}
	}
	
	/*
	 * 获取列表ids
	 */
	function getlist()
	{
		$sqls = $this->getsql ();
		if(! is_array ( $sqls ))
		{
			return array();
		}
		if($this->cfg['debug'])
		{
			var_dump ( $sqls );
		}
		return $sqls;
		
		$md5 = md5 ( ($this->cfg['mrow'] ? '1' : '0') . '_' . join ( '', $sqls ) );
		// 是否可以使用缓存
		$cacheids = array();
		$gomysql = 1;
		if($this->cfg['cache'] != 0)
		{
			if($this->cfg['debug'])
			{
				echo 'getCache';
			}
			$cacheTime = $this->cfg['cache'] < 0 ? - 1 : $this->cfg['cache'];
			$caches = $this->getCache ( $md5, 'conList', $cacheTime );
			if($caches !== false)
			{
				$gomysql = 0;
				$cacheids = $caches;
			}
		}
		if($gomysql)
		{
			if($this->cfg['debug'])
			{
				echo 'execquery';
			}
			foreach($sqls as $sql)
			{
				$cacheids = array_merge ( $cacheids, $this->msql->select ( $sql ) );
			}
			// ?补齐条数
			if($this->cfg['mrow'] && count ( $cacheids ) < $this->cfg['row'])
			{
				$msqls = $this->getMrows ( $cacheids );
				foreach($msqls as $sql)
				{
					$cacheids = array_merge ( $cacheids, $this->msql->select ( $sql ) );
				}
				unset ( $msqls );
			}
			$cacheids = $this->ParseIds ( $cacheids, count ( $sqls ) > 1 );
			if($this->cfg['cache'] != 0)
			{
				setfcache ( $md5, $cacheids, 'conList', true );
			}
		}
		return $this->getlist_data ( $cacheids );
	}
	function getUpdate()
	{
		return $this->update;
	}
	
	/*
	 * 为了得到 缓存文件上次更新时间 从common.func.php拷贝了此函数 稍做了修改 *************************************************************
	 */
	function getCache($key = '', $dir = 'com', $time = -1, $slize = true)
	{
		global $_glb;
		if(trim ( $key ) == '')
			return false;
		$md5 = md5 ( $key . $_glb['sitekey'] );
		$cfile = BAIYU_DATA . '/cache' . ($dir == '' ? '' : '/' . $dir) . '/' . substr ( $md5, 0, 2 ) . '/' . substr ( $md5, 2, 2 ) . '/' . substr ( $md5, 4, 28 ) . ($slize ? '.inc' : '.php');
		if(! is_file ( $cfile ))
		{
			$this->update = $this->currtime;
			return false;
		}
		$date = @filemtime ( $cfile );
		if($time == - 1)
		{
			$this->update = $date;
			$rs = parsefcache ( $cfile, $slize );
			return $rs;
		}
		$time = intval ( $time );
		if(($date + $time) < $this->currtime)
		{
			$this->update = $this->currtime;
			return false;
		}
		$this->update = $date;
		$rs = parsefcache ( $cfile, $slize );
		return $rs;
	}
	
	/*
	 * 对查询得到的 ids 数据做 排序 附加模型ID 处理 *************************************************************
	 */
	function ParseIds($ids = array(), $isMulits = false)
	{
		$MulitSort = ($isMulits && $this->cfg['sort'] != 'rand');
		if($MulitSort)
		{
			$sorts = array();
			$sorts_field = $this->usecmt ? 'comment' : $this->cfg['sort'];
		}
		foreach($ids as $k=>$v)
		{
			if($this->usecmt)
			{
				$v['comment'] = isset ( $v['total'] ) ? intval ( $v['total'] ) : 0;
				unset ( $v['total'] );
			}
			if($MulitSort)
			{
				$sorts[$k] = $v[$sorts_field];
			}
			$ids[$k] = $v;
		}
		if($isMulits)
		{
			if($this->cfg['sort'] == 'rand')
			{
				shuffle ( $ids );
			}
			else
			{
				array_multisort ( $sorts, ($this->cfg['sorttype'] == 'ASC' ? SORT_ASC : SORT_DESC), $ids );
			}
			if(count ( $ids ) > $this->cfg['row'])
			{
				$ids = array_slice ( $ids, 0, $this->cfg['row'] );
			}
		}
		foreach($ids as $k=>$v)
		{
			$v['model'] = $this->catlogCache[$v['cid']]['model'];
			unset ( $v['cid'] );
			if($isMulits && ! $this->usecmt)
			{
				unset ( $v[$sorts_field] );
			}
			$ids[$k] = $v;
		}
		return $ids;
	}
	
	/*
	 * sql语句拼凑 *************************************************************
	 */
	function getsql()
	{
		// 状态
		$state = array_unique ( array_filter ( explode ( ',', $this->cfg['state'] ) ) );
		if(count ( $state ) > 0)
		{
			$wheresql = 'WHERE c.state' . $this->getsql_warr ( $state );
		}
		else
		{
			$wheresql = 'WHERE c.state>=0';
			// 状态
			$nostate = array_unique ( array_filter ( explode ( ',', $this->cfg['nostate'] ) ) );
			if(count ( $nostate ) > 0)
			{
				$wheresql .= ' AND c.state' . $this->getsql_warr ( $nostate, true );
			}
		}
		// 排除ID
		if($this->cfg['noid'] > 0)
		{
			$wheresql .= ' AND c.id NOT IN(' . $this->cfg['noid'] . ') ';
		}
		// 时间限制
		$time = intval ( $this->cfg['time'] );
		if($time > 0)
		{
			$mtime = $this->currtime - $time * 3600 * 24;
			$wheresql .= " AND c.uptime>$mtime";
		}
		// 关键词限制
		if($this->cfg['keyfield'] != '')
		{
			$keyfieldSQL = '';
			$keyfield = array_unique ( array_filter ( explode ( ',', $this->cfg['keyfield'] ) ) );
			if(count ( $keyfield ) > 1)
			{
				$keyfieldSQL = "CONCAT_WS('',c." . join ( ',c.', $keyfield ) . ')';
			}
			else
			{
				$keyfieldSQL = 'c.' . $keyfield[0];
			}
			if($keyfieldSQL != '')
			{
				$keywords = array();
				if($this->cfg['keywords'] != '')
				{
					$keywords = explode ( ',', $this->cfg['keywords'] );
				}
				if($this->cfg['keyextra'] != '')
				{
					loadlib ( 'pscws' );
					$keywords = array_merge ( $keywords, pscws_getSword ( $this->cfg['keyextra'] ) );
				}
				$keywords = array_unique ( array_filter ( $keywords ) );
				$keynum = 0;
				$keysql = '';
				foreach($keywords as $key)
				{
					$key = trim ( $key );
					if($key != '')
					{
						$keysql .= ($keysql == '' ? '' : 'OR ') . $keyfieldSQL . "  LIKE '%$key%' ";
						$keynum ++;
					}
					if($keynum >= 5)
					{
						break;
					}
				}
				if($keysql != '')
				{
					$wheresql .= ' AND (' . $keysql . ')';
				}
				unset ( $keywords, $keynum, $keysql );
			}
			unset ( $keyfieldSQL, $keyfield );
		}
		// 自定义限制
		if($this->cfg['wsql'] != '')
		{
			$wheresql .= ' AND ( ' . $this->cfg['wsql'] . ' )';
		}
		// 排序字段
		$sort = $this->cfg['sort'];
		// 排序方式
		$sorttype = $this->cfg['sorttype'];
		// 页条数Limit
		$row = $this->cfg['row'];
		$offset = (max ( 1, $this->cfg['page'] ) - 1) * $row;
		
		// 栏目限制 可指定多个
		$cids = $this->getcids ( $this->cfg['cid'] );
		// 栏目排除 可指定多个(优先 同一个栏目在 指定与排除中同时出现 则排除)
		$nocids = $this->getcids ( $this->cfg['nocid'] );
		
		// 自定义限制
		if($this->cfg['cid'] != '')
		{
			$wheresql .= ' AND c.columnid IN(' . $this->cfg['cid'] . ' )';
		}
		
		// 手工指定了模型 则剔除栏目设置中 不属于手工指定模型的单元
		$models = array();
		$model = $this->cfg['model'] != '' ? array_unique ( array_filter ( explode ( ',', $this->cfg['model'] ) ) ) : array();
		if(count ( $model ) > 0)
		{
			foreach($model as $c)
			{
				$arr = array();
				$arr['id'] = $c;
				$arr['cids'] = false;
				$arr['nocids'] = false;
				if(isset ( $cids[$c] ))
				{
					if(isset ( $nocids[$c] ))
					{
						$cids_tmp = $cids[$c];
						foreach($cids_tmp as $kk=>$cc)
						{
							if(in_array ( $cc, $nocids[$c] ))
							{
								unset ( $cids_tmp[$kk] );
							}
						}
						$arr['cids'] = array_values ( $cids_tmp );
						unset ( $cids_tmp );
					}
					else
					{
						$arr['cids'] = $cids[$c];
					}
				}
				else
				{
					if(isset ( $nocids[$c] ))
					{
						$arr['nocids'] = $nocids[$c];
					}
				}
				$models[] = $arr;
			}
		}
		else
		{
			foreach($cids as $k=>$v)
			{
				$arr = array();
				$arr['id'] = $k;
				$arr['cids'] = false;
				$arr['nocids'] = false;
				if($v)
				{
					if(isset ( $nocids[$k] ))
					{
						foreach($v as $kk=>$vv)
						{
							if(in_array ( $vv, $nocids[$k] ))
							{
								unset ( $v[$kk] );
							}
						}
						$arr['cids'] = array_values ( $v );
					}
					else
					{
						$arr['cids'] = $v;
					}
				}
				else
				{
					if(isset ( $nocids[$k] ))
					{
						$arr['nocids'] = $nocids[$k];
					}
				}
				$models[] = $arr;
			}
		}
		if(count ( $models ) < 1)
		{
			foreach($this->modelCache as $k=>$v)
			{
				$models[] = array(
						'id' => $v['id'],
						'cids' => false,
						'nocids' => false 
				);
			}
		}
		
		// 这里放一个类得 public变量 方便补齐条数使用
		$this->models = $models;
		
		// Fields
		// $fields = 'c.id,c.columnid';
		$fields = 'c.id ';
		if($this->usecmt)
		{
			$fields .= ',m.total';
		}
		elseif($sort == 'good')
		{
			$fields .= ',dg.good';
		}
		elseif(count ( $models ) > 1 && $sort != 'rand')
		{
			$fields .= ',c.' . $sort;
		}
		
		// 专辑设置
		$album = $this->cfg['album'];
		
		// 获取条数
		$LimitSql = $this->cfg['limit'];
		if($LimitSql == '')
		{
			$LimitSql = "$offset,$row";
		}
		
		$sql = array();
		foreach($models as $model)
		{
			$modelid = $model['id'];
			$catInfo = $this->modelCache;
			$table = $catInfo['table'];
			$wsql = $wheresql;
			if($model['cids'])
			{
				$wsql .= ' AND c.cid' . $this->getsql_warr ( $model['cids'] );
			}
			if($model['nocids'])
			{
				$wsql .= ' AND c.cid' . $this->getsql_warr ( $model['nocids'], true );
			}
			// 按评论排序
			if($this->usecmt)
			{
				$csign = $catInfo['sign'];
				if($album > 0)
				{
					$sql[] = "SELECT $fields FROM `{db}albumids` AS a LEFT JOIN `{db}$table` c ON a.aid=c.id LEFT JOIN `{db}autocmt` m ON m.data=c.id AND m.type='$csign' $wsql AND a.tid='$album' AND a.fid='$modelid' ORDER BY m.total $sorttype LIMIT $LimitSql;";
				}
				else
				{
					$sql[] = "SELECT $fields FROM `$table` AS c LEFT JOIN `{db}autocmt` m ON m.data=c.id AND m.type='$csign' $wsql ORDER BY m.total $sorttype LIMIT $LimitSql";
				}
			}
			else
			{
				if($sort == 'good')
				{
					$digleft = "LEFT JOIN `{db}caches_digs` dg ON (dg.id=c.id AND dg.type='{$catInfo['sign']}')";
					$newsort = 'dg.good';
				}
				else
				{
					$digleft = '';
					$newsort = $sort != 'rand' ? 'c.' . $sort : 'rand()';
				}
				if($album > 0)
				{
					$sql[] = "SELECT $fields FROM `{db}albumids` AS a LEFT JOIN `{db}$table` c ON a.aid=c.id $digleft $wsql AND a.tid='$album' AND a.fid='$modelid' ORDER BY " . ($sort == 'rktime' ? 'a.rtime' : $newsort) . " DESC LIMIT $LimitSql;";
				}
				else
				{
					$sql[] = "SELECT $fields FROM `$table` AS c $digleft $wsql ORDER BY $newsort $sorttype LIMIT $LimitSql";
				}
			}
		}
		return $sql;
	}
	
	/*
	 * 补齐条数SQL拼凑 在数据够用的时候 这个基本不会被启动 :) *************************************************************
	 */
	function getMrows($ids)
	{
		$sqls = array();
		if(! isset ( $this->models ))
		{
			return $sqls;
		}
		$models = $this->models;
		$limit = $this->cfg['row'] - count ( $ids );
		$wheresql = 'WHERE c.state>=0';
		$cacheids = array();
		foreach($ids as $v)
		{
			$cacheids[] = $v['id'];
		}
		if($this->cfg['noid'] > 0 && ! in_array ( $this->cfg['noid'], $cacheids ))
		{
			$cacheids[] = $this->cfg['noid'];
		}
		if(count ( $cacheids ) > 0)
		{
			$wheresql .= ' AND c.id' . $this->getsql_warr ( $cacheids, true );
		}
		
		// Sort
		$sort = $this->cfg['sort'];
		// Sorttype
		$sorttype = $this->cfg['sorttype'];
		
		// Fields
		$fields = 'c.id,c.cid';
		if($this->usecmt)
		{
			$fields .= ',m.total';
		}
		elseif($sort == 'good')
		{
			$fields .= ',dg.good';
		}
		elseif(count ( $models ) > 1 && $sort != 'rand')
		{
			$fields .= ',c.' . $sort;
		}
		
		// 查询条数
		$offset = 0;
		$row = $limit;
		
		foreach($models as $model)
		{
			$modelid = $model['id'];
			$catInfo = $this->modelCache[$modelid];
			$table = $catInfo['table'];
			$wsql = $wheresql;
			if($model['cids'])
			{
				$wsql .= ' AND c.cid' . $this->getsql_warr ( $model['cids'] );
			}
			if($model['nocids'])
			{
				$wsql .= ' AND c.cid' . $this->getsql_warr ( $model['nocids'], true );
			}
			// 按评论排序
			if($this->usecmt)
			{
				$csign = $catInfo['sign'];
				if($album > 0)
				{
					$sqls[] = "SELECT $fields FROM `{db}albumids` a LEFT JOIN `{db}$table` c ON a.aid=c.id LEFT JOIN `{db}autocmt` m ON m.data=c.id AND m.type='$csign' $wsql AND a.tid='$album' AND a.fid='$model' ORDER BY m.total $sorttype LIMIT $offset,$row;";
				}
				else
				{
					$sqls[] = "SELECT $fields FROM `{db}$table` c LEFT JOIN `{db}autocmt` m ON m.data=c.id AND m.type='$csign' $wsql ORDER BY m.total $sorttype LIMIT $offset,$row";
				}
			}
			else
			{
				if($sort == 'good')
				{
					$digleft = "LEFT JOIN `{db}caches_digs` dg ON (dg.id=c.id AND dg.type='{$catInfo['sign']}')";
					$newsort = 'dg.good';
				}
				else
				{
					$digleft = '';
					$newsort = $sort != 'rand' ? 'c.' . $sort : 'rand()';
				}
				if($album > 0)
				{
					$sqls[] = "SELECT $fields FROM `{db}albumids` a LEFT JOIN `{db}$table` c ON a.aid=c.id $digleft $wsql AND a.tid='$album' AND a.fid='$model' ORDER BY " . ($sort == 'rktime' ? 'a.rtime' : $newsort) . " DESC LIMIT $offset,$row;";
				}
				else
				{
					$sqls[] = "SELECT $fields FROM `{db}$table` c $digleft $wsql ORDER BY $newsort $sorttype LIMIT $offset,$row";
				}
			}
		}
		if($this->cfg['debug'])
		{
			print_r ( $sqls );
		}
		return $sqls;
	}
	// 子栏目ID字符串 ($self - 是否包含本身)
	function catlog_sonids($cid = 0, $self = true)
	{
		$ids = array();
		$rs = is_array ( $ids ) ? implode ( ',', $ids ) : false;
		return $rs;
	}
	/*
	 * 获得指定cid的所有子栏目并 格式化为数组 *************************************************************
	 */
	function getcids($ccid = '')
	{
		$ccid = trim ( $ccid );
		$cids = array();
		if($ccid != '')
		{
			// 转数组
			$cids = array_unique ( array_filter ( explode ( ',', $ccid ) ) );
			if(count ( $cids ) > 0)
			{
				$datas = array();
				foreach($cids as $k=>$v)
				{
					if(isset ( $this->catlogCache[$v] ))
					{
						$modelid = $this->catlogCache[$v]['model'];
						if(! isset ( $datas[$modelid] ))
						{
							$datas[$modelid] = array();
						}
						$datas[$modelid][] = $v;
					}
				}
				$cids = $datas;
				unset ( $datas );
			}
		}
		return $cids;
	}
	
	/*
	 * 多限制 wsql 处理 *************************************************************
	 */
	function getsql_warr($arr = array(), $un = false)
	{
		if($un)
		{
			return count ( $arr ) > 1 ? ' NOT IN (' . join ( ',', $arr ) . ') ' : '!=' . $arr[0];
		}
		else
		{
			return count ( $arr ) > 1 ? ' IN (' . join ( ',', $arr ) . ') ' : '=' . $arr[0];
		}
	}
	
	/*
	 * 最终返回数据处理 *************************************************************
	 */
	function getlist_data($ids = array())
	{
		$rsAry = array();
		foreach($ids as $s)
		{
			$v = art_getcache ( $s['model'], $s['id'] );
			if(! is_array ( $v ))
				continue;
			if($this->usecmt)
			{
				$v['comment'] = $s['comment'];
			}
			if(isset ( $s['good'] ))
			{
				$v['good'] = $s['good'];
			}
			if($this->cfg['parsealbum'] && count ( $v['albums'] ) > 0)
			{
				foreach($v['albums'] as $a=>$album)
				{
					if($album['id'])
					{
						$albums = album_gcache ( $album['id'] );
						if($albums)
						{
							$v['albums'][$a]['name'] = $albums['name'];
							$v['albums'][$a]['link'] = $albums['link'];
						}
					}
				}
			}
			// 要对底层数据进行扩展 使用 func标签 extra可传递自定义参数
			if($this->cfg['func'] != '')
			{
				$v = $func ( $v, $this->cfg['extra'] );
			} // End special
			$rsAry[] = $v;
		}
		return $rsAry;
	}
}
?>