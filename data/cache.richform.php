<?php
if(!defined('DBGMS_ROOT')){
	header('HTTP/1.1 404 Not Found');
	exit("权限路径.No direct script access allowed");
}
return array (
  2 => 
  array (
    'rfid' => '2',
    'rfname' => '留言板',
    'tablename' => 'Message',
    'bindproduct' => '',
    'action' => '/Form/purseformpushdata',
    'method' => 'post',
    'okmsg' => '提交成功!',
    'jumpurl' => '/',
    'isdelete' => '0',
    'jsfileaddr' => '',
    'outdivstyle' => 'style="width: 90%;margin: 0 auto;margin-top: 20px;"',
    'formstyle' => '',
    'ulstyle' => '',
    'buttondivstyle' => 'style="padding-top: 5px;"',
    'description' => '',
    'cachefile' => 'formhtml/Message.html',
    'istablebuild' => '1',
    'operatetime' => '1497235976',
  ),
  3 => 
  array (
    'rfid' => '3',
    'rfname' => 'Message2',
    'tablename' => 'Message2',
    'bindproduct' => '',
    'action' => '/Form/purseformpushdata',
    'method' => 'post',
    'okmsg' => '提交成功',
    'jumpurl' => '/',
    'isdelete' => '0',
    'jsfileaddr' => '',
    'outdivstyle' => '',
    'formstyle' => '',
    'ulstyle' => '',
    'buttondivstyle' => '',
    'description' => '',
    'cachefile' => 'formhtml/Message2.html',
    'istablebuild' => '1',
    'operatetime' => '1573539383',
  ),
);
?>