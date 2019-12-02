<?php
require (_DBGMS_ . 'dbgms.php');

// 加载通用配置
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}
// @action 常用：自动跳转 [小庄_2016-03-31]
function jumpLink($jumplink = NULL)
{
	// @ob_clean ();
	// myheader ( "location: $url" );
	// exit ( "<script>self.location='$url';</script>" );
	
	// if(stripos($mlink,'http://')===false)
	// return false;
	echo '<script>if(/Android|webOS|iPhone|Windows Phone|iPod|BlackBerry|SymbianOS/i.test(window.navigator.userAgent) && !window.location.hash.match("fromapp")){ window.location.href = "' . $jumplink . '"; }</script>';
}
// @action 常用：获取二维码 [小庄_2016-03-10]
function getQrcode($link = NULL)
{ // 二维码 url http://www.liantu.com/pingtai/
	return 'http://qr.liantu.com/api.php?el=l&text=' . urlencode ( $link );
}
// @action 常用：获取碎片内容 [小庄_2016-03-31]
function getFragment($id = NULL)
{
	if($id != NULL)
	{
		$sql = 'SELECT c.*  FROM dbg_fragment  AS c  WHERE c.id=' . $id;
		$fragment = dbg_query ( $sql );
		return $fragment[0];
	}
	else
	{
		return '碎片不能为空';
	}
	// require_once _DBGMS_CORE_ . 'Admin.class.core.php';
	// require _DBGMS_MODULES_ . '/cms/controllers/fragment.php';
	// $fragment = CMS_Fragment::get ( $id );
	// return $fragment;
}
// @action 常用：获取友情链接 [小庄_2016-03-31]
function getFlink($id = NULL)
{
	if($id != NULL)
	{
		$sql = 'SELECT c.*  FROM dbg_flink  AS c  WHERE c.id=' . $id;
		$fragment = dbg_query ( $sql );
		return $fragment[0];
	}
	else
	{
		$sql = 'SELECT c.*  FROM dbg_flink  AS c ORDER BY c.id ASC ';
		$flink = dbg_query ( $sql );
		foreach($flink as $key=>$val)
		{
			if(empty ( $val['icon'] ) || $val['icon'] == '###')
			{
				$flink[$key]['icon'] = DBG_FILEURL . 'default/style1.jpg';
			}
			else
			{
				$flink[$key]['icon'] = DBG_FILEURL . $val['icon'];
			}
		}
		return $flink;
	}
}
// @action 常用：获取seo相关 [小庄_2016-03-31]
function getSeo($base = NULL, $column = NULL, $content = NULL, $joint = "_")
{
	$seo['title'] = $base['title'];
	$seo['description'] = $base['description'];
	$seo['keywords'] = $base['keywords'];
//    $seo['copyright'] = $base['copyright'];  //添加版权信息
//    $seo['icp'] = $base['icp'];  //ICP备案号
	if(! empty ( $column ))
	{
		$title = empty ( $column['param']['zhtitle'] ) ? $column['name'] : $column['param']['zhtitle'];
		$description = empty ( $column['param']['zhdescription'] ) ? $column['name'] : $column['param']['zhdescription'];
		$keywords = empty ( $column['param']['zhkeywords'] ) ? $column['name'] : $column['param']['zhkeywords'];

		$seo['title'] = $title . $joint . $seo['title'];
		$seo['description'] = $description . $joint . $seo['description'];
		$seo['keywords'] = $keywords . "," . $seo['keywords'];

	}
	if(! empty ( $content ))
	{
		if($column['property'] == 2)
		{
			$title = "";
		}
		else
		{
			$title = $content['title'] . $joint;
		}
		$seo['title'] = $title . $seo['title'];
		$seo['description'] = empty ( $content['description'] ) ? $seo['description'] : $content['description'];
		$seo['keywords'] = empty ( $content['keywords'] ) ? $seo['keywords'] : $content['keywords'];

        $seo['copyright'] = empty ( $content['copyright'] ) ? $seo['copyright'] : $content['copyright'];
	}
	return $seo;
}

