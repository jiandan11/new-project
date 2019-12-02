<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * 模板前端中英文切换
 */
class Setlanguage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        date_default_timezone_set('Asia/Shanghai');
        error_reporting(0);
    }
    /*
     * $language chinese english
     */
    public function set($language = '') {
        session_start();
        if (empty($language)) {
            
        } else {
            $this->session->set_userdata('language', $language);
        }
        header("location:" . base_url());
    }

}
