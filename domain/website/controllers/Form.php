<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Form extends CI_Controller {
	public function __construct()
	{
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		date_default_timezone_set ( 'Asia/Shanghai' );
		//error_reporting ( 0 );
                error_reporting ( E_ALL ^ E_NOTICE );
	}
        public function purseformpushdata(){
		define ( 'DBG_OPEN', TRUE );
		require (_DBGMS_ . 'dbgms.php');
                
                 if(boolval($_REQUEST['needCheck'] )){
                     if($_REQUEST['yanzhengma'] == '' || md5($_REQUEST['yanzhengma']) != $_SESSION['captcha']){
                        echo '验证码输入不正确！';exit;
                     }
                }       
                
                // 通过rfid得到表名字段
                $rfid = dbg_input_getpost('rfid');
                $tableinfo = dbg_query('SELECT tablename,bindproduct FROM `dbg_richform` WHERE rfid="' . $rfid . '"',true);
                $tablename = $tableinfo[0]['tablename'];
                $productinfo = $tableinfo[0]['bindproduct'];
                
                //2. 获取富表单成员字段
                $sql = "SELECT a.attrname,a.labelcontent,b.regtype,b.function,b.expression,b.prompt FROM `dbg_form_element` a LEFT JOIN `dbg_regular` b ON a.regid=b.regid WHERE a.rfid='" . $rfid . "' AND a.enable=1 AND a.attrname != '' AND a.isrecord=1 ORDER BY a.sortnum DESC";
                $tmpdata = dbg_query($sql, TRUE);
                
                // 让字段唯一
                $richelementlist = $tmpdata;
                foreach ($tmpdata as $key => $value) {
                    $conflictnum = 0;
                    foreach ($richelementlist as $key1 => $value1) {
                        if($value['attrname'] == $value1['attrname']){
                                $conflictnum++;
                        }
                        if($conflictnum == 2){
                                unset($richelementlist[$key]);
                        }
                    }
                }
                
                // 获取数据 构造sql语句
                $insertsql = "INSERT INTO `{$tablename}` ";
                $columnstring = '(';
                $valuestring = 'VALUES (';
                if($productinfo != ''){
                        $productinfo = explode('|', $productinfo);
                        $columnstring .= "`productid`,";
                        $columnstring .= "`productname`,";
                        $columnstring .= "`producttable`,";
                        $valuestring .= "'{$productinfo[0]}',";
                        $valuestring .= "'{$productinfo[1]}',";
                        $valuestring .= "'{$productinfo[2]}',";
                }
                
                $pushformdata = array();
                
                foreach ($richelementlist as $key => $value) {
                        $pushformdata[$value['attrname']] = trim(dbg_input_getpost($value['attrname']));
                        // 需要做规则验证
                        if($value['regtype'] == 2){//php正则验证
                                if($value['expression'] == ''){
				                        $columnstring .= "`{$value['attrname']}`,";
				                        $valuestring .= "'{$pushformdata[$value['attrname']]}',";
                                        continue;
                                }
                                $rtn = preg_match($value['expression'], $pushformdata[$value['attrname']]);
                                if(!$rtn){
                                        echo $value['labelcontent'] . ':' . $value['prompt'];exit;
                                }
                        }
                        $columnstring .= "`{$value['attrname']}`,";
                        $valuestring .= "'{$pushformdata[$value['attrname']]}',";
                }
                $columnstring .= "`operatetime`) ";
                $valuestring .= time() . ') ';
                
                $insertsql .= $columnstring . $valuestring;
                $result = dbg_query($insertsql,false);
                echo $result;
                exit;
        }

}