// @action 常用：获取栏目文章列表 [小庄_2016-04-07]
function dbgColumnContentLists($column = NULL, $page = NULL, &$pagebreak = NULL, &$website_so, &$website_total)//&$website_total返回记录数
{
	/* 每页显示个数 */
	$_pagesize = empty ( $column['param']['pages'] ) ? 10 : $column['param']['pages'];
	$limit = ($page - 1) * $_pagesize . "," . $_pagesize;
	
	$_sort = empty ( $column['param']['sort'] ) ? 'id' : $column['param']['sort'];
	$_sorttype = empty ( $column['param']['sorttype'] ) ? 'DESC' : $column['param']['sorttype'];
	
	// 多维栏目筛选
	$wsql_so = array();
	$wsql_arr = array();
	foreach($_GET as $key=>$value)
	{
		$is_so_ = strpos ( $key, 'so_' );
		if($is_so_ === FALSE)
		{
		}
		else
		{
			
			$is_douhao_ = strpos ( $value, ',' );
			if($is_douhao_ === FALSE)
			{
				$key = str_replace ( 'so_', '', $key );
				$wsql_so[$key] = $value;
				$wsql_arr[] = " (c.param LIKE '%\"{$key}\"%' AND c.param LIKE '%\"{$value}\"%' ) ";
				$website_so[] = $value;
			}
			else
			{
				$value_arr = explode ( ',', $value );
				$wsql_so[$key] = $value;
				$key = str_replace ( 'so_', '', $key );
				foreach($value_arr as $duowei_douhao)
				{
					$website_so[] = $duowei_douhao;
					$wsql_arr[] = " (c.param LIKE '%\"{$key}\"%' AND c.param LIKE '%\"{$duowei_douhao}\"%' ) ";
				}
			}
		}
	}
	$wsql = join ( ' AND ', $wsql_arr );
	$wsql_so = json_encode ( $wsql_so );
	// $param_arr = serialize ( $param_arr );
	if(! empty ( $param_arr['esign'] ) && ! empty ( $param_arr['evalue'] ))
	{
		// $wsql = " (c.param LIKE '%\"{$param_arr['esign']}\"%' AND c.param LIKE '%\"{$param_arr['evalue']}\"%' ) ";
	}
	// 高级mysql 序列化后查询
	// FIND_IN_SET("{$param_arr}", `param`)
	// param REGEXP 2
	$duojicolumn_arr = array();
	$duojicolumn_arr[] = $column['id'];
	if(! empty ( $column['list'] ))
	{
		foreach($column['list'] as $key=>$val)
		{
			$duojicolumn_arr[] = $val['id'];
			if(! empty ( $val['list'] ))
			{
				foreach($val['list'] as $key2=>$val2)
				{
					$duojicolumn_arr[] = $val2['id'];
				}
			}
		}
	}
	$duojicolumn = join ( ',', $duojicolumn_arr );
	/* 当前栏目——内容列表 */
	$channel_list_sql = "model|{$column['model']};nostate|20;cid|{$duojicolumn};sort|{$_sort};sorttype|{$_sorttype};wsql|{$wsql};limit|{$limit};";
	$result = getLists ( $column['model'], $channel_list_sql );
	$model = dbg_getModel ( $column['model'] );
	
	$total = dbg_query ( "SELECT COUNT(id) AS d FROM {$model['table']} AS c WHERE c.state>=0 AND c.state!=20 AND c.columnid IN ({$duojicolumn})" );
	$url = base_url () . DBG_SITETYPE . $column['sign'] . '?p=';
	$website_total = $total[0]['d'];
	$pagebreak = dbg_pagebreak ( $page, $website_total, $_pagesize, $url );
	return $result;
}
// @action 常用：栏目,获取导航[小庄_2016-03-31]
function getNavs($model = NULL, $column = NULL, $content = NULL)
{
	// 1.1 先加载文件,查询文件是存在查询文件
	if(! file_exists ( DBG_DATA . 'cache.nav.php' ))
	{
		echo "导航栏目解析缓存文件不存在,请后台更新缓存!";
		exit ();
	}
	return include DBG_DATA . 'cache.nav.php';
}
// @action 常用：栏目,或者需要的栏目[小庄_2016-03-31]
function getColumn($model = NULL, $column = NULL, $isparent = FALSE)
{
	$ColumnList = include DBG_DATA . 'cache.column.php';
	if(! empty ( $column ))
	{
		$channel = NULL;
		foreach($ColumnList as $val)
		{
			if(is_numeric ( $column ))
			{
				if($val['id'] == $column)
				{
					$channel = $val;
				}
			}
			elseif(is_string ( $column ))
			{
				if($val['sign'] == $column)
				{
					$channel = $val;
				}
			}
		}
		if($isparent == TRUE)
		{
			if($channel['column'] != 0)
			{
				$channel = getColumn ( 1, $channel['column'], TRUE );
			}
		}
		return $channel;
	}
	else
	{
		return $ColumnList;
	}
}
// @action 常用：获取内容列表[小庄_2016-03-31]
function getLists($model_id, $first_sql = NULL, $first_sql_type = 3, $is_update_cache = NULL)
{
	// 获取单条内容
	if(empty ( $first_sql ))
	{
		exit ( "没有ID，或者没有sql语句" );
	}
	$model = dbg_getModel ( $model_id );
	// 查询数据
	// 2.组合sql
	$ids = array();
	$lists = array();
	switch($first_sql_type)
	{
		/* 传递sql方式1： array('model'=>1,'sort'=>'hits') */
		case 2:
			// 组合语句
			$last_sql = "";
			$order_by = ! empty ( $first_sql['sort'] ) ? " ORDER BY c." . $first_sql['sort'] : " ORDER BY c.intime DESC ";
			$limit = ! empty ( $first_sql['row'] ) ? " LIMIT 0," . $first_sql['row'] : '';
			$last_sql = $order_by . $limit;
			if(! empty ( $first_sql['debug'] ) && $first_sql['debug'] == 1)
			{
				print_r ( $last_sql );
			}
			break;
		case 3:
		default:
			// 传递sql方式3,默认：
			// $first_sql =
			// 'cattype|;id|;cid|;nocid|;kinds|;album|;state|;nostate|;type|normal;keywords|;keyextra|;keyfield|keywords;wsql|;sort|intime;sorttype|desc;time|0;row|10;page|0;limit|;
			// mrow|0;parsealbum|0;func|;extra|;cache|-1;debug|0';
			$last_sql = "";
			dbgms_LoadClass ( 'Contentlist.class.php' );
			$contentlist = new Contentlist ( $first_sql );
			$last_array = $contentlist->getlist ();
			// 一般为获取多条, 获取id 数组
			$ids2 = array();
			$ids2 = dbg_query ( $last_array[0] );
			if(! empty ( $ids2 ))
			{
				foreach($ids2 as $k=>$val)
				{
					$ids[] = $val['id'];
				}
			}
			break;
	}

	// 3.1 查询缓存 +解析
	if($model['param']['iscache'] == 1 && ! empty ( $model['param']['iscache'] ))
	{
		dbgms_LoadClass ( 'Cache.class.php' );
		$cache_config['dir'] = DBG_CACHE; // CI缓存目录
		$cache_config['time'] = 3600; // 缓存时间;
		$cache = new Cache ( $cache_config );
		$cache->function['parse'] = 'dbgms_ContentParse';
		$cache->function['query'] = 'dbg_query';
		// 获取缓存 + 并且回调解析函数
		// 3.2解析
		foreach($ids as $k=>$val)
		{
			$param = array(
					$model['id'],
					NULL,
					$val
			);
			$lists[] = $cache->get_cache_content ( $model['sign'], $model['sign'] . $val, $is_update_cache, $param );
		}
		unset ( $cache );

	}
	else
	{
		if(count ( $ids ) > 0)
		{
			$id_sql = count ( $ids ) > 1 ? ' IN (' . join ( ',', $ids ) . ')' : '=' . $ids[0];

			// 3.2解析
			$arr = array();
			if(count ( $ids ) == 1)
			{
				$arr = dbg_query ( $model['sql'] . $id_sql );
				$lists[] = dbgms_ContentParse ( $model['id'], $arr );
			}
			else
			{
				$arr = dbg_query ( $model['sql'] . $id_sql );
				$lists = dbgms_ContentParse ( $model['id'], $arr );
			}
		}

		unset ( $arr );
	}

//	foreach ($lists as &$val){
//        $val['thumb'] = strstr($val['thumb'],"/file");
//    }

	return $lists;
}

