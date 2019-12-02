<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );

// 合并表单 查询--数据转移
// SELECT
// n.title,
// n.intime,
// n.uptime,
// n.description,
// nc.content,
// CONCAT(n.classid, '/', c.classname) AS columnid,
// CONCAT('/d/file/',c.classpath,'/',f.path,'/',f.thumb) AS thumb
// FROM
// phome_ecms_news AS n
// LEFT JOIN phome_ecms_news_data_1 AS nc
// ON nc.id = n.id
// LEFT JOIN phome_enewsclass AS c
// ON n.classid = c.classid
// LEFT JOIN phome_enewsfile AS f
// ON n.filename = f.fileid
// ORDER BY intime ASC;";

/********************************************/

// SELECT hc.*, hcn.name AS hcname,hcs.name AS hsname,
// hc1.name AS city1,hc2.name AS city2,hc3.name AS city3
// FROM
// hooqo_company_nature AS hcn,
// hooqo_company_scale AS hcs,
// hooqo_company AS hc
// FROM db_company AS hc
// LEFT JOIN db_city AS hc1 ON hc1.id = hc.city_1
// LEFT JOIN db_city AS hc2 ON hc2.id = hc.city_2
// LEFT JOIN db_city AS hc3 ON hc3.id = hc.city_3
// LEFT JOIN db_company_nature AS hcn ON hcn.cnid = hc.cnid
// LEFT JOIN db_company_scale AS hcs ON hcs.csid = hc.csid
// WHERE hc.name LIKE '%北京%'
// WHERE hc.name LIKE '%百纳%' AND hcn.cnid=hc.cnid AND hcs.csid=hc.csid

// @action:清空表单 TRUNCATE dbg_admin_log
/*
 * mysql查询一天一周一个月的数据
 *
 * 查询一天：
 * Java代码
 * select * from table where to_days(column_time) = to_days(now());
 * select * from table where date(column_time) = curdate();
 * 查询一周：
 * Java代码
 * select * from table where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(column_time);
 * 查询一个月：
 * Java代码
 * select * from table where DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(column_time);
 */

// SELECT dl.id,dl.title,dl.num,COUNT(dlr1.lid) AS recos1,COUNT(dlr2.lid) AS recos2,COUNT(dlr3.lid) AS recos3,
// COUNT(dlr4.lid) AS recos4 ,COUNT(dlr.lid) AS recos FROM db_libao_reco AS dlr
// LEFT JOIN db_libao AS dl ON dlr.lid = dl.id LEFT JOIN db_libao_reco AS dlr1 ON ( dlr1.id = dlr.id AND TO_DAYS(FROM_UNIXTIME(dlr1.intime, '%Y-%m-%d')) = TO_DAYS(NOW()) )
// LEFT JOIN db_libao_reco AS dlr2 ON ( dlr2.id = dlr.id AND FROM_UNIXTIME(dlr2.intime, '%Y-%m-%d %H:%i') > DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND FROM_UNIXTIME(dlr2.intime, '%Y-%m-%d %H:%i') < CURDATE())
// LEFT JOIN db_libao_reco AS dlr3 ON ( dlr3.id = dlr.id AND FROM_UNIXTIME(dlr3.intime, '%Y-%m-%d %H:%i') > DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND FROM_UNIXTIME(dlr3.intime, '%Y-%m-%d %H:%i') < DATE_SUB(CURDATE(), INTERVAL 1 DAY))
// LEFT JOIN db_libao_reco AS dlr4 ON (dlr4.id = dlr.id AND DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= FROM_UNIXTIME(dlr4.intime, '%Y-%m-%d') )
// WHERE dl.title LIKE '%".$title."%' ".$wsql2."
// GROUP BY dlr.lid DESC LIMIT " . ($page - 1) * $pagerow . ",$pagerow";

// $monthtime = date ( "Y-m-d", strtotime ( "-1 month" ) );
// $wsql2= " AND FROM_UNIXTIME(dlr.intime, '%Y-%m-%d') >='" . $monthtime . "'";
// }else{
// $wsql2= " AND FROM_UNIXTIME(dlr.intime, '%Y-%m-%d %H:%i') >= '" . $cdate_start . "'
// AND FROM_UNIXTIME(dlr.intime, '%Y-%m-%d %H:%i') <= '" . $cdate_end . "'";
// }

// SELECT COUNT(DISTINCT (dlr.lid)) AS d FROM db_libao_reco AS dlr LEFT JOIN db_libao AS dl ON dlr.lid = dl.id
// WHERE dl.title LIKE '%".$title."%' ".$wsql2);

/**
 *
 * @author Name zhw Email 343196936@qq.com Data 2015年3月15日
 * @param string $table
 *        	数据表名
 * @param string $where_sql
 *        	查询条件
 * @param unknown $data
 *        	需要获取的 字段数组
 * @return string 返回重新编写好的sql语句
 */
