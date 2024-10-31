<?php
/*
Plugin Name: Page restriction with roles
Plugin URI: ''
Description: Make restriction on different pages for different users based on the extended role provided with this plugin
Version: 0.1
Author: Mithu A Quayium
Author URI: http://www.cybercraftit.com
License: GPLv2 or later
Text Domain: prwr
*/

define( 'PRWR_DIR', dirname(__FILE__) );
class Prwr_init {

    public $slugs;

    function __construct() {
        $this->includes();
    }


    function includes() {
        require_once PRWR_DIR.'/base-frontend.php';
        require_once PRWR_DIR.'/common-functions.php';
        require_once PRWR_DIR.'/prwr_role.php';
        require_once PRWR_DIR.'/shortcode.php';
        if ( is_admin() ) {
            require_once PRWR_DIR.'/admin/base-admin.php';
            require_once PRWR_DIR.'/admin/prwr-role-admin.php';
            require_once PRWR_DIR.'/admin/prwr-user-admin.php';
        }
    }
}

new Prwr_init();