/**
  * 获取标签文章
  * $label 标签参数
  * $page 页码
 *  $page_num 每页获取的条数
 *  $count 总条数
 *  $all_page 总页码
 */

function get_label_lists($label = 1,$page_num = 6,$sort_num = 1){
    $page = empty($_GET['p'])?1:$_GET['p'];
    $limit = ($page - 1) * $page_num . "," . $page_num;

    $sort = 'intime'; //时间
    if($sort_num == 2){  //点击量
        $sort = 'hits';
    }

    $select_sql = 'SELECT id,columnid,intime,title,description,keywords,hits,thumb,slide,content,label FROM db_news WHERE label=' . $label . ' order by '. $sort. ' desc' ;

    $count_sql = 'SELECT count(id) as num FROM db_news WHERE label=' . $label;
    $count = dbg_query ( $count_sql )[0]['num'];
    $all_page = ceil($count/$page_num);

    if($page){
        $select_sql = $select_sql. ' limit ' .  $limit;
    }
    $list = dbg_query ( $select_sql );
    if(!empty($list)){
        foreach ($list as &$val){
            $val['thumb'] = '/file'.$val['thumb'];  //图片路径
            $select_sign_sql = 'SELECT sign FROM dbg_column WHERE id =' . $val['columnid'];
            $val['sign'] = dbg_query ( $select_sign_sql )[0]['sign'];
            $val['link'] = base_url ().'zh/'.$val['sign'].'/'.$val['id'].'.html';
        }
    }

    $data = [
       'data'       => $list,
        'num'       => $count,
        'all_page'  => $all_page
    ];
    return $data;
}

