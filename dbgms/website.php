<?php
if(! defined ( 'DBG_OPEN' ))
{
	header ( 'HTTP/1.1 404 Not Found' );
	// 页面跳转
	// header ( 'Location:install' );
	// echo '<meta http-equiv="refresh" content="5; url=index.com/" />';
	// echo '该页面不允许单独访问,5秒后跳转<br/>';
	exit ( '权限路径.No direct script access allowed' );
}
/* 获取基本信息 */
if($_dbg_glb['trait']['hcache'] == 1)
{ /* 开启静态缓存,这里使用CI框架自带 */
	$this->output->cache ( 300 );
}
$website['_site'] = $_dbg_glb['base'];

/* 顶部导航 */
$website['_navs'] = getNavs ();

/*start***********************开启多语言处理**********************/
if($_SESSION['language'] == 'english'){
        $website['_site']['title'] = $_dbg_glb['en']['title'] ? $_dbg_glb['en']['title'] : $_dbg_glb['base']['title'];
        $website['_site']['keywords'] = $_dbg_glb['en']['keywords'] ? $_dbg_glb['en']['keywords'] : $_dbg_glb['base']['keywords'];
        $website['_site']['description'] = $_dbg_glb['en']['description'] ? $_dbg_glb['en']['description'] : $_dbg_glb['base']['description'];
        $website['_channel']['name'] = $website['_channel']['ename'] ? $website['_channel']['ename'] : $website['_channel']['name'];
        foreach ($website['_navs'] as $key => $value) {
            $website['_navs'][$key]['name'] = $value['ename'] ? $value['ename'] : $value['name'];
            if(is_array($value['list'])){
                foreach ($value['list'] as $key2 => $value2) {
                    $website['_navs'][$key]['list'][$key2]['name'] = $value2['ename'] ? $value2['ename'] : $value2['name'];
                    if(is_array($value2['list'])){
                        foreach ($value2['list'] as $key3 => $value3) {
                            $website['_navs'][$key]['list'][$key2]['list'][$key3]['name'] = $value3['ename'] ? $value3['ename'] : $value3['name'];
                        }
                    }
                }
            }
        }
}
 /*end***********************开启多语言处理**********************/

/* seo标签 */
$website['_seo'] = getSeo ( $website['_site'], $website['_channel'], $website['_content'] );

/* css -js 资源路径,后期修改dbg_ui()方法,一条加载并且压缩 */
$website['_baseurl'] = $this->config->base_url (); /* 基本链接 */

//var_dump($website['_baseurl']);

$website['_uiurl'] = $website['_baseurl'] . 'themes/' . DOMAIN_THEMES . '/';
$PHP_SELF = $_SERVER['SCRIPT_NAME'];
// $url = 'http://' . $_SERVER['HTTP_HOST'] . substr ( $PHP_SELF, 0, strrpos ( $PHP_SELF, '/' ) + 1 );
// echo $_SERVER['HTTP_HOST'].'<br/>';
$_root_ = substr ( $PHP_SELF, 0, strrpos ( $PHP_SELF, '/' ) + 1 );
$website['_uipath'] = $_root_ . 'themes/' . DOMAIN_THEMES . '/';
$website['_toolurl'] = $website['_baseurl'] . 'themes/tool/'; /* 工具url */
$website['_vuiurl'] = $website['_baseurl'] . 'ui/v1207/'; /* 高定制网站专用 */
$website['_vuipath'] = $_root_ . 'ui/v1207/';