function get_table_data($table = NULL, $where_sql = NULL, $data = array())
{
	if($table == NULL || ! is_array ( $data ))
	{ // 判断是否为空
		return '';
	}
	if($where_sql == NULL && $data == NULL)
	{ // 查询所有
		$sql = "SELECT * FROM `$table` ";
	}
	else if($where_sql == NULL && $data != NULL)
	{ // 查询需要的数据表字段
		$field = '';
		foreach($data as $value)
		{
			$field .= ($field == '' ? '' : ',') . "`$value`";
		}
		$sql = "SELECT $field FROM `$table` ";
	}
	else if($where_sql != NULL && $data == NULL)
	{
		$sql = "SELECT * FROM `$table` WHERE $where_sql ;";
	}
	else if($where_sql != NULL && $data != NULL)
	{
		$field = '';
		foreach($data as $value)
		{
			$field .= ($field == '' ? '' : ',') . "`$value`";
		}
		$sql = "SELECT $field FROM `$table` WHERE $where_sql;";
	}
	return $sql;
}

/**
 * 查询数据
 *
 * @param string $database        	
 * @return boolean
 *
 */
function connect_mysql($database = NULL)
{
	// connect_mysql ( 'benshouji' );
	// 连接MySQL
	$link = mysql_connect ( "localhost", "root", "123456" );
	if(! $link)
	{ // 判断是否存在
		die ( 'Connect Database Error:<br/>' . mysql_error () );
	}
	else
	{
		echo 'Connect Database Success(连接成功)<br/>';
	}
	// 选择数据库
	mysql_select_db ( $database, $link );
	// sql 语句
	$select_sql = "SELECT * FROM `db_news` ORDER BY id LIMIT 0,10";
	// 执行查询语句
	$result = mysql_query ( $select_sql, $link );
	
	// $row = mysql_fetch_array ( $result ); // 取数组
	// while ( $row = mysql_fetch_row ( $result [0] ) ) {
	// if (strtolower ( $row [0] ) == strtolower ( $tbname )) {
	// mysql_freeresult ( $this->result [0] );
	// return true;
	// }
	// }
	// var_dump ( mysql_fetch_row ( $result ) );
	// // $row = mysql_num_rows ( $res );// 返回行数
	// var_dump ( $row );
	
	if(FALSE == $result)
	{
		echo "Querry failed!";
	}
	$i = 0;
	$j = 0;
	while($i ++ < mysql_num_rows ( $result )) // 取总行数
	{
		$meta_c = 0;
		if($meta_c = mysql_fetch_row ( $result )) // 取每一行的结果集
		{
			while($j < mysql_num_fields ( $result )) // 取一行的列数
			{
				echo $meta_c[$j];
			}
			echo "<br>";
		} // while;
		$j = 0;
	}
	// 释放结果集
	mysql_free_result ( $result );
	// 关闭连接
	if(mysql_close ( $link ))
	{
		// echo "Close Database Success";
	}
	else
	{
		// echo "Close Database Error";
	}
}
// 创建数据库
// Create database，创建一个数据库，名字为 my_db
function CreateDB()
{
	if(mysql_query ( "CREATE DATABASE my_db", $link ))
	{
		echo "Database created is Successful(or Correct)";
		echo "<br/>";
	}
	else
	{
		echo "Error creating database: " . "<br/>" . mysql_error ();
		echo "<br/>";
	}
	echo "<br/>";
}
// 创建表
function CreateTable()
{
	// Create table in my_db database 创建数据表 函数
	mysql_select_db ( "my_db", $link );
	$sql = "CREATE TABLE Persons
				(
					FirstName varchar(15),
					LastName varchar(15),
					Age int
				)";
	if(mysql_query ( $sql, $link ))
	{
		echo "Table created is Successful(or Correct)";
		echo "<br/>";
	}
	else
	{
		echo "Error creating table: " . "<br/>" . mysql_error ();
		echo "<br/>";
	}
	echo "<br/>";
}
function login()
{
	$value = $_POST['value'];
	$obj = json_decode ( $value );
	$uname = $obj->uname;
	$upassword = $obj->upassword;
	if(! empty ( $row ))
	{
		$mselect = "select * from `quser` where uname = '" . $uname . "' and upass = '" . $upassword . "'";
		$res = mysql_query ( $mselect );
		$row = mysql_num_rows ( $res );
		if(! empty ( $row ))
		{
			$arr = array();
			// 结果集中取得一行作为关联数组。
			// 用assoc来取得结果集中的 一行 是array（[username]=>'test',[password]=>'123456'）
			while($row = mysql_fetch_assoc ( $res ))
			{
				$arr[] = $row;
			}
			die ( json_encode ( $arr ) );
		}
		else
		{
			printf ( "nopass" );
		}
	}
	else
	{
		printf ( "nouser" );
	}
	die ();
}