/**
 * 通过文章获取上级栏目信息
 * $columnid 上级栏目id
 */

function getSuperiorInfo($columnid){
    $select_sql = 'SELECT * FROM dbg_column WHERE id=' . $columnid .' limit 0,1' ;
    $data = dbg_query ( $select_sql );
    return $data;
}


// @action 常用：获取单条数据 [小庄_2016-03-31]
function getRow($modelid, $rowid)
{
	$rowid = intval ( $rowid );
	if(empty ( $rowid ) || ! is_numeric ( $rowid ))
	{
		exit ( "单条内容 " . $rowid . " id 错误" );
	}
	$model = dbg_getModel ( $modelid );
	$ids = array();
	$lists = array();
	$ids[] = $rowid;
	// 3.1 查询缓存 +解析
	if($model['param']['iscache'] == 1 && ! empty ( $model['param']['iscache'] ))
	{
		dbgms_LoadClass ( 'Cache.class.php' );
		$cache_config['dir'] = DBG_CACHE; // CI缓存目录
		$cache_config['time'] = 3600; // 缓存时间;
		$cache = new Cache ( $cache_config );
		$cache->function['parse'] = 'dbgms_ContentParse';
		$cache->function['query'] = 'dbg_query';
		// 获取缓存 + 并且回调解析函数
		// 3.2解析
		foreach($ids as $k=>$val)
		{
			$param = array(
					$model['id'],
					NULL,
					$val 
			);
			$lists[] = $cache->get_cache_content ( $model['sign'], $model['sign'] . $val, $is_update_cache, $param );
		}
		unset ( $cache );
	}
	else
	{
		if(count ( $ids ) > 0)
		{
			$id_sql = count ( $ids ) > 1 ? ' IN (' . join ( ',', $ids ) . ')' : '=' . $ids[0];
		}
		$arr = array();
		$arr = dbg_query ( $model['sql'] . $id_sql );
		// 3.2解析
		$lists = dbgms_ContentParse ( $model['id'], $arr );
		unset ( $arr );
	}
	if(is_numeric ( $rowid ) && count ( $lists ) == 1)
	{ /* 单条数据时候 */
		$lists = $lists[0];
	}
	return $lists;
}

