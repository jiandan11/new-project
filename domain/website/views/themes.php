<?php
// {elapsed_time} memory_usage:<?php echo memory_get_usage();? >___{memory_usage}
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$themesviewpath = FCPATH . 'themes/' . DOMAIN_THEMES . '/views/' . $tep_path;
if(! file_exists ( $themesviewpath ))
{
	show_error ( '模板不存在', 404, 404 );
}
include $themesviewpath;
?>

