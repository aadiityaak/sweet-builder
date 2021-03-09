<?php
/**
 * Plugin Name: Sweet Builder Modules
 * Plugin URI: https://github.com/aadiityaak/sweet-builder
 * Description: Speed up your project with sweet module.
 * Version: 2.0.1
 * Author: Velocity Developer
 * Author URI: https://velocitydeveloper.com
 */
define( 'FL_SWEET_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_SWEET_URL', plugins_url( '/', __FILE__ ) );

require_once FL_SWEET_DIR . 'classes/class-fl-sweet-builder-loader.php';
require_once FL_SWEET_DIR . 'classes/postview.php';