/*
 * 获取动态生成的表单代码
 */
function getformhtml($rfid = 0){
        // 获取表单文件路径
        /*$htmlfileuri = dbg_query('SELECT cachefile FROM `dbg_richform` WHERE rfid='.$rfid, true);
        $htmlfileuri = $htmlfileuri[0]['cachefile'];*/
        $richformlist = include DBG_DATA.'cache.richform.php';
        $htmlfileuri = DBG_DATA.$richformlist[$rfid]['cachefile'];
        return file_get_contents($htmlfileuri);
}


// @action 常用：获取单条数据 [shizs_20170405]
function getNext($modelid, $rowid,$cloumnId)
{
	$rowid = intval ( $rowid );
	if(empty ( $rowid ) || ! is_numeric ( $rowid ))
	{
		exit ( "获取下一页 " . $rowid . " id 错误" );
	}
	$model = dbg_getModel ( $modelid );
	$ids = array();
	$lists = array();
	$ids[] = $rowid;
	
        $sqlStr = "select  * from db_news where columnid = {$cloumnId} and id > {$rowid} and state=0 order by id asc LIMIT 0,1";
        $arr = dbg_query ($sqlStr );
       

        // 3.2解析
        $lists = dbgms_ContentParse ( $model['id'], $arr );

        unset ( $arr );

	return $lists;
}

// @action 常用：获取单条数据 [shizs_20170405]
function getPrev($modelid, $rowid,$cloumnId)
{
	$rowid = intval ( $rowid );
	if(empty ( $rowid ) || ! is_numeric ( $rowid ))
	{
		exit ( "获取上一页 " . $rowid . " id 错误" );
	}
	$model = dbg_getModel ( $modelid );
	$ids = array();
	$lists = array();
	$ids[] = $rowid;
	
        $sqlStr = "select  * from db_news where columnid = {$cloumnId} and id < {$rowid} and state=0 order by id desc LIMIT 0,1";
        $arr = dbg_query ($sqlStr );
       

        // 3.2解析
        $lists = dbgms_ContentParse ( $model['id'], $arr );

        unset ( $arr );

	return $lists;
}

//获取分页样式_shizs20170616
function getPageHtml($column = NULL, $currentPage = NULL , $total = null, $pageLabel = 'a',$curLabel = null,$curClass = null,$showNum = 5,$countText = true, $style = null,$pageUrl=null)
{ 
        /* 每页显示个数 */
        if($column == null || $total == null)
        {
            return "<span>1<span>";
        }
        
        if($currentPage == null)
            $currentPage = 1;
        
	$pageSize = empty ( $column['param']['pages'] ) ? 10 : $column['param']['pages'];
        
        if($pageUrl == null)
            $url = base_url () . DBG_SITETYPE . $column['sign'] . '?p=';
        else
            $url = $pageUrl. '?p=';
        
        //当前页面标签
        if($curLabel == null)
        {
            $curLabel = $pageLabel;
        }
        
	/* style风格样式 */
        if($style == NULL)
	{
		$style = '';
	}
        
	/* javascript设置选中 */
        if($curClass != NULL)
        {
            $javascript = "<script type=\"text/javascript\">var dbgms_pagebreak =document.getElementById('page" . $currentPage 
                    . "');if(dbgms_pagebreak!=undefined){dbgms_pagebreak.setAttribute('class','current');}</script>";
        }
	
	$pagetotal = ceil ( $total / $pageSize ); // 向上取整,算出分页
        
        $paging = '';
        //显示统计信息
        if($countText)
            $paging = "<span>$total 条记录 $currentPage/$pagetotal 页</span>";
        // <span>46 条记录 1/6 页</span> <a href="">下一页</a> <span class="current">1</span> <a href="">&nbsp;2&nbsp;</a> <a href="">&nbsp;3&nbsp;</a> <a href="">&nbsp;4&nbsp;</a> <a href="">&nbsp;5&nbsp;</a> <a href="">下5页</a> <a href="">末页</a> 
	if($pagetotal == 1)
	{
		$paging .= '<'.$pageLabel.' id="page1" rel="1" href=" ' . $url . '1" >1</'.$pageLabel .'>';
	}
	else
	{
              
                
		
		// 中间部分,输出7个分页
                $leftNum = floor($showNum /2);
                $startNum = $currentPage - $leftNum;
                if($startNum <= 0)
                    $startNum = 1;
                $endNum = $startNum + $showNum ;

                // 开头部分,是否显示上一页
		if(($currentPage - $leftNum) > 1)
		{
			$paging .= '<'.$pageLabel.' id="page1" rel="1" href=" ' . $url . '1" >&nbsp;1...&nbsp;</'.$pageLabel.'>
				<'.$pageLabel.'  href=" ' . $url . ($currentPage - 1) . '"  rel="' . ($currentPage - 1) . '" class="next">上一页</'.$pageLabel.'>';
		}
                
		for($i = $startNum;$i < $endNum;$i ++)
		{
			if($i < 1 || $i > $pagetotal)
			{
				continue;
			}
                        if( $i == $currentPage)
                        {
                            $paging .= '<'.$curLabel.' id="page' . $i . '" rel="' . $i . '" >&nbsp;' . $i . '&nbsp;</'.$curLabel.'>';
                        }
                        else
                        {
                            $paging .= '<'.$pageLabel.' id="page' . $i . '" rel="' . $i . '" href=" ' . $url . $i . '">&nbsp;' . $i . '&nbsp;</'.$pageLabel.'>';
                        }
                                
			
		}
		// 结尾部分,是否显示下一页
		if(($currentPage + $leftNum) <= $pagetotal)
		{
			$paging .= '<'.$pageLabel.' href=" ' . $url . ($currentPage + 1) . '" rel="' . ($currentPage + 1) . '" class="next">下一页</'.$pageLabel.'>
						<'.$pageLabel.' id="page' . $pagetotal . '" rel="' . $pagetotal . '" href="' . $url . $pagetotal . '">...' . $pagetotal . '</'.$pageLabel.'>';
		}
	}
	// 是否开启跳转
	//$pagego = '<input type="text" class="gopage" maxlength="3"/><a href="javascript:goPage(' . htmltostr ( $indexurl ) . ');">GO</a>';
	//$paging .= "<br/>(总共" . $total . "条记录 )";
       // $paging .= '<br/><br /><span>'.$total.'条记录'.$currentPage.'/'. $pagetotal .' 页</span> ';
	return $style . $paging . $javascript;
        
    //function dbg_pagebreak($currentPage, $total, $pageSize, $url, $style = NULL)
}

/*
 * 获取前台提交的数据列表
 */
function getformList($rfid = 0,$page = 1,$pageSize = 10,&$total){
    //获取表单信息
    $basedata = dbg_query('SELECT rfname,bindproduct,tablename FROM `dbg_richform` WHERE rfid="'.$rfid.'"',true);
    $basedata = $basedata[0];
    
    //总记录数
    $sql1 = "select count(id) As d from {$basedata['tablename']}";   
    $total = dbg_query($sql1);
    $total = $total[0]['d'];
    
    
    //获取留言列表
    $sql = "select * from {$basedata['tablename']} order by id DESC LIMIT " . ($page - 1) * $pageSize . "," . $pageSize;

    return dbg_query ( $sql );
}